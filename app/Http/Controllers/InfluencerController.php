<?php

namespace App\Http\Controllers;

use App\Services\YoutubeService;
use Illuminate\Http\Request;
use http\Exception;
use Illuminate\Http\Response;
use App\Contracts\UserPlatformRepository;
use App\Contracts\UserPlatformMetaRepository;
use App\Services\InstagramService;
use Carbon\Carbon;


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

//        if($influencer->provider == "instagram") {
        $this->instagramService->setAccessToken($influencer->access_token);
        $posts = $this->instagramService->getPosts();

        $postCollection = collect($posts);

        $today = Carbon::today()->subDays(180)->format("d-m-Y");

        $lastPosts = $postCollection->filter(function ($post, $key) use ($today) {
            if (strtotime(date("d-m-Y", $post->created_time)) > strtotime($today)) {
                return $post;
            }
        });
//            dd($lastPosts);
        $data = $postCollection->map(function ($post) {
            return [
                'likes' => $post->likes->count,
                'comments' => $post->comments->count
            ];
        });
//
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
            $videos = $this->youtubeService->getListSearch('video');
         }
}
