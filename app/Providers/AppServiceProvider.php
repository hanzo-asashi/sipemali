<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Model::handleLazyLoadingViolationUsing(static function ($model, $relation) {
            $class = get_class($model);

            info("Attempted to lazy load [{$relation}] on model [{$class}].");
            Debugbar::info("Attempted to lazy load [{$relation}] on model [{$class}].");
//            clock()->info("Attempted to lazy load [{$relation}] on model [{$class}].");
        });

        /* Seacrh on every model macro */
//        Builder::macro('whereLike', function (string $attribute, string $searchTerm) {
//            return $this->orWhere($attribute,'LIKE',"%{$searchTerm}%");
//        });
    }
}
