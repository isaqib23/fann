<?php

namespace App\Http\Controllers;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use http\Exception;
use Illuminate\Http\Response;
use App\Contracts\UserPlatformRepository;
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
     * @return JsonResponse
     */
    public function getProfile( Request $request )
    {
        $profile = $this->userPlatformRepository->getUserPlatforms($request);
        return response()->json([
            'details' => $profile
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function getPosts( Request $request )
    {
        $influencer = $this->userPlatformRepository->findByField('id', $request->id)->first();

        $this->instagramService->setAccessToken($influencer->access_token);
        $posts = $this->instagramService->getPosts();

        $data = $this->instagramService->postStats($posts);

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
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
        $data = $this->youtubeService->videoStats($videos);

        return response()->json($data);
    }


}
