<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eloquent\OauthPendingVerify;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;




/**
 * Class User
 * @package App
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_city',
        'address_country',
        'address_country_code',
        'address_name',
        'address_state',
        'address_status',
        'address_street',
        'address_zip',
        'first_name',
        'last_name',
        'payer_business_name',
        'payer_email',
        'payer_id',
        'payer_status',
        'contact_phone',
        'residence_country',
        'username',
        'password',
        'subscr_id',
        'remember_token',
        'verified',
        'verify_token',
        'auth_type'
        ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fitness_goals()
    {
        return $this->belongsToMany('App\FitnessGoal','customer_fitness_goal','customer_id','fitness_goal_id')->withTimestamps();
    }

    /**
     * Get the user's first name
     * @param string $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    /**
     * Get the user's last name
     * @param string $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    /**
     * Get the user's Initials
     * @param string $value
     * @return string
     */
    public function getInitialsAttribute($value)
    {
        $initials[] = @$this->first_name[0] . @$this->last_name[0];
        $initials[] = @$this->first_name[0] . @$this->first_name[1];
        $initials[] = @$this->last_name[0] . @$this->last_name[1];
        foreach ($initials as $initial) {
            if (strlen($initial)==2) {
                return strtoupper($initial);
            }
        }

        return $initials[0];
    }


    /**
     * Get the user's avatar
     * @param string $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        return @$this->profile->getAvatar() ?: NULL;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image_url()
    {
        return $this->hasOne('App\File',"id",'image');
    }

    /*
     * A User has a profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\CustomerProfile', 'customer_id');
    }


    /*
     * A User may have a dash user associated with
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dashUser()
    {
        return $this->hasOne('FitlifeGroup\Models\Eloquent\User', 'email', 'payer_email');
    }

    /**
     * Get outh verifies related to this user
     */
    public function oauthPendingVerify()
    {
        return $this->belongsToMany(OauthPendingVerify::class, "oauth_pending_verify", "user_id", "oauth_verify_id")->withPivot('type', 'oauth_verify_id')->withTimestamps();
    }
    /**
     * Retrieve a Customer by email
     * @param string $email
     * @return static
     */
    public static function byEmail($email)
    {
        return static::where('payer_email', $email)->firstOrFail();

    }

    /**
     * Retrieve a Customer by verification token
     * @param string $token
     * @return static
     */
    public static function byVerifyToken($token)
    {
        return static::where('verify_token', $token)->firstOrFail();
    }

     /**
     * Retrieve a Customer by remember token
     * @param string $token
     * @return static
     */
    public static function byRememberToken($token)
    {
        return static::with('profile')->where('remember_token', $token)->firstOrFail();
    }

}
