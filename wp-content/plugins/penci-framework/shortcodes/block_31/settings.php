<?php
$shotcode_id = 'block_31';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Block 31', 'penci-framework' ),
	'weight' => 862,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(3),
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_image_type(),
		Penci_Framework_Shortcode_Params::block_option_loop( 3, '3,6,9' ),
		Penci_Framework_Shortcode_Params::block_option_image_size( array(
			'thumbnail_size_key'    => 'big_image_size',
			'thumbnail_size_label'  => __( 'Image size for the Big Post', 'penci-framework' ),
			'thumbnail_size_df'     => 'penci-thumb-760-570',
			'thumbnail_ratio_key'   => 'big_image_ratio',
			'thumbnail_ratio_label' => __( 'Image ratio for the Big Post', 'penci-framework' ),
			'thumbnail_ratio_df'    => 0.67,
		) ),
		Penci_Framework_Shortcode_Params::block_option_image_size( array(
			'thumbnail_size_key'    => 'image_size',
			'thumbnail_size_label'  => __( 'Image size for the Small Post', 'penci-framework' ),
			'thumbnail_size_df'     => 'penci-thumb-280-186',
			'thumbnail_ratio_key'   => 'image_ratio',
			'thumbnail_ratio_label' => __( 'Image ratio for the Small Post', 'penci-framework' ),
			'thumbnail_ratio_df'    => 0.67,
		) ),
		Penci_Framework_Shortcode_Params::block_pos_thumbnail(),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'big' => 20, 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'cat', 'comment', 'date','icon_post_format','review','view','read_more' ), array( 'author' ) ),
		Penci_Framework_Shortcode_Params::block_post_excrept( 20 ),
		array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Custom Excerpt Length for Big Posts:', 'penci-framework' ),
				'param_name' => 'post_big_excrept_length',
				'std'        => 50,
				'dependency' => array( 'element' => 'hide_excrept', 'is_empty' => true ),
			)
		),
		Penci_Framework_Shortcode_Params::block_option_pag( array(  'limit_loadmore' => 3 ) ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_color_meta(),
		array(
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Post excrept color', 'penci-framework' ),
				'param_name' => 'excrept_color',
				'group'      => 'Color',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_color_readmore(),
		Penci_Framework_Shortcode_Params::block_option_color_cat(),
		Penci_Framework_Shortcode_Params::block_option_color_ajax_loading(),
		Penci_Framework_Shortcode_Params::block_option_color_filter_text(),
		Penci_Framework_Shortcode_Params::block_option_color_pagination(),
		Penci_Framework_Shortcode_Params::block_option_typo_heading(),
		Penci_Framework_Shortcode_Params::block_option_typo_cat(),
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
				'param_name'       => 'post_title_font_size_first_item',
				'heading'          => esc_html__( 'Font size first item', 'penci-framework' ),
				'value'            => '',
				'std'              => '24px',
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
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_excrept',
				'title'        => esc_html__( 'Post excrept settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo_readmore(),
		Penci_Framework_Shortcode_Params::block_option_typo_pagination(),
		Penci_Framework_Shortcode_Params::ajax_filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_infeed_ad()
	),
	'js_view' => 'VcPenciShortcodeView',
);