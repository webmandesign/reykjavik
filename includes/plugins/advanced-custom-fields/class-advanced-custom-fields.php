<?php
/**
 * Advanced Custom Fields Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.1
 *
 * Contents:
 *
 *  0) Init
 * 10) Intro section
 * 20) Child pages list section
 * 30) Any page builder setup
 */
class Reykjavik_Advanced_Custom_Fields {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.3.1
		 */
		private function __construct() {

			// Requirements check

				if ( (bool) apply_filters( 'wmhook_reykjavik_acf_disable', ! is_admin() ) ) {
					return;
				}


			// Processing

				// Hooks

					// Actions

						$priority = 100; // Late enough for all post types to be registered.

						add_action( 'init', __CLASS__ . '::intro', $priority );
						add_action( 'init', __CLASS__ . '::child_pages', $priority );
						add_action( 'init', __CLASS__ . '::any_page_builder', $priority );

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
	 * 10) Intro section
	 */

		/**
		 * Intro metaboxes
		 *
		 * @since    1.0.0
		 * @version  1.3.1
		 */
		public static function intro() {

			// Helper variables

				$group_no = 0;


			// Processing

				acf_add_local_field_group( (array) apply_filters( 'wmhook_reykjavik_acf_field_group', array(
					'id'     => 'reykjavik_intro_options',
					'title'  => esc_html__( 'Intro options', 'reykjavik' ),
					'fields' => array(

						// Disable intro

							100 => array(
								'key'           => 'reykjavik_no_intro',
								'label'         => esc_html__( 'Intro section', 'reykjavik' ),
								'name'          => 'no_intro',
								'type'          => 'true_false',
								'message'       => esc_html__( 'Disable intro section for this page', 'reykjavik' ),
								'default_value' => 0,
							),

						// Disable intro media

							200 => array(
								'key'               => 'reykjavik_no_intro_media',
								'label'             => esc_html__( 'Disable intro media', 'reykjavik' ),
								'name'              => 'no_intro_media',
								'type'              => 'true_false',
								'message'           => esc_html__( 'Do not show intro media (such as image) if it is displayed on this page', 'reykjavik' ),
								'default_value'     => 0,
								'conditional_logic' => array(
									'status'   => 1,
									'allorany' => 'all',
									'rules'    => array(
										array(
											'field'    => 'reykjavik_no_intro',
											'operator' => '!=',
											'value'    => 1,
										),
									),
								),
							),

						// Custom intro image

							300 => array(
								'key'               => 'reykjavik_intro_image',
								'label'             => esc_html__( 'Custom intro image', 'reykjavik' ),
								'instructions'      => esc_html__( 'Here you can override the default Intro section image with a custom one.', 'reykjavik' ),
								'name'              => 'intro_image',
								'type'              => 'image',
								'save_format'       => 'id',
								'preview_size'      => 'thumbnail',
								'library'           => 'all',
								'conditional_logic' => array(
									'status'   => 1,
									'allorany' => 'all',
									'rules'    => array(
										array(
											'field'    => 'reykjavik_no_intro',
											'operator' => '!=',
											'value'    => 1,
										),
									),
								),
							),

						// Display intro widgets

							400 => array(
								'key'               => 'reykjavik_show_intro_widgets',
								'label'             => esc_html__( 'Intro widgets', 'reykjavik' ),
								'name'              => 'show_intro_widgets',
								'type'              => 'true_false',
								'message'           => esc_html__( 'Show widgets in intro section of this page', 'reykjavik' ),
								'default_value'     => 0,
								'conditional_logic' => array(
									'status'   => 1,
									'allorany' => 'all',
									'rules'    => array(
										array(
											'field'    => 'reykjavik_no_intro',
											'operator' => '!=',
											'value'    => 1,
										),
									),
								),
							),

					),
					'location' => array(

						// Display everywhere except:
						// - blog page,
						// - "No intro" page template,
						// - "Blank" page template,
						// - Beaver Builder/Themer CPTs,
						// - WooCommerce orders,
						// - WooSidebars related CPTs,

							100 => array(

								100 => array(
									'param'    => 'page_type',
									'operator' => '!=',
									'value'    => 'posts_page',
									'order_no' => 0,
									'group_no' => $group_no++,
								),

								200 => array(
									'param'    => 'page_template',
									'operator' => '!=',
									'value'    => 'templates/no-intro.php',
									'order_no' => 0,
									'group_no' => $group_no++,
								),

									210 => array(
										'param'    => 'page_template',
										'operator' => '!=',
										'value'    => 'templates/blank.php',
										'order_no' => 0,
										'group_no' => $group_no++,
									),

								// CPTs

									300 => array(
										'param'    => 'post_type',
										'operator' => '!=',
										'value'    => 'fl-builder-template',
										'order_no' => 0,
										'group_no' => $group_no++,
									),

										310 => array(
											'param'    => 'post_type',
											'operator' => '!=',
											'value'    => 'fl-theme-layout',
											'order_no' => 0,
											'group_no' => $group_no++,
										),

									400 => array(
										'param'    => 'post_type',
										'operator' => '!=',
										'value'    => 'shop_order',
										'order_no' => 0,
										'group_no' => $group_no++,
									),

									500 => array(
										'param'    => 'post_type',
										'operator' => '!=',
										'value'    => 'sidebar',
										'order_no' => 0,
										'group_no' => $group_no++,
									),

							),

					),
					'menu_order' => 20,
					'position'   => ( function_exists( 'has_blocks' ) ) ? ( 'side' ) : ( 'normal' ),
					'style'      => 'default',
				), 'intro', $group_no ) );

		} // /intro





	/**
	 * 20) Child pages list section
	 */

		/**
		 * Child pages list metaboxes
		 *
		 * @since    1.0.0
		 * @version  1.3.1
		 */
		public static function child_pages() {

			// Helper variables

				$group_no = 0;


			// Processing

				acf_add_local_field_group( (array) apply_filters( 'wmhook_reykjavik_acf_field_group', array(
					'id'     => 'reykjavik_child_pages_options',
					'title'  => esc_html__( 'Child pages list options', 'reykjavik' ),
					'fields' => array(

						// Instructions message

							100 => array(
								'key'     => 'reykjavik_child_pages_options_instructions',
								'label'   => esc_html__( 'Instructions', 'reykjavik' ),
								'name'    => '',
								'type'    => 'message',
								'message' => esc_html__( 'These settings will modify the page display in the list of child pages. The page needs to be nested under a parent page that is set up as a "List child pages" page template.', 'reykjavik' ),
							),

						// Disable child page image

							200 => array(
								'key'           => 'reykjavik_no_thumbnail',
								'label'         => esc_html__( 'Disable image', 'reykjavik' ),
								'name'          => 'no_thumbnail',
								'type'          => 'true_false',
								'message'       => esc_html__( 'Do not display page image in list of child pages', 'reykjavik' ),
								'default_value' => 0,
							),

					),
					'location' => array(

						// Display on Pages

							100 => array(

								100 => array(
									'param'    => 'post_type',
									'operator' => '==',
									'value'    => 'page',
									'order_no' => 0,
									'group_no' => $group_no++,
								),

								200 => array(
									'param'    => 'page_type',
									'operator' => '!=',
									'value'    => 'posts_page',
									'order_no' => 0,
									'group_no' => $group_no++,
								),

								300 => array(
									'param'    => 'page_parent',
									'operator' => '!=',
									'value'    => '',
									'order_no' => 0,
									'group_no' => $group_no++,
								),

							),

					),
					'menu_order' => 20,
					'position'   => ( function_exists( 'has_blocks' ) ) ? ( 'side' ) : ( 'normal' ),
					'style'      => 'default',
				), 'child_pages', $group_no ) );

		} // /child_pages





	/**
	 * 30) Any page builder setup
	 */

		/**
		 * Post modifiers to support any page builder
		 *
		 * @since    1.0.0
		 * @version  1.3.1
		 */
		public static function any_page_builder() {

			// Requirements check

				if ( class_exists( 'FLBuilder' ) ) {
					return;
				}


			// Helper variables

				$group_no = 0;


			// Processing

				acf_add_local_field_group( (array) apply_filters( 'wmhook_reykjavik_acf_field_group', array(
					'id'     => 'reykjavik_any_page_builder',
					'title'  => esc_html__( 'Page builder layout', 'reykjavik' ),
					'fields' => array(

						100 => array(
							'key'           => 'reykjavik_content_layout',
							'label'         => esc_html__( 'Content area layout', 'reykjavik' ),
							'name'          => 'content_layout',
							'type'          => 'radio',
							'choices'       => array(
								''            => esc_html__( 'Leave as is', 'reykjavik' ),
								'no-paddings' => esc_html__( 'Remove content paddings only', 'reykjavik' ),
								'stretched'   => esc_html__( 'Fullwidth content with no paddings', 'reykjavik' ),
							),
							'instructions'  => esc_html__( 'As every page builder plugin works differently, set this according to your needs.', 'reykjavik' ),
							'default_value' => '',
						),

					),
					'location' => array(

						// Display everywhere except:
						// - blog page,
						// - WooCommerce orders,
						// - WooSidebars related CPTs,

							100 => array(

								100 => array(
									'param'    => 'page_type',
									'operator' => '!=',
									'value'    => 'posts_page',
									'order_no' => 0,
									'group_no' => $group_no++,
								),

								200 => array(
									'param'    => 'post_type',
									'operator' => '!=',
									'value'    => 'shop_order',
									'order_no' => 0,
									'group_no' => $group_no++,
								),

								300 => array(
									'param'    => 'post_type',
									'operator' => '!=',
									'value'    => 'sidebar',
									'order_no' => 0,
									'group_no' => $group_no++,
								),

							),

					),
					'menu_order' => 20,
					'position'   => 'side',
					'style'      => 'default',
				), 'any_page_builder', $group_no ) );

		} // /any_page_builder





} // /Reykjavik_Advanced_Custom_Fields

add_action( 'after_setup_theme', 'Reykjavik_Advanced_Custom_Fields::init' );
