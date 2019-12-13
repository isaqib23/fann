<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use Illuminate\Validation\Rule;

class TouchPointRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this->request->all());
        $rules = [
            'campaignId'                     => 'required|numeric',
            'platformId'                     => 'required|numeric',
            //'campaignInformation.description'=> Rule::requiredIf($this->checkCampaignDescription()),
            'touchPoint.name'                => 'required',
            'touchPoint.caption'             => 'required',
        ];

        $rules = $this->checkTouchPointAmount($rules);

        $rules = $this->checkTouchPointInstagramFormat($rules);

        $rules = $this->checkBarterProduct($rules);

        $rules = $this->checkProductBrand($rules);

        return $rules;
    }

    /**
     * @param array $rules
     * @return array
     */
    private function checkTouchPointAmount(array $rules): array
    {
        if ($this->input('touchPoint.touchPointConditionalFields.isPaid') ||
            $this->input('touchPoint.touchPointConditionalFields.additionalPayAsAmount')
        ) {
            $rules['touchPoint.amount'] = 'nullable|numeric|min:1';
        }

        return $rules;
    }

    /**
     * @param array $rules
     * @return array
     */
    private function checkTouchPointInstagramFormat(array $rules): array
    {
        if ($this->input('touchPoint.touchPointConditionalFields.touchPointInstagramFormat')
        ) {
            if (is_null($this->input('touchPoint.instaPost')) && is_null($this->input('touchPoint.instaStory'))
            ) {
                $rules['touchPoint.instaPost'] = 'required';
            }

            if (!is_null($this->input('touchPoint.instaPost'))) {
                $rules['touchPoint.instaBioLink'] = 'required';
            } elseif (!is_null($this->input('touchPoint.instaStory'))) {
                $rules['touchPoint.instaStoryLink'] = 'required';
            }
        }

        return $rules;
    }

    /**
     * @param array $rules
     * @return array
     */
    private function checkBarterProduct(array $rules): array
    {
        if ($this->input('touchPoint.touchPointConditionalFields.touchPointProduct')
        ) {
            $rules['touchPoint.dispatchProduct'] = 'required';
        }

        return $rules;
    }

    /**
     * @param array $rules
     * @return array
     */
    private function checkProductBrand(array $rules): array
    {
        if ($this->input('touchPoint.touchPointConditionalFields.touchPointBrand')
        ) {
            $rules['touchPoint.productBrand'] = 'required';
        }

        return $rules;
    }

    private function checkCampaignDescription()
    {
        $data = $this->request->all();
        $campaign = Campaign::find($data['campaignId']);

        return (is_null($campaign->description)) ? true : false;
    }
}
