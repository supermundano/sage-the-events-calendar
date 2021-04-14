# The Events Calendar support for Sage 10

![Latest Version](https://img.shields.io/packagist/v/supermundano/sage-the-events-calendar.svg?style=flat-square)
![Total Downloads](https://img.shields.io/packagist/dt/supermundano/sage-the-events-calendar.svg?style=flat-square)


Add The Events Calendar support to Sage 10.

For the time being there can only be a blade view, the default-template.blade.php file, that allows the events page to work loading the Sage blade layout.

The template parts are not available yet as blade templates. If you need to override a template part, say for instance:

```the-events-calendar/src/views/v2/components/events-bar.php```

just copy the file in the folder root folder of your theme

```your-sage10-theme/tribe/events/v2/components/events-bar.php```

You won't have the blade functionality but at least you can use the plugin.

## Requirements

- [Sage](https://github.com/roots/sage) >= 10.0
- [PHP](https://secure.php.net/manual/en/install.php) >= 7.1.3
- [Composer](https://getcomposer.org/download/)


## Installation

Install the composer package (in the theme folder).

```bash
$ composer require supermundano/sage-the-events-calendar```
```

Add the package to the cached package manifest.

```bash
$ wp acorn package:discover
```

Publish the required `template-default.blade.php` view

```bash
$ wp acorn vendor:publish --tag="TheEventsCalendar Templates"```
```

## Bug Reports

If you discover a bug in Sage The Events Calendar, please [open an issue](https://github.com/supermundano/sage-the-events-calendar/issues).

## Todo

What we need to have full Sage10 coverage:

- [] Allow blade templates for template parts

What I've found so far:

The templates are rendered by the function template here [the-events-calendar/common/src/Tribe/Template.php](https://github.com/the-events-calendar/tribe-common/blob/master/src/Tribe/Template.php#L836:L915)


We need to figure out how to:
- get access to $context and $echo
- port those actions before/after template rendering: https://github.com/the-events-calendar/tribe-common/blob/a561e923b1eb4877e78abeb44f9db06e357cb650/src/Tribe/Template.php#L893:L900
- set the current hook name back again https://github.com/the-events-calendar/tribe-common/blob/a561e923b1eb4877e78abeb44f9db06e357cb650/src/Tribe/Template.php#L915


## License

Sage The Events Calendar is provided under the [MIT License](https://github.com/supermundano/sage-the-events-calendar/blob/master/LICENSE.md).
