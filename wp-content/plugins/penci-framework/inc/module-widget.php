<?php

class Penci_Framework_Widget extends WP_Widget {

	var $block_id = 0;

	/**
	 * Class constructor
	 */
	public function __construct() {

		$block_id  = $this->block_id;
		$map_array = $this->map_array( $block_id );

		if ( empty( $map_array ) ) {
			return;
		}
		//print_rmd( $this->map_default_array );

		add_filter( 'penci_widget_default_array', array( $this, 'update_default_array' ), 10, 2 );

		$id_widget    = 'penci-widget__' . $block_id;
		$class_widget = 'penci-block-vc penci-widget penci-' . $block_id . ' ' . $id_widget;
		$name_widget  = isset( $map_array['name'] ) ? $map_array['name'] : '';
		$desc         = isset( $map_array['description'] ) ? $map_array['description'] : esc_html__( 'Show Shortcode ', 'penci-framework' ) . $name_widget;

		$widget_ops = array(
			'classname'   => $class_widget,
			'description' => $desc,
		);
		parent::__construct( $id_widget, '.PenNews: ' . $name_widget, $widget_ops );
	}


	/**
	 * Display front end widget
	 *
	 * @param array $args Sidebar arguments
	 * @param array $instance Widget instance parameters
	 */
	public function widget( $args, $instance ) {

		preg_match( '/class="(.+)"/', $args['before_widget'], $matches_class );
		preg_match( '/id="(.+)" class/', $args['before_widget'], $matches_id );

		$instance = $atts = wp_parse_args( $instance, $this->map_default_array() );

		$atts['style_block_title']         = '';
		$instance['style_block_title']     = '';
		$atts['block_title_fonts']         = '';
		$instance['block_title_fonts']     = '';
		$atts['block_title_font_size']     = '';
		$instance['block_title_font_size'] = '';


		$atts['class']    = isset( $matches_class[1] ) ? $matches_class[1] : ( isset( $matches_class[0] ) ? str_replace( '"', '', $matches_class[0] ) : '' );
		$atts['block_id'] = isset( $matches_id[1] ) ? $matches_id[1] : ( isset( $matches_id[0] ) ? str_replace( '" class', '', $matches_id[0] ) : '' );

		$content = null;

		if ( isset( $atts['videos_list'] ) ) {
			$videos_list         = explode( "\n", $atts['videos_list'] );
			$atts['videos_list'] = implode( ',', $videos_list );

			wp_enqueue_style( 'mCustomScrollbar', get_template_directory_uri() . '/css/mCustomScrollbar.css', array(), PENCI_FW_VERSION );
		}

		if ( isset( $atts['build_query'] ) && ! $atts['build_query'] && class_exists( 'PenciLoopSettings' ) ) {
			$build_query = '';
			$loop_settings = new PenciLoopSettings( '' );
			$loop_params        = $loop_settings->get_query_parts();

			foreach ( $loop_params as $loop_param ) {
				if ( isset( $atts['build_query_'. $loop_param ] ) && $atts['build_query_'. $loop_param ] ) {
					if( $build_query ) {
						$build_query .= '|';
					}

					if ( is_array( $atts[ 'build_query_' . $loop_param ] ) ) {
						$build_query .= $loop_param . ':' . reset( $atts[ 'build_query_' . $loop_param ] );
					} else {
						$build_query .= $loop_param . ':' . $atts[ 'build_query_' . $loop_param ];
					}
				}

				if ( isset( $atts['build_query_'. $loop_param ] ) ){
					unset($atts['build_query_'. $loop_param ]);
				}
			}

			$atts['build_query'] = $build_query;
		}

		if ( isset( $atts['content'] ) && $atts['content'] ) {
			$content = $atts['content'];
		}

		ob_start();
		include( PENCI_ADDONS_DIR . "shortcodes/{$this->block_id}/frontend.php" );
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	/**
	 * Update widget parameters
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$instance =  $old_instance;

		$map_default_array = $this->map_default_array();

		foreach ( $map_default_array as $param_name => $param_value ) {

			if ( false !== strpos( $param_name, '_fonts' ) ) {
				$_font_family            = isset( $new_instance[ $param_name . '_font_family' ] ) ? $new_instance[ $param_name . '_font_family' ] : '';
				$_font_style             = isset( $new_instance[ $param_name . '_font_style' ] ) ? $new_instance[ $param_name . '_font_style' ] : '';
				$instance[ $param_name ] = $_font_family . $_font_style;
			} else {
				$instance[ $param_name ] = isset( $new_instance[ $param_name ] ) ? $new_instance[ $param_name ] : '';
			}

		}

		$atts = $new_instance;
		if ( isset( $old_instance['build_query'] ) && class_exists( 'PenciLoopSettings' ) ) {
			$build_query = '';
			$loop_settings = new PenciLoopSettings( '' );
			$loop_params        = $loop_settings->get_query_parts();

			foreach ( $loop_params as $loop_param ) {

				if ( isset( $atts['build_query_'. $loop_param ] ) && $atts['build_query_'. $loop_param ] ) {
					if( $build_query ) {
						$build_query .= '|';
					}

					$build_query .= $loop_param . ':';
					if( is_array( $atts['build_query_'. $loop_param ] ) && $atts['build_query_'. $loop_param ] ){
						$build_query .=  implode( ',', $atts['build_query_'. $loop_param ] );
					}else{
						$build_query .= $atts['build_query_'. $loop_param ];
					}

				}
			}

			$instance['build_query'] = $build_query;
		}

		return $instance;
	}

	/**
	 * Display backend widget form in the admin
	 *
	 * @param array $instance Widget instance parameter
	 *
	 * @return void
	 */
	public function form( $instance ) {

		if ( is_customize_preview() ) {
			return;
		}
		$instance = wp_parse_args( $instance, $this->map_default_array() );
		$settings = $this->map_array( $this->block_id );

		if ( empty( $settings['params'] ) ) {
			return;
		}

		$group_params = $this->group_params( $settings['params'] );

		$this->list_tab_group( $group_params );

//		echo '<pre>';
//		print_r( $group_params );
//		echo '</pre>';

		echo '<div class="penci-tab-content-widget">';

		$i = 0;
		foreach ( $group_params as $id_group => $params ) {
			$i ++;


			echo '<div id="' . strtolower( $id_group ) . '" class="tab-content" style="' . ( $i > 1 ? 'display:none;' : '' ) . '" >';

			foreach ( $params as $param ) {

				if ( 'dropdown' == $param['type'] && 'style_pag' == $param['param_name'] ) {
					$param['value'] = array(
						esc_html__( '- No pagination -', 'penci-framework' ) => '',
						esc_html__( 'Next Prev Ajax', 'penci-framework' )    => 'next_prev',
						esc_html__( 'Load More Button', 'penci-framework' )  => 'load_more',
					);
				}

				$heading = isset( $param['heading'] ) ? $param['heading'] : '';

				$edit_field_class = isset( $param['edit_field_class'] ) ? $param['edit_field_class'] : '';
				?>
				<p class="penci-field-item <?php echo esc_attr( $edit_field_class ); ?>">
					<?php if ( $heading ): ?>
						<label for="<?php echo esc_attr( $this->get_field_id( $param['param_name'] ) ); ?>"><?php echo ( $heading ); ?></label>
					<?php endif; ?>
					<?php
					switch ( $param['type'] ) {
						case 'exploded_textarea':
						case 'textarea_html':
							$this->form_textarea_html( $param['param_name'], $instance );
							break;
						case 'attach_image':
							$this->form_attach_image( $param['param_name'], $instance );
							break;
						case 'dropdown':
						case 'penci_image_select':
							$this->form_dropdown( $param, $instance );
							break;

						case 'checkbox':
							$this->form_checkbox( $param['param_name'], $instance );
							break;

						case 'loop':
							$this->form_loop( $param['param_name'], $instance );
							break;

						case 'href':
						case 'autocomplete':
						case 'textarea_raw_html':
						case 'textfield':

							if ( isset( $param['edit_field_class'] ) && false !== strpos( $param['edit_field_class'], 'penci-param-heading-wrapper' ) ) {
								$this->form_heading( $param['param_name'], $instance );
							} else {
								$this->form_textfield( $param['param_name'], $instance );
							}

							break;
						case 'penci_number':
							$this->form_textfield( $param['param_name'], $instance );
							break;
						case 'penci_google_fonts':
							$this->form_google_fonts( $param, $instance );
							break;
						case 'colorpicker':
							$this->form_colorpicker( $param['param_name'], $instance );
							break;
					}
					?>
					<?php echo( isset( $param['description'] ) ? '<span class="penci-widget-desc">' . $param['description'] . '</span>' : '' ); ?>
				</p>
				<?php
			}
			echo '</div>';


		}
		echo '</div>';
	}

	public function map_array( $block_id ) {
		$settings = include PENCI_ADDONS_DIR . "/shortcodes/{$block_id}/settings.php";

		return $settings;
	}

	/**
	 * Get value default with option
	 *
	 * @return array
	 */
	public function map_default_array() {
		$settings = $this->map_array( $this->block_id );
		$default  = array();
		if ( empty( $settings['params'] ) ) {
			return $default;
		}

		$remove = $this->get_option_dont_need();

		foreach ( $settings['params'] as $param ) {
			if ( ! isset( $param['param_name'] ) ) {
				continue;
			}

			if ( in_array( $param['param_name'], $remove ) ) {
				continue;
			}

			$option_id   = $param['param_name'];
			$option_type = $param['type'];

			$value_default = isset( $param['std'] ) ? $param['std'] : '';

			if ( 'penci_google_fonts' == $option_type && empty( $value_default ) ) {
				$value_default = isset( $param['value'] ) ? $param['value'] : '';
			}

			$default[ $option_id ] = $value_default;

			if( 'loop' == $option_type && class_exists( 'PenciLoopSettings' ) ) {
				$loop_settings = new PenciLoopSettings( '' );
				$loop_params        = $loop_settings->get_query_parts();

				foreach ( $loop_params as $loop_param ) {
					$loop_param_val = isset( $param['settings'][$loop_param]['value'] ) ? $param['settings'][$loop_param]['value'] : '';
					$default[ 'build_query_' . $loop_param ] = $loop_param_val;
				}
			}

		}

		$default = apply_filters( "penci_widget_default_array", $default, $this->block_id );

		return $default;

	}

	public function update_default_array( $default, $block_id ) {

		if ( 'block_25' == $block_id ) {
			$default['hide_cat']              = 1;
			$default['hide_comment']          = 1;
			$default['hide_count_view']       = 1;
			$default['hide_review_piechart']  = 1;
			$default['hide_icon_post_format'] = 1;
		} elseif ( 'block_16' == $block_id ) {
			$default['limit']                 = 5;
			$default['limit_loadmore']        = 4;
			$default['hide_cat']              = 1;
			$default['hide_comment']          = 1;
			$default['hide_count_view']       = 1;
			$default['hide_review_piechart']  = 1;
			$default['hide_icon_post_format'] = 1;
		} elseif ( 'block_23' == $block_id ) {
			$default['hide_cat']              = 1;
			$default['hide_comment']          = 1;
			$default['hide_count_view']       = 1;
			$default['hide_icon_post_format'] = 1;
		}

		return $default;
	}


	public function group_params( $params ) {
		$group_params = array();

		if ( empty( $params ) ) {
			return $group_params;
		}

		$remove = $this->get_option_dont_need();

		foreach ( $params as $param ) {
			if ( empty( $param['type'] ) || empty( $param['param_name'] ) ) {
				continue;
			}

			if ( in_array( $param['param_name'], $remove ) ) {
				continue;
			}

			$group_name = isset( $param['group'] ) ? str_replace( ' ', '_', $param['group'] ) : 'General';

			if ( ! isset( $group_params[ $group_name ] ) ) {
				$group_params[ $group_name ] = array();
			}

			$group_params[ $group_name ][] = $param;
		}

		return $group_params;
	}

	public function list_tab_group( $group_params ) {
		$tabs       = array_keys( $group_params );
		$count_tabs = count( (array)$tabs );
		if ( $count_tabs < 2 ) {
			return '';
		}

		echo '<div class="penci-tab-widget nav-tab-wrapper">';
		$i = 0;
		foreach ( $tabs as $tab ) {
			printf( '<a class="nav-tab%s" href="%s">%s</a>',
				$i < 1 ? ' nav-tab-active' : '',
				'#' . strtolower( $tab ),
				$tab
			);

			$i ++;
		}
		echo '</div>';
	}

	/**
	 * Show html form type attach image
	 *
	 * @param $param
	 * @param $instance
	 */
	public function form_attach_image( $param_name, $instance ) {
		$url = wp_get_attachment_thumb_url( $instance[ $param_name ] );

		?>
		<div class="penci-widget-image media-widget-control">
			<input name="<?php echo esc_attr( $this->get_field_name( $param_name ) ); ?>" type="hidden" class="penci-widget-image__input" value="<?php echo esc_attr( $instance[ $param_name ] ); ?>">
			<img src="<?php echo esc_url( $url ); ?>" class="penci-widget-image__image<?php echo $instance[ $param_name ] ? '' : ' hidden'; ?>">
			<div class="placeholder <?php echo( $url ? 'hidden' : '' ); ?>"><?php _e( 'No image selected' ); ?></div>
			<button class="button penci-widget-image__select"><?php esc_html_e( 'Select' ); ?></button>
			<button class="button penci-widget-image__remove"><?php esc_html_e( 'Remove' ); ?></button>
		</div>
		<?php
	}

	public function form_loop( $param_name, $instance ) {
		if( ! class_exists( 'PenciLoopSettings' ) ){
			return;
		}

		$loop_settings = new PenciLoopSettings( '' );
		$params        = $loop_settings->get_query_parts();

		if ( empty( $params ) ) {
			return;
		}


		echo '<a href="#" class="button penci-loop-build">Build query</a>';
		echo '<span class="penci-build-query">';

		foreach ( $params as $param ) {
			if ( 'post_type' == $param ) {

				$post_types = get_post_types( array( 'public' => true ) );

				if( isset( $post_types['attachment'] ) ) {
					unset( $post_types['attachment'] );
				}
				if( isset( $post_types['penci_slider'] ) ) {
					unset( $post_types['penci_slider'] );
				}

				if( $post_types ) {
					$val_bquery_ptype = (array)$instance[ 'build_query_' . $param ];
					echo '<span class="penci-bquery-ele penci-bquery-post">';
					echo '<label>' . esc_html__( 'Post types', 'penci-framework' ) . '</label><br>';
						foreach ( $post_types as $post_type ) {
							echo '<label><input type="checkbox" name="' . esc_attr( $this->get_field_name( 'build_query_' . $param ) ) . '[]" value="' . $post_type . '" ' .  (  in_array( $post_type, $val_bquery_ptype  ) ? 'checked="true"' : '' ) . '>' . $post_type . '&nbsp;</label>';
						}
					echo '<span class="penci-widget-desc">' . esc_html__( 'Select post types to populate posts from. Note: If no post type is selected, WordPress will use default "Post" value.', 'penci-framework' ) . '</span>';
					echo '</span>';
				}
			} elseif ( 'size' == $param ) {
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Post count', 'penci-framework' ) . '</label>';
				$this->form_textfield( 'build_query_' . $param, $instance );
				echo '<span class="penci-widget-desc">' . esc_html__( 'How many teasers to show? Enter number.', 'penci-framework' ) . '</span>';
				echo '</span>';
			}elseif ( 'offset' == $param ) {
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Offset posts', 'penci-framework' ) . '</label>';
				$this->form_textfield( 'build_query_' . $param, $instance );
				echo '<span class="penci-widget-desc">' . esc_html__( 'Start the count with an offset.Enter number.', 'penci-framework' ) . '</span>';
				echo '</span>';
			} elseif ( 'order_by' == $param ) {

				$param = array(
					'param_name' => 'build_query_order_by',
					'value'      => array(
						esc_html__( '-- Default --', 'penci-framework' )                 => '',
						esc_html__( 'Date', 'penci-framework' )                          => 'date',
						esc_html__( 'Random', 'penci-framework' )                        => 'rand',
						esc_html__( 'Random posts Today', 'penci-framework' )            => 'random_today',
						esc_html__( 'Random posts from last 7 days', 'penci-framework' ) => 'random_7_day',
						esc_html__( 'Alphabetical ( A - Z )', 'penci-framework' )        => 'alphabetical_order',
						esc_html__( 'Popular posts in all time', 'penci-framework' )    => 'popular',
						esc_html__( 'Popular posts in once month', 'penci-framework' )   => 'popular_month',
						esc_html__( 'Popular posts in once week', 'penci-framework' )    => 'popular7',
						esc_html__( 'Review score number', 'penci-framework' )           => 'review',
						esc_html__( 'ID', 'penci-framework' )                            => 'ID',
						esc_html__( 'Author', 'penci-framework' )                        => 'author',
						esc_html__( 'Title', 'penci-framework' )                         => 'title',
						esc_html__( 'Modified', 'penci-framework' )                      => 'modified',
						esc_html__( 'Random', 'penci-framework' )                        => 'rand',
						esc_html__( 'Comment count', 'penci-framework' )                 => 'comment_count',
						esc_html__( 'Menu order', 'penci-framework' )                    => 'menu_order',
					)
				);
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Order by', 'penci-framework' ) . '</label>';
				$this->form_dropdown( $param, $instance );
				echo '<span class="penci-widget-desc">' . __( 'Select how to sort retrieved posts.', 'penci-framework' ) . '</span>';
				echo '</span>';
			} elseif ( 'order' == $param ) {
				$param = array(
					'param_name' => 'build_query_order',
					'value'      => array(
						esc_html__( '-- Default --', 'penci-framework' ) => '',
						esc_html__( 'Ascending', 'penci-framework' )     => 'ASC',
						esc_html__( 'Descending', 'penci-framework' )    => 'DESC',
					)
				);
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Sort order', 'penci-framework' ) . '</label>';
				$this->form_dropdown( $param, $instance );
				echo '<span class="penci-widget-desc">' . esc_html__( 'Designates the ascending or descending order', 'penci-framework' ) . '</span>';
				echo '</span>';
			} elseif ( 'categories' == $param ) {
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Categories', 'penci-framework' ) . '</label>';
				$this->form_textfield( 'build_query_' . $param, $instance );
				echo '<span class="penci-widget-desc">' . __( 'Filter output by posts categories, enter category IDs here. Fill here the category IDs separated by commas ( Ex: 4,13,20 ). To exclude categories add them with \'-\' ( ex: -5, -7 ). Check <a href="http://pennews.pencidesign.com/pennews-document/images/category_ID.png" target="_blank">this image</a> to know how to find ID of a category.', 'penci-framework' ) . '</span>';
				echo '</span>';
			} elseif ( 'tags' == $param ) {
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Tags', 'penci-framework' ) . '</label>';
				$this->form_textfield( 'build_query_' . $param, $instance );
				echo '<span class="penci-widget-desc">' . __( 'Filter output by posts tags, enter tag IDs here. Fill here the tag IDs separated by commas ( Ex: 4,13,20 ). To exclude tags add them with \'-\' ( ex: -5, -7 ). Check <a href="http://pennews.pencidesign.com/pennews-document/images/tag_ID.png" target="_blank">this image</a> to know how to find ID of a tag.', 'penci-framework' ) . '</span>';
				echo '</span>';
			} elseif ( 'tax_query' == $param ) {
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Taxonomies', 'penci-framework' ) . '</label>';
				$this->form_textfield( 'build_query_' . $param, $instance );
				echo '<span class="penci-widget-desc">' . __( 'Filter output by custom taxonomies categories, enter taxonomy IDs here. Fill here the taxonomy IDs separated by commas ( Ex: 4,13,20 ). To exclude taxonomies add them with \'-\' ( ex: -5, -7 ).The way to find taxonomy IDs like above.', 'penci-framework' ) . '</span>';
				echo '</span>';
			} elseif ( 'by_id' == $param ) {
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Individual Posts/Pages/Custom Post Types', 'penci-framework' ) . '</label>';
				$this->form_textfield( 'build_query_' . $param, $instance );
				echo '<span class="penci-widget-desc">' . __( 'Only entered posts/pages will be included in the output. Note: Works in conjunction with selected "Post types". Fill here the post IDs separated by commas ( Ex: 2,3,8 ). To exclude posts add them with \'-\' ( ex: -5, -7 ).  Check <a href="http://pennews.pencidesign.com/pennews-document/images/post_ID.jpg" target="_blank">this image</a> to know how to find ID of a post/page.', 'penci-framework' ) . '</span>';
				echo '</span>';
			} elseif ( 'authors' == $param ) {
				echo '<span class="penci-bquery-ele">';
				echo '<label>' . esc_html__( 'Author', 'penci-framework' ) . '</label>';
				$this->form_textfield( 'build_query_' . $param, $instance );
				echo '<span class="penci-widget-desc">' . __( 'Filter by author ID. Fill here the author IDs separated by commas ( Ex: 2,3,8 ). To exclude authors add them with \'-\' ( ex: -5, -7 )', 'penci-framework' ) . '</span>';
				echo '</span>';
			}
		}

		echo '</span>';
	}

	/**
	 * Show html form type textfield
	 *
	 * @param $param_name
	 * @param $instance
	 */
	public function form_textfield( $param_name, $instance ) {

		?>
		<input id="<?php echo esc_attr( $this->get_field_id( $param_name ) ); ?>" class="widefat" type="text" name="<?php echo esc_attr( $this->get_field_name( $param_name ) ); ?>" value="<?php echo esc_attr( $instance[ $param_name ] ) ?>" / >
		<?php
	}

	public function form_heading( $param_name, $instance ) {
	}

	/**
	 * Show html form type textarea
	 *
	 * @param $param_name
	 * @param $instance
	 */
	public function form_textarea_html( $param_name, $instance ) {
		?>
		<textarea id="<?php echo esc_attr( $this->get_field_id( $param_name ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( $param_name ) ); ?>"><?php echo esc_textarea( $instance[ $param_name ] ) ?></textarea>
		<?php
	}

	/**
	 * Show html form type dropdown
	 *
	 * @param $param
	 * @param $instance
	 */
	public function form_dropdown( $param, $instance ) {
		?>
		<select name="<?php echo $this->get_field_name( $param['param_name'] ); ?>" id="<?php echo $this->get_field_id( $param['param_name'] ); ?>" class="widefat">
			<?php
			foreach ( $param['value'] as $param_name => $param_value ) {

				?>
				<option value="<?php echo $param_value; ?>"<?php selected( $instance[ $param['param_name'] ], $param_value ); ?>><?php echo $param_name; ?></option>
				<?php
			}
			?>
		</select>
		<?php
	}

	/**
	 * Show html form type checkbox
	 *
	 * @param $param_name
	 * @param $instance
	 */
	public function form_checkbox( $param_name, $instance ) {
		?>
		<input class="penci-checkbox" id="<?php echo esc_attr( $this->get_field_id( $param_name ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $param_name ) ); ?>" type="checkbox" value="1" <?php checked( $instance[ $param_name ] ); ?>>
		<?php
	}


	public function form_google_fonts( $param, $instance ) {

		if( ! class_exists( 'Vc_Google_Fonts' ) ){
			return;
		}

		$value = isset( $instance[ $param['param_name'] ] ) ? $instance[ $param['param_name'] ] : '';

		$google_fonts = new Vc_Google_Fonts();
		$values       = vc_parse_multi_attribute( $value, array(
			'font_family' => '',
			'font_style'  => '',
		) );

		$fonts = $google_fonts->_vc_google_fonts_get_fonts();


		?>
		<label><?php esc_html_e( 'Font family', 'penci-framework' ); ?></label>
		<select name="<?php echo $this->get_field_name( $param['param_name'] . '_font_family' ); ?>" id="<?php echo $this->get_field_id( $param['param_name'] . '_font_family' ); ?>_font_family" class="widefat">
			<?php foreach ( $fonts as $font_data ) : ?>
				<option
					value="font_family:<?php echo $font_data->font_family . '|'; ?>" <?php echo( strtolower( $values['font_family'] ) == strtolower( $font_data->font_family ) || strtolower( $values['font_family'] ) == strtolower( $font_data->font_family ) . ':' . $font_data->font_styles ? 'selected' : '' ); ?> ><?php echo $font_data->font_family ?></option>
			<?php endforeach ?>
		</select>
		<label><?php esc_html_e( 'Font family', 'penci-framework' ); ?></label>
		<select name="<?php echo $this->get_field_name( $param['param_name'] . '_font_style' ); ?>" id="<?php echo $this->get_field_id( $param['param_name'] . '_font_style' ); ?>" class="widefat">
			<option value="font_style:100%20regular%3A100%3Anormal" <?php selected( $values['font_style'], '100 regular:100:normal' ); ?>>100</option>
			<option value="font_style:200%20regular%3A100%3Anormal" <?php selected( $values['font_style'], '200 regular:100:normal' ); ?>>200</option>
			<option value="font_style:300%20regular%3A300%3Anormal" <?php selected( $values['font_style'], '300 regular:300:normal' ); ?>>300</option>
			<option value="font_style:400%20regular%3A400%3Anormal" <?php selected( $values['font_style'], '400 regular:400:normal' ); ?>>400</option>
			<option value="font_style:500%20medium%3A500%3Anormal" <?php selected( $values['font_style'], '500 medium:500:normal' ); ?>>500</option>
			<option value="font_style:600%20medium%3A600%3Anormal" <?php selected( $values['font_style'], '600 medium:600:normal' ); ?>>600</option>
			<option value="font_style:700%20bold%20regular%3A700%3Anormal" <?php selected( $values['font_style'], '700 bold regular:700:normal' ); ?>>700</option>
			<option value="font_style:800%20bold%20regular%3A800%3Anormal" <?php selected( $values['font_style'], '800 bold regular:800:normal' ); ?>>800</option>
			<option value="font_style:900%20bold%20regular%3A900%3Anormal" <?php selected( $values['font_style'], '900 bold regular:900:normal' ); ?>>900</option>
		</select>
		<?php
	}

	/**
	 * Show html form type colorpicker
	 *
	 * @param $param_name
	 * @param $instance
	 */
	public function form_colorpicker( $param_name, $instance ) {

		$color = ! empty( $instance[ $param_name ] ) ? $instance[ $param_name ] : '';
		?>
		<span class="penci-picker-container">
		<input id="<?php echo esc_attr( $this->get_field_id( $param_name ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $this->get_field_name( $param_name ) ); ?>" value="<?php echo $color; ?>" / >
		</span>
		<?php
	}


	/**
	 * Get shortcode class instance.
	 *
	 */
	public function getShortCode() {
		return "penci_{$this->block_id}";
	}

	/**
	 * @param $css_animation
	 *
	 * @return string
	 */
	public function getCSSAnimation( $css_animation ) {
		$output = '';
		if ( '' !== $css_animation ) {
			wp_enqueue_script( 'waypoints' );
			$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
		}

		return $output;
	}

	public function get_option_dont_need() {
		return array(
			'style_block_title',
			'color_genral_css',
			'bordertop_color',
			'background_title_color',
			'title_color',
			'title_hover_color',
			'border_title_color',
			'block_title_align',
			'block_title_meta_settings',
			'block_title_off_uppercase',
			'block_title_typography',
			'block_title_fonts',
			'block_title_font_size',
			'add_title_icon',
			'title_i_align',
			'title_icon',
			'dis_bg_block',
			'block_title_wborder_left_right',
			'block_title_wborder',
			'border_left_right_color',
			'border_color_title_s10',
			'bg_logged',
			'pagination_css',
			'pagi_number_color',
			'pagi_number_bg_color',
			'pagi_number_hcolor',
			'pagi_number_bg_hcolor',
			'pagi_number_color',
			''
		);
	}

}