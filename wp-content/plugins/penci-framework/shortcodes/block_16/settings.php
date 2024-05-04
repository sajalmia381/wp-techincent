<?php

$shotcode_id = 'block_16';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Block 16', 'penci-framework' ),
	'weight' => 874,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(4),
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_image_type(),
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
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'big' => 20, 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'comment','date','icon_post_format','cat','view','review','read_more' ), array( 'author' ) ),
		array(
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Drop title to below image for big post', 'penci-framework' ),
				'param_name' => 'big_post_text_below',
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_pag( array( 'limit_loadmore' => 6 ) ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),

		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'first_post_title_css_heading',
				'heading'          => esc_html__( 'First Post Title Colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'First Post title color', 'penci-framework' ),
				'param_name'       => 'first_post_title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'First Post title hover color', 'penci-framework' ),
				'param_name'       => 'first_post_title_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_color_meta(),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'first_post_meta_css',
				'heading'          => esc_html__( 'First Post meta colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'First Post meta color', 'penci-framework' ),
				'param_name'       => 'first_meta_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'First Post meta hover color', 'penci-framework' ),
				'param_name'       => 'first_meta_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		),
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
			) ),
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
		Penci_Framework_Shortcode_Params::block_option_typo_readmore(),
		Penci_Framework_Shortcode_Params::block_option_typo_pagination(),
		Penci_Framework_Shortcode_Params::ajax_filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_infeed_ad()
	),
	'js_view' => 'VcPenciShortcodeView',
);
