<?php

namespace App\Models\wt;

use Illuminate\Database\Eloquent\Model;

class wt_Add extends Model
{
    /*
     * 用户请假理由
     * le_type-请假类型
        le_why-请假理由
        le_time_bg-请假开始时间
        le_time_end-请假结束时间
     * */
    protected $table = 'le_re';
    public $primaryKey = 'id';
    public $timestamps =true;
    protected $fillable = [
        'stu_id',
        'stu_name',
        'le_type',
        'le_why',
        'le_time_bg',
        'le_time_end',
        'le_state'
    ];

    public static function add_why($stu_id,$stu_name,$le_type,$le_why,$le_time_bg,$le_time_end)  {
        try {
            $res = self::create([
                'stu_id'=>$stu_id,
                'stu_name'=>$stu_name,
                'le_type'=>$le_type,
                'le_why'=>$le_why,
                'le_time_bg'=>$le_time_bg,
                'le_time_end'=>$le_time_end,
                'le_state'=>'审核中',

            ]);
            return $res;
        }catch (\Exception $e)  {
            logError('请假失败@!',[$e->getMessage()]);
            return false;
        }


    }
}
