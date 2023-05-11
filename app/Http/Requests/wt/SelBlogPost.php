<?php

namespace App\Http\Requests\wt;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class SelBlogPost extends FormRequest
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
            'stu_name' => [
                'required',
                'between:1,11',

            ]
        ];
    }

    public function messages(){
        return [
            'stu_name.required' => '查询不能为空',
            'stu_name.between' => '查询内容必须介于 1 - 11 个字符之间',
        ];
    }

    public function failedValidation(Validator $validator){

        throw(new HttpResponseException(json_fail('参数错误',$validator->errors()->all(),422)));
    }
}
