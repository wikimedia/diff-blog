# WordPress Plugin Framework

This is basic library for creating WordPress plugins on Alledia.

Use it on the main plugin only. For add-ons, use [this library](https://github.com/upstreamplugin/EDD-SL-Plugin-Updater) for adding EDD integration.

## Modules

### Add-ons

This module deals with add-ons and their license keys. It is optional.
### Assets

This module take care of the framework assets and is initialized by the core.

### Reviews

The Reviews module help displaying an admin notice asking for 5-star reviews, based a custom rule.

### Upgrade

The Upgrade module displays a sidebar banner on the admin pages (optional) of the main plugin, offering a discount for the user to upgrade to the Pro plan.

## How to use it

### Installing

Add as a requirement using composer:

```
$ composer require alledia/wordpress-plugin-framework 
```

Or add it manually to the composer.json file:

```json
{
  "require": {
    "alledia/wordpress-plugin-framework": "*"
  }
} 
```
### Loading and initializing

```php
<?php

// Call the autoloader.
require __DIR__ . '/vendor/autoload.php';

// Initialize the framework.
$pluginBaseName = plugin_basename('you-plugin/your-plugin.php');
$eddApiUrl      = 'https://your-plugin-site.com';
$pluginAuthor   = 'Your Company/Plugin';

$framework = new Allex\Core($pluginBaseName, $eddApiUrl, $pluginAuthor);
$famrwork->init();
```

### Using the Add-ons module


```php
<?php
add_filter('allex_addons', 'filter_allex_addons', 10, 2);

// Initialize the module.
$framework->get_service('module_addons')->init();

/**
 * @param $addons
 * @param $plugin_name
 *
 * @return array
 */
function filter_allex_addons($addons, $plugin_name)
{
    if ('you-plugin' === $plugin_name) {
        $addons = [
            'addon-1' => [
                'slug'        => 'addon-1',
                'title'       => __('Add-on 1', 'your-plugin'),
                'description' => __('The first Add-on', 'your-plugin'),
                'icon_class'  => 'fa fa-check-circle',
                'edd_id'      => 6323,
            ],
            'addon-2' => [
                'slug'        => 'addon-2',
                'title'       => __('Add-on 2', 'your-plugin'),
                'description' => __('The second Add-on', 'your-plugin'),
                'icon_class'  => 'fab fa-bell',
                'edd_id'      => 8217,
            ],
        ];
    }
    
    return $addons;
}
```

The license key and status will be stored in the following options:

    - {$pluginSlug}_license_key
    - {$pluginSlug}_license_status

You can use the following hooks to customize or overwrite it:

```php
<?php
add_action('allex_addon_update_license', 'action_allex_addon_update_license', 10, 4);
add_filter('allex_addons_get_license_key', 'filter_allex_addons_get_license_key', 10, 2);
add_filter('allex_addons_get_license_status', 'filter_allex_addons_get_license_status', 10, 2);

/**
 * @param $plugin_name
 * @param $addon_slug
 * @param $license_key
 * @param $license_status
 */
function action_allex_addon_update_license($plugin_name, $addon_slug, $license_key, $license_status)
{
    // ...
}

/**
 * @param $license_key
 * @param $addon_slug
 *
 * @return string
 */
function filter_allex_addons_get_license_key($license_key, $addon_slug)
{
    return $license_key;
}

/**
 * @param $license_status
 * @param $addon_slug
 *
 * @return string
 */
function filter_allex_addons_get_license_status($license_status, $addon_slug)
{
    return $license_status;
}
```
 
