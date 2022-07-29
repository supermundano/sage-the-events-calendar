<?php

namespace Supermundano\Sage\TheEventsCalendar;

use Illuminate\Contracts\Container\Container as ContainerContract;
use Roots\Acorn\Sage\ViewFinder;
use Roots\Acorn\View\FileViewFinder;
use Illuminate\Support\Str;

use function Roots\view;

class TheEventsCalendar
{
    public function __construct(
        ViewFinder $sageFinder,
        FileViewFinder $fileFinder,
        ContainerContract $app
    ) {
        $this->app = $app;
        $this->fileFinder = $fileFinder;
        $this->sageFinder = $sageFinder;
    }

    /**
     * Override The Events Calendar's V2 Views
     *
     * Based on:
     * @link https://gist.github.com/cliffordp/39e68939132bd0f483e0111972165455
     * @link https://theeventscalendar.com/knowledgebase/k/custom-templates-for-the-updated-calendar-views/
     *
     * @see  \Tribe__Template::tribe_template_theme_path_list()
     *
     * @param array $folders Array of data for loading locations.
     *
     * @return array
     */
    public function tribeTemplateThemePathList($folders)
    {
        $sage_tribe_base_path = resource_path('views/tribe/');

        $folders['sage_tec'] = [
            'id'       => 'sage_tec',
            'priority' => 5,
            'path'     => $sage_tribe_base_path . 'events',
        ];

        $folders['sage_tec_pro'] = [
            'id'       => 'sage_tec_pro',
            'priority' => 5,
            'path'     => $sage_tribe_base_path . 'pro',
        ];

        $folders['sage_et'] = [
            'id'       => 'sage_et',
            'priority' => 5,
            'path'     => $sage_tribe_base_path . 'tickets',
        ];

        $folders['sage_ce'] = [
            'id'       => 'sage_ce',
            'priority' => 5,
            'path'     => $sage_tribe_base_path . 'community',
        ];
        return $folders;
    }

    /**
     * Support blade templates for the main template include.
     */
    public function templateInclude(string $template): string
    {
        if (!$this->isTribeTemplate($template)) {
            return $template;
        }
        return $this->locateThemeTemplate($template) ?: $template;
    }

    /**
     * Check if template is a Tribe template.
     */
    protected function isTribeTemplate(string $template): bool
    {
        $plugin_path = dirname( \TRIBE_EVENTS_FILE );
        $pos = strpos($template, $plugin_path);
        return $pos !== false;
    }

    /**
     * Locate the theme's Tribe blade template when available.
     */
    protected function locateThemeTemplate(string $template): string
    {
        $plugin_path = trailingslashit(dirname( \TRIBE_EVENTS_FILE ));

        // Convert any backslashes to forward slashes for Windows compatibility.
        if (DIRECTORY_SEPARATOR === '\\') {
            $plugin_path = str_replace('\\', '/', $plugin_path);
            $template = str_replace('\\', '/', $template);
        }

        $themeTemplate = 'tribe/events/v2' . str_replace($plugin_path . 'src/views/v2', '', $template);

        return locate_template($this->sageFinder->locate($themeTemplate));
    }
}
