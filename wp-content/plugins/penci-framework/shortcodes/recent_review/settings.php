<?php
$shotcode_id = 'recent_review';
$group_color  = 'Color';
// Shortcode settings
return array(
	'name'    => esc_html__( 'Recent Review', 'penci-framework' ),
	'weight'  => 900,
	'params'  => array_merge(
		Penci_Framework_Shortcode_Params::block_title( array( 'block_title_default' => __( 'Recent Comments' ) ) ),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Order by', 'penci-framework' ),
				'param_name' => 'review_orderby',
				'std'        => 'mostRecent',
				'value'      => array(
					esc_html__( 'Most recent', 'penci-framework' )  => 'most_recent',
					esc_html__( 'Top score', 'penci-framework' )    => 'tops_core',
					esc_html__( 'Most helpful', 'penci-framework' ) => 'most_helpful',
					esc_html__( 'Worst score', 'penci-framework' )  => 'worst_score',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Number of reviews', 'penci-framework' ),
				'description' => __( 'Enter number of reviews to display.', 'penci-framework' ),
				'param_name' => 'number',
				'value' => 5,
				'admin_label' => true,
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Author image', 'penci-framework' ),
				'param_name'       => 'hide_author_img',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Review Date', 'penci-framework' ),
				'param_name'       => 'hide_review_date',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide Review rating', 'penci-framework' ),
				'param_name'       => 'hide_review_rating',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide Review Title', 'penci-framework' ),
				'param_name' => 'hide_rvtitle',

			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Custom Review Title Length', 'penci-framework' ),
				'param_name' => 'rvtitle_length',
				'std'        => '10',
				'dependency' => array( 'element' => 'hide_rvtitle', 'is_empty' => true ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide Review Excrept', 'penci-framework' ),
				'param_name' => 'hide_excrept',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Custom Review Excrept Length', 'penci-framework' ),
				'param_name' => 'excrept_length',
				'std'        => '25',
				'dependency' => array( 'element' => 'hide_excrept', 'is_empty' => true ),
			)
		),
		Penci_Framework_Shortcode_Params::block_option_block_title(),
		Penci_Framework_Shortcode_Params::color_params( 'penci_recent_comments', false ),
		array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'extra_css',
				'heading'          => esc_html__( 'Extra colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Review author color', 'penci-framework' ),
				'param_name'       => 'author_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Review date color', 'penci-framework' ),
				'param_name'       => 'date_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Review title color', 'penci-framework' ),
				'param_name'       => 'rvtitle_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Review title hover color', 'penci-framework' ),
				'param_name'       => 'rvtitle_hcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Review excrept color', 'penci-framework' ),
				'param_name'       => 'excrept_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border bottom color', 'penci-framework' ),
				'param_name'       => 'item_border_bottom_color',
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
				'prefix'       => 'review_author',
				'title'        => esc_html__( 'Author settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '18px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'review_date',
				'title'        => esc_html__( 'Date settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'review_title',
				'title'        => esc_html__( 'Review title settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
				'font-size'    => '18px',
			)
		),
		Penci_Framework_Shortcode_Params::block_option_typo(
			array(
				'prefix'       => 'review_excrept',
				'title'        => esc_html__( 'Review Excrept settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '14px',
			)
		)
	),
	'js_view' => 'VcPenciShortcodeView',
);