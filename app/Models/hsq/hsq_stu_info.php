<?php

namespace App\Models\hsq;

use Illuminate\Database\Eloquent\Model;

class hsq_stu_info extends Model
{
    protected $table = 'stu_info';
    protected $primaryKey = 'id';
    protected $fillable = ['stu_id','stu_name','stu_class','email','phone_num','teacher'];
    public $timestamps = true;
    public static function hsq_insert_student($request)
    {
        try {
            self::create(['stu_id'=>$request->input('stu_id'),'stu_name'=>$request->input('stu_name'),
                'stu_class'=>$request->input('stu_class'), 'email'=>$request->input('email'),
                'phone_num'=>$request->input('phone_num'),'teacher'=>$request->input('teacher')]);

        }
        catch (\Exception $e)
        {
            return 0;
        }
        return 1;
    }

    public static function dd1($request)
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

    //通过学号查找姓名
    public static function hsq_select_stu_name($stu_id)
    {

        try {

            $res = self::where('stu_id',$stu_id)->value('stu_name');
            if ($res!=null){
                return $res;
            }else{
                return false;
            }

        }catch (\Exception $e){
            logError('操作失败',[$e->getMessage()]);
            return false;
        }


    }
}
