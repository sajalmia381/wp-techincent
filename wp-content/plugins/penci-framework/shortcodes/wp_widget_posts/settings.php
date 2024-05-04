<?php

$group_filter = 'Filter';
$group_color  = 'Color';

// Shortcode settings
return array(
	'category'      => esc_html__( 'PenNews WP Widget', 'penci-framework' ),
	'name'   => 'WP ' . __( 'Recent Posts' ),
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title( array( 'block_title_default' => __( 'Recent Posts' ) ) ),
		array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Number of posts', 'penci-framework' ),
				'description' => esc_html__( 'Enter number of posts to display.', 'penci-framework' ),
				'param_name' => 'number',
				'value' => 5,
				'admin_label' => true,
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Display post date?', 'penci-framework' ),
				'param_name' => 'show_date',
				'value' => array( esc_html__( 'Yes', 'penci-framework' ) => true ),
				'description' => esc_html__( 'If checked, date will be displayed.', 'penci-framework' ),
			),
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings', 'hide_enable_stiky' ) ),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),

		array(
			array(
				'type'             => 'colorpicker',
				'param_name'       => 'border_bottom_post_color',
				'heading'          => esc_html__( 'Post title border bottom color', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post date color', 'penci-framework' ),
				'param_name'       => 'post_date_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Post title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_date',
				'title'        => esc_html__( 'Post date settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '12px',
			)
		)
	)
);