<?php
/**
 * Welcome Page Class.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.2.0
 */
class Reykjavik_Welcome {

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

					add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles' );

					add_action( 'admin_menu', __CLASS__ . '::admin_menu' );

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
	 * Render the screen content
	 *
	 * @since    1.0.0
	 * @version  2.2.0
	 */
	public static function render() {

		// Variables

			$sections = (array) apply_filters( 'wmhook_reykjavik_welcome_render_sections', array(
				0   => 'header',
				10  => 'a11y',
				20  => 'guide',
				30  => 'demo',
				40  => 'promo',
				100 => 'footer',
			) );

			ksort( $sections );


		// Output

			?>

			<div class="wrap welcome__container">

				<?php

				do_action( 'wmhook_reykjavik_welcome_render_top' );

				foreach ( $sections as $section ) {
					get_template_part( 'templates/parts/admin/welcome', $section );
				}

				do_action( 'wmhook_reykjavik_welcome_render_bottom' );

				?>

			</div>

			<?php

	} // /render

	/**
	 * Welcome screen CSS styles.
	 *
	 * @since    1.0.0
	 * @version  2.2.0
	 *
	 * @param  string $hook
	 *
	 * @return  void
	 */
	public static function styles( $hook = '' ) {

		// Requirements check

			if ( 'appearance_page_reykjavik-welcome' !== $hook ) {
				return;
			}


		// Processing

			// Styles

				wp_enqueue_style(
					'reykjavik-welcome',
					get_theme_file_uri( 'assets/css/welcome.css' ),
					array( 'about' ),
					'v' . REYKJAVIK_THEME_VERSION
				);

	} // /styles

	/**
	 * Add screen to WordPress admin menu
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public static function admin_menu() {

		// Processing

			add_theme_page(
				// $page_title
				esc_html__( 'Welcome', 'reykjavik' ),
				// $menu_title
				esc_html__( 'Welcome', 'reykjavik' ),
				// $capability
				'edit_theme_options',
				// $menu_slug
				'reykjavik-welcome',
				// $function
				__CLASS__ . '::render'
			);

	} // /admin_menu

	/**
	 * Info text: Rate the theme.
	 *
	 * @since    1.5.2
	 * @version  2.2.0
	 */
	public static function get_info_like() {

		// Output

			return
				sprintf(
					/* translators: %1$s: heart icon, %2$s: star icons. */
					esc_html__( 'If you %1$s love this theme don\'t forget to rate it %2$s.', 'reykjavik' ),
					'<span class="dashicons dashicons-heart" style="color: red; vertical-align: -.181em;"></span>',
					'<a href="https://wordpress.org/support/theme/reykjavik/reviews/#new-post" style="display: inline-block; color: goldenrod; vertical-align: middle;"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></span></a>'
				)
				. ' '
				. '<br>'
				. '<a href="https://www.webmandesign.eu/contact/#donation">'
				. esc_html__( 'And/or please consider a donation.', 'reykjavik' )
				. '</a>'
				. ' '
				. esc_html__( 'Thank you!', 'reykjavik' );

	} // /get_info_like

	/**
	 * Info text: Contact support.
	 *
	 * @since    1.5.2
	 * @version  2.2.0
	 */
	public static function get_info_support() {

		// Output

			return
				esc_html__( 'Have a suggestion for improvement or something is not working as it should?', 'reykjavik' )
				. ' <a href="https://support.webmandesign.eu/forums/forum/reykjavik/">'
				. esc_html__( '&rarr; Contact support', 'reykjavik' )
				. '</a>';

	} // /get_info_support

} // /Reykjavik_Welcome

add_action( 'after_setup_theme', 'Reykjavik_Welcome::init' );
