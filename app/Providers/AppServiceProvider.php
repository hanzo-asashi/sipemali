<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\LivewireBladeDirectives;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $class = get_class($model);

            info("Attempted to lazy load [{$relation}] on model [{$class}].");
            Debugbar::info("Attempted to lazy load [{$relation}] on model [{$class}].");
        });

        /* Seacrh on every model macro */
        Builder::macro('whereLike', function (string $attribute, string $searchTerm) {
            return $this->orWhere($attribute,'LIKE',"%{$searchTerm}%");
        });
    }
}
