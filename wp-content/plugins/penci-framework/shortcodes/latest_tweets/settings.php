<?php

$group_color  = 'Color';


// Shortcode settings
return array(
	'name'   => esc_html__( 'Latest Tweets', 'penci-framework' ),
	'params' => array_merge(
		Penci_Framework_Shortcode_Params::block_title( ),
		array(
			array(
		    'param_name' => 'custom_markup', 
		    'type' => 'custom_markup',
			'value' => '<a href="'. esc_url( __( 'https://apps.twitter.com/', 'penci-framework' ) ) .'" target="_blank">'. esc_html__( 'Get your Twitter app details here', 'penci-framework' ) .'</a>',
 			 'group' => 'Tweets'
 			 ),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Consumer Key:', 'penci-framework' ),
				'param_name'  => 'consumer_key',
				'std' => '',
				'group' => 'Tweets'
			),array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Consumer Secret:', 'penci-framework' ),
				'param_name'  => 'consumer_secret',
				'std' => '',
				'group' => 'Tweets'
			),array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Access Token:', 'penci-framework' ),
				'param_name'  => 'access_token',
				'std' => '',
				'group' => 'Tweets'
			),array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Access Token Secre:', 'penci-framework' ),
				'param_name'  => 'access_token_secret',
				'std' => '',
				'group' => 'Tweets'
			),array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Cache Time (seconds):', 'penci-framework' ),
				'param_name'  => 'cache_time',
				'std' => '3600',
				'group' => 'Tweets'
			),array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Twitter Screen Name:', 'penci-framework' ),
				'param_name'  => 'username',
				'std' => '',
				'group' => 'Tweets'
			),array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Number Of Tweets:', 'penci-framework' ),
				'param_name'  => 'number',
				'std' => '3',
				'group' => 'Tweets'
			),
			
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Custom Reply text:', 'penci-framework' ),
				'param_name'  => 'reply',
				'std' => esc_html__( 'Reply', 'penci-framework' ),
				'group' => 'Tweets'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Custom Retweet text:', 'penci-framework' ),
				'param_name'  => 'retweet',
				'std' => esc_html__( 'Retweet', 'penci-framework' ),
				'group' => 'Tweets'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Custom Favorite text:', 'penci-framework' ),
				'param_name'  => 'favorite',
				'std' => esc_html__( 'Favorite', 'penci-framework' ),
				'group' => 'Tweets'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Text Align', 'penci-framework' ),
				'param_name' => 'align',
				'value' => array(
					__( 'Align Center', 'penci-framework' ) => 'pc_aligncenter',
					__( 'Align Left', 'penci-framework' ) => 'pc_alignleft',
					__( 'Align Right', 'penci-framework' ) => 'pc_alignright',
				),
				'group' => 'Tweets'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Disable Auto Play Tweets Slider?', 'penci-framework' ),
				'param_name' => 'auto',
				'std'        => true
			),
		),
		Penci_Framework_Shortcode_Params::block_option_meta( array( 'hide_heading_meta_settings', 'hide_enable_stiky' ) ),
		Penci_Framework_Shortcode_Params::block_option_block_title(  ),
		Penci_Framework_Shortcode_Params::color_params( 'penci_widget_archive', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_Tweets_css',
				'heading'          => esc_html__( 'Tweets colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Text color', 'penci-framework' ),
				'param_name'       => 'tweets_text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Date color', 'penci-framework' ),
				'param_name'       => 'tweets_date_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Icon and Link color', 'penci-framework' ),
				'param_name'       => 'tweets_link_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Dot background color', 'penci-framework' ),
				'param_name'       => 'tweets_dot_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Dot border color', 'penci-framework' ),
				'param_name'       => 'tweets_dot_bordercolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Dot border and background active color', 'penci-framework' ),
				'param_name'       => 'tweets_dot_hcolor',
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
				'prefix'       => 'tweets_text',
				'title'        => esc_html__( 'Tweet text settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'tweets_date',
				'title'        => esc_html__( 'Tweet date settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'tweets_link',
				'title'        => esc_html__( 'Tweet link settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '',
			)
		)
	)
);