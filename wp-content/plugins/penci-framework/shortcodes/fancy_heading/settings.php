<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$shotcode_id = 'fancy_heading';
$group_icon  = 'Icon';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'    => esc_html__( 'Fancy Heading', 'penci-framework' ),
	'weight'  => 700,
	'params'  => array_merge(
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Text Align', 'penci-framework' ),
				'param_name' => '_text_align',
				'std'        => 'center',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )   => 'left',
					esc_html__( 'Center', 'penci-framework' ) => 'center',
					esc_html__( 'Right', 'penci-framework' )  => 'right',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Subtitle:', 'penci-framework' ),
				'param_name' => 'subtitle',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Subtitle tag', 'penci-framework' ),
				'param_name' => 'subtitle_tag',
				'std'        => 'div',
				'value'      => array(
					'h1'   => 'h1',
					'h2'   => 'h2',
					'h3'   => 'h3',
					'h4'   => 'h4',
					'h5'   => 'h5',
					'h6'   => 'h6',
					'span' => 'span',
					'p'    => 'p',
					'div'  => 'div',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Subtitle position', 'penci-framework' ),
				'param_name' => 'subtitle_pos',
				'std'        => 'above',
				'value'      => array(
					esc_html__( 'Above the title', 'penci-framework' )     => 'above',
					esc_html__( 'Below the title', 'penci-framework' )     => 'below',
					esc_html__( 'Below the separator', 'penci-framework' ) => 'belowline',
				),
			),array(
				'type'       => 'penci_number',
				'param_name' => 'subtitle_margin_top',
				'heading'    => __( 'Custom margin top for subtitle', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'subtitle_margin_bottom',
				'heading'    => __( 'Custom margin bottom for subtitle', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'subtitle_width',
				'heading'    => __( 'Custom width for subtitle', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title:', 'penci-framework' ),
				'param_name'  => 'title',
				'admin_label' => true,
				'value'       => esc_html__( 'This is custom heading element', 'penci-framework' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Title tag', 'penci-framework' ),
				'param_name' => 'title_tag',
				'std'        => 'h2',
				'value'      => array(
					'h1'   => 'h1',
					'h2'   => 'h2',
					'h3'   => 'h3',
					'h4'   => 'h4',
					'h5'   => 'h5',
					'h6'   => 'h6',
					'span' => 'span',
					'p'    => 'p',
					'div'  => 'div',
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Turn on upppearcase for title', 'penci-framework' ),
				'param_name' => 'turn_on_title',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Use separator', 'penci-framework' ),
				'param_name' => '_use_separator',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Style', 'penci-framework' ),
				'param_name'  => 'separator_style',
				'value'       => array(
					'Border' => '',
					'Dashed' => 'dashed',
					'Dotted' => 'dotted',
					'Double' => 'double'
				),
				'description' => __( 'Separator display style.', 'penci-framework' ),
				'dependency'  => array( 'element' => '_use_separator', 'value' => 'true', ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Add separator icon?', 'penci-framework' ),
				'param_name' => 'add_separator_icon',
				'dependency' => array( 'element' => 'separator_style', 'value_not_equal_to' => 'double' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Separator Border width', 'penci-framework' ),
				'param_name'  => 'separator_border_width',
				'value'       => array(
					'1px'  => '',
					'2px'  => '2',
					'3px'  => '3',
					'4px'  => '4',
					'5px'  => '5',
					'6px'  => '6',
					'7px'  => '7',
					'8px'  => '8',
					'9px'  => '9',
					'10px' => '10',
				),
				'description' => __( 'Select border width (pixels).', 'penci-framework' ),
				'dependency'  => array( 'element' => '_use_separator', 'value' => 'true', ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'separator_width',
				'heading'    => __( 'Separator width', 'penci-framework' ),
				'value'      => '',
				'std'        => '60px',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => '_use_separator', 'value' => 'true', ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'separator_margin_top',
				'heading'    => __( 'Custom margin top for Separator', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'content_margin_top',
				'heading'    => __( 'Custom margin top for Content', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'content_width',
				'heading'    => __( 'Custom width for Content', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'textarea_html',
				'holder'     => 'div',
				'heading'    => __( 'Content', 'penci-framework' ),
				'param_name' => 'content',
				'value'      => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'penci-framework' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Icon library', 'penci-framework' ),
				'value'       => array(
					__( 'Font Awesome', 'penci-framework' ) => 'fontawesome',
					__( 'Open Iconic', 'penci-framework' )  => 'openiconic',
					__( 'Typicons', 'penci-framework' )     => 'typicons',
					__( 'Entypo', 'penci-framework' )       => 'entypo',
					__( 'Linecons', 'penci-framework' )     => 'linecons',
					__( 'Mono Social', 'penci-framework' )  => 'monosocial',
					__( 'Material', 'penci-framework' )     => 'material',
				),
				'param_name'  => '_icon_type',
				'description' => __( 'Select icon library.', 'penci-framework' ),
				'dependency'  => array( 'element' => 'add_separator_icon', 'value' => 'true', ),
				'group'       => $group_icon,
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'penci-framework' ),
				'param_name'  => 'icon_fontawesome',
				'value'       => 'fa fa-adjust',
				// default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
				),
				'dependency'  => array(
					'element' => '_icon_type',
					'value'   => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
				'group'       => $group_icon,
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'penci-framework' ),
				'param_name'  => 'icon_openiconic',
				'value'       => 'vc-oi vc-oi-dial',
				// default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'type'         => 'openiconic',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => '_icon_type',
					'value'   => 'openiconic',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
				'group'       => $group_icon,
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'penci-framework' ),
				'param_name'  => 'icon_typicons',
				'value'       => 'typcn typcn-adjust-brightness',
				// default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'type'         => 'typicons',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => '_icon_type',
					'value'   => 'typicons',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
				'group'       => $group_icon,
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => __( 'Icon', 'penci-framework' ),
				'param_name' => 'icon_entypo',
				'value'      => 'entypo-icon entypo-icon-note',
				// default value to backend editor admin_label
				'settings'   => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'type'         => 'entypo',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value'   => 'entypo',
				),
				'group'      => $group_icon,
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'penci-framework' ),
				'param_name'  => 'icon_linecons',
				'value'       => 'vc_li vc_li-heart',
				// default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'type'         => 'linecons',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => '_icon_type',
					'value'   => 'linecons',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
				'group'       => $group_icon,
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'penci-framework' ),
				'param_name'  => 'icon_monosocial',
				'value'       => 'vc-mono vc-mono-fivehundredpx',
				// default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'type'         => 'monosocial',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => '_icon_type',
					'value'   => 'monosocial',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
				'group'       => $group_icon,
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'penci-framework' ),
				'param_name'  => 'icon_material',
				'value'       => 'vc-material vc-material-cake',
				// default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'type'         => 'material',
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => '_icon_type',
					'value'   => 'material',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
				'group'       => $group_icon,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_size',
				'heading'    => __( 'Size Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '20px',
				'suffix'     => 'px',
				'min'        => 1,
				'group'      => $group_icon,
				'dependency' => array( 'element' => 'add_separator_icon', 'value' => 'true', ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_mar_top_bottom',
				'heading'    => __( 'Custom margin top and bottom for Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '10px',
				'suffix'     => 'px',
				'min'        => 1,
				'group'      => $group_icon,
				'dependency' => array( 'element' => 'add_separator_icon', 'value' => 'true', ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_mar_left_right',
				'heading'    => __( 'Custom margin right and left for Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '15px',
				'suffix'     => 'px',
				'min'        => 1,
				'group'      => $group_icon,
				'dependency' => array( 'element' => 'add_separator_icon', 'value' => 'true', ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Title color', 'penci-framework' ),
				'param_name'       => 'title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Subtitle color', 'penci-framework' ),
				'param_name'       => 'subtitle_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Content color', 'penci-framework' ),
				'param_name' => '_content_color',
				'group'      => $group_color,
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Custom icon color for Separator', 'penci-framework' ),
				'param_name'       => '_separator_icon_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Custom border color for Separator', 'penci-framework' ),
				'param_name'       => '_separator_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'title',
				'title'        => esc_html__( 'Title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '36px',
				'font_style'   => 'normal',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'subtitle',
				'title'        => esc_html__( 'Subtitle settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '16px',
				'font_style'   => 'normal',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'content',
				'title'        => esc_html__( 'Content settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '16px',
			)
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);