<?php
$group_color = 'Color';
$group_user_filter = 'User Filter';

// Shortcode settings
return array(
	'name'   => esc_html__( 'Authors Box 2', 'penci-framework' ),
	'weight' => 821,
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Columns', 'penci-framework' ),
				'param_name' => 'columns',
				'value'      => array(
					__( '1 Column', 'penci-framework' )  => 'column-1',
					__( '2 Columns', 'penci-framework' ) => 'columns-2',
					__( '3 Columns', 'penci-framework' ) => 'columns-3',
					__( '4 Columns', 'penci-framework' ) => 'columns-4',
				),
				'std'        => 'columns-3'
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Description', 'penci-framework' ),
				'param_name'       => 'hide_desc',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Contact Info', 'penci-framework' ),
				'param_name'       => 'hide_contact_info',
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Button View All Posts', 'penci-framework' ),
				'param_name'       => 'hide_posts_url',
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Custom Description Length:', 'penci-framework' ),
				'param_name' => 'post_desc_length',
				'std'        => 20,
				'dependency' => array( 'element' => 'hide_desc', 'is_empty' => true ),
			)
		),
		Penci_Framework_Shortcode_Params::color_params( '', false ),
		array(
			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'User roles', 'penci-framework' ),
				'param_name'  => 'roles',
				'settings'    => array(
					'multiple'       => true,
					'sortable'       => true,
					'min_length'     => 1,
					'no_hide'        => true,
					'groups'         => false,
					'unique_values'  => true,
					'display_inline' => true,
					'values'         => Penci_Framework_Helper::get_roles(),
				),
				'group'      => $group_user_filter,
				'description' => __( 'Filter by role, add one or more user roles, separate them with a comma.', 'penci-framework' ) . Penci_Framework_Helper::get_roles( true ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Number of Users', 'penci-framework' ),
				'param_name'  => 'number',
				'std'         => '10',
				'group'      => $group_user_filter,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Order', 'penci-framework' ),
				'param_name' => 'order',
				'value'      => array(
					__( 'Latest First - Descending', 'penci-framework' )  => 'DESC',
					__( 'Oldest First - Ascending', 'penci-framework' ) => 'ASC',
				),
				'std'        => 'ASC',
				'group'      => $group_user_filter,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Order By', 'penci-framework' ),
				'param_name' => 'order_by',
				'value'      => array(
					__( 'User registered', 'penci-framework' ) => 'user_registered',
					__( 'User nicename', 'penci-framework' )   => 'user_nicename',
					__( 'Display name', 'penci-framework' )    => 'display_name',
					__( 'User login', 'penci-framework' )      => 'user_login',
					__( 'User email', 'penci-framework' )      => 'user_email',
					__( 'Post count', 'penci-framework' )      => 'post_count',
					__( 'User url', 'penci-framework' )        => 'user_url',
					__( 'ID', 'penci-framework' )              => 'ID',
				),
				'std'        => 'DESC',
				'group'      => $group_user_filter,
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Offset', 'penci-framework' ),
				'param_name'  => 'offset',
				'std'         => '',
				'description' => __( 'Start the count with an offset.', 'penci-framework' ),
				'group'      => $group_user_filter,
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Include Users', 'penci-framework' ),
				'param_name'  => 'include',
				'std'         => '',
				'description' => __( 'List of users to include in the result . Separate the users IDs with ",". (ex: 2,88, 35 )', 'penci-framework' ),
				'group'      => $group_user_filter,
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Exclude Users', 'penci-framework' ),
				'param_name'  => 'exclude',
				'std'         => '',
				'description' => __( 'List of users to exclude in the result .S eparate the users IDs with ",".  (ex: 2,88, 35 )', 'penci-framework' ),
				'group'      => $group_user_filter,
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
	),
	'js_view' => 'VcPenciShortcodeView',
);