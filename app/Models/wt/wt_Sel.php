<?php

namespace App\Models\wt;

use Illuminate\Database\Eloquent\Model;

class wt_Sel extends Model
{
    /*
 * 查询学生信息(id/name)
  */
    protected $table = 'stu_info';
    public $primaryKey = 'id';
    public $timestamps =true;
    protected $fillable = [
        'stu_id',
        'stu_name'
    ];

    public static function selBy_name($stu_name)    {
        try {
            $res = self::select()
                ->where('stu_name',$stu_name)
                ->orwhere('stu_id',$stu_name)
                ->get();
            return $res;
        }catch (\Exception $e)  {
            logError('查询学生信息失败',[$e->getMessage()]);
            return false;
        }
    }
}
