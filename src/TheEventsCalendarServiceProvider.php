<?php

namespace Supermundano\Sage\TheEventsCalendar;

use Roots\Acorn\ServiceProvider;

class TheEventsCalendarServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tribe_events', TheEventsCalendar::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (defined('TRIBE_EVENTS_FILE')) {
            $this->bindFilters();
        }

        $this->publishes([
            __DIR__ . '/../publishes/resources/views' => $this->app->resourcePath('views/tribe/events/v2'),
        ], 'TheEventsCalendar Templates');

    }

    public function bindFilters()
    {
        $tribeEvents = $this->app['tribe_events'];

        add_filter('tribe_template_theme_path_list', [$tribeEvents, 'tribeTemplateThemePathList'], 10, 1);
        add_filter( 'template_include', [$tribeEvents, 'templateInclude'], 51);
    }
}
