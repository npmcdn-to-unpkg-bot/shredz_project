<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Auth\traits\SupportsAuth;
use App\Http\Controllers\Auth\traits\ResetsPasswords;

class PasswordController extends BaseController
{
    
    use ResetsPasswords, SupportsAuth;

    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming password reset email submit
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function passwordResetEmailValidator(array $data)
    {
        return Validator::make($data, [
            'payer_email' => 'required|email|exists:customers'
        ], [
            'payer_email.exists' => 'We could not find a user with this email address.'
        ]);
    }

    /**
     * Get a validator for an incoming password reset email and token submit
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function passwordResetTokenValidator(array $data)
    {
        return Validator::make($data, [
            'token' => 'required|exists:customers,remember_token|token_belongs_to_user',
            'payer_email' => 'required|email|exists:customers',
            'password' => 'required|confirmed|min:6',
        ], [
            'token.token_belongs_to_user' => 'The token is invalid.',
            'payer_email.exists' => 'The email entered does not belong to an active user.'
        ]);
    }
}
