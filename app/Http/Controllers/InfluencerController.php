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

    public function __construct( UserPlatformRepository $userPlatformRepository ) {
        $this->userPlatformRepository = $userPlatformRepository;
        $this->instagramService = new InstagramService();
        $this->youtubeService = new YoutubeService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProfile(Request $request)
    {
        $id = $request->user_id;
        $profile = $this->userPlatformRepository->with(['userPlatformMeta'])->findByField('user_id',$request->user_id);
        return response()->json([
             'details' => $profile
        ]);
    }

    public function getPosts(Request $request)
    {

        $influencer = $this->userPlatformRepository->findByField('id', $request->id)->first();

        $this->instagramService->setAccessToken($influencer->access_token);
        $posts = $this->instagramService->getPosts();

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

        $lastLikes = $data->sum('likes');
        $lastComments = $data->sum('comments');

        return response()->json([
            'posts' => $posts,
            'countLatestPosts' => count($lastPosts),
            'countLastLikes' => $lastLikes,
            'countLastComments' => $lastComments

        ]);
    }
        public function getYoutubeVideos(Request $request)
        {
            $influencer = $this->userPlatformRepository->findByField('id', $request->id)->first();

            $refreshedToken = $this->youtubeService->setAccessToken($influencer->access_token);
            if($refreshedToken !=null) {
                $influencer->access_token = $refreshedToken;
                $this->userPlatformRepository->store($influencer);
            }

            $videos = $this->youtubeService->getListSearch();
            $videos = $videos->items;
            if( !empty($videos )) {
                $vid = collect($videos);
                $list = $vid->pluck('id.videoId');
                $list = $list->implode(',');
                $listed = $this->youtubeService->getVideoList($list);
            }

            $channels = $this->youtubeService->getChannelsList();
//            dd($channels);
            $channelList = $channels->items;

            $today = Carbon::today()->subDays(280)->format("d-m-Y");
             $filtered = array_filter($videos, function ($item) use($today) {
                 if(strtotime(date("d-m-Y",strtotime($item->snippet->publishedAt))) > strtotime($today)) {
                     return $item;
                 }
             });

            return response()->json([
                'videos' => $listed,
                'channelList' => $channelList,
                'countLatestVideos' => count($filtered),
            ]);
         }
}
