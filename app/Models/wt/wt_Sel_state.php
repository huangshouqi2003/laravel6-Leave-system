<?php

namespace App\Models\wt;

use Illuminate\Database\Eloquent\Model;

class wt_Sel_state extends Model
{
    /*
     * 用户查询审核状态
     * */
    protected $table = 'le_re';
    public $primaryKey = 'id';
    public $timestamps =true;
    protected $fillable = [
        'stu_id',
        'stu_name',
    ];

    public static function sel_stu_state($stu_name)  {
        try {
            $res = self::select('*')->where('stu_name','=',$stu_name)->orwhere('stu_id','=',$stu_name)->get();
            return $res;
        }catch (\Exception $e)  {
            logError('查询审核状态失败',[$e->getMessage()]);
            return false;
        }
    }

}
