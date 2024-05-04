<?php

$group_filter = 'Filter';
$group_color  = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Banner Box', 'penci-framework' ),
	'weight' => 828,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'        => 'attach_image',
				'heading'     => __( 'Banner Image', 'penci-framework' ),
				'param_name'  => 'image',
				'value'       => '',
				'description' => __( 'Select image from media library.', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Banner Image size', 'penci-framework' ),
				'param_name'  => 'img_size',
				'std'         => 'full',
				'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use "thumbnail" by default.', 'penci-framework' ),
			),
			array(
				'type'        => 'href',
				'heading'     => __( 'Banner Link', 'penci-framework' ),
				'param_name'  => 'link',
				'description' => __( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'penci-framework' )
			),array(
				'type'        => 'textfield',
				'heading'     => __( 'Banner Text', 'penci-framework' ),
				'param_name'  => 'banner_text'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Link Target', 'penci-framework' ),
				'param_name' => 'img_link_target',
				'value'      => array(
					__( 'Same window', 'penci-framework' ) => '_self',
					__( 'New window', 'penci-framework' )  => '_blank',
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Enable Nofollow', 'penci-framework' ),
				'param_name' => 'enable_nofollow',
			),array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show banner border', 'penci-framework' ),
				'param_name' => 'show_banner_border',
			),
		),
		Penci_Framework_Shortcode_Params::color_params( 'ad_box', false ),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		array(
			// Colors
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_genral_css',
				'heading'          => esc_html__( 'Extra colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border color', 'penci-framework' ),
				'param_name'       => 'banner_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( ' Banner text background color', 'penci-framework' ),
				'param_name'       => 'banner_text_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( ' Banner text color', 'penci-framework' ),
				'param_name'       => 'banner_text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'banner_text',
				'title'        => esc_html__( 'Banner text settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		)
	)
);