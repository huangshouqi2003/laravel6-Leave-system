<?php

namespace App\Http\Controllers\hsq;

use App\Http\Controllers\Controller;
use App\Http\Requests\hsq\hsq_yanzhen_zhuce;
use App\Models\hsq\hsq_stu_info;
use App\Models\hsq\hsq_zhucetwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class hsq_enroll extends Controller
{

    public function hsq_send_email(Request $request)
    {
        $num=rand(1000,9999);
        $email=$request->input('email');
        $data= array('name'=>$num);
        try {
            Mail::send('kf',$data, function($message) use($email)
            {
                $message->to($email)->subject('验证码');
            });
            return response()->json(['data'=>$num]);
        }
        catch (\Exception $e)
        {
            return response()->json(['data'=>'发送失败']);
        }
    }
    public static function add_user(hsq_yanzhen_zhuce $request)
    {
        $flag=hsq_stu_info::hsq_insert_student($request);
        $flag1=hsq_zhucetwo::hsq_insert_password($request);
        if($flag!=1 and $flag1!=1)
        {
            return response()->json(['data'=>'注册失败']);
        }
        elseif ($flag==1 and $flag1!=1)
        {
            hsq_stu_info::dd1($request);
            return response()->json(['data'=>'注册失败']);
        }
        elseif ($flag!=1 and $flag1==1)
        {
            hsq_zhucetwo::dd2($request);
            return response()->json(['data'=>'注册失败']);
        }
        else
        {
            return response()->json(['data'=>'注册成功']);
        }
    }
}
