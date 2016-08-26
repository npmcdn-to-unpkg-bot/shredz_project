<?php

namespace App\Http\Middleware;

use DB;
use Closure;

class RedirectDomain
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
        $redirects = DB::table('route_rules')->where('active', 1)->get();
        //19 and 15
        $path = $request->fullUrl();
        $pathBreakDown = $this->returnPath($path);
            if($pathBreakDown){
                $buildPath = $pathBreakDown[1];
                $buildPathArray = [];
                //does subdomain exitst
                $dbSubdomain = DB::table('route_rules')->where('subdomain', str_replace('.', '', $pathBreakDown[5]))->get();
                //does domain exists
                $dbDomain = DB::table('route_rules')->where('domain', $pathBreakDown[7])->get();
                //does path exists
                if(isset($pathBreakDown[11])){
                    $dbPath = DB::table('route_rules')->where('path', $pathBreakDown[11])->get();
                }

                if($pathBreakDown[5]){//incoming url has domain
                    if(count($dbDomain)){
                        if(!count($dbSubdomain)){
                            $buildPath.= '{subdomain}.'.$pathBreakDown[7];
                            $buildPathArray['subdomain'] = '{subdomain}';
                            $buildPathArray['domain'] = $pathBreakDown[7];
                         }else{
                            $hasDomain = false;
                            foreach ($dbSubdomain as $value) {
                                if($value->domain == $pathBreakDown[7]){
                                    $hasDomain = true;
                                }
                            }
                            if($hasDomain){
                                $buildPath.= $pathBreakDown[5].$pathBreakDown[7];
                                $buildPathArray['subdomain'] = $pathBreakDown[5];
                                $buildPathArray['domain'] = $pathBreakDown[7];
                            }else{
                                $buildPath.= '{subdomain}'.$pathBreakDown[7];
                                $buildPathArray['subdomain'] = '{subdomain}';
                                $buildPathArray['domain'] = $pathBreakDown[7];
                            }
                            //now we have domains and we have subdomains that matches
                        }
                    }else{
                        if(count($dbSubdomain)){
                            $buildPath.= $pathBreakDown[5].'{domain.com}';
                            $buildPathArray['subdomain'] = $pathBreakDown[5];
                            $buildPathArray['domain'] = '{domain.com}';
                        }else{
                            $buildPath.= '{subdomain}.'.'{domain.com}';
                            $buildPathArray['subdomain'] = '{subdomain}';
                            $buildPathArray['domain'] = '{domain.com}';
                        }
                    }

                }else{
                    if(!count($dbDomain)){
                        $buildPath.= '{domain.com}';
                        $buildPathArray['domain'] = '{domain.com}';
                    }else{
                        $buildPath.= $pathBreakDown[7];
                        $buildPathArray['domain'] = $pathBreakDown[7];
                    }
                }//end if subdomain
                //lets work with the path
                if(isset($dbPath)){
                        $hasPath = false;
                        if(count($dbPath)){
                            foreach ($dbPath as $value) {
                                if($value->subdomain == str_replace('.', '', $buildPathArray['subdomain']) && $buildPathArray['domain'] == $value->domain){
                                    $hasPath = true;
                                }
                            }
                            if($hasPath){
                                $buildPath.= $pathBreakDown[11];
                            }else{
                                $buildPath.= '/{path}';
                            }
                        }else{
                            $buildPath.= '/{path}';
                        }
                }
                foreach ($redirects as $redirect) {
                    if($redirect->redirect_from_url == $buildPath){
                        return redirect($redirect->redirect_to_url);
                    }
                }
            }//end pathbreakdown
        return $next($request);
    }

    /**
     * Return an array with path elements
     * @return Array
     */
    private function returnPath($path)
    {
        $re = '/^(((http|https):)?\\/\\/)?((([a-z0-9][a-z0-9\\-]*[a-z0-9])\\.)?(([a-z0-9][a-z0-9\\-]*[a-z0-9])\\.([a-z]{2,}\\.)*([a-z]{2,})))(\\/.*)?$/i';
        if (preg_match($re, $path, $m)) {
            if(empty($m[6])){
                return $m;
            }else{
                return $m;
            }
        }
    }
    /**
     * Remove any brackets from our urls
     * @return array
     */
    private function removeBrackets($string = null)
    {
        return str_replace(['{', '}'], '', $string);
    }
}
