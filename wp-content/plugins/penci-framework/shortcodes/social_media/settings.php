<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// Shortcode settings
return array(
	'name'    => esc_html__( 'Social Media', 'penci-framework' ),
	'weight'  => 700,
	'params'  => array_merge(
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Position', 'penci-framework' ),
				'param_name' => '_pos',
				'std'        => 'center',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )   => 'left',
					esc_html__( 'Center', 'penci-framework' ) => 'center',
					esc_html__( 'Right', 'penci-framework' )  => 'right',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Social icon style', 'penci-framework' ),
				'param_name' => '_icon_style',
				'std'        => 'default',
				'value'      => array(
					esc_html__( 'Default', 'penci-framework' ) => 'default',
					esc_html__( 'Circle', 'penci-framework' )  => 'circle',
					esc_html__( 'Square', 'penci-framework' )  => 'square',
				),
			),
			array(
				'type'       => 'penci_only_number',
				'param_name' => '_icon_width',
				'heading'    => __( 'Custom width & height for circle & square style', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => '_icon_style', 'value' => array( 'circle', 'square' ) ),
			),

			array(
				'type'       => 'penci_only_number',
				'param_name' => '_icon_border_w',
				'heading'    => __( 'Custom border width for circle & square style', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => '_icon_style', 'value' => array( 'circle', 'square' ) ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'font_size',
				'heading'    => __( 'Custom font size', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'social_space',
				'heading'    => __( 'Custom space between social icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social icon color', 'penci-framework' ),
				'param_name'       => 'icon_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social icon hover color', 'penci-framework' ),
				'param_name'       => 'icon_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social icon background color', 'penci-framework' ),
				'param_name'       => 'icon_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => '_icon_style', 'value' => array( 'circle', 'square' ) ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social icon background hover color', 'penci-framework' ),
				'param_name'       => 'icon_hover_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => '_icon_style', 'value' => array( 'circle', 'square' ) ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social icon border color', 'penci-framework' ),
				'param_name'       => 'icon_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => '_icon_style', 'value' => array( 'circle', 'square' ) ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social icon border hover color', 'penci-framework' ),
				'param_name'       => 'icon_hover_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => '_icon_style', 'value' => array( 'circle', 'square' ) ),
			)
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);