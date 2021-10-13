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
    return view('front.home');
})->name('home');
Route::get('/news', function () {
    return view('front.news');
})->name('news');
Route::get('/news/{slug}', function () {
    return view('front.news-detail');
})->name('news_detail');
Route::get('/kementrian', function () {
    return view('front.kementrian');
})->name('kementrian');
Route::get('/aboutus', function () {
    return view('front.aboutus');
})->name('aboutus');
Route::get('/contactus', function () {
    return view('front.contactus');
})->name('contactus');

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

        Route::prefix('down_stream_institutions')->name('down_stream_institutions.')->group(function(){
            Route::get('/', [BackAdmin\DownStreamInstitutionController::class, 'index'])->name('index');
            Route::post('/add', [BackAdmin\DownStreamInstitutionController::class, 'add'])->name('add');
            Route::delete('{id}/delete', [BackAdmin\DownStreamInstitutionController::class, 'delete'])->name('delete');
        });

        Route::prefix('notifications')->name('notifications.')->group(function() {
            Route::put('/{notification}/process-downstream', [BackAdmin\NotificationController::class, 'processDownstream'])->name('process-downstream');
        });

        Route::resources([
            'border_control_infos' => BackAdmin\BorderControlInfoController::class,
            'dangerous_infos' => BackAdmin\DangerousInfoController::class,
            'downstreams' => BackAdmin\DownStreamNotificationController::class,
            'notifications' => BackAdmin\NotificationController::class,
            'issue_notifications' => BackAdmin\IssueNotificationController::class,
            'follow_up_issues' => BackAdmin\FollowUpIssueController::class,
            'news' => BackAdmin\NewsController::class,
            'risk_infos' => BackAdmin\RiskInfoController::class,
            'traceability_lot_infos' => BackAdmin\TraceabilityLotInfoController::class,
            'sliders' => BackAdmin\SliderController::class,
        ]);

         // Get select2 options
         Route::prefix('s2opt')->name('s2Opt.')->group(function () {
            Route::get('countries', [Controller\CountryController::class, 'getS2Options'])->name('countries');
            Route::get('institutions', [BackAdmin\InstitutionController::class, 'getS2Options'])->name('institutions');
        });

        // Get select2 initial value
        Route::prefix('s2init')->name('s2Init.')->group(function () {
            Route::get('countries', [Controller\CountryController::class, 'getS2Init'])->name('countries');
            Route::get('institutions', [BackAdmin\InstitutionController::class, 'getS2Init'])->name('institutions');
        });
    });
});
