<?php

namespace App\Providers;

use App\Models\DownloadableForm;
use App\Observers\DownloadableFormObserver;
use App\View\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        DownloadableForm::observe(DownloadableFormObserver::class);

        // Register the navigation view composer with the navigation menu component
        View::composer('components.navigation-menu', NavigationComposer::class);
    }
}
