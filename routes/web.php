<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GivenumberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('note', [NotesController::class,'index']);
Route::get('pdf', [NotesController::class,'pdf']);
Route::get('/',function() {
    return view('login');
})->name('login');

Route::get('/logout',[AccountController::class,'logout'])->name('logout');

Route::post('/login',[AccountController::class,'changePassword'])->name('confirm.forgetpassword');

Route::get('/forgetpassword',function() {
    return view('forgetpassword');
})->name('forgetpassword');

Route::post('/forgetpassword-confirm',[AccountController::class,'forgetpassword'])->name('forgetpassword.confirm');

Route::post('welcome',[AccountController::class,'login'])->name('welcome');

Route::get('/admin-info/{id}', [AccountController::class,'index'])->name('admin.info');

Route::post('/uploadImage', [AccountController::class,'uploadImage'])->name('uploadImage');

Route::get('/uploadImg', [AccountController::class,'uploadImg']);

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::get('/getData',[DashboardController::class,'select']);

Route::get('/equipment', [EquipmentController::class,'index'])->name('equipment');

Route::get('/equipment/search', [EquipmentController::class,'search']);

Route::get('/listService',[ServiceController::class,'listService']);
Route::get('/equipment/add', function () {
    return view('add-equipment',['isEquipment' => true]);
})->name('equipment.add');

Route::get('/equipment/update/{id}', [ EquipmentController::class,'updating'])->name('equipment.update');

Route::get('/equipment/detail/{id}',[ EquipmentController::class,'show'])->name('equipment.detail');

Route::post('add',[ EquipmentController::class,'create'])->name('add.equipment');

Route::post('update',[ EquipmentController::class,'edit'])->name('update.equipment');

Route::get('/service', [ServiceController::class,'index'])->name('service');

Route::get('/service/search', [ServiceController::class,'search']);

Route::get('/service/searchTime', [ServiceController::class,'searchTime']);

Route::get('/service/add', function () {
    return view('add-service',['isService' => true]);
})->name('service.add');

Route::get('/service/detail/{id}',[ServiceController::class,'show'])->name('service.detail');

Route::post('/addService',[ServiceController::class,'create'])->name('add.service');

Route::get('/service/update', [ServiceController::class,'updating'])->name('service.update');

Route::post('/updateService', [ServiceController::class,'update'])->name('update.service');

Route::get('/givenumber',[GivenumberController::class,'index'])->name('givenumber');

Route::get('/getnumber',[GivenumberController::class,'userGetNumber']);

Route::get('/givenumber/search',[GivenumberController::class,'search']);

Route::get('/givenumber/searchTime',[GivenumberController::class,'searchTime']);

Route::get('/givenumber/add',[GivenumberController::class,'creating'])->name('givenumber.add');

Route::get('/givenumber/detail/{stt}',[GivenumberController::class,'detail'])->name('givenumber.detail');

Route::get('/givenumber/update',function(){
    return view('givenumber',['isGivenumber'=> true]);
})->name('givenumber.update');
Route::get('/giveNumber',[GivenumberController::class,'create']);

Route::get('/report',[GivenumberController::class,'report'])->name('report');

Route::get('/download',[GivenumberController::class,'download'])->name('download');

Route::get('/manage/rule',[RoleController::class,'index'])->name('rule.management');

Route::get('/manage/rule/add',[RoleController::class,'creating'])->name('rule.add');

Route::get('/manage/rule/update/{id}',[RoleController::class,'updating'])->name('rule.update');

Route::post('/updateRole',[RoleController::class,'update'])->name('update.role');

Route::post('/createRole',[RoleController::class,'create'])->name('add.role');

//account
Route::get('/manage/account',[AccountController::class,'management'])->name('account');

Route::get('/manage/account/add',[AccountController::class,'creating'])->name('account.add');

Route::post('/createAccount',[AccountController::class,'create'])->name('add.account');

Route::get('/manage/account/update/{id}',[AccountController::class,'updating'])->name('account.update');

Route::post('/updateAccount',[AccountController::class,'edit'])->name('update.account');

Route::get('/account/search',[AccountController::class,'search']);
//diary
Route::get('/manage/diary',function(){
    return view('diary-user',['isInstall'=> true,'isDiary' => true]);
})->name('diary');
