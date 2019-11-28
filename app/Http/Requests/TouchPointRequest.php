<?php

namespace App\Http\Requests;


use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'touchPoint.campaignDescription'=> 'required',
            'touchPoint.name'=> 'required',
            'touchPoint.caption'=> 'required',
            'touchPoint.amount'=> 'nullable|numeric|min:1',
        ];
    }

    /**
     * @return array
     */
    public static function staticRules()
    {
        return (new TouchPointRequest)->rules();
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->messages()->first()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

}
