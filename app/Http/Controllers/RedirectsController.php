<?php

namespace App\Http\Controllers;

class RedirectsController extends BaseController
{
    public function homeToShop()
    {
        return redirect()->route('shop');
    }

    public function oldV2ProductPage($product_id)
    {
        return redirect()->route('products', [$product_id]);
    }

    public function docsTerms()
    {
        return redirect()->route('termsAndConditions');
    }

    public function docsReturnPolicy()
    {
        return redirect()->route('returnPolicy');
    }

    public function docsPrivacyPolicy()
    {
        return redirect()->route('privacyPolicy');
    }

    public static function maintainOldLinks($request)
    {
        $redirects = [
            'product/deal-day-30-day-weight-loss-plan-max-supplements-shredz-alpha-tank-drawstring-bag-shaker-cup' => '/products/dotd-30-day-quick-weight-loss-plan-for-women-plus-supplements-plus-free-gift-max',
            'product/deal-day-30-day-weight-loss-plan-men-max-supplements-shredz-gym-tee-duffle-bag-shaker-cup' => '/products/dotd-30-day-quick-weight-loss-plan-for-men-plus-supplement-free-gift-max',
            'product/30-day-shredz-weight-loss-challenge-women' => '/products/30-day-quick-weight-loss-plan-supplements-for-women-m',
            'product/30-day-weight-loss-plan-supplements-men' => '/products/30-day-quick-weight-loss-plan-supplements-for-men-free-testosterone',
            'product/30-day-weight-loss-plan-vol-20-supplements-women' => '/products/30-day-quick-weight-loss-plan-supplements-for-women-m2',
            'product/30-day-weight-loss-plan-vol-20-supplements-men' => '/products/30-day-quick-weight-loss-plan-free-testosterone-supplements-for-men-level-2',
            'product/alpha-female-weight-loss-supplements' => '/products/alpha-female-plan-plus-supplements-for-her',
            'product/accelerated-alpha-female-plan-supplements-30-day-squat-challenge-free-tank' => '/products/alpha-female-plan-plus-supplements-for-her',
            'product/alpha-male-stack-all-in-one-solution-for-men' => '/products/alpha-male-plan-supplements-for-him',
            'product/shape-tone-plan-supplements' => '/products/shape-and-tone-plan-plus-supplements-for-her',
            'product/bikini-edition-sexy-lean-plan-supplements' => '/products/sexy-and-lean-plan-plus-supplements-for-her',
            'product/six-pack-stack-quick-weightloss-for-men' => '/products/6-pack-plan-for-him-supplements',
            'product/sexy-beautiful-stack-for-women' => '/products/sexy-beautiful-stack-for-her-burner-detox-beauty',
            'product/4-pack-ebook-bundle-thermogenic-protein' => '/products/4-pack-ebook-bundle-plus-thermogenic-protein',
            'product/30-recipes-300-calories' => '/products/30-recipes-under-300-calories',
            'product/30-recipes-300-calories-weight-loss-smoothies' => '/products/30-recipes-under-300-calories-plus-weight-loss-smoothies',
            'product/4-pack-ebook-bundle-recipe-books' => '/products/4-pack-ebook-bundle-recipe-books',
            'product/shredz-pink-leggings-sports-bra' => '/products/shredz-pink-leggings-sports-bras',
            'product/shredz-pink-leggings-sports-bras' => '/products/shredz-red-leggings-sports-bras',
            'product/shredz-thermogenic-protein-made-for-women-2lb-2' => '/products/shredz-thermogenic-protein-made-for-women-blueberry-2lb',
            'product/fat-loss-blue-print-free-slim-waist-butt-sculpting-program' => '/products/fat-loss-blue-print-free-slim-waist-and-butt-sculpting-program',
            'product/6pack-blueprint-dieting-nutrition-wfree-6pack-workout-guide' => '/products/six-pack-blueprint-for-men-english',
            'product/joey-swoll-train-harder-volume-1' => '/products/joey-swoll-train-harder-than-me-volume-1',
            'product/devin-physiques-formula-abs' => '/products/devin-physiques-formula-for-abs',
            'product/ifbb-pro-tristen-escos-gains-guide' => '/products/ifbb-pro-tristen-esos-gains-guide',
            'product/alex-michael-turners-guide-aesthetics' => '/products/alex-michael-turners-guide-to-aesthetics',
            'product/shredz-burner-max' => '/products/core-burner-max',
            'product/shredz-burner-max-women' => '/products/shredz-burner-max-made-for-women',
            'product/shredz-fat-burner-made-for-women' => '/products/shredz-burner-for-women',
            'product/shredz-bcaaglutamine-building-recovery-complex-fruit-punch-women' => '/products/shredz-bcaaglutamine-fruit-punch-women',
            'product/detox-women' => '/products/shredz-detox-for-women',
            'product/toner' => '/products/shredz-toner-for-women',
            'product/shredz-rebuildpm-women' => '/products/shredz-rebuild-pm-for-women',
            'product/beauty' => '/products/shredz-beauty-for-women',
            'product/shredz-protein-performance-blend' => '/products/shredz-protein-2lb',
            'product/shredz-protein-2lb' => '/products/shredz-protein-2lb',
            'product/shredz-protein-1lb' => '/products/shredz-protein-1lb',
            'product/shredz-fat-burner' => '/products/shredz-burner',
            'product/shredz-bcaaglutamine-building-recovery-complex-fruit-punch-men' => '/products/shredz-bcaa-glutamine-fruit-punch-men',
            'product/shredz-creatine' => '/products/shredz-creatine',
            'product/shredz-detox' => '/products/shredz-detox',
            'product/shredz-rebuildpm' => '/products/shredz-rebuild-pm',
            'product/shredz-testosterone-2' => '/products/shredz-testosterone',
            'product/shredz-preworkout-performance' => '/products/shredz-preworkout-mango',
            'product/shredz-shaker' => '/products/shredz-shaker',
            'product/neon-red-sports-bra-shredzarmy-camo-red-leggings' => '/products/shredzarmy-rocket-red-sports-bra-leggings',
            'product/neon-pink-sports-bra-shredzarmy-camo-pink-leggings' => '/products/shredzarmy-ultra-pink-sports-bra-leggings',
            'product/shredz-neon-red-sports-bra' => '/products/shredz-rocket-red-sports-bra',
            'product/shredz-rocket-red-shorts' => '/products/shredz-rocket-red-shorts',
            'product/shredz-neon-pink-sports-bra' => '/products/shredz-ultra-pink-sports-bra',
            'product/shredz-ultra-pink-shorts' => '/products/shredz-ultra-pink-shorts',
            'product/shredz-female-crop-hoodie-whitepink' => '/products/shredz-female-crop-hoodie-white-pink',
            'product/shredz-female-crop-hoodie-blackred' => '/products/shredz-female-crop-hoodie-black-red',
            'product/black-alpha-male-stringer' => '/products/alpha-male-stringer-black-red',
            'product/white-alpha-male-stringer' => '/products/alpha-male-stringer-white-black',
            'product/alpha-female-neon-pink-hand-printed-tanktop' => '/products/alpha-female-neon-pink-hand-printed-tanktop',
            'product/alpha-female-neon-yellow-hand-printed-tanktop' => '/products/alpha-female-neon-yellow-hand-printed-tanktop',
            'product/alpha-female-neon-green-hand-printed-tanktop' => '/products/alpha-female-neon-green-hand-printed-tanktop',
            'product/alpha-female-black-gold-tanktop' => '/products/alpha-female-black-and-gold-tanktop',
            'product/shredz-dumbbell-fashion-bracelet-red' => '/products/shredz-dumbbell-fashion-bracelet-red',

            'military-discounts' => '/',
            'featured/joey-swoll' => '/athletes/joey-swoll',
            'featured/paige-hathaway' => '/athletes/paige-hathaway',
            'featured/devin-physique' => '/athletes/devin-zimmerman',
            'featured/ainsley-rodriguez' => '/athletes/ainsley-rodriguez',
            'featured/tristen-esco' => '/athletes/tristen-escolastico',
            'featured/jessica-arevalo' => '/athletes/jessica-arevalo',
            'featured/jonathan-coyle' => '/athletes/jonathan-coyle',
            'featured/nikki-leonard' => '/athletes/nikki-leonard',
            'featured/alex-turner' => '/athletes/alex-turner',
            'featured/brittany-coutu' => '/athletes/brittany-coutu',
            'featured/brandon-michael' => '/athletes/brandon-lomeo',
            'featured/chris-white' => '/athletes/chris-white',

            'featured_item_category/athletes' => 'http://shredz2.foo/athletes',
            'submit' => 'http://shredztransformations.com',
            'challenge' => 'http://shredztransformations.com',
            'transformations' => 'http://shredztransformations.com',
            'transformation' => 'http://shredztransformations.com',
            'tracking-support' => 'http://shredzsupport.com',
            'usa-tour' => 'http://tour.shredz.com',
            'tour' => 'http://tour.shredz.com',
            'shredz-ambassadors' => 'ambassadors',

            'product-reviews' => 'results',
            'female-transformations' => 'results',
            'male-transformations' => 'results',

            'shredz-30-day-weight-loss-challange-official-rules' => 'shredz-30-day-weight-loss-challenge-official-rules',
            'dosage-chart' => 'help',

        ];

        if (isset($redirects[$request->path()])) {
            return redirect($redirects[$request->path()]);
        }
        return false;

    }
    public static function redirectDomain()
    {
        $domain = \Request::root();

        $redirects = [
            'shredzfashion.com'  => 'http://fashion.shredz.com',
            'shredzdiet.com'     => 'http://diet.shredz.com',
            'shredzkitchen.com'  => 'http://kitchen.shredz.com',
            'shredzarmy.com'     => 'http://army.shredz.com',
            'shredzwomen.com'    => 'http://women.shredz.com',
            'shredzforwomen.com' => 'http://forwomen.shredz.com',
        ];
        foreach ($redirects as $key => $to) {
            if (stristr($domain, $key)) {
                return \Redirect::to($to, 301);
            }
        }
        return \App::abort(404);

    }
}
