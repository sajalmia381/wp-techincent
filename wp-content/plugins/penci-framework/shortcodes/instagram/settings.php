<?php
$group_color = 'Color';
$group_insta  = 'Instagram';

// Shortcode settings
return array(
	'name'    => esc_html__( 'Instagram', 'penci-framework' ),
	'weight'  => 828,
	'params'  => array_merge(
		Penci_Framework_Shortcode_Params::block_title(),
		Penci_Framework_Shortcode_Params::block_option_block_title( ),
		array(
			array(
				'heading'    => __( 'Username', 'penci-framework' ),
				'type'       => 'textfield',
				'param_name' => 'username',
				'group'      => $group_insta,
				'dependency' => array( 'element' => 'search_for', 'value' => array( 'username' ) ),
			),
			array(
				'heading'    => __( 'Instagram Access Token', 'penci-framework' ),
				'type'       => 'textfield',
				'param_name' => 'access_token',
				'group'      => $group_insta,
				'description' => 'Please fill the Instagram Access Token here. You can get Instagram Access Token via <a href="http://pencidesign.com/penci_instagram/" target="_blank">http://pencidesign.com/penci_instagram/</a>',
				'dependency' => array( 'element' => 'search_for', 'value' => array( 'username' ) ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Instagram User ID:', 'soledad' ),
				'param_name'  => 'insta_user_id',
				'group'      => $group_insta,
				'description' => 'Please enter the User ID for this Profile ( Eg: 123456789987654321 ). You can get User ID via <a href="http://pencidesign.com/penci_instagram/" target="_blank">http://pencidesign.com/penci_instagram/</a>',
				'dependency' => array( 'element' => 'search_for', 'value' => array( 'username' ) ),
			),
			array(
				'heading'    => __( 'Number of images to show:', 'penci-framework' ),
				'type'        => 'textfield',
				'param_name'  => 'images_number',
				'std'         => '9',
				'group'       => $group_insta,
				'description' => __( 'You can shows 12 latest images from a public Instagram user( maximum 12 )', 'penci-framework' ),
			),
			array(
				'heading'    => __( 'Check for new images every ( unix is hour(s) ):', 'penci-framework' ),
				'type'       => 'textfield',
				'param_name' => 'refresh_hour',
				'std'        => '5',
				'group'      => $group_insta,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Style', 'penci-framework' ),
				'param_name' => 'template',
				'value'      => array(
					__( 'Thumbnails', 'penci-framework' )                  => 'thumbs',
					__( 'Thumbnails - Without Border', 'penci-framework' ) => 'thumbs-no-border',
					__( 'Slider - Overlay Text', 'penci-framework' )       => 'slider',
				),
				'std'        => 'thumbs-no-border',
				'group'      => $group_insta,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Number of Columns:', 'penci-framework' ),
				'param_name' => 'columns',
				'value'      => array(
					__( '1', 'penci-framework' )  => '1',
					__( '2', 'penci-framework' )  => '2',
					__( '3', 'penci-framework' )  => '3',
					__( '4', 'penci-framework' )  => '4',
					__( '5', 'penci-framework' )  => '5',
					__( '6', 'penci-framework' )  => '6',
					__( '7', 'penci-framework' )  => '7',
					__( '8', 'penci-framework' )  => '8',
					__( '9', 'penci-framework' )  => '9',
					__( '10', 'penci-framework' ) => '10',
				),
				'std'        => '3',
				'group'      => $group_insta,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Image Type', 'penci-framework' ),
				'param_name' => 'image_type',
				'value'      => array(
					__( 'Square', 'penci-framework' )    => 'square',
					__( 'Vertical', 'penci-framework' )  => 'vertical',
					__( 'Landscape', 'penci-framework' ) => 'landscape',
				),
				'std'        => 'square',
				'group'      => $group_insta,
				'dependency' => array( 'element' => 'template', 'value' => array( 'thumbs', 'thumbs-no-border' ) ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Image Size', 'penci-framework' ),
				'param_name' => 'image_size',
				'value'      => array(
					__( '640 x 640', 'penci-framework' ) => '640',
					__( '480 x 480', 'penci-framework' ) => '480',
					__( '320 X 320', 'penci-framework' ) => '320',
					__( '240 X 240', 'penci-framework' ) => '240',
					__( '150 X 150', 'penci-framework' ) => '150',
				),
				'std'        => '480',
				'group'      => $group_insta
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'On click action', 'js_composer' ),
				'param_name' => 'onclick',
				'value' => array(
					__( 'None', 'js_composer' ) => 'none',
					__( 'Link to image', 'js_composer' ) => 'link_image',
					__( 'Open Lightbox', 'js_composer' ) => 'lightbox',
				),
				'description' => __( 'Select action for click action.', 'js_composer' ),
				'dependency' => array( 'element' => 'template', 'value' => array( 'thumbs', 'thumbs-no-border' ) ),
				'std' => 'link_image',
				'group'      => $group_insta
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide avatar', 'penci-framework' ),
				'param_name' => 'hide_avatar',
				'group'      => $group_insta,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide username', 'penci-framework' ),
				'param_name' => 'hide_username',
				'group'      => $group_insta,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide followers', 'penci-framework' ),
				'param_name' => 'hide_followers',
				'group'      => $group_insta,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide video icon', 'penci-framework' ),
				'param_name' => 'hide_video_icon',
				'group'      => $group_insta,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide button follow', 'penci-framework' ),
				'param_name' => 'hide_button_follow',
				'group'      => $group_insta,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Select Icon Size', 'penci-framework' ),
				'param_name' => 'icon_size',
				'value'      => array(
					__( 'Normal', 'penci-framework' ) => '',
					__( 'Small', 'penci-framework' )  => 'small',
				),
				'std'        => 'square',
				'group'      => $group_insta,
				'dependency'       => array( 'element' => 'template', 'value' => array( 'thumbs','thumbs-no-border' ) ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Disable Auto Play Slider ', 'penci-framework' ),
				'param_name' => 'auto_play',
				'dependency'       => array( 'element' => 'template', 'value' => 'slider' ),
				'group'      => $group_insta,
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Disable Slider Loop', 'penci-framework' ),
				'param_name' => 'disable_loop',
				'dependency'       => array( 'element' => 'template', 'value' => 'slider' ),
				'group'      => $group_insta,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slider Auto Time (at x seconds)', 'penci-framework' ),
				'param_name'  => 'auto_time',
				'std'         => 4000,
				'dependency'       => array( 'element' => 'template', 'value' => 'slider' ),
				'group'      => $group_insta,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slider Speed (at x seconds)', 'penci-framework' ),
				'param_name'  => 'speed',
				'std'         => 600,
				'dependency'       => array( 'element' => 'template', 'value' => 'slider' ),
				'group'      => $group_insta,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Number of words in caption', 'penci-framework' ),
				'param_name'  => 'caption_words',
				'std'         => 100,
				'dependency'       => array( 'element' => 'template', 'value' => 'slider' ),
				'group'      => $group_insta,
			),
		),
		Penci_Framework_Shortcode_Params::color_params( '', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_instagram_css',
				'heading'          => esc_html__( 'Instagram colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Username color', 'penci-framework' ),
				'param_name'       => 'username_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Username hover color', 'penci-framework' ),
				'param_name'       => 'username_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Followers color', 'penci-framework' ),
				'param_name'       => 'followers_color',
				'group'            => $group_color,
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button follow text color', 'penci-framework' ),
				'param_name'       => 'follow_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button follow background color', 'penci-framework' ),
				'param_name'       => 'follow_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button follow text hover color', 'penci-framework' ),
				'param_name'       => 'follow_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button follow background hover color', 'penci-framework' ),
				'param_name'       => 'follow_bghcolor',
				'group'            => $group_color,
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
				'prefix'       => 'username',
				'title'        => esc_html__( 'Username settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '18px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'followers',
				'title'        => esc_html__( 'Followers settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '13px',
			)
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);