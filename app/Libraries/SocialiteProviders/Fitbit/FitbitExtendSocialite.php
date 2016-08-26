<?php

namespace App\Libraries\SocialiteProviders\Fitbit;

use SocialiteProviders\Manager\SocialiteWasCalled;

class FitbitExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('fitbit', __NAMESPACE__.'\Fitbit');
    }
}