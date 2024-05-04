<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$shotcode_id = 'buton';
$group_icon  = 'Icon';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'          => esc_html__( 'Button', 'penci-framework' ),
	'weight'        => 700,
	'js_view'       => 'VcButton3View',
	'custom_markup' => '{{title}}<div class="vc_btn3-container"><button class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-{{ params.shape }} vc_btn3-style-modern vc_btn3-color-grey">{{{ params.title }}}</button></div>',
	'params'        => array_merge(
		array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Text', 'penci-framework' ),
				'param_name' => 'title',
				'value'      => __( 'Text on the button', 'penci-framework' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Turn on uppearcase for title ?', 'penci-framework' ),
				'param_name' => 'title_upper'
			),
			array(
				'type'        => 'vc_link',
				'heading'     => __( 'URL (Link)', 'penci-framework' ),
				'param_name'  => 'btn_link',
				'description' => __( 'Add link to button.', 'penci-framework' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Style', 'penci-framework' ),
				'param_name' => 'btn_style',
				'value'      => array(
					__( 'Fill button', 'penci-framework' )        => 'fill',
					__( 'Simple link', 'penci-framework' )        => 'simple',
					__( 'Transparent button', 'penci-framework' ) => 'trans',
				),
				'std'        => 'fill',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Alignment', 'penci-framework' ),
				'param_name'  => 'align',
				'description' => __( 'Select button alignment.', 'penci-framework' ),
				'value'       => array(
					__( 'Inline', 'penci-framework' ) => 'inline',
					__( 'Left', 'penci-framework' )   => 'left',
					__( 'Right', 'penci-framework' )  => 'right',
					__( 'Center', 'penci-framework' ) => 'center',
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Set full width button?', 'penci-framework' ),
				'param_name' => 'button_fullwidth'
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'penci-framework' ),
				'param_name'  => 'icon_fontawesome',
				'value'       => '',
				'settings'    => array(
					'emptyIcon'    => true,
					'iconsPerPage' => 4000,
				),
				'dependency'  => array(
					'element' => '_icon_type',
					'value'   => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'penci-framework' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Icon Alignment', 'penci-framework' ),
				'description' => __( 'Select icon alignment.', 'penci-framework' ),
				'param_name'  => 'i_align',
				'value'       => array(
					__( 'Left', 'penci-framework' )  => 'left',
					__( 'Right', 'penci-framework' ) => 'right',
				)
			),
			array(
				'type'             => 'penci_only_number',
				'param_name'       => '_i_fsize',
				'heading'          => __( 'Custom size for icon', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'max'              => 1000,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_only_number',
				'param_name'       => '_i_pleft',
				'heading'          => __( 'Icon margin left', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'max'              => 1000,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_only_number',
				'param_name'       => '_i_pright',
				'heading'          => __( 'Icon margin right', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'max'              => 1000,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_only_number',
				'param_name'       => 'btn_plr',
				'heading'          => __( 'Button padding left/right', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'max'              => 1000,
				'dependency'       => array( 'element' => 'btn_style', 'value' => array( 'fill', 'trans' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_only_number',
				'param_name'       => 'btn_ptb',
				'heading'          => __( 'Button padding top/bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'max'              => 1000,
				'dependency'       => array( 'element' => 'btn_style', 'value' => array( 'fill', 'trans' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_only_number',
				'param_name'       => 'btn_radius',
				'heading'          => __( 'Button border radius', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'max'              => 1000,
				'dependency'       => array( 'element' => 'btn_style', 'value' => array( 'fill', 'trans' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_only_number',
				'param_name'       => 'btn_width',
				'heading'          => __( 'Button border width', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'max'              => 1000,
				'dependency'       => array( 'element' => 'btn_style', 'value' => array( 'fill', 'trans' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Button 1
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button text color', 'penci-framework' ),
				'param_name'       => 'btn_text_color',
				'group'            => $group_color,
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Icon color', 'penci-framework' ),
				'param_name'       => 'icon_color',
				'group'            => $group_color,
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button border color', 'penci-framework' ),
				'param_name'       => 'btn_bcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button background color', 'penci-framework' ),
				'param_name'       => 'btn_bg',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button text hover color', 'penci-framework' ),
				'param_name'       => 'btn_text_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button border hover color', 'penci-framework' ),
				'param_name'       => 'btn_hoverbcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button background hover color', 'penci-framework' ),
				'param_name'       => 'btn_hoverbg',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button hover icon color', 'penci-framework' ),
				'param_name'       => 'icon_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'btn',
				'title'        => esc_html__( 'Button settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		)
	)
);