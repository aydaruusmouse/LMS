<?php

namespace App\Http;

use App\Http\Middleware\CheckApiKeyMiddleware;
// use App\Http\Middleware\InstallCheckMiddleware; // Removed - installation check disabled
use App\Http\Middleware\IsAdminInstructorMiddleware;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsInstructorMiddleware;
use App\Http\Middleware\IsStudentMiddleware;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\LoginCheckMiddleware;
use App\Http\Middleware\LogoutCheckMiddleware;
// use App\Http\Middleware\NotInstallCheckMiddleware; // Removed - installation check disabled
use App\Http\Middleware\OrganizationStaff;
use App\Http\Middleware\PermissionCheckerMiddleware;
use App\Http\Middleware\XssMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware       = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\XssMiddleware::class,
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
    protected $routeMiddleware  = [
        'auth'                 => \App\Http\Middleware\Authenticate::class,
        'auth.basic'           => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session'         => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers'        => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'                  => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'                => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm'     => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed'               => \App\Http\Middleware\ValidateSignature::class,
        'throttle'             => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'             => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'loginCheck'           => LoginCheckMiddleware::class,
        'logoutCheck'          => LogoutCheckMiddleware::class,
        'adminCheck'           => IsAdminMiddleware::class,
        'studentCheck'         => IsStudentMiddleware::class,
        'instructorCheck'      => IsInstructorMiddleware::class,
        'AdminInstructorCheck' => IsAdminInstructorMiddleware::class,
        'PermissionCheck'      => PermissionCheckerMiddleware::class,
        // 'NotInstalledCheck'    => NotInstallCheckMiddleware::class, // Removed - installation check disabled
        // 'isInstalled'          => InstallCheckMiddleware::class, // Removed - installation check disabled
        'CheckApiKey'          => CheckApiKeyMiddleware::class,
        'jwt.verify'           => JwtMiddleware::class,
        'orgazinationStaff'    => OrganizationStaff::class,
        'XSS'                  => XssMiddleware::class,
    ];
}
