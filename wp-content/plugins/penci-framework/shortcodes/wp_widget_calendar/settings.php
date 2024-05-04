<?php

$group_filter = 'Filter';
$group_color  = 'Color';
$shotcode_id = '';

// Shortcode settings
return array(
	'category' => esc_html__( 'PenNews WP Widget', 'penci-framework' ),
	'name'     => 'WP ' . __( 'Calendar' ),
	'params'   => array_merge(
		Penci_Framework_Shortcode_Params::block_title( array( 'block_title_default' => __( 'Calendar' ) ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings', 'hide_enable_stiky' ) ),
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