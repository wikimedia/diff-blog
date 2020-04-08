# VIP Go / WordPress.com Compatibility

This plugin provides compatibility for sites that are moving from WordPress.com to VIP Go. It's meant to be a temporary shim to ease your transition to the new platform, not a permanent solution.

_We suggest reading through this README and the codebase to determine whether you need it or it can be removed safely._

## Plugin Versioning

To minimize the amount of moving pieces we move plugins with exactly the same version as on WordPress.com. With the exception of `es-wp-query` because versions prior to `0.2.0` are not compatible with VIP Go.

`wpcom_vip_load_plugin` has a couple of important differences on VIP Go:

1. `wpcom_vip_load_plugin` does not accept `$version` argument.
2. Plugins can only be loaded from `plugins/` and its subfolders.

To address those differences we automatically move all loaded plugins during the code migration into `plugins`. If we detect that `wpcom_vip_load_plugin` call uses $version argument we replace that call with `wpcom_vip_legacy_load_plugin`.

`wpcom_vip_legacy_load_plugin` is a thin wrapper around `wpcom_vip_load_plugin` that allows for loading of the correct version.

⚠️ If you see calls to `wpcom_vip_legacy_load_plugin` in your codebase (themes or your custom plugins) removing `vip-go-wpcom-compat` will break your site. ⚠️

Examples:

#### Unversioned
```
// WP.com loads from `vip/plugins/my-plugin`
wpcom_vip_load_plugin( 'my-plugin' );

// VIP Go loads from `plugins/`
wpcom_vip_load_plugin( 'my-plugin' );
```

#### Versioned
```
// WP.com loads from `vip/plugins/my-plugin-2.0`
wpcom_vip_load_plugin( 'my-plugin', 'plugins', '2.0' );


// VIP Go loads from `plugins/my-plugin-2.0`
// 1. With compat wrapper:
wpcom_vip_legacy_load_plugin( 'my-plugin', 'plugins', '2.0' );
// 2. With VIP Go wpcom_vip_load_plugin:
wpcom_vip_load_plugin( 'my-plugin-2.0/my-plugin.php' );
```

## Deprecated Functions

The following functions are deprecated on VIP Go and are added as shims to keep themes and plugins from throwing fatal errors:

* `wpcom_vip_load_wp_rest_api()` - Loads the built-in WP REST API endpoints in WordPress.com VIP context.  This function is not needed on VIP Go, or core WordPress to load the REST API and can be safely removed.
* `wpcom_vip_enable_https_canonical()` - By default HTTP is forced to be the canonical version of URLs on WordPress.com. This function is not needed on VIP Go.
* `require_lib( $slug )` - This internal WordPress.com function adds shared WordPress.com libraries. These libraries will need to be copied directly into the VIP Go client repository.
* `is_wpcom_vip()` - This checks if we are on a WordPress VIP platform vs local. Tihs function is not needed on VIP Go.

## Shortcodes

The following shortcodes are either ported over from WordPress.com or created with minimal backward compatibility:

* `protected-iframe` - Displays "protected embeds" imported from WordPress.com. This does not allow sites to create new embeds, nor does it enable the "protected" domain. Other plugins can be used for this, such as [humanmade/protected-embeds](https://github.com/humanmade/protected-embeds).

## WP-CLI Commands

The following custom WP-CLI commands exist in this plugin:

* `wpcom-compat import-protected-embeds` - Imports "protected embeds" from a CSV file into the database table `protected_embeds`.

## Plugins

* [Writing Helper](https://github.com/Automattic/writing-helper) - "Helps you write your posts."  This plugin is a feature on WordPress.com that allows posts to be copied and for feedback to be requested.  This plugin can be disabled by calling `add_filter( 'wpcom_compat_enable_writing_helper', '__return_false' );` before loading the WordPress.com Compatibility mu-plugin.
* MediaRSS - This plugin adds compatibility for MediaRSS for RSS feeds, it's going to be merged in Jetpack at some point [Jetpack issue #11062](https://github.com/Automattic/jetpack/issues/11062), but for now it's a part of this compat plugin.

## Filters

### `wpcom_make_content_clickable()` - Convert plain text URLs in `post_content` to links on display.

* `wpcom_make_content_clickable()` is the WordPress.com implementation of [`make_clickable()`](https://developer.wordpress.org/reference/functions/make_clickable/). It uses `make_clickable()` conditionally as that is an expensive function. This conversion of plain text URLs to HTML links is turned on by default on WordPress.com and VIP Go.

* To turn off this behavior please use the following piece of code:
```
remove_filter( 'the_content', 'wpcom_make_content_clickable', 120 );
remove_filter( 'the_excerpt', 'wpcom_make_content_clickable', 120 );
```

## Updating

We only add the plugin once during initial migration, once the site is launched on VIP Go it's up to you whether to keep it updated or remove it completely (after verifying that you're not using any of the features).

### Submodule

If the plugin is added as a submodule:
1. Navigate to `client-mu-plugins/vip-go-wpcom-compat`.
2. Do `git pull`.
3. Navigate back to your repo and commit the result.
4. Push.

## Subtree

If the plugin is added as a subtree:

From the root of your repo.
1. `git subtree pull --prefix client-mu-plugins/vip-go-wpcom-compat https://github.com/Automattic/vip-go-wpcom-compat.git master --squash`.
2. (Optional) Modify the commit message.
3. Push.
