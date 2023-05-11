<?php

namespace App\Models\hsq;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Exception;

class hsq_admin_login_cc extends Model
{
    protected $table = 'admin_login';
    protected $primaryKey = 'id';
    protected $fillable = ['stu_id','password'];
    public $timestamps = true;

    public static  function hsq_denglus($request)
    {
        try
        {
            $stu_id=self::firstwhere('stu_id',$request->input('stu_id'));//查询账号
        }
        catch (\Exception $e)
        {
            return 0;
        }
        if($stu_id==null)//都为空返回500
        {
            return 0;
        }
        else if($stu_id['password']!=$request->input('password'))
        {
            return 0;
        }
        else
        {
            return response()->json(['data'=>$stu_id],200);
        }

    }


//    public static function hsq_login($request)
//    {
//        try {
//            $res = self::where('stu_id',$request)->value('email');
//
//            if ($res == null){
//                return $res;
//
//            }else{
//                return 0 ;
//            }
//        }catch (\Exception $e){
//            logError('操作失败',[$e->getMessage()]);
//            return 0;
//        }
//    }
}
