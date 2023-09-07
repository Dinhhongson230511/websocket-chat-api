<?php

use App\Http\Controllers\Admin\CourseRegistrationController;
use App\Http\Controllers\Admin\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TravelAgenciesController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\Auth\PusherController;

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

// admin
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

    /*
    |----------------------------------------------
    | Message
    |----------------------------------------------
    |
    */
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::post('store', [MessageController::class, 'store'])->name('store');
        Route::patch('{id}/update', [MessageController::class, 'update'])->name('update');
        Route::get('show/{channelId}', [MessageController::class, 'show'])->name('show');
        Route::get('show-left/{channel}', [MessageController::class, 'showChannelList'])->name('showLeft');
        Route::get('show-message/{channel}/msg', [MessageController::class, 'showMessage'])->name('showMessage');
        Route::post('send-message/{channel}', [MessageController::class, 'sendMessage'])->name('sendMessage');
        Route::get('update-read/{channelId}', [MessageController::class, 'updateRead'])->name('updateRead');
    });
});
