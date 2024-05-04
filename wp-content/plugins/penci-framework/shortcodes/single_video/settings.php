<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Shortcode settings
return array(
	'name'        => esc_html__( 'Single Video', 'penci-framework' ),
	'params'      => array_merge(
		array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Video Link', 'penci-framework' ),
				'param_name' => 'link',
			),

			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Cover Image', 'penci-framework' ),
				'param_name' => 'cover',
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Description', 'penci-framework' ),
				'param_name' => 'content'
			),
			array(
				'type'       => 'penci_number',
				'heading'    => esc_html__( 'Size icon play', 'penci-framework' ),
				'param_name' => 'font_size_play',
			),
			array(
				'type'       => 'penci_number',
				'heading'    => esc_html__( 'Custom width/height for icon play', 'penci-framework' ),
				'param_name' => 'wh_iconplay',
			),
			array(
				'type'       => 'penci_number',
				'heading'    => esc_html__( 'Custom width for description', 'penci-framework' ),
				'param_name' => 'width_desc',
			),array(
				'type'       => 'penci_number',
				'heading'    => esc_html__( 'Custom margin bottom for description', 'penci-framework' ),
				'param_name' => 'mar_bottom',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Description color', 'penci-framework' ),
				'param_name' => 'desc_color',
				'group'      => 'Color',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Icon play hover', 'penci-framework' ),
				'param_name' => 'color_play_color',
				'group'      => 'Color',
			),

			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Icon play hover color', 'penci-framework' ),
				'param_name' => 'hover_color_play_color',
				'group'      => 'Color',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Icon play background color', 'penci-framework' ),
				'param_name' => 'color_play_bgcolor',
				'group'      => 'Color',
			),

			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'icon play hover background color', 'penci-framework' ),
				'param_name' => 'hover_color_play_hbgcolor',
				'group'      => 'Color',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'desc',
				'title'        => esc_html__( 'Description settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		)
	)
);