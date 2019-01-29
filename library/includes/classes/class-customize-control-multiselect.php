<?php
/**
 * Customizer custom controls
 *
 * Customizer multi select field.
 *
 * @subpackage  Customize
 *
 * @package    WebMan WordPress Theme Framework
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.7.0
 * @version  1.4.0
 */
class Reykjavik_Customize_Control_Multiselect extends WP_Customize_Control {

	public function enqueue() {

		// Processing

			// Scripts

				if ( 'multicheckbox' === $this->type ) {

					wp_enqueue_script(
						'reykjavik-customize-control-multicheckbox',
						get_theme_file_uri( REYKJAVIK_LIBRARY_DIR . 'js/customize-control-multicheckbox.js' ),
						array( 'customize-controls' ),
						REYKJAVIK_THEME_VERSION,
						true
					);

				}

	} // /enqueue



	public function render_content() {

		// Requirements check

			if (
				empty( $this->choices )
				|| ! is_array( $this->choices )
			) {
				return;
			}


		// Output

			if ( 'multicheckbox' === $this->type ) {
				$this->render_content_checkbox();
			} else {
				$this->render_content_select();
			}

	} // /render_content



	public function render_content_checkbox() {

		// Helper variables

			$value_array = ( ! is_array( $this->value() ) ) ? ( explode( ',', $this->value() ) ) : ( $this->value() );


		// Output

			?>

			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( $this->description ) : ?><span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span><?php endif; ?>

			<ul>
			<?php foreach ( $this->choices as $value => $label ) : ?>
				<li>
					<label>
						<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $this->id ); ?>[]" <?php checked( in_array( $value, $value_array ) ); ?> />
						<?php echo esc_html( $label ); ?>
					</label>
				</li>
			<?php endforeach; ?>
			</ul>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $value_array ) ); ?>" />

			<?php

	} // /render_content_checkbox



	public function render_content_select() {

		// Helper variables

			$value_array = ( ! is_array( $this->value() ) ) ? ( explode( ',', $this->value() ) ) : ( $this->value() );


		// Output

			?>

			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( $this->description ) : ?><span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span><?php endif; ?>

				<select name="<?php echo esc_attr( $this->id ); ?>" multiple="multiple" <?php $this->link(); ?>>
					<?php foreach ( $this->choices as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>"<?php selected( in_array( $value, $value_array ) ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>

				<em><?php esc_html_e( 'Press CTRL key for multiple selection.', 'reykjavik' ); ?></em>
			</label>

			<?php

	} // /render_content_select

} // /Reykjavik_Customize_Control_Multiselect
