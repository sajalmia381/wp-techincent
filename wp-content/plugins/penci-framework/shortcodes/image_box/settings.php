<?php
$group_images = 'Images';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Image Box', 'penci-framework' ),
	'weight' => 828,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'box__settings',
				'heading'          => 'Box settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Box style', 'penci-framework' ),
				'param_name' => 'box_style',
				'value'      => array(
					__( 'Style 1', 'penci-framework' ) => 'boxes-style-1',
					__( 'Style 2', 'penci-framework' ) => 'boxes-style-2',
					__( 'Style 3', 'penci-framework' ) => 'boxes-style-3',
					__( 'Style 4', 'penci-framework' ) => 'boxes-style-4',
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Columns', 'penci-framework' ),
				'param_name' => 'columns',
				'value'      => array(
					__( '1 Column', 'penci-framework' )  => 'column-1',
					__( '2 Columns', 'penci-framework' ) => 'columns-2',
					__( '3 Columns', 'penci-framework' ) => 'columns-3',
					__( '4 Columns', 'penci-framework' ) => 'columns-4',
				),
				'std'        => 'columns-3'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Set Height for Crop Banner Images:', 'penci-framework' ),
				'param_name'  => 'height_img',
				'std'         => '',
				'description' => esc_html__( 'Example if you want to set the images with ratio width/height = 4/3 = 133% - Let\'s fill here is 133. ( Default is 67 )', 'penci-framework' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Disable space between element?', 'penci-framework' ),
				'param_name' => 'dis_space',
			),
			array(
				'type'       => 'param_group',
				'heading'    => '',
				'param_name' => 'images',
				'group'      => $group_images,
				'value' => urlencode( json_encode( array(
					array(
						'image'       => '',
						'title'       => 'Custom title 1',
						'url'         => '#custom_url',
						'link_target' => ''
					),
					array(
						'image'       => '',
						'title'       => 'Custom title 2',
						'url'         => '#custom_url',
						'link_target' => ''
					),
					array(
						'image'       => '',
						'title'       => 'Custom title 3',
						'url'         => '#custom_url',
						'link_target' => ''
					),
				) ) ),
				'params'     => array(
					array(
						'type'        => 'attach_image',
						'heading'     => __( 'Image', 'penci-framework' ),
						'param_name'  => 'image',
						'value'       => '',
						'description' => __( 'Select image from media library.', 'penci-framework' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Custom title', 'penci-framework' ),
						'param_name'  => 'title',
						'admin_label' => true,
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Custom url', 'penci-framework' ),
						'param_name'  => 'url',
						'admin_label' => true,
					),
					array(
						'type'       => 'checkbox',
						'heading'    => __( 'Open in new window', 'penci-framework' ),
						'param_name' => 'link_target',
					),
				),
			),
		),
		Penci_Framework_Shortcode_Params::color_params( '', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_image_box_css',
				'heading'          => esc_html__( 'Image box colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Background and Border color', 'penci-framework' ),
				'param_name'       => 'img_box_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Text color', 'penci-framework' ),
				'param_name'       => 'img_box_text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Hover text color', 'penci-framework' ),
				'param_name'       => 'img_box_text_hcolor',
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
				'prefix'       => 'img_box_text',
				'title'        => esc_html__( 'Text settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '14px',
			)
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);