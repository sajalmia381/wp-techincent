<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Penci_Portfolio_Shortcode_Frontend' ) ) {

	class Penci_Portfolio_Shortcode_Frontend {

		public function __construct() {
			add_shortcode( 'portfolio', array( $this, 'portfolio_callback' ) );
		}

		public function portfolio_callback( $atts, $content = null ) {
			$filter = $all_text = $style = $image_type =  $layout = $number = $column = $cat =  $item_style = $space_item = '';
			$dis_bg_block = $css = $class = $pag_pos = $nav_style = $offset = $build_query = '';

			$atts = shortcode_atts( array(
				'style'                  => 'masonry',
				'image_type'             => 'landscape',
				'column'                 => '3',
				'filter'                 => 'true',
				'all_text'               => __( 'All', 'pencidesign' ),
				'dis_bg_block'           => false,
				'css'                    => '',
				'class'                  => '',
				'pag_pos'                => 'center',
				'style_pag'              => '',
				'numbermore'             => 6,
				'item_style'             => '',
				'hide_cat'               => false,
				'loadmore_text'          => esc_html__( 'Load More', 'penci-framework' ),
				'no_more_text'           => esc_html__( 'Sorry, No more', 'penci-framework' ),
				'build_query'            => 'post_type:portfolio',
				'dis_subcat_filter'      => '',
				'only_cat_select'        => '',
				'_animation'             => 'fadeInPortfolio',
				'_effect'                => 'slidenfade-one',
				'space_item'             => '',
				'space_item'             => '',
				'more_link'              => '',
				'pfl_filter_color'       => '',
				'pfl_filter_hcolor'      => '',
				'pfl_filter_slash_color' => '',
				'pfl_title_color'        => '',
				'pfl_title_hcolor'       => '',
				'pfl_cat_color'          => '',
				'pfl_cat_hcolor'         => '',
				'pfl_overlay_color'      => '',
				'pfl_overlay_opacity'    => '',
				'readmore_text_color'    => '',
				'readmore_bg_color'      => '',
				'readmore_border_color'  => '',
				'readmore_text_hcolor'   => '',
				'readmore_border_hcolor' => '',
				'readmore_bg_hcolor'     => '',
				'readmore_margin_top'    => '',
				'readmore_bwidth'        => '',

				'pfl_filter_fonts'     => '',
				'pfl_title_fonts'      => '',
				'pfl_title_font_style' => '',
				'pfl_title_font_size'  => '',
				'pfl_cat_fonts'        => '',
				'pfl_cat_font_style'   => '',
				'pfl_cat_font_size'    => '',

				'pflbig_title_fonts'      => '',
				'pflbig_title_font_style' => '',
				'pflbig_title_font_size'  => '',
				'pflbig_cat_fonts'        => '',
				'pflbig_cat_font_style'   => '',
				'pflbig_cat_font_size'    => '',
				'pfl_dis_lazyload_img'    => '',
			), $atts );

			extract( $atts );

			$unique_id    = 'penci-portfolio' . '--' . rand( 1000, 100000 );

			$class = isset( $atts['class'] ) ? $atts['class'] : '';
			$class .= $item_style ? ' penci-portfolio-' . $item_style : '';
			$class .= $style ? ' penci-portfolio-' . $style : '';
			$class .=  function_exists( 'vc_shortcode_custom_css_class' ) ?  ' ' . vc_shortcode_custom_css_class( $css, '' ) : '';

			$class_pfl_item = 'penci-portfolio penci-portfolio-wrap';
			$class_pfl_item .= $column && 'mix' != $style ? ' column-' . $column : '';
			$class_pfl_item .= $layout ? ' penci-portfolio-' . $layout : '';

			/* Set default value when properties is not valid */

			$image_thumb = 'penci-thumb-480-320';
			if ( $style == 'masonry' ): $image_thumb = 'penci-masonry-thumb'; endif;

			if ( class_exists( 'Penci_Helper_Shortcode' ) ) {
				$image_thumb = Penci_Helper_Shortcode::get_image_size_by_type( $image_thumb, $image_type );
			}

			if ( ! is_numeric( $number ) ): $number = '-1'; endif;
			if ( $filter != 'false' ): $filter = 'true'; endif;
			if ( empty( $all_text ) ): $all_text = ''; endif;

			/* Display Portfolio */
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}

			$data_query    = PenciLoopSettings::parseData( $build_query );
			if( ! isset( $data_query['size'] ) ) {
				$data_query['size'] = 12;
			}

			$query_builder = new PenciLoopQueryBuilder( $data_query );
			$query         = $query_builder->build_args();

			$query['paged'] = $paged;

			$portfolio_query = new WP_Query( $query );
			if ( ! $portfolio_query->have_posts() ) {
				return;
			}

			$portfolio_tax   = $this->get_taxs_by_post_type( $data_query );
			$portfolio_terms = $this->get_terms_by_query( $query, $portfolio_tax );
			$cat_active      = $this->get_portfolio_cat_active( $data_query );
			$cat_select      = $this->get_only_cat_select( $data_query );


			ob_start();

			?>

			<div id="<?php echo $unique_id; ?>"  class="wrapper-penci-portfolio <?php echo $class; ?>">
				<?php if ( $filter == 'true' ):
					?>
					<?php if ( ! empty( $portfolio_terms ) ): ?>
					<div class="penci-portfolio-filter">
						<ul class="penci-pfl-root-cats">
							<?php if( ! empty( $all_text ) ): ?>
							<li class="all<?php echo ( '' == $cat_active ? ' active' : '' ); ?>">
								<a data-term="*" href="#"><?php echo do_shortcode( $all_text ); ?></a>
							</li>
							<?php endif; ?>
							<?php

							foreach ( $portfolio_terms as $term ){
								if ( 0 != $term->parent ) {
									continue;
								}

								$term_id  = isset( $term->term_id ) ? $term->term_id : '';
								$taxonomy  = isset( $term->taxonomy ) ? $term->taxonomy : '';
								if( $atts['only_cat_select'] && ! in_array( $term_id, $cat_select ) ) {
									continue;
								}

								$term_slug  = isset($term->slug ) ? $term->slug : '';


								printf( '<li class="penci-pfl-cat-item penci-pfl-%s%s"><a data-term="%s" data-tax="%s" href="#">%s</a></li>',
									esc_attr( $term->slug ),
									$cat_active == $term_slug ? ' active' : '',
									esc_attr( $term->slug ),
									$taxonomy,
									//$this->get_term_link_by_tax( $term , $portfolio_tax ),
									esc_html( $term->name )
								);
							}
							?>
						</ul>
						<?php
						if( ! $atts['dis_subcat_filter'] ){
							foreach ( $portfolio_terms as $term ){
								$this->get_subcat_filter_by_parent_id( $term, array(
									'available_terms'  => $portfolio_terms,
									'cat_active' => $cat_active,
									'portfolio_tax' => $portfolio_tax,
								) );
							}
						}
						?>

					</div><!-- .portfolio-filter -->
					<div class="clearfix"></div>
				<?php endif;?>
				<?php endif; ?>
				<div class="<?php echo $class_pfl_item; ?>">
					<?php
					$portfolio_i = 0;
					while ( $portfolio_query->have_posts() ):
						$portfolio_query->the_post();
						include PENCI_PORTFOLIO__DIR . "/template/content-portfolio.php";
						$portfolio_i ++;
					endwhile; wp_reset_postdata();
					?>
				</div>
				<?php Pennew_Portfolio_Helper::get_html_pagination( $portfolio_query, $atts, $data_query  ); ?>
			</div>

			<?php
			// Category Counter
			$category_post_count = array();

			$category_query = array_merge( $query, array(
				'paged'               => 0,
				'posts_per_page'      => -1,
				'portfolio_category'  => '',
				'fields'			  => 'ids'
			) );

			$get_posts_category_query = get_posts( $category_query );

			$all_items_count = count( (array)$get_posts_category_query );
			$category_tax_query = isset( $category_query['tax_query'] ) ? $category_query['tax_query'] : array();

			foreach ( $portfolio_terms as $term ) {

				$category_query['tax_query'] = array_merge( $category_tax_query, array(
					'relation' => 'AND',
					array(
						'taxonomy'           => $portfolio_tax,
						'field'              => 'term_id',
						'terms'              => $term->term_id,
						'include_children'   => false
					)
				) );
				$get_posts_category_query2 = get_posts( $category_query );
				$category_post_count[ $term->slug ] = count( (array)$get_posts_category_query2 );
			}

			$portfolio_data_js = array(
				'atts'         => $atts,
				'instanceId'   => $unique_id,
				'data_query'   => $data_query,
				'query'        => $query,
				'count'        => $all_items_count,
				'countByTerms' => $category_post_count,
				'currentTerm'  => '*',
				'currentTax'  => '',
			);
			?>
			<script type="text/javascript">
				portfolioDataJs.push( <?php echo json_encode( $portfolio_data_js ); ?> );
			</script>
			<?php
			$portfolio_id = '#' . $unique_id;
			$css_custom = '';
			if ( $dis_bg_block ) {
				$css_custom .= '#' . $unique_id . '.wrapper-penci-portfolio{ background-color: transparent !important; }';
			}

			if ( $space_item || '0' == $space_item ) {

				$space_item_pre = $space_item_wrap = 0;
				if ( 0 != $space_item ) {
					$space_item_pre  = intval( $space_item / 2 );
					$space_item_wrap = - $space_item_pre;
				}

				$css_custom .= '#' . $unique_id . ' .penci-portfolio-wrap{ margin-left: ' . $space_item_wrap . 'px; margin-right: ' . $space_item_wrap . 'px; }';
				$css_custom .= '#' . $unique_id . ' .penci-portfolio-wrap .portfolio-item{ padding-left: ' . $space_item_pre . 'px; padding-right: ' . $space_item_pre . 'px; margin-bottom:' . intval( $space_item ) . 'px; }';
			}

			if( $atts['pfl_filter_color'] ) {
				$css_custom .= sprintf( '%s .penci-portfolio-filter ul li a{ color:%s; }', $portfolio_id, esc_attr( $atts['pfl_filter_color'] ) );
			}
			if( $atts['pfl_filter_slash_color'] ) {
				$css_custom .= sprintf( '%s .penci-portfolio-filter ul li:after{ color:%s;  opacity: 1; }', $portfolio_id, esc_attr( $atts['pfl_filter_slash_color'] ) );
			}
			if( $atts['pfl_filter_hcolor'] ) {
				$css_custom .= sprintf( '%s .penci-portfolio-filter ul li.active a, %s .penci-portfolio-filter ul li a:hover { color:%s; }',
					$portfolio_id,$portfolio_id, esc_attr( $atts['pfl_filter_hcolor'] ) );
			}

			if ( isset( $atts['pfl_title_color'] ) && $atts['pfl_title_color'] ) {
				$css_custom .= sprintf( '%s .inner-item-portfolio .portfolio-desc h3,
				 %s .penci-portfolio-below_img .inner-item-portfolio .portfolio-desc h3{ color:%s; }', $portfolio_id, $portfolio_id, esc_attr( $atts['pfl_title_color'] ) );
			}

			if( isset( $atts['pfl_title_hcolor'] ) && $atts['pfl_title_hcolor'] ) {
				$css_custom .= sprintf( '%s .inner-item-portfolio .portfolio-desc h3:hover,
		       %s .penci-portfolio-below_img .inner-item-portfolio .portfolio-desc h3:hover{ color:%s; }', $portfolio_id, $portfolio_id, esc_attr( $atts['pfl_title_hcolor'] ) );
			}

			if( isset( $atts['pfl_cat_color'] ) && $atts['pfl_cat_color'] ) {
				$css_custom .= sprintf( '%s .inner-item-portfolio .portfolio-desc span{ color:%s; }', $portfolio_id, esc_attr( $atts['pfl_cat_color'] ) );
			}

			if( isset( $atts['pfl_cat_hcolor'] ) && $atts['pfl_cat_hcolor'] ) {
				$css_custom .= sprintf( '% .inner-item-portfolio .portfolio-desc span:hover{ color:%s; }',$portfolio_id, esc_attr( $atts['pfl_cat_hcolor'] ) );
			}

			if( isset( $atts['pfl_overlay_color'] ) && $atts['pfl_overlay_color'] ) {
				$css_custom .= sprintf( '%s .penci-portfolio-thumbnail a:after{ background-color:%s; }', $portfolio_id, esc_attr( $atts['pfl_overlay_color'] ) );
			}

			if( isset( $atts['pfl_overlay_opacity'] ) && $atts['pfl_overlay_opacity'] ) {
				$css_custom .= sprintf( '%s .inner-item-portfolio:hover .penci-portfolio-thumbnail a:after,%s .penci-portfolio-below_img .inner-item-portfolio:hover .penci-portfolio-thumbnail a:after{ opacity:%s; }',
					$portfolio_id,
					$portfolio_id,
					esc_attr( $atts['pfl_overlay_opacity'] ) );
			}

			$btn_readmore_css = '';
			if( isset( $atts['readmore_text_color'] ) && $atts['readmore_text_color'] ) {
				$btn_readmore_css .= 'color:' . esc_attr( $atts['readmore_text_color'] ) . ';';
			}if( isset( $atts['readmore_bg_color'] ) && $atts['readmore_bg_color'] ) {
				$btn_readmore_css .= 'background-color:' . esc_attr( $atts['readmore_bg_color'] ) . ';';
			}if( isset( $atts['readmore_border_color'] ) && $atts['readmore_border_color'] ) {
				$btn_readmore_css .= 'border-color:' . esc_attr( $atts['readmore_border_color'] ) . ';';
			}if( isset( $atts['readmore_bwidth'] ) && $atts['readmore_bwidth'] ) {
				$btn_readmore_css .= 'border-width:' . esc_attr( $atts['readmore_bwidth'] ) . 'px;';
				$line_height = 40 - ( intval( $atts['readmore_bwidth'] ) * 2 );
				$btn_readmore_css .= 'line-height: ' . $line_height . 'px;';

			}if( isset( $atts['readmore_margin_top'] ) && $atts['readmore_margin_top'] ) {
				$btn_readmore_css .= 'margin-top:' . esc_attr( $atts['readmore_margin_top'] ) . 'px;';
			}

			if( $btn_readmore_css ) {
				$css_custom .= $portfolio_id . ' .penci-ajax-more a.penci-portfolio-more-button{ ' . $btn_readmore_css . ' }';
			}

			$readmore_hover_css = '';
			if( isset( $atts['readmore_text_hcolor'] ) && $atts['readmore_text_hcolor'] ) {
				$readmore_hover_css .= 'color:' . esc_attr( $atts['readmore_text_hcolor'] ) . ';';
			}if( isset( $atts['readmore_border_hcolor'] ) && $atts['readmore_border_hcolor'] ) {
				$readmore_hover_css .= 'border-color:' . esc_attr( $atts['readmore_border_hcolor'] ) . ';';
			}if( isset( $atts['readmore_bg_hcolor'] ) && $atts['readmore_bg_hcolor'] ) {
				$readmore_hover_css .= 'background-color:' . esc_attr( $atts['readmore_bg_hcolor'] ) . ';';
			}

			if( $readmore_hover_css ) {
				$css_custom .= $portfolio_id . ' .penci-ajax-more a.penci-portfolio-more-button:hover { ' . $readmore_hover_css . ' }';
			}

			if( class_exists( 'Penci_Helper_Shortcode' ) ){
				$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
					'e_admin'      => 'pfl_filter',
					'font-size'    => '',
					'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
					'template' => $portfolio_id .' .penci-portfolio-filter ul li a{ %s }' ,
				), $atts
				);

				$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
					'e_admin'      => 'pfl_title',
					'font-size'    => '20px',
					'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
					'template' => $portfolio_id .' .inner-item-portfolio .portfolio-desc h3{ %s }' ,
				), $atts
				);

				$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
					'e_admin'      => 'pfl_cat',
					'font-size'    => '12px',
					'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
					'template'     => $portfolio_id . ' .inner-item-portfolio .portfolio-desc span{ %s }',
				), $atts );
				$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
					'e_admin'      => 'pflbig_title',
					'font-size'    => '20px',
					'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
					'template' => $portfolio_id .' .penci-pfl-big-item .inner-item-portfolio .portfolio-desc h3{ %s }' ,
				), $atts
				);

				$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
					'e_admin'      => 'pflbig_cat',
					'font-size'    => '12px',
					'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
					'template'     => $portfolio_id . ' .penci-pfl-big-item .inner-item-portfolio .portfolio-desc span{ %s }',
				), $atts
				);
			}

			$disable_lazyload = penci_get_theme_mod( 'penci_disable_lazyload' );
			if ( isset( $pfl_dis_lazyload_img ) ) {
				if ( 'yes' == $pfl_dis_lazyload_img ) {
					$disable_lazyload = true;
				} elseif ( 'no' == $pfl_dis_lazyload_img ) {
					$disable_lazyload = false;
				}
			}
			if( $disable_lazyload ){
				$css_custom .= '.penci-image-placeholder.penci-lazyloaded > img{ opacity: 1; visibility: visible; }';
			}

			if ( $css_custom ) {
				echo '<style>';
				echo $css_custom;
				echo '</style>';
			}

			$return = ob_get_clean();

			return $return;
		}

		public function get_terms_by_query( $args, $tax = 'portfolio-category' ) {
			if( ! $tax ) {
				return array();
			}

			// Remove param paged
			if ( isset( $args['paged'] ) ) {
				unset( $args['paged'] );
			}
			$args['fields']         = 'ids';
			$args['posts_per_page'] = - 1;

			$posts = new WP_Query( $args );

			if ( ! $posts->have_posts() ) {
				return;
			}

			$object_terms = wp_get_object_terms( $posts->posts, $tax );

			if ( is_wp_error( $object_terms ) ) {
				return array();
			}

			$term_ids = array();
			if ( $object_terms ) {
				foreach ( (array) $object_terms as $term ) {
					$term_ids[] = $term->term_id;
				}

				foreach ( (array) $object_terms as $term ) {
					if ( ! in_array( $term->parent, $term_ids ) ) {
						$term->parent = 0;
					}
				}
			}
			return $object_terms;
		}

		public function get_subcat_filter_by_parent_id( $parent_term, $args ) {
			$available_terms = isset( $args['available_terms'] ) ? $args['available_terms'] : '';
			$cat_active      = isset( $args['cat_active'] ) ? $args['cat_active'] : '';
			$portfolio_tax   = isset( $args['portfolio_tax'] ) ? $args['portfolio_tax'] : '';

			$sub_terms = array();

			if ( empty( $available_terms ) || ! is_array( $available_terms ) ) {
				return;
			}

			foreach ( $available_terms as $term ) {
				if ( $term->parent == $parent_term->term_id ) {
					$sub_terms[] = $term;
				}
			}

			if ( ! count( (array)$sub_terms ) ) {
				return;
			}

			$parent_term_slug = isset( $parent_term->slug ) ? $parent_term->slug : '';

			$output = '<ul class="portfolio-subcategory ' . ( $cat_active == $parent_term_slug ? ' active' : '' ) . '" data-subCatOf="' . esc_attr( $parent_term->slug ) . '">';
			$output .= '<li class="penci-pfl-subcat-back">';
			$output .= sprintf( '<a href="%s" class="subcategory-back-href" data-term="%s"><i class="fa fa-angle-left"></i><span>%s:</span></a>',
				$this->get_term_link_by_tax( $parent_term, $portfolio_tax ),
				esc_attr( $parent_term->slug ),
				esc_html( $parent_term->name )
			);
			$output .= '</li>';

			foreach ( $sub_terms as $term ) {
				$output .= sprintf( '<li class="penci-pfl-cat-item penci-pfl-%s%s"><a data-term="%s" href="#">%s</a></li>',
					esc_attr( $term->slug ),
					$cat_active == $term->slug ? ' active' : '',
					esc_attr( $term->slug ),
					//$this->get_term_link_by_tax( $term , $portfolio_tax ),
					esc_html( $term->name )
				);
			}

			$output .= '</ul>';

			echo  $output;
		}

		public function get_term_link_by_tax( $term, $taxonomy ) {
			if ( empty( $taxonomy ) ) {
				return '';
			}

			return get_term_link( $term, $taxonomy );

		}

		public function get_portfolio_cat_active( $data_query ) {
			$cta = get_query_var( 'portfolio-category' );

			if ( ! $cta ) {
				$post_type = $this->get_only_post_type( $data_query );
				if ( 'post' == $post_type ) {

					$cats      = $this->get_vc_category( $data_query );
					$cats      = $this->remove_exclude_param( $cats );
					$cat_first = $this->get_first_item_array( $cats );
					$count_cat = is_array( $cats ) ? count( $cats ) : 0;

					if ( $count_cat < 2 && $cat_first > 0 ) {
						$category = get_category( $cat_first );
						$cta      = isset( $category->slug ) ? $category->slug : '';
					}
				} elseif ( $post_type ) {
					$cats      = $this->get_vc_tax_query( $data_query );
					$cats      = $this->remove_exclude_param( $cats );
					$cat_first = $this->get_first_item_array( $cats );
					$count_cat = is_array( $cats ) ? count( $cats ) : 0;

					if ( $count_cat < 2 && $cat_first > 0 ) {
						$tax  = $this->get_taxs_by_post_type( $data_query );
						$term = get_term( $cat_first, $tax );
						$cta  = isset( $term->slug ) ? $term->slug : '';
					}

				}
			}

			return $cta;
		}

		public function get_only_cat_select( $data_query ) {
			$post_type = $this->get_only_post_type( $data_query );
			if ( 'post' == $post_type ) {
				$cats = $this->get_vc_category( $data_query );
			} elseif ( $post_type ) {
				$cats = $this->get_vc_tax_query( $data_query );
			}

			$cats = $this->remove_exclude_param( $cats );

			return $cats;
		}

		public function get_taxs_by_post_type( $data ) {
			$tax = '';

			$post_type = $this->get_only_post_type( $data );

			if ( 'post' == $post_type ) {
				$tax = 'category';
			} elseif ( 'portfolio' == $post_type ) {
				$tax = 'portfolio-category';
			} elseif ( 'product' == $post_type ) {
				$tax = 'product_cat';
			}elseif ( $post_type ) {
				$taxonomy_objects = get_object_taxonomies( $post_type );

				if ( isset( $taxonomy_objects[0] ) ) {
					$tax = $taxonomy_objects[0];
				}
			}

			return $tax;
		}

		public function get_vc_category( $data ){

			$cats = isset( $data['categories'] ) ? $data['categories'] : '';

			if( ! $cats ) {
				return '';
			}

			$cats       = $this->stringToArray( $cats );
			$cats       = array_filter( $cats );

			return $cats;
		}

		public function get_vc_tax_query( $data ){

			$tax_query = isset( $data['tax_query'] ) ? $data['tax_query'] : '';

			if( ! $tax_query ) {
				return '';
			}

			$tax_query       = $this->stringToArray( $tax_query );
			$tax_query       = array_filter( $tax_query );

			return $tax_query;
		}

		public function get_vc_post_type( $data ){
			$post_type = isset( $data['post_type'] ) ? $data['post_type'] : '';

			if( ! $post_type ) {
				return '';
			}

			$post_type       = $this->stringToArray( $post_type );
			$post_type       = array_filter( $post_type );

			return $post_type;
		}

		public function get_only_post_type( $data ){
			$post_type       = $this->get_vc_post_type( $data );
			$count_post_type = count( (array)$post_type );


			if ( $count_post_type > 1 ) {
				return '';
			}

			$post_type = reset( $post_type );

			return $post_type;
		}

		public function stringToArray( $value ) {
			$valid_values = array();
			$list         = preg_split( '/\,[\s]*/', $value );
			foreach ( $list as $v ) {
				if ( strlen( $v ) > 0 ) {
					$valid_values[] = $v;
				}
			}

			return $valid_values;
		}

		public function remove_exclude_param( $data ) {
			if ( ! $data ) {
				return $data;
			}

			foreach ( (array)$data as $key => $value ) {
				$value = (int) $value;

				if ( $value < 0 ) {
					unset( $data[ $key ] );
				}
			}

			return $data;
		}

		public function get_first_item_array( $array ) {
			return isset( $array[0] ) ? $array[0] : '';
		}
	}
}

new Penci_Portfolio_Shortcode_Frontend;
?>