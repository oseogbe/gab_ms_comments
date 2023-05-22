<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function() {
    Route::post('/{postId}/comment', [CommentController::class, 'store']);
    Route::post('/{commentId}/reply', [CommentController::class, 'storeReply']);
    Route::get('/{postId}/comments', [CommentController::class, 'getCommentsForPost']);
});
