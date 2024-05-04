<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$group_filter = 'Filter';
$group_color  = 'Color';

$custom_menus = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	if ( is_array( $menus ) && ! empty( $menus ) ) {
		foreach ( $menus as $single_menu ) {
			if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
				$custom_menus[ $single_menu->name ] = $single_menu->term_id;
			}
		}
	}
}

// Shortcode settings
return array(
	'category' => esc_html__( 'PenNews WP Widget', 'penci-framework' ),
	'name'     => 'WP ' . __( 'Custom Menu' ),
	'params'   => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
		array(
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Menu', 'penci-framework' ),
				'param_name'  => 'nav_menu',
				'value'       => $custom_menus,
				'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'penci-framework' ) : esc_html__( 'Select menu to display.', 'penci-framework' ),
				'admin_label' => true,
				'save_always' => true,
			)
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::color_params( 'penci_widget_custom_menu', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_css',
				'heading'          => esc_html__( 'Link colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Link color', 'penci-framework' ),
				'param_name' => 'link_color',
				'group'      => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Link hover color', 'penci-framework' ),
				'param_name' => 'link_hover_color',
				'group'      => $group_color,
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
				'prefix'       => 'link_cat',
				'title'        => esc_html__( 'Link settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		)
	)
);