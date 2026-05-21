<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Announcement;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind services
        $this->app->singleton(\App\Services\SermonService::class);
        $this->app->singleton(\App\Services\EventService::class);
        $this->app->singleton(\App\Services\MediaService::class);
    }

    public function boot(): void
    {
        // Use Tailwind pagination
        Paginator::defaultView('vendor.pagination.tailwind');
        Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');

        // Share global data with all views
        View::composer('*', function ($view) {
            $view->with([
                'currentYear' => date('Y'),
                'churchConfig' => config('church'),
            ]);
        });

        // Share announcement banner with public views
        View::composer('layouts.app', function ($view) {
            $activeAnnouncements = Cache::remember('active_announcements', 900, function () {
                return Announcement::where('is_active', true)
                    ->where('show_banner', true)
                    ->where(function ($q) {
                        $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
                    })
                    ->orderBy('order')
                    ->first();
            });

            $view->with('activeBanner', $activeAnnouncements);
        });

        // Custom Blade directives
        Blade::directive('money', function ($expression) {
            return "<?php echo '$' . number_format($expression, 2); ?>";
        });

        Blade::directive('dateformat', function ($expression) {
            return "<?php echo ($expression)->format('M d, Y'); ?>";
        });

        Blade::directive('badge', function ($expression) {
            return "<?php echo '<span class=\"badge badge-' . $expression . '\">' . ucfirst($expression) . '</span>'; ?>";
        });

        // Blade component aliases
        Blade::component('admin.nav-item', 'admin-nav-item');
        Blade::component('ui.alert', 'alert');
        Blade::component('ui.modal', 'modal');
    }
}
