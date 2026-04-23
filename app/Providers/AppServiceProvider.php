<?php

namespace App\Providers;

use App\Models\DownloadableForm;
use App\Models\Consultation;
use App\Observers\DownloadableFormObserver;
use App\Policies\ConsultationPolicy;
use App\View\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Consultation::class => ConsultationPolicy::class ,
    ];

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
        // Register policies
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }

        // Register observers
        DownloadableForm::observe(DownloadableFormObserver::class);

        // Register the navigation view composer with the navigation menu component
        View::composer('components.navigation-menu', NavigationComposer::class);
    }
}