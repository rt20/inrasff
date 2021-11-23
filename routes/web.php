<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackAdmin;
use App\Http\Controllers\FrontController;
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


// FRONTEND
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/news', [FrontController::class, 'news'])->name('news');
Route::get('/news/{slug}', [FrontController::class, 'newsDetail'])->name('news_detail');
Route::get('/kementrian', [FrontController::class, 'kementrian'])->name('kementrian');
Route::get('/aboutus', [FrontController::class, 'aboutus'])->name('aboutus');
Route::get('/logical', [FrontController::class, 'logical'])->name('logical');
Route::get('/baganalir', [FrontController::class, 'baganalir'])->name('baganalir');
Route::get('/contactus', [FrontController::class, 'contactus'])->name('contactus');

Route::get('/login', function(){
    return redirect()->route('backadmin.auth.index');
});

Route::get('/session', function(){
    return auth()->user();
});

Route::get('/mail', [Controller\TestController::class, 'mail']);
Route::get('/send-mail', [Controller\TestController::class, 'sendMail']);
// BACKEND


Route::prefix('backadmin')->middleware('anti-script-middleware')->name('backadmin.')->group(function() {
    
    Route::middleware('guest')->group(function () {
        Route::get('login', [BackAdmin\LoginController::class, 'index'])->name('auth.index');
        Route::post('login', [BackAdmin\LoginController::class, 'login'])->name('auth.login');
        
    });

    Route::middleware('auth', 'admin')->group(function () {
        Route::get('dashboard', [BackAdmin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('logout', [BackAdmin\LoginController::class, 'logout'])->name('auth.logout');

        // Slider
        Route::post('sliders/slider-image/store', [BackAdmin\SliderController::class, 'uploadImage'])->name('sliders.slider_image.store');
        Route::delete('sliders/{slider}/slider-image/destroy', [BackAdmin\SliderController::class, 'deleteImage'])->name('sliders.slider_image.destroy');
        
        Route::prefix('dangerous_samplings')->name('dangerous_samplings.')->group(function(){
            Route::get('/', [BackAdmin\DangerousSamplingInfoController::class, 'index'])->name('index');
            Route::post('/add', [BackAdmin\DangerousSamplingInfoController::class, 'add'])->name('add');
            Route::delete('{id}/delete', [BackAdmin\DangerousSamplingInfoController::class, 'delete'])->name('delete');
        });
        Route::prefix('down_stream_institutions')->name('down_stream_institutions.')->group(function(){
            Route::get('/', [BackAdmin\DownStreamInstitutionController::class, 'index'])->name('index');
            Route::post('/add', [BackAdmin\DownStreamInstitutionController::class, 'add'])->name('add');
            Route::delete('{id}/delete', [BackAdmin\DownStreamInstitutionController::class, 'delete'])->name('delete');
        });

        Route::prefix('up_stream_institutions')->name('up_stream_institutions.')->group(function(){
            Route::get('/', [BackAdmin\UpStreamInstitutionController::class, 'index'])->name('index');
            Route::post('/add', [BackAdmin\UpStreamInstitutionController::class, 'add'])->name('add');
            Route::delete('{id}/delete', [BackAdmin\UpStreamInstitutionController::class, 'delete'])->name('delete');
        });

        Route::prefix('down_stream_user_accesses')->name('down_stream_user_accesses.')->group(function(){
            Route::get('/', [BackAdmin\DownStreamUserAccessController::class, 'index'])->name('index');
            Route::post('/add', [BackAdmin\DownStreamUserAccessController::class, 'add'])->name('add');
            Route::delete('{id}/delete', [BackAdmin\DownStreamUserAccessController::class, 'delete'])->name('delete');
        });

        Route::prefix('up_stream_user_accesses')->name('up_stream_user_accesses.')->group(function(){
            Route::get('/', [BackAdmin\UpStreamUserAccessController::class, 'index'])->name('index');
            Route::post('/add', [BackAdmin\UpStreamUserAccessController::class, 'add'])->name('add');
            Route::delete('{id}/delete', [BackAdmin\UpStreamUserAccessController::class, 'delete'])->name('delete');
        });

        Route::prefix('notifications')->name('notifications.')->group(function() {
            Route::put('/{notification}/process-downstream', [BackAdmin\NotificationController::class, 'processDownstream'])->name('process-downstream');
            Route::put('/{notification}/process-upstream', [BackAdmin\NotificationController::class, 'processUpstream'])->name('process-upstream');
        });

        Route::prefix('follow_ups')->name('follow_ups.')->group(function() {
            Route::post('/add-attachment', [BackAdmin\FollowUpNotificationController::class, 'addAttachment'])->name('add-attachment');
            Route::delete('/{id}/delete-attachment', [BackAdmin\FollowUpNotificationController::class, 'deleteAttachment'])->name('delete-attachment');
            Route::post('/add-user-fu', [BackAdmin\FollowUpNotificationController::class, 'addUserFu'])->name('add-user-fu');
            Route::delete('/{id}/delete-user-fu', [BackAdmin\FollowUpNotificationController::class, 'deleteUserFu'])->name('delete-user-fu');
        });

        Route::prefix('downstreams')->name('downstreams.')->group(function() {
            Route::put('/{downstream}/process-ccp', [BackAdmin\DownStreamNotificationController::class, 'processCcp'])->name('process-ccp');
            Route::put('/{downstream}/back-ccp', [BackAdmin\DownStreamNotificationController::class, 'backCcp'])->name('back-ccp');
            Route::put('/{downstream}/process-ext', [BackAdmin\DownStreamNotificationController::class, 'processExt'])->name('process-ext');
            Route::put('/{downstream}/done', [BackAdmin\DownStreamNotificationController::class, 'done'])->name('done');
            Route::post('/add-attachment', [BackAdmin\DownStreamNotificationController::class, 'addAttachment'])->name('add-attachment');
            Route::delete('/{id}/delete-attachment', [BackAdmin\DownStreamNotificationController::class, 'deleteAttachment'])->name('delete-attachment');
            
        });

        Route::prefix('attachments')->name('attachments.')->group(function(){
            Route::get('{id}/notification-attachment', [BackAdmin\AttachmentController::class, 'viewNotificationAttachment'])->name('view-notification-attachment');
            Route::get('{id}/follow-up-attachment', [BackAdmin\AttachmentController::class, 'viewFollowUpAttachment'])->name('view-follow-up-attachment');
        });

        Route::prefix('upstreams')->name('upstreams.')->group(function() {
            Route::put('/{upstream}/process-ext', [BackAdmin\UpStreamNotificationController::class, 'processExt'])->name('process-ext');
            Route::put('/{upstream}/done', [BackAdmin\UpStreamNotificationController::class, 'done'])->name('done');
            Route::put('/{upstream}/back-open', [BackAdmin\UpStreamNotificationController::class, 'backOpen'])->name('back-open');
            Route::post('/add-attachment', [BackAdmin\UpStreamNotificationController::class, 'addAttachment'])->name('add-attachment');
            Route::delete('/{id}/delete-attachment', [BackAdmin\UpStreamNotificationController::class, 'deleteAttachment'])->name('delete-attachment');
        });

        Route::prefix('follow_ups')->name('follow_ups.')->group(function() {
            Route::put('/{followUp}/process', [BackAdmin\FollowUpNotificationController::class, 'process'])->name('process');
            Route::put('/{followUp}/accept', [BackAdmin\FollowUpNotificationController::class, 'accept'])->name('accept');
            Route::put('/{followUp}/reject', [BackAdmin\FollowUpNotificationController::class, 'reject'])->name('reject');
        });

        Route::resources([
            'border_control_infos' => BackAdmin\BorderControlInfoController::class,
            'dangerous_infos' => BackAdmin\DangerousInfoController::class,
            'downstreams' => BackAdmin\DownStreamNotificationController::class,
            'notifications' => BackAdmin\NotificationController::class,
            'institutions' => BackAdmin\InstitutionController::class,
            'follow_up_issues' => BackAdmin\FollowUpIssueController::class,
            'follow_ups' => BackAdmin\FollowUpNotificationController::class,
            'news' => BackAdmin\NewsController::class,
            'categories' => BackAdmin\CategoryController::class,
            'faq' => BackAdmin\FAQController::class,
            'kementrian' => BackAdmin\KementrianController::class,
            'risk_infos' => BackAdmin\RiskInfoController::class,
            'traceability_lot_infos' => BackAdmin\TraceabilityLotInfoController::class,
            'sliders' => BackAdmin\SliderController::class,
            'upstreams' => BackAdmin\UpStreamNotificationController::class,
            'users' => BackAdmin\UserController::class,
        ]);

         // Get select2 options
         Route::prefix('s2opt')->name('s2Opt.')->group(function () {
            Route::get('countries', [Controller\CountryController::class, 'getS2Options'])->name('countries');
            Route::get('institutions', [BackAdmin\InstitutionController::class, 'getS2Options'])->name('institutions');
            Route::get('institution-for-follow-ups', [BackAdmin\InstitutionController::class, 'getS2OptionsForFollowUp'])->name('institution_for_follow_ups');
            Route::get('notification-status', [BackAdmin\NotificationStatusController::class, 'getS2Options'])->name('notification_status');
            Route::get('notification-type', [BackAdmin\NotificationTypeController::class, 'getS2Options'])->name('notification_type');
            Route::get('notification-base', [BackAdmin\NotificationBaseController::class, 'getS2Options'])->name('notification_base');
            Route::get('dangerous-category', [BackAdmin\DangerousCategoryController::class, 'getS2Options'])->name('dangerous_category');
            Route::get('dangerous-category-level', [BackAdmin\DangerousCategoryLevelController::class, 'getS2Options'])->name('dangerous_category_level');
            Route::get('uom-result', [BackAdmin\UomResultController::class, 'getS2Options'])->name('uom_result');
            Route::get('distribution-status', [BackAdmin\DistributionStatusController::class, 'getS2Options'])->name('distribution_status');
            Route::get('category-news', [BackAdmin\CategoryController::class, 'getS2Options'])->name('category_news');
        });

        // Get select2 initial value
        Route::prefix('s2init')->name('s2Init.')->group(function () {
            Route::get('countries', [Controller\CountryController::class, 'getS2Init'])->name('countries');
            Route::get('institutions', [BackAdmin\InstitutionController::class, 'getS2Init'])->name('institutions');
            Route::get('notification-status', [BackAdmin\NotificationStatusController::class, 'getS2Init'])->name('notification_status');
            Route::get('notification-type', [BackAdmin\NotificationTypeController::class, 'getS2Init'])->name('notification_type');
            Route::get('notification-base', [BackAdmin\NotificationBaseController::class, 'getS2Init'])->name('notification_base');
            Route::get('dangerous-category', [BackAdmin\DangerousCategoryController::class, 'getS2Init'])->name('dangerous_category');
            Route::get('dangerous-category-level', [BackAdmin\DangerousCategoryLevelController::class, 'getS2Init'])->name('dangerous_category_level');
            Route::get('uom-result', [BackAdmin\UomResultController::class, 'getS2Init'])->name('uom_result');
            Route::get('distribution-status', [BackAdmin\DistributionStatusController::class, 'getS2Init'])->name('distribution_status');
            Route::get('category-news', [BackAdmin\CategoryController::class, 'getS2Init'])->name('category_news');
        });

        Route::prefix('datatables')->name('dt.')->group(function () {
            Route::get('attachment-fu', [BackAdmin\FollowUpNotificationController::class, 'attachmentDataTable'])->name('attachment_fu');
            Route::get('user-fu', [BackAdmin\FollowUpNotificationController::class, 'userFuDataTable'])->name('user_fu');
            Route::get('attachment-n-downstreams', [BackAdmin\DownStreamNotificationController::class, 'attachmentDataTable'])->name('attachment_n_downstreams');
            Route::get('attachment-n-upstreams', [BackAdmin\UpStreamNotificationController::class, 'attachmentDataTable'])->name('attachment_n_upstreams');
        });
    });
});
