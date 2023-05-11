<?php

namespace App\Http\Controllers\wt;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
     * token方法
     * */


    //token验证
    public static function encode_token($jwt)
    {
        $key = 'hsq';
        try {
//            JWT::$leeway = 60;//当前时间减去60，把时间留点余地
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));//HS256方式，这里要和签发的时候对应
            $arr = (array)$decoded;
            return $arr;
        } catch (\Firebase\JWT\SignatureInvalidException $e) {  //签名不正确
            return $e->getMessage();
        } catch (\Firebase\JWT\BeforeValidException $e) {  // 签名在某个时间点之后才能用
            return $e->getMessage();
        } catch (\Firebase\JWT\ExpiredException $e) {  // token过期
            return $e->getMessage();
        } catch (\Exception $e) {  //其他错误
            return $e->getMessage();
        }
        //Firebase定义了多个 throw new，我们可以捕获多个catch来定义问题，catch加入自己的业务，比如token过期可以用当前Token刷新一个新Token
    }


    //生成token
    public static function creat_token($stu_id, $stu_name)
    {
        /*iss: jwt签发者
sub: jwt所面向的用户
aud: 接收jwt的一方
exp: jwt的过期时间，这个过期时间必须要大于签发时间
nbf: 定义在什么时间之前，该jwt都是不可用的.
iat: jwt的签发时间
jti: jwt的唯一身份标识，主要用来作为一次性token,从而回避重放攻击。
*/
        $key = 'hsq';
        $time = time();
        //公用信息
        $token = [
            "alg" => "HS256",
            "typ" => "JWT",
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'exp' => '',
            'data' => [
                $stu_id,
                $stu_name
            ],
            'iat' => time(),
            'nbf' => time()
        ];
        //刷新token
        $refresh_token = $token;
        $refresh_token['scopes'] = 'role_refresh'; //token标识，刷新access_token
        $refresh_token['exp'] = $time+600; //access_token过期时间,这里设置1小时

        $jsonList = [
            'refresh_token'=>JWT::encode($refresh_token,$key, 'HS256'),
        ];
        Header("HTTP/1.1 201 Created"); //请求已被接受，等待资源响应
        return $jsonList; //返回给客户端token信息

    }
}
