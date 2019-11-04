<?php
/**
 * Created by PhpStorm.
 * User: Saqib Rao
 * Date: 08/05/2019
 * Time: 08:50 AM
 */

namespace App\Services;

use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;

class InstagramService
{
    protected $instagram;
    private $client;
    private $access_token;
//3226967544.4bb0011.5cf812b3e7044c7daf218c69b1ca8620
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.instagram.com/v1/',
        ]);
    }

    public function setAccessToken($token){
        $this->access_token = $token;
    }

    public function getUser(){
        if($this->access_token){
            $response = $this->client->request('GET', 'users/self/', [
                'query' => [
                    'access_token' =>  $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    public function getPosts(){
        if($this->access_token){
            $response = $this->client->request('GET', 'users/self/media/recent/', [
                'query' => [
                    'access_token' =>  $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    public function getTagPosts($tags){
        if($this->access_token){
            $response = $this->client->request('GET', 'tags/'.$tags.'/media/recent/', [
                'query' => [
                    'access_token' =>  $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    public function getUsersFollows(){
        if($this->access_token){
            $response = $this->client->request('GET', 'users/self/follows/', [
                'query' => [
                    'access_token' =>  $this->access_token,
                    'scope'         => 'basic+public_content+follower_list+comments+relationships+likes'
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }
}
