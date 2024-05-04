<?php

$setting_gallery = array(
	array(
		'type'       => 'penci_image_select',
		'heading'    => esc_html__( 'Select style gallery display', 'penci-framework' ),
		'param_name' => 'style_gallery',
		'std'        => 'style-1',
		'options'    => array(
			'style-1' => PENCI_ADDONS_URL . 'assets/img/gallery/style-1.png',
			'style-2' => PENCI_ADDONS_URL . 'assets/img/gallery/style-2.png',
			'style-3' => PENCI_ADDONS_URL . 'assets/img/gallery/style-3.png',
			'style-4' => PENCI_ADDONS_URL . 'assets/img/gallery/style-4.png',
			'style-5' => PENCI_ADDONS_URL . 'assets/img/gallery/style-5.png',
			'style-6' => PENCI_ADDONS_URL . 'assets/img/gallery/style-6.png',
			'style-7' => PENCI_ADDONS_URL . 'assets/img/gallery/style-7.png',
			//'style-8' => PENCI_ADDONS_URL . 'assets/img/gallery/style-8.png',
			//'style-9' => PENCI_ADDONS_URL . 'assets/img/gallery/style-9.png',
		),
	),
	array(
		'type'        => 'attach_images',
		'heading'     => __( 'Images', 'penci-framework' ),
		'param_name'  => 'images',
		'value'       => '',
		'description' => __( 'Select images from media library.', 'penci-framework' ),
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
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Slider Auto Time (at x seconds)', 'penci-framework' ),
		'param_name'  => 'auto_time',
		'std'         => 4000,
		'admin_label' => true
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Slider Speed (at x seconds)', 'penci-framework' ),
		'param_name'  => 'speed',
		'std'         => 800,
		'admin_label' => true
	)

);

return array(
	'name'   => __( 'Image Gallery', 'penci-framework' ),
	'weight' => 818,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		$setting_gallery,
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id, false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_css',
				'heading'          => esc_html__( 'Caption colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),

			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Caption color', 'penci-framework' ),
				'param_name'       => 'post_title_color',
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
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Caption settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '20px',
			)
		)

	)
);