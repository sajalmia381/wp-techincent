<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function penci_portfolio_meta_boxes( $meta_boxes ) {
	$prefix = 'penci_';

	$meta_boxes[] = array(
		'title'      => 'Portfolio Parameters and Options',
		'post_types' => array( 'portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'tabs'       => array(
			'general'      => array( 'label' => 'General', 'icon' => 'dashicons dashicons-admin-settings' ),
			'desc'         => array( 'label' => 'Description', 'icon' => 'dashicons dashicons-format-aside' ),
			'info'         => array( 'label' => 'Information', 'icon' => 'dashicons dashicons-info' )
		),
		'fields'     => array(
			array(
				'id'   => $prefix . 'pfl_use_opt_current_page',
				'name' => esc_html__( 'Use the options of the current page:', 'penci-framework' ),
				'type' => 'checkbox',
				'std'  => '',
				'tab'  => 'general',
			),
			// General Details
			array(
				'name'    => esc_html__( 'Sidebar position:', 'penci-framework' ),
				'id'      => $prefix . 'pfl_sidebar_pos',
				'type'    => 'image_select',
				'options' => array(
					'no-sidebar-wide' => get_template_directory_uri() . '/images/layout/wide-content.png',
					'no-sidebar-1080' => get_template_directory_uri() . '/images/layout/wide-content-1080.png',
					'no-sidebar'      => get_template_directory_uri() . '/images/layout/no-sidebar.png',
					'sidebar-left'    => get_template_directory_uri() . '/images/layout/sidebar-left.png',
					'sidebar-right'   => get_template_directory_uri() . '/images/layout/sidebar-right.png',
					'two-sidebar'     => get_template_directory_uri() . '/images/layout/3cm.png',
				),
				'std'     => 'no-sidebar-1080',
				'tab'     => 'general',
			),
			array(
				'name'     => esc_html__( 'Page Title Align', 'pennews' ),
				'id'       => $prefix . "pfl_align_post_title",
				'type'     => 'select',
				'options'  => array(
					'left'   => esc_html__( 'Left', 'pennews' ),
					'center' => esc_html__( 'Center', 'pennews' ),
					'right'  => esc_html__( 'Right', 'pennews' )
				),
				'multiple' => false,
				'std'      => 'left',
				'tab'      => 'general',
			),
			array(
				'name' => esc_html__( 'Custom Font Size for Portfolio Title ', 'pennews' ),
				'id'   => $prefix . 'pfl_size_post_title',
				'type' => 'text',
				'std'  => function_exists( 'penci_page_size_post_title' ) ? penci_default_setting( 'penci_page_size_post_title' ) : '',
				'size' => 10,
				'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
				'tab'  => 'general',
			),
			array(
				'id'   => $prefix . 'pfl_hide_text_share',
				'name' => esc_html__( 'Hide Text "Share"', 'penci-framework' ),
				'type' => 'checkbox',
				'std'  => '',
				'tab'  => 'general',
			),
			array(
				'id'   => $prefix . 'pfl_desc',
				'name' => '',
				'type' => 'wysiwyg',
				'tab'  => 'desc',
			),
			array(
				'id'         => $prefix . 'pfl_info',
				'type'       => 'group',
				'clone'      => true,
				'tab'        => 'info',
				'sort_clone' => true,
				'fields'     => array(
					array(
						'name' => esc_html__( 'Detail label', 'penci-framework' ),
						'id'   => 'label',
						'type' => 'text',
						'size' => 100,
					),
					array(
						'name' => esc_html__( 'Detail value', 'penci-framework' ),
						'id'   => 'value',
						'type' => 'text',
						'size' => 100,
					),
				),
			)
		),
	);


	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'penci_portfolio_meta_boxes' );