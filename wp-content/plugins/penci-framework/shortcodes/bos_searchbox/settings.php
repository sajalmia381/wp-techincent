<?php
// Shortcode settings
$group_color = 'Color';
$group_space = 'Spacing';

return array(
	'name'   => esc_html__( 'Booking Official', 'penci-framework' ),
	'weight' => 810,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_extra_settings',
				'heading'          => esc_html__( 'Booking settings', 'penci-framework' ),
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Posttion', 'penci-framework' ),
				'param_name' => 'booking_pos',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )   => 'left',
					esc_html__( 'Center', 'penci-framework' ) => 'center',
					esc_html__( 'Right', 'penci-framework' )  => 'right',
				),
				'std'        => 'left',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Hide Text "Search hotels and more..."', 'penci-framework' ),
				'param_name' => 'hide_dftitle',
				'value'      => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Hide logo booking.com', 'penci-framework' ),
				'param_name' => 'hide_logo'
			),
			array(
				'type'             => 'penci_number',
				'heading'          => esc_html__( 'Custom padding for form booking', 'penci-framework' ),
				'param_name'       => 'padding_booking',
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Penci_Framework_Shortcode_Params::color_params( $shotcode_id, false ),
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
				'prefix'       => 'default_title',
				'title'        => esc_html__( 'Default title booking settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '24px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'destination_text',
				'title'        => esc_html__( 'Destination text,Check-in text , Check-out text settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani600' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'submit_button',
				'title'        => esc_html__( 'Submit button settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		)
	)
);

