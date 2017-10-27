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
									'text'  => esc_html_x( 'Remove all widgets from sidebar to hide it.', 'Theme starter content', 'reykjavik' ) . ' ' . esc_html_x( 'Or use WooSidebars plugin to manage all widget areas on your website and create your own ones.', 'Theme starter content', 'reykjavik' ),
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
							'post_title'   => esc_html_x( 'Hello from Reykjavik', 'Theme starter content', 'reykjavik' ),
							'post_excerpt' => '<p>' . esc_html_x( 'This is a page/post excerpt text. You might need to enable the excerpt field in screen options first when editing the page/post.', 'Theme starter content', 'reykjavik' ) . '</p><p><a href="#" class="button">' . esc_html_x( 'Go shopping', 'Theme starter content', 'reykjavik' ) . '</a></p>',
							'post_content' => '<div class="outdent-content"><h2 class="display-1">' .
							                  esc_html_x( 'Welcome to our website!', 'Theme starter content', 'reykjavik' ) .
							                  '</h2><p class="h3">' .
							                  esc_html_x( 'This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content', 'reykjavik' ) .
							                  ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci.</p><p>&nbsp;</p><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/waves.jpg" alt="" /><p>&nbsp;</p></div>' .

							                  '<h2>' .
							                  esc_html_x( 'In default page layout&hellip;', 'Theme starter content', 'reykjavik' ) .
							                  '</h2><div class="text-columns-2"><p>' .
							                  esc_html_x( 'By default the theme displays page content in 2 columns. You can change this to more traditional layout in theme options.', 'Theme starter content', 'reykjavik' ) .
							                  '</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, vulputate orci. Integer in leo eget.</p></div>' .

							                  '<h2>' .
							                  esc_html_x( '&hellip;H2 headings are outdented', 'Theme starter content', 'reykjavik' ) .
							                  '</h2>' .
							                  '<div class="text-columns-2"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p></div>',
						),

						'shop' => array(
							'thumbnail'    => '{{image-header}}',
							'post_type'    => 'page',
							'template'     => 'templates/intro-widgets.php',
							'post_title'   => esc_html_x( 'WooCommerce shop homepage', 'Theme starter content', 'reykjavik' ),
							'post_excerpt' => '<p>' . esc_html_x( 'This is a page/post excerpt text. You might need to enable the excerpt field in screen options first when editing the page/post.', 'Theme starter content', 'reykjavik' ) . '</p>',
							'post_content' => '<h2>' .
							                  esc_html_x( 'Featured products', 'Theme starter content', 'reykjavik' ) .
							                  '</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat.</p>' .
							                  '<div class="outdent-content">' .
							                  '[products visibility="featured" limit="3" columns="3" orderby="date" order="DESC"]' .
							                  '<p><em><small>' .
							                  esc_html_x( 'You need to have WooCommerce plugin installed and activated for this shortcode to display your products.', 'Theme starter content', 'reykjavik' ) .
							                  '</small></em></p><p>&nbsp;</p><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/waves.jpg" alt="" />' .
							                  '</div>' .

							                  '<h2>' .
							                  esc_html_x( 'Shop categories', 'Theme starter content', 'reykjavik' ) .
							                  '</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat.</p>' .
							                  '<div class="outdent-content">' .
							                  '[product_categories limit="3" columns="3"]' .
							                  '<p><em><small>' .
							                  esc_html_x( 'You need to have WooCommerce plugin installed and activated for this shortcode to display your product categories.', 'Theme starter content', 'reykjavik' ) .
							                  '</small></em></p><p>&nbsp;</p><img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/images/starter-content/waves.jpg" alt="" />' .
							                  '</div>' .

							                  '<h2>' .
							                  esc_html_x( 'Shortly about us', 'Theme starter content', 'reykjavik' ) .
							                  '</h2>' .
							                  '<div class="text-columns-2">' .
							                  '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>' .
							                  '</div>' .
							                  '<img src="https://sample.webmandesign.eu/signature-webman-design-black-320.png" alt="WebMan Design signature" />',
						),

						'about' => array(
							'post_type'    => 'page',
							'post_excerpt' => '<p>' . esc_html_x( 'This is a page/post excerpt text. You might need to enable the excerpt field in screen options first when editing the page/post.', 'Theme starter content', 'reykjavik' ) . '</p>',
							'post_content' => '<h2>' .
							                  esc_html_x( 'Introduce yourself', 'Theme starter content', 'reykjavik' ) .
							                  '</h2>' .
							                  '<p class="uppercase">' .
							                  esc_html_x( 'You might be an artist who would like to introduce yourself and your work here or maybe you&rsquo;re a business with a mission to describe.', 'Theme starter content', 'reykjavik' ) .
							                  '</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>' .

							                  '<div class="outdent-content">[embed]https://www.youtube.com/watch?v=fbkEmW6PlXs[/embed]</div>' .

							                  '<h2 class="display-2 weight-300">2017</h2>' .
							                  '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>' .

							                  '<h2 class="display-2 weight-300">2010</h2>' .
							                  '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in mauris eleifend, egestas lectus et, vulputate orci. Integer in leo eget justo hendrerit consequat. Donec varius est eu neque ultrices consectetur.</p>',
						),

						'news' => array(
							'thumbnail'    => '{{image-header}}',
							'post_type'    => 'page',
							'post_excerpt' => '<p>' . esc_html_x( 'This is a page/post excerpt text. You might need to enable the excerpt field in screen options first when editing the page/post.', 'Theme starter content', 'reykjavik' ) . '</p>',
						),

						'contact' => array(
							'post_type'    => 'page',
							'template'     => 'templates/intro-widgets.php',
							'post_excerpt' => '<p>' . esc_html_x( 'This is a page/post excerpt text. You might need to enable the excerpt field in screen options first when editing the page/post.', 'Theme starter content', 'reykjavik' ) . '</p>',
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
						'external_header_video' => 'https://www.youtube.com/watch?v=HbXTFQXnhmY',
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

						'image-header' => array(
							'file' => 'assets/images/header/pixabay-colorado-1436681.png',
						),

					);

		} // /attachments





} // /Reykjavik_Starter_Content

add_action( 'after_setup_theme', 'Reykjavik_Starter_Content::content' );
