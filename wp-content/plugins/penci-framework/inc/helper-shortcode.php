<?php

class Penci_Helper_Shortcode {

	public function __construct() {

		add_filter( 'penci_after_block_items', array( __CLASS__, 'get_html_ajax_loading' ) );
		add_filter( 'penci_blockvc_before_post_items', array( __CLASS__, 'blockvc_before_post_items' ), 10, 2 );
		add_filter( 'penci_blockvc_after_post_items', array( __CLASS__, 'blockvc_after_post_items' ) );
	}

	/*
	 * Show shortcode with each device
	 */
	public static function show_on_shortcode( $atts ) {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return true;
		}
		$show_on = true;
		$detect  = new Mobile_Detect;

		if ( isset( $atts['penci_show_desk'] ) && ! $atts['penci_show_desk'] && ! $detect->isMobile() && ! $detect->isTablet() ) {
			$show_on = false;
		}

		if ( isset( $atts['penci_show_tablet'] ) && ! $atts['penci_show_tablet'] && $detect->isTablet() ) {
			$show_on = false;
		}

		if ( isset( $atts['penci_show_mobile'] ) && ! $atts['penci_show_mobile'] && $detect->isMobile() ) {
			$show_on = false;
		}

		return $show_on;
	}

	/**
	 * Renders the block title
	 *
	 * @param      $atts
	 * @param bool $show
	 *
	 * @return string
	 */
	public static function get_block_title( $atts, $show = true ) {

		$atts = shortcode_atts( array(
				'title'           => '',
				'block_title_url' => '',
				'add_title_icon'  => '',
				'title_i_align'   => 'left',
				'title_icon'      => ''
			), $atts );

		if ( empty( $atts['title'] ) ) {
			return '';
		}


		$output = '<h3 class="penci-block__title">';
		$output .= ( ! empty( $atts['block_title_url'] ) ? '<a href="' . esc_url( $atts['block_title_url'] ) . '" title="' . $atts['title'] . '">' : '<span>' );
		$output .= $atts['add_title_icon'] && $atts['title_icon'] && 'left' == $atts['title_i_align'] ? '<i class="fa-pos-left ' . $atts['title_icon'] . '"></i>' : '';
		$output .= $atts['title'];
		$output .= $atts['add_title_icon'] && $atts['title_icon'] && 'right' == $atts['title_i_align'] ? '<i class="fa-pos-right ' . $atts['title_icon'] . '"></i>' : '';
		$output .= ( ! empty( $atts['block_title_url'] ) ? '</a >' : '</span>' );
		$output .= '</h3>';

		if ( ! $show ) {
			return $output;
		}
		echo $output;
	}

	/**
	 * Renders the filter of the block
	 *
	 * @param      $atts
	 * @param      $shortcode_id
	 * @param bool $show
	 *
	 * @return string
	 */
	public static function get_pull_down_filter( $atts, $shortcode_id, $unique_id, $show = true ) {
		$output = $subcat = '';

		$items = Penci_Framework_Helper::get_ajax_filter_item( $atts );

		if ( empty( $items ) ) {
			return $output;
		}

		$pull_down_wrapper_id = "penci_pulldown_" . $shortcode_id;

		$output .= '<div class="penci-subcat-filter" id="' . $pull_down_wrapper_id . '">';

		$output .= '<ul class="penci-subcat-list" id="' . $pull_down_wrapper_id . '_list">';
		foreach ( $items as $key => $item ) {
			$item_taxonomy = isset( $item['taxonomy'] ) ? $item['taxonomy'] : '';
			$html_item     = '<li class="penci-subcat-item"><a class="penci-subcat-link ' . ( $key < 1 ? 'active penci-subcat-item-1' : '' ) . '" data-filter_value="' . $item['id'] . '" data-filter_tax="' . $item_taxonomy . '"  data-block_id="' . $unique_id . '" href="#">' . do_shortcode( $item['name'] ) . '</a></li>';

			$output .= $html_item;
		}
		$output .= '</ul>';
		$output .= '</div>';

		if ( ! $show ) {
			return $output;
		}
		echo $output;
	}


	public static function add_cache_block( $atts, $unique_cache_id, $unique_id, $items, $args ) {
		if ( empty( $atts['ajax_filter_type'] ) && ( isset( $atts['style_pag'] ) && 'next_prev' != $atts['style_pag'] ) ) {
			return;
		}
		?>
        <script>
            (
                function () {
                    "use strict";
                    var <?php echo $unique_cache_id; ?>dataFilter = jQuery('#<?php echo $unique_id; ?>').data('atts_json');
                    var <?php echo $unique_cache_id; ?>responseData = {
                        items: '<?php echo $items; ?>',
                        hidePagNext: '',
                        hidePagPrev: '1',
                        args: '<?php echo json_encode( $args ); ?>'
                    };

					<?php if( ! empty( $atts['ajax_filter_type'] ) ): ?>
                    var <?php echo $unique_cache_id; ?>data = {
                        action: 'penci_ajax_block',
                        datafilter: <?php echo $unique_cache_id; ?>dataFilter,
                        styleAction: 'link',
                        nonce: '<?php echo wp_create_nonce( 'ajax-nonce' ); ?>'
                    };
                    PENCILOCALCACHE.set(JSON.stringify(<?php echo $unique_cache_id; ?>data), JSON.stringify(<?php echo $unique_cache_id; ?>responseData));
					<?php endif; ?>


					<?php if( ( isset( $atts['style_pag'] ) && 'next_prev' == $atts['style_pag'] ) ): ?>
                    var <?php echo $unique_cache_id; ?>data = {
                        action: 'penci_ajax_block',
                        datafilter: <?php echo $unique_cache_id; ?>dataFilter,
                        paged: '1',
                        styleAction: 'pagination',
                        nonce: '<?php echo wp_create_nonce( 'ajax-nonce' ); ?>'
                    };
                    PENCILOCALCACHE.set(JSON.stringify(<?php echo $unique_cache_id; ?>data), JSON.stringify(<?php echo $unique_cache_id; ?>responseData));
					<?php endif; ?>

                }
            )();
        </script>
		<?php
	}

	public static function get_block_script( $unique_id, $atts, $content = '' ) {

		$unset = array(
			'style_block_title',
			'title',
			'block_title_url',
			'ajax_filter_ids',
			'filter_default_txt',
			'css_animation',
			'css',
			'notification',
			'post_meta_css',
			'post_title_css',
			'next_prev',
			'pag_position',
			'class'

		);

		foreach ( $atts as $option => $value ) {
			if ( false !== strpos( $option, 'color' ) ) {
				unset( $atts[ $option ] );
			}

			if ( false !== strpos( $option, 'font' ) ) {
				unset( $atts[ $option ] );
			}

			if ( false !== strpos( $option, 'typography' ) ) {
				unset( $atts[ $option ] );
			}

			if ( false !== strpos( $option, 'heading' ) ) {
				unset( $atts[ $option ] );
			}

			if ( false !== strpos( $option, 'heading' ) ) {
				unset( $atts[ $option ] );
			}

			if ( in_array( $option, $unset ) ) {
				unset( $atts[ $option ] );
			}
		}

		$atts['category_ids'] = '';
		$atts['taxonomy']     = '';

		$output = '<script>';

		$output .= 'if( typeof(penciBlock) === "undefined" ) {';
		$output .= "function penciBlock() {
		    this.atts_json = '';
		    this.content = '';
		}";
		$output .= '}';
		$output .= 'var penciBlocksArray = penciBlocksArray || [];';
		$output .= 'var PENCILOCALCACHE = PENCILOCALCACHE || {};';
		$output .= 'var ' . $unique_id . ' = new penciBlock();';
		$output .= $unique_id . '.blockID="' . $unique_id . '";';
		$output .= $unique_id . ".atts_json = '" . json_encode( $atts ) . "';";

		if ( 'megamenu' != $atts['shortcode_id'] ) {
			$output .= $unique_id . '.content="' . $content . '";';
		}
		$output .= "penciBlocksArray.push(" . $unique_id . ");";

		if ( isset( $atts['shortcode_id'] ) && 'megamenu' == $atts['shortcode_id'] && $content ) {

			$output .= "var " . $unique_id . "dataFirstItems = {";
			$output .= "action: 'penci_ajax_mega_menu',";
			$output .= "datafilter: " . json_encode( $atts ) . ",";
			$output .= "paged: '1',";
			$output .= "styleAction: 'next_prev',";
			$output .= "nonce: '" . wp_create_nonce( 'ajax-nonce' ) . "'";
			$output .= "};";

			$output .= "var " . $unique_id . "responseData = {";
			$output .= "items: '" . $content . "',";
			$output .= "hidePagNext: " . ( isset( $atts['megahidePagNext'] ) && $atts['megahidePagNext'] ? 1 : "''" ) . ",";
			$output .= "hidePagPrev: 1,";
			$output .= "};";

			$output .= "PENCILOCALCACHE.set( JSON.stringify( " . $unique_id . "dataFirstItems ), " . $unique_id . "responseData );";
		}

		$output .= '</script>';

		echo $output;
	}

	/**
	 * Render data filter ajax
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public static function get_data_filter( $shortcode_id, $atts, $content = '' ) {
		return '';

		$unset = array(
			'style_block_title',
			'title',
			'block_title_url',
			'filter_default_txt',
			'css_animation',
			'css',
			'notification',
			'post_meta_css',
			'post_title_css',
			'next_prev',
			'pag_position',
			'class'

		);

		foreach ( $atts as $option => $value ) {
			if ( false !== strpos( $option, 'color' ) ) {
				unset( $atts[ $option ] );
			}

			if ( false !== strpos( $option, 'font' ) ) {
				unset( $atts[ $option ] );
			}

			if ( false !== strpos( $option, 'typography' ) ) {
				unset( $atts[ $option ] );
			}

			if ( false !== strpos( $option, 'heading' ) ) {
				unset( $atts[ $option ] );
			}

			if ( false !== strpos( $option, 'heading' ) ) {
				unset( $atts[ $option ] );
			}

			if ( in_array( $option, $unset ) ) {
				unset( $atts[ $option ] );
			}
		}

		$data_filter = "data-atts_json='" . json_encode( $atts ) . "'";
		$data_filter .= $content ? " data-content='" . $content . "'" : '';

		return $data_filter;
	}

	/**
	 *  Render data slider
	 *
	 * @param $args
	 *
	 * @return string
	 */
	public static function get_data_slider( $args ) {

		$items = $auto = $autotime = $speed = $loop = $dots = $nav = $style = '';

		$args = wp_parse_args( $args, array(
			'items'     => '1',
			'auto'      => '',
			'autotime'  => '',
			'speed'     => '',
			'loop'      => '',
			'dots'      => '0',
			'nav'       => '0',
			'style'     => '',
			'autowidth' => ''
		) );
		extract( $args );

		$data = ' data-items="' . $items . '"';
		$data .= ' data-auto="' . $auto . '"';
		$data .= ' data-autotime="' . $autotime . '"';
		$data .= ' data-speed="' . $speed . '"';
		$data .= ' data-loop="' . $loop . '"';
		$data .= ' data-dots="' . $dots . '"';
		$data .= ' data-nav="' . $nav . '"';
		$data .= 'data-style="' . $style . '"';
		$data .= ' data-autowidth="0"';

		return $data;
	}

	/**
	 * Render html slider nav
	 *
	 * @param $block_id
	 * @param string $style_pag
	 */
	public static function get_slider_nav( $block_id, $atts = array(), $query = null ) {

		if ( isset( $atts['style_pag'] ) && 'next_prev' != $atts['style_pag'] ) {
			return;
		}

		$total_pages = isset( $query->max_num_pages ) ? $query->max_num_pages : 1;
		?>
        <span class="penci-slider-nav">
			<a class="penci-block-pag penci-slider-prev penci-pag-disabled"
               data-block_id="<?php echo esc_attr( $block_id ); ?>" href="#"><i class="fa fa-angle-left"></i></a>
			<a class="penci-block-pag penci-slider-next <?php echo( $total_pages < 2 ? 'penci-pag-disabled' : '' ); ?>"
               data-block_id="<?php echo esc_attr( $block_id ); ?>" href="#"><i class="fa fa-angle-right"></i></a>
		</span>
		<?php
	}

	/**
	 *
	 * Render html pagination
	 *
	 * @param $atts
	 */
	public static function get_pagination( $atts, $query ) {
		if ( empty( $atts['style_pag'] ) || 'default' == $atts['style_pag'] ) {
			return;
		}

		if ( in_array( $atts['style_pag'], array( 'load_more', 'next_more', 'infinite' ) ) ) {
			$shortcode_id = isset( $atts['unique_id'] ) ? $atts['unique_id'] . 'block_content' : '';

			printf( '<div class="penci-pagination penci-ajax-more %s%s%s">
				    <a class="penci-block-ajax-more-button button %s" data-mes="%s" data-block_id="%s" %s>
				     <span class="ajax-more-text">%s</span><span class="ajaxdot"></span><i class="fa fa-refresh"></i>
				    </a>
				   </div>', isset( $atts['pag_position'] ) ? $atts['pag_position'] : '', isset( $atts['max_num_pages'] ) && 1 == $atts['max_num_pages'] ? ' penci-ajax-more-disabled' : '', isset( $atts['disable_bg_load_more'] ) && $atts['disable_bg_load_more'] ? ' disable_bg_load_more' : '', 'infinite' == $atts['style_pag'] ? 'infinite_scroll' : '', function_exists( 'penci_get_tran_setting' ) ? penci_get_tran_setting( 'penci_content_no_more_post_text' ) : esc_html__( 'Sorry, No more posts', 'penci-framework' ), esc_attr( $shortcode_id ), isset( $atts['ajax_pag_infinite_stop'] ) ? 'infinite_stop="' . $atts['ajax_pag_infinite_stop'] . '"' : '', function_exists( 'penci_get_tran_setting' ) ? penci_get_tran_setting( 'penci_click_handle_text' ) : esc_html__( 'Load More Posts', 'penci-framework' ) );
		} elseif ( 'pagination' == $atts['style_pag'] ) {

			$max_num_pages = isset( $query->max_num_pages ) ? $query->max_num_pages : 1;
			$add_args      = isset( $atts['block_id'] ) ? array( 'show_only' => $atts['block_id'] ) : '';

			Penci_Pagination::the_posts_pagination( $max_num_pages, ( isset( $atts['pag_position'] ) ? $atts['pag_position'] : '' ), $atts );
		}
	}

	/**
	 * Render button load more
	 *
	 * @param $atts
	 */
	public static function get_button_load_more( $atts ) {
		if ( 'load_more' != $atts['style_pag'] ) {
			return;
		}

	}


	/**
	 * Get url image
	 *
	 * @param $attach_id
	 * @param string $size
	 *
	 * @return mixed|void
	 */
	public static function get_image_holder_gal( $attach_id, $size = 'full', $is_background = true ) {

		$list_url  = self::penci_image_downsize( $attach_id, $sizes = array( $size, 'penci-thumb-1920-auto' ) );
		$src_large = isset( $list_url['penci-thumb-1920-auto']['img_url'] ) ? $list_url['penci-thumb-1920-auto']['img_url'] : '';
		$src_thmb  = isset( $list_url[ $size ]['img_url'] ) ? $list_url[ $size ]['img_url'] : '';

		$class_lazy = $data_src = '';
		if ( function_exists( 'penci_check_lazyload_type' ) ) {
			$class_lazy = penci_check_lazyload_type( 'class', null, false );
			$data_src   = penci_check_lazyload_type( 'src', $src_thmb, false );
		}

		if ( $is_background ) {
			$output = sprintf( '<a class="penci-image-holder%s" %s href="%s" title="%s"></a>', $class_lazy, $data_src, $src_large, self::get_image_alt( $attach_id ) );
		} else {
			$output = sprintf( '<a class="%s" href="%s" title="%s"><img src="%s" alt="%s" /></a>', $class_lazy, $src_large, self::get_image_alt( $attach_id ), $src_thmb, self::get_image_alt( $attach_id ) );
		}

		return $output;
	}

	public static function penci_image_downsize( $id, $sizes = array( 'medium' ) ) {

		$img_url          = wp_get_attachment_url( $id );
		$img_url_basename = wp_basename( $img_url );

		$list_url = array();

		foreach ( $sizes as $size ) {
			$img_url_pre = $width = $height = '';
			if ( $intermediate = image_get_intermediate_size( $id, $size ) ) {
				$img_url_pre = isset( $intermediate['url'] ) ? $intermediate['url'] : $img_url;
				$width       = isset( $intermediate['width'] ) ? $intermediate['width'] : '';
				$height      = isset( $intermediate['height'] ) ? $intermediate['height'] : '';
			} elseif ( $size == 'thumbnail' ) {
				if ( ( $thumb_file = wp_get_attachment_thumb_file( $id ) ) && $info = getimagesize( $thumb_file ) ) {
					$img_url_pre = str_replace( $img_url_basename, wp_basename( $thumb_file ), $img_url );
					$width       = $info[0];
					$height      = $info[1];
				}
			} else {
				$img_url_pre = $img_url;
			}

			$list_url[ $size ] = array(
				'img_url' => $img_url_pre,
				'height'  => $height,
				'width'   => $width
			);
		}

		return $list_url;
	}

	public static function get_image_alt( $attach_id ) {

		$attachment = get_post( $attach_id );

		if ( ! isset( $attachment->post_excerpt ) ) {
			return '';
		}

		$alt = trim( strip_tags( $attachment->post_excerpt ) );

		return $alt;
	}

	public static function get_img_info_by_id( $attachment_id = 0, $sizes = array( 'medium' ) ) {
		$attachment_id = (int) $attachment_id;
		if ( ! $post = get_post( $attachment_id ) ) {
			return false;
		}

		if ( 'attachment' != $post->post_type ) {
			return false;
		}

		$url = '';
		if ( $file = get_post_meta( $post->ID, '_wp_attached_file', true ) ) {
			if ( ( $uploads = wp_get_upload_dir() ) && false === $uploads['error'] ) {
				if ( 0 === strpos( $file, $uploads['basedir'] ) ) {
					$url = str_replace( $uploads['basedir'], $uploads['baseurl'], $file );
				} elseif ( false !== strpos( $file, 'wp-content/uploads' ) ) {
					$url = trailingslashit( $uploads['baseurl'] . '/' . _wp_get_attachment_relative_path( $file ) ) . basename( $file );
				} else {
					$url = $uploads['baseurl'] . "/$file";
				}
			}
		}

		if ( empty( $url ) ) {
			$url = get_the_guid( $post->ID );
		}

		if ( is_ssl() && ! is_admin() && 'wp-login.php' !== $GLOBALS['pagenow'] ) {
			$url = set_url_scheme( $url );
		}

		$img_url = apply_filters( 'wp_get_attachment_url', $url, $post->ID );

		$width            = $height = 0;
		$img_url_basename = wp_basename( $img_url );
		$list_url         = array(
			'alt' => trim( strip_tags( $post->post_excerpt ) )
		);

		foreach ( $sizes as $size ) {
			if ( $intermediate = image_get_intermediate_size( $attachment_id, $size ) ) {
				$img_url = str_replace( $img_url_basename, $intermediate['file'], $img_url );
				$width   = $intermediate['width'];
				$height  = $intermediate['height'];
			} elseif ( $size == 'thumbnail' ) {
				// fall back to the old thumbnail
				if ( ( $thumb_file = wp_get_attachment_thumb_file( $attachment_id ) ) && $info = getimagesize( $thumb_file ) ) {
					$img_url = str_replace( $img_url_basename, wp_basename( $thumb_file ), $img_url );
					$width   = $info[0];
					$height  = $info[1];
				}
			}

			$list_url[ $size ] = array(
				'img_url' => $img_url,
				'height'  => $height,
				'width'   => $width
			);
		}

		return $list_url;
	}

	/**
	 * Render html post meta
	 *
	 * @param $args array( 'cat', 'author', 'comment', 'date', 'like', 'view'  )
	 * @param $atts
	 * @param bool $show
	 *
	 * @return string
	 */
	public static function get_post_meta( $args, $atts, $wapper = true, $show_args = array() ) {
		$output = '';
		if ( empty( $args ) || empty( $atts ) ) {
			return $output;
		}

		if ( in_array( 'author', $show_args ) && function_exists( 'penci_get_post_author' ) && isset( $atts['show_author'] ) && $atts['show_author'] ) {
			$output .= penci_get_post_author( false, false );
		}

		if ( in_array( 'date', $show_args ) && function_exists( 'penci_get_post_date' ) && isset( $atts['show_post_date'] ) && $atts['show_post_date'] ) {
			$output .= penci_get_post_date( false );
		}

		foreach ( $args as $item ) {
			switch ( $item ) {
				case 'author':
					$output .= function_exists( 'penci_get_post_author' ) && empty( $atts['hide_author'] ) ? penci_get_post_author( false, false ) : '';
					break;
				case 'comment':
					$output .= function_exists( 'penci_get_comment_count' ) && empty( $atts['hide_comment'] ) ? penci_get_comment_count( false ) : '';;
					break;
				case 'date':
					$output .= function_exists( 'penci_get_post_date' ) && empty( $atts['hide_post_date'] ) ? penci_get_post_date( false ) : '';
					break;
				case 'like':
					$output .= function_exists( 'penci_get_post_like_link' ) && empty( $atts['hide_count_like'] ) ? penci_get_post_like_link( get_the_ID(), false ) : '';
					break;
				case 'view':
					$output .= empty( $atts['hide_count_view'] ) ? penciframework_get_post_countview( get_the_ID(), false ) : '';
					break;
				case 'cat':
					if ( empty( $atts['hide_cat'] ) ) {
						if ( isset( $atts['show_allcat'] ) && $atts['show_allcat'] ) {
							$categories_list = Penci_Framework_Helper::get_the_category_list( ' ' );
							if ( $categories_list ) {
								$output .= '<div class="entry-meta-item penci-post-cat">' . $categories_list . '</div>';
							}
						} else {
							$output .= '<div class="entry-meta-item penci-post-cat">' . Penci_Framework_Helper::show_category( '', '', false ) . '</div>';
						}
					}
					break;
				case 'review':
					/* Display Review Piechart  */ if ( empty( $atts['hide_review_piechart'] ) && function_exists( 'penci_display_piechart_review_html' ) ) {

					$output .= penci_display_piechart_review_html( get_the_ID(), 'normal', false );
				}
					break;
			}
		}

		if ( $show_args ) {
			foreach ( $show_args as $item ) {
				switch ( $item ) {
					case 'comment':
						$output .= function_exists( 'penci_get_comment_count' ) && isset( $atts['show_comment'] ) && $atts['show_comment'] ? penci_get_comment_count( false ) : '';
						break;
					case 'view':
						$output .= isset( $atts['show_count_view'] ) && $atts['show_count_view'] ? penciframework_get_post_countview( get_the_ID(), false ) : '';
						break;
				}
			}
		}

		if ( $wapper && $output ) {
			$output = '<div class="penci_post-meta">' . $output . '</div>';
		}

		return $output;
	}

	/**
	 *  Render markup post excrept
	 *
	 * @param $length
	 * @param $hide_excrept
	 *
	 * @return string
	 */
	public static function get_excrept( $length, $hide_excrept ) {
		$excrept = function_exists( 'penci_content_limit' ) ? penci_content_limit( $length, $more = '...', false ) : get_the_excerpt();

		return ( $excrept && empty( $hide_excrept ) ? '<div class="penci-post-excerpt">' . $excrept . '</div>' : '' );
	}

	public static function get_markup_title_post( $title_length, $schema_markup = true ) {
		$post_id = get_the_ID();
		$output  = '<h3 class="penci__post-title entry-title"><a href="' . get_the_permalink( $post_id ) . '" title=" ' . esc_attr( get_the_title( $post_id ) ) . ' ">' . penci_trim_post_title( $post_id, $title_length ) . '</a></h3>';

		$output .= apply_filters( 'penci_framework/markup_title_post_block', '', $post_id );

		if ( $schema_markup && function_exists( 'penci_get_schema_markup' ) ) {
			$output .= penci_get_schema_markup();
		}

		return $output;
	}

	/** Render image holder
	 *
	 * @param $image_size
	 * @param string $class
	 * @param bool $show_icon
	 * @param string $class_icon lager-size-icon, medium-size-icon,small-size-icon
	 *
	 * @return string
	 */
	public static function get_image_holder2( $image_size, $class = '', $show_icon = false, $class_icon = '', $item_order = '' ) {

		if ( function_exists( 'is_penci_amp' ) && is_penci_amp() && function_exists( 'penci_amp_post_thumbnail' ) ) {
			ob_start();
			?>
            <a class="penci-pthumb-wrap <?php echo( $class ? ' ' . $class : '' ); ?>"
               href="<?php the_permalink(); ?>"><?php penci_amp_post_thumbnail( array(
					'post'  => get_the_ID(),
					'size'  => 'penci-thumb-480-320',
					'class' => 'penci-pthumbamp'
				) ); ?></a>
			<?php
			return ob_get_clean();
		}

		$class_lazy = $data_src = '';
		if ( function_exists( 'penci_check_lazyload_type' ) ) {
			$class_lazy = penci_check_lazyload_type( 'class', null, false );
			$src_thmb   = Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size );
			$data_src   = penci_check_lazyload_type( 'src', $src_thmb, false );
		}


		$output = sprintf( '<a class="penci-image-holder%s%s%s" data-src="%s" data-delay="%s" href="%s" title="%s">%s<span class="screen-reader-text">%s</span></a>', $class ? ' ' . $class : '', $class_lazy, function_exists( 'penci_icon_post_format' ) && $show_icon ? ' penci-image_has_icon' : '', $data_src, self::penci_ajax_data_delay( $item_order, 50 ), get_the_permalink(), wp_strip_all_tags( get_the_title() ), function_exists( 'penci_icon_post_format' ) && $show_icon ? penci_icon_post_format( false, $class_icon ) : '', wp_strip_all_tags( get_the_title() )

		);

		return $output;
	}

	/**
	 * Get ajax time out
	 *
	 * @param $order
	 * @param int $time
	 *
	 * @return int
	 */
	public static function penci_ajax_data_delay( $order, $time = 50 ) {
		return $order ? ( intval( $order ) * intval( $time ) ) : 0;
	}

	/**
	 * Render image holder
	 *
	 * @param $args
	 * $class_icon lager-size-icon, medium-size-icon,small-size-icon
	 *
	 * @return string
	 */
	public static function get_image_holder( $args ) {

		$image_size     = $class = $class_icon = $image_type = '';
		$show_icon      = false;
		$use_penci_lazy = true;

		$args = wp_parse_args( $args, array(
			'image_size'     => 'penci-thumb-480-320',
			'class'          => '',
			'show_icon'      => false,
			'class_icon'     => '',
			'image_type'     => 'landscape',
			'use_penci_lazy' => true
		) );

		extract( $args );

		if ( function_exists( 'is_penci_amp' ) && is_penci_amp() && function_exists( 'penci_amp_post_thumbnail' ) ) {
			ob_start();
			?>
            <a class="penci-pthumb-wrap <?php echo( $class ? ' ' . $class : '' ); ?>"
               href="<?php the_permalink(); ?>"><?php penci_amp_post_thumbnail( array(
					'post'  => get_the_ID(),
					'size'  => 'penci-thumb-480-320',
					'class' => 'penci-pthumbamp'
				) ); ?></a>
			<?php
			return ob_get_clean();
		}

		$image_size = self::get_image_size_by_type( $image_size, $image_type );

		$src_thmb = Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size );

		$class_lazy = $data_src = '';
		if ( function_exists( 'penci_check_lazyload_type' ) ) {
			$class_lazy = penci_check_lazyload_type( 'class', null, false );
			$data_src   = penci_check_lazyload_type( 'src', $src_thmb, false );
		}

		if ( ! $use_penci_lazy ) {
			$class_lazy = '';
			$data_src   = ' style="background-image: url(' . $src_thmb . ');"';
		}

		if ( class_exists( 'Mobile_Detect' ) ) {
			$detect = new Mobile_Detect;

			if ( $detect->version( 'Opera Mini' ) ) {
				$class_lazy = '';
				$data_src   = ' style="background-image: url(' . $src_thmb . ');"';
			}
		}

		$output = sprintf( '<a class="penci-image-holder %s%s%s" %s data-delay="" href="%s" title="%s">%s</a>', $class_lazy, $class ? ' ' . $class : '', function_exists( 'penci_icon_post_format' ) && $show_icon ? ' penci-image_has_icon' : '', $data_src, get_the_permalink(), esc_attr( get_the_title() ), function_exists( 'penci_icon_post_format' ) && $show_icon ? penci_icon_post_format( false, $class_icon ) : '' );

		return $output;
	}

	public static function get_image_size_by_type( $default, $type ) {
		$output = $default;

		if ( 'square' == $type ) {
			if ( 'penci-thumb-280-186' == $default ) {
				$output = 'penci-thumb-280-280';
			} elseif ( 'penci-thumb-480-320' == $default || 'penci-thumb-480-645' == $default || 'penci-masonry-thumb' == $default ) {
				$output = 'penci-thumb-480-480';
			} elseif ( 'penci-thumb-760-570' == $default ) {
				$output = 'penci-thumb-960-auto';
			}
		} elseif ( 'vertical' == $type ) {
			if ( 'penci-thumb-280-186' == $default ) {
				$output = 'penci-thumb-280-376';
			} elseif ( 'penci-thumb-480-320' == $default || 'penci-thumb-480-645' == $default || 'penci-masonry-thumb' == $default ) {
				$output = 'penci-thumb-480-645';
			} elseif ( 'penci-thumb-760-570' == $default ) {
				$output = 'penci-thumb-960-auto';
			}
		}

		return $output;
	}

	public static function replace_featured_img_to_author_avatar( $args ) {
		global $authordata;

		$class          = $image_type = '';
		$use_penci_lazy = true;

		$args = wp_parse_args( $args, array(
			'class'          => '',
			'image_type'     => 'landscape',
			'use_penci_lazy' => true
		) );

		extract( $args );

		$avatar_args = array();
		if ( 'landscape' == $image_type ) {
			$avatar_args = array( 'width' => '120', 'height' => 80 );
		} elseif ( 'vertical' == $image_type ) {
			$avatar_args = array( 'width' => '120', 'height' => 162 );
		}

		$avatar_html = get_avatar( get_the_author_meta( 'email' ), '120', '', '', $avatar_args );

		preg_match( '/src \s* = \s*([\"\'])?(?(1) (.*?)\\1 | ([^\s\>]+))/isx', $avatar_html, $match );


		$src_thmb = isset( $match[2] ) ? $match[2] : '';

		if ( empty( $src_thmb ) ) {
			return '';
		}

		$class_lazy = $data_src = '';
		if ( function_exists( 'penci_check_lazyload_type' ) ) {
			$class_lazy = penci_check_lazyload_type( 'class', null, false );
			$data_src   = penci_check_lazyload_type( 'src', $src_thmb, false );
		}

		if ( ! $use_penci_lazy ) {
			$class_lazy = '';
			$data_src   = ' style="background-image: url(' . $src_thmb . ');"';
		}

		if ( class_exists( 'Mobile_Detect' ) ) {
			$detect = new Mobile_Detect;

			if ( $detect->version( 'Opera Mini' ) ) {
				$class_lazy = '';
				$data_src   = ' style="background-image: url(' . $src_thmb . ');"';
			}
		}

		$author_posts_link = '#';
		if ( isset( $authordata->ID ) && $authordata->ID ) {
			$author_posts_link = esc_url( get_author_posts_url( $authordata->ID ) );
		}

		$output = '<a class="penci-image-holder ' . $class_lazy . ( $class ? ' ' . $class : '' ) . '" ' . $data_src;
		$output .= ' data-delay="" href="' . $author_posts_link . '" title="' . esc_attr( get_the_title() ) . '"></a>';

		return $output;
	}

	public static function get_image_holder_pre( $args ) {

		$review_html = $icon_post_format = '';
		$image_size  = $size_review = $class = $size_icon = $size_review = '';
		$show_icon   = $hide_review = $echo = false;

		$image_type = '';

		$args = wp_parse_args( $args, array(
			'image_size'  => '',
			'class'       => '',
			'show_icon'   => false,
			'size_icon'   => '',
			'item_order'  => '',
			'hide_review' => false,
			'size_review' => '',
			'image_type'  => '',
			'echo'        => false
		) );

		extract( $args );

		if ( function_exists( 'is_penci_amp' ) && is_penci_amp() && function_exists( 'penci_amp_post_thumbnail' ) ) {
			ob_start();
			?>
            <a class="penci-pthumb-wrap <?php echo( $class ? ' ' . $class : '' ); ?>"
               href="<?php the_permalink(); ?>"><?php penci_amp_post_thumbnail( array(
					'post'  => get_the_ID(),
					'size'  => 'penci-thumb-480-320',
					'class' => 'penci-pthumbamp'
				) ); ?></a>
			<?php
			return ob_get_clean();
		}

		if ( ! $hide_review && function_exists( 'penci_display_piechart_review_html' ) ) {
			$review_html = penci_display_piechart_review_html( get_the_ID(), 'normal', false );
		}

		if ( $show_icon && function_exists( 'penci_icon_post_format' ) ) {
			$icon_post_format = penci_icon_post_format( false, $size_icon );
			$class            .= ' penci-image_has_icon';
		}

		if ( $image_type ) {
			$image_size = self::get_image_size_by_type( $image_size, $image_type );
		}

		$src_thmb   = Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size );
		$class_lazy = $data_src = '';
		if ( function_exists( 'penci_check_lazyload_type' ) ) {
			$class_lazy = penci_check_lazyload_type( 'class', null, false );
			$data_src   = penci_check_lazyload_type( 'src', $src_thmb, false );
		}

		$output = sprintf( '<a class="penci-image-holder %s %s" %s data-delay="" href="%s" title="%s">%s %s<span class="screen-reader-text">%s</span></a>', $class_lazy, $class, $data_src, get_the_permalink(), wp_strip_all_tags( get_the_title() ), $icon_post_format, $review_html, wp_strip_all_tags( get_the_title() ) );

		if ( ! $echo ) {
			return $output;
		}

		echo $output;


	}

	public static function pre_output_content_items( $items, $atts ) {
		$output = apply_filters( 'penci_blockvc_before_post_items', '', $atts );
		$output .= $items;
		$output .= apply_filters( 'penci_blockvc_after_post_items', '', $atts );

		return apply_filters( 'penci_after_block_items', $output, $atts );
	}

	/**
	 * Render html ajax loading
	 */
	public static function get_html_ajax_loading( $output ) {
		$html = $output;
		$html .= self::get_html_animation_loading();

		return $html;
	}

	public static function get_html_animation_loading() {

		$style_animation = penci_get_theme_mod( 'penci_general_loader_effect' ) ? penci_get_theme_mod( 'penci_general_loader_effect' ) : 9;

		$animation = array(
			'1' => '<div class="penci-loader-effect penci-loading-animation-1"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div></div>',
			'2' => '<div class="penci-loader-effect penci-loading-animation-2"><div class="penci-loading-animation"></div></div>',
			'3' => '<div class="penci-loader-effect penci-loading-animation-3"><div class="penci-loading-animation"></div></div>',
			'4' => '<div class="penci-loader-effect penci-loading-animation-4"><div class="penci-loading-animation"></div></div>',
			'5' => '<div class="penci-loader-effect penci-loading-animation-5 penci-three-bounce"><div class="penci-loading-animation one"></div><div class="penci-loading-animation two"></div><div class="penci-loading-animation three"></div></div>',
			'6' => '<div class="penci-loader-effect penci-loading-animation-6 penci-load-thecube"><div class="penci-loading-animation penci-load-cube penci-load-c1"></div><div class="penci-loading-animation penci-load-cube penci-load-c2"></div><div class="penci-loading-animation penci-load-cube penci-load-c4"></div><div class="penci-loading-animation penci-load-cube penci-load-c3"></div></div>',
			'7' => '<div class="penci-loader-effect penci-loading-animation-7"><div class="penci-loading-animation"></div><div class="penci-loading-animation penci-loading-animation-inner-2"></div><div class="penci-loading-animation penci-loading-animation-inner-3"></div><div class="penci-loading-animation penci-loading-animation-inner-4"></div><div class="penci-loading-animation penci-loading-animation-inner-5"></div><div class="penci-loading-animation penci-loading-animation-inner-6"></div><div class="penci-loading-animation penci-loading-animation-inner-7"></div><div class="penci-loading-animation penci-loading-animation-inner-8"></div><div class="penci-loading-animation penci-loading-animation-inner-9"></div></div>',
			'8' => '<div class="penci-loader-effect penci-loading-animation-8"><div class="penci-loading-animation"></div><div class="penci-loading-animation penci-loading-animation-inner-2"></div></div>',
			'9' => '<div class="penci-loader-effect penci-loading-animation-9"> <div class="penci-loading-circle"> <div class="penci-loading-circle1 penci-loading-circle-inner"></div> <div class="penci-loading-circle2 penci-loading-circle-inner"></div> <div class="penci-loading-circle3 penci-loading-circle-inner"></div> <div class="penci-loading-circle4 penci-loading-circle-inner"></div> <div class="penci-loading-circle5 penci-loading-circle-inner"></div> <div class="penci-loading-circle6 penci-loading-circle-inner"></div> <div class="penci-loading-circle7 penci-loading-circle-inner"></div> <div class="penci-loading-circle8 penci-loading-circle-inner"></div> <div class="penci-loading-circle9 penci-loading-circle-inner"></div> <div class="penci-loading-circle10 penci-loading-circle-inner"></div> <div class="penci-loading-circle11 penci-loading-circle-inner"></div> <div class="penci-loading-circle12 penci-loading-circle-inner"></div> </div> </div>',
		);

		return isset( $animation[ $style_animation ] ) ? $animation[ $style_animation ] : $animation[9];
	}

	/**
	 * Render html ajax loading
	 */
	public static function blockvc_before_post_items( $output, $atts, $class = '' ) {

		$currentPage = isset( $atts['paged'] ) ? $atts['paged'] : 1;

		$class = $class ? ' ' . $class : '';

		return '<div class="penci-block_content__items penci-block-items__' . $currentPage . $class . '">';
	}

	/**
	 * Render html ajax loading
	 */
	public static function blockvc_after_post_items( $output ) {
		return '</div>';
	}

	/**
	 * Render general custom css
	 *
	 * @param $id
	 * @param $atts
	 *
	 * @return string
	 */
	public static function get_general_css_custom( $id, $atts ) {
		if ( empty( $id ) ) {
			return '';
		}

		$style_block_title              = $css = $bordertop_color = $title_color = $title_hover_color = $background_title_color = $dis_bg_block = '';
		$border_title_color             = $post_title_color = $post_title_hover_color = $block_title_align = $block_title_off_uppercase = '';
		$block_title_wborder_left_right = $border_left_right_color = $border_color_title_s10 = '';
		$block_title_wborder            = '';

		$atts = wp_parse_args( $atts, array(
			'style_block_title'              => '',
			'bordertop_color'                => '',
			'border_color_title_s10'         => '',
			'border_left_right_color'        => '',
			'background_title_color'         => '',
			'title_color'                    => '',
			'title_hover_color'              => '',
			'border_title_color'             => '',
			'post_title_color'               => '',
			'post_title_hover_color'         => '',
			'meta_color'                     => '',
			'meta_hover_color'               => '',
			'block_title_off_uppercase'      => '',
			'css'                            => '',
			'dis_bg_block'                   => '',
			'block_title_wborder_left_right' => '',
			'block_title_wborder'            => ''

		) );


		extract( $atts );

		$css_vc = $atts['css'];

		$css = '';

		$title_temp = '%s .penci-block__title a, %s .penci-block__title span{ color:%s !important; } %s .penci-block-heading:after{ background-color:%s !important; }';


		if ( $bordertop_color ) : $css .= sprintf( '%s.style-title-1 .penci-block__title:before{ border-color:%s; }', $id, $bordertop_color ); endif;
		if ( $bordertop_color ) : $css .= sprintf( '%s.style-title-8 .penci-block__title:before{ border-color:%s; }', $id, $bordertop_color ); endif;
		if ( $background_title_color ) : $css .= sprintf( '%s .penci-block__title a, %s .penci-block__title span{ background-color:%s !important; }', $id, $id, $background_title_color ); endif;
		if ( $title_color ) : $css .= sprintf( $title_temp, $id, $id, $title_color, $id, $title_color ); endif;
		if ( $block_title_off_uppercase ) : $css .= sprintf( '%s .penci-block__title{ text-transform: none; }', $id ); endif;
		if ( $title_hover_color ) : $css .= sprintf( '%s .penci-block__title a:hover{ color:%s !important; }', $id, $title_hover_color ); endif;
		if ( $border_title_color ) : $css .= sprintf( '%s .penci-block-heading,%s .penci-subcat-list .flexMenu-viewMore .flexMenu-popup{ border-color:%s; }', $id, $id, $border_title_color ); endif;
		if ( $title_hover_color ) : $css .= sprintf( '%s .penci-block__title a:hover{ color:%s; }', $id, $title_hover_color ); endif;
		if ( $post_title_color ) : $css .= sprintf( '%s .penci__post-title a{ color:%s !important; }', $id, $post_title_color ); endif;
		if ( $post_title_hover_color ) : $css .= sprintf( '%s .penci__post-title a:hover{ color:%s !important; }', $id, $post_title_hover_color ); endif;
		if ( $dis_bg_block ) : $css .= sprintf( '%s.penci-block-vc{ background-color:transparent !important; }', $id ); endif;

		if ( 'style-title-5' == $style_block_title && $border_title_color ) {
			$css .= sprintf( '%s.style-title-5 .penci-block-heading:after{ background-color:%s !important; }', $id, $border_title_color );
		}

		if ( 'style-title-6' == $style_block_title && $border_title_color ) {
			$css .= sprintf( '%s.penci-block-vc.style-title-6:not(.footer-widget) .penci-block__title a:before,' . '%s.penci-block-vc.style-title-6:not(.footer-widget) .penci-block__title a:after{ border-color:%s !important; }', $id, $id, $border_title_color );

			$css .= sprintf( '%s.penci-block-vc.style-title-6:not(.footer-widget) .penci-block__title span:before,' . '%s.penci-block-vc.style-title-6:not(.footer-widget) .penci-block__title span:after{ border-color:%s !important; }', $id, $id, $border_title_color );

		}

		if ( 'style-title-9' == $style_block_title ) {


			if ( $block_title_wborder_left_right ) {
				if ( ! is_rtl() ) {
					$css .= sprintf( '%s.style-title-9.style-title-left .penci-block-heading{ border-left-width:%s !important; }', $id, $block_title_wborder_left_right );
					$css .= sprintf( '%s.style-title-9.style-title-right .penci-block-heading{ border-right-width:%s !important; }', $id, $block_title_wborder_left_right );
				} else {
					$css .= sprintf( '%s.style-title-9.style-title-left .penci-block-heading{ border-right-width:%s !important; }', $id, $block_title_wborder_left_right );
					$css .= sprintf( '%s.style-title-9.style-title-right .penci-block-heading{ border-left-width:%s !important; }', $id, $block_title_wborder_left_right );
				}

			}

			if ( $background_title_color ) {
				$css .= sprintf( '%s.style-title-9 .penci-block-heading{ background-color:%s !important; }', $id, $background_title_color );
				$css .= sprintf( '%s .penci-block__title a, %s .penci-block__title span{ background-color:transparent !important; }', $id, $id );
			}

			if ( $border_left_right_color ) {

				if ( ! is_rtl() ) {
					$css .= sprintf( '%s.style-title-9 .penci-block-heading{ border-left-color:%s !important; }', $id, $border_left_right_color );
					$css .= sprintf( '%s.style-title-9.style-title-left .penci-block-heading{ border-left-color:%s !important; }', $id, $border_left_right_color );
					$css .= sprintf( '%s.style-title-9.style-title-right .penci-block-heading{ border-right-color:%s !important;border-left-color:transparent !important; }', $id, $border_left_right_color );
				} else {
					$css .= sprintf( '%s.style-title-9 .penci-block-heading{ border-right-color:%s !important; }', $id, $border_left_right_color );
					$css .= sprintf( '%s.style-title-9.style-title-left .penci-block-heading{ border-right-color:%s !important; }', $id, $border_left_right_color );
					$css .= sprintf( '%s.style-title-9.style-title-right .penci-block-heading{ border-left-color:%s !important;border-right-color:transparent !important; }', $id, $border_left_right_color );
				}

			}
		}

		if ( 'style-title-10' == $style_block_title ) {
			if ( $block_title_wborder_left_right ) {
				$css .= sprintf( '%s.style-title-10 .penci-block-heading:after{ width:%s; }', $id, $block_title_wborder_left_right );
			}

			if ( $border_left_right_color ) {
				$css .= sprintf( '%s.style-title-10 .penci-block-heading:after{ background-color:%s; }', $id, $border_left_right_color );
			}

			if ( $border_color_title_s10 ) {
				$css .= sprintf( '%s.style-title-10 .penci-block-heading{ border-color:%s; }', $id, $border_color_title_s10 );
			}
		}

		if ( 'style-title-11' == $style_block_title ) {
			if ( is_numeric( $block_title_wborder ) ) {
				$css .= sprintf( '%s.style-title-11 .penci-block__title:after{ height:%s; margin-top: -%spx; }', $id, esc_attr( $block_title_wborder ), ( $block_title_wborder / 2 ) );
			}

			if ( $bordertop_color ) {
				$css .= sprintf( '%s.penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title:after{ background-color:%s; }', $id, $bordertop_color );
			}
			$background = $css ? self::pre_background_design_vc( $css ) : '';
			if ( $background ) {
				$css .= sprintf( '.penci_dis_padding_bw .penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title a,
					.penci_dis_padding_bw .penci-block-vc.style-title-11:not(.footer-widget) .penci-block__title span, 
					.penci_dis_padding_bw .penci-block-vc.style-title-11:not(.footer-widget) .penci-subcat-filter, 
					.penci_dis_padding_bw .penci-block-vc.style-title-11:not(.footer-widget) .penci-slider-nav{ background-color:%s }', $background );
			}
		}

		if ( 'style-title-12' == $style_block_title ) {
			if ( $block_title_wborder ) {
				$css .= sprintf( '%s.style-title-12 .penci-block-heading{ border-bottom-width:%s; }', $id, esc_attr( $block_title_wborder ) );
			}
		}

		if ( 'style-title-13' == $style_block_title ) {
			if ( $block_title_wborder_left_right ) {
				$css .= sprintf( '%s.style-title-13 .penci-block-heading{ background-color:%s; }', $id, $background_title_color );
				$css .= sprintf( '%s.style-title-13 .penci-block__title:after{ border-top-color:%s; }', $id, $background_title_color );
			}
		}

		// Css background ajax loading
		if ( $css_vc && ! empty( $atts['style_pag'] ) ) {

			$background = self::pre_background_design_vc( $css_vc );

			if ( $background ) {
				$css .= sprintf( '%s .ajax-loading:before{ %s }', $id, $background );
			}
		}


		if ( $css_vc && 'style-title-11' == $style_block_title ) {
			$background = self::pre_background_design_vc( $css_vc );

			if ( $background ) {
				$css .= sprintf( '%s.style-title-11 .penci-block__title a,%s.style-title-11 .penci-block__title span,' . '%s.style-title-11 .penci-subcat-filter,%s.style-title-11 .penci-slider-nav{ %s }', $id, $id, $id, $id, $background );
			}
		}

		return $css;

	}

	public static function pre_background_design_vc( $css ) {
		preg_match_all( '/background-color: #(?:[0-9a-fA-F]{6})/', $css, $matches );

		$background = isset( $matches[0][0] ) ? $matches[0][0] : '';

		if ( $background ) {
			$background = ( false === strpos( ';', $background ) ) ? $background . ';' : $background;

		}

		return $background;
	}

	public static function get_general_css_imgtype_custom( $id, $atts ) {

		if ( isset( $atts[''] ) ) {
			return $css;
		}
	}

	/**
	 * Render post meta custom css
	 *
	 * @param $id
	 * @param $atts
	 *
	 * @return string
	 */
	public static function get_post_meta_css_custom( $id, $atts ) {
		if ( empty( $id ) ) {
			return '';
		}

		$atts = wp_parse_args( $atts, array( 'meta_color' => '', 'meta_hover_color' => '', ) );

		$meta_color       = $atts['meta_color'];
		$meta_hover_color = $atts['meta_hover_color'];

		$css = '';
		if ( $meta_color ) : $css .= sprintf( '%s .penci_post-meta{ color:%s; }', $id, $meta_color ); endif;
		if ( $meta_hover_color ) : $css .= sprintf( '%s .penci_post-meta a:hover{ color:%s !important; }', $id, $meta_hover_color ); endif;

		return $css;
	}

	/**
	 * Render post meta custom css
	 *
	 * @param $id
	 * @param $atts
	 *
	 * @return string
	 */
	public static function get_post_cat_css_custom( $id, $atts ) {
		if ( empty( $id ) ) {
			return '';
		}

		$atts = wp_parse_args( $atts, array(
				'cat_color'         => '',
				'cat_bg_color'      => '',
				'cat_hover_color'   => '',
				'cat_bghover_color' => '',
			) );

		$css = '';
		if ( $atts['cat_color'] ) : $css .= sprintf( '%s .penci-cat-name{ color:%s; }', $id, $atts['cat_color'] ); endif;
		if ( $atts['cat_bg_color'] ) : $css .= sprintf( '%s .penci-cat-name{ background-color:%s; }', $id, $atts['cat_bg_color'] ); endif;


		if ( false !== strpos( $id, 'penci-grid' ) || false !== strpos( $id, 'penci_grid' ) ) {
			if ( $atts['cat_hover_color'] ) : $css .= sprintf( '%s.penci-block_grid .penci-post-item:hover .penci-cat-name{ color:%s; }', $id, $atts['cat_hover_color'] ); endif;
			if ( $atts['cat_bghover_color'] ) : $css .= sprintf( '%s.penci-block_grid .penci-post-item:hover .penci-cat-name{ background-color:%s; }', $id, $atts['cat_bghover_color'] ); endif;
		} else {
			if ( $atts['cat_hover_color'] ) : $css .= sprintf( '%s .penci-cat-name:hover,%s .penci_post_thumb:hover .penci-cat-name{ color:%s; }', $id, $id, $atts['cat_hover_color'] ); endif;
			if ( $atts['cat_bghover_color'] ) : $css .= sprintf( '%s .penci-cat-name:hover,%s .penci_post_thumb:hover .penci-cat-name{ background-color:%s; }', $id, $id, $atts['cat_bghover_color'] ); endif;
		}

		return $css;
	}

	/**
	 * Render post meta custom css
	 *
	 * @param $id
	 * @param $atts
	 *
	 * @return string
	 */
	public static function get_post_social_css_custom( $id, $atts ) {
		if ( empty( $id ) ) {
			return '';
		}

		$atts = wp_parse_args( $atts, array( 'social_share_color' => '', 'social_share_hover_color' => '', ) );

		$color       = $atts['social_share_color'];
		$hover_color = $atts['social_share_hover_color'];

		$css = '';
		if ( $color ) : $css .= sprintf( '%s .social-buttons a{ color:%s; }', $id, $color ); endif;
		if ( $hover_color ) : $css .= sprintf( '%s .social-buttons a:hover{ color:%s !important; }', $id, $hover_color ); endif;

		return $css;
	}

	/**
	 * Render ajax loading custom css
	 *
	 * @param $id
	 * @param $atts
	 *
	 * @return string
	 */
	public static function get_ajax_loading_css_custom( $id, $atts ) {
		if ( empty( $id ) ) {
			return '';
		}

		$atts = wp_parse_args( $atts, array( 'overlay_bgcolor' => '', 'spinner_color' => '', ) );

		$overlay_bgcolor = $atts['overlay_bgcolor'];
		$spinner_color   = $atts['spinner_color'];

		$css = '';
		if ( $overlay_bgcolor ) : $css .= sprintf( '%s .ajax-loading:before{ background:%s !important; }', $id, $overlay_bgcolor ); endif;
		if ( $spinner_color ) {


			$style_animation = penci_get_theme_mod( 'penci_general_loader_effect' ) ? penci_get_theme_mod( 'penci_general_loader_effect' ) : 9;

			$pre_id = str_replace( '#', '', $id );

			if ( 1 == $style_animation ) {
				$css .= $id . ' .penci-loading-animation-1 > div { background-color: ' . esc_attr( $spinner_color ) . '; }';
			} elseif ( 2 == $style_animation ) {

				$css .= $id . ' .penci-loading-animation-2 .penci-loading-animation{ animation-name: ' . $pre_id . '-loader-2; }';
				$css .= '@keyframes ' . $pre_id . '-loader-2 {
				    0%,100% {  box-shadow: 0 -3em 0 .2em ' . esc_attr( $spinner_color ) . ',2em -2em 0 0 ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 0 ' . esc_attr( $spinner_color ) . '}
				    12.5% {
				        box-shadow: 0 -3em 0 0 ' . esc_attr( $spinner_color ) . ',2em -2em 0 .2em ' . esc_attr( $spinner_color ) . ',3em 0 0 0 ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . '}
				    25% {
				        box-shadow: 0 -3em 0 -0.5em ' . esc_attr( $spinner_color ) . ',2em -2em 0 0 ' . esc_attr( $spinner_color ) . ',3em 0 0 .2em ' . esc_attr( $spinner_color ) . ',2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . '}
				    37.5% {
				        box-shadow: 0 -3em 0 -1em ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 0 ' . esc_attr( $spinner_color ) . ',2em 2em 0 .2em ' . esc_attr( $spinner_color ) . ',0 3em 0 0 ' . esc_attr( $spinner_color ) . ',-2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ' }
				    50% {
				        box-shadow: 0 -3em 0 -1em ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',0 3em 0 .2em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . '}
				    62.5% {
				        box-shadow: 0 -3em 0 -1em ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 0 ' . esc_attr( $spinner_color ) . ',-2em 2em 0 .2em ' . esc_attr( $spinner_color ) . ',-3em 0 0 0 ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . '}
				    75% {
				        box-shadow: 0 -3em 0 -1em ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',-3em 0 0 .2em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 0 ' . esc_attr( $spinner_color ) . '}
				    87.5% {
				        box-shadow: 0 -3em 0 0 ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',-3em 0 0 0 ' . esc_attr( $spinner_color ) . ',-2em -2em 0 .2em ' . esc_attr( $spinner_color ) . '}
				}';

				$css .= '@-webkit-keyframes ' . $pre_id . '-loader-2 {
				    0%,100% {  box-shadow: 0 -3em 0 .2em ' . esc_attr( $spinner_color ) . ',2em -2em 0 0 ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 0 ' . esc_attr( $spinner_color ) . '}
				    12.5% {
				        box-shadow: 0 -3em 0 0 ' . esc_attr( $spinner_color ) . ',2em -2em 0 .2em ' . esc_attr( $spinner_color ) . ',3em 0 0 0 ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . '}
				    25% {
				        box-shadow: 0 -3em 0 -0.5em ' . esc_attr( $spinner_color ) . ',2em -2em 0 0 ' . esc_attr( $spinner_color ) . ',3em 0 0 .2em ' . esc_attr( $spinner_color ) . ',2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . '}
				    37.5% {
				        box-shadow: 0 -3em 0 -1em ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 0 ' . esc_attr( $spinner_color ) . ',2em 2em 0 .2em ' . esc_attr( $spinner_color ) . ',0 3em 0 0 ' . esc_attr( $spinner_color ) . ',-2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ' }
				    50% {
				        box-shadow: 0 -3em 0 -1em ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',0 3em 0 .2em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',-3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . '}
				    62.5% {
				        box-shadow: 0 -3em 0 -1em ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 0 ' . esc_attr( $spinner_color ) . ',-2em 2em 0 .2em ' . esc_attr( $spinner_color ) . ',-3em 0 0 0 ' . esc_attr( $spinner_color ) . ',-2em -2em 0 -1em ' . esc_attr( $spinner_color ) . '}
				    75% {
				        box-shadow: 0 -3em 0 -1em ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',-3em 0 0 .2em ' . esc_attr( $spinner_color ) . ',-2em -2em 0 0 ' . esc_attr( $spinner_color ) . '}
				    87.5% {
				        box-shadow: 0 -3em 0 0 ' . esc_attr( $spinner_color ) . ',2em -2em 0 -1em ' . esc_attr( $spinner_color ) . ',3em 0 0 -1em ' . esc_attr( $spinner_color ) . ',2em 2em 0 -1em ' . esc_attr( $spinner_color ) . ',0 3em 0 -1em ' . esc_attr( $spinner_color ) . ',-2em 2em 0 0 ' . esc_attr( $spinner_color ) . ',-3em 0 0 0 ' . esc_attr( $spinner_color ) . ',-2em -2em 0 .2em ' . esc_attr( $spinner_color ) . '}
				}';
			} elseif ( 3 == $style_animation ) {
				$spinner_color_02 = penci_convert_hex_rgb( $spinner_color, 0.2 );
				$spinner_color_05 = penci_convert_hex_rgb( $spinner_color, 0.5 );
				$spinner_color_07 = penci_convert_hex_rgb( $spinner_color, 0.7 );

				$css .= $id . ' .penci-loading-animation-3 .penci-loading-animation{ animation-name: ' . $pre_id . '-loader-3; }';

				$css .= '@-webkit-keyframes ' . $pre_id . '-loader-3 {
				    0%,100% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_05 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_07 ) . ';}
				    12.5% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_07 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_05 ) . '; }
				
				    25% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_05 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_07 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . '; }
				
				    37.5% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_05 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_07 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ';}
				
				    50% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_05 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_07 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ';}
				
				    62.5% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_05 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_07 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . '; }
				
				    75% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_05 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_07 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ';}
				
				    87.5% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_05 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_07 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color ) . ';}
				}';

				$css .= '@keyframes ' . $pre_id . '-loader-3 {
				    0%,100% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_05 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_07 ) . ';}
				    12.5% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_07 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_05 ) . '; }
				
				    25% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_05 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_07 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . '; }
				
				    37.5% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_05 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_07 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ';}
				
				    50% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_05 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_07 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ';}
				
				    62.5% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_05 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_07 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . '; }
				
				    75% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_05 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_07 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ';}
				
				    87.5% {
				        box-shadow: 0 -2.6em 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.8em -1.8em 0 0 ' . esc_attr( $spinner_color_02 ) . ',2.5em 0 0 0 ' . esc_attr( $spinner_color_02 ) . ',1.75em 1.75em 0 0 ' . esc_attr( $spinner_color_02 ) . ',0 2.5em 0 0 ' . esc_attr( $spinner_color_02 ) . ',-1.8em 1.8em 0 0 ' . esc_attr( $spinner_color_05 ) . ',-2.6em 0 0 0 ' . esc_attr( $spinner_color_07 ) . ',-1.8em -1.8em 0 0 ' . esc_attr( $spinner_color ) . ';}
				}';
			} elseif ( 4 == $style_animation ) {

				$css .= $id . ' .penci-loading-animation-4 .penci-loading-animation{ animation-name: ' . $pre_id . '-loader-4; }';

				$css .= '@keyframes ' . $pre_id . '-loader-4 {
					0% {
						-webkit-transform: rotate(0);
						transform: rotate(0);
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					5%,95% {
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					10%,59% {
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',-0.087em -0.825em 0 -0.42em ' . esc_attr( $spinner_color ) . ',-0.173em -0.812em 0 -0.44em ' . esc_attr( $spinner_color ) . ',-0.256em -0.789em 0 -0.46em ' . esc_attr( $spinner_color ) . ',-0.297em -0.775em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					20% {
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',-0.338em -0.758em 0 -0.42em ' . esc_attr( $spinner_color ) . ',-0.555em -0.617em 0 -0.44em ' . esc_attr( $spinner_color ) . ',-0.671em -0.488em 0 -0.46em ' . esc_attr( $spinner_color ) . ',-0.749em -0.34em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					38% {
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',-0.377em -0.74em 0 -0.42em ' . esc_attr( $spinner_color ) . ',-0.645em -0.522em 0 -0.44em ' . esc_attr( $spinner_color ) . ',-0.775em -0.297em 0 -0.46em ' . esc_attr( $spinner_color ) . ',-0.82em -0.09em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					100% {
						-webkit-transform: rotate(360deg);
						transform: rotate(360deg);
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				}';

				$css .= '@-webkit-keyframes ' . $pre_id . '-loader-4 {
					0% {
						-webkit-transform: rotate(0);
						transform: rotate(0);
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					5%,95% {
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					10%,59% {
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',-0.087em -0.825em 0 -0.42em ' . esc_attr( $spinner_color ) . ',-0.173em -0.812em 0 -0.44em ' . esc_attr( $spinner_color ) . ',-0.256em -0.789em 0 -0.46em ' . esc_attr( $spinner_color ) . ',-0.297em -0.775em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					20% {
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',-0.338em -0.758em 0 -0.42em ' . esc_attr( $spinner_color ) . ',-0.555em -0.617em 0 -0.44em ' . esc_attr( $spinner_color ) . ',-0.671em -0.488em 0 -0.46em ' . esc_attr( $spinner_color ) . ',-0.749em -0.34em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					38% {
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',-0.377em -0.74em 0 -0.42em ' . esc_attr( $spinner_color ) . ',-0.645em -0.522em 0 -0.44em ' . esc_attr( $spinner_color ) . ',-0.775em -0.297em 0 -0.46em ' . esc_attr( $spinner_color ) . ',-0.82em -0.09em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				
					100% {
						-webkit-transform: rotate(360deg);
						transform: rotate(360deg);
						box-shadow: 0 -0.83em 0 -0.4em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.42em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.44em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.46em ' . esc_attr( $spinner_color ) . ',0 -0.83em 0 -0.477em ' . esc_attr( $spinner_color ) . ';
					}
				}';
			} elseif ( 5 == $style_animation ) {
				$css .= $id . ' .penci-loading-animation-5 .penci-loading-animation,';
				$css .= $id . ' .penci-three-bounce .one,';
				$css .= $id . ' .penci-three-bounce .two,';
				$css .= $id . ' .penci-three-bounce .three';
				$css .= '{ background-color: ' . esc_attr( $spinner_color ) . '; }';
			} elseif ( 6 == $style_animation ) {
				$css .= $id . ' .penci-loading-animation-6 .penci-loading-animation:before';
				$css .= '{ background-color: ' . esc_attr( $spinner_color ) . '; }';
			} elseif ( 7 == $style_animation ) {
				$css .= $id . ' .penci-loading-animation-7 .penci-loading-animation,';
				$css .= $id . ' .penci-load-thecube .penci-load-cube:before';
				$css .= '{ background-color: ' . esc_attr( $spinner_color ) . '; }';
			} elseif ( 8 == $style_animation ) {
				$css .= $id . ' .penci-loading-animation-8 .penci-loading-animation';
				$css .= '{ background-color: ' . esc_attr( $spinner_color ) . '; }';
			} elseif ( 9 == $style_animation ) {
				$css .= $id . ' .penci-loading-animation-9 .penci-loading-circle-inner:before';
				$css .= '{ background-color: ' . esc_attr( $spinner_color ) . '; }';
			}

		}

		return $css;
	}

	/**
	 * Render ajax loading custom css
	 *
	 * @param $id
	 * @param $atts
	 *
	 * @return string
	 */
	public static function get_text_filter_css_custom( $id, $atts ) {
		if ( empty( $id ) ) {
			return '';
		}

		$atts = wp_parse_args( $atts, array(
			'filter_text_color'       => '',
			'filter_text_hover_color' => '',
			'filter_dropdown_bgcolor' => ''
		) );

		$color            = $atts['filter_text_color'];
		$hover_color      = $atts['filter_text_hover_color'];
		$background_color = $atts['filter_dropdown_bgcolor'];

		$css = '';

		if ( $color ) : $css .= sprintf( '%s.penci-block-vc .penci-subcat-filter .penci-subcat-item a,
			 %s .penci-subcat-list .flexMenu-viewMore > a,
			 %s.penci-block-vc .penci-slider-nav .penci-block-pag{ color:%s; }', $id, $id, $id, $color );
		endif;

		if ( $hover_color ) : $css .= sprintf( '%s.penci-block-vc .penci-subcat-list .flexMenu-viewMore:hover > a,
			 %s.penci-block-vc .penci-subcat-list .flexMenu-viewMore:focus > a,
			%s.penci-block-vc .penci-subcat-filter .penci-subcat-item a.active,
			 %s.penci-block-vc .penci-subcat-filter .penci-subcat-item a:hover,
			 %s .penci-subcat-list .flexMenu-viewMore > a:hover,
			 %s.penci-block-vc .penci-slider-nav .penci-block-pag:not( .penci-pag-disabled ):hover{ color:%s; }', $id, $id, $id, $id, $id, $id, $hover_color );
		endif;

		if ( $background_color ) {
			$css .= sprintf( '%s .penci-subcat-list .flexMenu-viewMore .flexMenu-popup:before{ background-color:%s; }', $id, $background_color );
		}

		return $css;
	}

	public static function get_pagination_css_custom( $id, $atts ) {
		if ( empty( $id ) || ! isset( $atts['style_pag'] ) ) {
			return '';
		}

		$atts = wp_parse_args( $atts, array(
			'pagi_number_color'     => '',
			'pagi_number_bg_color'  => '',
			'pagi_number_hcolor'    => '',
			'pagi_number_bg_hcolor' => '',

			'loadmore_text_color'    => '',
			'loadmore_bg_color'      => '',
			'loadmore_border_color'  => '',
			'loadmore_text_hcolor'   => '',
			'loadmore_bg_hcolor'     => '',
			'loadmore_border_hcolor' => '',
		) );

		$css = '';

		if ( 'pagination' == $atts['style_pag'] ) {
			if ( $atts['pagi_number_color'] ) {
				$css .= sprintf( '%s .penci-pagination:not(.penci-ajax-more) a,%s .penci-pagination:not(.penci-ajax-more) span{ color: %s; border-color: %s; }', $id, $id, $atts['pagi_number_color'], $atts['pagi_number_color'] );
			}

			if ( $atts['pagi_number_bg_color'] ) {
				$css .= sprintf( '%s .penci-pagination:not(.penci-ajax-more) a,%s .penci-pagination:not(.penci-ajax-more) span{ background-color: %s; }', $id, $id, $atts['pagi_number_bg_color'] );
			}

			if ( $atts['pagi_number_hcolor'] ) {
				$css .= sprintf( '%s .penci-pagination:not(.penci-ajax-more) span.current,%s .penci-pagination:not(.penci-ajax-more) a:hover{ color: %s; }', $id, $id, $atts['pagi_number_hcolor'] );
			}

			if ( $atts['pagi_number_bg_hcolor'] ) {
				$css .= sprintf( '%s .penci-pagination:not(.penci-ajax-more) span.current,%s .penci-pagination:not(.penci-ajax-more) a:hover{ border-color: %s;background-color: %s;  }', $id, $id, $atts['pagi_number_bg_hcolor'], $atts['pagi_number_bg_hcolor'] );
			}
		} elseif ( 'load_more' == $atts['style_pag'] ) {
			if ( $atts['loadmore_text_color'] ) {
				$css .= sprintf( '%s .penci-ajax-more .penci-block-ajax-more-button{ color: %s; }', $id, $atts['loadmore_text_color'] );
			}

			if ( $atts['loadmore_bg_color'] ) {
				$css .= sprintf( '%s .penci-ajax-more:not( .disable_bg_load_more ) .penci-block-ajax-more-button,
				%s .penci-ajax-more:not( .disable_bg_load_more ) .penci-ajax-more .penci-ajax-more-button.loading-posts:hover,%s 
				.penci-ajax-more:not( .disable_bg_load_more ) .penci-block-ajax-more-button.loading-posts:hover
				{ background-color: %s; }', $id, $id, $id, $atts['loadmore_bg_color'] );

				if ( ! $atts['loadmore_bg_hcolor'] && ! $atts['loadmore_border_color'] ) {
					$css .= sprintf( '%s .penci-ajax-more:not( .disable_bg_load_more ) .penci-block-ajax-more-button:hover{ background-color: %s;border-color: %s; }', $id, $atts['loadmore_bg_color'], $atts['loadmore_bg_color'] );
				}
			}

			if ( $atts['loadmore_border_color'] ) {
				$css .= sprintf( '%s .penci-ajax-more:not( .disable_bg_load_more ) .penci-block-ajax-more-button,
				%s .penci-ajax-more:not( .disable_bg_load_more ) .penci-ajax-more .penci-ajax-more-button.loading-posts:hover,
				%s .penci-ajax-more:not( .disable_bg_load_more ) .penci-block-ajax-more-button.loading-posts:hover
				{ border-color: %s; }', $id, $id, $id, $atts['loadmore_border_color'] );
			}

			if ( $atts['loadmore_text_hcolor'] ) {
				$css .= sprintf( '%s .penci-ajax-more .penci-block-ajax-more-button:hover{ color: %s; }', $id, $atts['loadmore_text_hcolor'] );
			}

			if ( $atts['loadmore_bg_hcolor'] ) {
				$css .= sprintf( '%s .penci-ajax-more:not( .disable_bg_load_more ) .penci-block-ajax-more-button:hover{ background-color: %s;border-color: %s; }', $id, $atts['loadmore_bg_hcolor'], $atts['loadmore_bg_hcolor'] );
			}

		}

		return $css;
	}

	public static function get_load_more_css_custom( $id, $atts ) {

		if ( empty( $id ) ) {
			return '';
		}

		$atts = wp_parse_args( $atts, array(
			'button_bg_color'      => '',
			'button_border_color'  => '',
			'button_text_color'    => '',
			'button_hbg_color'     => '',
			'button_hborder_color' => '',
			'button_htext_color'   => '',
		) );

		$button_bg_color      = $atts['button_bg_color'];
		$button_border_color  = $atts['button_border_color'];
		$button_text_color    = $atts['button_text_color'];
		$button_hbg_color     = $atts['button_hbg_color'];
		$button_hborder_color = $atts['button_hborder_color'];
		$button_htext_color   = $atts['button_htext_color'];

		$css = '';

		if ( $button_bg_color ) : $css .= sprintf( '%s .penci-more-post{ background-color:%s; }', $id, $button_bg_color ); endif;
		if ( $button_border_color ) : $css .= sprintf( '%s .penci-more-post{ border-color:%s; }', $id, $button_border_color ); endif;
		if ( $button_text_color ) : $css .= sprintf( '%s .penci-more-post{ color:%s; }', $id, $button_text_color ); endif;
		if ( $button_hbg_color ) : $css .= sprintf( '%s .penci-more-post:hover{ background-color:%s; }', $id, $button_hbg_color ); endif;
		if ( $button_hborder_color ) : $css .= sprintf( '%s .penci-more-post:hover{ border-color:%s; }', $id, $button_hborder_color ); endif;
		if ( $button_htext_color ) : $css .= sprintf( '%s .penci-more-post:hover{ color:%s; }', $id, $button_htext_color ); endif;

		return $css;
	}

	public static function get_typo_css_custom_block_heading( $id_block, $atts ) {
		$css_custom = self::get_typo_css_custom( array(
			'e_admin'      => 'block_title',
			'font-size'    => '18px',
			'google_fonts' => self::get_font_family( 'oswald' ),
			'template'     => $id_block . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
		), $atts );

		$css_custom .= self::get_typo_css_custom( array(
			'e_admin'      => 'link_filter',
			'font-size'    => '13px',
			'google_fonts' => self::get_font_family( 'roboto' ),
			'template'     => $id_block . ' .penci-subcat-filter .penci-subcat-item a,' . $id_block . ' .penci-subcat-list .flexMenu-viewMore > a{ %s }',
		), $atts );

		return $css_custom;
	}

	/**
	 *
	 * Render typo
	 *
	 * @param $args
	 * @param $atts
	 *
	 * @return string
	 */
	public static function get_typo_css_custom( $args, $atts ) {
		$output = $css = '';

		global $penci_font_enqueue;

		$args = wp_parse_args( $args, array(
			'template'     => '',
			'e_admin'      => '',
			'font-size'    => '',
			'google_fonts' => '',
			'font-weight'  => '',
			'media'        => '768',
		) );

		$e_admin = $args['e_admin'];


		if ( isset( $atts[ $e_admin . '_fonts' ] ) && ( $atts[ $e_admin . '_fonts' ] != $args['google_fonts'] ) ) {
			$google_fonts_obj = new Vc_Google_Fonts();
			$font             = $google_fonts_obj->_vc_google_fonts_parse_attributes( array(), trim( $atts[ $e_admin . '_fonts' ] ) );
			$font             = $font['values'];
			list( $font_family ) = explode( ':', $font['font_family'] . ':' );
			$font_style = explode( ':', $font['font_style'] . ':' );

			$penci_font_enqueue = array( 'Mukta Vaani', 'Mukta+Vaani', 'Roboto', 'Oswald' );

			if ( function_exists( 'penci_get_custom_fonts' ) ) {
				$custom_fonts = penci_get_custom_fonts();
				if ( $custom_fonts ) {
					$list_custom_fonts = array_keys( $custom_fonts );

					if ( $list_custom_fonts && is_array( $list_custom_fonts ) ) {
						$penci_font_enqueue = array_merge( $penci_font_enqueue, $list_custom_fonts );
					}
				}
			}

			$settings = get_option( 'wpb_js_google_fonts_subsets' );
			if ( is_array( $settings ) && ! empty( $settings ) ) {
				$subsets = '&subset=' . implode( ',', $settings );
			} else {
				$subsets = '';
			}

			if ( $font_family && ! in_array( $font_family, $penci_font_enqueue ) ) {
				wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( urlencode( $font_family ) ), '//fonts.googleapis.com/css?family=' . urlencode( $font_family ) . $subsets );
			}

			if ( ! empty( $font_family ) ) {

				$font_browser = array(
					'Arial'                                            => 'Arial, Helvetica, sans-serif',
					'Arial Black'                                      => 'Arial Black, Gadget, sans-serif',
					'Comic Sans MS'                                    => 'Comic Sans MS, cursive, sans-serif',
					'Impact'                                           => 'Impact, Charcoal, sans-serif',
					'Lucida Sans Unicode'                              => 'Lucida Sans Unicode, Lucida Grande, sans-serif',
					'Tahoma'                                           => 'Tahoma, Geneva, sans-serif',
					'Trebuchet MS'                                     => 'Trebuchet MS, Helvetica, sans-serif',
					'Verdana'                                          => 'Verdana, Geneva, sans-serif',
					'Georgia'                                          => 'Georgia, serif',
					'Palatino Linotype'                                => 'Palatino Linotype, Book Antiqua, Palatino, serif',
					'Times New Roman'                                  => 'Times New Roman, Times, serif',
					'Courier New'                                      => 'Courier New, Courier, monospace',
					'Lucida Console'                                   => 'Lucida Console, Monaco, monospace',
					'Arial, Helvetica, sans-serif'                     => 'Arial, Helvetica, sans-serif',
					'Arial Black, Gadget, sans-serif'                  => 'Arial Black, Gadget, sans-serif',
					'Comic Sans MS, cursive, sans-serif'               => 'Comic Sans MS, cursive, sans-serif',
					'Impact, Charcoal, sans-serif'                     => 'Impact, Charcoal, sans-serif',
					'Lucida Sans Unicode, Lucida Grande, sans-serif'   => 'Lucida Sans Unicode, Lucida Grande, sans-serif',
					'Tahoma, Geneva, sans-serif'                       => 'Tahoma, Geneva, sans-serif',
					'Trebuchet MS, Helvetica, sans-serif'              => 'Trebuchet MS, Helvetica, sans-serif',
					'Verdana, Geneva, sans-serif'                      => 'Verdana, Geneva, sans-serif',
					'Georgia, serif'                                   => 'Georgia, serif',
					'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
					'Times New Roman, Times, serif'                    => 'Times New Roman, Times, serif',
					'Courier New, Courier, monospace'                  => 'Courier New, Courier, monospace',
					'Lucida Console, Monaco, monospace'                => 'Lucida Console, Monaco, monospace',
				);

				if ( isset( $font_browser[ $font_family ] ) && $font_browser[ $font_family ] ) {
					$css .= 'font-family:' . $font_browser[ $font_family ] . ';';
				} else {
					$css .= 'font-family:"' . $font_family . '";';
				}
			}

			if ( ! empty( $font_style[1] ) ) {
				$css .= 'font-weight:' . $font_style[1] . ';';
			}

			//			if ( ! empty( $font_style[2] ) ) {
			//				$css .= 'font-style:' . $font_style[2] . ';';
			//			}
		}

		if ( isset( $atts[ $e_admin . '_font_style' ] ) && $atts[ $e_admin . '_font_style' ] ) {
			$css .= 'font-style:' . esc_attr( $atts[ $e_admin . '_font_style' ] ) . ';';
		}

		$css_size = '';

		if ( ! empty( $atts[ $e_admin . '_font_size' ] ) && $atts[ $e_admin . '_font_size' ] != $args['font-size'] ) {
			$css_size = 'font-size:' . strip_tags( $atts[ $e_admin . '_font_size' ] ) . ' !important;';
		}

		if ( $css ) {
			$output .= sprintf( $args['template'], $css );
		}

		if ( $css_size ) {
			if ( $args['media'] ) {
				$output .= sprintf( '@media screen and (min-width: %spx ){' . $args['template'] . '}', $args['media'], $css_size );
			} elseif ( $css_size ) {
				$output .= sprintf( $args['template'], $css_size );
			}
		}

		return $output;
	}

	/**
	 * Get font family
	 *
	 * @param $font
	 *
	 * @return string
	 */
	public static function get_font_family( $font, $widget = false ) {
		$output = '';

		// Use widget on sidebar and footer
		if ( $widget ) {
			if ( 'muktavaani' == $font ) {
				$output = 'font_family:Mukta Vaani|font_style:400%20regular%3A400%3Anormal';
			}
			if ( 'muktavaani500' == $font ) {
				$output = 'font_family:Mukta Vaani|font_style:500%20regular%3A500%3Anormal';
			}
			if ( 'muktavaani600' == $font ) {
				$output = 'font_family:Mukta Vaani|font_style:600%20medium%3A600%3Anormal';
			} elseif ( 'roboto' == $font ) {
				$output = 'font_family:Roboto|font_style:400%20regular%3A400%3Anormal';
			} elseif ( 'oswald' == $font ) {
				$output = 'font_family:Oswald|font_style:400%20regular%3A400%3Anormal';
			}

			return $output;
		}

		// Block normal
		if ( 'muktavaani' == $font ) {
			$output = 'font_family:Mukta%20Vaani%3A200%2C300%2C400%2Cregular%2C500%2C600%2C700%2C800|font_style:400%20regular%3A400%3Anormal';
		}
		if ( 'muktavaani500' == $font ) {
			$output = 'font_family:Mukta%20Vaani%3A200%2C300%2C400%2Cregular%2C500%2C600%2C700%2C800|font_style:500%20medium%3A500%3Anormal';
		} elseif ( 'muktavaani600' == $font ) {
			$output = 'font_family:Mukta%20Vaani%3A200%2C300%2C400%2Cregular%2C500%2C600%2C700%2C800|font_style:600%20medium%3A600%3Anormal';
		} elseif ( 'roboto' == $font ) {
			$output = 'font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:400%20regular%3A400%3Anormal';
		} elseif ( 'oswald' == $font ) {
			$output = 'font_family:Oswald%3A300%2Cregular%2C700|font_style:600%20medium%3A600%3Anormal';
		} elseif ( 'teko' == $font ) {
			$output = 'font_family:Teko%3A300%2Cregular%2C500%2C600%2C700|font_style:400%20regular%3A400%3Anormal';
		}

		return $output;
	}

	public static function get_typo_css_custom_cat( $id_block, $atts ) {
		$css_custom = self::get_typo_css_custom( array(
			'e_admin'      => 'cat',
			'font-size'    => '10px',
			'google_fonts' => self::get_font_family( 'roboto' ),
			'template'     => $id_block . '.penci-block-vc .penci-cat-name{ %s }',
		), $atts );

		return $css_custom;
	}

	public static function get_typo_css_custom_pagination( $id_block, $atts ) {

		$widget = false;
		if ( isset( $atts['block_id'] ) && false !== strpos( $atts['block_id'], 'penci-widget__' ) ) {
			$widget = true;
		}

		$template = '';
		if ( 'pagination' == $atts['style_pag'] ) {
			$template = $id_block . ' .penci-pagination:not(.penci-ajax-more) a,' . $id_block . ' .penci-pagination:not(.penci-ajax-more) span{ %s }';
		} elseif ( 'load_more' == $atts['style_pag'] ) {
			$template = $id_block . ' .penci-ajax-more .penci-block-ajax-more-button{ padding-top:0; %s }';
		}

		$css_custom = self::get_typo_css_custom( array(
			'e_admin'      => 'pag_loadmore',
			'font-size'    => '14px',
			'google_fonts' => self::get_font_family( 'roboto', $widget ),
			'template'     => $template,
		), $atts );

		return $css_custom;
	}

	public static function get_typo_css_custom_readmore( $id_block, $atts ) {
		$css_custom = '';

		$css_read_button = $css_read_button_hover = '';

		$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
			'e_admin'      => 'readmore',
			'font-size'    => '13px',
			'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
			'template'     => $id_block . ' .penci-pmore-link .more-link{ %s }',
		), $atts );

		if ( $atts['readmore_text_color'] ) {
			$css_read_button .= 'color:' . $atts['readmore_text_color'] . ';';
		}
		if ( $atts['readmore_bg_color'] ) {
			$css_read_button .= 'background-color:' . $atts['readmore_bg_color'] . ';';
		}
		if ( $atts['readmore_text_hcolor'] ) {
			$css_read_button_hover .= 'color:' . $atts['readmore_text_hcolor'] . ';';
		}
		if ( $atts['readmore_bg_hcolor'] ) {
			$css_read_button_hover .= 'background-color:' . $atts['readmore_bg_hcolor'] . ';';
		}

		if ( $css_read_button ) {
			$css_custom .= $id_block . ' .penci-pmore-link .more-link{ ' . esc_attr( $css_read_button ) . ' }';
		}
		if ( $css_read_button_hover ) {
			$css_custom .= $id_block . ' .penci-pmore-link .more-link:hover{ ' . esc_attr( $css_read_button_hover ) . ' }';
		}

		return $css_custom;
	}

	public static function get_post_count( $atts ) {

		$atts['limit'] = - 1;

		$query_block = Penci_Pre_Query::do_query( $atts );

		return $query_block->post_count;
	}

	public static function get_general_param_frontend_shortcode( $atts, $shortcode_id ) {

		$unique_id = 'penci_' . $shortcode_id . '__' . rand( 1000, 100000000 );

		if ( isset( $atts['block_id'] ) && false !== strpos( $atts['block_id'], 'penci-widget__' ) && is_customize_preview() ) {
			$unique_id = 'penci_' . $shortcode_id . '__' . rand( 1000, 100000 );
		}

		$block_content_id     = $unique_id . 'block_content';
		$atts['paged']        = 1;
		$atts['unique_id']    = $unique_id;
		$atts['shortcode_id'] = $shortcode_id;

		return array( $atts, $block_content_id, $unique_id );
	}

	/**
	 * Replace link tweet
	 *
	 * @param $text
	 *
	 * @return string
	 */
	public static function tweets_convert_links( $text ) {
		$text = preg_replace( '#https?://[a-z0-9._/-]+#i', '<a rel="nofollow" target="_blank" href="$0">$0</a>', $text );
		$text = preg_replace( '#@([a-z0-9_]+)#i', '@<a rel="nofollow" target="_blank" href="http://twitter.com/$1">$1</a>', $text );
		$text = preg_replace( '# \#([a-z0-9_-]+)#i', ' #<a rel="nofollow" target="_blank" href="http://twitter.com/search?q=%23$1">$1</a>', $text );

		return $text;
	}

	public static function check_blockvc_is_widget( $atts ) {
		$widget = false;
		if ( isset( $atts['block_id'] ) && false !== strpos( $atts['block_id'], 'penci-widget__' ) ) {
			$widget = true;
		}

		return $widget;
	}

	public static function getImageBySize( $params = array() ) {
		$params = array_merge( array(
			'post_id'    => null,
			'attach_id'  => null,
			'thumb_size' => 'thumbnail',
			'class'      => '',
		), $params );

		if ( ! $params['thumb_size'] ) {
			$params['thumb_size'] = 'thumbnail';
		}

		if ( ! $params['attach_id'] && ! $params['post_id'] ) {
			return false;
		}

		$post_id = $params['post_id'];

		$attach_id   = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
		$attach_id   = apply_filters( 'vc_object_id', $attach_id );
		$thumb_size  = $params['thumb_size'];
		$thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';

		global $_wp_additional_image_sizes;
		$thumbnail = '';

		if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, array(
					'thumbnail',
					'thumb',
					'medium',
					'large',
					'full',
				) ) ) ) {
			$attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );
			$thumbnail  = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
		} elseif ( $attach_id ) {
			if ( is_string( $thumb_size ) ) {
				preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
				if ( isset( $thumb_matches[0] ) ) {
					$thumb_size = array();
					$count      = is_array( $thumb_matches[0] ) ? count( $thumb_matches[0] ) : 0;
					if ( $count > 1 ) {
						$thumb_size[] = $thumb_matches[0][0]; // width
						$thumb_size[] = $thumb_matches[0][1]; // height
					} elseif ( 1 === $count ) {
						$thumb_size[] = $thumb_matches[0][0]; // width
						$thumb_size[] = $thumb_matches[0][0]; // height
					} else {
						$thumb_size = false;
					}
				}
			}
			if ( is_array( $thumb_size ) ) {
				// Resize image to custom size
				$p_img      = wpb_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
				$alt        = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
				$attachment = get_post( $attach_id );
				if ( ! empty( $attachment ) ) {
					$title = trim( strip_tags( $attachment->post_title ) );

					if ( empty( $alt ) ) {
						$alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
					}
					if ( empty( $alt ) ) {
						$alt = $title;
					} // Finally, use the title
					if ( $p_img ) {

						$thumbnail = sprintf( '<img class="%s" src="%s" data-src="%s" width="%s" height="%s" alt="%s" title="%s">', $thumb_class, $p_img['url'], $p_img['url'], $p_img['width'], $p_img['height'], $alt, $title );
					}
				}
			}
		}

		return $thumbnail;
	}

	public static function get_url_image_by_size( $params = array() ) {
		$params = array_merge( array(
			'post_id'    => null,
			'attach_id'  => null,
			'thumb_size' => 'thumbnail',
			'class'      => '',
		), $params );

		if ( ! $params['thumb_size'] ) {
			$params['thumb_size'] = 'thumbnail';
		}

		if ( ! $params['attach_id'] && ! $params['post_id'] ) {
			return false;
		}

		$post_id = $params['post_id'];

		$attach_id   = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
		$attach_id   = apply_filters( 'vc_object_id', $attach_id );
		$thumb_size  = $params['thumb_size'];
		$thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';

		global $_wp_additional_image_sizes;
		$thumbnail = '';

		if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, array(
					'thumbnail',
					'thumb',
					'medium',
					'large',
					'full',
				) ) ) ) {
			$thumbnail = wp_get_attachment_image_src( $attach_id, $thumb_size );
		} elseif ( $attach_id ) {
			if ( is_string( $thumb_size ) ) {
				preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
				if ( isset( $thumb_matches[0] ) ) {
					$thumb_size = array();
					$count      = is_array( $thumb_matches[0] ) ? count( $thumb_matches[0] ) : 0;;
					if ( $count > 1 ) {
						$thumb_size[] = $thumb_matches[0][0]; // width
						$thumb_size[] = $thumb_matches[0][1]; // height
					} elseif ( 1 === $count ) {
						$thumb_size[] = $thumb_matches[0][0]; // width
						$thumb_size[] = $thumb_matches[0][0]; // height
					} else {
						$thumb_size = false;
					}
				}
			}
			if ( is_array( $thumb_size ) ) {
				// Resize image to custom size
				$p_img      = wpb_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
				$alt        = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
				$attachment = get_post( $attach_id );
				if ( ! empty( $attachment ) ) {
					$title = trim( strip_tags( $attachment->post_title ) );

					if ( empty( $alt ) ) {
						$alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
					}
					if ( empty( $alt ) ) {
						$alt = $title;
					} // Finally, use the title
					if ( $p_img ) {

						$thumbnail = isset( $p_img['url'] ) ? $p_img['url'] : '';
					}
				}
			}
		}

		return $thumbnail;
	}

	public static function get_class_item_scolours( $slider_i ) {
		echo 'penci-item-style penci-item-style' . $slider_i;
	}

	/**
	 * Get code in feed ad
	 *
	 * @param $args
	 *
	 * @return string|void
	 */
	public static function get_markup_infeed_ad( $args ) {
		$defaults = array(
			'before'     => '<div class="penci-infeed_ad penci-post-item">',
			'after'      => '</div>',
			'order_ad'   => '2',
			'order_post' => '',
			'code'       => '',
			'echo'       => false
		);

		$r = wp_parse_args( $args, $defaults );

		if ( $r['order_ad'] != $r['order_post'] || empty( $r['code'] ) ) {
			return;
		}

		$output = $r['before'];
		$output .= rawurldecode( base64_decode( strip_tags( $r['code'] ) ) );
		$output .= $r['after'];

		if ( ! $r['echo'] ) {
			return $output;
		}

		echo do_shortcode( $output );
	}

	public static function get_user_roles() {
		$roles = array();

		$all_roles = wp_roles()->roles;

		/**
		 * Filters the list of editable roles.
		 *
		 * @param array $all_roles List of roles.
		 *
		 * @since 2.8.0
		 *
		 */
		$editable_roles = apply_filters( 'editable_roles', $all_roles );

		foreach ( $editable_roles as $role => $options ) {
			$roles[ $role ] = $options['name'];
		}

		return $roles;
	}

	public static function get_css_media_by_width( $width = '768' ) {
		return '@media screen and (min-width: ' . $width . 'px ){';
	}
}
