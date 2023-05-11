<?php

namespace App\Http\Controllers\Lsf;

use App\Http\Controllers\Controller;
use App\Http\Requests\hsq\hsq_yanzhen_zhuce;
use App\Models\Lsf\Stu_pwd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

//use http\Env\Response;

class StuController extends Controller
{

    //学生忘记密码
    public static function stu_fg(Request $request)
    {
        $email = $request['email'];
        $stu_id = $request['stu_id'];
        $stu_new_password = $request['$stu_new_password'];
        $code = $request['code'];


        $res = Stu_pwd::lsf_forget($email, $stu_id, $stu_new_password, $code);
        return $res ?
            json_success('操作成功!', $res, '200') :
            json_fail('操作失败!', null, '100');
    }
    //加密
    public static function encryptString($value)
    {
        $enc = Crypt::encryptString($value);
        return $enc;
    }

    //解密
    public static function decryptString($value)
    {
        $enc = Crypt::decryptString($value);
        return $enc;
    }

}
