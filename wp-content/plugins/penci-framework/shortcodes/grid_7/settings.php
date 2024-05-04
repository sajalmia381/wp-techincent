<?php
$shotcode_id = 'grid_7';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Big Grid 7', 'penci-framework' ),
	'weight' => 842,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(3),
		Penci_Framework_Shortcode_Params::block_title( array( 'shortcode_id' => $shotcode_id ) ),
		Penci_Framework_Shortcode_Params::block_option_image_type( 'vertical' ),
		Penci_Framework_Shortcode_Params::block_option_image_size(array(
			'thumbnail_size_df'     => 'penci-thumb-480-645',
			'thumbnail_ratio_df'    => 1.34,
		)),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'comment', 'date','icon_post_format', 'cat','review' ), array( 'author','view' ) ),
		Penci_Framework_Shortcode_Params::block_option_pag( ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_color_meta( ),
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
				'font-size'    => '16px',
			) ),
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