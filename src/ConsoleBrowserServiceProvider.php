<?php
namespace Bagoesz21\ConsoleBrowser;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;


class ConsoleBrowserServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $middlewareMethod = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';
        $router->$middlewareMethod('console_protect', Http\Middlewares\Console::class);

        // Publish config.
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('console-browser.php'),
            __DIR__.'/../resources/assets' => base_path('public/vendor/console-browser'),
        ], 'public');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app['request']->is('console') and $this->app['request']->getMethod() == 'POST') {
            $this->app->bind(
                'Illuminate\Contracts\Debug\ExceptionHandler',
                'Bagoesz21\ConsoleBrowser\Handler'
            );
        }

        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'console-browser'
        );

        $this->loadViewsFrom(
            __DIR__.'/../resources/views', 'console-browser'
        );

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/console-browser'),
        ], 'view');

        if (! $this->app->routesAreCached()) {
            $group = [
                'namespace' => 'Bagoesz21\ConsoleBrowser',
                'middleware' => $this->app['config']['console']['middleware']
            ];

            \Route::group($group, function ($router) {
                require __DIR__ . '/routes.php';
            });
        }

        // Attach Console events
        Console::attach();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
