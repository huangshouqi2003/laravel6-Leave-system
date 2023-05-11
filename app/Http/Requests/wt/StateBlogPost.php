<?php

namespace App\Http\Requests\wt;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class StateBlogPost extends FormRequest
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
            'le_time_bg' => [
                'required'
            ],
            'le_time_end' => [
                'required'
            ],
            'le_type'=>[
                'required',//不能为空
            ],
            'le_why' => [
                'required',
                'between:1,150',
            ]
        ];
    }

    public function messages(){
        return [
            'le_type.required' => '请假类型不能为空',
            'le_why.required' => '请假理由不能为空',
            'le_time_bg.required' => '请假开始时间不能为空',
            'le_time_end.required' => '请假结束时间不能为空',
            'le_why.between' => '假条状态必须介于 1 - 150 个字符之间',
        ];
    }

    public function failedValidation(Validator $validator){

        throw(new HttpResponseException(json_fail('参数错误',$validator->errors()->all(),422)));
    }
}
