<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hsq;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/enroll',[hsq\hsq_enroll::class,'add_user']);
Route::any('/login',[hsq\hsq_login::class,'dd']);
Route::any('/hsqsenddemail',[hsq\hsq_enroll::class,'hsq_send_email']);
//Route::post('/hsqsenddemail','hsq\hsq_enroll@lsf_send_email');

Route::any('/ad_login',[hsq\hsq_admin_login::class,'dd']);

Route::get('all_stu','zm\AllinfoController@zmSelect');
Route::get('lea_search','zm\SelectController@zmsearch');
Route::any('change','zm\AllinfoController@zmchangetable');

Route::post('/stu_search',[\App\Http\Controllers\wt\wtSelStuController::class, 'find_stu']);
Route::post('/cause',[\App\Http\Controllers\wt\wtAddStuController::class, 'insert_stu_why']);
Route::get('/check',[\App\Http\Controllers\wt\wtSelStateController::class, 'stu_state']);

Route::post('/correcting','Lsf\AdminController@lsf_correct');
Route::post('email','Lsf\AdminController@lsf_send_email');
Route::post('/forgetpwd','Lsf\AdminController@lsf_up_paw');
Route::post('/search_le','Lsf\AdminController@lsf_search_le');

