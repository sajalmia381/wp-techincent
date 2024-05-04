<?php
$shotcode_id = 'weather';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Weather', 'penci-framework' ),
	'params' => array_merge(
		array(
			array(
				'param_name'  => 'custom_markup_weather',
				'type'        => 'custom_markup',
				'description' => '<span style="color: red;font-weight: bold;">Note Important</span>: To use this element, you need to fill your Weather API Key via Customize > General Options > Weather API Key',
			)
		),
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Search your for location:', 'penci-framework' ),
				'param_name'  => 'location',
				'std'         => 'London',
				'admin_label' => true,
				'description' => sprintf( '%s - You can use "city name" (ex: London) or "city name,country code" (ex: London,uk)',
					'<a href="' . esc_url( 'http://openweathermap.org/find' ) . '">' . esc_html__( 'Find your location', 'pennews' ) . '</a>' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Location display', 'penci-framework' ),
				'param_name'  => 'location_show',
				'description' => esc_html__( 'If the option is empty,will display results from ', 'pennews' ) . '<a href="' . esc_url( 'http://openweathermap.org/find' ) . '">openweathermap.org</a>',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Units', 'penci-framework' ),
				'param_name' => 'units',
				'value'      => array(
					esc_html__( 'F', 'penci-framework' ) => 'imperial',
					esc_html__( 'C', 'penci-framework' ) => 'metric',
				),
				'std'        => 'metric',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Forcast', 'penci-framework' ),
				'param_name' => 'forcast',
				'value'      => array(
					esc_html__( '1 Day', 'penci-framework' )  => '1',
					esc_html__( '2 Days', 'penci-framework' ) => '2',
					esc_html__( '3 Days', 'penci-framework' ) => '3',
					esc_html__( '4 Days', 'penci-framework' ) => '4',
					esc_html__( '5 Days', 'penci-framework' ) => '5',
				),
				'std'        => '5',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id, false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_weather_css',
				'heading'          => esc_html__( 'Weather colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'General color', 'penci-framework' ),
				'param_name'       => 'w_genneral_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Localtion color', 'penci-framework' ),
				'param_name'       => 'w_localtion_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border color', 'penci-framework' ),
				'param_name'       => 'w_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Degrees color', 'penci-framework' ),
				'param_name'       => 'w_degrees_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Custom color for forecast weather in next days', 'penci-framework' ),
				'param_name'       => 'w_forecast_text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Custom background for forecast weather in next days', 'penci-framework' ),
				'param_name'       => 'w_forecast_bg_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Block title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
				'font-size'    => '18px',
			)
		)
	)
);