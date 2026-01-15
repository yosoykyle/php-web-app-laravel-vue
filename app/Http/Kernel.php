<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

// =================================================================================================
// Kernel.php (The "Traffic Police" or "Security Checkpoints")
// =================================================================================================
//
// ANALOGY:
// This file controls the flow of requests entering your application.
// Just like airport security checks every passenger before they board a plane,
// the Kernel runs "Middleware" checks on every request before it hits your Controller.
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * ANALOGY: "The Main Entrance Security"
     * Everyone (Web users, API bots) must go through these checks first.
     * - TrustProxies: Handling requests behind a load balancer.
     * - HandleCors: Allowing other websites to talk to us.
     * - TrimStrings: Cleaning up input (removing extra spaces).
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * ANALOGY: "Specialized Security Lines"
     *
     * 'web': The line for human users in browsers.
     * - EncryptCookies: Securing data stored in the browser.
     * - StartSession: Remembering who the user is (Login state).
     * - VerifyCsrfToken: preventing malicious form submissions.
     *
     * 'api': The line for mobile apps and robots.
     * - throttle:api: Limiting how many requests they can make per minute (Speed limit).
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
