<?php

namespace App\Models\hsq;

use Illuminate\Database\Eloquent\Model;

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
        if($stu_id['stu_id']==null)//都为空返回500
        {
            return 0;
        }
        else if($stu_id['identity'])
        {
            return response()->json(['data'=>$stu_id,'identity'=>'1'],200);
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
}