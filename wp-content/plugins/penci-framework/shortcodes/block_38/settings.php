<?php
$shotcode_id = 'block_38';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Block 38', 'penci-framework' ),
	'weight' => 855,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(),
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Design style', 'penci-framework' ),
				'param_name' => '_design_style',
				'std'        => 'standard',
				'value'      => array(
					esc_html__( 'Standard', 'penci-framework' ) => 'standard',
					esc_html__( 'Classic', 'penci-framework' )  => 'classic',
					esc_html__( 'Overlay', 'penci-framework' )  => 'overlay'
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Text align', 'penci-framework' ),
				'param_name' => '_design_align',
				'std'        => '',
				'value'      => array(
					esc_html__( 'Default', 'penci-framework' ) => '',
					esc_html__( 'Left', 'penci-framework' ) => 'left',
					esc_html__( 'Center', 'penci-framework' )  => 'center',
					esc_html__( 'Right', 'penci-framework' )  => 'right'
				),
			),
		),
		Penci_Framework_Shortcode_Params::block_pos_thumbnail(),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Image Type', 'penci-framework' ),
				'param_name' => 'image_type',
				'value'      => array(
					__( 'Square', 'penci-framework' )    => 'square',
					__( 'Vertical', 'penci-framework' )  => 'vertical',
					__( 'Landscape', 'penci-framework' ) => 'landscape',
				)
			)
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 12 ) ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'cat', 'author', 'comment', 'date','icon_post_format','view','read_more' ) ),
		Penci_Framework_Shortcode_Params::block_post_excrept(),
		Penci_Framework_Shortcode_Params::block_option_pag(),
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
		Penci_Framework_Shortcode_Params::block_option_color_cat(),
		Penci_Framework_Shortcode_Params::block_option_color_readmore(),
		Penci_Framework_Shortcode_Params::block_option_color_ajax_loading(),
		Penci_Framework_Shortcode_Params::block_option_color_filter_text(),
		Penci_Framework_Shortcode_Params::block_option_color_pagination(),
		Penci_Framework_Shortcode_Params::block_option_typo_heading(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Post title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani600' ),
				'font-size'    => '20px',
			) ),
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