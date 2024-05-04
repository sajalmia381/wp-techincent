<?php

$shotcode_id = 'block_18';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Block 18', 'penci-framework' ),
	'weight' => 872,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(6),
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_image_type(),
		Penci_Framework_Shortcode_Params::block_option_image_size(),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'cat','comment','date','icon_post_format','view','read_more' ), array( 'author' ) ),
		Penci_Framework_Shortcode_Params::block_option_pag( array( 'limit_loadmore' => 3  ) ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_color_meta(),
		Penci_Framework_Shortcode_Params::block_option_color_readmore(),
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

			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_meta',
				'title'        => esc_html__( 'Post meta settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '12px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo_readmore(),
		Penci_Framework_Shortcode_Params::block_option_typo_pagination(),
		Penci_Framework_Shortcode_Params::ajax_filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_infeed_ad()
	),
	'js_view' => 'VcPenciShortcodeView',
);
