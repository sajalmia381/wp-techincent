<?php
$shotcode_id = 'block_33';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Block 33', 'penci-framework' ),
	'weight' => 858,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(),
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Turn on loop items', 'penci-framework' ),
				'param_name'       => 'turn_on_loop_item',
				'description' => esc_html__( 'If checked, will be display 5 posts this one. Please enter the amount which can be devided by 5 such as 5, 10, 15, 20', 'penci-framework' ),

			)
		),
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
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'big' => 20, 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_post_excrept(),
		array(
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Hide Post Excrept For Big Post', 'penci-framework' ),
				'param_name' => 'hide_excrept_big_post',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Custom Excerpt Length For Big Post', 'penci-framework' ),
				'param_name' => 'big_post_excrept_length',
				'std'        => 10,
				'dependency' => array( 'element' => 'hide_excrept_big_post', 'is_empty' => true ),
			)
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'author', 'cat', 'comment', 'date','icon_post_format','view','read_more' ) ),
		Penci_Framework_Shortcode_Params::block_option_pag( array(  'limit_loadmore' => 2 ) ),
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
		Penci_Framework_Shortcode_Params::block_option_color_social_share(),
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
				'font-size'    => '20px',
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