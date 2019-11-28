<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CampaignOfferCreateRequest;
use App\Http\Requests\CampaignOfferUpdateRequest;
use App\Contracts\CampaignOfferRepository;
use App\Validators\CampaignOfferValidator;

/**
 * Class CampaignOffersController.
 *
 * @package namespace App\Http\Controllers;
 */
class CampaignOffersController extends Controller
{
    /**
     * @var CampaignOfferRepository
     */
    protected $repository;

    /**
     * @var CampaignOfferValidator
     */
    protected $validator;

    /**
     * CampaignOffersController constructor.
     *
     * @param CampaignOfferRepository $repository
     * @param CampaignOfferValidator $validator
     */
    public function __construct(CampaignOfferRepository $repository, CampaignOfferValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $campaignOffers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $campaignOffers,
            ]);
        }

        return view('campaignOffers.index', compact('campaignOffers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CampaignOfferCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CampaignOfferCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $campaignOffer = $this->repository->create($request->all());

            $response = [
                'message' => 'CampaignOffer created.',
                'data'    => $campaignOffer->toArray(),
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
        $campaignOffer = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $campaignOffer,
            ]);
        }

        return view('campaignOffers.show', compact('campaignOffer'));
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
        $campaignOffer = $this->repository->find($id);

        return view('campaignOffers.edit', compact('campaignOffer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CampaignOfferUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CampaignOfferUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $campaignOffer = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CampaignOffer updated.',
                'data'    => $campaignOffer->toArray(),
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
                'message' => 'CampaignOffer deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CampaignOffer deleted.');
    }
}
