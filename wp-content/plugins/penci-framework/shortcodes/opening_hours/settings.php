<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$group_color = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Openings Hours / Menu', 'penci-framework' ),
	'params' => array_merge(
		array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Title:', 'penci-framework' ),
				'param_name' => 'title',
			),
			array(
				'type'       => 'textarea',
				'heading'    => esc_html__( 'Subtitle:', 'penci-framework' ),
				'param_name' => 'subtitle',
			),
			array(
				'type'       => 'param_group',
				'heading'    => 'Content',
				'param_name' => 'working_hours',
				'value'      => urlencode( json_encode( array(
					array(
						'icon'  => 'fa fa-clock-o',
						'title' => 'Monday',
						'hours' => '8:00 AM - 9:00 PM'
					),
					array(
						'icon'  => 'fa fa-clock-o',
						'title' => 'Tuesday',
						'hours' => '8:00 AM - 9:00 PM'
					),
					array(
						'icon'  => 'fa fa-clock-o',
						'title' => 'Wednessday',
						'hours' => '8:00 AM - 9:00 PM'
					)
				) ) ),
				'params'     => array(
					array(
						'type'       => 'iconpicker',
						'heading'    => __( 'Icon', 'penci-framework' ),
						'param_name' => 'icon',
						'value'      => '',
						'settings'   => array(
							'emptyIcon'    => true,
							'iconsPerPage' => 4000,
						)
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Title', 'penci-framework' ),
						'param_name'  => 'title',
						'admin_label' => true
					),
					array(
						'type'       => 'textfield',
						'heading'    => __( 'Subtitle', 'penci-framework' ),
						'param_name' => 'subtitle'
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Hours or Price', 'penci-framework' ),
						'param_name'  => 'hours',
						'admin_label' => true
					)
				)
			),
			array(
				'type'        => 'attach_image',
				'heading'     => __( 'Image', 'penci-framework' ),
				'param_name'  => 'image',
				'value'       => '',
				'description' => __( 'Select image from media library.', 'penci-framework' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Image url:', 'penci-framework' ),
				'param_name' => 'url_img',
			),
			array(
				'type'             => 'penci_only_number',
				'heading'          => esc_html__( 'Image width', 'penci-framework' ),
				'param_name'       => 'image_width',
				'value'            => 50,
				'min'              => 1,
				'max'              => 100,
				'suffix'           => '%',
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'             => 'penci_only_number',
				'heading'          => esc_html__( 'Image width/height radio', 'penci-framework' ),
				'param_name'       => 'image_wh_radio',
				'value'            => 67,
				'min'              => 1,
				'max'              => 100,
				'suffix'           => '%',
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'             => 'dropdown',
				'heading'          => __( 'Image position', 'penci-framework' ),
				'param_name'       => 'image_pos',
				'value'            => array(
					__( 'Right', 'penci-framework' ) => 'right',
					__( 'Left', 'penci-framework' )  => 'left'
				),
				'std'              => 'right',
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'             => 'dropdown',
				'heading'          => __( 'Columns', 'penci-framework' ),
				'param_name'       => 'columns',
				'value'            => array(
					__( '1 Column', 'penci-framework' )  => 'col1',
					__( '2 Columns', 'penci-framework' ) => 'col2',
					__( '3 Columns', 'penci-framework' ) => 'col3'
				),
				'std'              => 'col1',
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'             => 'dropdown',
				'heading'          => __( 'Content position', 'penci-framework' ),
				'param_name'       => 'content_placement',
				'value'            => array(
					__( 'Middle', 'penci-framework' ) => 'middle',
					__( 'Top', 'penci-framework' )    => 'top',
					__( 'Bottom', 'penci-framework' ) => 'bottom',
				),
				'std'              => 'middle',
				'description'      => __( 'Select content position within columns.', 'penci-framework' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'             => 'penci_only_number',
				'heading'          => esc_html__( 'Columns gap', 'penci-framework' ),
				'param_name'       => 'gap',
				'value'            => 0,
				'min'              => 0,
				'max'              => 100,
				'suffix'           => 'px',
				'edit_field_class' => 'vc_col-sm-4',
				'description'      => __( 'Select gap between columns in item menu.', 'penci-framework' ),
				'dependency'       => array( 'element' => 'columns', 'value' => array( 'col2', 'col3' ) ),
			),
			array(
				'type'       => 'penci_number',
				'param_name' => 'icon_fsize',
				'heading'    => __( 'Font size for Icon', 'penci-framework' ),
				'value'      => '',
				'std'        => '',
				'suffix'     => 'px',
				'min'        => 1,
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'title_margin_bottom',
				'heading'          => __( 'Title margin bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'subtitle_margin_bottom',
				'heading'          => __( 'Subtitle margin bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'menu_item_margin_b',
				'heading'          => __( 'Menu list item margin bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'menu_item_padding_b',
				'heading'          => __( 'Menu list item padding bottom', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'menu_item_sub_mar_t',
				'heading'          => __( 'Menu list item subtitle margin top', 'penci-framework' ),
				'value'            => '',
				'std'              => '',
				'suffix'           => 'px',
				'min'              => 1,
				'edit_field_class' => 'vc_col-sm-6',
			),

			// Color
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Title color', 'penci-framework' ),
				'param_name'       => 'title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Subtitle color', 'penci-framework' ),
				'param_name'       => 'subtitle_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Menu list item icon color', 'penci-framework' ),
				'param_name'       => 'icon_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Menu list item title color', 'penci-framework' ),
				'param_name'       => 'item_title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Menu list item subtitle color', 'penci-framework' ),
				'param_name'       => 'item_subtitle_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Menu list item hours or price color', 'penci-framework' ),
				'param_name'       => 'item_hours_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Menu list item hours or price background color', 'penci-framework' ),
				'param_name'       => 'item_hours_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'title',
				'title'        => esc_html__( 'Title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '42px'
			)
		), Penci_Framework_Shortcode_Params::block_option_typo(
		array(
			'prefix'       => 'subtitle',
			'title'        => esc_html__( 'Subtitle settings' ),
			'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
			'font-size'    => '14px'
		)
	),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'menu_title',
				'title'        => esc_html__( 'Menu list item title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '15px'
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'menu_subtitle',
				'title'        => esc_html__( 'Menu list item  subtitle settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px'
			)
		), Penci_Framework_Shortcode_Params::block_option_typo(
		array(
			'prefix'       => 'item_hours',
			'title'        => esc_html__( 'Menu list item hours or price settings' ),
			'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
			'font-size'    => '15px'
		)
	)
	)
);