<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * Class InstagramService
 * @package App\Services
 */
class InstagramService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var
     */
    private $access_token;

    /**
     * InstagramService constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.instagram.com/v1/',
        ]);
    }

    /**
     *
     * @param $user_id
     * @return string
     */
    public function getAuthUrl($user_id)
    {
        $authUrl = 'https://api.instagram.com/oauth/authorize/?client_id=' . config('services.instagram.client_id') . '&redirect_uri=' . config('services.instagram.redirect') . '&response_type=code&state=' . $user_id;
        return $authUrl;
    }

    /**
     * @param $code
     * @return mixed
     * @throws GuzzleException
     */
    public function getAccessToken($code)
    {
        $client = new Client();
        $response = $client->post('https://api.instagram.com/oauth/access_token',
            [
                'form_params' => [
                    'client_id' => config('services.instagram.client_id'),
                    'client_secret' => config('services.instagram.client_secret'),
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => config('services.instagram.redirect'),
                    'code' => $code
                ]
            ]);

        $result = json_decode($response->getBody()->getContents());

        // set Access Token
        $this->setAccessToken($result->access_token);
        // Get User Data
        $result->user = $this->getUser();

        return $result;
    }

    /**
     * @param $token
     */
    public function setAccessToken($token)
    {
        $this->access_token = $token;
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getUser()
    {
        if ($this->access_token) {
            $response = $this->client->request('GET', 'users/self/', [
                'query' => [
                    'access_token' => $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getPosts()
    {
        if ($this->access_token) {
            $response = $this->client->request('GET', 'users/self/media/recent/', [
                'query' => [
                    'access_token' => $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    /**
     * @param $tags
     * @return array
     * @throws GuzzleException
     */
    public function getTagPosts($tags)
    {
        if ($this->access_token) {
            $response = $this->client->request('GET', 'tags/' . $tags . '/media/recent/', [
                'query' => [
                    'access_token' => $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getUsersFollows()
    {
        if ($this->access_token) {
            $response = $this->client->request('GET', 'users/self/follows/', [
                'query' => [
                    'access_token' => $this->access_token,
                    'scope' => 'basic+public_content+follower_list+comments+relationships+likes'
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

}
