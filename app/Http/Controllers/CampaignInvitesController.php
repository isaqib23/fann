<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CampaignInviteCreateRequest;
use App\Http\Requests\CampaignInviteUpdateRequest;
use App\Contracts\CampaignInviteRepository;

/**
 * Class CampaignInvitesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CampaignInvitesController extends Controller
{
    /**
     * @var CampaignInviteRepository
     */
    protected $repository;

    /**
     * CampaignInvitesController constructor.
     *
     * @param CampaignInviteRepository $repository
     */
    public function __construct(CampaignInviteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $campaignInvites = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $campaignInvites,
            ]);
        }

        return view('campaignInvites.index', compact('campaignInvites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CampaignInviteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CampaignInviteCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $campaignInvite = $this->repository->create($request->all());

            $response = [
                'message' => 'CampaignInvite created.',
                'data'    => $campaignInvite->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaignInvite = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $campaignInvite,
            ]);
        }

        return view('campaignInvites.show', compact('campaignInvite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaignInvite = $this->repository->find($id);

        return view('campaignInvites.edit', compact('campaignInvite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CampaignInviteUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CampaignInviteUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $campaignInvite = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CampaignInvite updated.',
                'data'    => $campaignInvite->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'CampaignInvite deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CampaignInvite deleted.');
    }
}
