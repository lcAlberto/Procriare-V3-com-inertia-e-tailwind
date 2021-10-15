<?php

namespace App\Providers;

use App\Enums\UserRolesEnum;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';

    protected $namespace = 'App\\Http\\Controllers';

    public function boot()
    {
        /*
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });*/

        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        $this->mapUnauthenticatedWebRoutes();
        $this->mapAuthenticatedWebRoutes();
        $this->mapPaginationRoutes();
        $this->mapAjaxRoutes();

        $this->mapRootAdminRoutes();
        $this->mapAdminRoutes();
        $this->mapClientRoutes();
    }


    protected function mapRootAdminRoutes()
    {
        Route::namespace($this->namespace . '\Root')
            ->middleware(['web', 'auth', 'role:' . UserRolesEnum::ROOT])
            ->group(function () {
                Route::name('ajax.root.')
                    ->prefix('ajax/root')
                    ->group(base_path('routes/web/root/ajax.php'));

                Route::name('root.')
                    ->prefix('root')
                    ->group(base_path('routes/web/root/authenticated.php'));

                Route::name('root.pagination.')
                    ->prefix('pagination/root')
                    ->group(base_path('routes/web/root/pagination.php'));
            });
    }


    protected function mapAdminRoutes()
    {
        Route::namespace($this->namespace . '\Admin')
            ->middleware(['web', 'auth', 'role:' . UserRolesEnum::ADMIN])
            ->group(function () {
                Route::name('ajax.admin.')
                    ->prefix('ajax/admin')
                    ->group(base_path('routes/web/admin/ajax.php'));

                Route::name('admin.')
                    ->prefix('admin')
                    ->group(base_path('routes/web/admin/authenticated.php'));

                Route::name('admin.pagination.')
                    ->prefix('pagination/admin')
                    ->group(base_path('routes/web/admin/pagination.php'));
            });
    }

    protected function mapClientRoutes()
    {
        $rolesAllowed = implode(',', [UserRolesEnum::CLIENT]);

        Route::namespace($this->namespace . '\Client')
            ->middleware(['web', 'auth', "role:{$rolesAllowed}"])
            ->group(function () {
                Route::name('ajax.client.')
                    ->prefix('ajax/client')
                    ->group(base_path('routes/web/client/ajax.php'));

                Route::name('client.')
                    ->prefix('client')
                    ->group(base_path('routes/web/client/authenticated.php'));

                Route::name('client.pagination.')
                    ->prefix('pagination/client')
                    ->group(base_path('routes/web/client/pagination.php'));
            });
    }

    protected function mapUnauthenticatedWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/shared/unauthenticated.php'));
    }

    protected function mapAuthenticatedWebRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web/shared/authenticated.php'));
    }

    protected function mapPaginationRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->prefix('pagination')
            ->group(base_path('routes/web/shared/pagination.php'));
    }

    protected function mapAjaxRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->name('ajax.')
            ->namespace($this->namespace)
            ->prefix('ajax')
            ->group(base_path('routes/web/shared/ajax.php'));
    }

    protected function mapApiRoutes()
    {
        $this->mapApiV1Routes();
    }

    protected function mapApiV1Routes()
    {
        $namespace = $this->namespace . '\Api\v1';

        Route::prefix('api/v1')
            ->middleware(['api', 'auth:sanctum'])
            ->namespace($namespace)
            ->group(base_path('routes/api/v1/authenticated.php'));

        Route::prefix('api/v1')
            ->middleware('api')
            ->namespace($namespace)
            ->group(base_path('routes/api/v1/unauthenticated.php'));
    }


    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
