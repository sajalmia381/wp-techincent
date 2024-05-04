<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$group_trans = 'Strings Translation';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'        => esc_html__( 'Count Down', 'penci-framework' ),
	'description' => esc_html__( 'Count down time to event format', 'penci-framework' ),
	'params'      => array_merge(
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'penci-framework' ),
				'param_name' => 'count_down_style',
				'value'      => array(
					esc_html__( 'Digit and Unit Up and Down', 'penci-framework' )  => 'style-1',
					esc_html__( 'Digit and Unit Side by Side', 'penci-framework' ) => 'style-2',
				),
				'std'        => 'style-1',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Posttion', 'penci-framework' ),
				'param_name' => 'count_down_posttion',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )   => 'style-left',
					esc_html__( 'Center', 'penci-framework' ) => 'style-center',
					esc_html__( 'Right', 'penci-framework' )  => 'style-right',
				),
				'std'        => 'style-center',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Year', 'penci-framework' ),
				'param_name'       => 'count_year',
				'admin_label'      => true,
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Month', 'penci-framework' ),
				'param_name'       => 'count_month',
				'admin_label'      => true,
				'edit_field_class' => 'vc_col-sm-2',

			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Day', 'penci-framework' ),
				'param_name'       => 'count_day',
				'admin_label'      => true,
				'edit_field_class' => 'vc_col-sm-2',

			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Hour', 'penci-framework' ),
				'param_name'       => 'count_hour',
				'admin_label'      => true,
				'edit_field_class' => 'vc_col-sm-2',

			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Minus', 'penci-framework' ),
				'param_name'       => 'count_minus',
				'admin_label'      => true,
				'edit_field_class' => 'vc_col-sm-2',

			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Sec', 'penci-framework' ),
				'param_name'       => 'count_sec',
				'admin_label'      => true,
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				"type"       => "checkbox",
				"class"      => "",
				"heading"    => esc_html__( "Select time units to display in countdown timer", "penci-framework" ),
				"param_name" => "countdown_opts",
				"value"      => array(
					esc_html__( "Years", "penci-framework" )   => "Y",
					esc_html__( "Months", "penci-framework" )  => "O",
					esc_html__( "Weeks", "penci-framework" )   => "W",
					esc_html__( "Days", "penci-framework" )    => "D",
					esc_html__( "Hours", "penci-framework" )   => "H",
					esc_html__( "Minutes", "penci-framework" ) => "M",
					esc_html__( "Seconds", "penci-framework" ) => "S",
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Timer digit border style', 'penci-framework' ),
				'param_name' => 'digit_border',
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
				'param_name' => 'digit_border_width',
				'heading'    => __( 'Timer digit border width', 'penci-framework' ),
				'value'      => '',
				'std'        => '1px',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => 'digit_border', 'value' => array( 'solid', 'dashed', 'dotted', 'double' ) ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'digit_border_radius',
				'heading'    => __( 'Timer digit border radius', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'dependency' => array( 'element' => 'digit_border', 'value' => array( 'solid', 'dashed', 'dotted', 'double' ) ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'digit_padding',
				'heading'    => __( 'Timer digit padding', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'unit_margin_top',
				'heading'    => __( 'Timer unit margin top', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Turn on uppearcase for label count down?', 'penci-framework' ),
				'param_name' => 'cdtitle_upper'
			),
			// Transition
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Day (Singular)', 'penci-framework' ),
				'param_name' => 'str_days',
				'value'      => esc_html__( 'Day', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Days (Plural)', 'penci-framework' ),
				'param_name' => 'str_days2',
				'value'      => esc_html__( 'Days', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Week (Singular)', 'penci-framework' ),
				'param_name' => 'str_weeks',
				'value'      => esc_html__( 'Week', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Weeks (Plural)', 'penci-framework' ),
				'param_name' => 'str_weeks2',
				'value'      => esc_html__( 'Weeks', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Month (Singular)', 'penci-framework' ),
				'param_name' => 'str_months',
				'value'      => esc_html__( 'Month', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Months (Plural)', 'penci-framework' ),
				'param_name' => 'str_months2',
				'value'      => esc_html__( 'Months', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Year (Singular)', 'penci-framework' ),
				'param_name' => 'str_years',
				'value'      => esc_html__( 'Year', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Years (Plural)', 'penci-framework' ),
				'param_name' => 'str_years2',
				'value'      => esc_html__( 'Years', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Hour (Singular)', 'penci-framework' ),
				'param_name' => 'str_hours',
				'value'      => esc_html__( 'Hour', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Hours (Plural)', 'penci-framework' ),
				'param_name' => 'str_hours2',
				'value'      => esc_html__( 'Hours', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Minute (Singular)', 'penci-framework' ),
				'param_name' => 'str_minutes',
				'value'      => esc_html__( 'Minute', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Minutes (Plural)', 'penci-framework' ),
				'param_name' => 'str_minutes2',
				'value'      => esc_html__( 'Minutes', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Second (Singular)', 'penci-framework' ),
				'param_name' => 'str_seconds',
				'value'      => esc_html__( 'Second', 'penci-framework' ),
				'group'      => $group_trans
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Seconds (Plural)', 'penci-framework' ),
				'param_name' => 'str_seconds2',
				'value'      => esc_html__( 'Seconds', 'penci-framework' ),
				'group'      => $group_trans
			),

			// Color
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Timer digit color', 'penci-framework' ),
				'param_name'       => 'time_digit_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Timer digit border color', 'penci-framework' ),
				'param_name'       => 'time_digit_bordercolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Timer digit background color', 'penci-framework' ),
				'param_name'       => 'time_digit_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Timer unit color', 'penci-framework' ),
				'param_name'       => 'unit_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		),
		// Typo
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'time_digit',
				'title'        => esc_html__( 'Timer digit settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '90px',
			)
		),
		array(
			array(
				'type'             => 'penci_number',
				'param_name'       => 'time_digit_fsize_mobile',
				'heading'          => esc_html__( 'Font size for mobile', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => 'Typo',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'time_unit',
				'title'        => esc_html__( 'Timer unit settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '24px',
			)
		),
		array(
			array(
				'type'             => 'penci_number',
				'param_name'       => 'time_unit_fsize_mobile',
				'heading'          => esc_html__( 'Font size for mobile', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
				'group'            => 'Typo',
			)
		)
	)
);