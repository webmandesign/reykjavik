<?php
/**
 * Theme Starter Content Class
 *
 * @link  https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.1
 *
 * Contents:
 *
 *  0) Init
 * 10) Partials
 */
class Reykjavik_Starter_Content {





	/**
	 * 0) Init
	 */

		private static $content;



		/**
		 * Initialization.
		 *
		 * @since    1.0.0
		 * @version  2.0.1
		 */
		public static function init() {

			// Processing

				// Setting content.
				self::attachments();
				self::widgets();
				self::pages();
				self::options();
				self::nav_menus();

				// Registering content.
				if ( ! empty( self::$content ) ) {
					add_theme_support( 'starter-content', self::$content );
				}

		} // /init





	/**
	 * 10) Partials
	 */

		/**
		 * Widgets.
		 *
		 * @since    1.0.0
		 * @version  2.0.1
		 */
		public static function widgets() {

			// Output

				self::$content['widgets'] = array(

					'sidebar' => array(

						'search',

						'text_sidebar' => array(
							'text',
							array(
								'title' => esc_html_x( 'How to hide sidebar?', 'Theme starter content', 'reykjavik' ),
								'text'  => esc_html_x( 'Remove all widgets from sidebar to hide it.', 'Theme starter content', 'reykjavik' ) . ' ' . esc_html_x( 'Or use a sidebar management plugin to manage all widget areas on your website and create your own ones.', 'Theme starter content', 'reykjavik' ),
							),
						),

					),

					'intro' => array(

						'text_intro_1' => array(
							'text',
							array(
								'title' => esc_html_x( 'Intro Widgets', 'Theme starter content', 'reykjavik' ),
								'text'  => esc_html_x( 'This is an Intro Widgets area displayed on a special page template.', 'Theme starter content', 'reykjavik' ),
								'icon'  => 'genericons-neue genericons-neue-anchor',
								'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/boat-in-harbor.jpg',
							),
						),

						'text_intro_2' => array(
							'text',
							array(
								'title' => 'Lorem Ipsum',
								'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris.',
								'icon'  => 'genericons-neue genericons-neue-cart',
								'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/boat-sailing.jpg',
							),
						),

						'text_intro_3' => array(
							'text',
							array(
								'title' => 'Lorem Ipsum',
								'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris.',
								'icon'  => 'genericons-neue genericons-neue-phone',
								'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/boat-sailing-side-wind.jpg',
							),
						),

					),

					'footer' => array(
						'meta',

						'html_empty' => array(
							'custom_html',
							array(
								'title'    => '',
								'content'  => '<!-- Empty space placeholder. -->',
							),
						),

						'text_business_info',
						'text_about',
					),

				);

		} // /widgets



		/**
		 * Pages.
		 *
		 * @since    1.0.0
		 * @version  2.0.1
		 */
		public static function pages() {

			// Output

				self::$content['posts'] = array(

					'home' => array(
						'post_type'  => 'page',
						'template'   => 'templates/intro-widgets.php',
						'post_title' => esc_html_x( 'Hello from Reykjavik', 'Theme starter content', 'reykjavik' ),

						'post_excerpt' =>
							'<p>'
								. esc_html_x( 'This is a page/post excerpt text.', 'Theme starter content', 'reykjavik' )
								. ' '
								. '<a href="http://easycaptures.com/fs/uploaded/1105/7384447174.jpg">'
								. esc_html_x( 'How to edit excerpt field content?', 'Theme starter content', 'reykjavik' )
								. '</a>'
							. '</p>'
							. '<p>'
								. '<a href="#" class="button">'
								. esc_html_x( 'Go shopping', 'Theme starter content', 'reykjavik' )
								. '</a>'
							. '</p>',

						'post_content' =>
							'<!-- wp:heading -->
							<h2>' . esc_html_x( 'Welcome to our website!', 'Theme starter content', 'reykjavik' ) . '</h2>
							<!-- /wp:heading -->

							<!-- wp:paragraph {"fontSize":"extra-large"} -->
							<p class="has-extra-large-font-size">' . esc_html_x( 'This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content', 'reykjavik' ) . ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas et, vulputate orci.</p>
							<!-- /wp:paragraph -->

							<!-- wp:separator {"className":"is-style-dots"} -->
							<hr class="wp-block-separator is-style-dots"/>
							<!-- /wp:separator -->

							<!-- wp:columns {"align":"wide"} -->
							<div class="wp-block-columns alignwide has-2-columns"><!-- wp:column -->
							<div class="wp-block-column"><!-- wp:heading -->
							<h2>Lorem ipsum dolor</h2>
							<!-- /wp:heading --></div>
							<!-- /wp:column -->

							<!-- wp:column -->
							<div class="wp-block-column"><!-- wp:paragraph {"className":"uppercase"} -->
							<p class="uppercase">Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>
							<!-- /wp:paragraph -->

							<!-- wp:paragraph -->
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>
							<!-- /wp:paragraph --></div>
							<!-- /wp:column --></div>
							<!-- /wp:columns -->

							<!-- wp:spacer {"height":50} -->
							<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:image {"align":"wide"} -->
							<figure class="wp-block-image alignwide"><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/waves.jpg" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:spacer {"height":50} -->
							<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:heading {"align":"center"} -->
							<h2 style="text-align:center">Lorem ipsum dolor sit amet</h2>
							<!-- /wp:heading -->

							<!-- wp:paragraph {"align":"center"} -->
							<p style="text-align:center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /> Vestibulum in mauris eleifend, egestas lectus et, vulputate orci.</p>
							<!-- /wp:paragraph -->

							<!-- wp:button {"align":"center","className":"is-style-squared"} -->
							<div class="wp-block-button aligncenter is-style-squared"><a class="wp-block-button__link" href="#0">Lorem ipsum →</a></div>
							<!-- /wp:button -->',
					),

					'shop' => array(
						'thumbnail'  => '{{image-header}}',
						'post_type'  => 'page',
						'template'   => 'templates/intro-widgets.php',
						'post_title' => esc_html_x( 'WooCommerce shop homepage', 'Theme starter content', 'reykjavik' ),

						'post_excerpt' =>
							'<p>'
								. esc_html_x( 'This is a page/post excerpt text.', 'Theme starter content', 'reykjavik' )
								. ' '
								. '<a href="http://easycaptures.com/fs/uploaded/1105/7384447174.jpg">'
								. esc_html_x( 'How to edit excerpt field content?', 'Theme starter content', 'reykjavik' )
								. '</a>'
							. '</p>',

						'post_content' =>
							'<!-- wp:columns {"align":"wide"} -->
							<div class="wp-block-columns alignwide has-2-columns"><!-- wp:column -->
							<div class="wp-block-column"><!-- wp:heading -->
							<h2>' . esc_html_x( 'Featured products', 'Theme starter content', 'reykjavik' ) . '</h2>
							<!-- /wp:heading --></div>
							<!-- /wp:column -->

							<!-- wp:column -->
							<div class="wp-block-column"><!-- wp:paragraph -->
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat.</p>
							<!-- /wp:paragraph --></div>
							<!-- /wp:column --></div>
							<!-- /wp:columns -->

							<!-- wp:spacer -->
							<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:woocommerce/handpicked-products {"align":"wide","editMode":false,"products":[185,184,177]} -->
							<div class="wp-block-woocommerce-handpicked-products alignwide">[products limit="3" columns="3" orderby="date" order="DESC" ids="185,184,177"]</div>
							<!-- /wp:woocommerce/handpicked-products -->

							<!-- wp:spacer -->
							<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:image {"align":"wide"} -->
							<figure class="wp-block-image alignwide"><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/waves.jpg" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:spacer -->
							<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:columns {"align":"wide"} -->
							<div class="wp-block-columns alignwide has-2-columns"><!-- wp:column -->
							<div class="wp-block-column"><!-- wp:heading -->
							<h2>' . esc_html_x( 'Newest products', 'Theme starter content', 'reykjavik' ) . '</h2>
							<!-- /wp:heading --></div>
							<!-- /wp:column -->

							<!-- wp:column -->
							<div class="wp-block-column"><!-- wp:paragraph -->
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat.</p>
							<!-- /wp:paragraph --></div>
							<!-- /wp:column --></div>
							<!-- /wp:columns -->

							<!-- wp:spacer -->
							<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:woocommerce/product-new {"align":"wide"} -->
							<div class="wp-block-woocommerce-product-new alignwide">[products limit="3" columns="3" orderby="date" order="DESC"]</div>
							<!-- /wp:woocommerce/product-new -->

							<!-- wp:spacer -->
							<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:image {"align":"wide"} -->
							<figure class="wp-block-image alignwide"><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/waves.jpg" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:spacer -->
							<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:columns {"columns":3,"align":"wide"} -->
							<div class="wp-block-columns alignwide has-3-columns"><!-- wp:column -->
							<div class="wp-block-column"><!-- wp:heading -->
							<h2>Lorem ipsum</h2>
							<!-- /wp:heading --></div>
							<!-- /wp:column -->

							<!-- wp:column -->
							<div class="wp-block-column"><!-- wp:paragraph -->
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo consequat.</p>
							<!-- /wp:paragraph --></div>
							<!-- /wp:column -->

							<!-- wp:column -->
							<div class="wp-block-column"><!-- wp:paragraph -->
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo consequat.</p>
							<!-- /wp:paragraph --></div>
							<!-- /wp:column --></div>
							<!-- /wp:columns -->',
					),

					'about' => array(
						'post_type' => 'page',

						'post_excerpt' =>
							'<p>'
								. esc_html_x( 'This is a page/post excerpt text.', 'Theme starter content', 'reykjavik' )
								. ' '
								. '<a href="http://easycaptures.com/fs/uploaded/1105/7384447174.jpg">'
								. esc_html_x( 'How to edit excerpt field content?', 'Theme starter content', 'reykjavik' )
								. '</a>'
							. '</p>',

						'post_content' =>
							'<!-- wp:heading -->
							<h2>' . esc_html_x( 'Introduce yourself', 'Theme starter content', 'reykjavik' ) . '</h2>
							<!-- /wp:heading -->

							<!-- wp:paragraph {"fontSize":"large"} -->
							<p class="has-large-font-size">' . esc_html_x( 'You might be an artist who would like to introduce yourself and your work here or maybe you&rsquo;re a business with a mission to describe.', 'Theme starter content', 'reykjavik' ) . ' Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							<!-- /wp:paragraph -->

							<!-- wp:separator {"className":"is-style-wide"} -->
							<hr class="wp-block-separator is-style-wide"/>
							<!-- /wp:separator -->

							<!-- wp:columns {"align":"wide"} -->
							<div class="wp-block-columns alignwide has-2-columns"><!-- wp:column -->
							<div class="wp-block-column"><!-- wp:heading {"level":3,"className":"has-display-2-font-size"} -->
							<h3 class="has-display-2-font-size">2013</h3>
							<!-- /wp:heading --></div>
							<!-- /wp:column -->

							<!-- wp:column -->
							<div class="wp-block-column"><!-- wp:paragraph -->
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>
							<!-- /wp:paragraph --></div>
							<!-- /wp:column --></div>
							<!-- /wp:columns -->

							<!-- wp:spacer -->
							<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:columns {"align":"wide"} -->
							<div class="wp-block-columns alignwide has-2-columns"><!-- wp:column -->
							<div class="wp-block-column"><!-- wp:heading {"level":3,"className":"has-display-2-font-size"} -->
							<h3 class="has-display-2-font-size">2019</h3>
							<!-- /wp:heading --></div>
							<!-- /wp:column -->

							<!-- wp:column -->
							<div class="wp-block-column"><!-- wp:paragraph -->
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>
							<!-- /wp:paragraph --></div>
							<!-- /wp:column --></div>
							<!-- /wp:columns -->

							<!-- wp:spacer -->
							<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:image {"align":"wide"} -->
							<figure class="wp-block-image alignwide"><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/waves.jpg" alt="" /></figure>
							<!-- /wp:image -->

							<!-- wp:spacer {"height":50} -->
							<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
							<!-- /wp:spacer -->

							<!-- wp:heading -->
							<h2>Here we are now</h2>
							<!-- /wp:heading -->

							<!-- wp:paragraph -->
							<p>Lorem ipsum dolor sit amet consectetur adipiscing elit lobortis magna, ultrices porta hac fusce lacus etiam hendrerit non morbi risus, sociis volutpat turpis bibendum litora vestibulum accumsan augue. Sapien gravida aenean himenaeos aptent vitae taciti donec, curabitur parturient fames massa imperdiet quisque.</p>
							<!-- /wp:paragraph -->',
					),

					'news' => array(
						'thumbnail' => '{{image-header}}',
						'post_type' => 'page',

						'post_excerpt' =>
							'<p>'
								. esc_html_x( 'This is a page/post excerpt text.', 'Theme starter content', 'reykjavik' )
								. ' '
								. '<a href="http://easycaptures.com/fs/uploaded/1105/7384447174.jpg">'
								. esc_html_x( 'How to edit excerpt field content?', 'Theme starter content', 'reykjavik' )
								. '</a>'
							. '</p>',
					),

					'contact' => array(
						'post_type' => 'page',
						'template'  => 'templates/intro-widgets.php',

						'post_excerpt' =>
							'<p>'
								. esc_html_x( 'This is a page/post excerpt text.', 'Theme starter content', 'reykjavik' )
								. ' '
								. '<a href="http://easycaptures.com/fs/uploaded/1105/7384447174.jpg">'
								. esc_html_x( 'How to edit excerpt field content?', 'Theme starter content', 'reykjavik' )
								. '</a>'
							. '</p>',

						'post_content' =>
							'<!-- wp:columns {"align":"wide"} -->
							<div class="wp-block-columns alignwide has-2-columns"><!-- wp:column -->
							<div class="wp-block-column"><!-- wp:heading -->
							<h2>' . esc_html_x( 'Get in touch', 'Theme starter content', 'reykjavik' ) . '</h2>
							<!-- /wp:heading --></div>
							<!-- /wp:column -->

							<!-- wp:column -->
							<div class="wp-block-column"><!-- wp:paragraph -->
							<p>' . esc_html_x( 'This is a page with some basic contact information, such as an address and phone number. You might also try a plugin to add a contact form.', 'Theme starter content', 'reykjavik' ) . '</p>
							<!-- /wp:paragraph -->

							<!-- wp:html -->
							<form>
							<p style="width: 48%; float: left;"><input id="field1" class="fullwidth" style="width: 100%;" type="text" placeholder="' . esc_attr_x( 'Your name', 'Theme starter content', 'reykjavik' ) . '"/></p>
							<p style="width: 48%; float: right;"><input id="field2" class="fullwidth" style="width: 100%;" type="email" placeholder="' . esc_attr_x( 'Your email', 'Theme starter content', 'reykjavik' ) . '"/></p>
							<p style="clear: both;"><textarea id="field3" class="fullwidth" style="width: 100%;" rows="2" placeholder="' . esc_attr_x( 'Your message', 'Theme starter content', 'reykjavik' ) . '"></textarea></p>
							<p><small>' . esc_html_x( 'This is only a dummy form placeholder. It does not work. Use a plugin to create forms for your website.', 'reykjavik' ) . '</small></p>
							<p><input type="submit" value="' . esc_attr_x( 'This form does not work', 'Theme starter content', 'reykjavik' ) . '"/></p>
							</form>
							<!-- /wp:html --></div>
							<!-- /wp:column --></div>
							<!-- /wp:columns -->',
					),

				);

		} // /pages



		/**
		 * Navigational menus.
		 *
		 * @since    1.0.0
		 * @version  2.0.1
		 */
		public static function nav_menus() {

			// Output

				self::$content['nav_menus'] = array(

					'primary' => array(
						'name' => esc_html_x( 'Primary Menu', 'Theme starter content', 'reykjavik' ),
						'items' => array(

							'page_home' => array(
								'title' => esc_html_x( 'Home', 'Theme starter content', 'reykjavik' ),
							),

							'page_shop' => array(
								'title'     => esc_html_x( 'Shop', 'Theme starter content', 'reykjavik' ),
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{shop}}',
							),

							'page_about',
							'page_news',
							'page_contact',

							'link_documentation' => array(
								'title' => esc_html_x( 'Docs', 'Short for "documentation". Theme starter content.', 'reykjavik' ),
								'url'   => 'https://webmandesign.github.io/docs/reykjavik',
							),

						),
					),

					'secondary' => array(
						'name' => esc_html_x( 'Secondary Menu', 'Theme starter content', 'reykjavik' ),
						'items' => array(

							'link_secondary_1' => array(
								'title' => esc_html_x( 'Secondary', 'As in "Secondary simple navigational menu". Theme starter content.', 'reykjavik' ),
								'url'   => '#0',
							),

							'link_secondary_2' => array(
								'title' => esc_html_x( 'Menu', 'As in "Secondary simple navigational menu". Theme starter content.', 'reykjavik' ),
								'url'   => '#0',
							),

						),
					),

					'social' => array(
						'name' => esc_html_x( 'Social Links Menu', 'Theme starter content', 'reykjavik' ),
						'items' => array(

							'link_facebook' => array(
								'title' => esc_html_x( 'Facebook', 'Theme starter content', 'reykjavik' ),
								'url'   => 'https://www.facebook.com/',
							),

							'link_twitter' => array(
								'title' => esc_html_x( 'Twitter', 'Theme starter content', 'reykjavik' ),
								'url'   => 'https://twitter.com/',
							),

							'link_email',

						),
					),

				);

		} // /nav_menus



		/**
		 * WordPress options.
		 *
		 * @since    1.0.0
		 * @version  2.0.1
		 */
		public static function options() {

			// Output

				self::$content['options'] = array(
					'show_on_front'       => 'page',
					'page_on_front'       => '{{home}}',
					'page_for_posts'      => '{{news}}',
					'posts_per_page'      => 6,
					'permalink_structure' => '/%postname%/',
					'external_header_video' => 'https://www.youtube.com/watch?v=HbXTFQXnhmY',
				);

		} // /options



		/**
		 * Attachments.
		 *
		 * @since    1.0.0
		 * @version  2.0.1
		 */
		public static function attachments() {

			// Output

				self::$content['attachments'] = array(

					'image-header' => array(
						'file' => 'assets/images/header/pixabay-colorado-1436681.png',
					),

				);

		} // /attachments





} // /Reykjavik_Starter_Content

add_action( 'after_setup_theme', 'Reykjavik_Starter_Content::init' );
