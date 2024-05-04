<?php
$shotcode_id = 'block_list';
$group_color = 'Color';
// Shortcode settings
return array(
	'name'    => esc_html__( 'Blog List No Featured Images', 'penci-framework' ),
	'weight'  => 700,
	'params'  => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Text Align', 'penci-framework' ),
				'param_name' => 'text_align',
				'std'        => 'center',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )   => 'left',
					esc_html__( 'Center', 'penci-framework' ) => 'center',
					esc_html__( 'Right', 'penci-framework' )  => 'right',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Column', 'penci-framework' ),
				'param_name' => '_column',
				'value'      => array(
					esc_html__( 'Default', 'penci-framework' )   => '',
					esc_html__( '1 Column', 'penci-framework' )  => '1',
					esc_html__( '2 Columns', 'penci-framework' ) => '2',
					esc_html__( '3 Columns', 'penci-framework' ) => '3',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Block title:', 'penci-framework' ),
				'param_name'  => 'block_title',
				'value'       => '',
				'admin_label' => true,
				'description' => esc_html__( 'A title for this block, if you leave it blank the block will not have a title', 'penci-framework' ),
			),
		),
		array(
			array(
				'type'       => 'textfield',
				'param_name' => 'post_title_length',
				'heading'    => esc_html__( 'Custom Post Title Length:', 'penci-framework' ),
				'std'        => '12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Block Title text color', 'penci-framework' ),
				'param_name'       => 'block_title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border bottom of item post color', 'penci-framework' ),
				'param_name'       => 'post_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_css',
				'heading'          => esc_html__( 'Post title colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post title color', 'penci-framework' ),
				'param_name'       => 'post_title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post title hover color', 'penci-framework' ),
				'param_name'       => 'post_title_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_category_css',
				'heading'          => esc_html__( 'Category colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Category color', 'penci-framework' ),
				'param_name'       => 'cat_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Category hover color', 'penci-framework' ),
				'param_name'       => 'cat_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_color_meta(),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'cat', 'date', 'comment' ) ),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '42px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Post title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '24px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'cat',
				'title'        => esc_html__( 'Categories settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_meta',
				'title'        => esc_html__( 'Post meta settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_infeed_ad()

	),
	'js_view' => 'VcPenciShortcodeView',
);