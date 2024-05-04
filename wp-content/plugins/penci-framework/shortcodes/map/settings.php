<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Shortcode settings
return array(
	'name'   => __( 'Map', 'penci-framework' ),
	'weight' => 700,
	'params' => array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Insert Map Using', 'penci-framework' ),
			'param_name' => 'map_using',
			'value'      => array(
				esc_html__( 'Address', 'penci-framework' )     => 'address',
				esc_html__( 'Coordinates', 'penci-framework' ) => 'coordinates',
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Address', 'penci-framework' ),
			'param_name'  => 'address',
			'admin_label' => true,
			'dependency'  => array(
				'element' => 'map_using',
				'value'   => 'address'
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Latitude', 'penci-framework' ),
			'param_name'  => 'latitude',
			'admin_label' => true,
			'dependency'  => array(
				'element' => 'map_using',
				'value'   => 'coordinates'
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Longtitude', 'penci-framework' ),
			'param_name'  => 'longtitude',
			'admin_label' => true,
			'dependency'  => array(
				'element' => 'map_using',
				'value'   => 'coordinates'
			)
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Map type', 'penci-framework' ),
			'param_name' => 'map_type',
			'value'      => array(
				esc_html__( 'Road', 'penci-framework' )      => 'road',
				esc_html__( 'Satellite', 'penci-framework' ) => 'satellite',
				esc_html__( 'Hybrid', 'penci-framework' )    => 'hybrid',
				esc_html__( 'Terrain', 'penci-framework' )   => 'terrain',
				esc_html__( 'Custom', 'penci-framework' )    => 'custom',
			)
		),
		array(
			'type'             => 'penci_number',
			'heading'          => esc_html__( 'Width', 'penci-framework' ),
			'param_name'       => 'map_width',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'penci_number',
			'heading'          => esc_html__( 'Height', 'penci-framework' ),
			'param_name'       => 'map_height',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Marker Image', 'penci-framework' ),
			'param_name' => 'marker_img',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Marker Title', 'penci-framework' ),
			'param_name'  => 'marker_title',
			'admin_label' => true,
		),
		array(
			'type'        => 'exploded_textarea_safe',
			'heading'     => esc_html__( 'Info Window', 'penci-framework' ),
			'param_name'  => 'info_window',
			'description' => ''
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Zoom', 'penci-framework' ),
			'param_name'       => 'map_is_zoom',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Pan', 'penci-framework' ),
			'param_name'       => 'map_pan',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Map scale', 'penci-framework' ),
			'param_name'       => 'map_scale',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Street view', 'penci-framework' ),
			'param_name'       => 'map_street_view',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Rotate', 'penci-framework' ),
			'param_name'       => 'map_rotate',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_html__( 'Overview map', 'penci-framework' ),
			'param_name'       => 'map_overview',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Zoom', 'penci-framework' ),
			'param_name' => 'map_zoom',
			'value'      => array(
				6  => 6,
				7  => 7,
				8  => 8,
				9  => 9,
				10 => 10,
				11 => 11,
				12 => 12,
				13 => 13,
				14 => 14,
				15 => 15,
				16 => 16,
			),
			'std'        => '8',
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Scrollwheel', 'penci-framework' ),
			'param_name' => 'map_scrollwheel',
		),
	)
);