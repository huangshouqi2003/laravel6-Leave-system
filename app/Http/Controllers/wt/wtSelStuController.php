<?php

namespace App\Http\Controllers\wt;

use App\Http\Controllers\Controller;
use App\Http\Requests\wt\SelBlogPost;
use App\Models\wt\wt_Add;
use App\Models\wt\wt_Sel;
use Illuminate\Http\Request;

class wtSelStuController extends Controller
{
    /*
 * 查询学生信息
  */

    public function find_stu(SelBlogPost $request)   {

        $res = wt_Sel::selBy_name($request['stu_name']);
        if (strlen(($res))==2)   {
            return response()->json(['data'=>'查询学生信息不存在！']);
        }else{
            return $res ?
                json_success('学生信息查询成功!',$res,200):
                json_fail('学生信息查询失败!',$res,100);
//                response()->json(array('code' => 1, 'msg' => '学生信息查询成功', 'date' => $res), 200):
//                response()->json(array('code' => 0, 'msg' => '学生信息查询失败', 'date' => $res), 100);
        }

    }

}
