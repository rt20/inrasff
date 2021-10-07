<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackAdmin;
use App\Http\Controllers as Controller;

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

Route::get('/country', function()
{
	$countries =  Countries::getList('id', 'php');

    return $countries;
});
Route::get('/country-one', function()
{
    try {
        return Countries::getOne('XTC', 'id');    
    } catch (\Exception $e) {
        return $e->getMessage();
    }
	
});

Route::prefix('backadmin')->name('backadmin.')->group(function() {

    Route::get('login', [BackAdmin\LoginController::class, 'index'])->name('auth.index');
    Route::post('login', [BackAdmin\LoginController::class, 'login'])->name('auth.login');
    Route::get('logout', [BackAdmin\LoginController::class, 'logout'])->name('auth.logout');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [BackAdmin\DashboardController::class, 'index'])->name('dashboard');


        // Slider
        Route::post('sliders/slider-image/store', [BackAdmin\SliderController::class, 'uploadImage'])->name('sliders.slider_image.store');
        Route::delete('sliders/{slider}/slider-image/destroy', [BackAdmin\SliderController::class, 'deleteImage'])->name('sliders.slider_image.destroy');
        
        Route::prefix('issue_notifications')->name('issue_notifications.')->group(function() {
            Route::get('{id}/setting', [BackAdmin\IssueNotificationController::class, 'setting'])->name('setting');
        });

        Route::resources([
            'downstreams' => BackAdmin\DownStreamNotificationController::class,
            'notifications' => BackAdmin\NotificationController::class,
            'issue_notifications' => BackAdmin\IssueNotificationController::class,
            'follow_up_issues' => BackAdmin\FollowUpIssueController::class,
            'news' => BackAdmin\NewsController::class,
            'sliders' => BackAdmin\SliderController::class,
        ]);

         // Get select2 options
         Route::prefix('s2opt')->name('s2Opt.')->group(function () {
            Route::get('countries', [Controller\CountryController::class, 'getS2Options'])->name('countries');
        });

        // Get select2 initial value
        Route::prefix('s2init')->name('s2Init.')->group(function () {
            Route::get('countries', [Controller\CountryController::class, 'getS2Init'])->name('countries');
        });
    });
});
