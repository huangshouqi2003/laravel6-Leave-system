<?php

namespace App\Http\Controllers\hsq;

use App\Http\Controllers\Controller;
use App\Http\Requests\hsq\hsq_yanzhen_denlu;
use App\Models\hsq\hsq_stu_info;
use App\Models\hsq\hsq_student;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class hsq_login extends Controller
{
    public static function creat_token(hsq_yanzhen_denlu $request)
    {
        $stu_name = hsq_stu_info::hsq_select_stu_name($request['stu_id']);

        $key = 'hsq';
        $payload = [
            "alg" => "HS256",
            "typ" => "JWT",
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'exp' =>  time()+3600,
            'data' => [$request->input('stu_id'),
                $stu_name
            ],
            'iat' => time(),
            'nbf' => time()
        ];
        $token = JWT::encode($payload, $key, 'HS256');
        return $token;
    }

    public static function encode_token($jwt,$key)
    {
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        return $decoded;
    }

    public static function dd(hsq_yanzhen_denlu $request)
    {

        $stu_id = $request->input('stu_id');
        $password = $request->input('password');

        $gg = hsq_student::hsq_denglus($stu_id,$password);
        if($gg=='0')//账号密码输入有误
        {
            return response()->json(['data'=>'账号密码有误','code'=>100]);
        }
        $data=$gg->getData();
        $data=$data->data;//取出查询的数据
        $token=self::creat_token($request);//生成token
        return response()->json(['data'=>$data,'token'=>$token,'code'=>200]);
    }
}
