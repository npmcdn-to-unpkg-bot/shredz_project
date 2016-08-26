<?php 

namespace App\Http\Controllers\Auth\traits;

trait SupportsAuth
{

	/**
     * Determine which domain the user is coming from
     * @param string $path
     * @return string
     */
    protected function fromDomain($path)
    {
        $re = '/^(((http|https):)?\\/\\/)?((([a-z0-9][a-z0-9\\-]*[a-z0-9])\\.)?(([a-z0-9][a-z0-9\\-]*[a-z0-9])\\.([a-z]{2,}\\.)*([a-z]{2,})))(\\/.*)?$/i';
        if (preg_match($re, $path, $m)) {
            if(empty($m[6])){
                return $m[1].$m[7]; 
            }else{
                return $m[1].$m[6].'.'.$m[7];
            }
        } 
    }

    /**
     * Create a custom token
     * @param string $sting
     */
    protected function createToken($string)
    {
        return sha1(time() . $string);
    }

    /**
     * Convert users height from feet/inches to centimeters
     * @param int $feet
     * @param int $inches
     * @return int
     */
    protected function feetToCentimeters($feet, $inches = 0)
    {
         $inches = ($feet * 12) + $inches;
         return (int) round($inches / 0.393701);
    }

    /**
     * Convert users height from feet/inches to centimeters
     * @param int $feet
     * @param int $inches
     * @return int
     */
    protected function libsToKilograms($libs)
    {
        return (int) round($libs / 2.2);
    }



}