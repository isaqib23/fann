<?php

namespace App\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Madcoda\Youtube\Youtube;

/**
 * Class YoutubeService
 * @package App\Services
 */
class YoutubeService
{
    /**
     * @var Google Client
     */
    private $google;

    /**
     * YoutubeService constructor.
     */
    public function __construct()
    {
        $this->google = new \Google_Client();
        $this->google->setAuthConfig(public_path(env('YOUTUBE_CLIENT_CREDENTIALS_PATH')));

        $this->google->setScopes([
            'profile',
            'https://www.googleapis.com/auth/youtube',
            'https://www.googleapis.com/auth/youtube.force-ssl',
            'https://www.googleapis.com/auth/youtube.readonly',
            'https://www.googleapis.com/auth/youtubepartner-channel-audit',
        ]);
        $this->google->setIncludeGrantedScopes(true);
        $this->google->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $this->google->setRedirectUri(env('YOUTUBE_REDIRECT_URI'));
        $this->google->setAccessType('offline');

    }

    /**
     *
     * @param $user_id
     * @return string
     */
    public function getAuthUrl($user_id)
    {
        $this->google->setState($user_id);

        return $this->google->createAuthUrl();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function authenticateToken($code)
    {
        $tokenObject = $this->google->fetchAccessTokenWithAuthCode($code);

        $this->setAccessToken($tokenObject);
        return $tokenObject;
    }

    /**
     * @param $token
     */
    public function setAccessToken($token)
    {
        $this->google->setAccessToken($token);

        if ($this->google->isAccessTokenExpired()) {
            return $this->refreshAccessToken($token);
        }

    }

    /**
     * @return \Google_Service_Oauth2_Userinfoplus
     */
    public function getUserInfo() {

        $userInfo = new \Google_Service_Oauth2($this->google);

        return $userInfo->userinfo->get();

    }

    /**
     * @return
     */
    public function getChannelsList()
    {
        $youtube = new \Google_Service_YouTube($this->google);
          $queryParams = [
              'mine' => true,
        ];
        return $youtube->channels->listChannels('snippet,contentDetails,statistics', $queryParams);
    }

    public function getListSearch()
    {
        $youtube = new \Google_Service_YouTube($this->google);
        $queryParams = [
            'maxResults' => 5,
            'type' => 'video',
            'forMine' => true,
        ];
        return $youtube->search->listSearch('snippet', $queryParams);
    }

    public function getVideoList($list)
    {
        $youtube = new \Google_Service_YouTube($this->google);
        $queryParams = [
            'id' => $list
        ];
        return $youtube->videos->listVideos('snippet,statistics', $queryParams);
    }
    public function refreshAccessToken($token)
    {
        if ($this->google->isAccessTokenExpired()) {
            // save refresh token to some variable
            $refreshTokenSaved = $this->google->getRefreshToken();
            // update access token
            $this->google->fetchAccessTokenWithRefreshToken($refreshTokenSaved);
            $this->google->setAccessToken($refreshTokenSaved);

            return $refreshTokenSaved;
        }

    }

}
