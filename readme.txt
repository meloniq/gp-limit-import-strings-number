=== GlotCore Limit Import Strings Number ===
Contributors: meloniq
Tags: glotpress, import, strings, limit
Tested up to: 6.9
Stable tag: 1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a limit to the number of strings that can be imported in GlotPress.

== Description ==

Adds a limit to the number of strings that can be imported in [GlotPress](https://wordpress.org/plugins/glotpress/).
It helps to prevent importing large translation projects, sets a reasonable limit to avoid performance issues.
It allows to provide a free tier for users who needs it for small personal projects.


= Configuration =

Once you have installed GlotCore Limit Import Strings Number it is ready to use, and the initial limit is set to 1000 strings.
You can change this limit by defining the following constant in your `wp-config.php` file:
```php
define( 'GLOTCORE_IMPORT_STRINGS_LIMIT', 500 ); // Change 500 to your desired limit
```


== Changelog ==

= 1.0 =
* Initial release.
