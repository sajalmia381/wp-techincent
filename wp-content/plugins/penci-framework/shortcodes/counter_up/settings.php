<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$group_color = 'Color';

// Shortcode settings
return array(
	'name'        => esc_html__( 'Counter Up', 'penci-framework' ),
	'params'      => array_merge(
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Counter Up style', 'penci-framework' ),
				'param_name' => 'cup_style',
				'std'        => 's1',
				'value'      => array(
					esc_html__( 'Style 1', 'penci-framework' ) => 's1',
					esc_html__( 'Style 2', 'penci-framework' ) => 's2',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Counter Up Align', 'penci-framework' ),
				'param_name' => 'cup_align',
				'value'      => array(
					__( 'Align Center', 'penci-framework' ) => 'center',
					__( 'Align Left', 'penci-framework' )   => 'left',
					__( 'Align Right', 'penci-framework' )  => 'right',
				),
				'std' => 'center',
				'dependency' => array( 'element' => 'cup_style', 'value' => 's1' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon type', 'penci-framework' ),
				'param_name' => 'icon_type',
				'value'      => array(
					esc_html__( 'Icon', 'penci-framework' )  => 'icon',
					esc_html__( 'Image', 'penci-framework' ) => 'image',
				),
			),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Image', 'penci-framework' ),
				'param_name' => 'image',
				'dependency' => array( 'element' => 'icon_type', 'value' => 'image' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Image size', 'penci-framework' ),
				'param_name'  => 'img_size',
				'std'         => 'full',
				'dependency' => array( 'element' => 'icon_type', 'value' => 'image', ),
				'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use "thumbnail" by default.', 'penci-framework' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'penci-framework' ),
				'value' => array(
					__( 'Font Awesome', 'penci-framework' ) => 'fontawesome',
					__( 'Open Iconic', 'penci-framework' ) => 'openiconic',
					__( 'Typicons', 'penci-framework' ) => 'typicons',
					__( 'Entypo', 'penci-framework' ) => 'entypo',
					__( 'Linecons', 'penci-framework' ) => 'linecons',
					__( 'Mono Social', 'penci-framework' ) => 'monosocial',
					__( 'Material', 'penci-framework' ) => 'material',
				),
				'param_name' => '_icon_type',
				'description' => __( 'Select icon library.', 'penci-framework' ),
				'dependency' => array( 'element' => 'icon_type', 'value' => 'icon', ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'penci-framework' ),
				'param_name' => 'icon_fontawesome',
				'value' => '',
				// default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => true,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value' => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'penci-framework' ),
				'param_name' => 'icon_openiconic',
				'value' => 'vc-oi vc-oi-dial',
				// default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value' => 'openiconic',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'penci-framework' ),
				'param_name' => 'icon_typicons',
				'value' => 'typcn typcn-adjust-brightness',
				// default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value' => 'typicons',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'penci-framework' ),
				'param_name' => 'icon_entypo',
				'value' => 'entypo-icon entypo-icon-note',
				// default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value' => 'entypo',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'penci-framework' ),
				'param_name' => 'icon_linecons',
				'value' => 'vc_li vc_li-heart',
				// default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value' => 'linecons',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' )
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'penci-framework' ),
				'param_name' => 'icon_monosocial',
				'value' => 'vc-mono vc-mono-fivehundredpx',
				// default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'monosocial',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value' => 'monosocial',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'penci-framework' ),
				'param_name' => 'icon_material',
				'value' => 'vc-material vc-material-cake',
				// default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'type' => 'material',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value' => 'material',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Number', 'penci-framework' ),
				'param_name'       => 'number'
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Prefix of number', 'penci-framework' ),
				'param_name'       => 'prefix_number'
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Suffix of number', 'penci-framework' ),
				'param_name'       => 'suffix_number',
			),array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Title', 'penci-framework' ),
				'param_name'       => 'title',
				'admin_label'      => true
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_fsize',
				'heading'    => __( 'Font size for Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => 'icon_type', 'value' => 'icon', ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon border style', 'penci-framework' ),
				'param_name' => 'icon_border_style',
				'value'      => array(
					esc_html__( 'None', 'penci-framework' )   => '',
					esc_html__( 'Solid', 'penci-framework' )  => 'solid',
					esc_html__( 'Dashed', 'penci-framework' ) => 'dashed',
					esc_html__( 'Dotted', 'penci-framework' ) => 'dotted',
					esc_html__( 'Double', 'penci-framework' ) => 'double',
				)
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_border_width',
				'heading'    => __( 'Border width for Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => 'icon_border_style', 'value' => array( 'solid', 'dashed', 'dotted', 'double' ) ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_border_radius',
				'heading'    => __( 'Border radius for Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => 'icon_border_style', 'value' => array( 'solid', 'dashed', 'dotted', 'double' ) ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_padding',
				'heading'    => __( 'Padding for Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => 'icon_size', 'value' => 'custom' ),
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => '_image_width_height',
				'heading'          => __( 'Image with/height', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'dependency' => array( 'element' => 'icon_type', 'value'   => 'image' ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_margin_bottom',
				'heading'    => __( 'Custom margin bottom for Icon or Image', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'number_margin_top',
				'heading'    => __( 'Custom margin top for number', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'title_margin_top',
				'heading'    => __( 'Custom margin top for title', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'button_margin_top',
				'heading'    => __( 'Custom margin top for Read more button', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'button_margin_bottom',
				'heading'    => __( 'Custom margin bottom for Read more button', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Delay', 'penci-framework' ),
				'param_name'       => 'delay'
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Time', 'penci-framework' ),
				'param_name'       => 'time'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Use button read more ?', 'penci-framework' ),
				'param_name' => 'use_button',
				'value'      => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Read more button text', 'penci-framework' ),
				'param_name' => 'button_text',
				'value'      => esc_html__( 'Read more', 'penci-framework' ),
				'dependency'       => array( 'element' => 'use_button', 'value' => 'yes' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Read more button Link', 'penci-framework' ),
				'param_name' => 'button_link',
				'dependency'       => array( 'element' => 'use_button', 'value' => 'yes' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Image Type', 'penci-framework' ),
				'param_name' => 'btn_type',
				'value'      => array(
					__( 'Simple Link', 'penci-framework' ) => '',
					__( 'Fill Button', 'penci-framework' ) => 'background'
				),
				'dependency'       => array( 'element' => 'use_button', 'value' => 'yes' ),
			),
			// Color
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Icon color', 'penci-framework' ),
				'param_name'       => 'icon_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Icon background color', 'penci-framework' ),
				'param_name'       => 'icon_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Icon border color', 'penci-framework' ),
				'param_name'       => 'icon_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Number color', 'penci-framework' ),
				'param_name'       => 'number_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Prefix and suffix  color', 'penci-framework' ),
				'param_name'       => 'frefix_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Title color', 'penci-framework' ),
				'param_name'       => 'title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_bt_settings',
				'heading'          => 'Button settings',
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
				'dependency'       => array( 'element' => 'use_button', 'value' => 'yes' ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button text color', 'penci-framework' ),
				'param_name'       => 'btn_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => 'use_button', 'value' => 'yes' ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button background color', 'penci-framework' ),
				'param_name'       => 'btn_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => 'btn_type', 'value' => 'background' ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button hover text color', 'penci-framework' ),
				'param_name'       => 'btn_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => 'use_button', 'value' => 'yes' ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button hover background color', 'penci-framework' ),
				'param_name'       => 'btn_hbgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => 'btn_type', 'value' => 'background' ),
			)
		),
		// Typo
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'number',
				'title'        => esc_html__( 'Number settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '50px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'pre_postfix',
				'title'        => esc_html__( 'Prefix and suffix  settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '50px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'title',
				'title'        => esc_html__( 'Title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '24px',
			)
		),Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'btn',
				'title'        => esc_html__( 'Button settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
				'dependency'   => array( 'element' => 'use_button', 'value' => 'yes' )
			)
		)
	)
);