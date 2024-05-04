<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$shotcode_id = 'icon_boxes';
$group_color = 'Color';
$group_line = 'Line';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Info Box', 'penci-framework' ),
	'weight' => 700,
	'params' => array_merge(
		array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'penci-framework' ),
				'param_name'  => '_title',
				'admin_label' => true,
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Use line below the title', 'penci-framework' ),
				'param_name' => '_use_line',
			),
			array(
				'type'       => 'textarea',
				'heading'    => esc_html__( 'Content', 'penci-framework' ),
				'param_name' => '_text',
				'value'      => esc_html__( 'Insert your content here','penci-framework' )
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
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Image hover', 'penci-framework' ),
				'param_name' => 'image_hover',
				'dependency' => array( 'element' => 'icon_type', 'value'   => 'image' ),
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
				'value' => 'fa fa-adjust',
				'settings' => array(
					'emptyIcon' => false,
					'iconsPerPage' => 100,
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
					'iconsPerPage' => 100,
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
					'iconsPerPage' => 100,
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
					'iconsPerPage' => 100,
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
					'iconsPerPage' => 100,
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
					'iconsPerPage' => 100,
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
					'iconsPerPage' => 100,
					// default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => '_icon_type',
					'value' => 'material',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Size Icon', 'penci-framework' ),
				'param_name' => 'icon_size',
				'value'      => array(
					esc_html__( 'Small', 'penci-framework' )       => 'sm',
					esc_html__( 'Normal', 'penci-framework' )      => 'md',
					esc_html__( 'Large', 'penci-framework' )       => 'lg',
					esc_html__( 'Extra Large', 'penci-framework' ) => 'xl',
					esc_html__( 'Custom size', 'penci-framework' ) => 'custom',
				),
				'std'        => 'md',
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_fsize',
				'heading'    => __( 'Font size for Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '20px',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => 'icon_size', 'value' => 'custom' ),
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
				'type'             => 'penci_number',
				'param_name'       => 'icon_mar_top_bottom',
				'heading'          => __( 'Custom margin bottom for Icon or Image', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon position', 'penci-framework' ),
				'param_name' => 'icon_position',
				'value'      => array(
					esc_html__( 'Top left', 'penci-framework' )    => 'top-left',
					esc_html__( 'Top center', 'penci-framework' )  => 'top-center',
					esc_html__( 'Top right', 'penci-framework' )   => 'top-right',
					esc_html__( 'Float left', 'penci-framework' )  => 'float-left',
					esc_html__( 'Float right', 'penci-framework' ) => 'float-right',
					esc_html__( 'Icon left', 'penci-framework' )    => 'icon-left',
					esc_html__( 'Icon right', 'penci-framework' )    => 'icon-right',
				),
				'std'        => 'float-left',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Background shape for Icon', 'penci-framework' ),
				'param_name'  => 'background_style',
				'value'       => array(
					__( 'None', 'penci-framework' )            => '',
					__( 'Circle', 'penci-framework' )          => 'rounded',
					__( 'Square', 'penci-framework' )          => 'boxed',
					__( 'Rounded', 'penci-framework' )         => 'rounded-less',
					__( 'Outline Circle', 'penci-framework' )  => 'rounded-outline',
					__( 'Outline Square', 'penci-framework' )  => 'boxed-outline',
					__( 'Outline Rounded', 'penci-framework' ) => 'rounded-less-outline',
				),
				'description' => __( 'Select background shape and style for icon.', 'penci-framework' ),
				'dependency' => array( 'element' => 'icon_position', 'value' => array(
					'top-left','top-center','top-right','float-left','float-right',
				) )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Icon Hover Effects', 'penci-framework' ),
				'param_name'  => 'icon_effects',
				'value'       => array(
					__( 'None', 'penci-framework' )    => '',
					__( 'Style 1', 'penci-framework' ) => 's1',
					__( 'Style 2', 'penci-framework' ) => 's2',
					__( 'Style 3', 'penci-framework' ) => 's3',
					__( 'Style 4', 'penci-framework' ) => 's4',
					__( 'Style 5', 'penci-framework' ) => 's5'
				),
				'description' => __( 'Select background shape and style for icon.', 'penci-framework' ),
				'dependency' => array( 'element' => 'icon_position', 'value' => array(
					'top-left','top-center','top-right','float-left','float-right',
				) )
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'URL (Link)', 'penci-framework' ),
				'param_name' => 'link',
				'description' => __( 'Add link to icon.', 'penci-framework' ),
			),

			// Line
			array(
				'type'             => 'penci_number',
				'param_name'       => 'line_width',
				'heading'          => __( 'Line width', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'dependency' => array( 'element' => '_use_line', 'value' => 'true', ),
				'group'      => $group_line,
			),array(
				'type'             => 'penci_number',
				'param_name'       => 'line_height',
				'heading'          => __( 'Line height', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'dependency' => array( 'element' => '_use_line', 'value' => 'true', ),
				'group'      => $group_line,
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'line_margin_top',
				'heading'          => __( 'Margin top', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'dependency' => array( 'element' => '_use_line', 'value' => 'true', ),
				'group'      => $group_line,
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'line_margin_bottom',
				'heading'          => __( 'Margin bototm', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'dependency' => array( 'element' => '_use_line', 'value' => 'true', ),
				'group'      => $group_line,
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
				'heading'          => esc_html__( 'Content color', 'penci-framework' ),
				'param_name'       => '_content_color',
				'group'            => $group_color,
			),
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
				'heading'          => esc_html__( 'Icon hover color', 'penci-framework' ),
				'param_name'       => 'icon_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Icon hover background color', 'penci-framework' ),
				'param_name'       => 'icon_hbgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Icon hover border color', 'penci-framework' ),
				'param_name'       => 'icon_hborder_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Custom color for Line', 'penci-framework' ),
				'param_name'       => 'line_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'title',
				'title'        => esc_html__( 'Title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '20px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'content',
				'title'        => esc_html__( 'Content settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);