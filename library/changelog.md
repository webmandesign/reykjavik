# WebMan WordPress Theme Framework Changelog

## 2.7.0

* **Add**: Theme options/mods wrapper with automatic default value fallback
* **Add**: Support for customizer options `validation_callback`
* **Update**: Improving customizer options setup
* **Update**: Using `error_log` where appropriate
* **Update**: Improving security
* **Update**: Using `PHP_EOL`
* **Update**: Improving and fixing `$pre` filters
* **Update**: Removing `get_theme_file_uri()` shim function (WP4.7+)
* **Update**: Removing custom TinyMCE editor page template class (WP4.7+)
* **Update**: Adding variable type where applicable
* **Update**: Removing obsolete WordPress min version requirement in favor of 2 major versions backwards compatibility
* **Update**: Simplifying assets versioning
* **Update**: Improving customizer options functionality
* **Update**: Improving PHP DocBlock and adding @subpackages info
* **Update**: Improving custom styles output functionality
* **Update**: Removing obsolete functionality
* **Update**: Improving code formatting
* **Update**: WebMan Design Use Child Theme 1.3.0

### Files changed:

	changelog.md
	init.php
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize-control-hidden.php
	includes/classes/class-customize-control-html.php
	includes/classes/class-customize-control-multiselect.php
	includes/classes/class-customize-control-radio-matrix.php
	includes/classes/class-customize-control-select.php
	includes/classes/class-customize-styles.php
	includes/classes/class-customize.php
	includes/classes/class-sanitize.php
	includes/classes/class-visual-editor.php
	includes/vendor/tgmpa/class-tgm-plugin-activation.php
	includes/vendor/use-child-theme/class-use-child-theme.php
	js/customize-control-multicheckbox.js
	js/customize-control-radio-matrix.js
	js/customize-controls.js
	scss/customize.scss
	scss/welcome.scss
	scss/styles/_customize.scss
	scss/styles/_welcome.scss


## 2.6.1

* **Update**: Removing obsolete code comments
* **Fix**: Stylesheet generator functionality

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php
	includes/classes/class-customize-control-radio-matrix.php
	includes/classes/class-customize-control-select.php
	includes/classes/class-customize-styles.php
	includes/classes/class-customize.php
	includes/classes/class-sanitize.php


## 2.6.0

* **Add**: Customizer range control hover color
* **Update**: Removing filter to enable RTL (generating RTL stylesheets automatically if the compatibility file found in the theme)
* **Update**: Renaming `custom_mce_format` method and filters to `style_formats`
* **Update**: Improving stylesheet generator method
* **Update**: Removing donation link from customizer styles
* **Update**: Updating code formatting
* **Update**: Improving `selector_replace` for `preview_js` in theme options

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php
	includes/classes/class-customize-control-multiselect.php
	includes/classes/class-customize-styles.php
	includes/classes/class-customize.php
	includes/classes/class-visual-editor.php
	includes/vendor/tgmpa/class-tgm-plugin-activation.php
	scss/styles/_customize.scss


## 2.5.6

* **Add**: Float value sanitization method

### Files changed:

	changelog.md
	init.php
	includes/classes/class-sanitize.php


## 2.5.5

* **Fix**: Welcome page columns vertical align in WordPress 4.9

### Files changed:

	changelog.md
	init.php
	scss/styles/_welcome.scss


## 2.5.4

* **Fix**: Sanitize class "array" method name

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize.php
	includes/classes/class-sanitize.php


## 2.5.3

* **Fix**: Custom styles replacements issue

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php


## 2.5.2

* **Fix**: Custom styles caching issue

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php


## 2.5.1

* **Fix**: Undefined variable PHP error when using stylesheet generator
* **Fix**: Stylesheet generator and custom styles generator functionality

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php


## 2.5.0

* **Update**: Disabled Child Theme Generator by default (WPORG theme review requirement)
* **Update**: Separated sanitization methods into separate class
* **Update**: Updated and fixed customizer styles generator class

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php
	includes/classes/class-customize.php
	includes/classes/class-sanitize.php


## 2.4.4

* **Update**: Including WPORG theme review required PHP comment into TGMPA class

### Files changed:

	changelog.md
	init.php
	includes/vendor/tgmpa/class-tgm-plugin-activation.php


## 2.4.3

* **Update**: Removing duplicate text escaping from `link_skip_to()`

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php


## 2.4.2

* **Update**: Removing shortcodes in Text widget
* **Update**: Removing `get_image_id_from_url()` in favor of WordPress native `attachment_url_to_postid()`

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php


## 2.4.1

* **Fix**: Reykjavik theme reference.

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php


## 2.4.0

* **Fix**: Not overriding WordPress globals

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php


## 2.3.0

* **Update**: Using `__CLASS__` where appropriate
* **Update**: Removing stylesheet regeneration success message
* **Update**: Saving current stylesheet regeneration timestamp into theme options
* **Update**: Removing `set_theme_mod( '__theme_installed', true );` leaving this to theme

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize.php
	includes/classes/class-customize-styles.php


## 2.2.8

* **Fix**: Improving TinyMCE Formats button dropdown styles preview

### Files changed:

	changelog.md
	init.php
	includes/classes/class-visual-editor.php


## 2.2.7

* **Fix**: Removing obsolete slash for ABSPATH

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php


## 2.2.6

* **Update**: Updating child theme generator to 1.2.1
* **Update**: Do not display admin notices on theme "Welcome" page
* **Fix**: RTL customizer controls styles loading

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize.php
	includes/vendor/use-child-theme/class-use-child-theme.php
	scss/styles/_welcome.scss


## 2.2.5

* **Update**: Adding <address> tag support for TinyMCE custom Formats dropdown style

### Files changed:

	changelog.md
	init.php
	includes/classes/class-visual-editor.php


## 2.2.4

* **Fix**: Image control default value in custom styles generator

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php


## 2.2.3

* **Fix**: Displaying decimal places in range customizer control value preview

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize.php
	js/customize-controls.js


## 2.2.2

* **Fix**: `customize-controls.js` filename
* **Fix**: Allow for zero value of range customizer control in styles generator

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php
	js/customize-controls.js


## 2.2.1

* **Add**: Range input value prefix and suffix support
* **Update**: Range input slider styles

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize.php
	js/customize-controls.js
	scss/styles/_customize.scss


## 2.2.0

* **Add**: Conditional hiding of CSS image properties controls
* **Update**: Range input slider made RTL ready and more accessible
* **Fix**: CSS styles generator CSS conditionals
* **Fix**: CSS styles generator checkbox default value

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php
	includes/classes/class-customize.php
	js/customize-control-multicheckbox.js
	js/customize-control-radio-matrix.js
	js/customize-controls.js
	scss/styles/_customize.scss


## 2.1.1

* **Add**: Styles generator option value NOT conditional support
* **Update**: Renaming "checkboxes" to "multicheckbox"
* **Update**: Optimizing code
* **Update**: Not changing custom background and header customizer sections titles
* **Fix**: Styles generator image background (default) value
* **Fix**: Customizer image field validation

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-control-multiselect.php
	includes/classes/class-customize-styles.php
	includes/classes/class-customize.php
	includes/vendor/tgmpa/class-tgm-plugin-activation.php
	js/customize-control-multicheckbox.js


## 2.1.0

* **Add**: Support for multi-checkbox customizer control
* **Update**: Removing post meta method in favor of theme template files
* **Update**: Renaming post table of content active and passed section CSS classes
* **Update**: Improving customizer controls escaping
* **Update**: Using semantic versioning
* **Fix**: Multi-select customizer control check for what is selected

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php
	includes/classes/class-customize-control-multiselect.php
	includes/classes/class-customize-control-radio-matrix.php
	includes/classes/class-customize-control-range.php
	includes/classes/class-customize-control-select.php
	includes/classes/class-customize.php
	js/customize-control-checkboxes.js
	js/customize-control-radio-matrix.js


## 2.0.7

* **Update**: Using `wp_kses_post` instead of `wp_filter_post_kses` where appropriate
* **Fix**: Removing wrong theme name references

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize.php
	includes/classes/class-customize-styles.php


## 2.0.6

* **Add**: Adding Schema.org "url" itemprop on linked post date

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php


## 2.0.5

* **Update**: Using `wp_mkdir_p()` where appropriate

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize-styles.php


## 2.0.4

* **Fix**: Making customizer styles compatible with WordPress 4.7+

### Files changed:

	changelog.md
	init.php
	includes/classes/class-customize.php
	scss/styles/_customize.scss


## 2.0.3

* **Update**: Removing obsolete logo method in favor of dedicated template part file within the theme

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php


## 2.0.2

* **Update**: Improving customizer theme panel styles
* **Update**: Making it possible to rename customizer theme panel and set its attributes
* **Update**: Introducing `get_theme_file_uri()` function (will be removed with WordPess 4.9)

### Files changed:

	changelog.md
	init.php
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize-control-radio-matrix.php
	includes/classes/class-customize.php
	includes/classes/class-visual-editor.php
	scss/styles/_customize.scss


## 2.0.1

* **Update**: Adding conditional check for WordPress version to TinyMCE page template body class functionality
* **Update**: Using `$` instead of `jQuery` in JS files
* **Update**: Improving variables declarations in JS files

### Files changed:

	changelog.md
	init.php
	includes/classes/class-visual-editor.php
	js/customize-control-radio-matrix.js
	js/post.js


## 2.0

* **Update**: Renaming `Theme_Framework` to `Library`
* **Update**: Renaming `_tf_` to `_library_`

### Files changed:

	changelog.md
	init.php
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize-control-radio-matrix.php
	includes/classes/class-customize-styles.php
	includes/classes/class-customize.php
	includes/classes/class-visual-editor.php


## 1.9.3

* **Update**: Removing obsolete code
* **Fix**: Updating customizer sanitize functions

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php
	includes/classes/class-customize.php


## 1.9.2

* **Update**: Making sure there is a space between entry meta elements

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php


## 1.9.1

* **Update**: Updating constants names
* **Update**: Allow displaying admin notices on welcome screen
* **Update**: Improving customizer options generator
* **Update**: Updating customizer controls styles

### Files changed:

	changelog.md
	init.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	scss/styles/_customize.scss
	scss/styles/_welcome.scss


## 1.9

* **Update**: Improving loading files
* **Update**: Improving features (PHP classes) loading
* **Update**: Using `require` instead of `require_once` where appropriate
* **Update**: Removing obsolete constants
* **Update**: Using `theme_mods` by default
* **Update**: Updating theme edit capability
* **Update**: Better file organization
* **Update**: Renaming customizer related PHP classes and files
* **Update**: Removing obsolete files
* **Update**: Child theme generator script
* **Update**: Welcome screen styles
* **Fix**: Removing formats button icons on front-end to prevent empty icons

### Files changed:

	changelog.md
	init.php
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize-control-hidden.php
	includes/classes/class-customize-control-html.php
	includes/classes/class-customize-control-multiselect.php
	includes/classes/class-customize-control-radio-matrix.php
	includes/classes/class-customize-control-range.php
	includes/classes/class-customize-control-select.php
	includes/classes/class-customize-styles.php
	includes/classes/class-customize.php
	includes/classes/class-visual-editor.php
	includes/vendor/use-child-theme/class-use-child-theme.php
	scss/styles/_welcome.scss


## 1.8

* **Update**: Merging Complex and Simple library version into a single one
* **Update**: Removing `wp_title()` - rising minimal requirements to WordPress 4.4
* **Update**: Improving `$current_screen` checks
* **Update**: Improving logo generator method
* **Update**: Fixing admin PHP class loading
* **Update**: Separating theme update notifier from framework library
* **Update**: Removing obsolete files
* **Update**: Improving custom styles generator
* **Update**: Improving customizer custom control files
* **Update**: Improving customizer assets loading
* **Update**: Radio matrix customizer control JavaScript file

### Files changed:

	changelog.md
	init.php
	includes/admin.php
	includes/customize.php
	includes/visual-editor.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/classes/class-generate-styles.php
	includes/classes/class-visual-editor.php
	includes/classes/controls/class-control-hidden.php
	includes/classes/controls/class-control-html.php
	includes/classes/controls/class-control-multiselect.php
	includes/classes/controls/class-control-radio-matrix.php
	includes/classes/controls/class-control-range.php
	includes/classes/controls/class-control-select.php
	js/customize-control-radio-matrix.js


## 1.7.2

* **Add**: Adding custom classes on TinyMCE editor

### Files changed:

	init.php
	js/post.js
	includes/classes/class-visual-editor.php


## 1.7.1

* **Add**: Allow custom CSS property in customizer preview JS
* **Add**: Allow CSS selector before and after in customizer preview JS
* **Update**: Forcing boolean value in conditional CSS comment replacements
* **Fix**: Fixing range customizer control issues

### Files changed:

	init.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/classes/controls/class-control-range.php


## 1.7

* **Update**: Improving customizer preview JS, also allowing use of both `css` and `custom`

### Files changed:

	init.php
	includes/classes/class-customize.php


## 1.6.3

* **Update**: Customizer styles WordPress 4.6 ready
* **Update**: Customizer styles
* **Fix**: Customizer empty label PHP error

### Files changed:

	init.php
	includes/classes/class-customize.php
	scss/styles/_customize.scss


## 1.6.2

* **Add**: Child theme generator (Use Child Theme script)

### Files changed:

	init.php
	includes/admin.php
	includes/vendor/tgmpa/class-tgm-plugin-activation.php


## 1.6.1

* **Update**: Improving security by using `wp_strip_all_tags` and `wp_kses` instead of `strip_tags`
* **Update**: Welcome page styles (preventing page overflowing)

### Files changed:

	init.php
	includes/classes/class-core.php
	includes/classes/class-updater.php
	includes/classes/controls/class-control-radio-matrix.php
	scss/styles/_welcome.scss


## 1.6

* **Add**: Functionality for conditional CSS comments
* **Add**: Added support for `input_attrs` customizer option setup
* **Update**: Skip to content link text updated
* **Update**: Optimized customizer class
* **Update**: TGM Plugin Activation 2.6.1
* **Update**: Using `is-active` class instead of `active`
* **Update**: Welcome screen styles

### Files changed:

	init.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/vendor/tgmpa/class-tgm-plugin-activation.php
	js/customize.js
	scss/styles/_customize.scss
	scss/styles/_welcome.scss


## 1.5

* **Add**: Customizer checkbox field custom styles
* **Add**: Customizer `css_output` theme options setting
* **Update**: Renaming them "About" page to "Welcome" page
* **Update**: Files loading order
* **Update**: Not using ID selectors in CSS
* **Update**: Improved RTL stylesheets loading
* **Update**: Using `__CLASS__` wherever possible
* **Update**: Using theme Schema.org class instead of function
* **Update**: Removed obsolete hook priority setup
* **Update**: Changed priority of core class loading
* **Fix**: Customizer range field to accept floating point number values
* **Fix**: Allowing theme to set an image logo as predefined one (if text logo needed, user need to set custom logo image and then remove it)
* **Fix**: Removed all admin bar styles references to prevent issues with Theme Check plugin

### Files changed:

	init.php
	includes/admin.php
	includes/customize.php
	includes/update-notifier.php
	includes/visual-editor.php
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/classes/class-updater.php
	includes/classes/class-visual-editor.php
	includes/classes/controls/class-control-range.php
	js/customize.js
	scss/admin-rtl.scss
	scss/admin.scss
	scss/customize-rtl.scss
	scss/customize.scss
	scss/welcome-rtl.scss
	scss/welcome.scss
	scss/styles/_admin.scss
	scss/styles/_customize.scss
	scss/styles/_welcome.scss


## 1.4

* **Update**: Changed custom CSS variables format to `[[theme_mod_name]]`, `[[theme_mod_name(alpha_value)]]` respectively
* **Update**: Renamed `external` folder name to `vendor`
* **Update**: Moving TGM Plugin Activation script into `includes/vendor/tgmpa` folder
* **Update**: Custom `get_theme_mod()` made compatible with WordPress native function
* **Update**: Improved customizer preview JS
* **Update**: Escaping `get_stylesheet_directory_uri()` output
* **Fix**: TinyMCE Format button custom formats array sorting
* **Fix**: Localization functions

### Files changed:

	init.php
	includes/admin.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/classes/class-visual-editor.php


## 1.3.3

* **Update**: Improving SSL URL fixer
* **Update**: Removing obsolete PHP comment

### Files changed:

	init.php
	includes/classes/class-core.php


## 1.3.2

* **Update**: Improved stylesheet generator for better RTL support

### Files changed:

	init.php
	includes/classes/class-core.php


## 1.3.1

* **Update**: Improved logo function for better compatibility with customizer partial refresh
* **Update**: Removing obsolete version numbers

### Files changed:

	init.php
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/classes/class-updater.php
	includes/classes/class-visual-editor.php


## 1.3

* **Add**: WordPress 4.5 custom logo support
* **Add**: Support for WP ULike plugin in post meta
* **Update**: Removing obsolete `get_theme_slug()` method
* **Update**: Created dedicated constant for (parent) theme version
* **Update**: Moved and renamed WordPress native theme customizer settings and sections
* **Update**: PHP inline comments formating
* **Update**: Improved support for ThemeCheck.org check algorithm
* **Update**: Improved RTL support
* **Update**: Stylesheets
* **Fix**: Fixed SSL issues

### Files changed:

	init.php
	css/about.css
	css/admin.css
	css/customize.css
	css/rtl-about.css
	css/rtl-admin.css
	css/rtl-customize.css
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/classes/class-updater.php
	includes/classes/class-visual-editor.php
	includes/external/class-tgm-plugin-activation.php
	scss/about.scss
	scss/admin.scss
	scss/customize.scss
	scss/rtl-about.scss
	scss/rtl-admin.scss
	scss/rtl-customize.scss


## 1.2.1

* **Update**: Improving admin notice styles

### Files changed:

	init.php
	includes/classes/class-core.php


## 1.2

* **Update**: Improving files loading
* **Update**: Porting theme "About" admin page functionality into simple version of the framework
* **Update**: Updated TGM Plugin Activation class

### Files changed:

	init.php
	includes/admin.php
	includes/external/class-tgm-plugin-activation.php


## 1.1

* **Update**: Changing `locate_template()` for `require_once()` file loading
* **Update**: Adding links on post publish date meta
* **Update**: Removing theme slug constant
* **Update**: Adding dismissible admin notices
* **Fix**: Fixing TGM Plugin Activation admin notice position

### Files changed:

	init.php
	readme.md
	includes/admin.php
	includes/customize.php
	includes/update-notice.php
	includes/visual-editor.php
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/classes/class-updater.php
	includes/external/class-tgm-plugin-activation.php


## 1.0.16

* **Update**: Removing obsolete file reference
* **Fix**: Fixing typos

### Files changed:

	init.php
	includes/customize.php
	includes/classes/class-customize.php


## 1.0.15

* **Add**: Added method to get the (parent) theme folder name
* **Fix**: Compatibility with child themes
* **Fix**: Stripping HTML tags in Post Views Count plugin output to prevent errors in theme HTML

### Files changed:

	init.php
	includes/classes/class-admin.php
	includes/classes/class-core.php
	includes/classes/class-customize.php
	includes/classes/class-updater.php


## 1.0.14

* **Update**: Renaming the `customizer_js` to `preview_js` and improving the function

### Files changed:

	init.php
	includes/classes/class-customize.php


## 1.0.13

* **Update**: Renaming the `include` folder to `includes`
* **Update**: Updating `REYKJAVIK_INCLUDE_DIR` constant name to `REYKJAVIK_INCLUDES_DIR`
* **Update**: Library files paths
* **Update**: Theme files paths

### Files changed:

	init.php
	includes/admin.php
	includes/customize.php
	includes/update-notifier.php
	includes/visual-editor.php
	includes/classes/class-customize.php


## 1.0.12

* **Update**: Compatibility with Readability.com

### Files changed:

	init.php
	includes/classes/class-core.php


## 1.0.11

* **Fix**: Customizer custom option preview JS

### Files changed:

	init.php
	includes/customize.php


## 1.0.10

* **Update**: Removed custom color picker styling

### Files changed:

	init.php
	scss/customize.scss


## 1.0.9

* **Update**: Improved flexibility of accessibility skip link

### Files changed:

	init.php
	includes/classes/class-core.php


## 1.0.8

* **Update**: Renaming the `inc` folder to `include`
* **Update**: Updating `REYKJAVIK_INCLUDE_DIR` constant
* **Update**: Library files paths
* **Update**: Theme files paths

### Files changed:

	init.php
	includes/admin.php
	includes/customize.php
	includes/update-notifier.php
	includes/visual-editor.php
	includes/classes/class-customize.php


## 1.0.7

* **Update**: Renaming the `lib` folder to `library`

### Files changed:

	init.php
	readme.md


## 1.0.6

* **Update**: SASS files optimized

### Files changed:

	scss/about.scss
	scss/customize.scss


## 1.0.5

* **Fix**: Time post meta info markup

### Files changed:

	inc/classes/class-core.php


## 1.0.4

* **Add**: Adding description text for post meta info

### Files changed:

	inc/classes/class-core.php


## 1.0.3

* **Add**: Support for WordPress 4.4

### Files changed:

	inc/classes/class-core.php


## 1.0.2

* **Update**: Localization

### Files changed:

	inc/classes/class-core.php


## 1.0.1

* **Add**: Support for Jetpack logo refresh in customizer
* **Update**: Removing obsolete variables
* **Update**: Adding JS comments
* **Fix**: Returning site logo "pre" hook output instead of echoing

### Files changed:

	inc/classes/class-core.php
	inc/classes/class-customize.php
	js/customize.js


## 1.0

* Initial release - Resetting versioning as this was complete recode from previous framework versions (last one was v4.0.4).


*WebMan WordPress Theme Framework, (C) WebMan Design, Oliver Juhas, www.webmandesign.eu*
