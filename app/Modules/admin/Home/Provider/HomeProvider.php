<?php

namespace App\Modules\admin\Home\Provider;

use Illuminate\Support\ServiceProvider;

class HomeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(base_path('app/Modules/Admin/Home/Resources/Views'), 'Home');
    }
}
