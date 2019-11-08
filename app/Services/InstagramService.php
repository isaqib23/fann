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
