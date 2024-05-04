<?php

$shotcode_id = 'register_form';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Register Form', 'penci-framework' ),
	'weight' => 836,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id, false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_genral_css',
				'heading'          => esc_html__( 'Form colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'attach_image',
				'heading'    => __( ' Background image when users logged in', 'penci-framework' ),
				'param_name' => 'bg_logged',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Text color', 'penci-framework' ),
				'param_name'       => 'form_text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Input Text Color', 'penci-framework' ),
				'param_name'       => 'form_input_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Input Placeholder Color', 'penci-framework' ),
				'param_name'       => 'form_place_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Input Border Color', 'penci-framework' ),
				'param_name'       => 'form_inputborder_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Link Color', 'penci-framework' ),
				'param_name'       => 'form_link_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Link Hover Color', 'penci-framework' ),
				'param_name'       => 'form_link_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button Text Color', 'penci-framework' ),
				'param_name'       => 'form_button_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button Background Color', 'penci-framework' ),
				'param_name'       => 'form_button_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button Text Hover Color', 'penci-framework' ),
				'param_name'       => 'form_button_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button Hover Background Color', 'penci-framework' ),
				'param_name'       => 'form_button_hbgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);