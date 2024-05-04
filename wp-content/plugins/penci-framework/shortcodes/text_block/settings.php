<?php

$group_filter = 'Filter';
$group_color  = 'Color';
$shotcode_id = '';

// Shortcode settings
return array(
	'name'     => esc_html__( 'Text Block', 'penci-framework' ),
	'params'   => array_merge(
		Penci_Framework_Shortcode_Params::block_title( ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
		array(
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Text', 'penci-framework' ),
				'param_name' => 'content',
				'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'penci-framework' ),
			),
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id, false ),
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