<?php

$group_filter = 'Filter';
$group_color  = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Facebook Page Box', 'penci-framework' ),
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title( ),
		array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Facebook Page Title:', 'penci-framework' ),
				'param_name'  => 'title_page',
				'std' => esc_html__( 'Facebook', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Facebook Page URL:', 'penci-framework' ),
				'param_name'  => 'page_url',
				'admin_label' => true,
				'description' => esc_html__( 'EG. http://www.facebook.com/demo', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Facebook Page Height::', 'penci-framework' ),
				'param_name'  => 'height',
				'std' => 290,
				'description' => esc_html__( 'This option is only applied when "Show Stream" option is checked', 'penci-framework' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Hide Faces', 'penci-framework' ),
				'param_name' => 'faces',
			),array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Hide Stream', 'penci-framework' ),
				'param_name' => 'stream',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
		Penci_Framework_Shortcode_Params::block_option_block_title(  ),
		Penci_Framework_Shortcode_Params::color_params( 'penci_widget_archive', false ),
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		)
	)
);