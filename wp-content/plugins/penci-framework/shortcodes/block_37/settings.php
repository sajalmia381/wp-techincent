<?php
$shotcode_id = 'block_37';
$group_color = 'Color';

$post_type_default = post_type_exists( 'product' ) ?  'product' : 'post';

return array(
	'name'   => esc_html__( 'Block 37', 'penci-framework' ),
	'weight' => 855,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_build_query( 6 ),
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_image_type(),
		Penci_Framework_Shortcode_Params::block_option_image_size( ),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Columns', 'penci-framework' ),
				'value'      => array(
					esc_html__( '2 Columns', 'penci-framework' ) => '2',
					esc_html__( '3 Columns', 'penci-framework' ) => '3',
					esc_html__( '4 Columns', 'penci-framework' ) => '4',
					esc_html__( '5 Columns', 'penci-framework' ) => '5',
					esc_html__( '6 Columns', 'penci-framework' ) => '6',
				),
				'param_name' => 'column',
				'std'        => '3'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Text align', 'penci-framework' ),
				'value'      => array(
					esc_html__( 'Default', 'penci-framework' ) => '',
					esc_html__( 'Left', 'penci-framework' ) => 'left',
					esc_html__( 'Center', 'penci-framework' ) => 'center',
					esc_html__( 'Right', 'penci-framework' ) => 'right',
				),
				'param_name' => 'text_align',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 12 ) ),
		array(
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Turn on Uppercase Post title', 'penci-framework' ),
				'param_name'       => 'posttitle_on_upper',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'date','comment', 'icon_post_format','cat','review'  ), array( 'author' ) ),
		array(
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Show Post Excrept', 'penci-framework' ),
				'param_name' => 'show_excrept',
				'value'      => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Custom Excerpt Length', 'penci-framework' ),
				'param_name' => 'post_excrept_length',
				'std'        => 15,
				'dependency' => array( 'element' => 'show_excrept', 'value' => 'yes' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable line bottom title', 'penci-framework' ),
				'param_name' => 'enable_line',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'padding_content_lr',
				'heading'          => esc_html__( 'Padding right/left content', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'padding_top_title',
				'heading'          => esc_html__( 'Padding top title post', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'padding_bottom_title',
				'heading'          => esc_html__( 'Padding bottom title post', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'padding_top_meta',
				'heading'          => esc_html__( 'Padding post meta and price padding top', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'padding_bottom_meta',
				'heading'          => esc_html__( 'Padding post meta and price padding bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'padding_top_desc',
				'heading'          => esc_html__( 'Padding top description', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'padding_bottom_desc',
				'heading'          => esc_html__( 'Padding bottom description', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6'
			)
		),
		Penci_Framework_Shortcode_Params::block_option_pag( array( 'limit_loadmore' => 4 ) ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id, false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_meta_css',
				'heading'          => esc_html__( 'Content colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post title color', 'penci-framework' ),
				'param_name'       => 'post_title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post title hover color', 'penci-framework' ),
				'param_name'       => 'post_title_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Line bottom title color', 'penci-framework' ),
				'param_name'       => 'line_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post meta and price color', 'penci-framework' ),
				'param_name'       => 'meta_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post meta and price color when content hover', 'penci-framework' ),
				'param_name'       => 'meta_color_hover',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Description color', 'penci-framework' ),
				'param_name'       => 'desc_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Description color when content hover', 'penci-framework' ),
				'param_name'       => 'desc_color_hover',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Backgroud content color', 'penci-framework' ),
				'param_name'       => 'bg_content_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Backgroud content hover color', 'penci-framework' ),
				'param_name'       => 'bg_content_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6'
			),
		),
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
				'font-size'    => '16px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_meta',
				'title'        => esc_html__( 'Post meta settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '16px',
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
		Penci_Framework_Shortcode_Params::block_option_typo_pagination(),
		Penci_Framework_Shortcode_Params::ajax_filter_params( $shotcode_id ),
		Penci_Framework_Shortcode_Params::block_option_infeed_ad()
	),
	'js_view' => 'VcPenciShortcodeView',
);