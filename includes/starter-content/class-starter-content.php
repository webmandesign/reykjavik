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
 * @version  1.0.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Content
 * 20) Partials
 */
class Reykjavik_Starter_Content {





	/**
	 * 0) Init
	 */

		private static $content;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		private function __construct() {}





	/**
	 * 10) Content
	 */

		/**
		 * Theme starter content
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function content() {

			// Processing

				// Loading

					self::attachments();

					self::widgets();

					self::pages();

					self::options();

					self::nav_menus();

				// Setup

					if ( ! empty( self::$content ) ) {
						add_theme_support( 'starter-content', self::$content );
					}

		} // /content





	/**
	 * 20) Partials
	 */

		/**
		 * Widgets
		 *
		 * @since    1.0.0
		 * @version  1.0.0
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
									'text'  => esc_html_x( 'Remove all widgets from sidebar to hide it.', 'Theme starter content', 'reykjavik' ),
								),
							),

						),

						'intro' => array(

							'text_intro_1' => array(
								'text',
								array(
									'title' => esc_html_x( 'Intro Widgets', 'Theme starter content', 'reykjavik' ),
									'text'  => esc_html_x( 'This is an Intro Widgets area. It only displays on pages with a specific page template assigned, or a dedicated option enabled.', 'Theme starter content', 'reykjavik' ),
									'icon'  => 'ion-ios-cart-outline'
								),
							),

							'text_intro_2' => array(
								'text',
								array(
									'title' => esc_html_x( 'Icons in Text Widget', 'Theme starter content', 'reykjavik' ),
									'text'  => esc_html_x( 'To allow displaying icons in Text widget you need some plugin to load the icons to your website. You can use any icons plugin.', 'Theme starter content', 'reykjavik' ),
									'icon'  => 'ion-ios-gear-outline'
								),
							),

							'text_intro_3' => array(
								'text',
								array(
									'title' => 'Lorem Ipsum',
									'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci.',
									'icon'  => 'ion-ios-checkmark-outline'
								),
							),

						),

						'footer' => array(
							'meta',

							'text_empty' => array(
								'text',
								array(
									'title' => '',
									'text'  => '',
								),
							),

							'text_business_info',
							'text_about',
						),

					);

		} // /widgets



		/**
		 * Pages
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function pages() {

			// Output

				self::$content['posts'] = array(

						'home' => array(
							'post_type'    => 'page',
							'template'     => 'templates/intro-widgets.php',
							'post_title'   => esc_html_x( 'Welcome to our site!', 'Theme starter content', 'reykjavik' ),
							'post_excerpt' => '<p>' . esc_html_x( 'Set this text as a page excerpt. You will most likely need to enable the excerpt field in screen options in the upper right corner of the screen when editing the page.', 'Theme starter content', 'reykjavik' ) . '</p><p><a href="#" class="button size-large">' . esc_html_x( 'Go shopping', 'Theme starter content', 'reykjavik' ) . '</a></p>',
							'post_content' => '<div class="outdent-content"><h2 class="uppercase h3">' .
							                  esc_html_x( 'WooCommerce featured products', 'Theme starter content', 'reykjavik' ) .
							                  '</h2>[featured_products per_page="3" columns="3"]<p><em><small>' .
							                  esc_html_x( 'You need to have WooCommerce plugin installed and activated for this shortcode to display your featured products.', 'Theme starter content', 'reykjavik' ) .
							                  '</small></em></p><hr></div><h2>' .
							                  esc_html_x( 'H2 headings are outdented', 'Theme starter content', 'reykjavik' ) .
							                  '</h2><p>' .
							                  esc_html_x( 'This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content', 'reykjavik' ) .
							                  '</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p><h2>' .
							                  esc_html_x( 'Page layout in 2 columns', 'Theme starter content', 'reykjavik' ) .
							                  '</h2><p>' .
							                  esc_html_x( 'By default the theme displays page content in 2 columns. You can change this to more traditional layout in theme options.', 'Theme starter content', 'reykjavik' ) .
							                  '</p>',
						),

						'about' => array(
							'thumbnail'    => '{{attachment-image-mystery-1}}',
							'post_type'    => 'page',
							'post_excerpt' => '<p>' . esc_html_x( 'Set this text as a page excerpt. You will most likely need to enable the excerpt field in screen options in the upper right corner of the screen when editing the page.', 'Theme starter content', 'reykjavik' ) . '</p>',
							'post_content' => '<h2>' .
							                  esc_html_x( 'Introduce yourself', 'Theme starter content', 'reykjavik' ) .
							                  '</h2><p>' .
							                  esc_html_x( 'You might be an artist who would like to introduce yourself and your work here or maybe you&rsquo;re a business with a mission to describe.', 'Theme starter content', 'reykjavik' ) .
							                  '</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p><h2 class="display-2 weight-300">2017</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p><h2 class="display-2 weight-300">2010</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>',
						),

						'news' => array(
							'thumbnail'    => '{{attachment-image-mystery-2}}',
							'post_type'    => 'page',
							'post_excerpt' => '<p>' . esc_html_x( 'Set this text as a page excerpt. You will most likely need to enable the excerpt field in screen options in the upper right corner of the screen when editing the page.', 'Theme starter content', 'reykjavik' ) . '</p>',
						),

						'contact' => array(
							'post_type'    => 'page',
							'template'     => 'templates/child-pages.php',
							'post_excerpt' => '<p>' . esc_html_x( 'Set this text as a page excerpt. You will most likely need to enable the excerpt field in screen options in the upper right corner of the screen when editing the page.', 'Theme starter content', 'reykjavik' ) . '</p>',
							'post_content' => '<h2>' .
							                  esc_html_x( 'Get in touch', 'Theme starter content', 'reykjavik' ) .
							                  '</h2><p>' .
							                  esc_html_x( 'This is a page with some basic contact information, such as an address and phone number. You might also try a plugin to add a contact form.', 'Theme starter content', 'reykjavik' ) .
							                  '</p><form><p style="width: 48%; float: left;"><label class="screen-reader-text" for="field1">' .
							                  esc_html_x( 'Your name', 'Theme starter content', 'reykjavik' ) .
							                  '</label><input id="field1" class="fullwidth" style="width: 100%;" type="text" placeholder="' .
							                  esc_html_x( 'Your name', 'Theme starter content', 'reykjavik' ) .
							                  '" /></p><p style="width: 48%; float: right;"><label class="screen-reader-text" for="field2">' .
							                  esc_html_x( 'Your email', 'Theme starter content', 'reykjavik' ) .
							                  '</label><input id="field2" class="fullwidth" style="width: 100%;" type="email" placeholder="' .
							                  esc_html_x( 'Your email', 'Theme starter content', 'reykjavik' ) .
							                  '" /></p><p style="clear: both;"><label class="screen-reader-text" for="field3">' .
							                  esc_html_x( 'Your message', 'Theme starter content', 'reykjavik' ) .
							                  '</label><textarea id="field3" class="fullwidth" style="width: 100%;" rows="2" placeholder="' .
							                  esc_html_x( 'Your message', 'Theme starter content', 'reykjavik' ) .
							                  '"></textarea></p><p><small>' .
							                  esc_html_x( 'This is only a dummy form placeholder. Use a plugin to create forms, such as Caldera Forms or Contact Form 7.', 'Theme starter content', 'reykjavik' ) .
							                  '</small></p><p><input type="submit" value="' .
							                  esc_html_x( 'This form does not work', 'Theme starter content', 'reykjavik' ) .
							                  '" /></p></form>',
						),

					);

		} // /pages



		/**
		 * Navigational menus
		 *
		 * @since    1.0.0
		 * @version  1.0.0
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

								'page_about',
								'page_news',
								'page_contact',

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
									'title' => esc_html_x( 'Simple', 'As in "Secondary simple navigational menu". Theme starter content.', 'reykjavik' ),
									'url'   => '#0',
								),

								'link_secondary_3' => array(
									'title' => esc_html_x( 'Menu', 'As in "Secondary simple navigational menu". Theme starter content.', 'reykjavik' ),
									'url'   => '#0',
								),

							),
						),

						'social' => array(
							'name' => esc_html_x( 'Social Links Menu', 'Theme starter content', 'reykjavik' ),
							'items' => array(

								'link_facebook' => array(
									'title' => esc_html_x( 'WebMan Design on Facebook', 'Theme starter content', 'reykjavik' ),
									'url'   => 'https://www.facebook.com/webmandesigneu',
								),

								'link_twitter' => array(
									'title' => esc_html_x( 'WebMan Design on Twitter', 'Theme starter content', 'reykjavik' ),
									'url'   => 'https://youtu.be/vvxP5n2vsrw',
								),

								'link_email',

							),
						),

					);

		} // /nav_menus



		/**
		 * WordPress options
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function options() {

			// Output

				self::$content['options'] = array(
						'show_on_front'       => 'page',
						'page_on_front'       => '{{home}}',
						'page_for_posts'      => '{{news}}',
						'posts_per_page'      => 6,
						'permalink_structure' => '/%postname%/',
						'external_header_video' => 'https://youtu.be/vvxP5n2vsrw',
					);

		} // /options



		/**
		 * Attachments
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function attachments() {

			// Output

				self::$content['attachments'] = array(

						'attachment-image-mystery-1' => array(
							'file' => 'assets/images/header/mystery-1.jpg',
						),

						'attachment-image-mystery-2' => array(
							'file' => 'assets/images/header/mystery-2.jpg',
						),

					);

		} // /attachments





} // /Reykjavik_Starter_Content

add_action( 'after_setup_theme', 'Reykjavik_Starter_Content::content' );
