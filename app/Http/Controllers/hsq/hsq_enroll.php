<?php

namespace App\Http\Controllers\hsq;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Lsf\AdminController;
use App\Http\Requests\hsq\hsq_yanzhen_zhuce;
use App\Http\Requests\Lsf\UserRequest;
use App\Models\hsq\hsq_stu_info;
use App\Models\hsq\hsq_zhucetwo;
use App\Models\Lsf\Stu_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class hsq_enroll extends Controller
{

    //发送验证码
    public static function lsf_send_email(Request $request)
    {
        //创建验证码
        $co=self::lsf_create_email();

        $email=$request['email'];

//        $stu_id=$request['stu_id'];
        //发送验证码,每次都更新
//        $res=Stu_info::lsf_se_em(0);

        $p = (new AdminController)->sendEmail($email,$co);

        return $p?
            json_success('发送成功',$co,200):
            json_fail('发送失败，邮箱有误或不存在',null,100);
    }

    //发送邮件
    public function sendEmail ($email,$code) {
        try {

            Mail::raw("这是你的验证码：".$code, function ($message) use($email){//文本
                // * 如果已经设置过, mail.php中的from参数项,可以不用使用这个方法,直接发送
                $message->from("serein0311@qq.com", "Admin");//发送人
                $message->subject("验证码");//主题
                // 指定发送到哪个邮箱账号
                $message->to($email);
            });
            return true;
        }catch (\Exception $e){
            logError('操作失败',[$e->getMessage()]);
            return false;
        }
    }

    //创建随机验证码
    public static function lsf_create_email()
    {
        $code = (string)random_int(1000,9999);
        return $code;
    }





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
            return json_success($num,'操作成功',200);
        }
        catch (\Exception $e)
        {
            return json_fail('发送失败',null,100);
        }
    }
    public static function add_user(hsq_yanzhen_zhuce $request)
    {
        $flag=hsq_stu_info::hsq_insert_student($request);
        $flag1=hsq_zhucetwo::hsq_insert_password($request);
        if($flag!=1 and $flag1!=1)
        {
            return response()->json(['data'=>'注册失败','code'=>100]);
        }
        elseif ($flag==1 and $flag1!=1)
        {
            hsq_stu_info::dd1($request);
            return response()->json(['data'=>'注册失败','code'=>100]);
        }
        elseif ($flag!=1 and $flag1==1)
        {
            hsq_zhucetwo::dd2($request);
            return response()->json(['data'=>'注册失败','code'=>100]);
        }
        else
        {
            return response()->json(['data'=>'注册成功','code'=>200]);
        }
    }
}
