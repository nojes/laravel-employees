<?php
namespace nojes\employees;

use Illuminate\Database\Seeder;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use nojes\employees\Models\Employee;
use nojes\employees\Models\Position;

/**
 * Employees Service Provider.
 *
 * @see http://laravel.com/docs/master/packages#service-providers
 * @see http://laravel.com/docs/master/providers
 */
class EmployeesServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @see http://laravel.com/docs/master/providers#deferred-providers
     * @var bool
     */
    protected $defer = false;

    /**
     * @var string Views path.
     */
    protected $viewsPath = 'resources/views/';

    /**
     * @var array
     */
    protected $commands = [
        \nojes\employees\Console\InstallCommand::class,
        \nojes\employees\Console\SeedCommand::class,
    ];

    /**
     * Register the service provider.
     *
     * @see http://laravel.com/docs/master/providers#the-register-method
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);

        $this->viewsPath = (!empty(config('employees.views.path')))
            ? base_path(config('employees.views.path'))
            : $this->packagePath($this->viewsPath);
    }

    /**
     * Application is booting
     *
     * @see http://laravel.com/docs/master/providers#the-boot-method
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerMigrations();
//        $this->registerSeeds();
        $this->registerFactories();
        $this->registerAssets();
        $this->registerTranslations();
        $this->registerConfigurations();

        if(! $this->app->routesAreCached() && config('employees.routes')) {
            $this->registerRoutes();
        }
    }

    /**
     * Register the package views
     *
     * @see http://laravel.com/docs/master/packages#views
     * @return void
     */
    protected function registerViews()
    {
        if(!config('employees.publish.views')) {
            $this->loadViewsFrom($this->viewsPath, 'employees');
        } else {
            $this->publishes([
                $this->packagePath('resources/views') => base_path('resources/views/vendor/employees/'),
            ], 'views');
        }
    }

    /**
     * Register the package migrations
     *
     * @see http://laravel.com/docs/master/packages#publishing-file-groups
     * @return void
     */
    protected function registerMigrations()
    {
        if(!config('employees.publish.migrations')) {
            $this->loadMigrationsFrom($this->packagePath('database/migrations'));
        } else {
            $this->publishes([
                $this->packagePath('database/migrations') => database_path('/migrations')
            ], 'migrations');
        }
    }

    /**
     * Register the package database seeds
     *
     * @return void
     */
    protected function registerSeeds()
    {
        if(!config('employees.publish.seeds')) {
            $this->app->make(Seeder::class)->load($this->packagePath('database/seeds'));
        } else {
            $this->publishes([
                $this->packagePath('database/seeds') => database_path('/seeds')
            ], 'seeds');
        }
    }

    /**
     * Register the package public assets
     *
     * @see http://laravel.com/docs/master/packages#public-assets
     * @return void
     */
    protected function registerAssets()
    {
        $this->publishes([
            $this->packagePath('resources/assets') => public_path('vendor/nojes/employees'),
        ], 'public');
    }

    /**
     * Register the package public assets
     *
     * @see http://laravel.com/docs/master/packages#public-assets
     * @return void
     */
    protected function registerFactories()
    {
        $this->app->make(EloquentFactory::class)->load($this->packagePath('database/factories'));

        if(config('employees.publish.factories')) {
            $this->publishes([
                $this->packagePath('database/factories') => database_path('/factories'),
            ], 'public');
        }
    }

    /**
     * Register the package translations
     *
     * @see http://laravel.com/docs/master/packages#translations
     * @return void
     */
    protected function registerTranslations()
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'employees');
    }

    /**
     * Register the package configurations
     *
     * @see http://laravel.com/docs/master/packages#configuration
     * @return void
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/config.php'), 'employees'
        );
        $this->publishes([
            $this->packagePath('config/config.php') => config_path('employees.php'),
        ], 'config');
    }

    /**
     * Register the package routes
     *
     * @warn consider allowing routes to be disabled
     * @see http://laravel.com/docs/master/routing
     * @see http://laravel.com/docs/master/packages#routing
     * @return void
     */
    protected function registerRoutes()
    {
        $this->app['router']->group([
            'namespace' => __NAMESPACE__,
            'middleware' => ['web'],
            'prefix' => 'employees'
        ], function(Router $router) {
            /*
             * Other
             */
            $router->get('employee/tree', 'Http\Controllers\EmployeeController@tree')->name('employee.tree');
            $router->get('employee/{id}/tree/item/children', 'Http\Controllers\EmployeeController@treeItemChildren')->name('employee.tree.item');
            $router->post('employee/tree/update', 'Http\Controllers\EmployeeController@updateTree')->name('employee.tree.update');

            /*
             * Web resources
             */
            $router->resource('employee', 'Http\Controllers\EmployeeController');
            $router->resource('position', 'Http\Controllers\PositionController');

            /*
             * API resources
             */
            $router->resource('api/employee', 'Http\Controllers\API\EmployeeController');
            $router->resource('api/position', 'Http\Controllers\API\PositionController');
        });
    }

    /**
     * Loads a path relative to the package base directory
     *
     * @param string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/../%s", __DIR__ , $path);
    }
}
