<?php

namespace App\Http\Controllers;

use App\Contracts\PlacementRepository;
use App\Contracts\UserMetaRepository;
use App\Contracts\UserPlatformMetaRepository;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Contracts\UserPlatformRepository;
use App\Validators\UserPlatformValidator;
use App\Services\InstagramService;
use App\Services\YoutubeService;
use function foo\func;


/**
 * Class UserPlatformsController.
 *
 * @package namespace App\Http\Controllers;
 */
class UserPlatformsController extends Controller
{
    /**
     * @var UserPlatformRepository
     */
    protected $repository;

    /**
     * @var instagram
     */
    protected $instagram;

    /**
     * @var Youtube
     */
    protected $youtube;

    /**
     * @var PlacementRepository
     */
    private $placementRepository;
    /**
     * @var UserPlatformMetaRepository
     */
    private $userPlatformMetaRepository;

    /**
     * UserPlatformsController constructor.
     *
     * @param UserPlatformRepository $repository
     * @param PlacementRepository $placementRepository
     * @param UserPlatformMetaRepository $userPlatformMetaRepository
     */
    public function __construct(
        UserPlatformRepository $repository,
        PlacementRepository $placementRepository,
        UserPlatformMetaRepository $userPlatformMetaRepository
    )
    {
        $this->repository = $repository;
        $this->instagram = new InstagramService();
        $this->youtube = new YoutubeService();
        $this->placementRepository = $placementRepository;
        $this->userPlatformMetaRepository = $userPlatformMetaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */

    public function index(Request $request)
    {
        $userPlatform = $this->placementRepository->findByField('slug',$request->input('provider'));

        if($userPlatform->count() > 0){
            return $this->platformsLogin($request->input('provider'));
        }

        return abort('404');
    }

    /**
     * @param $provider
     * @return RedirectResponse
     *
     */
    public function platformsLogin($provider)
    {

        if ($provider == 'instagram') {
            return response()->json([
                'url' => $this->instagram->getAuthUrl(auth()->user()->id)
            ]);
        }

        return response()->json([
            'url' => $this->youtube->getAuthUrl(auth()->user()->id)
        ]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function handleProviderInstagramCallback(Request $request)
    {
        $userData = $this->instagram->getAccessToken($request->input('code'));
        // Create Meta object for saving
        $metaObject = $this->createMetaObject($userData, 'instagram', $request->input('state'));

        $response = $this->repository->store($metaObject);

        // Save user platform Meta
        $this->userPlatformMetaRepository->store($metaObject,$response);

        return redirect()->to('settings/profile');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function handleProviderYoutubeCallback(Request $request)
    {
        // Authenticate Token
        $token = $this->youtube->authenticateToken($request->input('code'));

        // Get User Info Object
        $getUserInfo = $this->youtube->getUserInfo($token);

        // Create Meta for saving user platform
        $metaObject = $this->createMetaObject($getUserInfo, 'youtube', $request->input('state'),$token);

        $response = $this->repository->store($metaObject);

        // Save user platform Meta
        $this->userPlatformMetaRepository->store($metaObject,$response);

        return redirect()->to('settings/profile');
    }

    /**
     * @param $payload
     * @param $provider
     * @param $user_id
     * @param null $token
     * @return Collection
     */
    private function createMetaObject($payload, $provider, $user_id, $token = null)
    {
        $placement = $this->placementRepository->findWhere(['slug' => $provider])->first();

        $metaObject = new Collection();
        if ($provider == 'instagram') {
            $metaObject->user_id = $user_id;
            $metaObject->access_token = $payload->access_token;
            $metaObject->provider = $provider;
            $metaObject->placement_id = $placement->id;
            $metaObject->provider_id = $payload->user->id;
            $metaObject->provider_name = $payload->user->full_name;
            $metaObject->provider_photo = $payload->user->profile_picture;
            $metaObject->followers = $payload->user->counts->follows;
            $metaObject->followings = $payload->user->counts->followed_by;
            $metaObject->meta_json = json_encode($payload);

            return $metaObject;
        }

        $metaObject->user_id = $user_id;
        $metaObject->access_token = json_encode($token);
        $metaObject->provider = $provider;
        $metaObject->placement_id = $placement->id;
        $metaObject->provider_id = $payload->id;
        $metaObject->provider_name = $payload->name;
        $metaObject->provider_photo = $payload->picture;
        $metaObject->followers = $this->getYoutubeFollowers();
        $metaObject->followings = 0;
        $metaObject->meta_json = json_encode($payload);

        return $metaObject;
    }

    /**
     * @return int
     */
    private function getYoutubeFollowers()
    {
        $followers = 0;
        $channels = $this->youtube->getChannelsList();

        foreach ($channels as $key => $value)
        {
            $followers += $value->statistics->subscriberCount;
        }

        return $followers;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserPlatforms(Request $request)
    {
        $platforms = $this->placementRepository->with(['userPlatforms' => function($query){
            $query->with(['userPlatformMeta']);
        }])->all();

        return response()->json([
            'details' => $platforms
        ]);
    }

}
