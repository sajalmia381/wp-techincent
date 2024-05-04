<?php

$group_filter = 'Filter';
$group_color  = 'Color';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Pinterest', 'penci-framework' ),
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title( ),
		array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Enter the <strong style="color: #ff0000;">username/board_name</strong> for load images:', 'penci-framework' ),
				'param_name'  => 'username',
				'admin_label' => true,
				'description' => 'Example if you want to load a board has url <strong style="color: #ff0000;"><a href="https://www.pinterest.com/thefirstmess/animals-cuteness" target="_blank">https://www.pinterest.com/thefirstmess/animals-cuteness</a></strong> You need to fill <strong style="color: #ff0000;">thefirstmess/animals-cuteness</strong>',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Numbers image to show:', 'penci-framework' ),
				'param_name'  => 'numbers',
				'std' => 9
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Cache life time ( unit is seconds ):', 'penci-framework' ),
				'param_name'  => 'cache',
				'std'         => 1200
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Display more link with username text?', 'penci-framework' ),
				'param_name' => 'follow',
				'std'        => true
			)
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
		Penci_Framework_Shortcode_Params::block_option_block_title(  ),
		Penci_Framework_Shortcode_Params::color_params( 'penci_widget_archive', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_pinterest_css',
				'heading'          => esc_html__( 'Pinterest colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Link color', 'penci-framework' ),
				'param_name'       => 'pin_link_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Username hover color', 'penci-framework' ),
				'param_name'       => 'pin_link_hcolor',
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
		)
	)
);