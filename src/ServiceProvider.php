<?php

namespace Datlv\Layout;

use Illuminate\Routing\Router;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use MenuManager;

/**
 * Class ServiceProvider
 *
 * @package Datlv\Layout
 */
class ServiceProvider extends BaseServiceProvider
{
    public function boot(Router $router)
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'layout');
        $this->loadViewsFrom(__DIR__.'/../views', 'layout');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/vendor/layout'),
            __DIR__.'/../lang' => base_path('resources/lang/vendor/layout'),
            __DIR__.'/../config/layout.php' => config_path('layout.php'),
        ]);

        // pattern filters
        $router->pattern('widget', '[0-9]+');
        // model bindings
        $router->model('widget', Widget::class);
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        MenuManager::addItems(config('layout.menus'));
        app('layout')->sidebarGroup(config('layout.sidebarGroups'));
        app('layout')->registerSidebars(config('layout.customSidebars') + config('layout.sidebars'));
        app('layout')->registerWidgetTypes(config('layout.widgetTypes'), config('layout.disableTypes'));
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/layout.php', 'layout');
        $this->app->singleton('layout', function () {
            return new Manager();
        });

        // add Layout,
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Layout', Facade::class);
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['layout'];
    }
}
