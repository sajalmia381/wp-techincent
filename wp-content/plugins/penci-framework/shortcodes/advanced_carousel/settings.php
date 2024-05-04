<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$shotcode_id = 'advanced_carousel';
$group_nav = 'Navigation';

// Shortcode settings
return array(
	'name'                    => esc_html__( 'Advanced Carousel', 'penci-framework' ),
	'weight'                  => 700,
	'as_parent'               => array( 'except' => 'penci_advanced_carousel' ),
	'params'                  => array(
		array(
			'type'             => 'textfield',
			'param_name'       => 'limit_heading',
			'heading'          => esc_html__( 'Items to Show', 'penci-framework' ),
			'value'            => '',
			'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
		),
		array(
			'type'       => 'penci_only_number',
			'heading'    => esc_html__( 'On desktop', 'penci-framework' ),
			'param_name' => 'limit_desk',
			'class'      => '',
			'value'      => 5,
			'min'        => 1,
			'max'        => 25,
			'step'       => 1,
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'       => 'penci_only_number',
			'heading'    => esc_html__( 'On tab', 'penci-framework' ),
			'param_name' => 'limit_tab',
			'class'      => '',
			'value'      => 3,
			'min'        => 1,
			'max'        => 25,
			'step'       => 1,
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'       => 'penci_only_number',
			'heading'    => esc_html__( 'On mobile', 'penci-framework' ),
			'param_name' => 'limit_mobile',
			'class'      => '',
			'value'      => 1,
			'min'        => 1,
			'max'        => 25,
			'step'       => 1,
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Disable Auto Play Slider ', 'penci-framework' ),
			'param_name' => 'auto_play',
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Disable Slider Loop', 'penci-framework' ),
			'param_name' => 'disable_loop',
		),
		array(
			'type'        => 'penci_only_number',
			'heading'     => esc_html__( 'Slider Auto Time (at x seconds)', 'penci-framework' ),
			'param_name'  => 'auto_time',
			'class'      => '',
			'value'      => 4000,
			'min'        => 1,
			'max'        => 100000,
			'step'       => 1,
		),
		array(
			'type'        => 'penci_only_number',
			'heading'     => esc_html__( 'Slider Speed (at x seconds)', 'penci-framework' ),
			'param_name'  => 'speed',
			'class'      => '',
			'value'      => 800,
			'min'        => 1,
			'max'        => 100000,
			'step'       => 1,
		),
		array(
			'type'        => 'penci_only_number',
			'heading'     => esc_html__( 'Margin right on item ( px )', 'penci-framework' ),
			'param_name'  => 'margin_right',
			'class'      => '',
			'value'      => '',
			'min'        => 1,
			'max'        => 50,
			'step'       => 1,
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Disable navigation arrows', 'penci-framework' ),
			'param_name' => 'dis_arrows',
			//'group'      => $group_nav,
			'value'      => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
		),
//		array(
//			"type"       => "dropdown",
//			"class"      => "",
//			"heading"    => __( "Arrow Style", "penci-framework" ),
//			"param_name" => "arrow_style",
//			"value"      => array(
//				"Default"           => "default",
//				"Circle Background" => "circle-bg",
//				"Square Background" => "square-bg",
//				"Circle Border"     => "circle-border",
//				"Square Border"     => "square-border",
//			),
//			'dependency' => array(
//				'element'            => 'dis_arrows',
//				'value_not_equal_to' => 'yes',
//			),
//			'group'      => $group_nav,
//		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Enable dots navigation', 'penci-framework' ),
			'param_name' => 'enable_dots',
			//'group'      => $group_nav,
		),array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Enable Auto width', 'penci-framework' ),
			'param_name' => 'autowidth',
			'description' => esc_html__( 'Set non grid content. Try using width style on divs', 'penci-framework' ),
			//'group'      => $group_nav,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Content position', 'penci-framework' ),
			'param_name'  => 'content_placement',
			'value'       => array(
				__( 'Default', 'penci-framework' ) => '',
				__( 'Top', 'penci-framework' )     => 'top',
				__( 'Middle', 'penci-framework' )  => 'middle',
				__( 'Bottom', 'penci-framework' )  => 'bottom',
			),
			'description' => __( 'Select content position within columns.', 'penci-framework' ),
		)
	),
	'js_view'                 => 'VcColumnView'
);