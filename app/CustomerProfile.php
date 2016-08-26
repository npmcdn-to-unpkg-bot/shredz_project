<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
	/**
	 * The fields that can be mass assigned
	 */
	protected $fillable = [
		'customer_id',
		'height',
		'weight',
		'avatar',
		'gender',
		'date_of_birth',
		'github_id',
		'google_id',
		'facebook_id',
		'fitbit_id',
		'underarmour_id',
		'nike_id',
		'oauth_avatar'
	];

	/**
	 * Get the user related to the profile
	 */
	public function user()
	{
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function getAvatar()
    {
		if ($this->avatar) {
			return $this->avatar;
		} elseif ($this->oauth_avatar) {
			return $this->oauth_avatar;
		}
		return false;
    }
}
