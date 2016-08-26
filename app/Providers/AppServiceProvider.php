<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Tools\ThemeManager;
use App\Tools\ShredzAPI;
use App\Tools\ChannelAttribution;
use App\Tools\Store;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $request = $this->app->make(Request::class);
        $referer = $request->server('HTTP_HOST');
        //
        $this->app->singleton(ThemeManager::class);
        $this->app->singleton(ShredzAPI::class, function ($app) use ($referer){
            $instance = new ShredzAPI;
            $instance->setReferer($referer);
            if (Auth::check()) {
                $instance->setUser(Auth::user()->payer_email);
            }

            return $instance;
        });
        $this->app->singleton(ChannelAttribution::class, function ($app) use ($referer) {
            return new ChannelAttribution($referer);
        });
    }
}
