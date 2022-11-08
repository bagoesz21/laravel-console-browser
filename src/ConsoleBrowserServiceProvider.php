<?php

namespace Bagoesz21\ConsoleBrowser;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ConsoleBrowserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app['request']->is('console') and $this->app['request']->getMethod() == 'POST') {
            $this->app->bind(
                Illuminate\Contracts\Debug\ExceptionHandler::class,
                Bagoesz21\ConsoleBrowser\Handler::class
            );
        }

        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'console-browser'
        );

        // Attach Console events
        Console::attach();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $middlewareMethod = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';
        $router->$middlewareMethod('console_protect', Http\Middlewares\Console::class);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'console-browser');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('console-browser.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/console-browser'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../resources/lang' => $this->app->langPath('vendor/console-browser'),
        ], 'lang');

        $this->loadViewsFrom(
            __DIR__.'/../resources/views', 'console-browser'
        );

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/console-browser'),
        ], 'view');

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
