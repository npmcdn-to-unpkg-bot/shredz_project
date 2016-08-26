<?php

namespace App\Http\Middleware;

use App\Tools\Geo\GeoIp;
use Carbon\Carbon;
use Closure;
use DB;
use Illuminate\Contracts\Auth\Guard;
use Log;
use Session;

class RedirectIfEurope
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('clear_session') == 1) {
            Session::forget('ip_detected');
        }
        // We only want to do this once per session.
        if (!Session::has('ip_detected')) {
            Session::push('ip_detected', '1');

            $geoip = new GeoIp();
            $geoip_data = $geoip->getData();

            $user_agent = (array_key_exists('HTTP_USER_AGENT', $_SERVER)) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
            $ignore_user_agents = [
                'Cyfe',
                'ELB-HealthChecker/1.0'
            ];

            $ip = $geoip->getIp();
            $ip_integer = $geoip->getIpInteger();
            $continent_code = (is_array($geoip_data) && array_key_exists('continent_code', $geoip_data)) ? $geoip_data['continent_code'] : NULL;
            $country_code = (is_array($geoip_data) && array_key_exists('country_code', $geoip_data)) ? $geoip_data['country_code'] : NULL;
            $geoname_id = (is_array($geoip_data) && array_key_exists('geoname_id', $geoip_data)) ? $geoip_data['geoname_id'] : NULL;

            $landing_page = (array_key_exists('HTTP_HOST', $_SERVER)) ? "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] : '';
            $log_data = [
                'ip' => $ip,
                'ip_integer' => $ip_integer,
                'continent_code' => $continent_code,
                'landing_page' => $landing_page,
                'geoname_id' => $geoname_id,
                'user_agent' => $user_agent,
                'created_at' => Carbon::now(),
            ];

            if (! in_array($user_agent, $ignore_user_agents)) {

                $redirect_to = false;
                if ($continent_code == 'EU') {
                    $redirect_to = 'http://shredzarmy.eu?redirect_from=' . $request->url();
                }
                // elseif ($country_code == 'BR') {
                //     $redirect_to = 'http://shredz.com.br?redirect_from=' . $request->url();
                // }

                if ($redirect_to) {
                    // Log::info("IP: " . $ip . " / " . $ip_integer . " (" . $continent_code . ") (" . $country_code. ")");
                    $log_data['redirected_to'] = $redirect_to;
                    DB::table('visitor_ip_log')->insert($log_data); // should queue it
                    return redirect($redirect_to);
                }
                DB::table('visitor_ip_log')->insert($log_data); // should queue it to not delay response
            }
        }

        return $next($request);
    }
}
