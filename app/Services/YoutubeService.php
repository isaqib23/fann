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
        $this->google->addScope(\Google_Service_Plus::class);
        $this->google->setRedirectUri(env('YOUTUBE_REDIRECT_URI'));

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
        $tokenObject = $this->google->authenticate($code);
        $this->setAccessToken($tokenObject);

        return $tokenObject;
    }

    /**
     * @param $token
     */
    public function setAccessToken($token)
    {
        $this->google->setAccessToken($token);

        if($this->google->isAccessTokenExpired()) {
            $this->google->fetchAccessTokenWithRefreshToken($this->google->getRefreshToken());
            //Update in DB $this->google->getAccessToken();
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
            'mine' => true
        ];
        return $youtube->channels->listChannels('contentOwnerDetails,snippet,contentDetails,statistics', array('mine' => $queryParams));
    }
}
