<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;


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
        Blade::anonymousComponentPath(resource_path() . '/views/admin/components', 'admin');
        Blade::anonymousComponentPath(config('theme.components_path'), 'theme');

        View::addNamespace('theme', resource_path( '/views/themes/' . config( 'theme.active' ) ));

        Blade::directive(
            'asset',
            function (string $path = '', $version = '') {
                if ( ! $path ) {
                    return '';
                }

                return "<?php echo e( url( 'assets/' . {$path} ) ); ?>";
            }
        );

        Paginator::defaultView('pagination::default');
        Paginator::defaultSimpleView('pagination::simple-default');
    }
}
