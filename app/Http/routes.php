<?php


// Password reset link request routes...
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
//Authentication routes
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
//Oauth2 Authentication Routes
Route::get('oauth2/{provider}/authorize/{code}', 'Auth\AuthController@redirectToProvider');
Route::get('oauth2/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('oauth2/redirect/{identity}', 'Auth\AuthController@oauthSubdomainRedirect');
Route::post('oauth2/oauthcredentials', 'Auth\AuthController@verifyOauthCredentials');
//Registration Routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
//Email verification routes
Route::get('email/verify/{token}', 'Auth\AuthController@getVerifyEmail');
Route::post('email/sendverify', 'Auth\AuthController@resendVerifyEmail');
Route::post('email/sendverifyloggedin', 'Auth\AuthController@resendVerifyEmailWhenLogggedIn');

Route::pattern('is_redirect_domain', '(shredzfashion.com|shredzdiet.com|shredzkitchen.com|shredzarmy.com|shredzwomen.com|shredzforwomen.com)');

Route::group(['domain' => '{is_redirect_domain}'], function () {
    Route::get('/', [
        'as' => 'home',
        'uses' => 'RedirectsController@redirectDomain']
    );
});

Route::get('/', [
    'as' => 'home_v1',
    'uses' => 'v1\pages\PageController@home_v1']
);

// Route::get('/home', [
//     'as' => 'home',
//     'uses' => 'v1\pages\PageController@home']
// );
Route::post('/upload-image', [
    'as' => 'home',
    'uses' => 'v1\pages\PageController@uploadImage'
]);        

Route::get('/home', [
    'as' => 'home',
    'uses' => 'v1\pages\PageController@home']
);

Route::get('user/verify/{token}', [
    'as' => 'user verification link',
    'uses' => 'v1\auth\RegistrationController@confirm'
]);

Route::get('/cart', [
    'as' => 'cart',
    'uses' => 'v1\pages\PageController@cart'
]);

Route::get('/about', [
    'as' => 'about',
    'uses' => 'v1\pages\PageController@about'
]);

Route::get('/blog', [
    'as' => 'blog',
    'uses' => 'v1\pages\PageController@blog'
]);

Route::get('/focus-enhance-your-mind', [
    'as' => 'focus-enhance-your-mind',
    'uses' => 'v1\pages\PageController@focus'
]);

Route::get('/free-ebook', [
    'as' => 'free-ebook',
    'uses' => 'v1\pages\PageController@freeEbook'
]);

Route::get('/fitclub-signup', [
    'as' => 'fitclub-signup',
    'uses' => 'v1\pages\PageController@fitclubSignup'
]);

Route::get('/meal-plan', [
    'as' => 'meal-plan',
    'uses' => 'v1\pages\PageController@mealPlan'
]);

Route::get('/coaching', [
    'as' => 'coaching',
    'uses' => 'v1\pages\PageController@coaching'
]);

// Route::post('blog/subscribe', function(Request $request){
//     $email = $request->json('email');
//     dd($email);
// });

Route::get('/help', [
    'as' => 'help',
    'uses' => 'v1\pages\PageController@help'
]);

Route::get('/shop', [
    'as' => 'shop',
    'uses' => 'v1\pages\PageController@store'
]);

Route::get('/results', [
    'as' => 'results',
    'uses' => 'v1\pages\PageController@getResults',
]);

Route::get('/invite', [
    'as' => 'invite',
    'uses' => 'v1\pages\PageController@invite',
]);

Route::get('about/careers', [
    'as' => 'careers',
    'uses' => 'v1\pages\PageController@careers',
]);

Route::get('/terms-and-conditions', [
    'as' => 'termsAndConditions',
    'uses' => 'v1\pages\PageController@terms'
]);

Route::get('shop/return-policy', [
    'as' => 'returnPolicy',
    'uses' => 'v1\pages\PageController@return_page'
]);

Route::get('/privacy-policy', [
    'as' => 'privacyPolicy',
    'uses' => 'v1\pages\PageController@privacy'
]);

Route::get('/vip', [
    'as' => 'vip',
    'uses' => 'v1\pages\PageController@vip'
]);

Route::get('/products/{id}', [
    'as' => 'products',
    'uses' => 'v1\pages\PageController@products'
]);

Route::get('/fitclub', [
    'as' => 'fitclub',
    'uses' => 'v1\pages\PageController@vipPreview'
]);

Route::get('/fitclub/{slug}', [
    'as' => 'fitclub videos',
    'uses' => 'v1\pages\PageController@vipVideos'
]);

// Route::get('/30-day-supplement-workout-plan', [
//     'as' => '30-day-supplement-workout-plan',
//     'uses' => 'v1\pages\PageController@newproduct'
// ]);

Route::get('/createAccount', [
    'as' => 'createAccount',
    'uses' => 'v1\pages\PageController@createAccount'
]);

Route::get('/checkoutReview', [
    'as' => 'checkoutReview',
    'uses' => 'v1\pages\PageController@checkoutReview'
]);

Route::group(['prefix' => 'auth'], function () {
    Route::post('user', [
        'as' => 'Register User',
        'uses' => 'v1\auth\RegistrationController@store',
    ]);

    Route::get('token', [
        'as' => 'Register User',
        'uses' => 'DataController@generateTokenAjax',
    ]);
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('settings', [
        'as' => 'User Settings',
        'uses' => 'v1\pages\PageController@settings',
    ]);

    Route::get('settings/payments', [
        'as' => 'User Settings',
        'uses' => 'v1\pages\PageController@paymentProfiles',
    ]);

    Route::get('settings/payments/add', [
        'as' => 'User Settings',
        'uses' => 'v1\pages\PageController@addPaymentMethod',
    ]);

    //create credit card
    Route::post('settings/payments/{id}/ccnumber', [
        'as' => 'create_cc', 
        'uses' => 'v1\PaymentProfileController@store'
    ]);

    Route::get('settings/addresses', [
        'as' => 'Customer Shipping Addresses',
        'uses' => 'v1\pages\PageController@shippingAddresses',
    ]);

    Route::get('settings/addresses/add', [
        'as' => 'User Settings',
        'uses' => 'v1\pages\PageController@addShippingAddress',
    ]);

    Route::get('settings/addresses/{uid}/edit', [
        'as' => 'User Settings',
        'uses' => 'v1\pages\PageController@editShippingAddress',
    ]);

    Route::get('settings-subscriptions', [
        'as' => 'User Subscriptions',
        'uses' => 'v1\pages\PageController@settingsSubs',
    ]);

    Route::get('settings-orders', [
        'as' => 'User Orders',
        'uses' => 'v1\pages\PageController@settingsOrders',
    ]);

    Route::post('user/settings', [
        'as' => 'Edit users information',
        'uses' => 'v1\ajax\UserController@editUser',
    ]);

    Route::get('user/subscriptions/ajax', [
        'as' => 'Redirect user subscription',
        'uses' => 'DataController@dataCheckUsersSubscription',
    ]);

    Route::delete('user/subscription', [
        'as' => 'Delete users subscription',
        'uses' => 'DataController@cancelUsersSubscription',
    ]);

    Route::get('user', [
        'as' => 'Get currently logged in user',
        'uses' => 'v1\ajax\UserController@getUser',
    ]);

    Route::post('user/image', [
        'as' => 'Edit a user\'s image',
        'uses' => 'v1\ajax\UserController@update_image',
    ]);

    Route::get('/fitclub-member/{name}', [
        'as' => 'Fitclub Member',
        'uses' => 'v1\pages\PageController@fitclubMember'
    ]);
    
    // auth ajax
    Route::group(['prefix' => 'ajax/v1'], function () {

        Route::get('user/orders', [
            'as' => 'get Order list',
            'uses' => 'DataController@listUsersOrders',
        ]);

        Route::get('user/orders/{id}', [
            'as' => 'Get order details',
            'uses' => 'DataController@orderDetails'
        ]);

    });
});

Route::get('user/membership', [
    'as' => 'Redirect user subscription',
    'uses' => 'DataController@redirectUsersSubscription'
]);

Route::post('support_ticket', [
    'as' => 'Create a support ticker',
    'uses' => 'v1\EmailController@sendEmail'
]);

Route::post('subscription_email', [
    'as' => 'Add email to subscription email',
    'uses' => 'v1\SubscriptionsController@store'
]);


Route::post('checkout/payment/submit', [
    'as' => 'Submit payment to Shredz API',
    'uses' => 'DataController@submitPayment'
]);

/*paypal related*/
Route::get('/paypal-success', [
    'as' => 'Paypal on sucess',
    'uses' => 'v1\pages\PageController@paypalSuccess'
]);

Route::get('/paypal-error', [
    'as' => 'Paypal on sucess',
    'uses' => 'v1\pages\PageController@paypalError'
]);

Route::get('about/ceo-message', [
    'as' => 'CEO Message',
    'uses' => 'v1\pages\PageController@ceoMessage'
]);

Route::get('/athletes', [
    'as' => 'Athlete List',
    'uses' => 'v1\pages\PageController@athleteList'
]);

Route::get('/ambassadors', [
    'as' => 'Ambassador List',
    'uses' => 'v1\pages\PageController@ambassadorList'
]);

Route::get('/athletes/{name}', [
    'as' => 'Athlete Detail',
    'uses' => 'v1\pages\PageController@athleteDetail'
]);

Route::get('/ambassadors/{name}', [
    'as' => 'Ambassador Detail',
    'uses' => 'v1\pages\PageController@ambassadorDetail'
]);

Route::get('/vip-area', [
    'as' => 'VIP page',
    'uses' => 'v1\pages\PageController@vipArea'
]);

// ===============================================
// REDIRECTS =====================================
// ===============================================

Route::get('/v2/products/{id}', [
    'as' => 'RedirectOldV2ProductPage',
    'uses' => 'RedirectsController@oldV2ProductPage'
]);

Route::get('/docs/terms-and-conditions', [
    'as' => 'RedirectDocsTerms',
    'uses' => 'RedirectsController@docsTerms'
]);

Route::get('/docs/return-policy', [
    'as' => 'RedirectDocsReturnPolicy',
    'uses' => 'RedirectsController@docsReturnPolicy'
]);

Route::get('/docs/privacy-policy', [
    'as' => 'RedirectDocsPrivacyPolicy',
    'uses' => 'RedirectsController@docsPrivacyPolicy'
]);

// Redirect http://staging.shredzsandbox.com/customers/orders/***/***
// to http://getshredz.com/customers/orders/***/***
Route::get('/customers/orders/{txn_id}/{action}', function ($txn_id, $action) {
    return redirect('http://getshredz.com/customers/orders/' . $txn_id . '/' . $action);
});

Route::get('/fl/page1', [
    'as' => 'page1.santosh',
    'uses' => 'v1\pages\PageController@page1'
]);

Route::get('/fl/page2', [
    'as' => 'page2.santosh',
    'uses' => 'v1\pages\PageController@page2'
]);

Route::get('/fl/dashboard', [
    'as' => 'page3.dashboard',
    'uses' => 'v1\pages\PageController@page3'
]);

// THIS HAS TO BE THE LAST ROUTE IN THE FILE!
Route::any('{slug?}', [
    'as' => 'Page',
    'uses' => 'v1\pages\PageController@page'
])->where('slug', '.*');