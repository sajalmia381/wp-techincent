<?php

$shotcode_id = 'grid_6';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Big Grid 6', 'penci-framework' ),
	'weight' => 844,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(6),
		Penci_Framework_Shortcode_Params::block_title( array( 'shortcode_id' => $shotcode_id ) ),
		Penci_Framework_Shortcode_Params::block_option_limit( 6 ),
		Penci_Framework_Shortcode_Params::block_option_image_type(),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'big' => 20, 'standard' => 12,'small' => 10 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'date','icon_post_format','cat','review' ), array( 'author','view' ) ),
		array(
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Comment Count for First Post', 'penci-framework' ),
				'param_name'       => 'hide_comment_first',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Comment Count for Medium Posts ( 2nd & 3rd )', 'penci-framework' ),
				'param_name'       => 'hide_comment_medium',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Comment Count for Small Posts', 'penci-framework' ),
				'param_name'       => 'hide_comment_small',
				'edit_field_class' => 'vc_col-sm-6',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_pag( ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_color_meta(),
		Penci_Framework_Shortcode_Params::block_option_color_cat(),
		Penci_Framework_Shortcode_Params::block_option_color_ajax_loading(),
		Penci_Framework_Shortcode_Params::block_option_color_filter_text(),
		Penci_Framework_Shortcode_Params::block_option_color_pagination(),
		Penci_Framework_Shortcode_Params::block_option_typo_heading(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Post title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '18px',
			)
		),
		array(
			array(
				'type'             => 'penci_number',
				'param_name'       => 'post_title_font_size_big_item',
				'heading'          => esc_html__( 'Font size big item', 'penci-framework' ),
				'value'            => '',
				'std'              => '24px',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => 'Typo',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'post_title_font_size_small_item',
				'heading'          => esc_html__( 'Font size small item', 'penci-framework' ),
				'value'            => '',
				'std'              => '16px',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => 'Typo',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_meta',
				'title'        => esc_html__( 'Post meta settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '12px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo_pagination(),
		Penci_Framework_Shortcode_Params::ajax_filter_params( $shotcode_id )
	),
	'js_view' => 'VcPenciShortcodeView',
);