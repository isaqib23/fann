<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use http\Exception;
use Illuminate\Http\Response;
use App\Contracts\UserPlatformRepository;
use App\Contracts\UserPlatformMetaRepository;
use App\Services\InstagramService;
use App\Services\YoutubeService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class InfluencerController extends Controller
{
    /**
     * @var userPlatformRepository
     */
    private $userPlatformRepository;

    /**
     * @var instagramService
     */
    private $instagramService;

    /**
     * @var youtube Service;
     */
    private $youtubeService;

    public function __construct(UserPlatformRepository $userPlatformRepository)
    {
        $this->userPlatformRepository = $userPlatformRepository;
        $this->instagramService = new InstagramService();
        $this->youtubeService = new YoutubeService();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile( Request $request )
    {
        $id = $request->user_id;
        $profile = $this->userPlatformRepository->getUserPlatforms($request);
        return response()->json([
            'details' => $profile
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPosts( Request $request )
    {
        $influencer = $this->userPlatformRepository->findByField('id', $request->id)->first();

        $this->instagramService->setAccessToken($influencer->access_token);
        $posts = $this->instagramService->getPosts();

        $data = $this->postStats($posts);

        return response()->json($data);
    }

    /**
     * @param $posts
     * @return mixed
     */
    public function postStats( $posts )
    {
        $postCollection = collect($posts);
        $today = Carbon::today()->subDays(180)->format("d-m-Y");

        $lastPosts = $postCollection->filter(function ($post, $key) use ($today) {

            if (strtotime(date("d-m-Y", $post->created_time)) > strtotime($today)) {
                return $post;
            }
        });
        $data = $postCollection->map(function ($post) {

            return [
                'likes' => $post->likes->count,
                'comments' => $post->comments->count
            ];
        });

        $values['posts'] = $posts;
        $values['countLatestPosts'] = count($lastPosts);
        $values['countLastLikes'] = $data->sum('likes');
        $values['countLastComments'] = $data->sum('comments');

        return $values;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getYoutubeVideos(Request $request)
    {
        $influencer = $this->userPlatformRepository->findByField('id', $request->id)->first();

        $refreshedToken = $this->youtubeService->setAccessToken($influencer->access_token);

        if ($refreshedToken != null) {

            $influencer->access_token = json_encode($refreshedToken);
            $this->userPlatformRepository->store($influencer);
        }

        $videos = $this->youtubeService->getListSearch();////videos without statistics
        $data = $this->videoStats($videos);

        return response()->json($data);
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
             $listed = $this->youtubeService->getVideoList($list); ///// to get statistics
         }

         $channels = $this->youtubeService->getChannelsList();
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
