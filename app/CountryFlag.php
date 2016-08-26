<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryFlag extends Model
{
    protected $table = "country_flag";

    protected $fillable = ["country_code",'address_country','1xfile','2xfile','text_color','text'];

    public function scopeFlagForCode($query,$country_code)
    {
        return $query -> where('country_code',$country_code);
    }

    public function scopeFlagForCountry($query,$address_country)
    {
        return $query -> where('address_country',$address_country);
    }
}
