<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

/**
 * =================================================================================================
 *  RouteServiceProvider (The "Traffic Controller")
 * =================================================================================================
 * 
 *  ANALOGY:
 *  Think of this as the "Traffic System" of your city.
 *  It decides which roads (routes) exist and rules for them (speed limits/rate limiting).
 *  
 *  It loads two main maps:
 *  1. api.php (The Highway) - Fast, stateless, usually for mobile apps or JavaScript.
 *  2. web.php (The Scenic Route) - Has sessions, cookies, and views (HTML).
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     *  The "Home" Address.
     *  Where do we send people after they successfully login?
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    /**
     *  Boot: Open the maps.
     *  This function actually loads the route files.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // LOAD API ROUTES (routes/api.php)
            // - Prefix 'api': All URLs will start with /api (e.g., /api/user)
            // - Middleware 'api': Applies API-specific rules (like throttling)
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            // LOAD WEB ROUTES (routes/web.php)
            // - Middleware 'web': Applies web rules (cookies, sessions, CSRF protection)
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    /**
     *  Rate Limiting (The Speed Limit)
     *  
     *  ANALOGY:
     *  "You can only ask 60 questions per minute."
     *  If you ask more, we stop you (429 Too Many Requests). This prevents spam.
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
