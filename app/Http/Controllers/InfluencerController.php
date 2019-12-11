<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use http\Exception;
use Illuminate\Http\Response;
use App\Contracts\UserPlatformRepository;
use App\Services\InstagramService;

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

    public function __construct(UserPlatformRepository $userPlatformRepository){
        $this->userPlatformRepository = $userPlatformRepository;
        $this->instagramService = new InstagramService();

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

    public function getProfile(Request $request){
        //provider access token from platform
        ///accesstoken instservice
        /// getposts inst serv


        $profile = $this->userPlatformRepository->findByField('user_id',$request->user_id);
        return response()->json([
             'details' => $profile
        ]);
    }
}
