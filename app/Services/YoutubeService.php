<?php

namespace App\Services;

use Carbon\Carbon;
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
            'email',
            'openid',
            'https://www.googleapis.com/auth/youtube',
            'https://www.googleapis.com/auth/youtube.force-ssl',
            'https://www.googleapis.com/auth/youtube.readonly',
            'https://www.googleapis.com/auth/youtubepartner-channel-audit',
        ]);
        $this->google->setIncludeGrantedScopes(true);
        $this->google->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $this->google->setRedirectUri(env('YOUTUBE_REDIRECT_URI'));
        $this->google->setApprovalPrompt("force");
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
     * @return array
     */
    public function authenticateToken($code)
    {
        $tokenObject = $this->google->fetchAccessTokenWithAuthCode($code);
        $this->setAccessToken($tokenObject);
        return $tokenObject;
    }

    /**
     * @param $token
     * @return string|null
     */
    public function setAccessToken($token)
    {
        $this->google->setAccessToken($token);
        return $this->refreshAccessToken($token);
    }

    /**
     * @return \Google_Service_Oauth2_Userinfoplus
     */
    public function getUserInfo()
    {
        $userInfo = new \Google_Service_Oauth2($this->google);
        return $userInfo->userinfo->get();
    }

    /**
     * @param $token
     * @return string|null
     */
    public function refreshAccessToken($token)
    {
        if ($this->google->isAccessTokenExpired()) {
            // save refresh token to some variable
            $refreshToken = $this->google->getRefreshToken();
            // update access token
            $newToken = $this->google->fetchAccessTokenWithRefreshToken($refreshToken);
            //$this->google->setAccessToken($newToken);
            return $newToken;
        }
    }

    /**
     * @return \Google_Service_YouTube_ChannelListResponse
     */
    public function getChannelsList()
    {
        $youtube = new \Google_Service_YouTube($this->google);
        $queryParams = [
            'mine' => true
        ];
        return $youtube->channels->listChannels(
            'contentOwnerDetails,snippet,contentDetails,statistics',
            array('mine' => $queryParams)
        );
    }

    /**
     * @return \Google_Service_YouTube_SearchListResponse
     */
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

    /**
     * @param $list
     * @return \Google_Service_YouTube_VideoListResponse
     */
    public function getVideoList($list)
    {
        $youtube = new \Google_Service_YouTube($this->google);
        $queryParams = [
            'id' => $list
        ];
        return $youtube->videos->listVideos('snippet,statistics', $queryParams);
    }
    /**
     * @param $videos
     * @return mixed
     */
    public function videoStats( $videos )
    {
        $videos = $videos->items;
        $listed = $videos;
        if (!empty($videos)) {

            $videoCollect = collect($videos);
            $list = $videoCollect->pluck('id.videoId');
            $list = $list->implode(',');
            $listed = $this->getVideoList($list); ///// to get statistics
        }

        $channels = $this->getChannelsList();
        $channelList = $channels->items;

        $today = Carbon::today()->subDays(280)->format("d-m-Y");

        $filtered = array_filter($videos, function ($item) use ($today) {

            if (strtotime(date("d-m-Y", strtotime($item->snippet->publishedAt))) > strtotime($today)) {
                return $item;
            }
        });

        $val['videos'] = $listed;
        $val['channelList'] = $channelList;
        $val['countLatestVideos'] = count($filtered);

        return $val;
    }

}
