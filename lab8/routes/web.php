<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\ImageController;
use \App\Http\Controllers\CommentsController;

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

Route::get('/', [UserController::class,'openHomePage'])->name('home');

Route::get('/upload', [UserController::class, 'openUploadingPage'])->name('upload');

Route::get('/authorize', [UserController::class, 'openAuthorizationPage'])->name('authorize');

Route::get('/register', [UserController::class, 'openRegistrationPage']);

Route::get('/reset', [UserController::class, 'openResetPasswordPage'])->name('reset');

Route::post('/register/registerUser', [UserController::class, 'registerUser']);

Route::get('/logout', [UserController::class, 'logout']);

Route::post('/authorize/check', [UserController::class, 'checkUser']);

Route::post('reset/changePassword', [UserController::class, 'resetPassword']);

Route::post('/upload/addImage', [ImageController::class, 'uploadImage']);

Route::get('/photo/{id}', [ImageController::class, 'openPhotoPage'])->name('photo');

Route::get('/view/{id}', [ImageController::class, 'viewPhoto']);

Route::post('/leaveComment/{id}', [CommentsController::class, 'leaveComment']);

Route::get('/edit/{id}', [ImageController::class, 'openEditingPage'])->name('edit');

Route::post('/completeEditing/{id}', [ImageController::class, 'editPicture']);

Route::get('/tables', [UserController::class, 'openTablesPage'])->name('tables');

Route::get('/editUser/{id}', [UserController::class, 'openUserEditingPage']);

Route::post('/confirmUsersChanges/{id}', [UserController::class, 'updateUser']);

Route::get('/editComment/{id}', [UserController::class, 'openCommentEditingPage']);

Route::post('/confirmCommentChanges/{id}', [CommentsController::class, 'updateComment']);
