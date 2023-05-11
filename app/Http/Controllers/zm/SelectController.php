<?php

namespace App\Http\Controllers\zm;

use App\Http\Controllers\Controller;
use App\Models\zm\le_re;

class SelectController extends Controller
{
    public  function  zmsearch()//获取所有假条信息
    {
    $res=le_re::zmselectle();
    $res=$res[0];

        return $res ?
            json_success('查询成功!',$res,200):
            json_fail('查询失败!',null,100);
    }
}
