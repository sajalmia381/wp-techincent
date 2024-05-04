<?php
$group_filter = 'Filter';
$group_color  = 'Color';

$shotcode_id = 'grid_3';

$block_general_array = array(
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Custom "Trending now" Text:', 'penci-framework' ),
		'param_name'  => 'title',
		'std'         => esc_html__( 'Trending now', 'penci-framework' ),
		'admin_label' => true,
		'description' => esc_html__( 'If you want hide Trending now text, let empty this', 'penci-framework' ),
	),
	array(
		'type'        => 'iconpicker',
		'heading'     => esc_html__( 'Custom icon after title for this block', 'penci-framework' ),
		'param_name'  => 'icon_fontawesome',
		'value'       => 'fa fa-bolt',
		'settings'    => array(
			'emptyIcon'    => true,
			'iconsPerPage' => 4000,
		),
		'description' => esc_html__( 'Select icon from library.', 'penci-framework' ),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Type', 'penci-framework' ),
		'param_name' => 'sort',
		'std'        => 'latest-posts',
		'value' => array(
			esc_html__( 'Show Popular Posts in Once Week', 'penci-framework' )   => 'popular7',
			esc_html__( 'Show Popular Posts in Once Month ', 'penci-framework' ) => 'popular_month',
			esc_html__( 'Show Popular Posts in All Times', 'penci-framework' )   => 'popular',
			esc_html__( 'Show Latest Posts', 'penci-framework' )                 => 'latest-posts',
		),
	),
	array(
		'type'       => 'checkbox',
		'heading'    => esc_html__( 'Disable Auto Play Slider ', 'penci-framework' ),
		'param_name' => 'auto_play',
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Slider Auto Time (at x seconds)', 'penci-framework' ),
		'param_name'  => 'auto_time',
		'std'         => 4000
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Slider Speed (at x seconds)', 'penci-framework' ),
		'param_name'  => 'speed',
		'std'         => 400,
	),
	array(
		'type'       => 'checkbox',
		'heading'    => esc_html__( 'Show next/prev buttons', 'penci-framework' ),
		'param_name' => 'hide_nav',
	),
);

$block_color_array = array(
	// Colors
	array(
		'type'       => 'colorpicker',
		'heading'    => esc_html__( 'Background color', 'penci-framework' ),
		'param_name' => 'bg_title_color',
		'group'      => $group_color,
	),
	array(
		'type'       => 'colorpicker',
		'heading'    => esc_html__( 'Title text color', 'penci-framework' ),
		'param_name' => 'title_color',
		'group'      => $group_color,
	),
	array(
		'type'       => 'colorpicker',
		'heading'    => esc_html__( 'Post title color', 'penci-framework' ),
		'param_name' => 'post_title_color',
		'group'      => $group_color,
	),
	array(
		'type'       => 'colorpicker',
		'heading'    => esc_html__( 'Post title hover color', 'penci-framework' ),
		'param_name' => 'post_title_hover_color',
		'group'      => $group_color,
	),
);


// Shortcode settings
return array(
	'name'   => esc_html__( 'News Ticker', 'penci-framework' ),
	'weight' => 814,
	'params' =>  array_merge(
		Penci_Framework_Shortcode_Params::block_build_query(),
		$block_general_array,
		Penci_Framework_Shortcode_Params::block_option_trim_word( array( 'standard' => 7 ) ),
		Penci_Framework_Shortcode_Params::filter_params( $shotcode_id ),
		$block_color_array,
		Penci_Framework_Shortcode_Params::block_option_note_custom_fonts(),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'block_title',
				'title'        => esc_html__( 'Text "Trending now" settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'post_title',
				'title'        => esc_html__( 'Post title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '18px',
			)
		)
	)
);