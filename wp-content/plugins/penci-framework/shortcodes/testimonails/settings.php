<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$shotcode_id = 'testimonails';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'    => esc_html__( 'Testimonials', 'penci-framework' ),
	'weight'  => 700,
	'params'  => array_merge(
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Design style', 'penci-framework' ),
				'param_name' => '_design_style',
				'std'        => 's1',
				'value'      => array(
					esc_html__( 'Style 1', 'penci-framework' ) => 's1',
					esc_html__( 'Style 2', 'penci-framework' ) => 's2'
				),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'limit_heading',
				'heading'          => esc_html__( 'Items to Show', 'penci-framework' ),
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'penci_only_number',
				'heading'          => esc_html__( 'On desktop', 'penci-framework' ),
				'param_name'       => 'limit_desk',
				'class'            => '',
				'value'            => 3,
				'min'              => 1,
				'max'              => 25,
				'step'             => 1,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'             => 'penci_only_number',
				'heading'          => esc_html__( 'On tab', 'penci-framework' ),
				'param_name'       => 'limit_tab',
				'class'            => '',
				'value'            => 2,
				'min'              => 1,
				'max'              => 25,
				'step'             => 1,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'             => 'penci_only_number',
				'heading'          => esc_html__( 'On mobile', 'penci-framework' ),
				'param_name'       => 'limit_mobile',
				'class'            => '',
				'value'            => 1,
				'min'              => 1,
				'max'              => 25,
				'step'             => 1,
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
				'type'       => 'penci_only_number',
				'heading'    => esc_html__( 'Slider Auto Time (at x seconds)', 'penci-framework' ),
				'param_name' => 'auto_time',
				'class'      => '',
				'value'      => 4000,
				'min'        => 1,
				'max'        => 100000,
				'step'       => 1,
			),
			array(
				'type'       => 'penci_only_number',
				'heading'    => esc_html__( 'Slider Speed (at x seconds)', 'penci-framework' ),
				'param_name' => 'speed',
				'class'      => '',
				'value'      => 800,
				'min'        => 1,
				'max'        => 100000,
				'step'       => 1,
			),
			array(
				'type'       => 'penci_only_number',
				'heading'    => esc_html__( 'Margin right on item ( px )', 'penci-framework' ),
				'param_name' => 'margin_right',
				'class'      => '',
				'value'      => '30',
				'min'        => 1,
				'max'        => 50,
				'step'       => 1,
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Disable navigation arrows', 'penci-framework' ),
				'param_name' => 'dis_arrows',
				'value'      => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable dots navigation', 'penci-framework' ),
				'param_name' => 'enable_dots',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable auto width', 'penci-framework' ),
				'param_name'  => 'autowidth',
				'description' => esc_html__( 'Set non grid content. Try using width style on divs', 'penci-framework' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Disable center with loop', 'penci-framework' ),
				'param_name'  => 'center_item',
			),
			array(
				'type'       => 'param_group',
				'heading'    => '',
				'param_name' => 'testiminails',
				'group'      => 'Testimonials',
				'value'      => urlencode( json_encode( array(
					array(
						'name'    => 'Testimonails 1',
						'desc'    => 'I am text block. Click edit button to change this text.',
						'company' => 'Company/Position',
						'link'    => '#'
					),
					array(
						'name'    => 'Testimonails 2',
						'desc'    => 'I am text block. Click edit button to change this text.',
						'company' => 'Company/Position',
						'link'    => '#'
					),
					array(
						'name'    => 'Testimonails 3',
						'desc'    => 'I am text block. Click edit button to change this text.',
						'company' => 'Company/Position',
						'link'    => '#'
					),
					array(
						'name'    => 'Testimonails 4',
						'desc'    => 'I am text block. Click edit button to change this text.',
						'company' => 'Company/Position',
						'link'    => '#'
					),
				) ) ),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Name', 'penci-framework' ),
						'param_name'  => 'name',
						'admin_label' => true,
						'description' => __( 'Insert the name of the person.', 'penci-framework' ),
					),
					array(
						'type'        => 'attach_image',
						'heading'     => __( 'Custom Avatar', 'penci-framework' ),
						'param_name'  => 'image',
						'value'       => '',
						'description' => __( 'Upload a custom avatar image. Recommended 70×70 pixels', 'penci-framework' ),
					),

					array(
						'type'        => 'textfield',
						'heading'     => __( 'Company/Position', 'penci-framework' ),
						'param_name'  => 'company',
						'description' => __( 'Insert the name of the company.', 'penci-framework' ),
					),
					array(
						'type'        => 'textarea',
						'heading'     => __( 'Description', 'penci-framework' ),
						'param_name'  => 'desc',
						'description' => __( 'Add the testimonial description..', 'penci-framework' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Link', 'penci-framework' ),
						'param_name'  => 'link',
						'description' => __( 'Add the url the company name will link to', 'penci-framework' ),
					)
				),
			),
			array(
				'type'             => 'textfield',
				'param_name'       => 'space_heading',
				'heading'          => esc_html__( 'Custom space', 'penci-framework' ),
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'bq_padding_tb',
				'heading'          => __( 'Blockquote padding top/bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'bq_padding_lr',
				'heading'          => __( 'Blockquote padding left/right', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'bq_mar_top',
				'heading'    => __( 'Blockquote margin top', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'bq_max_width',
				'heading'    => __( 'Blockquote max width', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'bq_mar_bottom',
				'heading'    => __( 'Blockquote margin bottom', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_bq_mar_b',
				'heading'    => __( 'Icon Blockquote margin bottom', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array('element' => '_design_style', 'value'   => array( 's1' ) ),
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'avatar_wh',
				'heading'          => __( 'Avatar width/height', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'avatar_mar_top',
				'heading'          => __( 'Avatar margin top', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'avatar_mar_bottom',
				'heading'          => __( 'Avatar margin bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'name_mar_bottom',
				'heading'          => __( 'Name margin bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'penci_number',
				'param_name'       => 'pos_mar_bottom',
				'heading'          => __( 'Company/Position margin bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Color
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Blockquote background color', 'penci-framework' ),
				'param_name'       => 'bq_bg_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Blockquote border top color', 'penci-framework' ),
				'param_name'       => 'bq_bo_top_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Blockquote icon color', 'penci-framework' ),
				'param_name'       => 'bg_icon_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array('element' => '_design_style', 'value'   => array( 's1' ) ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Blockquote text color', 'penci-framework' ),
				'param_name'       => 'bq_text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Name color', 'penci-framework' ),
				'param_name'       => 'name_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Company color', 'penci-framework' ),
				'param_name'       => 'company_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Color of dots', 'penci-framework' ),
				'param_name'       => 'dots_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Color of dots hover or active', 'penci-framework' ),
				'param_name'       => 'dots_active_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),

		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'blockquote',
				'title'        => esc_html__( 'Blockquote settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'name',
				'title'        => esc_html__( 'Name settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'company',
				'title'        => esc_html__( 'Company settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);