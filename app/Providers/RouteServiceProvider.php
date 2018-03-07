<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('alias','[\w[-_]]+');

        parent::boot();

        Route::bind('page', function ($value) {
            return \App\Page::where('alias',$value)->first();
        });

        Route::bind('server', function ($value) {
            return \App\Server::where('alias',$value)->first();
        });

        Route::bind('nomination', function ($value) {
            return \App\Nomination::where('alias',$value)->first();
        });

        Route::bind('user', function ($value) {
            return \App\User::find($value);
        });

        Route::bind('application', function ($value) {
            return \App\Application::find($value);
        });

        Route::bind('partner', function ($value) {
            return \App\Partner::find($value);
        });

        Route::bind('ad', function ($value) {
            return \App\Ad::find($value);
        });

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
