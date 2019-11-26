<?php

namespace App\Http\Controllers;

use App\Contracts\UserMetaRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Contracts\UserPlatformRepository;
use App\Validators\UserPlatformValidator;
use App\Services\InstagramService;


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
                'url' => 'https://api.instagram.com/oauth/authorize/?client_id=' . config('services.instagram.client_id') . '&redirect_uri=' . config('services.instagram.redirect') . '&response_type=code&state=' . auth()->user()->id
            ]);
        }

        return redirect()->to('https://api.instagram.com/oauth/authorize/?client_id=CLIENT-ID&redirect_uri=REDIRECT-URI&response_type=token');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
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
     * @param $payload
     * @param $provider
     * @param $user_id
     * @return Collection
     */
    private function createMetaObject($payload, $provider, $user_id)
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

        return $metaObject;
    }

}
