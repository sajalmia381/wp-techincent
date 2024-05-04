<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @var $tag - shortcode tag;
 */
return array(
	'name'                      => __( 'Column', 'penci-framework' ),
	'class'                   => 'vc_main-sortable-element',
	'wrapper_class'             => '',
	'controls'                  => 'full',
	'allowed_container_element' => false,
	'content_element'           => false,
	'is_container'              => true,
	'params'                    => array(
		array(
			'type'       => 'hidden',
			'param_name' => 'width',
		),
		array(
			'type'       => 'hidden',
			'param_name' => 'class_layout',
		),
		array(
			'type'       => 'hidden',
			'param_name' => 'order',
		),
	),
	'js_view'                   => 'VcColumnView',
);
