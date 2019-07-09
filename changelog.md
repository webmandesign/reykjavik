# Reykjavik Changelog

## 2.0.1

* **Update**: Demo content
* **Update**: Starter CSS 5.0.1
* **Update**: Localization
* **Fix**: Blocks styles
* **Fix**: Wide and full alignment styles
* **Fix**: WooCommerce page width
* **Fix**: Styles fixes

### Files changed:

	changelog.md
	readme.txt
	style.css
	assets/scss/editor-style-blocks.scss
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	includes/frontend/class-content.php
	includes/plugins/one-click-demo-import/demo-content-reykjavik.xml
	includes/plugins/one-click-demo-import/demo-widgets-reykjavik.wie
	includes/starter-content/class-starter-content.php


## 2.0.0

* **Add**: Block editor (Gutenberg) full, advanced support
* **Update**: Improving and updating styles
* **Update**: Helper class names
* **Update**: Improving more tag functionality
* **Update**: Code formatting
* **Update**: Removing FitVids in favor of block editor responsive embeds and Jetpack's Responsive Videos
* **Update**: Theme colors for consistency
* **Update**: Theme options description
* **Update**: Updating post meta styles for better blocks support
* **Update**: Removing outdented page layout when page built using block editor
* **Update**: Localization
* **Update**: Theme info
* **Fix**: Post excerpt wrapper div application

### Files changed:

	changelog.md
	readme.txt
	style.css
	assets/js/scripts-edit-post.js
	assets/js/scripts-global.js
	assets/scss/_setup.scss
	assets/scss/custom-styles-woocommerce.scss
	assets/scss/custom-styles.scss
	assets/scss/editor-style-blocks.scss
	assets/scss/editor-style.scss
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	assets/scss/starter/*.*
	includes/customize/class-customize.php
	includes/frontend/class-assets.php
	includes/frontend/class-content.php
	includes/frontend/class-header.php
	includes/frontend/class-post-summary.php
	includes/plugins/beaver-builder/class-beaver-builder-form.php
	includes/plugins/beaver-builder/class-beaver-builder-setup.php
	includes/plugins/jetpack/class-jetpack.php
	includes/setup/class-setup.php
	includes/welcome/class-welcome.php
	includes/widgets/class-wp-widget-text.php
	languages/reykjavik.pot
	library/includes/classes/class-core.php
	library/includes/classes/class-visual-editor.php
	templates/parts/admin/media-image-sizes.php
	templates/parts/admin/welcome-promo.php
	templates/parts/admin/welcome-wordpress.php
	templates/parts/component/link-more.php
	templates/parts/footer/site-info.php


## 1.5.3

* **Add**: Adding WhatsApp and Google social icon
* **Update**: Implementing WordPress 5.2 code updates
* **Fix**: Preventing PHP error after theme activation

### Files changed:

	changelog.md
	header.php
	readme.txt
	style.css
	assets/images/svg/social-icons.svg
	includes/frontend/class-header.php
	includes/frontend/class-menu.php
	includes/welcome/welcome.php
	templates/parts/admin/notice-welcome.php
	templates/parts/admin/welcome-demo.php
	templates/parts/admin/welcome-footer.php
	templates/parts/admin/welcome-header.php
	templates/parts/admin/welcome-promo.php
	templates/parts/admin/welcome-quickstart.php
	templates/parts/admin/welcome-wordpress.php


## 1.5.2

* **Update**: Custom typography info in theme options
* **Update**: Updating info about demo required plugins
* **Update**: Improving Beaver Themer compatibility
* **Update**: Elementor Pro Theme Builder compatibility
* **Update**: Welcome page and notice
* **Update**: Improving accessibility skip links
* **Update**: Improving code
* **Update**: Styles
* **Update**: Localization
* **Fix**: "Continue reading" broken HTML for posts with more tag

### Files changed:

	changelog.md
	footer.php
	header.php
	readme.txt
	style.css
	assets/scss/custom-styles.scss
	includes/customize/class-customize.php
	includes/frontend/class-assets.php
	includes/frontend/class-footer.php
	includes/frontend/class-header.php
	includes/frontend/class-post-summary.php
	includes/frontend/class-post.php
	includes/plugins/bb-header-footer/class-bb-header-footer.php
	includes/plugins/beaver-themer/class-beaver-themer.php
	includes/plugins/elementor/class-elementor.php
	includes/plugins/elementor/elementor.php
	includes/plugins/one-click-demo-import/class-one-click-demo-import.php
	includes/setup/class-setup.php
	includes/welcome/class-welcome.php
	languages/reykjavik.pot
	library/includes/classes/class-core.php
	templates/parts/admin/notice-welcome.php
	templates/parts/admin/welcome-footer.php
	templates/parts/admin/welcome-header.php
	templates/parts/admin/welcome-promo.php
	templates/parts/content/content-child-page.php
	templates/parts/header/links-skip.php


## 1.5.1

* **Update**: Preventing JavaScript error for CSS variables incompatible browsers fallback

### Files changed:

	changelog.md
	readme.txt
	style.css
	library/includes/classes/class-css-variables.php


## 1.5.0

* **Update**: Improving touch screen navigation
* **Update**: Improving accessibility
* **Update**: Improving excerpt display
* **Update**: Improving Recent Posts widget enhancements
* **Update**: Improving security
* **Update**: Removing obsolete code

### Files changed:

	changelog.md
	readme.txt
	style.css
	assets/js/scripts-navigation-accessibility.js
	assets/scss/main.scss
	includes/frontend/class-menu.php
	includes/frontend/class-post-summary.php
	includes/widgets/class-wp-widget-recent-posts.php
	languages/reykjavik.pot
	templates/parts/component/link-more.php
	templates/parts/component/link-more-product.php
	templates/parts/content/content.php
	templates/parts/content/content-child-page.php
	templates/parts/intro/intro-content.php
	templates/parts/meta/entry-meta-element-comments.php
	templates/parts/meta/entry-meta-element-date.php


## 1.4.2

* **Fix**: Displaying default background image URL when no image set in theme options

### Files changed:

	changelog.md
	readme.txt
	style.css
	includes/customize/class-customize-styles.php


## 1.4.1

* **Fix**: Background image URL escaping in CSS code

### Files changed:

	changelog.md
	readme.txt
	style.css
	library/includes/classes/class-css-variables.php


## 1.4.0

* **Add**: WP Subtitle plugin compatibility
* **Update**: Support URL
* **Update**: Improving code
* **Update**: Improving security
* **Update**: Improving accessibility
* **Update**: Adding WPCS comments to code
* **Update**: `.screen-reader-text` CSS class styles
* **Update**: Improving customizer functionality
* **Update**: Using CSS variables instead of generating customized stylesheet
* **Update**: Removing obsolete functionality
* **Update**: Updating readme file
* **Update**: Setting `use strict` in JavaScript
* **Update**: Removing all `locate_template()` function references
* **Update**: Removing Smart Slider 3 code
* **Update**: Localization
* **Update**: Documentation

### Files changed:

	changelog.md
	functions.php
	readme.txt
	style.css
	assets/js/customize-preview.js
	assets/js/scripts-beaver-builder-editor.js
	assets/js/scripts-global.js
	assets/js/scripts-masonry.js
	assets/js/scripts-navigation-accessibility.js
	assets/js/scripts-navigation-mobile.js
	assets/js/scripts-widget-text.js
	assets/js/scripts-woocommerce.js
	assets/js/skip-link-focus-fix.js
	assets/scss/_css-vars.scss
	assets/scss/_setup.scss
	assets/scss/custom-styles-editor.scss
	assets/scss/custom-styles-woocommerce.scss
	assets/scss/custom-styles.scss
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	assets/scss/starter/_starter.scss
	includes/custom-header/class-intro.php
	includes/customize/class-customize-styles.php
	includes/customize/class-customize.php
	includes/frontend/class-assets.php
	includes/frontend/class-loop.php
	includes/frontend/class-menu.php
	includes/frontend/class-post-media.php
	includes/frontend/class-post.php
	includes/plugins/beaver-builder/class-beaver-builder-setup.php
	includes/plugins/elementor/class-elementor.php
	includes/plugins/one-click-demo-import/class-one-click-demo-import.php
	includes/plugins/subtitles/class-subtitles.php
	includes/plugins/subtitles/subtitles.php
	includes/plugins/woocommerce/class-woocommerce-assets.php
	includes/plugins/woocommerce/class-woocommerce-customize.php
	includes/plugins/woocommerce/class-woocommerce-loop.php
	includes/plugins/woocommerce/class-woocommerce-pages.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/plugins/woocommerce/class-woocommerce-wrappers.php
	includes/setup/class-setup.php
	includes/starter-content/class-starter-content.php
	includes/tgmpa/class-tgmpa-plugins.php
	includes/welcome/class-welcome.php
	includes/widgets/class-wp-widget-recent-posts.php
	languages/*.*
	library/init.php
	library/includes/classes/class-admin.php
	library/includes/classes/class-core.php
	library/includes/classes/class-css-variables.php
	library/includes/classes/class-customize-control-html.php
	library/includes/classes/class-customize-control-multiselect.php
	library/includes/classes/class-customize-control-radio-matrix.php
	library/includes/classes/class-customize-control-select.php
	library/includes/classes/class-customize.php
	library/includes/classes/class-sanitize.php
	library/js/customize-control-multicheckbox.js
	library/js/customize-control-radio-matrix.js
	library/js/customize-controls.js
	templates/parts/admin/welcome-header.php
	templates/parts/admin/welcome-promo.php
	templates/parts/admin/welcome-quickstart.php
	templates/parts/header/site-branding.php
	templates/parts/intro/intro-content.php
	templates/parts/menu/menu-social.php
	templates/parts/meta/entry-meta-element-category.php
	templates/parts/meta/entry-meta-element-comments.php
	templates/parts/meta/entry-meta-element-tags.php


## 1.3.1

* **Add**: More social icons
* **Update**: WordPress 5.0 ready
* **Update**: Loading Genericons Neue as separate stylesheet
* **Update**: Advanced Custom Fields plugin compatibility
* **Update**: Beaver Themer plugin compatibility
* **Fix**: Making social icons menu multilingual ready
* **Fix**: Compatibility with Beaver Builder 2.2
* **Fix**: Link in theme demo content (widgets)

### Files changed:

	changelog.md
	functions.php
	style.css
	assets/fonts/genericons-neue/*.*
	assets/images/svg/social-icons.svg
	assets/scss/main.scss
	includes/frontend/class-assets.php
	includes/frontend/class-header.php
	includes/frontend/class-menu.php
	includes/frontend/class-svg.php
	includes/plugins/advanced-custom-fields/advanced-custom-fields.php
	includes/plugins/advanced-custom-fields/class-advanced-custom-fields.php
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-builder/class-beaver-builder-column.php
	includes/plugins/beaver-builder/class-beaver-builder-row.php
	includes/plugins/beaver-themer/class-beaver-themer.php
	includes/plugins/woocommerce/class-woocommerce-pages.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/tgmpa/class-tgmpa-plugins.php
	library/includes/classes/class-visual-editor.php
	templates/parts/menu/menu-primary.php
	templates/parts/menu/menu-social.php


## 1.3.0

* **Add**: Options to change homepage intro overlay colors and opacity
* **Update**: Library 2.7.0
* **Update**: Removing archive page title label options in favor of plugin
* **Update**: Preventing Beaver Builder color presets JS error
* **Update**: Improved categories selector in enhanced Recent Posts widget
* **Update**: Localization
* **Fix**: Blog page excerpt and intro image display
* **Fix**: WooCommerce product variation select not working in Firefox browser
* **Fix**: Button styles
* **Fix**: All Envato Theme Check plugin test requirements
* **Fix**: Content indentation in page excerpt field when using Rich Text Excerpt plugin
* **Fix**: Masonry layout not applied on archive pages
* **Fix**: Jetpack Author Bio display

### Files changed:

	changelog.md
	style.css
	assets/js/scripts-masonry.js
	assets/scss/custom-styles.scss
	assets/scss/editor-style.scss
	assets/scss/main.scss
	includes/custom-header/class-intro.php
	includes/customize/class-customize-styles.php
	includes/customize/class-customize.php
	includes/frontend/class-assets.php
	includes/frontend/class-header.php
	includes/frontend/class-loop.php
	includes/frontend/class-menu.php
	includes/frontend/class-sidebar.php
	includes/plugins/beaver-builder/class-beaver-builder-setup.php
	includes/plugins/breadcrumb-navxt/class-breadcrumb-navxt.php
	includes/plugins/jetpack/class-jetpack.php
	includes/plugins/woocommerce/class-woocommerce-assets.php
	includes/plugins/woocommerce/class-woocommerce-customize.php
	includes/plugins/woocommerce/class-woocommerce-pages.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/setup/class-setup.php
	includes/starter-content/class-starter-content.php
	includes/welcome/welcome.php
	includes/widgets/class-wp-widget-recent-posts.php
	languages/reykjavik.pot
	library/*.*
	templates/parts/footer/site-info.php
	templates/parts/intro/intro-content.php
	templates/parts/menu/menu-primary.php


## 1.2.0

* **Add**: WooCommerce masonry products layout when product images are set to "uncropped"
* **Update**: WordPress 4.9.6 compatibility (GDPR)
* **Update**: Improved custom widget enhancements
* **Update**: Jetpack Testimonials shortcode styles
* **Update**: Jetpack Author Bio box styles
* **Update**: Beaver Builder compatibility
* **Update**: WooCommerce compatibility and styles
* **Fix**: Beaver Builder row width

### Files changed:

	changelog.md
	style.css
	assets/js/scripts-masonry.js
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	assets/scss/starter/_starter.scss
	includes/frontend/class-assets.php
	includes/frontend/class-header.php
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-builder/class-beaver-builder-form.php
	includes/plugins/jetpack/class-jetpack.php
	includes/plugins/woocommerce/class-woocommerce-loop.php
	includes/widgets/class-wp-widget-recent-posts.php
	includes/widgets/class-wp-widget-text.php
	templates/parts/footer/site-info.php


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
