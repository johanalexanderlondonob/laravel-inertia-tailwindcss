<?php

namespace App\Providers;

use App\Support\Vite;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Blade;
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
        //
        JsonResource::withoutWrapping();

        Blade::directive('vite', function ($expression) {
            return "<?php echo \App\Support\Vite::render({$expression}); ?>";
        });
    }
}
