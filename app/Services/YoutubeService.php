<?php
/**
 * Created by PhpStorm.
 * User: Saqib Rao
 * Date: 08/07/2019
 * Time: 09:51 AM
 */

namespace App\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Madcoda\Youtube\Youtube;

class YoutubeService
{
    protected $youtube;

    public function __construct()
    {
        $this->youtube = new Youtube(['key' => config('services.youtube.key')]);
    }

    /**
     * @param string $video_id
     * @return JsonResponse
     * @throws Exception
     */
    public function getVideoInfo(string $video_id): JsonResponse
    {
        return response()->json($this->youtube->getVideoInfo($video_id));
    }

    /**
     * @param string $channel_id
     * @return JsonResponse
     * @throws Exception
     */
    public function getChannelById(string $channel_id): JsonResponse
    {
        return response()->json($this->youtube->getChannelById($channel_id));
    }

    /**
     * @param string $channel_url
     * @return JsonResponse
     * @throws Exception
     */
    public function getChannelFromURL(string $channel_url): JsonResponse
    {
        return response()->json($this->youtube->getChannelFromURL($channel_url));
    }

    /**
     * @param string $string
     * @return JsonResponse
     * @throws Exception
     * @description Search playlists, channels and videos
     */
    public function search(string $string): JsonResponse
    {
        return response()->json($this->youtube->search($string));
    }

    /**
     * @param string $string
     * @return JsonResponse
     * @throws Exception
     * @description Search only Videos
     */
    public function searchVideos(string $string): JsonResponse
    {
        return response()->json($this->youtube->searchVideos($string));
    }

    /**
     * @param string $string
     * @param string $channel_id
     * @param int $results
     * @return JsonResponse
     * @description Search only Videos in a given channel
     */
    public function searchChannelVideos(string $string,string $channel_id,int $results=50): JsonResponse
    {
        return response()->json($this->youtube->searchChannelVideos($string,$channel_id,$results));
    }

    /**
     * @param array $params
     * @return JsonResponse
     * @throws Exception
     * @Params eg: ['q' => 'Android', 'type' => 'video', 'part' => 'id, snippet', 'maxResults' => 50]
     */
    public function searchAdvanced(array $params): JsonResponse
    {
        return response()->json($this->youtube->searchAdvanced($params));
    }
}
