<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Admin\Auth\PusherController;

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
Route::prefix('v1')->group(function () {
    Route::group(['as' => 'api.'], function () {
        Route::middleware(['auth:sanctum'])->group(function () {
            /*
            |----------------------------------------------
            | Message
            |----------------------------------------------
            |
            */
            Route::prefix('messages')->name('messages.')->group(function () {
                Route::post('store', [MessageController::class, 'store'])->name('store');
                Route::patch('{id}/update', [MessageController::class, 'update'])->name('update');
                Route::get('show/{channel}', [MessageController::class, 'show'])->name('show');
                Route::get('show-left/{channel}', [MessageController::class, 'showChannelList'])->name('showLeft');
                Route::get('show-message/{channel}/msg', [MessageController::class, 'showMessage'])->name('showMessage');
                Route::post('send-message/{channel}', [MessageController::class, 'sendMessage'])->name('sendMessage');
                Route::get('update-read/{channelId}', [MessageController::class, 'updateRead'])->name('updateRead');
                Route::get('channels', [MessageController::class, 'index'])->name('index');
                Route::post('channel-create', [MessageController::class, 'channelCreate'])->name('channelCreate');
            });
            Route::post('pusher/auth', [PusherController::class, 'postAuth'])->name('auth.check');
        });
    });
});
