<?php
namespace App\Http\Middleware;

use App\Tools\Geo\GeoIp;
use Carbon\Carbon;
use Closure;
use DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class TrackUserPageViews
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth, Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $this->request->path();
        // $url = $this->request->url();
        $url = $this->request->fullUrl();
        $method = $this->request->method();
        $path_blacklist = ['auth/token'];

        if ($this->auth->check() && !in_array($path, $path_blacklist)) {
            $geoip = new GeoIp();

            $sid = $this->request->session()->getId();
            $customer_id = $this->auth->user()->id;
            $user_agent = (array_key_exists('HTTP_USER_AGENT', $_SERVER)) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
            $ip = $geoip->getIp();

            $log_data = [
                'sid' => $sid,
                'customer_id' => $customer_id,
                'ip' => $ip,
                'path' => $path,
                'url' => $url,
                'method' => $method,
                'user_agent' => $user_agent,
                'created_at' => Carbon::now(),
            ];

            DB::table('customer_pageviews')->insert($log_data); // should queue it to not delay response

        }

        return $next($request);
    }
}
