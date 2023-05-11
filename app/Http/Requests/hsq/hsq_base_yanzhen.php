<?php

namespace App\Http\Requests\hsq;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class hsq_base_yanzhen extends FormRequest
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
    public function failedValidation(Validator $validator)
    {

        $error= $validator->errors()->all();
        throw  new HttpResponseException(response()->json(['code'=>400,'message'=>$error[0]]));
    }
}
