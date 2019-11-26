<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailCreateRequest extends FormRequest
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
            'bio' => 'required|string|max:191',
            'userDetail.address'=> 'required',
            'userDetail.picture'=> 'required',
            'userDetail.niche'=> 'required',
            'userDetail.timezone'=> 'required',
            'userDetail.state_id'=> 'required',
            'userDetail.country_id'=> 'required',
            'userDetail.website'=> 'required|url',
            'userDetail.phone' => 'required|numeric'
        ];
    }
}
