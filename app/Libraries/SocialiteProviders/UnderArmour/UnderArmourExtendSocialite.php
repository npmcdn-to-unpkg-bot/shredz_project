<?php

namespace App\Libraries\SocialiteProviders\UnderArmour;

use SocialiteProviders\Manager\SocialiteWasCalled;

class UnderArmourExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('underarmour', __NAMESPACE__.'\UnderArmour');
    }
}