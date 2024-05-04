<?php

$group_filter = 'Filter';
$group_color  = 'Color';

$tag_taxonomies = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
	$taxonomies = get_taxonomies();
	if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
		foreach ( $taxonomies as $taxonomy ) {
			$tax = get_taxonomy( $taxonomy );
			if ( ( is_object( $tax ) && ( ! $tax->show_tagcloud || empty( $tax->labels->name ) ) ) || ! is_object( $tax ) ) {
				continue;
			}
			$tag_taxonomies[ $tax->labels->name ] = esc_attr( $taxonomy );
		}
	}
}

// Shortcode settings
return array(
	'category'      => esc_html__( 'PenNews WP Widget', 'penci-framework' ),
	'name'   => 'WP ' . __( 'Tag Cloud' ),
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title( array( 'block_title_default' => __( 'Tags' ) ) ),
		array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Taxonomy', 'penci-framework' ),
				'param_name' => 'taxonomy',
				'value' => $tag_taxonomies,
				'description' => __( 'Select source for tag cloud.', 'penci-framework' ),
				'admin_label' => true,
				'save_always' => true,
			)
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings','hide_enable_stiky' ) ),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::color_params( 'penci_widget_tagcould', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_css',
				'heading'          => esc_html__( 'Tags colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Tag color', 'penci-framework' ),
				'param_name'       => 'tag_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Tag Background color', 'penci-framework' ),
				'param_name'       => 'tag_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Tag border color', 'penci-framework' ),
				'param_name'       => 'tag_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Tag hover color', 'penci-framework' ),
				'param_name'       => 'tag_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Tag hover background and border color', 'penci-framework' ),
				'param_name'       => 'tag_hbgcolor',
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
				'prefix'       => 'tag',
				'title'        => esc_html__( 'Tag settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '10px',
			)
		)
	)
);