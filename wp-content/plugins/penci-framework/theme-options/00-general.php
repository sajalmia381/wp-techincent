<?php
/**
 * General options.
 */
return array(
	'id'             => 'general',
	'title'          => esc_html__( 'General', 'edupro' ),
	'settings_pages' => 'theme-options',
	'tab'            => 'general',
	'tab_style'      => 'box',
	'tab_wrapper'    => true,
	'fields'         => array(
		array(
			'name' => esc_html__( 'Google Map API KEY', 'edupro' ),
			'id'   => 'map_api_key',
			'type' => 'text',
			'size' => 100,
		),
	
		array(
			'name' => esc_html__( 'Custom Size Of Fonts in Posts', 'edupro' ),
			'id'   => 'edupro_font_for_size_body',
			'type' => 'text',
			'std'  => '15',
			'size' => 10,
			'desc'     => esc_html__( 'Numeric value only, unit is pixel', 'edupro' ),
		),
	),
);

