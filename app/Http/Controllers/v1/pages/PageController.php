<?php

namespace App\Http\Controllers\v1\pages;

use App;
use App\Http\Components\Page as PageComponent;
use App\Http\Controllers\DataController;
use App\Libraries\PaymentGateway\Braintree;
use App\Tools\ChannelAttribution;
use App\Tools\ShredzAPI;
use App\User;
use Aws\S3\S3Client;
use Cache;
use Crypt;
use File;
use FitlifeGroup\Models\Eloquent\Country;
use FitlifeGroup\Models\Eloquent\GeoIP;
use FitlifeGroup\Models\Eloquent\Page as PageModel;
use Flysystem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as Image;
use Storage;

class PageController extends DataController
{
    protected $page;
    protected $attribution;

    public function __construct(Request $request, ChannelAttribution $attribution, PageComponent $page)
    {
        $this->attribution = $attribution;
        $cached = ($request->input('cached', 'true') === 'true');

        $contentEditor = Auth::check() && Auth::user()->dashUser && Auth::user()->dashUser->isContentEditor();
        $noPrivate = App::environment('production') && !$contentEditor;

        $this->page
        =$page
        ->excludingPrivate($noPrivate)
        ->current($cached);
         //parent::__construct();
        view()->share('page', $this->page);

        $userIdentity = Auth::check() ? Auth::user()->payer_email : \Session::getId();
        view()->share('userIdentity', Crypt::encrypt(json_encode($userIdentity)));
        view()->share('mainUrl', config('app.url'));
    }

    public function settings()
    {
        $user = User::with('fitness_goals', 'profile')->find(Auth::user()['id']);
        //return $user;
        // add false or tru to see if user is subscribed
        $user['subscribed'] = $this->checkUserSubscription();
        $user['date_of_birth'] = count($user->profile) ? date('m/d/Y',strtotime($user->profile['date_of_birth'])) : '';

        return view('pages.settings', ['user' => $user]);
    }

    public function paymentProfiles()
    {
        $user = User::with('fitness_goals')->find(Auth::user()['id']);
        //return $user;
        // add false or tru to see if user is subscribed
        $user['subscribed'] = $this->checkUserSubscription();

        return view('pages.paymentProfiles', ['user' => $user]);
    }

    public function addPaymentMethod()
    {
        $countries = Country::sorted()->get();
        $country = Country::where('name', 'United States')->first();
        $states = [];
        foreach ($country->regions as $key => $value) {
            $states[$key] = $value;
        }
        $user = User::with('fitness_goals')->find(Auth::user()['id']);
        //return $user;
        // add false or tru to see if user is subscribed
        $user['subscribed'] = $this->checkUserSubscription();
        $user['token'] = (new Braintree)->getClientToken();

        return view('pages.addPaymentMethod', ['user' => $user]);
    }

    /**
     * Store a new credit card and add or create a new address and attach to customer
     * @param int $id Customer id
     *
     */
    public function storeCreditCard($id)
    {
        $validator = $this->validator(Input::all());
        if($validator->fails()){
            return Response::json(['errors' => $validator->errors()], 422);
        }
        $gatewayName = $this->paymentGateway->getName();
        $customer = Customer::with('addresses', 'paymentProfiles')->findOrFail($id);
        //verify that the customer exists before adding payment method
        $gatewayCustomer = $this->paymentGateway->getCustomer($id);
        if(!$this->paymentGateway->getResponse()){
            //create the customer if the customer does not exists in gateway
            $btCustomerdata = [
                'id' => $customer->id,
                'firstName' => $customer->first_name,
                'lastName' => $customer->last_name,
                'company' => $customer->payer_business_name,
                'email' => $customer->payer_email,
                'phone' => $customer->contact_phone
            ];
            $gatewayCustomerId = $this->paymentGateway->createCustomer($btCustomerdata);
            if(!$this->paymentGateway->getResponse()){
                return Response::json(['errors' => ['customer' => [$this->paymentGateway->getMessage()]]], 422);
            }
            $gatewayCustomer = $this->paymentGateway->getCustomer($gatewayCustomerId);
        }
        if($gatewayCustomer['id'] == $customer->id){//continue only if we have the same customer on both sides
            if(Input::get('primary') == 'true'){
              $primaryValue = true;
            }else if(Input::get('primary') == 'false'){
              $primaryValue = false;
            }
            $paymentMethodData = [
                'customerId' => $customer->id,
                'paymentMethodNonce' => Input::get('nonce_token'),
                'billingAddress' => ['postalCode' => Input::get('postal_code')],
                'primary' => $primaryValue
            ];
            $paymentMethod = $this->paymentGateway->addPaymentMethod($paymentMethodData);
            if(!$this->paymentGateway->getResponse()){
                return Response::json(['errors' => ['customer' => [$this->paymentGateway->getMessage()]]], 422);
            }
            $data = [
                'last_four' => $paymentMethod['last_four'],
                'billing_reference' => $paymentMethod['billing_reference'],
                'type' => $paymentMethod['type'],
                'billing_zip' => $paymentMethod['address_zip'],
                'expiration_date' => Carbon::create($paymentMethod['expiration_year'], $paymentMethod['expiration_month'], 1),
                'customer_id' => $paymentMethod['customer_id'],
                'gateway' => $gatewayName
              ];
              $this->createPaymentProfile($customer, $data, Input::get('primary'));
              return Response::json(['success' => 'Payment method added.'], 200);
        }//end same ids
    }

    /**
     * Return a validator instance when adding a new cc with no creditcard
     * @param array $param
     * @return Validator
     */
    public function validator($data)
    {
        return Validator::make($data, [
            'nonce_token' => 'required',
            'postal_code' => 'required'
        ]);
    }


    public function shippingAddresses()
    {
        $user = User::with('fitness_goals')->find(Auth::user()['id']);
        //return $user;
        // add false or tru to see if user is subscribed
        $user['subscribed'] = $this->checkUserSubscription();

        return view('pages.shippingAddresses', ['user' => $user]);
    }

    public function addShippingAddress()
    {
        $user = User::with('fitness_goals')->find(Auth::user()['id']);
        //return $user;
        // add false or tru to see if user is subscribed
        $user['subscribed'] = $this->checkUserSubscription();

        return view('pages.addShippingAddress', ['user' => $user]);
    }

    public function editShippingAddress($uid)
    {
        $user = User::with('fitness_goals')->find(Auth::user()['id']);
        //return $user;
        // add false or tru to see if user is subscribed
        $user['subscribed'] = $this->checkUserSubscription();
        $user['editing_addr_uid'] = $uid;

        return view('pages.editShippingAddress', ['user' => $user]);
    }

    public function settingsSubs()
    {
        $user = User::with('fitness_goals', 'image_url')->find(Auth::user()['id']);
        //return $user;
        // add false or tru to see if user is subscribed
        $user['subscribed'] = $this->checkUserSubscription();

        return view('pages.settingsSubscriptions', ['user' => $user]);
    }

    public function settingsOrders()
    {
        $user = User::with('fitness_goals', 'image_url')->find(Auth::user()['id']);
        //return $user;
        // add false or tru to see if user is subscribed
        $user['subscribed'] = $this->checkUserSubscription();

        return view('pages.settingsOrders', ['user' => $user]);
    }

    public function subscriptions()
    {
        $user = User::with('fitness_goals', 'image_url')->find(10);

        return view('pages.subscriptions', ['user' => $user]);
    }

    public function membership()
    {
        return view('pages.membership');
    }


    public function getResults()
    {
        // $featuredReviews = PageModel::with([
        //     'tags',
        //     'meta',
        //     'assets'=>function($q) {
        //             $q->wherePivot('relation_type_name', 'primary_image');
        //     }])
        //     ->published()
        //     ->orderByRaw('RAND()')
        //     ->ofType(4)
        //     ->take(10)
        //     ->get()
        //     ->each(function ($page) {
        //         PageComponent::transform($page);
        //     });

        // $reviews = PageModel::with([
        //     'tags',
        //     'meta',
        //     'assets'=>function($q) {
        //             $q->wherePivot('relation_type_name', 'primary_image');
        //     }])
        //     ->published()
        //     ->orderByRaw('RAND()')
        //     ->ofType(5)
        //     ->take(60)
        //     ->get()
        //     ->each(function ($page) {
        //         PageComponent::transform($page);
        //     });

        // return view('pages.reviews', ['featuredReviews' => $featuredReviews->toArray(), 'reviews' => $reviews->toArray()]);

            return view('pages.results');
    }

    public function invite()
    {
        return view('pages.invitation');
    }

    public function home(Request $request)
    {
        $ip = $request->server('HTTP_X_REAL_IP') ?: $request->server('HTTP_X_FORWARDED_FOR') ?: $request->ip();
        $ip = explode(',', str_replace(' ', '', $ip))[0]; // in case of multiple x-forwarded-for

        $geo = GeoIP::has('country')->with('country')->withIPv4($ip)->first();

        $country = $geo ? $geo->country : Country::where('code', 'US')->first();

        $s3 = Storage::disk('s3');
        if ($s3->has('/flags/' . $country->code . '-2x.jpg')) {
            $countryBannerImage = 'https://s3.amazonaws.com/' . config('filesystems.disks.s3.bucket') . '/flags/' . $country->code . '-2x.jpg';
        } else {
            $countryBannerImage = 'https://s3.amazonaws.com/' . config('filesystems.disks.s3.bucket') . '/flags/US-2x.jpg';
        }

        $countryBannerText = $country->getMetaAttribute('country_banner_text');
        $countryBannerColor = $country->getMetaAttribute('country_banner_color');

        $transformations = PageModel::whereHas('assets', function ($query) {
           $query->where('assetables.relation_type_name', 'primary_image');
        })
        ->with([
        'tags',
        'meta',
        'assets' => function($query){
            $query->wherePivot('relation_type_name', 'primary_image');
        }])
        ->published()
        ->ofType(5)
        ->latest()
        ->get();

        $femaleImages = [];
        $maleImages = [];

        $transformations->each(function ($transformation) use (&$femaleImages, &$maleImages) {
            $gender = null;
            $transformation->tags->each(function ($tag) use (&$gender) {
               if (in_array($tag->key, ['women', 'men'])) {
                   $gender = $tag->key;
                   return false;
               }
            });

            if ($transformation->assets->count()) {
               if ($gender == 'men') {
                   $maleImages[] = $transformation->assets[0]->path;
               } elseif ($gender == 'women') {
                   $femaleImages[] = $transformation->assets[0]->path;
               }
            }
        });

        return view('pages.home', compact('countryBannerImage', 'countryBannerText', 'countryBannerColor', 'femaleImages', 'maleImages'));
    }

    public function home_v1(Request $request)
    {
        $ip = $request->server('HTTP_X_REAL_IP') ?: $request->server('HTTP_X_FORWARDED_FOR') ?: $request->ip();
        $ip = explode(',', str_replace(' ', '', $ip))[0]; // in case of multiple x-forwarded-for

        $geo = GeoIP::has('country')->with('country')->withIPv4($ip)->first();

        $country = $geo ? $geo->country : Country::where('code', 'US')->first();

        $s3 = Storage::disk('s3');
        if ($s3->has('/flags/' . $country->code . '-2x.jpg')) {
            $countryBannerImage = 'https://s3.amazonaws.com/' . config('filesystems.disks.s3.bucket') . '/flags/' . $country->code . '-2x.jpg';
        } else {
            $countryBannerImage = 'https://s3.amazonaws.com/' . config('filesystems.disks.s3.bucket') . '/flags/US-2x.jpg';
        }

        $countryBannerText = $country->getMetaAttribute('country_banner_text');
        $countryBannerColor = $country->getMetaAttribute('country_banner_color');

        $transformations = PageModel::whereHas('assets', function ($query) {
           $query->where('assetables.relation_type_name', 'primary_image');
        })
        ->with([
        'tags',
        'meta',
        'assets' => function($query){
            $query->wherePivot('relation_type_name', 'primary_image');
        }])
        ->published()
        ->ofType(5)
        ->latest()
        ->get();

        $femaleImages = [];
        $maleImages = [];

        $transformations->each(function ($transformation) use (&$femaleImages, &$maleImages) {
            $gender = null;
            $transformation->tags->each(function ($tag) use (&$gender) {
               if (in_array($tag->key, ['women', 'men'])) {
                   $gender = $tag->key;
                   return false;
               }
            });

            if ($transformation->assets->count()) {
               if ($gender == 'men') {
                   $maleImages[] = $transformation->assets[0]->path;
               } elseif ($gender == 'women') {
                   $femaleImages[] = $transformation->assets[0]->path;
               }
            }
        });

        return view('pages.home-old', compact('countryBannerImage', 'countryBannerText', 'countryBannerColor', 'femaleImages', 'maleImages'));
    }

    public function cart()
    {
        return view('pages.cart');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function blog(Request $request, PageComponent $pageComponent)
    {
        $category = $request->input('category');
        $cached = ($request->input('cached', 'true') === 'true');

        $blogs = $pageComponent->blogs($category, $cached);

        $blogTags = [
            'workouts',
            'motivation',
            'nutrition',
            'wellness',
            'recipes',
            'women'
        ];

        $trendingNowPath = [
            '3-reasons-you-re-not-shredded',
            '10-ways-to-cut-calories-without-noticing',
            'post-workout-beauty-tips',
            '5-strength-training-mistakes-that-are-holding-you-back',
            'chicken-butterflying-your-chicken-breast'
        ];

        return view('pages.blog', ['blogs' => $blogs, 'category' => $category, 'blogTags' => $blogTags, 'trendingNowPath' => $trendingNowPath]);
    }


    // public function blog(Request $request)
    // {
    //     $category = $request->input('category');
    //     $cached = ($request->input('cached', 'true') === 'true');

    //     $storeId = $this->attribution->getChannelId();
    //     $agentId = $this->attribution->getAgentId();

    //     $cache_key = 'blogs_' . str_pad($storeId, 3, '0', STR_PAD_LEFT) . '_a' . str_pad($agentId, 3, '0', STR_PAD_LEFT) . (empty($category) ? '' : '_' . $category);

    //     if (empty($blogs = $cached ? Cache::get($cache_key) : null)) {
    //         $blogs
    //         =PageModel::published()
    //         ->excludingPrivate()
    //         ->with('channel', 'agent', 'type', 'tags', 'assets', 'meta', 'author')
    //         ->whereHas('tags', function ($query) use ($category) {
    //             if (!empty($category)) {
    //                 $query->where('key', $category);
    //             } else {
    //                 $query->whereNotNull('key');
    //             }
    //         })
    //         ->recentPublicationsFirst()
    //         ->ofType(8)
    //         ->get()
    //         ->each(function ($page) {
    //             PageComponent::transform($page);
    //         });

    //         $blogs = json_decode(json_encode($blogs), true);

    //         // swap first and second blog item if
    //         // first's primary category is not the current
    //         // category
    //         if (count($blogs) > 1 && ($first = $blogs[0])) {
    //             if (@$first['_primary_category'] !== $category) {
    //                 $blogs[0] = $blogs[1];
    //                 $blogs[1] = $first;
    //             }
    //         }

    //         Cache::put($cache_key, $blogs, 60);
    //     }

    //     $blogTags = [
    //         'workouts',
    //         'motivation',
    //         'nutrition',
    //         'wellness',
    //         'recipes',
    //         'women'
    //     ];

    //     $trendingNowPath = [
    //         '3-reasons-you-re-not-shredded',
    //         '10-ways-to-cut-calories-without-noticing',
    //         'post-workout-beauty-tips',
    //         '5-strength-training-mistakes-that-are-holding-you-back',
    //         'chicken-butterflying-your-chicken-breast'
    //     ];

    //     return view('pages.blog', ['blogs' => $blogs, 'category' => $category, 'blogTags' => $blogTags, 'trendingNowPath' => $trendingNowPath]);
    // }

    public function focus(Request $request){
        $queryString = $request->query('type');
        return view('pages.focus.focuspill', compact('queryString'));
    }

    public function freeEbook(){
        return view('pages.landing.free-ebook');
    }

    public function fitclubSignup(){
        if(!Auth::check()){
            return view('pages.fitclub.signup');
        } else{
            return redirect()->route('fitclub');
        }
    }

    public function mealPlan(Request $request){
        $queryString = $request->query('gender');
        return view('pages.meal-plan', compact('queryString'));
    }

    public function coaching()
    {
        return view('pages.coaching');
    }

    public function article()
    {
        return view('pages.article');
    }

    public function help()
    {
        return view('pages.help');
    }

    public function store()
    {
        return view('pages.store');
    }

    public function careers()
    {
        return $this->RenderPage();
    }

    public function dosage()
    {
        return view('pages.dosage');
    }

    public function distribution()
    {
        return view('pages.distribution');
    }

    public function wholesale()
    {
        return view('pages.wholesale');
    }

    public function terms()
    {
        return $this->RenderPage();
    }

    public function return_page()
    {
        return $this->RenderPage();
    }

    public function privacy()
    {
        return $this->RenderPage();
    }

    public function vip()
    {
        return view('pages.vip');
    }

    public function products($id)
    {
        $transformations = PageModel::whereHas('assets', function ($query) {
           $query->where('assetables.relation_type_name', 'primary_image');
        })
        ->with([
        'tags',
        'meta',
        'assets' => function($query){
            $query->wherePivot('relation_type_name', 'primary_image');
        }])
        ->published()
        ->ofType(5)
        ->latest()
        ->get();

        $femaleImages = [];
        $maleImages = [];

        $transformations->each(function ($transformation) use (&$femaleImages, &$maleImages) {
            $gender = null;
            $transformation->tags->each(function ($tag) use (&$gender) {
               if (in_array($tag->key, ['women', 'men'])) {
                   $gender = $tag->key;
                   return false;
               }
            });

            if ($transformation->assets->count()) {
               if ($gender == 'men') {
                   $maleImages[] = $transformation->assets[0]->path;
               } elseif ($gender == 'women') {
                   $femaleImages[] = $transformation->assets[0]->path;
               }
            }
        });
        $product = \FitlifeGroup\Models\Eloquent\Product::where('slug', $id)->first();
        if ($product && filter_var($id, FILTER_VALIDATE_INT) === false) {
            $cache_key = 'chat_' . $this->attribution->getCustom();

            $chatScript = Cache::remember($cache_key, 60, function() {
                $s3 = Storage::disk('shredz-site');
                $domain = strtoupper($this->attribution->getDomain());
                $subdomain = strtoupper($this->attribution->getSubdomain());
                $chatScript = '';

                $path = $domain.'/injectables/';
                $pref = 'chat_';
                $ext = '.html';
                $paths[] = $path.$pref.$subdomain.$ext;
                $paths[] = $path.$pref.$ext;
                $paths[] = 'GENERIC/injectables/'.$pref.$ext;

                foreach ($paths as $path) {
                    if ($s3->has($path)) {
                        $chatScript = $s3->get($path);
                        break;
                    }
                }

                return $chatScript;
            });

            if ($product->external_url) {
                return redirect()->to($product->external_url, 301);
            }

            return view('pages.products', compact('id', 'chatScript', 'femaleImages', 'maleImages'));
        } else if($product =  \FitlifeGroup\Models\Eloquent\Product::where('id', $id)->first()) {
            return redirect()->route('products', [$id => $product->slug], 301);
        }
        return redirect()->route('shop',[], 301);
    }

    public function newproduct()
    {
        return view('pages.newproduct');
    }

    public function thanks($callback)
    {
        return view('pages.thanks', ['callback' => $callback]);
    }

    public function createAccount()
    {
        return view('pages.createAccount');
    }

    public function checkout()
    {
        return view('pages.checkout');
    }

    public function checkoutAddress()
    {
        return view('pages.checkoutAddress');
    }

    public function checkoutReview()
    {
        return view('pages.checkoutReview');
    }

    public function paypalSuccess()
    {
        return view('pages.paypalSuccess');
    }

    public function paypalError()
    {
        return view('pages.paypalError');
    }

    public function ceoMessage()
    {
        return view('pages.ceoMessage');
    }

    public function companyProfile()
    {
        return view('pages.companyProfile');
    }

    public function athleteList()
    {
        $psgr = new \App\Tools\Pages\Page();
        $athletes = $psgr->getAthletes();
        $mathletes = $psgr->getAthletes('male');
        $fathletes = $psgr->getAthletes('female');

        $pickRange = range(0, count($mathletes) - 1);
        shuffle($pickRange);

        $mchosen = '';
        $mother = [];
        $i = 0;

        foreach ($mathletes as $key => $value) {
            if ($i == 0) {
                $mchosen = $key;
            } else {
                array_push($mother, $key);
            }
            ++$i;
        }

        $pickRange = range(0, count($fathletes) - 1);
        shuffle($pickRange);

        $fchosen = '';
        $fother = [];
        $i = 0;

        foreach ($fathletes as $key => $value) {
            if ($i == 0) {
                $fchosen = $key;
            } else {
                array_push($fother, $key);
            }
            ++$i;
        }

        $content = [
            'athletes' => $athletes,
            'males' => $mathletes,
            'females' => $fathletes,
            'featured-male' => $mchosen,
            'paige-hathaway' => 'paige-hathaway',
            'joey-swoll' => 'joey-swoll',
            'other-males' => $mother,
            'featured-female' => $fchosen,
            'other-females' => $fother,
            'persons' => 'ALL ATHLETES',
            'url-pre' => '/athletes',
        ];

        return view('pages.athletes', ['content' => $content]);
    }

    public function ambassadorList()
    {
        $psgr = new \App\Tools\Pages\Page();
        $fathletes = $psgr->getAmbassadors();

        $pickRange = range(0, count($fathletes) - 1);
        shuffle($pickRange);

        $fchosen = [];
        $fother = [];
        $i = 0;

        foreach ($fathletes as $key => $value) {
            if ($i == $pickRange[0] || $i == $pickRange[1]) {
                array_push($fchosen, $key);
            } else {
                array_push($fother, $key);
            }
            ++$i;
        }

        $content = [
            'females' => $fathletes,
            'featured-female' => $fchosen[0],
            'other-females' => $fother,
            'males' => $fathletes,
            'featured-male' => $fchosen[1],
            'other-males' => $fother,//not used
            'persons' => 'ALL AMBASSADORS',
            'url-pre' => '/ambassadors',
        ];

        return view('pages.ambassadors', ['content' => $content]);
    }

    public function athleteDetail($name)
    {
        $page = new \App\Tools\Pages\Page();
        $content = $page->getAthlete($name);

        $others = $page->getAthletes();
        $found = false;
        $i = 0;

        foreach ($others as $key => $value) {
            if ($key != $name) {
                $content['other-'.$i] = $key;
                $content['thumb-'.$i] = $others[$key]['thumbnail'];
                ++$i;
            } else {
                $found = true;
            }
        }

        if (!$found) {
            return \App::abort(404);
        }

        $content['back-url'] = '/athletes';
        $content['subject'] = 'ATHLETES';

        return view('pages.athleteDetail', ['content' => $content]);

    }

    public function ambassadorDetail($name)
    {
        $page = new \App\Tools\Pages\Page();
        $content = $page->getAmbassador($name);

        $others = $page->getAmbassadors();

        $i = 0;

        foreach ($others as $key => $value) {
            if (strcmp($others[$key]['name'], $name) != 0) {
                $content['other-'.$i] = $key;
                $content['thumb-'.$i] = $others[$key]['thumbnail'];
                ++$i;
            }
        }

        $content['back-url'] = '/ambassador-list';
        $content['subject'] = 'AMBASSADORS';

        return view('pages.athleteDetail', ['content' => $content]);
    }

    public function vipArea()
    {
        return view('pages.vipNotSignedUp');
    }

    public function executiveTeam()
    {
        return view('pages.executiveTeam');
    }

    public function vipPreview(Request $request)
    {

        $category = $request->input('category');
        $cached = ($request->input('cached', 'true') === 'true');

        return view('pages.vipPreview', ['category' => $category]);
    }

    public function vipVideos($slug){
        return view("pages.videopage", ['slug' => $slug]);
    }



    function uploadImage(Request $request){
        $currentUser = Auth::user()->profile()->first();

        $file = $request->file('profileimage');
        $fileName = $this->fileName($file);
        // Instantiate an Amazon S3 client.
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => env('FILESYSTEM_S3_REGION'),
            'credentials' => [
                'key'    => env('FILESYSTEM_S3_KEY'),
                'secret' => env('FILESYSTEM_S3_SECRET'),
            ],
        ]);

        $tmpDir = storage_path().'/tmp/';
        $tmpFile = $tmpDir.$fileName;

        $file->move($tmpDir, $fileName);

        $s3FileKey = 'fitclub-members/' . $fileName;
        $result = $this->upload($s3, $s3FileKey, $tmpFile);
        if($result['@metadata']['statusCode'] == 200){
            $imageUrl = $result['@metadata']['effectiveUri'];
            $currentUser->avatar = $imageUrl;
            $currentUser->save();
            File::delete($tmpFile);
        }
    }

    private function upload($s3, $s3_file_key, $file_path){
        try {
            return $s3->putObject([
                'Bucket' => 'shredz-com-v2',
                'Key'    => $s3_file_key,
                'ACL'    => 'public-read',
                'Body'   =>  fopen($file_path, 'r')
            ]);
        } catch (Aws\Exception\S3Exception $e) {
            return ['@metadata' => ['statusCode' => 0], 'error' => "There was an error uploading the file."];
        }
    }

    /**
     * Hash profile image file name
     * @param Symfony\Component\HttpFoundation\File\UploadedFile
     */
    private function fileName($file)
    {
        $name = sha1($file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();
        return "{$name}.{$extension}";
    }

    public function fitclubMember($name){
        $image = Auth::user()->profile()->first()->avatar;
        $userImage = $image;
        return view("pages.fitclub-member", compact('userImage'));
    }

    // public function vipPreview()
    // {
    //     $pages = PageModel::with([
    //         'tags',
    //         'assets'=>function($q) {
    //                 $q->wherePivot('relation_type_name', 'primary_video');
    //         }])
    //         ->isPublished()
    //         ->SortedByPublished()
    //         ->PageTypeId(2) // Public
    //         ->get()
    //         ->each(function ($page) {
    //             PageComponent::transform($page);
    //         });

    //     return view('pages.vipPreview', ['pages' => $pages->toArray()]);
    // }

    public function Page($slug)
    {
        return $this->RenderPage();
    }

    public function RenderPage()
    {
        $template = 'pages.' . $this->page['template'];

        if ($this->page) {
            return view()->exists($template) ? view($template) : view('pages.page');
        }
        // So the correct error handler will be called.
        return \App::abort(404);
    }

    public function page1()
    {
        return view("pages.wholesale");
    }

    public function page2()
    {
        return view("pages.wholesalethank");
    }
}
