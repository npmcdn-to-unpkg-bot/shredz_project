<?php

namespace App\Libraries\SocialiteProviders\UnderArmour;

use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;
use GuzzleHttp\ClientInterface;

class UnderArmour extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'UNDERARMOUR';

    /**
     * {@inheritdoc}
     */
    protected $scopes = ['read'];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://www.mapmyfitness.com/v7.1/oauth2/uacf/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://api.ua.com/v7.1/oauth2/uacf/access_token';
    }

    public function getAccessTokenResponse($code)
    {
        $postKey = (version_compare(ClientInterface::VERSION, '6') === 1) ? 'form_params' : 'body';
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => [ 
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Api-Key' => env('UNDERARMOUR_ID')
            ],
            'grant_type' => 'authorization_code',
            'client_id' => env('UNDERARMOUR_ID'),
            'client_secret' => env('UNDERARMOUR_SECRET'),
            $postKey => $this->getTokenFields($code),
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.ua.com/v7.1/user/self/', [
            'headers' => [
                'Api-Key' => env('UNDERARMOUR_ID'),
                'Authorization' => 'Bearer '.$token,
            ],
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['id'],
            'nickname' => '',
            'name' => $user['first_name'],
            'email' => $user['email'],
            'avatar' => 'https://api.ua.com/v7.1/' . $user['_links']['image'][0]['href'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
