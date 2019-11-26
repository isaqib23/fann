<?php

namespace App\Http\Controllers;

use App\Contracts\UserMetaRepository;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Contracts\UserPlatformRepository;
use App\Validators\UserPlatformValidator;
use App\Services\InstagramService;
use App\Services\YoutubeService;


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
     * @var UserPlatformRepository
     */
    private $userPlatformRepository;

    /**
     * @var UserMetaRepository
     */
    private $userMetaRepository;

    /**
     * UserPlatformsController constructor.
     *
     * @param UserPlatformRepository $repository
     * @param UserPlatformRepository $userPlatformRepository
     * @param UserMetaRepository $userMetaRepository
     */
    public function __construct(
        UserPlatformRepository $repository,
        UserPlatformRepository $userPlatformRepository,
        UserMetaRepository $userMetaRepository
    )
    {
        $this->repository = $repository;
        $this->userPlatformRepository = $userPlatformRepository;
        $this->userMetaRepository = $userMetaRepository;
        $this->instagram = new InstagramService();
        $this->youtube = new YoutubeService();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */

    public function index(Request $request)
    {
        $userPlatform = $this->userPlatformRepository->findByField('name',$request->input('provider'));

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

        $this->userMetaRepository->store($metaObject);

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

        // Set Access Token
        $this->youtube->setAccessToken($token);

        // Get User Info Object
        $getUserInfo = $this->youtube->getUserInfo($token);

        // Create Meta object for saving
        $metaObject = $this->createMetaObject($getUserInfo, 'youtube', $request->input('state'),$token);

        $this->userMetaRepository->store($metaObject);

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
        $metaObject = new Collection();
        if ($provider == 'instagram') {
            $metaObject->user_id = $user_id;
            $metaObject->access_token = $payload->access_token;
            $metaObject->provider = $provider;
            $metaObject->provider_id = $payload->user->id;
            $metaObject->provider_name = $payload->user->full_name;
            $metaObject->provider_photo = $payload->user->profile_picture;
            $metaObject->meta_json = json_encode($payload);
        }

        $metaObject->user_id = $user_id;
        $metaObject->access_token = json_encode($token);
        $metaObject->provider = $provider;
        $metaObject->provider_id = $payload->id;
        $metaObject->provider_name = $payload->name;
        $metaObject->provider_photo = $payload->picture;
        $metaObject->meta_json = json_encode($payload);

        return $metaObject;
    }

}
