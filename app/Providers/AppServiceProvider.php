<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Carbon\CarbonInterval;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::authorizationView(fn ($parameters) => view('mcp.authorize', $parameters));

        Gate::define('view-animals', fn (User $user) => $user->hasVerifiedEmail());

        Passport::tokensExpireIn(CarbonInterval::days(15));
        Passport::refreshTokensExpireIn(CarbonInterval::days(30));

        RateLimiter::for('mcp', fn ($request) => Limit::perMinute(60)
            ->by($request->user()?->id ?: $request->ip()));
    }
}
