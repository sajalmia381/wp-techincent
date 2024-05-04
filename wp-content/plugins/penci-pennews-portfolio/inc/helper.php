<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Pennew_Portfolio_Helper' ) ) {
	class Pennew_Portfolio_Helper{
		public function __construct() {
			add_action( 'wp_ajax_nopriv_penci_ajax_portfolio', array( $this, 'ajax_callback' ) );
			add_action( 'wp_ajax_penci_ajax_portfolio', array( $this, 'ajax_callback' ) );
		}

		public function ajax_callback() {
			$datafilter  = isset( $_POST['datafilter'] ) ? $_POST['datafilter'] : '';
			$atts        = isset( $datafilter['atts'] ) ? $datafilter['atts'] : '';
			$query       = isset( $datafilter['query'] ) ? $datafilter['query'] : '';
			$shown_ids   = isset( $datafilter['pflShowIds'] ) ? $datafilter['pflShowIds'] : '';
			$count       = isset( $datafilter['count'] ) ? $datafilter['count'] : '';
			$count_terms = isset( $datafilter['countByTerms'] ) ? $datafilter['countByTerms'] : '';
			$currentTerm = isset( $datafilter['currentTerm'] ) ? $datafilter['currentTerm'] : '';
			$currentTax  = isset( $datafilter['currentTax'] ) ? $datafilter['currentTax'] : '';
			$numbermore  = isset( $atts['numbermore'] ) ? $atts['numbermore'] : '';
			$style       = isset( $atts['style'] ) ? $atts['style'] : '';
			$image_type  = isset( $atts['image_type'] ) ? $atts['image_type'] : '';

			extract( $atts );

			$image_thumb = Pennew_Portfolio_Helper::get_image_size( $style, $image_type );

			$pre_query = array_merge( $query, array(
				'ignore_sticky_posts' => true,
				'post__not_in'        => $shown_ids,
				'paged'               => 0,
				'posts_per_page'      => $numbermore,
			) );

			if ( $currentTerm && '*' != $currentTerm && $currentTax ) {
				$pre_query['tax_query'] = array(
					array(
						'taxonomy' => $currentTax,
						'field'    => 'slug',
						'terms'    => $currentTerm
					)
				);
			}

			$show_pag = false;
			$portfolio_query = new WP_Query( $pre_query );
			ob_start();
			if ( ! $portfolio_query->have_posts() ) {
				wp_send_json_success( array( 'items' => '', 'hasMore' => $show_pag ) );
			}
			$portfolio_i = 0;
			while ( $portfolio_query->have_posts() ):
				$portfolio_query->the_post();
				include PENCI_PORTFOLIO__DIR . "/template/content-portfolio.php";

				$portfolio_i ++;
			endwhile;
			wp_reset_postdata();

			$content_items = ob_get_clean();

			$post_count  = $portfolio_query->post_count;

			if ( '*' == $currentTerm ) {
				$shown_items = count( (array)$shown_ids ) + $post_count;
				$show_pag = $shown_items < $count;
			} else {
				$query_current_term = array_merge( $pre_query, array(
					'fields'         => 'ids',
					'posts_per_page' => - 1,
					'post__not_in'   => ''
				) );

				$get_category_ids = array_intersect( $shown_ids, get_posts( $query_current_term ) );
				$shown_items      = count( (array)$get_category_ids ) + $post_count;
				$post_count_Term = isset( $count_terms[$currentTerm] ) ? $count_terms[$currentTerm] : 0;
				$show_pag         = $shown_items < $post_count_Term;
			}

			wp_send_json_success( array( 'items' => $content_items, 'show_pag' => $show_pag ) );
		}

		public static function get_html_pagination( $custom_query = false, $atts = array(), $data_query = array() ) {
			$atts = wp_parse_args( $atts, array(
				'style'         => 'masonry',
				'column'        => '3',
				'filter'        => 'true',
				'all_text'      => __( 'All', 'pencidesign' ),
				'style_pag'     => '',
				'numbermore'    => 6,
				'loadmore_text' => function_exists( 'penci_get_tran_setting' ) ?  penci_get_tran_setting( 'penci_click_handle_text' ) : esc_html__( 'Load More', 'penci-framework' ),
				'no_more_text'  => function_exists( 'penci_get_tran_setting' ) ?  penci_get_tran_setting( 'penci_content_no_more_post_text' ) : esc_html__( 'Sorry, No more', 'penci-framework' ),
				'more_link'     => '',
				'pag_pos'       => 'center',
				'build_query'   => ''
			) );

			$number = isset( $data_query['size'] ) ? intval( $data_query['size'] ) : '12';

			if ( $number <= 0  ) {
				return;
			}

			if ( in_array( $atts['style_pag'], array( 'load_more', 'infinite' ) ) ) {
				printf(
					'<div class="penci-pagination penci-ajax-more  penci-pag-%s">
						<a class="penci-portfolio-more-button button %s %s">
							<span class="ajax-more-text">%s</span>
							<span class="penci-portfolio-ajaxdot penci-pfl-ajaxdot">
								<span class="dot dot1"></span>
								<span class="dot dot2"></span>
								<span class="dot dot3"></span>
								<span class="dot dot4"></span>
							</span>
							<span class="ajax-more-finished">%s</span>
						</a>
					</div>',
					$atts['pag_pos'],
					$atts['style_pag'],
					'penci-plf-loading-2',
					function_exists( 'penci_get_tran_setting' ) ?  penci_get_tran_setting( 'penci_loadmore__text' ) : esc_html__( 'Load More', 'penci-framework' ),
					function_exists( 'penci_get_tran_setting' ) ?  penci_get_tran_setting( 'penci_content_no_more_post_text' ) : esc_html__( 'Sorry, No more', 'penci-framework' )
				);
			} elseif( 'showmore' == $atts['style_pag'] ) {
				$more_link = vc_build_link( $atts['more_link'] );
				$url       = isset( $more_link['url'] ) ? $more_link['url'] : '';
				$title     = isset( $more_link['title'] ) ? $more_link['title'] : '';

				if ( $url && $title ) {
					printf(
						'<div class="penci-pagination penci-ajax-more penci-pag-%s">
							<a class="penci-portfolio-more-button button %s" href="%s" target="%s">
							<span class="ajax-more-text">%s</span>
							</a>
						</div>',
						$atts['pag_pos'],
						$atts['style_pag'],
						esc_url( $url ),
						isset( $more_link['target'] ) ? $more_link['target'] : '',
						esc_html( $title )
					);
				}
			}elseif( 'numeric' == $atts['style_pag'] ) {
				echo '<div class="penci-pagenavi-shortcode">' . penci_pagination_numbers( $custom_query, $atts['pag_pos'] ) . '</div>';
			}
		}

		public static function is_use_option( $id = '' ) {
			if ( empty( $id ) ) {
				$id = get_the_ID();
			}

			return get_post_meta( $id, 'penci_pfl_use_opt_current_page', true );
		}

		public static function get_image_size ( $layout = '', $image_type = '' ) {
			$image_thumb = 'penci-thumb-480-320';

			if ( empty( $layout ) ) {
				$layout = get_theme_mod( 'penci_portfolio_layout' );
				$layout = $layout ? $layout : 'masonry';
			}

			if ( $layout == 'masonry' ) {
				$image_thumb = 'penci-masonry-thumb';
			}

			if ( function_exists( 'penci_get_archive_image_type' ) ) {
				$image_thumb = penci_get_archive_image_type( $image_thumb, $image_type );
			}

			return $image_thumb;
		}

		public static function get_slug(){
			return get_theme_mod( 'penci_pfl_custom_slug' ) ? get_theme_mod( 'penci_pfl_custom_slug' ) : 'portfolio';
		}

		public static function get_slug_tax(){
			return get_theme_mod( 'penci_pfl_custom_catslug' ) ? get_theme_mod( 'penci_pfl_custom_catslug' ) : 'portfolio-category';
		}

		public static function pre_Ratio( $width, $height ) {
			return number_format( $height / $width * 100, 8 );
		}

		public static function get_image_ratio( $image, $style, $image_type, $echo = true , $disable_lazyload = false ) {
			$ratio = '0.666666667';

			if ( false === strpos( $image, '<img' ) ) {
				return $image;
			}
			$src_img   = '';
			$pre_image = $image;
			if ( preg_match( '@src="([^"]+)"@', $pre_image, $match ) ) {
				$src_img = array_pop( $match );
			}

			if( 'grid' == $style ){
				if( 'square' == $image_type ){
					$ratio = 'padding-bottom: 100%';
				}elseif( 'vertical' == $image_type ){
					$ratio = 'padding-bottom: 125%';
				}else{
					$ratio = 'padding-bottom: 66.6666667%';
				}
			} elseif ( preg_match_all( '#(width|height)=(\'|")?(?<dimensions>[0-9]+)(\'|")?#i', $image, $image_dis ) && 2 == count( (array)$image_dis['dimensions'] ) ) {
				$ratio = 'padding-bottom:' . self::pre_Ratio( $image_dis['dimensions'][0], $image_dis['dimensions'][1] ) . '%';
			}

			if( ! $disable_lazyload ) {
				if ( preg_match( '(class=(\'|")[^"]+)', $image, $class_el ) ) {
					$image = str_replace( $src_img, PENCI_PORTFOLIO__URL . 'images/penci-holder.png', $image );
					$image = str_replace( $class_el[0], $class_el[0] . ' penci-pfl-lazy" data-src="' . $src_img, $image );
				}

				if ( preg_match( '@srcset="([^"]+)"@', $image, $match ) ) {
					$srcset_img = array_pop( $match );
					$image = str_replace( $srcset_img, '', $image );
				}
			}

			$output = '<span class="penci-image-placeholder' . ( $disable_lazyload ? ' penci-lazyloaded' : '' ) . '" style="' . $ratio . '">' . $image . '</span>';

			if ( ! $echo ) {
				return $output;
			}

			echo $output;
		}
		
	}
}

new Pennew_Portfolio_Helper;
