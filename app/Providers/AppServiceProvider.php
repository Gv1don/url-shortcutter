<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->booted(function () {
            /** @var Request $request */
            $request = $this->app->make(Request::class);

            URL::forceRootUrl($request->getSchemeAndHttpHost());

            if ($request->isSecure()) {
                URL::forceScheme('https');
            }
        });
    }
}
