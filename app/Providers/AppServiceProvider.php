<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Gate;

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
        Model::preventLazyLoading();
        //Paginator::useBootstrapThree();

        // Gate::define('edit-job', function (User $user, Job $job) { // gate needs to return bool.
        //     return $job->employer->user->is($user);
        // });
        // adding gates to the app service provider will make them accessible anywhere
    }
}
