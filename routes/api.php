<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\todoContoller;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//For Login and Signup
Route::post("sign_up", [userController::class, 'signUp']);
Route::post("sign_in", [userController::class, 'signIn']);
Route::post("update", [userController::class, 'updateUser']);
Route::post("delete", [userController::class, 'deleteUser']);

// For Todo
Route::post("add_todo", [todoContoller::class, 'addTodo']);
Route::post("update_todo", [todoContoller::class, 'updateTodo']);
Route::post("delete_todo", [todoContoller::class, 'deleteTodo']);
Route::post("get_todo", [todoContoller::class, 'getTodo']);