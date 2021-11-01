<?php

use App\Http\Controllers\FeedBackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include 'admin.php';
include "site.php";
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

Route::post('restaurant/{restaurant}/menu-items/{menuItem}/feedbacks', [FeedBackController::class, 'store']);
