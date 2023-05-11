<?php

namespace App\Http\Controllers\wt;

use App\Http\Controllers\Controller;
use App\Http\Requests\wt\StateBlogPost;
use App\Models\wt\wt_Add;
use App\Models\wt\wt_Sel;
use Illuminate\Http\Request;



class wtAddStuController extends Controller
{
    /*
     * 用户请假理由
     * */
    public function insert_stu_why(StateBlogPost $request)    {

        //获取JWT
        $jwt = $request->header("authorization");

        if ($jwt == null){
            return json_fail('token无效或不存在',null,100);
        }else{
            //验证token
            $arr=AuthController::encode_token($jwt);
            try   {
                //获取登录数据
                $stu_id = $arr['data'][0];
                $stu_name = $arr['data'][1];

                $res = wt_Add::add_why($stu_id,$stu_name,$request['le_type'],$request['le_why'],$request['le_time_bg'],$request['le_time_end']);

                //刷新token
//            $token = AuthController::creat_token($stu_id, $stu_name);

                return $res ?
                    json_success('请假成功!',$res,200):
                    json_fail('请假失败!',$res,100);
//                response()->json(array('code' => 1, 'msg' => '请假成功', 'date' => $res), 200):
//                response()->json(array('code' => 0, 'msg' => '请假失败', 'date' => $res), 100);
            }catch (\Exception $e)   {
                return response()->json(['data'=>$arr]);

            }
        }

    }


}
