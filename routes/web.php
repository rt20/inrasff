<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackAdmin;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('backadmin')->name('backadmin.')->group(function() {
    // Route::get('login', [BackAdmin\LoginController::class, 'index'])->name('auth.index');
    // Route::post('login', [BackAdmin\LoginController::class, 'login'])->name('auth.login');
    // Route::get('logout', [BackAdmin\LoginController::class, 'logout'])->name('auth.logout');
    // Route::middleware('auth')->group(function () {
        Route::get('dashboard', [BackAdmin\DashboardController::class, 'index'])->name('dashboard');
    // });


    Route::resources([
        'issue_notifications' => BackAdmin\IssueNotificationController::class,
        'news' => BackAdmin\NewsController::class,
    ]);
});
