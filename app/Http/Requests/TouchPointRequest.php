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
        return [
            'campaignId'                     => 'required|numeric',
            'platformId'                     => 'required|numeric',
            'touchPoint.campaignDescription' => 'required',
            'touchPoint.name'                => 'required',
            'touchPoint.caption'             => 'required',
            'touchPoint.amount'              => 'nullable|numeric|min:1',
        ];
    }
}
