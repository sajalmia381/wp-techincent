<?php

/**
 * Class Penci_Framework_Shortcode_Params
 */
class Penci_Framework_Shortcode_Params {

	public static function block_build_query( $size = 5 , $setting = array(), $post_type = 'post' ) {

		if( ! $setting ) {
			$setting = array(
				'size'      => array( 'value' => $size, 'hidden' => false ),
				'post_type' => array( 'value' => 'post', 'hidden' => false )
			);
		}

		$value = 'post_type:' . $post_type;
		if ( $size ) {
			$value .= '|size:' . $size;
		}

		return array(
			array(
				'type'        => 'loop',
				'heading'     => __( '', 'penci-framework' ),
				'param_name'  => 'build_query',
				'value'       => $value,
				'settings'    => $setting,
				'description' => __( 'Create WordPress loop, to populate content from your site.', 'penci-framework' ),
			),
		);
	}
	/**
	 * Get setting block title
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	public static function block_title( $args = array() ) {

		$args = shortcode_atts( array(
			'shortcode_id'        => '',
			'block_title_default' => '',
		), $args );


		$block_grid = array( 'grid_1', 'grid_11', 'grid_2', 'grid_3', 'grid_4', 'grid_5', 'grid_6', 'grid_7', 'grid_8' );

		$style = array(
			esc_html__( 'Style 1', 'penci-framework' )  => 'style-title-1',
			esc_html__( 'Style 2', 'penci-framework' )  => 'style-title-2',
			esc_html__( 'Style 3', 'penci-framework' )  => 'style-title-3',
			esc_html__( 'Style 4', 'penci-framework' )  => 'style-title-4',
			esc_html__( 'Style 5', 'penci-framework' )  => 'style-title-5',
			esc_html__( 'Style 6', 'penci-framework' )  => 'style-title-6',
			esc_html__( 'Style 7', 'penci-framework' )  => 'style-title-7',
			esc_html__( 'Style 8', 'penci-framework' )  => 'style-title-8',
			esc_html__( 'Style 9', 'penci-framework' )  => 'style-title-9',
			esc_html__( 'Style 10', 'penci-framework' ) => 'style-title-10',
			esc_html__( 'Style 11', 'penci-framework' ) => 'style-title-11',
			esc_html__( 'Style 12', 'penci-framework' ) => 'style-title-12',
			esc_html__( 'Style 13', 'penci-framework' ) => 'style-title-13',
		);

		if ( in_array( $args['shortcode_id'] ,$block_grid ) ) {
			$style[ esc_html__( 'Style Grid', 'penci-framework' ) ] = 'style-title-grid';
		}

		return array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Select Style Block Title', 'penci-framework' ),
				'param_name'  => 'style_block_title',
				'std'         => 'style-title-1',
				'value'       => $style,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Block title:', 'penci-framework' ),
				'param_name'  => 'title',
				'value'        => $args['block_title_default'],
				'admin_label' => true,
				'description' => esc_html__( 'A title for this block, if you leave it blank the block will not have a title', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title url:', 'penci-framework' ),
				'param_name'  => 'block_title_url',
				'std'         => '',
				'description' => esc_html__( 'A custom url when the block title is clicked', 'penci-framework' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Add icon for title?', 'penci-framework' ),
				'param_name' => 'add_title_icon',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon Alignment', 'penci-framework' ),
				'description' => __( 'Select icon alignment.', 'penci-framework' ),
				'param_name' => 'title_i_align',
				'value' => array(
					__( 'Left', 'penci-framework' ) => 'left',
					__( 'Right', 'penci-framework' ) => 'right',
				),
				'dependency' => array( 'element' => 'add_title_icon', 'value' => 'true', ),
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Icon', 'penci-framework' ),
				'param_name' => 'title_icon',
				'settings'   => array(
					'emptyIcon'    => true,
					'type'         => 'fontawesome',
					'iconsPerPage' => 4000,
				),
				'dependency' => array( 'element' => 'add_title_icon', 'value' => 'true',
				),
			),
		);
	}

	/**
	 * Option hidden thumbnail
	 * Node:  check block 15
	 * @return array
	 */
	public static function block_pos_thumbnail() {
		return array(
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide thumbnails', 'penci-framework' ),
				'param_name'       => 'hide_thumb',
				'value'            => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Select position of thumbnail', 'penci-framework' ),
				'param_name' => 'thumb_pos',
				'std'        => 'left',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )  => 'left',
					esc_html__( 'Right', 'penci-framework' ) => 'right',
				),
				//'dependency' => array( 'element' => 'hide_thumb', 'value_not_equal_to' => 'yes', ),
			),
		);
	}

	/**
	 * Get setting limit
	 *
	 * @param int $default
	 *
	 * @return array
	 */
	public static function block_option_limit( $default = 5, $args_limit = array() ) {
		if ( $args_limit ) {

			$option = array();
			foreach ( $args_limit as $item ) {
				$option[ $item ] = $item;
			}

			return array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Amount', 'penci-framework' ),
					'param_name'  => 'limit',
					'std'         => $default,
					'value'       => $option,
					'admin_label' => true,
					'description' => esc_html__( 'If the field is empty the limit post number will be the number from Wordpress settings -> Reading', 'penci-framework' ),
				)
			);
		}

		return array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Amount', 'penci-framework' ),
				'param_name'  => 'limit',
				'std'         => $default,
				'admin_label' => true,
				'description' => esc_html__( 'If the field is empty the limit post number will be the number from Wordpress settings -> Reading', 'penci-framework' ),
			),
		);
	}

	/**
	 * Get block option loop
	 *
	 * @param string $number
	 * @param string $example
	 *
	 * @return array
	 */
	public static function block_option_loop( $number = '5', $example = '5,10,15,20' ) {
		return array(
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Turn on loop items', 'penci-framework' ),
				'param_name'  => 'turn_on_loop_item',
				'description' => esc_html__( 'If checked, will be display ' . $number . ' posts this one. Please enter the amount which can be devided by ' . $number . ' such as ' . $example, 'penci-framework' ),

			)
		);
	}


	/**
	 * Get setting option meta
	 *
	 * @param $args array( 'cat', 'author', 'comment', 'date', 'like', 'view' ,'icon_post_format','hide_dis_bg_block' )
	 *
	 * @return array
	 */
	public static function block_option_meta( $args, $show_args = array() ) {
		if ( empty( $args ) ) {
			return array();
		}

		$option_meta = array();

		if ( ! in_array( 'hide_heading_meta_settings', $args ) ) {
			$option_meta[] = array(
				'type'             => 'textfield',
				'param_name'       => 'heading_meta_settings',
				'heading'          => 'Post settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			);
		}


		foreach ( $args as $item ) {

			switch ( $item ) {
				case 'author':
					$option_meta[] = array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Hide Post Author', 'penci-framework' ),
						'param_name'       => 'hide_author',
						'edit_field_class' => 'vc_col-sm-6',
					);
					break;
				case 'comment':
					$option_meta[] = array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Hide Comment Count', 'penci-framework' ),
						'param_name'       => 'hide_comment',
						'edit_field_class' => 'vc_col-sm-6',
					);
					break;
				case 'date':
					$option_meta[] = array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Hide Post Date', 'penci-framework' ),
						'param_name'       => 'hide_post_date',
						'edit_field_class' => 'vc_col-sm-6',
					);
					break;
				case 'like':
					$option_meta[] = array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Hide Post Count Likes', 'penci-framework' ),
						'param_name'       => 'hide_count_like',
						'edit_field_class' => 'vc_col-sm-6',
					);
					break;
				case 'view':
					$option_meta[] = array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Hide Post Count Views', 'penci-framework' ),
						'param_name'       => 'hide_count_view',
						'edit_field_class' => 'vc_col-sm-6',
					);
					break;
				case 'cat':
					$option_meta[] = array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Hide Categories', 'penci-framework' ),
						'param_name'       => 'hide_cat',
						'edit_field_class' => 'vc_col-sm-6',
					);
					$option_meta[] = array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Show All Categories', 'penci-framework' ),
						'param_name'       => 'show_allcat',
						'edit_field_class' => 'vc_col-sm-6',
						'dependency' => array( 'element' => 'hide_cat', 'is_empty' => true ),
					);
					break;
				case 'icon_post_format':
					$option_meta[] = array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Hide Icon Post Format', 'penci-framework' ),
						'param_name'       => 'hide_icon_post_format',
						'edit_field_class' => 'vc_col-sm-6',
					);
					break;
				case 'review':
					$option_meta[] = array(
						'type'       => 'checkbox',
						'heading'    => esc_html__( 'Hide Review Piechart', 'penci-framework' ),
						'param_name' => 'hide_review_piechart',
						'edit_field_class' => 'vc_col-sm-6',
					);
					break;
				case 'read_more':
					$option_meta[] = array(
						'type'       => 'checkbox',
						'heading'    => esc_html__( 'Show Read More Button', 'penci-framework' ),
						'param_name' => 'show_readmore',
						'value'      => array( __( 'Yes', 'penci-framework' ) => 'yes' ),
						'edit_field_class' => 'vc_col-sm-6',
					);
					break;
			}
		}

		if( $show_args ){
			foreach ( $show_args as $item ) {
				switch ( $item ) {
					case 'author':
						$option_meta[] = array(
							'type'             => 'checkbox',
							'heading'          => esc_html__( 'Show Post Author', 'penci-framework' ),
							'param_name'       => 'show_author',
							'edit_field_class' => 'vc_col-sm-6',
						);
						break;
					case 'comment':
						$option_meta[] = array(
							'type'             => 'checkbox',
							'heading'          => esc_html__( 'Show Comment Count', 'penci-framework' ),
							'param_name'       => 'show_comment',
							'edit_field_class' => 'vc_col-sm-6',
						);
						break;
					case 'date':
						$option_meta[] = array(
							'type'             => 'checkbox',
							'heading'          => esc_html__( 'Show Post Date', 'penci-framework' ),
							'param_name'       => 'show_post_date',
							'edit_field_class' => 'vc_col-sm-6',
						);
						break;
					case 'view':
						$option_meta[] = array(
							'type'             => 'checkbox',
							'heading'          => esc_html__( 'Show Post Count Views', 'penci-framework' ),
							'param_name'       => 'show_count_view',
							'edit_field_class' => 'vc_col-sm-6',
						);
						break;
				}
			}
		}

		if( ! in_array( 'hide_dis_bg_block', $args ) ){
			$option_meta[] = array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Disable Background', 'penci-framework' ),
				'param_name' => 'dis_bg_block',
				'edit_field_class' => 'vc_col-sm-6',
			);
		}

		if( ! in_array( 'hide_enable_stiky', $args ) ){
			$option_meta[] = array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable sticky posts', 'penci-framework' ),
				'param_name' => 'enable_stiky_post',
				'edit_field_class' => 'vc_col-sm-6',
			);
		}



		return $option_meta;
	}

	public static function block_option_block_title( ) {
		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'block_title_meta_settings',
				'heading'          => 'Block title settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Select Block Title Align', 'penci-framework' ),
				'param_name' => 'block_title_align',
				'std'        => 'left',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )   => 'style-title-left',
					esc_html__( 'Center', 'penci-framework' ) => 'style-title-center',
					esc_html__( 'Right', 'penci-framework' )  => 'style-title-right',
				),
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Turn off Uppercase Block Title', 'penci-framework' ),
				'param_name'       => 'block_title_off_uppercase',
			),
			array(
				'type'             => 'penci_number',
				'param_name'       => 'block_title_wborder_left_right',
				'heading'          => esc_html__( 'Custom width border left or right', 'penci-framework' ),
				'value'            => '',
				'std'              => '5px',
				'suffix'           => 'px',
				'min'              => 1,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-9', 'style-title-10' ) ),
			),

			array(
				'type'             => 'penci_number',
				'param_name'       => 'block_title_wborder',
				'heading'          => esc_html__( 'Custom width border', 'penci-framework' ),
				'value'            => '',
				'std'              => '3px',
				'suffix'           => 'px',
				'min'              => 1,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-11','style-title-12' ) ),
			),

		);
	}

	/**
	 * Render option wp trimword title
	 *
	 * 'big','standard','small'
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	public static function block_option_trim_word( $args = array() ) {

		$settings = array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_trimword_settings',
				'heading'          => 'Post title settings',
				'std'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			)
		);

		foreach ( $args as $key => $value ) {
			if ( 'big' == $key ) {
				$settings[] = array(
					'type'       => 'textfield',
					'param_name' => 'post_big_title_length',
					'heading'    => esc_html__( 'Custom Title Length for Big Posts:', 'penci-framework '),
					'std'      => $value,
				);
			}

			if ( 'standard' == $key ) {
				$settings[] = array(
					'type'       => 'textfield',
					'param_name' => 'post_standard_title_length',
					'heading'    => esc_html__( 'Custom Title Length:','penci-framework' ),
					'std'      => $value,
				);
			}

			if ( 'small' == $key ) {
				$settings[] = array(
					'type'       => 'textfield',
					'param_name' => 'post_small_title_length',
					'heading'    => esc_html__( 'Custom Title Length for Small Posts:','penci-framework' ),
					'std'      => $value,
				);
			}
		}

		return $settings;
	}

	/**
	 * Get setting option post excrept
	 *
	 * @param int $length
	 * @param string $heading_checkbox
	 * @param string $heading_length
	 *
	 * @return array
	 */
	public static function block_post_excrept( $length = 15, $heading_checkbox = '', $heading_length = '' ) {

		$heading_checkbox = $heading_checkbox ? $heading_checkbox : esc_html__( 'Hide Post Excrept', 'penci-framework' );
		$heading_length   = $heading_length ? $heading_length : esc_html__( 'Custom Excerpt Length:', 'penci-framework' );

		return array(
			array(
				'type'       => 'checkbox',
				'heading'    => $heading_checkbox,
				'param_name' => 'hide_excrept',
			),
			array(
				'type'       => 'textfield',
				'heading'    => $heading_length,
				'param_name' => 'post_excrept_length',
				'std'        => $length,
				'dependency' => array( 'element' => 'hide_excrept', 'is_empty' => true ),
			)
		);
	}

	/**
	 * Get setting option slider
	 *
	 * @return array
	 */
	public static function block_option_slider() {
		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_slider_settings',
				'heading'          => 'Slider settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable Auto Play Slider ', 'penci-framework' ),
				'param_name' => 'auto_play',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Disable Slider Loop', 'penci-framework' ),
				'param_name' => 'disable_loop',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slider Auto Time (at x seconds)', 'penci-framework' ),
				'param_name'  => 'auto_time',
				'std'         => 4000,
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slider Speed (at x seconds)', 'penci-framework' ),
				'param_name'  => 'speed',
				'std'         => 600,
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Show next/prev buttons', 'penci-framework' ),
				'param_name' => 'show_nav',
			),
		);
	}

	public static function block_option_btn_viewmore() {
		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_viewmore_settings',
				'heading'          => 'Button view more settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Hide button see more posts', 'penci-framework' ),
				'param_name' => 'hide_button_more_post',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Link button see more posts:', 'penci-framework' ),
				'param_name'       => 'link_button_more_post',
				'std'              => '#',
				'dependency'       => array( 'element' => 'hide_button_more_post', 'is_empty' => true ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Text button see more posts:', 'penci-framework' ),
				'param_name'       => 'text_button_more_post',
				'std'              => esc_html__( 'See more posts', 'penci-framework' ),
				'dependency'       => array( 'element' => 'hide_button_more_post', 'is_empty' => true ),
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
	}


	/**
	 * Get list filter params
	 *
	 * @param $shotcode_id
	 *
	 * @return mixed|void
	 */
	public static function filter_params( $shotcode_id = '' ) {
		return array();
		$group_filter = 'Filter';

		return array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Post ID filter:', 'penci-framework' ),
				'param_name'  => 'post_ids',
				'std'         => '',
				'group'       => $group_filter,
				'description' => esc_html__( 'Fill here the post IDs separated by commas ( Ex: 2,3,8 ). To exclude posts add them with \'-\' ( ex: -5, -7 )', 'penci-framework' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Post Type:', 'penci-framework' ),
				'param_name' => 'post_types',
				'value'      => Penci_Framework_Helper::get_post_types(),
				'std'        => 'post',
				'group'      => $group_filter,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Select category', 'penci-framework' ),
				'value'      => Penci_Framework_Helper::get_terms(),
				'param_name' => 'category_ids',
				'dependency' => array( 'element' => 'post_types', 'value' => 'post' ),
				'group'      => $group_filter,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Exclude categories ID:', 'penci-framework' ),
				'param_name'  => 'exclude_cat_id',
				'std'         => '',
				'group'       => $group_filter,
				'description' => esc_html__( 'Fill here the tag slugs separated by commas ( Ex: 4,13,20 )', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Tag slug:', 'penci-framework' ),
				'param_name'  => 'tag_slug',
				'std'         => '',
				'group'       => $group_filter,
				'description' => esc_html__( 'Fill here the tag slugs separated by commas ( Ex: tag2 ,tag4,tag5 )', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Multiple authors filter:', 'penci-framework' ),
				'param_name'  => 'autors_id',
				'std'         => '',
				'group'       => $group_filter,
				'description' => esc_html__( 'Fill here the author IDs separated by commas ( Dx: 10,56,1 ).', 'penci-framework' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Sort order:', 'penci-framework' ),
				'param_name' => 'sort',
				'value'      => array(
					esc_html__( '-- Latest posts --', 'penci-framework' )           => '',
					esc_html__( 'Random posts Today', 'penci-framework' )           => 'random_today',
					esc_html__( 'Random posts from last 7 days', 'penci-framework' ) => 'random_7_day',
					esc_html__( 'Alphabetical ( A - Z )', 'penci-framework' )       => 'alphabetical_order',
					esc_html__( 'Popular posts is all times', 'penci-framework' )   => 'popular',
					esc_html__( 'Popular posts is once month', 'penci-framework' )  => 'popular_month',
					esc_html__( 'Popular posts in once week', 'penci-framework' )   => 'popular7',
					esc_html__( 'Review score number', 'penci-framework' )          => 'review',
					esc_html__( 'Random Posts', 'penci-framework' )                 => 'random_posts',
					esc_html__( 'Most Commented', 'penci-framework' )               => 'comment_count'
				),
				'group'      => $group_filter,
			),
		);
	}


	/**
	 * Get option pagination
	 *
	 * @param null $args
	 *
	 * @return array
	 */
	public static function block_option_pag( $args = null ) {

		$defaults = array(
			'next_prev'      => 1,
			'load_more'      => 1,
			'infinite'       => 1,
			'pagination'     => 1,
			'link_more'      => 0,
			'limit_loadmore' => 0,
			'hide_pag_position' => 0
		);

		$args = wp_parse_args( $args, $defaults );

		$style_pag = array( esc_html__( '- No pagination -', 'penci-framework' ) => '' );

		$label_next_prev  = esc_html__( 'Next Prev Ajax', 'penci-framework' );
		$label_load_more  = esc_html__( 'Load More Button', 'penci-framework' );
		$label_infinite   = esc_html__( 'Infinite Load', 'penci-framework' );
		$label_pagination = esc_html__( 'Numeric Pagination', 'penci-framework' );

		if ( $args['next_prev'] ) {
			$style_pag[ $label_next_prev ] = 'next_prev';
		}

		if ( $args['load_more'] ) {
			$style_pag[ $label_load_more ] = 'load_more';
		}

		if ( $args['infinite'] ) {
			$style_pag[ $label_infinite ] = 'infinite';
		}

		if ( $args['pagination'] ) {
			$style_pag[ $label_pagination ] = 'pagination';
		}

		$params = array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_ajax_pagination_settings',
				'heading'          => 'Pagination settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination:', 'penci-framework' ),
				'param_name' => 'style_pag',
				'std'        => '',
				'value'      => $style_pag,
			),
		);

		if( ! $args['hide_pag_position'] ) {
			$params[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Select pagination position', 'penci-framework' ),
				'param_name' => 'pag_position',
				'std'        => 'penci-pag-center',
				'value'      => array(
					esc_html__( 'Left', 'penci-framework' )   => 'penci-pag-left',
					esc_html__( 'Center', 'penci-framework' ) => 'penci-pag-center',
					esc_html__( 'Right', 'penci-framework' )  => 'penci-pag-right',
				),
				'dependency' => array( 'element' => 'style_pag', 'value' => array( 'load_more', 'infinite', 'next_more', 'pagination' ) ),
			);
		}

		if ( ! empty( $args['limit_loadmore'] )  ) {

			if( is_array( $args['limit_loadmore'] ) ) {

				$limit_loadmore_option = array();
				foreach ( $args['limit_loadmore'] as $v ) {
					$limit_loadmore_option[$v] = $v;
				}

				$params[] = array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Custom Number Posts for Each Time Load More Posts', 'penci-framework' ),
					'param_name' => 'limit_loadmore',
					'std'        => $args['limit_loadmore'],
					'dependency' => array( 'element' => 'style_pag', 'value' => array( 'load_more', 'infinite' ) ),
					'value'      => $limit_loadmore_option,
				);
			}else{
				$params[] = array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Custom Number Posts for Each Time Load More Posts', 'penci-framework' ),
					'param_name' => 'limit_loadmore',
					'std'        => $args['limit_loadmore'],
					'dependency' => array( 'element' => 'style_pag', 'value' => array( 'load_more', 'infinite' ) ),
				);
			}
		}

		return $params;
	}


	/**
	 * Get setting option color meta
	 *
	 * @return array
	 */
	public static function block_option_color_pagination() {
		$group_color = 'Color';

		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'pagination_css',
				'heading'          => esc_html__( 'Pagination colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_pag', 'value' => array( 'pagination' ) ),
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Number color', 'penci-framework' ),
				'param_name'       => 'pagi_number_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_pag', 'value' => array( 'pagination' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Number Background color', 'penci-framework' ),
				'param_name'       => 'pagi_number_bg_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_pag', 'value' => array( 'pagination' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Number hover color', 'penci-framework' ),
				'param_name'       => 'pagi_number_hcolor',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_pag', 'value' => array( 'pagination' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Number Hover Background color', 'penci-framework' ),
				'param_name'       => 'pagi_number_bg_hcolor',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_pag', 'value' => array( 'pagination' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'             => 'textfield',
				'param_name'       => 'loadmore_css',
				'heading'          => esc_html__( 'Load More colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_pag', 'value' => array( 'load_more' ) ),
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Disable background and border load more button', 'penci-framework' ),
				'param_name'       => 'disable_bg_load_more',
				'value'            => array( esc_html__( 'Yes', 'penci-framework' ) => 'yes' ),
				'group'            => $group_color,
				'dependency' => array( 'element' => 'style_pag', 'value' => array( 'load_more', 'infinite' ) ),
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Text color', 'penci-framework' ),
				'param_name'       => 'loadmore_text_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_pag', 'value' => array( 'load_more' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Background color', 'penci-framework' ),
				'param_name'       => 'loadmore_bg_color',
				'group'            => $group_color,
				'dependency' => array( 'element' => 'disable_bg_load_more', 'value_not_equal_to' => array( 'yes' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border color', 'penci-framework' ),
				'param_name'       => 'loadmore_border_color',
				'group'            => $group_color,
				'dependency' => array( 'element' => 'disable_bg_load_more', 'value_not_equal_to' => array( 'yes' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Text hover color', 'penci-framework' ),
				'param_name'       => 'loadmore_text_hcolor',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_pag', 'value' => array( 'load_more' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Background and border hover color', 'penci-framework' ),
				'param_name'       => 'loadmore_bg_hcolor',
				'group'            => $group_color,
				'dependency' => array( 'element' => 'disable_bg_load_more', 'value_not_equal_to' => array( 'yes' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
	}


	public static function block_option_typo_pagination() {
		return self::block_option_typo(
			array(
				'prefix'       => 'pag_loadmore',
				'title'        => esc_html__( 'Pagination & Load more settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
				'font-size'    => '13px',
				'dependency'   => array( 'element' => 'style_pag', 'value' => array( 'load_more', 'pagination' ) ),
			)
		);
	}


	/**
	 * Get setting option color meta
	 *
	 * @return array
	 */
	public static function block_option_color_readmore() {
		$group_color = 'Color';

		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'readmore_css',
				'heading'          => esc_html__( 'Read more button colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'dependency'   => array( 'element' => 'show_readmore', 'value' => 'yes' ),
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Text color', 'penci-framework' ),
				'param_name'       => 'readmore_text_color',
				'group'            => $group_color,
				'dependency'   => array( 'element' => 'show_readmore', 'value' => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Background color', 'penci-framework' ),
				'param_name'       => 'readmore_bg_color',
				'group'            => $group_color,
				'dependency'   => array( 'element' => 'show_readmore', 'value' => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Text hover color', 'penci-framework' ),
				'param_name'       => 'readmore_text_hcolor',
				'group'            => $group_color,
				'dependency'   => array( 'element' => 'show_readmore', 'value' => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Background  hover color', 'penci-framework' ),
				'param_name'       => 'readmore_bg_hcolor',
				'group'            => $group_color,
				'dependency'   => array( 'element' => 'show_readmore', 'value' => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
	}

	public static function block_option_typo_readmore() {
		return self::block_option_typo(
			array(
				'prefix'       => 'readmore',
				'title'        => esc_html__( 'Read more button settings' ),
				'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani500' ),
				'font-size'    => '13px',
				'dependency'   => array( 'element' => 'show_readmore', 'value' => 'yes' ),
			)
		);
	}


	/**
	 * Get list ajax filter params
	 *
	 * @param $shotcode_id
	 *
	 * @return mixed|void
	 */
	public static function ajax_filter_params( $shotcode_id ) {
		$group_ajaxfilter = 'Ajax Filter';

		$ajaxfilter = array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Ajax dropdown - filter type:', 'penci-framework' ),
				'param_name'  => 'ajax_filter_type',
				'std'         => '',
				'value'       => array(
					esc_html__( '- No drop down ajax filter -', 'penci-framework' ) => '',
					esc_html__( 'Filter by categories', 'penci-framework' )         => 'category_ids_filter',
					esc_html__( 'Filter by tag slug', 'penci-framework' )           => 'tag_slug_filter',
					esc_html__( 'Filter by taxonomies', 'penci-framework' )         => 'taxonomies_filter',
				),
				'description' => esc_html__( 'Show the ajax drop down filter. The ajax filters (except by popularity) require an additional parameter. If no ids are provided in the input below, the filter will show all the available items (ex: all categories or tags...)', 'penci-framework' ),
				'group'       => $group_ajaxfilter,
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Display selected categories or tags on the filter', 'penci-framework' ),
				'param_name' => 'ajax_filter_selected',
				'group'       => $group_ajaxfilter,
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Display child categories of selected category on the filter', 'penci-framework' ),
				'param_name'  => 'ajax_filter_childselected',
				'group'       => $group_ajaxfilter,
				'description' => esc_html__( 'The option only work with category', 'penci-framework' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Amount item ajax filter:', 'penci-framework' ),
				'param_name' => 'ajax_filter_number_item',
				'std'        => '5',
				'group'      => $group_ajaxfilter,
			),
			array(
				'type'        => 'textfield',//
				'heading'     => esc_html__( 'Ajax dropdown - show the following IDs:', 'penci-framework' ),
				'param_name'  => 'ajax_filter_ids',
				'std'         => '',
				'group'       => $group_ajaxfilter,
				'description' => __( 'The ajax drop down shows only the ( <a href="http://pennews.pencidesign.com/pennews-document/images/category_ID.png" target="_blank">categories ids</a> OR <a href="http://pennews.pencidesign.com/pennews-document/images/tag_ID.png" target="_blank">tag ids</a> ) that you enter here separated by comas. Example: 12, 14', 'penci-framework' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Ajax dropdown - Filter default text', 'penci-framework' ),
				'param_name'  => 'filter_default_txt',
				'std'         => function_exists( 'penci_get_tran_setting' ) ? penci_get_tran_setting( 'penci_tran_text_all' ) : esc_html__( 'All', 'penci-framework' ),
				'group'       => $group_ajaxfilter,
				'description' => esc_html__( 'The default text for the first item from the drop down. The first item shows the default block settings ( the settings from the Filter tab )', 'penci-framework' ),
			)
		);

		return apply_filters( "{$shotcode_id}_ajax_filter_params", $ajaxfilter );
	}

	/**
	 * @param $shotcode_id
	 * @param bool $has_post_title
	 *
	 * @return mixed|void
	 */
	public static function color_params( $shotcode_id, $has_post_title = true ) {
		$group_color = 'Color';
		$color_array = array(
			// Colors
			array(
				'type'             => 'textfield',
				'param_name'       => 'color_genral_css',
				'heading'          => esc_html__( 'Heading block colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border top color', 'penci-framework' ),
				'param_name'       => 'bordertop_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-1','style-title-8', 'style-title-11' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border left or right color', 'penci-framework' ),
				'param_name'       => 'border_left_right_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-9','style-title-10' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border color for block title style 10', 'penci-framework' ),
				'param_name'       => 'border_color_title_s10',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-10' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Background text block color', 'penci-framework' ),
				'param_name'       => 'background_title_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-2', 'style-title-4','style-title-9','style-title-13', 'style-title-grid' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Title text color', 'penci-framework' ),
				'param_name'       => 'title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Title text hover color', 'penci-framework' ),
				'param_name'       => 'title_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Border bottom color', 'penci-framework' ),
				'param_name'       => 'border_title_color',
				'group'            => $group_color,
				'dependency'       => array( 'element' => 'style_block_title', 'value' => array( 'style-title-1', 'style-title-3', 'style-title-4', 'style-title-5','style-title-6','style-title-12' ) ),
				'edit_field_class' => 'vc_col-sm-6',
			)
		);

		if( $has_post_title ) {
			$color_array[] = array(
				'type'             => 'textfield',
				'param_name'       => 'post_title_css',
				'heading'          => esc_html__( 'Post title colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			);

			$color_array[] = array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post title color', 'penci-framework' ),
				'param_name'       => 'post_title_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			);

			$color_array[] = array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post title hover color', 'penci-framework' ),
				'param_name'       => 'post_title_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			);
		}

		return apply_filters( "{$shotcode_id}_color_params", $color_array );
	}

	/**
	 * Get setting option color meta
	 *
	 * @return array
	 */
	public static function block_option_color_meta( $dependency = '' ) {
		$group_color = 'Color';

		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_meta_css',
				'heading'          => esc_html__( 'Post meta colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'dependency'       => $dependency,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post meta color', 'penci-framework' ),
				'param_name'       => 'meta_color',
				'group'            => $group_color,
				'dependency'       => $dependency,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Post meta hover color', 'penci-framework' ),
				'param_name'       => 'meta_hover_color',
				'group'            => $group_color,
				'dependency'       => $dependency,
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
	}

	/**
	 * Get setting option color meta
	 *
	 * @return array
	 */
	public static function block_option_color_cat() {
		$group_color = 'Color';

		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_category_css',
				'heading'          => esc_html__( 'Category colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Category color', 'penci-framework' ),
				'param_name'       => 'cat_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Category background color', 'penci-framework' ),
				'param_name'       => 'cat_bg_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Category hover color', 'penci-framework' ),
				'param_name'       => 'cat_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Category hover background color', 'penci-framework' ),
				'param_name'       => 'cat_bghover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
	}

	/**
	 * Get setting option color meta
	 *
	 * @return array
	 */
	public static function block_option_color_social_share() {
		$group_color = 'Color';

		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'social_share_css',
				'heading'          => esc_html__( 'Social share colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social media color', 'penci-framework' ),
				'param_name'       => 'social_share_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Social media hover color', 'penci-framework' ),
				'param_name'       => 'social_share_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
	}

	/**
	 * Get setting option color meta
	 *
	 * @return array
	 */
	public static function block_option_color_ajax_loading() {
		$group_color = 'Color';

		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_meta_css',
				'heading'          => esc_html__( 'Ajax loading colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Spinner loading color', 'penci-framework' ),
				'param_name'       => 'spinner_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
	}

	/**
	 * Get setting option color meta
	 *
	 * @return array
	 */
	public static function block_option_color_filter_text() {
		$group_color = 'Color';

		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_meta_css',
				'heading'          => esc_html__( 'Ajax dropdown colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Filter text color', 'penci-framework' ),
				'param_name'       => 'filter_text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Filter text hover color', 'penci-framework' ),
				'param_name'       => 'filter_text_hover_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Filter dropdown background color', 'penci-framework' ),
				'param_name'       => 'filter_dropdown_bgcolor',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
		);
	}


	public static function block_option_color_button() {
		$group_color = 'Color';

		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'post_meta_css',
				'heading'          => esc_html__( 'Button view more colors', 'penci-framework' ),
				'value'            => '',
				'group'            => $group_color,
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button background', 'penci-framework' ),
				'param_name'       => 'button_bg_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button border color', 'penci-framework' ),
				'param_name'       => 'button_border_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button text color', 'penci-framework' ),
				'param_name'       => 'button_text_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button hover background', 'penci-framework' ),
				'param_name'       => 'button_hbg_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button hover border color', 'penci-framework' ),
				'param_name'       => 'button_hborder_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Button hover text color', 'penci-framework' ),
				'param_name'       => 'button_htext_color',
				'group'            => $group_color,
				'edit_field_class' => 'vc_col-sm-6',
			)
		);
	}

	public static function block_option_typo( $args ) {

		$args = wp_parse_args( $args, array(
			'prefix'       => '',
			'title'        => '',
			'font-size'    => '',
			'line-height'  => '',
			'google_fonts' => '',
			'dependency'   => '',
			'font_style'   => '',
		) );

		$group_typo = 'Typo';

		$typo =  array(
			array(
				'type'             => 'textfield',
				'param_name'       => $args['prefix'] . '_typography',
				'heading'          => $args['title'],
				'value'            => '',
				'group'            => $group_typo,
				'dependency'       => $args['dependency'],
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'penci_google_fonts',
				'heading'    => '',
				'param_name' => $args['prefix'] . '_fonts',
				'value'      => $args['google_fonts'],
				'group'      => $group_typo,
				'dependency' => $args['dependency'],
			)
		);

		if ( $args['font_style'] ) {
			$typo[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Font style', 'penci-framework' ),
				'param_name' => $args['prefix'] . '_font_style',
				'std'        => $args['font_style'],
				'value'      => array(
					esc_html__( 'Normal', 'penci-framework' )  => 'normal',
					esc_html__( 'Italic', 'penci-framework' )  => 'italic',
					esc_html__( 'Oblique', 'penci-framework' ) => 'oblique',
				),
				'dependency' => $args['dependency'],
				'group'      => $group_typo,
			);
		}

		$typo[] = array(
			'type'             => 'penci_number',
			'param_name'       => $args['prefix'] . '_font_size',
			'heading'          => esc_html__( 'Font size', 'penci-framework' ),
			'value'            => '',
			'std'              => $args['font-size'],
			'suffix'           => 'px',
			'min'              => 1,
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'       => $args['dependency'],
			'group'            => $group_typo,
		);

		return $typo;
	}

	public static function block_option_note_custom_fonts(){
		$custom_markup  = '<span class="vc_description vc_clearfix">';
		$custom_markup .= '<span style="color: red;font-weight: bold;">Note Important</span>: You can add more fonts to select list fonts <a target="_blank" href="' . admin_url( 'admin.php?page=pennews_custom_fonts' ) . '">here</a>. ';
		$custom_markup .=  'Check video tutorial for this <a href="#">here</a>';
		$custom_markup .= '</span>';

		return array(
			array(
				'param_name'  => 'custom_markup_1',
				'type'        => 'custom_markup',
				'description' => $custom_markup,
				'group'       => 'Typo',
			),
		);
	}

	public static function block_option_typo_heading() {



		$output = array_merge(
			self::block_option_note_custom_fonts(),
			self::block_option_typo(
				array(
					'prefix'       => 'block_title',
					'title'        => esc_html__( 'Block title settings' ),
					'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
					'font-size'    => '18px',
				)
			),
			self::block_option_typo(
				array(
					'prefix'       => 'link_filter',
					'title'        => esc_html__( 'Link filter settings' ),
					'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
					'font-size'    => '13px',
				)
			)
		);

		return $output;
	}

	public static function block_option_typo_cat() {
		$output = array_merge(
			self::block_option_typo(
				array(
					'prefix'       => 'cat',
					'title'        => esc_html__( 'Categories settings' ),
					'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
					'font-size'    => '10px',
				)
			)
		);

		return $output;
	}

	public static function block_option_infeed_ad( ) {
		return array(
			array(
				'type'             => 'textfield',
				'param_name'       => 'heading_ajax_pagination_settings',
				'heading'          => 'Infeed ads settings',
				'value'            => '',
				'edit_field_class' => 'penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Insert Ads code after post:', 'penci-framework' ),
				'param_name' => 'infeed_ads__order',
				'value'      => '2',
			),
			array(
				'type' => 'textarea_raw_html',
				'holder' => 'div',
				'heading' => __( 'In-feed Ad Code', 'penci-framework' ),
				'param_name' => 'content',
			),
		);
	}

	public static function block_option_image_type( $default = 'landscape' ) {
		return array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Image Type', 'penci-framework' ),
				'param_name' => 'image_type',
				'value'      => array(
					__( 'Square', 'penci-framework' )    => 'square',
					__( 'Vertical', 'penci-framework' )  => 'vertical',
					__( 'Landscape', 'penci-framework' ) => 'landscape',
					__( 'Custom', 'penci-framework' )    => 'custom',
				),
				'std'        => $default,
			)
		);
	}

	public static function block_option_image_size( $args = null ) {
		$default = array(
			'thumbnail_size_key'    => 'image_size',
			'thumbnail_size_label'  => __( 'Image size', 'penci-framework' ),
			'thumbnail_size_df'     => 'penci-thumb-480-320',
			'thumbnail_ratio_key'   => 'image_ratio',
			'thumbnail_ratio_label' => __( 'Image ratio', 'penci-framework' ),
			'thumbnail_ratio_df'    => 0.67,
		);

		$r = wp_parse_args( $args, $default );

		return array(
			array(
				'type'        => 'penci_only_number',
				'heading'     => $r['thumbnail_ratio_label'],
				'param_name'  => $r['thumbnail_ratio_key'],
				'class'       => '',
				'value'       => $r['thumbnail_ratio_df'],
				'min'         => 0.1,
				'max'         => 2,
				'step'        => 0.1,
				'dependency'  => array( 'element' => 'image_type', 'value' => 'custom' ),
				'description' => esc_html__( 'Please enter a valid value. min is 0.1 and max is 2', 'penci-framework' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => $r['thumbnail_size_label'],
				'param_name' => $r['thumbnail_size_key'],
				'std'        => $r['thumbnail_size_df'],
				'value'      => penci_pennews_get_list_image_sizes()
			),
		);
	}

	public static function  build_query( ){
		$group_filter = 'Build query';
		
		return array(
			array(
				'type' => 'checkbox',
				'heading' => __( 'Post types', 'penci-framework' ),
				'param_name' => 'post_types',
				'value' => Penci_Framework_Helper::get_all_post_types(),
				'group'       => $group_filter,
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'penci-framework' ),
				'value'       => 12,
				'param_name'  => 'per_page',
				'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'penci-framework' ),
				'group'       => $group_filter,
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'penci-framework' ),
				'param_name'  => 'orderby',
				'value'       => array(
					'',
					__( 'Date', 'penci-framework' )          => 'date',
					__( 'ID', 'penci-framework' )            => 'ID',
					__( 'Author', 'penci-framework' )        => 'author',
					__( 'Title', 'penci-framework' )         => 'title',
					__( 'Modified', 'penci-framework' )      => 'modified',
					__( 'Random', 'penci-framework' )        => 'rand',
					__( 'Comment count', 'penci-framework' ) => 'comment_count',
					__( 'Menu order', 'penci-framework' )    => 'menu_order',
				),
				'group'       => $group_filter,
				'description' => sprintf( __( 'Select how to sort retrieved portfolio. More at %s.', 'penci-framework' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'penci-framework' ),
				'param_name'  => 'order',
				'value'       => array(
					'',
					__( 'Descending', 'penci-framework' ) => 'DESC',
					__( 'Ascending', 'penci-framework' )  => 'ASC',
				),
				'group'       => $group_filter,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'penci-framework' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
			),
			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Categories', 'penci-framework' ),
				'param_name'  => 'ids',
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'groups' => true,
					'values'   => array( // Using key 'values' will disable an AJAX requests on autocomplete input and also any filter for suggestions
						array( 'label' => 'Abrams', 'value' => 1, 'group' => 'category' ),
						array( 'label' => 'Brama', 'value' => 2, 'group' => 'category' ),
						array( 'label' => 'Dron', 'value' => 3, 'group' => 'tags' ),
						array( 'label' => 'Akelloam', 'value' => 4, 'group' => 'tags' ),
						// Label will show when adding
						// Value will saved in input
						// Group only used if groups=>true, this will group data in select dropdown by groups
					),
				),
				'save_always' => true,
				'group'       => $group_filter,
				'description' => __( 'List of portfolio categories', 'penci-framework' ),

			),
			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Type a for example', 'penci-framework' ),
				'param_name'  => 'ids',
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'min_length' => 1,
					'no_hide' => true, // In UI after select doesn't hide an select list
					'groups' => true, // In UI show results grouped by groups
					'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
					'display_inline' => true, // In UI show results inline view
					'values'   => array( // Using key 'values' will disable an AJAX requests on autocomplete input and also any filter for suggestions
						array( 'label' => 'Abrams', 'value' => 1, 'group' => 'category' ),
						array( 'label' => 'Brama', 'value' => 2, 'group' => 'category' ),
						array( 'label' => 'Dron', 'value' => 3, 'group' => 'tags' ),
						array( 'label' => 'Akelloam', 'value' => 4, 'group' => 'tags' ),
						// Label will show when adding
						// Value will saved in input
						// Group only used if groups=>true, this will group data in select dropdown by groups
					),
				),
				'description' => __( '', 'penci-framework' ),
			),
		);
	}
}
