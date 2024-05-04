<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Penci_Vc_Google_Fonts {
	public function __construct() {
		add_filter( 'vc_google_fonts_render_filter', array( $this, 'google_fonts_render' ), 10, 2 );
	}

	public function google_fonts_render( $settings, $value ) {
		$fields = array();
		$values = array();
		$set    = isset( $settings['settings'], $settings['settings']['fields'] ) ? $settings['settings']['fields'] : array();
		extract( $this->_vc_google_fonts_parse_attributes( $set, $value ) );
		ob_start();
		?>
		<div class="vc_row-fluid vc_column">
			<div class="wpb_element_label"><?php _e( 'Font Family', 'penci-framework' ); ?></div>
			<div class="vc_google_fonts_form_field-font_family-container">
				<select class="vc_google_fonts_form_field-font_family-select"
				        default[font_style]="<?php echo $values['font_style']; ?>">
					<?php
					/** @var $this Vc_Google_Fonts */
					$fonts = $this->_vc_google_fonts_get_fonts();
					foreach ( $fonts as $font_data ) : ?>
						<option value="<?php echo $font_data->font_family . ':' . $font_data->font_styles; ?>"
						        data[font_types]="<?php echo $font_data->font_types; ?>"
						        data[font_family]="<?php echo $font_data->font_family; ?>"
						        data[font_styles]="<?php echo $font_data->font_styles; ?>"
						        class="<?php echo vc_build_safe_css_class( $font_data->font_family ); ?>" <?php echo( strtolower( $values['font_family'] ) == strtolower( $font_data->font_family ) || strtolower( $values['font_family'] ) == strtolower( $font_data->font_family ) . ':' . $font_data->font_styles ? 'selected' : '' ); ?> ><?php echo $font_data->font_family ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<?php if ( isset( $fields['font_family_description'] ) && strlen( $fields['font_family_description'] ) > 0 ) : ?>
				<span class="vc_description clear"><?php echo $fields['font_family_description']; ?></span>
			<?php endif ?>
		</div>

		<?php if ( isset( $fields['no_font_style'] ) && false === $fields['no_font_style'] || ! isset( $fields['no_font_style'] ) ) : ?>
			<div class="vc_row-fluid vc_column">
				<div class="wpb_element_label"><?php _e( 'Font style', 'penci-framework' ); ?></div>
				<div class="vc_google_fonts_form_field-font_style-container">
					<select class="vc_google_fonts_form_field-font_style-select"></select>
				</div>
			</div>
			<?php if ( isset( $fields['font_style_description'] ) && strlen( $fields['font_style_description'] ) > 0 ) : ?>
				<span class="vc_description clear"><?php echo $fields['font_style_description']; ?></span>
			<?php endif ?>
		<?php endif ?>
		<input name="<?php echo $settings['param_name']; ?>"
		       class="wpb_vc_param_value  <?php echo $settings['param_name'] . ' ' . $settings['type']; ?>_field" type="hidden"
		       value="<?php echo $value; ?>"/>

		<?php

		return ob_get_clean();
	}

	/**
	 * @param $attr
	 * @param $value
	 *
	 * @since 4.3
	 * @return array
	 */
	public function _vc_google_fonts_parse_attributes( $attr, $value ) {
		$fields = array();
		if ( is_array( $attr ) && ! empty( $attr ) ) {
			foreach ( $attr as $key => $val ) {
				if ( is_numeric( $key ) ) {
					$fields[ $val ] = '';
				} else {
					$fields[ $key ] = $val;
				}
			}
		}

		$values = vc_parse_multi_attribute( $value, array(
			'font_family'             => isset( $fields['font_family'] ) ? $fields['font_family'] : '',
			'font_style'              => isset( $fields['font_style'] ) ? $fields['font_style'] : '',
			'font_family_description' => isset( $fields['font_family_description'] ) ? $fields['font_family_description'] : '',
			'font_style_description'  => isset( $fields['font_style_description'] ) ? $fields['font_style_description'] : '',
		) );

		return array( 'fields' => $fields, 'values' => $values );
	}
}