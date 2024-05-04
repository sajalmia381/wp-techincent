<?php

$group_filter = 'Filter';
$group_color  = 'Color';
$shotcode_id = '';

// Shortcode settings
return array(
	'name'     => esc_html__( 'About Us', 'penci-framework' ),
	'params'   => array_merge(
		Penci_Framework_Shortcode_Params::block_title( ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
		array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Align This Block', 'penci-framework' ),
				'param_name' => 'block_text_align',
				'value' => array(
					__( 'Align Center', 'penci-framework' ) => 'pc_aligncenter',
					__( 'Align Left', 'penci-framework' ) => 'pc_alignleft',
					__( 'Align Right', 'penci-framework' ) => 'pc_alignright',
				),
				'std' => 'center',
			),
			array(
				'type'        => 'attach_image',
				'heading'     => __( 'About Image', 'penci-framework' ),
				'param_name'  => 'about_image',
				'value'       => '',
				'description' => __( 'Select image from media library.', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'About Image size', 'penci-framework' ),
				'param_name'  => 'img_size',
				'std'         => 'full',
				'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use "thumbnail" by default.', 'penci-framework' ),
			),
			array(
				'type'        => 'href',
				'heading'     => __( 'Add Link for About Image', 'penci-framework' ),
				'param_name'  => 'imageurl',
				'description' => __( 'If you want to clickable on the about me image link to other page, put the link here. Include http:// or https:// on the link', 'penci-framework' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Link Target', 'penci-framework' ),
				'param_name' => 'target',
				'value'      => array(
					__( 'Same window', 'penci-framework' ) => '_self',
					__( 'New window', 'penci-framework' )  => '_blank',
				),
				'dependency' => array(
					'element' => 'onclick',
					'value'   => array( 'custom_link' ),
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Heading Text:', 'penci-framework' ),
				'param_name'  => 'heading',
				'value'        => '',
				'admin_label' => true,
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'About us text: ( you can use HTML here )', 'penci-framework' ),
				'param_name' => 'content',
				'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'penci-framework' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Make About Image Circle:', 'penci-framework' ),
				'param_name' => 'circle',
				'description' => __( 'To use this feature, please use square image for your image above to get best display.', 'penci-framework' )
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Disable Lazyload for About Me Image:', 'penci-framework' ),
				'param_name' => 'lazyload',
				'description' => __( 'To use this feature, please use square image for your image above to get best display.', 'penci-framework' )
			),
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id, false ),
		array(
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'About us heading text color', 'penci-framework' ),
				'param_name'       => 'aboutus_hedding_color',
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
				'prefix'       => 'aboutus_hedding',
				'title'        => esc_html__( 'About us heading text settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '18px',
			)
		)
	)
);