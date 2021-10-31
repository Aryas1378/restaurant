<?php

use App\Http\Controllers\FeedBackController;
use App\Models\FeedBack;
use Illuminate\Support\Facades\Route;

Route::prefix('/site')->middleware('auth:sanctum')->group(function (){

    Route::post('feedbacks', [FeedBackController::class, 'store'])
        ->middleware('can:create,' . FeedBack::class)
        ->name('site.feedbacks.store');

    Route::get('feedbacks', [FeedBackController::class, 'index'])
        ->middleware('can:viewAny,' . FeedBack::class)
        ->name('site.feedbacks.index');

    Route::get('feedbacks/{feedBack}', [FeedBackController::class, 'show'])
        ->middleware('can:view,feedBack')
        ->name('site.feedbacks.show');

    Route::patch('feedbacks/{feedBack}', [FeedBackController::class, 'update'])
        ->middleware('can:update,feedBack')
        ->name('site.feedbacks.update');

    Route::delete('feedbacks/{feedBack}', [FeedBackController::class, 'destroy'])
        ->middleware('can:delete,feedBack')
        ->name('site.feedbacks.destroy');

});
