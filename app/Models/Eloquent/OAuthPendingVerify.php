<?php

namespace App\Models\Eloquent;

use App\User;
use Illuminate\Database\Eloquent\Model;

class OauthPendingVerify extends Model
{
	protected $fillable = ['name'];

	protected $table = 'oauth_verifies';

	/**
	 * Get the users that have this pending verification
	 */
	public function users()
	{
		return $this->belongsToMany(User::class, "oauth_pending_verify", "oauth_verify_id", "user_id")->withPivot('type', 'oauth_verify_id')->withTimeStamps();
	}

}