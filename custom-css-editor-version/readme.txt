=== Smart Frontend Custom CSS Version Manager  ===
Contributors: rajvindersingh
Tags: custom css, css editor, theme css, site css
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add custom CSS to your WordPress site from a simple admin editor, with recent saved versions kept as backups.

== Description ==

Smart Frontend Custom CSS Version Manager adds a simple admin page where site administrators can save custom CSS for the active WordPress site. The plugin stores the latest CSS in the uploads directory and automatically enqueues it on the front end.

The plugin keeps recent saved CSS files as backups so administrators can review earlier versions.

== Installation ==

1. Upload the `smart-frontend-custom-css-version-manager` folder to the `/wp-content/plugins/` directory, or install it from the WordPress Plugins screen.
2. Activate the plugin through the Plugins screen in WordPress.
3. Go to Custom CSS in the WordPress admin menu.
4. Add your CSS and click Save Custom CSS.

== Frequently Asked Questions ==

= Who can edit the CSS? =

By default, users with the `manage_options` capability can edit and save custom CSS.

= Where is the CSS stored? =

The latest CSS file and recent backup versions are stored in `/wp-content/uploads/smart-frontend-custom-css-version-manager/`.

== Changelog ==

= 1.0.0 =
* Initial public release.
