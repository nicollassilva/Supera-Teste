<?php

namespace App\Providers;

use App\Models\Dashboard\{
    Member,
    Unit
};
use App\Observers\{
    MemberObserver,
    UnitObserver
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Unit::observe(UnitObserver::class);
        Member::observe(MemberObserver::class);
    }
}
