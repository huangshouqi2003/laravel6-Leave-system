<?php

namespace App\Models\hsq;

use App\Http\Controllers\Lsf\StuController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class hsq_student extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id';
    protected $fillable = ['stu_id','password'];
    public $timestamps = true;

    //查看账号密码是否相同
    public static  function hsq_denglus($stu_id,$password)
    {
        try {
            $stu_id=self::where('stu_id',$stu_id)->value('stu_id');//查询账号
            $ress = self::where('stu_id',$stu_id)->value('password');

            $re=StuController::decryptString($ress);
            if ($re == $password){
                return response()->json(['data'=>$stu_id],200);
            }else{
                return 0;
            }
        }catch (\Exception $e){
            logError('错误');
            return 0;
        }

    }
}
