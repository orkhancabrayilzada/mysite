<?php

namespace App\Modules\admin\About\Provider;

use Illuminate\Support\ServiceProvider;

class AboutProvider extends ServiceProvider
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
        $this->loadViewsFrom(base_path('app/Modules/Admin/About/Resources/Views'), 'About');
    }
}
