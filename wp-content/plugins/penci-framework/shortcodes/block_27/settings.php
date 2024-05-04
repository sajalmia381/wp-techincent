<?php
$shotcode_id = 'block_27';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Block 27', 'penci-framework' ),
	'weight' => 865,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(3),
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_image_type(),
		Penci_Framework_Shortcode_Params::block_option_image_size( array(
			'thumbnail_size_key'    => 'big_image_size',
			'thumbnail_size_label'  => __( 'Image size for the Big Post', 'penci-framework' ),
			'thumbnail_size_df'     => 'penci-thumb-480-320',
			'thumbnail_ratio_key'   => 'big_image_ratio',
			'thumbnail_ratio_label' => __( 'Image ratio for the Big Post', 'penci-framework' ),
			'thumbnail_ratio_df'    => 0.67,
		) ),
		Penci_Framework_Shortcode_Params::block_option_image_size( array(
			'thumbnail_size_key'    => 'image_size',
			'thumbnail_size_label'  => __( 'Image size for the Small Post', 'penci-framework' ),
			'thumbnail_size_df'     => 'penci-thumb-480-320',
			'thumbnail_ratio_key'   => 'image_ratio',
			'thumbnail_ratio_label' => __( 'Image ratio for the Small Post', 'penci-framework' ),
			'thumbnail_ratio_df'    => 0.67,
		) ),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'comment', 'date','icon_post_format','cat','view','review' ) , array( 'author' ) ),
		Penci_Framework_Shortcode_Params::block_post_excrept( 15 ),
		Penci_Framework_Shortcode_Params::block_option_pag(),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		array(
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Right post title color', 'penci-framework' ),
				'param_name'       => 'right_post_title_color',
				'group'            => 'Color',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Right post title hover color', 'penci-framework' ),
				'param_name'       => 'right_post_title_hover_color',
				'group'            => 'Color',
				'edit_field_class' => 'vc_col-sm-6',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_color_meta(),
		array(
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Right post meta color', 'penci-framework' ),
				'param_name'       => 'right_post_meta_color',
				'group'            => 'Color',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Right post meta hover color', 'penci-framework' ),
				'param_name'       => 'right_post_meta_hover_color',
				'group'            => 'Color',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Post excrept color', 'penci-framework' ),
				'param_name' => 'excrept_color',
				'group'      => 'Color',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Right post background color', 'penci-framework' ),
				'param_name' => 'right_post_bg_color',
				'group'      => 'Color',
			)
		),
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
		Penci_Framework_Shortcode_Params::block_option_typo_pagination(),
		Penci_Framework_Shortcode_Params::ajax_filter_params( $shotcode_id )
	),
	'js_view' => 'VcPenciShortcodeView',
);