<?php

namespace App\Http\Controllers\wt;

use App\Http\Controllers\Controller;
use App\Models\wt\wt_Sel;
use App\Models\wt\wt_Sel_state;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
//use Illuminate\Http\Request;


class wtSelStateController extends Controller
{
    /*
 * 用户查询审核状态
 * */
    public function stu_state(Request $request) {
        //获取JWT
//        $jwt = $request->header();
        $jwt = $request->header("Authorization");
//        $result = substr($jwt,strripos($jwt," ")+1);
        //验证token
        $arr=AuthController::encode_token($jwt);
        if ($jwt!=null) {
            try   {
                //获取登录数据
                $stu_id = $arr['data'][0];
                $stu_name = $arr['data'][1];

                $res = wt_Sel_state::sel_stu_state($stu_id);
                $arr = [];
                for($i = 0; $i<= count($res); $i++) {
                    $arr_1 = [
                        "学号"=>$res[$i]->stu_id,
                        "姓名"=>$res[$i]->stu_name,
                        "申请时间"=>$res[$i]->le_time_bg.'—'.$res[$i]->le_time_end,
                        "请假类型"=>$res[$i]->le_type,
                        "审批结果"=>$res[$i]->le_state
                    ];
                    array_unshift($arr,$arr_1);
                }


                //刷新token
//            $token = AuthController::creat_token($stu_id, $stu_name);

                return $res ?
                    json_success('查询审核状态成功!',$arr,200):
                    json_fail('查询审核状态失败!',null,100);
//                    response()->json(array('code' => 1, 'msg' => '查询审核状态成功', 'date' => $res), 200):
//                    response()->json(array('code' => 0, 'msg' => '查询审核状态失败', 'date' => $res), 100);

            }catch (\Exception $e)   {
                return response()->json(['data'=>$arr]);

            }
        }else   {
            return json_success('token验证失败',$arr,200);
        }
    }

}
