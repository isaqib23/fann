<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TouchPointRequest extends FormRequest
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
            'campaignId' => 'required|numeric',
            'platformId' => 'required|numeric',
            'touchPoint.name'=> 'required',
            'touchPoint.caption'=> 'required',
            'touchPoint.amount'=> 'nullable|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'touchPoint.amount' => "The touch point.amount must be at least 1.",
            'touchPoint.caption' => "The touch point.caption field is required.",
            'touchPoint.name' => "The touch point.name field is required.",
        ];
    }
}
