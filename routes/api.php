<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BoardController;
use App\Http\Controllers\Api\TaskListController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\LabelController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EmailVerificationController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, PATCH, DELETE');
header('Access-Control-Allow-Headers: Accept, Content-Type, X-Auth-Token, Origin, Authorization');

//Auth
Route::post('auth/register', [AuthController::class, 'createUser']);
Route::post('auth/login', [AuthController::class, 'loginUser']);
Route::post('email/send-verification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('email/verify/{id}/{hash}/', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed', 'throttle:6,1']);

//Users
Route::get('users/by-board-id/{id}', [UserController::class, 'getUsersByBoardId'])->middleware('auth:sanctum');
Route::get('users/', [UserController::class, 'index'])->middleware('auth:sanctum');


//Board
Route::apiResource('boards', BoardController::class)->middleware('auth:sanctum');
Route::post('users/{user}/boards/{board}/assign', [BoardController::class, 'assignUser'])->middleware('auth:sanctum');
Route::post('users/{user}/boards/{board}/unassign', [BoardController::class, 'unassignUser'])->middleware('auth:sanctum');

//TaskList
Route::apiResource('tasklists', TaskListController::class)->middleware('auth:sanctum');

//Task
Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');
Route::post('users/{user}/tasks/{task}/assign', [TaskController::class, 'assignUser'])->middleware('auth:sanctum');
Route::post('users/{user}/tasks/{task}/unassign', [TaskController::class, 'unassignUser'])->middleware('auth:sanctum');

//Label
Route::apiResource('labels', LabelController::class)->middleware('auth:sanctum');
Route::post('tasks/{task}/labels/{label}/assign', [LabelController::class, 'assignLabel'])->middleware('auth:sanctum');
Route::post('tasks/{task}/labels/{label}/unassign', [LabelController::class, 'unassignLabel'])->middleware('auth:sanctum');