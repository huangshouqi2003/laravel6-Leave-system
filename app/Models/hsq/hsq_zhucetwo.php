<?php

namespace App\Models\hsq;

use App\Http\Controllers\Lsf\StuController;
use Illuminate\Database\Eloquent\Model;


class hsq_zhucetwo extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id';
    protected $fillable = ['stu_id','password'];
    public $timestamps = true;
    public static function hsq_insert_password($request)
    {
        try {

            $stu_password = StuController::encryptString($request->input('password'));

            self::create(['stu_id'=>$request->input('stu_id'),'password'=>$stu_password]);
        }
        catch (\Exception $e)
        {
            return 0;
        }
        return 1;
    }
    public static function dd2($request)
    {
        try {
            self::where('stu_id',$request->input('stu_id'))->delete();
        }
        catch (\Exception $e)
        {
            return 0;
        }
        return 1;
    }
}
