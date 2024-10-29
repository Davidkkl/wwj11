<?php

use App\Http\Controllers\WwjController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WdwController;

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
Route::delete('usershanchu/paper_stars/{student_id}', [\App\Http\Controllers\MhwController::class, 'Mhwshanchu']);//学生删除操作
Route::get('userchaxun/paper_stars/{student_id}', [\App\Http\Controllers\MhwController::class, 'Mhwpapershanxun']);//学生查询操作

//管理员导出Excel表
Route::get('admin/export-company-star', [WwjController::class, 'exportCompanyStar']);
Route::get('admin/export-paper-star', [WwjController::class, 'exportPaperStar']);
Route::get('admin/export-research-star', [WwjController::class, 'exportResearchStar']);
Route::get('admin/export-software-star', [WwjController::class, 'exportSoftwareStar']);
Route::get('admin/export-competition-star', [WwjController::class, 'exportCompetitionStar']);

//管理员查询双创之星
Route::get('admin/company_stars', [WwjController::class, 'ViewCompanyStar']);

//删除双创之星报名接口
Route::delete('student/delete_company_stars', [WwjController::class, 'deleteCompanyStar']);

//wdw
//学生报名竞赛之星
Route::POST('/student/competition/create_competition/{student_id}', [WdwController::class, 'create_competition']);

//学生查询竞赛之星信息
Route::GET('/student/competition', [WdwController::class, 'check_competition']);
//学生修改竞赛之星信息
Route::POST('/student/competition/{student_id}', [WdwController::class, 'revise_competition']);
//学生删除竞赛之星信息
Route::DELETE('/student/competition/{student_id}', [WdwController::class, 'delete_competition']);

//学生报名科研之星项目
Route::POST('/student/research/create_project/{student_id}', [WdwController::class, 'create_research_project']);
//学生查询科研之星项目
Route::GET('/student/research/project', [WdwController::class, 'check_research_project']);
//学生修改科研之星项目
Route::POST('/student/research/project/{student_id}', [WdwController::class, 'revise_research_project']);
//学生删除科研之星项目
Route::DELETE('/student/research/project/{student_id}', [WdwController::class, 'delete_research_project']);

//学生报名科研之星论文
Route::POST('/student/research/create_paper/{student_id}', [WdwController::class, 'create_research_paper']);
//学生修改科研之星论文
Route::POST('/student/research/paper/{student_id}', [WdwController::class, 'revise_research_paper']);

//学生报名科研之星软件
Route::POST('/student/research/create_software/{student_id}', [WdwController::class, 'create_research_software']);
//学生修改科研之星软件
Route::POST('/student/research/software/{student_id}', [WdwController::class, 'revise_research_software']);

//学生报名双创之星
Route::POST('/student/innovation/create_innovation/{student_id}', [WdwController::class, 'create_company']);
//学生修改双创之星
Route::POST('/student/innovation/{student_id}', [WdwController::class, 'revise_company']);


//老师查看竞赛之星状态
Route::GET('/admin/students', [WdwController::class, 'teacher_check_competition']);
//老师修改状态
Route::POST('/admin/students/{student_id}/status', [WdwController::class, 'revise_application_status']);


Route::get('/search', [WdwController::class, 'search']);

//老师查看竞赛之星状态
Route::GET('/admin/students', [WdwController::class, 'teacher_check_competition']);
