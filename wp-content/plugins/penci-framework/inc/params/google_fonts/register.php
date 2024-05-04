<?php
/**
 * Callback for new param 'penci_google_fonts'.
 *
 * @param array $settings
 * @param string $value
 *
 * @return string
 */
function penci_vc_param_google_fonts( $settings, $value ) {
	$fields = array();
	$values = array();
	$set = isset( $settings['settings'], $settings['settings']['fields'] ) ? $settings['settings']['fields'] : array();
	$google_fonts = new Vc_Google_Fonts();
	extract( $google_fonts->_vc_google_fonts_parse_attributes( $set, $value ) );
	ob_start();

	$output = '<div class="vc_row-fluid vc_column">';
	$output .= '<div class="wpb_element_label">' . esc_html__( 'Font Family', 'penci-framework' ) . '</div>';
	$output .= '<div class="vc_google_fonts_form_field-font_family-container">';

	$fonts = $google_fonts->_vc_google_fonts_get_fonts();

	$output .= '<select class="vc_google_fonts_form_field-font_family-select" default[font_style]="' . $values['font_style'] . '">';
	foreach ( $fonts as $font_data ) {

		$font_family = $font_data->font_family;

		$font_browser = array(
			'Arial'               => 'Arial, Helvetica, sans-serif',
			'Arial Black'         => 'Arial Black, Gadget, sans-serif',
			'Comic Sans MS'       => 'Comic Sans MS, cursive, sans-serif',
			'Impact'              => 'Impact, Charcoal, sans-serif',
			'Lucida Sans Unicode' => 'Lucida Sans Unicode, Lucida Grande, sans-serif',
			'Tahoma'              => 'Tahoma, Geneva, sans-serif',
			'Trebuchet MS'        => 'Trebuchet MS, Helvetica, sans-serif',
			'Verdana'             => 'Verdana, Geneva, sans-serif',
			'Georgia'             => 'Georgia, serif',
			'Palatino Linotype'   => 'Palatino Linotype, Book Antiqua, Palatino, serif',
			'Times New Roman'     => 'Times New Roman, Times, serif',
			'Courier New'         => 'Courier New, Courier, monospace',
			'Lucida Console'      => 'Lucida Console, Monaco, monospace',
		);

		if( isset( $font_browser[$font_family] ) && $font_browser[$font_family] ){
			$font_family = $font_browser[$font_family];
		}

		$output .= '<option value="' .  $font_family . ':' . $font_data->font_styles  . '"';
		$output .= 'data[font_types]="' . $font_data->font_types . '"';
		$output .= ' data[font_family]="' . $font_family . '"';
		$output .= 'data[font_styles]="' .  $font_data->font_styles . '"';
		$output .= 'class="' . vc_build_safe_css_class( $font_data->font_family ) . '"';
		$output .= ( strtolower( $values['font_family'] ) == strtolower( $font_family ) || strtolower( $values['font_family'] ) == strtolower( $font_family ) . ':' . strtolower( $font_data->font_styles ) ? 'selected' : '' );
		$output .= '>' . $font_family . '</option>';
	}
	$output .= '</select>';
	$output .= '</div>';
	$output .= '</div>';

	$output .= '<div class="vc_row-fluid vc_column">';
	$output .= '<div class="wpb_element_label">' . esc_html__( 'Font Weight', 'penci-framework' ) . '</div>';
	$output .= '<div class="vc_google_fonts_form_field-font_style-container">';
	$output .= '<select class="vc_google_fonts_form_field-font_style-select">';
	$output .= '<option value="100 regular:100:normal" data[font_weight]="100" data[font_style]="normal" class="normal_100"      ' . selected( $values['font_style'], '100 regular:100:normal', false ) . '>100</option>';
	$output .= '<option value="200 regular:100:normal" data[font_weight]="100" data[font_style]="normal" class="italic_200"      ' . selected( $values['font_style'], '200 regular:100:normal', false ) . '>200</option>';
	$output .= '<option value="300 regular:300:normal" data[font_weight]="300" data[font_style]="normal" class="normal_300"      ' . selected( $values['font_style'], '300 regular:300:normal', false ) . '>300</option>';
	$output .= '<option value="400 regular:400:normal" data[font_weight]="400" data[font_style]="normal" class="normal_400"      ' . selected( $values['font_style'], '400 regular:400:normal', false ) . '>400</option>';
	$output .= '<option value="500 medium:500:normal" data[font_weight]="500" data[font_style]="normal" class="normal_500"       ' . selected( $values['font_style'], '500 medium:500:normal', false ) . '>500</option>';
	$output .= '<option value="600 medium:600:normal" data[font_weight]="600" data[font_style]="normal" class="normal_600"       ' . selected( $values['font_style'], '600 medium:600:normal', false ) . '>600</option>';
	$output .= '<option value="700 bold regular:700:normal" data[font_weight]="700" data[font_style]="normal" class="normal_700" ' . selected( $values['font_style'], '700 bold regular:700:normal', false ) . '>700</option>';
	$output .= '<option value="800 bold regular:800:normal" data[font_weight]="900" data[font_style]="normal" class="italic_800" ' . selected( $values['font_style'], '800 bold regular:800:normal', false ) . '>800</option>';
	$output .= '<option value="900 bold regular:900:normal" data[font_weight]="900" data[font_style]="normal" class="normal_900" ' . selected( $values['font_style'], '900 bold regular:900:normal', false ) . '>900</option>';
	$output .= '</select>';
	$output .= '</div>';
	$output .= '</div>';

	$output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . ( $settings['param_name'] . ' ' . $settings['type'] ) . '" type="hidden" value="' . $value . '"/>';
	return $output;
}