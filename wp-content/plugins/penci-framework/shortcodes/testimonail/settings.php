<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$shotcode_id = 'testimonails';
$group_color = 'Color';

// Shortcode settings
return array(
	'name'    => esc_html__( 'Testimonial', 'penci-framework' ),
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
					esc_html__( 'Style 2', 'penci-framework' ) => 's2',
					esc_html__( 'Style 3', 'penci-framework' ) => 's3'
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Columns', 'penci-framework' ),
				'param_name' => 'columns',
				'value'      => array(
					__( '1 Column', 'penci-framework' )  => 'column-1',
					__( '2 Columns', 'penci-framework' ) => 'columns-2',
					__( '3 Columns', 'penci-framework' ) => 'columns-3',
					__( '4 Columns', 'penci-framework' ) => 'columns-4',
				),
				'std'        => 'columns-2'
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
					)
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
						'type'       => 'dropdown',
						'heading'    => __( 'Rating', 'penci-framework' ),
						'param_name' => 'rating',
						'value'      => array(
							__( '1', 'penci-framework' ) => '1',
							__( '2', 'penci-framework' ) => '2',
							__( '3', 'penci-framework' ) => '3',
							__( '4', 'penci-framework' ) => '4',
							__( '5', 'penci-framework' ) => '5',
						),
						'std'        => '5',
						'dependency'       => array( 'element' => '_design_style', 'value' => array( 's3' ) ),
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
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'bq_max_width',
				'heading'    => __( 'Blockquote max width', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'bq_mar_bottom',
				'heading'    => __( 'Blockquote margin bottom', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_bq_mar_b',
				'heading'    => __( 'Icon Blockquote margin bottom', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
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
				'heading'          => esc_html__( 'Rating color', 'penci-framework' ),
				'param_name'       => 'rating_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'       => array( 'element' => '_design_style', 'value' => array( 's3' ) ),
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