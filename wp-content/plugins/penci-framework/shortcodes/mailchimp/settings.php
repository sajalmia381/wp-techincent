<?php
// Shortcode settings
$group_color  = 'Color';
$group_space = 'Spacing';

return array(
	'name'   => esc_html__( 'Mailchimp', 'penci-framework' ),
	'weight' => 810,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Choose Style your sign-up form', 'penci-framework' ),
				'param_name' => 'mailchimp_style',
				'std'        => 'mailchimp_style-1',
				'value'      => array(
					esc_html__( 'Style 1', 'penci-framework' ) => 'mailchimp_style-1',
					esc_html__( 'Style 2', 'penci-framework' ) => 'mailchimp_style-2',
					esc_html__( 'Style 3', 'penci-framework' ) => 'mailchimp_style-3',
					esc_html__( 'Style 4', 'penci-framework' ) => 'mailchimp_style-4',
					esc_html__( 'Style 5', 'penci-framework' ) => 'mailchimp_style-5',
				),
				'description' => sprintf( __( 'You can edit your sign-up form in the <a href="%s">MailChimp for WordPress form settings</a>.', 'penci-framework' ), admin_url( 'admin.php?page=mailchimp-for-wp-forms' ) ),
			)
		),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
		array(
			array(
				'type'             => 'penci_number',
				'param_name'       => 'mc4wp_des_width',
				'heading'          => esc_html__( 'Description width', 'penci-framework' ),
				'value'            => '',
				'suffix'           => 'px',
				'min'              => 1,
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'mc4wp_des_martop',
				'heading'          => esc_html__( 'Margin top', 'penci-framework' ),
				'value'            => '',
				'suffix'           => 'px',
				'min'              => 1,
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'mc4wp_des_marbottom',
				'heading'          => esc_html__( 'Margin bottom', 'penci-framework' ),
				'value'            => '',
				'suffix'           => 'px',
				'min'              => 1,
			),
			

		),
		Penci_Framework_Shortcode_Params::color_params( 'mailchimp', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_genral_css',
				'heading'          => esc_html__( ' Sign-up form colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Description color', 'penci-framework' ),
				'param_name'       => 'mc4wp_des_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Input name & email background color', 'penci-framework' ),
				'param_name'       => 'mc4wp_bg_input_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( ' Input name & email border color', 'penci-framework' ),
				'param_name'       => 'mc4wp_border_input_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Input name & email text color', 'penci-framework' ),
				'param_name'       => 'mc4wp_text_input',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Placeholder input name & email color', 'penci-framework' ),
				'param_name'       => 'mc4wp_placeh_input',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button submit text color', 'penci-framework' ),
				'param_name'       => 'mc4wp_submit_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button submit background color', 'penci-framework' ),
				'param_name'       => 'mc4wp_submit_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button submit border color', 'penci-framework' ),
				'param_name'       => 'mc4wp_submit_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button submit hover text color', 'penci-framework' ),
				'param_name'       => 'mc4wp_submit_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button submit hover background color', 'penci-framework' ),
				'param_name'       => 'mc4wp_submit_hbgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button submit hover border color', 'penci-framework' ),
				'param_name'       => 'mc4wp_submit_hborder_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
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
				'prefix'       => 'mc4wp_des',
				'title'        => esc_html__( 'Description settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'mc4wp_input',
				'title'        => esc_html__( 'Input settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		),Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'mc4wp_submit',
				'title'        => esc_html__( 'Button submit settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		)
	)
);

