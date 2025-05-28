=== Accordions and Tabs by Vander Web ===
Contributors: ulrikvander
Donate link: https://vander-web.com/
Tags: accordion, post_type, taxonomy, options, Bootstrap 4.6, Bootstrap Icons
Requires PHP: 5.6.20
Requires at least: 5.3
Tested up to: 5.6.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add Accordions Section and Shortcodes.

== Description ==

This plugin sets up a custom post-type and custom taxonomy to be used as Accordion and Tab content. 

It require Bootstrap 4.6 and Bootstrap Icons 1.2 to run. If the current theme does not load these, they can be loaded with this plugin.

Shortcodes, based on each Section (custom taxonomy) will be available when a Section is created.
Every accordion (custom post-type) assigned to a section, will be used as entries.
Several attributes can be assigned to each shortcode to customize the loop used.


== Installation ==

1. Upload `vanderweb-bs4-accordion.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create a Section in the Accordion menu item called Sections.
4. Create accordions and make sure to assign a Section.
6. Use one of the generated Shortcodes (based on sections), modify with attributes if needed.


== Frequently Asked Questions ==

= What does the plugin do? =

The plugin provides Shortcodes to display Accordions and Tabs in content, based on Accordion Sections and their accordion entries.


== Changelog ==

= 1.0.1 =
* Plugin is recreated to fit the boilerplate made by https://wppb.me.
*  Bootstrap updated to version 4.6.
*  Fontawesome replaced with Bootstrap Icons version 1.3.


== Screenshots ==

1. No screenshots available.


== Upgrade Notice ==
* 1.0.1: First release.