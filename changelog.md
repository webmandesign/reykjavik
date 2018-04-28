# Reykjavik Changelog

## 1.1.2

* **Fix**: Just fixing the installer ZIP


## 1.1.1

* **Fix**: Backwards compatibility with Beaver Builder pre-2.1

### Files changed:

	changelog.md
	style.css
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-themer/class-beaver-themer.php


## 1.1.0

* **Add**: Elementor Pro Theme Builder compatibility!
* **Fix**: Compatibility with Beaver Builder 2.1+
* **Fix**: Beaver Themer post preview selector not working
* **Fix**: Back to top button accessibility
* **Fix**: Customizer logo partial refresh
* **Fix**: Preventing PHP error when WooCommerce shop page is not set

### Files changed:

	changelog.md
	functions.php
	style.css
	assets/js/scripts-global.js
	includes/customize/class-customize.php
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-themer/class-beaver-themer.php
	includes/plugins/elementor/class-elementor.php
	includes/plugins/elementor/elementor.php
	includes/plugins/woocommerce/class-woocommerce-pages.php


## 1.0.8

* **Fix**: Jetpack Infinite Scroll compatibility
* **Fix**: Mobile devices horizontal scroll

### Files changed:

	changelog.md
	style.css
	assets/scss/main.scss
	templates/parts/loop/loop.php


## 1.0.7

* **Fix**: Hiding WooCommerce 3.3 search form submit button
* **Fix**: WooCommerce cart cross-sells layout

### Files changed:

	changelog.md
	style.css
	assets/scss/custom-styles-editor.scss
	assets/scss/custom-styles.scss
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	includes/customize/class-customize.php
	library/changelog.md


## 1.0.6

* **Fix**: WooCommerce 3.3- backwards compatibility

### Files changed:

	changelog.md
	style.css
	includes/plugins/woocommerce/class-woocommerce-loop.php


## 1.0.5

* **Add**: Compatibility with WooCommerce 3.3 product grid options
* **Add**: Displaying post category and tags on single post page
* **Update**: Single post meta display
* **Update**: Hiding post meta on paginated/parted single post
* **Update**: Not disabling Jetpack sharing buttons on page builder posts/pages (leaving this to Jetpack per-post option)
* **Update**: Improving media player (playlist) styles
* **Update**: Welcome admin page
* **Fix**: Localization issue
* **Fix**: WooCommerce 3.3 pagination issue
* **Fix**: Jetpack Author Bio box styles
* **Fix**: Single post meta display when page builder is used
* **Fix**: Single post intro media responsive RTL styles
* **Fix**: Recent Posts widget "Continue reading" link URL
* **Fix**: Theme name displays localized when needed

### Files changed:

	changelog.md
	style.css
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	includes/customize/class-customize-styles.php
	includes/customize/class-customize.php
	includes/frontend/class-header.php
	includes/frontend/class-loop.php
	includes/plugins/jetpack/class-jetpack.php
	includes/plugins/woocommerce/class-woocommerce-loop.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/plugins/woocommerce/class-woocommerce-widgets.php
	includes/setup/class-setup.php
	includes/widgets/class-wp-widget-recent-posts.php
	includes/widgets/class-wp-widget-text.php
	languages/reykjavik.pot
	templates/parts/admin/welcome-header.php
	templates/parts/admin/welcome-promo.php
	templates/parts/footer/site-info.php
	templates/parts/meta/entry-meta.php


## 1.0.4

* **Update**: Future proofing custom Text widget enhancement
* **Update**: Post meta styles on single post pages
* **Update**: Media player styles

### Files changed:

	changelog.md
	style.css
	assets/scss/main.scss
	includes/widgets/class-wp-widget-text.php


## 1.0.3

* **Fix**: Duplicate declaration of `float()` sanitize method

### Files changed:

	changelog.md
	style.css
	library/includes/classes/class-sanitize.php


## 1.0.2

* **Add**: Recommending Jetpack plugin installation
* **Update**: Library 2.5.6
* **Update**: Removed obsolete language files (theme is fully translatable via WPORG repository)
* **Update**: Theme description and tags

### Files changed:

	changelog.md
	style.css
	includes/tgmpa/class-tgmpa-plugins.php
	library/*.*


## 1.0.1

* **Update**: One Click Demo Import demo files moved to the plugin setup folder
* **Update**: Welcome admin page theme rating link
* **Update**: Code formatting
* **Update**: Compatible with WordPress 4.9
* **Update**: CSS Starter 3.16.0
* **Update**: Library 2.5.5
* **Update**: Documentation
* **Fix**: Author archive page layout
* **Fix**: Recent Posts widget compatibility with Subtitles plugin

### Files changed:

	changelog.md
	style.css
	assets/scss/_setup.scss
	assets/scss/starter/*.*
	includes/frontend/class-header.php
	includes/plugins/one-click-demo-import/class-one-click-demo-import.php
	includes/widgets/class-wp-widget-recent-posts.php
	library/*.*
	templates/parts/admin/welcome-promo.php


## 1.0.0

* Initial release.
