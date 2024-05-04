<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$shotcode_id = 'fancy_heading';
$group_icon  = 'Icon';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'    => esc_html__( 'Progress Bar', 'penci-framework' ),
	'weight'  => 700,
	'params'  => array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Block title', 'penci-framework' ),
				'param_name' => 'title',
			),array(
				'type' => 'textarea',
				'heading' => __( 'Description', 'penci-framework' ),
				'param_name' => 'description',
			),
			array(
				'type' => 'param_group',
				'heading' => __( 'Values', 'penci-framework' ),
				'param_name' => 'values',
				'description' => __( 'Enter values for graph - value, title and color.', 'penci-framework' ),
				'value' => urlencode( json_encode( array(
					array(
						'label' => __( 'Development', 'penci-framework' ),
						'value' => '90',
					),
					array(
						'label' => __( 'Design', 'penci-framework' ),
						'value' => '80',
					),
					array(
						'label' => __( 'Marketing', 'penci-framework' ),
						'value' => '70',
					),
				) ) ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Label', 'penci-framework' ),
						'param_name' => 'label',
						'description' => __( 'Enter text used as title of bar.', 'penci-framework' ),
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Value', 'penci-framework' ),
						'param_name' => 'value',
						'description' => __( 'Enter value of bar.', 'penci-framework' ),
						'admin_label' => true,
					),
					array(
						'type' => 'colorpicker',
						'heading' => __( 'Custom background color', 'penci-framework' ),
						'param_name' => 'bgcolor',
						'description' => __( 'Select custom single bar background color.', 'penci-framework' )
					),
					array(
						'type' => 'colorpicker',
						'heading' => __( 'Custom text color', 'penci-framework' ),
						'param_name' => 'textcolor',
						'description' => __( 'Select custom single bar text color.', 'penci-framework' ),
						'dependency' => array(
							'element' => 'color',
							'value' => array( 'custom' ),
						),
					),
				),
			),
			array(
				'type'             => 'penci_number',
				'heading'          => esc_html__( 'Block title margin bottom', 'penci-framework' ),
				'param_name'       => 'block_title_mar_bottom',
				'value'            => '',
				'min'              => 1,
				'max'              => 100,
				'suffix'           => 'px',
			),
			array(
				'type'             => 'penci_number',
				'heading'          => esc_html__( 'Block title padding bottom', 'penci-framework' ),
				'param_name'       => 'block_title_pad_bottom',
				'value'            => '',
				'min'              => 1,
				'max'              => 100,
				'suffix'           => 'px',
			),
			array(
				'type'             => 'penci_number',
				'heading'          => esc_html__( 'Custom width for line below the block title', 'penci-framework' ),
				'param_name'       => 'line_width',
				'value'            => '',
				'min'              => 1,
				'max'              => 100,
				'suffix'           => 'px',
			),
			array(
				'type'             => 'penci_number',
				'heading'          => esc_html__( 'Description bottom', 'penci-framework' ),
				'param_name'       => 'desc_mar_bottom',
				'value'            => '',
				'min'              => 1,
				'max'              => 100,
				'suffix'           => 'px',
			),
			array(
				'type'             => 'penci_only_number',
				'heading'          => esc_html__( 'Custom height for bar', 'penci-framework' ),
				'param_name'       => 'bar_height',
				'value'            => '',
				'min'              => 1,
				'max'              => 100,
				'suffix'           => 'px',
			),
			array(
				'type'             => 'penci_number',
				'heading'          => esc_html__( 'Custom margin top for bar', 'penci-framework' ),
				'param_name'       => 'bar_mar_top',
				'value'            => '',
				'min'              => 1,
				'max'              => 100,
				'suffix'           => 'px',
			),
			array(
				'type'             => 'penci_number',
				'heading'          => esc_html__( 'Custom margin bottom for bar', 'penci-framework' ),
				'param_name'       => 'bar_mar_bottom',
				'value'            => '',
				'min'              => 1,
				'max'              => 100,
				'suffix'           => 'px',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Units', 'penci-framework' ),
				'param_name' => 'units',
				'description' => __( 'Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'penci-framework' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Options', 'penci-framework' ),
				'param_name' => 'options',
				'value' => array(
					__( 'Add stripes', 'penci-framework' ) => 'striped',
					__( 'Add animation (Note: visible only with striped bar).', 'penci-framework' ) => 'animated',
				),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Block Title color', 'penci-framework' ),
				'param_name'       => 'title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Line below title color', 'penci-framework' ),
				'param_name'       => 'line_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Description color', 'penci-framework' ),
				'param_name'       => 'desc_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Bar custom text color', 'penci-framework' ),
				'param_name' => 'bar_textcolor',
				'description' => __( 'Select custom text color for bars.', 'penci-framework' ),
				'group'      => $group_color,
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Bar process run custom background color', 'penci-framework' ),
				'param_name' => 'bar_run_bgcolor',
				'description' => __( 'Select custom background color for bars.', 'penci-framework' ),
				'group'      => $group_color,
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Bar custom background color', 'penci-framework' ),
				'param_name' => 'bar_bgcolor',
				'description' => __( 'Select custom background color for bars.', 'penci-framework' ),
				'group'      => $group_color,
			),

		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'title',
				'title'        => esc_html__( 'Title settings', 'penci-framework' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '30px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'desc',
				'title'        => esc_html__( 'Description settings', 'penci-framework' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'bar',
				'title'        => esc_html__( 'Bar text settings', 'penci-framework' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);