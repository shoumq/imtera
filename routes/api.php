<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/admin/create_answer', [AdminController::class, 'createAnswer']);
Route::post('/admin/delete_answer', [AdminController::class, 'deleteAnswer']);
Route::post('/admin/update_answer', [AdminController::class, 'updateAnswer']);
Route::post('/admin/update_design', [AdminController::class, 'updateDesign']);
