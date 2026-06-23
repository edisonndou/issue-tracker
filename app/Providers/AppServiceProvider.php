<?php

namespace App\Providers;

use App\Models\Project;
use App\Policies\ProjectPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    //----------
    protected $policies = [
        Project::class => ProjectPolicy::class,
    ];
    //----------
    public function register(): void
    {
        //
    }
    //----------
    public function boot(): void
    {
        $this->registerPolicies();
    }
    //----------
    public function registerPolicies(): void
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
