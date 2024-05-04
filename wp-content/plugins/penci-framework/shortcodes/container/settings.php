<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name'                    => __( 'Container', 'penci-framework' ),
	'weight'                  => 1000,
	'is_container'            => true,
	'show_settings_on_create' => false,
	'params'                  => array(
		array(
			'type'       => 'hidden',
			'param_name' => 'container_layout',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Choose with container', 'penci-framework' ),
			'param_name' => 'el_width',
			'value'      => array(
				esc_html__( 'Container ( width: 1080px ) ', 'penci-framework' )       => 'penci-container',
				esc_html__( 'Container normal ( width: 1170px ) ', 'penci-framework' ) => 'penci-container-1170',
				esc_html__( 'Container fluid ( width: 1400px ) ', 'penci-framework' ) => 'penci-container-fluid',
			),
			'std'        => 'penci-container-fluid',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Custom position of content and sidebar on mobile', 'penci-framework' ),
			'param_name' => 'ctsidebar_mb',
			'value'      => array(
			     esc_html__( 'Content + Sidebar left + Sidebar right', 'pennews' ) => 'con_sb2_sb1',
			     esc_html__( 'Content + Sidebar right + Sidebar left', 'pennews' ) => 'con_sb1_sb2',
			     esc_html__( 'Sidebar left + Content + Sidebar right', 'pennews' ) => 'sb2_con_sb1',
			     esc_html__( 'Sidebar left + Sidebar right + Content', 'pennews' ) => 'sb2_sb1_con',
			     esc_html__( 'Sidebar right + Content + Sidebar left', 'pennews' ) => 'sb1_con_sb2',
			     esc_html__( 'Sidebar right + Sidebar left + Content', 'pennews' ) => 'sb1_sb2_con',
			),
			'std'        => '',
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Disable sticky content & sidebar.', 'penci-framework' ),
			'param_name' => 'el_disable_sticky',
			'value'      => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
		),
		array(
			'type'        => 'el_id',
			'heading'     => __( 'Container ID', 'penci-framework' ),
			'param_name'  => 'el_id',
			'description' => sprintf( __( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'penci-framework' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . __( 'link', 'penci-framework' ) . '</a>' ),
		),
	),
	'js_view'                 => 'VcPenciContainerView',
	'default_content'         => '[penci_column width="11"][/penci_column]',
);

