<?php
$shotcode_id = 'block_6';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Block 6', 'penci-framework' ),
	'weight' => 883,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(),
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_pos_thumbnail(),
		array(
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Replace featured image to author avatar', 'penci-framework' ),
				'param_name'       => 'replace_feat_author',
				'value'            => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_image_type(),
		Penci_Framework_Shortcode_Params::block_option_image_size( array(
			'thumbnail_size_key'    => 'image_size',
			'thumbnail_size_label'  => __( 'Image size', 'penci-framework' ),
			'thumbnail_size_df'     => 'penci-thumb-280-186',
			'thumbnail_ratio_key'   => 'image_ratio',
			'thumbnail_ratio_label' => __( 'Image ratio', 'penci-framework' ),
			'thumbnail_ratio_df'    => 0.67,
		) ),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'date','icon_post_format','comment' ),array( 'author','view' ) ),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 20 ) ),
		Penci_Framework_Shortcode_Params::block_option_pag( array( 'limit_loadmore' => 3, 'pagination' => 0,'hide_pag_position' => 1 ) ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id ),
		array(
			array(
				'type'             => 'colorpicker',
				'param_name'       => 'border_bottom_post_color',
				'heading'          => esc_html__( 'Custom border bottom color of Post', 'penci-framework' ),
				'value'            => '',
				'group'            => 'Color',
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