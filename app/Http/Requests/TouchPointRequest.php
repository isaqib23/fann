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
        $rules = [
            'campaignId'                     => 'required|numeric',
            'platformId'                     => 'required|numeric',
            'campaignInformation.description'=> Rule::requiredIf($this->checkCampaignDescription()),
            'touchPoint.caption'             => 'required',
            'touchPoint.hashtags'             => 'required',
            'touchPoint.mentions'             => 'required',
            'touchPoint.guideLines'             => 'required',
        ];

        $rules = $this->checkTouchPointName($rules);

        $rules = $this->checkTouchPointAmount($rules);

        $rules = $this->checkTouchPointInstagramFormat($rules);

        $rules = $this->checkDispatchProduct($rules);

        $rules = $this->checkProductBrand($rules);

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'touchPoint.caption'    => 'touch point caption',
            'touchPoint.hashtags'   => 'touch point hashtags',
            'touchPoint.mentions'   => 'touch point mentions',
            'touchPoint.guideLines' => 'touch point guidelines',
            'campaignInformation.description' => 'campaign description',
            'touchPoint.name'                 => 'touch point name',
            'touchPoint.dispatchProduct'      => 'touch point dispatch product'
        ];
        return $attributes;
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
            if (is_null($this->input('touchPoint.instaFormatFields.instaPost')) && is_null($this->input('touchPoint.instaFormatFields.instaStory'))
            ) {
                $rules['touchPoint.instaFormatFields.instaPost'] = 'required';
            }

            if (!is_null($this->input('touchPoint.instaFormatFields.instaPost'))) {
                $rules['touchPoint.instaFormatFields.instaBioLink'] = 'required';
            } elseif (!is_null($this->input('touchPoint.instaFormatFields.instaStory'))) {
                $rules['touchPoint.instaFormatFields.instaStoryLink'] = 'required';
            }
        }

        return $rules;
    }

    /**
     * @param array $rules
     * @return array
     */
    private function checkDispatchProduct(array $rules): array
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
        if ($this->input('touchPoint.touchPointConditionalFields.touchPointBrand') &&
                $this->input('touchPoint.touchPointConditionalFields.additionalPayAsBarter')
        ) {
            $rules['touchPoint.barterProduct'] = 'required';
        }
        if ($this->input('touchPoint.touchPointConditionalFields.touchPointBrand') &&
            $this->input('touchPoint.touchPointConditionalFields.isBarter')
        ) {
            $rules['touchPoint.barterProduct'] = 'required';
        }

        return $rules;
    }

    /**
     * @return bool
     */
    private function checkCampaignDescription()
    {
        $data = $this->request->all();
        $campaign = Campaign::find($data['campaignId']);

        return (is_null($campaign->description)) ? true : false;
    }

    /**
     * @param array $rules
     * @return array
     */
    private function checkTouchPointName(array $rules): array
    {
        if ($this->input('touchPoint.touchPointConditionalFields.touchPointTitle')
        ) {
            $rules['touchPoint.name'] = 'required';
        }

        return $rules;
    }

}
