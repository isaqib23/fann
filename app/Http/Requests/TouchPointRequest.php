<?php

namespace App\Http\Requests;

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
            'touchPoint.campaignDescription' => 'required',
            'touchPoint.name'                => 'required',
            'touchPoint.caption'             => 'required',
        ];

        if($this->input('touchPoint.touchPointConditionalFields.isPaid') ||
            $this->input('touchPoint.touchPointConditionalFields.additionalPayAsAmount')
        ) {
            $rules['touchPoint.amount'] = 'nullable|numeric|min:1';
        }

        if($this->input('touchPoint.touchPointConditionalFields.touchPointproduct')
        ) {
            $rules['touchPoint.barterProduct'] = 'required';
        }

        if($this->input('touchPoint.touchPointConditionalFields.touchPointInstagramFormat')
        ) {
            if(is_null($this->input('touchPoint.instaPost')) && is_null($this->input('touchPoint.instaStory'))
            ) {
                $rules['touchPoint.instaPost'] = 'required';
            }

            if(!is_null($this->input('touchPoint.instaPost')) ) {
                $rules['touchPoint.instaBioLink'] = 'required';
            }elseif(!is_null($this->input('touchPoint.instaStory')) ) {
                $rules['touchPoint.instaStoryLink'] = 'required';
            }
        }

        return $rules;
    }
}
