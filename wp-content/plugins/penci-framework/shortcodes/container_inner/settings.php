<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


return array(
	'name'                    => __( 'Container', 'penci-framework' ),
	'weight'                  => 1000,
	'is_container'            => true,
	'show_settings_on_create' => false,
	'as_child'                => array( 'only' => 'penci_column' ),
	'params'                  => array(
		array(
			'type'       => 'hidden',
			'param_name' => 'el_width',
			'std'        => 'penci-container',
			'value'        => 'penci-container',
		),
		array(
			'type'       => 'hidden',
			'param_name' => 'container_layout',
		),
		array(
			'type'        => 'checkbox',
			'heading'     => __( 'Disable sticky content & sidebar.', 'penci-framework' ),
			'param_name'  => 'el_disable_sticky',
			'value'       => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
		),
		array(
			'type'        => 'el_id',
			'heading'     => __( 'Row ID', 'penci-framework' ),
			'param_name'  => 'el_id',
			'description' => sprintf( __( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'penci-framework' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . __( 'link', 'penci-framework' ) . '</a>' ),
		),
	),
	'js_view'                 => 'VcPenciContainerView',
	'default_content'         => '
	[penci_column_inner width="1/3"][/penci_column_inner]
	[penci_column_inner width="2/3"][/penci_column_inner]
	',
);

