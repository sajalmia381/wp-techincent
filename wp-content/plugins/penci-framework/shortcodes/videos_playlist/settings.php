<?php

$group_filter       = 'Filter';
$group_color        = 'Color';
$video_shortcode_id = '';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Videos Playlist', 'penci-framework' ),
	'weight' => 828,
	'params' => array_merge(
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Select style block title', 'penci-framework' ),
				'param_name' => 'style_block_title',
				'std'        => 'style-title-1',
				'value'      => array(
					esc_html__( 'Style 1', 'penci-framework' )          => 'style-title-1',
					esc_html__( 'Style 2', 'penci-framework' )          => 'style-title-2',
					esc_html__( 'Style 3', 'penci-framework' )          => 'style-title-3',
					esc_html__( 'Style 4', 'penci-framework' )          => 'style-title-4',
					esc_html__( 'Style 5', 'penci-framework' )          => 'style-title-5',
					esc_html__( 'Style 6', 'penci-framework' )          => 'style-title-6',
					esc_html__( 'Style 7', 'penci-framework' )          => 'style-title-7',
					esc_html__( 'Style 8', 'penci-framework' )          => 'style-title-8',
					esc_html__( 'Style 9', 'penci-framework' )          => 'style-title-9',
					esc_html__( 'Style 10', 'penci-framework' )         => 'style-title-10',
					esc_html__( 'Style 11', 'penci-framework' )         => 'style-title-11',
					esc_html__( 'Style 12', 'penci-framework' )         => 'style-title-12',
					esc_html__( 'Style 13', 'penci-framework' )         => 'style-title-13',
					esc_html__( 'Style Video List', 'penci-framework' ) => 'style-video_list',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Block title:', 'penci-framework' ),
				'param_name'  => 'title',
				'std'         => '',
				'admin_label' => true,
				'description' => esc_html__( 'A title for this block, if you leave it blank the block will not have a title', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title url:', 'penci-framework' ),
				'param_name'  => 'block_title_url',
				'std'         => '',
				'description' => esc_html__( 'A custom url when the block title is clicked', 'penci-framework' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Add icon for title?', 'penci-framework' ),
				'param_name' => 'add_title_icon',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon Alignment', 'penci-framework' ),
				'description' => __( 'Select icon alignment.', 'penci-framework' ),
				'param_name' => 'title_i_align',
				'value' => array(
					__( 'Left', 'penci-framework' ) => 'left',
					__( 'Right', 'penci-framework' ) => 'right',
				),
				'dependency' => array( 'element' => 'add_title_icon', 'value' => 'true', ),
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Icon', 'penci-framework' ),
				'param_name' => 'title_icon',
				'settings'   => array(
					'emptyIcon'    => true,
					'type'         => 'fontawesome',
					'iconsPerPage' => 4000,
				),
				'dependency' => array( 'element' => 'add_title_icon', 'value' => 'true',
				),
			),
			array(
				'type'        => 'exploded_textarea',
				'heading'     => esc_html__( 'Videos List', 'penci-framework' ),
				'param_name'  => 'videos_list',
				'std'         => '',
				'description' => 'Enter each video url in a seprated line. Supports: YouTube and Vimeo videos only.<br><span style="color: red;font-weight: bold;">Note Important</span>: If  you use video come from youtube, please go to Customize > General Options > YouTube API Key and enter an api key.</span>'
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_meta_settings',
				'heading'          => 'Meta settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide video duration', 'penci-framework' ),
				'param_name'       => 'hide_duration',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide video order number', 'penci-framework' ),
				'param_name'       => 'hide_order_number',
				'edit_field_class' => 'vc_col-sm-6',
			),

			// Colors
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_genral_css',
				'heading'          => esc_html__( 'Heading block colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border top color', 'penci-framework' ),
				'param_name'       => 'bordertop_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-1','style-title-8', 'style-title-11' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border left or right color', 'penci-framework' ),
				'param_name'       => 'border_left_right_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-9','style-title-10' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border color for block title style 10', 'penci-framework' ),
				'param_name'       => 'border_color_title_s10',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-10' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Background text block color', 'penci-framework' ),
				'param_name'       => 'background_title_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-2', 'style-title-4', 'style-title-9','style-video_list' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Title text color', 'penci-framework' ),
				'param_name'       => 'title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Title text hover color', 'penci-framework' ),
				'param_name'       => 'title_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border bottom text color', 'penci-framework' ),
				'param_name'       => 'border_title_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-1', 'style-title-3', 'style-title-4' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_css',
				'heading'          => esc_html__( 'Extra colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Background list videos', 'penci-framework' ),
				'param_name'       => 'list_video_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Video title color', 'penci-framework' ),
				'param_name'       => 'video_title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Video title hover color', 'penci-framework' ),
				'param_name'       => 'video_title_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Video duration color', 'penci-framework' ),
				'param_name'       => 'duration_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Video order number color', 'penci-framework' ),
				'param_name'       => 'order_number_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Video order number background color', 'penci-framework' ),
				'param_name'       => 'order_number_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Item video border color', 'penci-framework' ),
				'param_name'       => 'item_video_border-color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Item video hover background and border color', 'penci-framework' ),
				'param_name'       => 'item_video_bg_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),

		),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 10 ) ),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block Video List title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'video_title',
				'title'        => esc_html__( 'Video title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '13px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'duration_typo',
				'title'        => esc_html__( 'Video duration settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '13px',
			)
		)
	),
	'js_view'                 => 'VcPenciVideoList',
);