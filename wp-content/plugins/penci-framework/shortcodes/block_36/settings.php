<?php
$shotcode_id = 'block_36';
$group_color = 'Color';
// Shortcode settings
return array(
	'name'   => esc_html__( 'Block 36', 'penci-framework' ),
	'weight' => 855,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(),
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide posts review', 'penci-framework' ),
				'param_name'       => 'hide_post_review',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Select position of posts review', 'penci-framework' ),
				'param_name' => 'thumb_pos',
				'std'        => 'left',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )  => 'left',
					esc_html__( 'Right', 'penci-framework' ) => 'right',
				),
			),
		),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'date','view', 'comment' ) , array( 'author' ) ),
		array(
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Only show posts with review', 'penci-framework' ),
				'param_name'       => 'only_post_review',
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_pag( array(  'limit_loadmore' => 3, 'pagination'     => 0 ) ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		array(
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border post title color', 'penci-framework' ),
				'param_name'       => 'border_post_title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_post_order_color_settings',
				'heading'          => esc_html__( 'Post Review Colors', 'penci-framework' ),
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => $group_color,
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Review Point Color', 'penci-framework' ),
				'param_name'       => 'review_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Review Process Main Background Color', 'penci-framework' ),
				'param_name'       => 'review_pro_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Review Process Running Background Color', 'penci-framework' ),
				'param_name'       => 'review_pro_runcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_color_meta(),
		Penci_Framework_Shortcode_Params::block_option_color_ajax_loading(),
		Penci_Framework_Shortcode_Params::block_option_color_filter_text(),
		Penci_Framework_Shortcode_Params::block_option_color_pagination(),
		Penci_Framework_Shortcode_Params::block_option_typo_heading(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Post title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '14px',
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
		Penci_Framework_Shortcode_Params::block_option_typo_pagination(),
		Penci_Framework_Shortcode_Params::ajax_filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_infeed_ad()

	),
	'js_view' => 'VcPenciShortcodeView',
);