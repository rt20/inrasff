<?php

namespace App\Providers;

use Carbon\Carbon;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\NotificationService;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('backadmin.downstream.form', function ($view) {
            
            $a_notification_status = NotificationService::notificationStatus();
            $a_notification_base = NotificationService::notificationBase();
            $a_notification_source_local = NotificationService::notificationSource();
            $a_notification_source_interlocal = NotificationService::notificationSource('interlocal');
            $a_product_category = NotificationService::productCategory();

            $view->with([
                'a_notification_status' => $a_notification_status,
                'a_notification_base' => $a_notification_base,
                'a_notification_source_local' => $a_notification_source_local,
                'a_notification_source_interlocal' => $a_notification_source_interlocal,
                'a_product_category' => $a_product_category,
            ]);
        });
    }
}
