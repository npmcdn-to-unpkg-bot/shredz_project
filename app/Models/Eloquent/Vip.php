<?php

namespace App\Models\Eloquent;
use App\User;
use FitlifeGroup\Models\Eloquent\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VIP extends Model
{
    use SoftDeletes;

    protected $table = 'viplist';

    protected $dates = [
        'created_at'
    ];

    public $timestamps = false;

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

}