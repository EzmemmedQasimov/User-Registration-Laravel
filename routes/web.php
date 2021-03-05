<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUD;
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

Route::get('/',[CRUD::class,'index'])->name('esas');
Route::get('/qeydiyyat',[CRUD::class,'qeydiyyatgoster'])->name('qeydiyyatgoster');
Route::get('/siyahi',[CRUD::class,'siyahigoster'])->name('siyahigoster');
Route::post('/qeydiyyat-elave',[CRUD::class,'qeydiyyat'])->name('qeydiyyat');
Route::post('/qeydiyyat-email-yoxla',[CRUD::class,'EmailCheck'])->name('EmailCheck');
Route::post('/user-edit-view',[CRUD::class,'UserEditView'])->name('UserEditView');
Route::post('/user-update',[CRUD::class,'UserEdit'])->name('UserEdit');
Route::get('/user-delete/{id}',[CRUD::class,'UserDelete'])->name('UserDelete');


