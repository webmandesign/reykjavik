<?php
/**
 * SVG Class
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
 * 10) Include SVG images
 * 20) Return SVG markup
 */
class Reykjavik_SVG {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'wp_footer', __CLASS__ . '::include_files', 9999 );

						// Social menu SVG symbols cache flush

							add_action( 'wp_update_nav_menu',   __CLASS__ . '::social_icons_symbols_cache_flush' );
							add_action( 'customize_save_after', __CLASS__ . '::social_icons_symbols_cache_flush' );
							add_action( 'wmhook_reykjavik_library_theme_upgrade', __CLASS__ . '::social_icons_symbols_cache_flush' );

		} // /__construct



		/**
		 * Initialization (get instance)
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function init() {

			// Processing

				if ( null === self::$instance ) {
					self::$instance = new self;
				}


			// Output

				return self::$instance;

		} // /init





	/**
	 * 10) Include SVG images
	 */

		/**
		 * Add SVG definitions to the footer
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function include_files() {

			// Processing

				// Social icons SVG sprite

					if ( has_nav_menu( 'social' ) && $social_icons = self::get_social_icons_symbols() ) {
						echo '<svg style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs>' . $social_icons . '</defs></svg>';
					}

		} // /include_files



		/**
		 * Get markup for social icons we need only
		 *
		 * @uses  `wmhook_reykjavik_social_links_icons` global hook
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function get_social_icons_symbols() {

			// Helper variables

				$is_customize_preview = is_customize_preview();

				$output = ( $is_customize_preview ) ? ( '' ) : ( (string) get_transient( 'reykjavik_social_icons_symbols' ) );

				// Output cache if it's set

					if ( $output ) {
						return $output;
					}

				$social_icons      = (array) apply_filters( 'wmhook_reykjavik_social_links_icons', array() );
				$menu_locations    = get_nav_menu_locations();
				$social_menu_items = ( isset( $menu_locations['social'] ) ) ? ( wp_get_nav_menu_items( $menu_locations['social'] ) ) : ( array() );


			// Requirements check

				if ( empty( $social_icons ) || empty( $social_menu_items ) ) {
					return;
				}


			// Processing

				ob_start();

				// Always load chain symbol as a fallback

					locate_template( 'assets/images/svg/symbol-chain.svg', true );

				// Then load only the icons we need (except in customizer preview load all)

					if ( $is_customize_preview ) {

						foreach ( $social_icons as $icon ) {
							locate_template( 'assets/images/svg/symbol-' . sanitize_title( $icon ) . '.svg', true );
						}

					} else {

						foreach ( $social_menu_items as $menu_item ) {
							foreach ( $social_icons as $url => $icon ) {
								if ( false !== strpos( $menu_item->url, $url ) ) {
									locate_template( 'assets/images/svg/symbol-' . sanitize_title( $icon ) . '.svg', true );
									break;
								}
							}
						}

					}

				$output = ob_get_clean();

				// Cache the markup

					set_transient( 'reykjavik_social_icons_symbols', $output );


			// Output

				return $output;

		} // /get_social_icons_symbols



		/**
		 * Flush social icons symbols markup cache
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function social_icons_symbols_cache_flush() {

			// Processing

				delete_transient( 'reykjavik_social_icons_symbols' );

		} // /social_icons_symbols_cache_flush





	/**
	 * 20) Return SVG markup
	 */

		/**
		 * Site navigation
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param array $args {
		 *     Parameters needed to display an SVG.
		 *
		 *     @type string  $icon      Required SVG icon filename.
		 *     @type string  $title     Optional SVG title.
		 *     @type string  $desc      Optional SVG description.
		 *     @type string  $class     Optional SVG class.
		 *     @type string  $base      Optional SVG ID base.
		 *     @type boolean $fallback  Output an SVG fallback markup?
		 * }
		 */
		public static function get( $args = array() ) {

			// Requirements check

				if (
						empty( $args )
						|| false === array_key_exists( 'icon', $args )
					) {
					return;
				}


			// Helper variables

				$output = array();

				$args = wp_parse_args( $args, array(
						'icon'     => '',
						'title'    => '',
						'desc'     => '',
						'class'    => 'svgicon',
						'base'     => 'icon',
						'fallback' => false,
					) );

				$args = (array) apply_filters( 'wmhook_reykjavik_svg_get_args', $args );

				$aria_hidden     = ' aria-hidden="true"';
				$aria_labelledby = '';

				/**
				 * This theme doesn't use the SVG title or description attributes; non-decorative icons are described with .screen-reader-text.
				 *
				 * However, child themes can use the title and description to add information to non-decorative SVG icons to improve accessibility.
				 *
				 * Example 1 with title: <?php echo Reykjavik_SVG::get( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ) ) ); ?>
				 *
				 * Example 2 with title and description: <?php echo Reykjavik_SVG::get( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ), 'desc' => __( 'This is the description', 'textdomain' ) ) ); ?>
				 *
				 * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
				 */
				if ( $args['title'] ) {

					$aria_hidden     = '';
					$unique_id       = uniqid();
					$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

					if ( $args['desc'] ) {
						$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
					}

				}


			// Processing

				$output[10] = '<svg class="' . esc_attr( $args['class'] ) . ' ' . esc_attr( $args['base'] ) . '-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

				if ( $args['title'] ) {

					$output[15] = '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

					if ( $args['desc'] ) {
						$output[16] = '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
					}

				}

				/**
				 * Display the icon.
				 *
				 * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
				 *
				 * See https://core.trac.wordpress.org/ticket/38387.
				 * See https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/xlink:href.
				 */
				$output[20] = ' <use href="#' . esc_attr( $args['base'] ) . '-' . esc_html( $args['icon'] ) . '" xlink:href="#' . esc_attr( $args['base'] ) . '-' . esc_html( $args['icon'] ) . '"></use> ';

				// Add some markup to use as a fallback for browsers that do not support SVGs

					if ( $args['fallback'] ) {
						$output[25] = '<span class="svg-fallback ' . esc_attr( $args['base'] ) . '-' . esc_attr( $args['icon'] ) . '"></span>';
					}

				$output[30] = '</svg>';

				$output = (array) apply_filters( 'wmhook_reykjavik_svg_get_output', $output, $args );

				ksort( $output );


			// Output

				return implode( '', $output );

		} // /get





} // /Reykjavik_SVG

add_action( 'after_setup_theme', 'Reykjavik_SVG::init' );
