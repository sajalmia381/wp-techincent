<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @var $tag - shortcode tag;
 */
return array(
	'name'                      => __( 'Column Inner', 'penci-framework' ),
	'class'                     => '',
	'wrapper_class'             => '',
	'controls'                  => 'full',
	'allowed_container_element' => false,
	'content_element'           => false,
	'is_container'              => true,
	'as_child'                => array( 'only' => 'penci_container_inner' ),
	'params'                    => array(
		array(
			'type'       => 'hidden',
			'param_name' => 'width',
		),
		array(
			'type'       => 'hidden',
			'param_name' => 'class_layout',
		),
	),
	'js_view'                   => 'VcColumnView',
);
