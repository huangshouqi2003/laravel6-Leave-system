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
            $res = self::select("*")->where('stu_name','=',$stu_name)->orwhere('stu_id','=',$stu_name)->get();
            $arr = [
                "学号"=>$res[0]->stu_id,
                "姓名"=>$res[0]->stu_name,
                "申请时间"=>$res[0]->le_time_bg.'—'.$res[0]->le_time_end,
                "请假类型"=>$res[0]->le_type,
                "审批结果"=>$res[0]->le_state
            ];
            return $arr;
        }catch (\Exception $e)  {
            logError('查询审核状态失败',[$e->getMessage()]);
            return false;
        }
    }

}
