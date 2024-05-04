<?php

if ( ! function_exists( 'penci_related_posts_shortcode' ) ) {
	function penci_related_posts_shortcode( $atts, $content ) {
		$atts = shortcode_atts( array(
			'number'          => '4',
			'style'           => 'list',
			'align'           => 'none',
			'displayby'       => 'recent_posts',
			'orderby'         => 'rand',
			'title'           => '',
			'thumbright'      => 'no',
			'hide_post_date'  => '',
			'hide_count_view' => '',
			'border'          => '',
			'background'      => '',
			'post_type'       => '',
			'wpblock'         => '',
			'withids'         => '',
			'dis_pview'       => '',
			'dis_pdate'       => '',
		), $atts );

		if ( 'yes' == $atts['dis_pview'] ) {
			$atts['hide_count_view'] = 1;
		}
		if ( 'yes' == $atts['dis_pdate'] ) {
			$atts['hide_post_date'] = 1;
		}

		$args = array(
			'posts_per_page'      => $atts['number'],
			'orderby'             => $atts['orderby'],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'post_type' => 'post'
		);

		if( !$atts['post_type'] ) {
			$args['post_type'] = get_post_type();
		}

		global $post;
		$post_current = $post;

		$post_type = get_post_type();

		$postID = get_the_ID();
		if( is_single() && $postID ) {
			$args['post__not_in'] = array ( $postID );
		}

		if ( $atts['withids'] ) {
			$withIDs          = array_filter( explode( ',', $atts['withids'] . ',' ) );
			$args['post__in'] = $withIDs;

			if( isset( $args['post__not_in'] ) ) {
				unset( $args['post__not_in'] );
			}

		} elseif ( 'cat' == $atts['displayby'] ) {
			$categories = get_the_category( get_the_ID() );
			if ( $categories ) {
				$category_ids = array();
				foreach ( $categories as $individual_category ) {
					$category_ids[] = $individual_category->term_id;
				}

				$args['category__in'] = $category_ids;
			}
		}elseif ( 'tag' == $atts['displayby'] ){
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				$tag_ids = array();
				foreach ( $tags as $individual_tag ) {
					$tag_ids[] = $individual_tag->term_id;
				}

				$args['tag__in'] = $tag_ids;
			}
		}elseif( $atts['displayby'] ){

			$_terms = get_the_terms( get_the_ID(), $atts['displayby'] );
			if ( $_terms && ! is_wp_error( $_terms ) ) {
				
				$id_terms = array();
				foreach ($_terms as $_term ) {
					$id_terms[] = 	$_term->term_id;
				}

				if( $id_terms ) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => $atts['displayby'],
							'field'    => 'term_id',
							'terms'    => $id_terms
						),
					);
				}
			}
			
		}

		$the_query = Penci_Pre_Query::result_query( $args );
		if (! $the_query->have_posts() ) {
			return;
		}

		$inline_style = '';

		if( $atts['border'] || $atts['background'] ) {
			$inline_style = ' style="';

			if( $atts['border'] ) {
				$inline_style .='border-color: ' . esc_attr( $atts['border'] ) . ';';
			}

			if( $atts['background'] ) {
				$inline_style .='background-color: ' . esc_attr( $atts['background'] ) . ';';
			}

			$inline_style .='"';
		}

		$output = sprintf( '<div class="penci-inline-related-posts %s %s %s %s" %s>',
			'penci-irp-type-' . $atts['style'],
			'penci-irp-align-' . $atts['align'],
			empty( $atts['title'] ) ? 'irp_empty-title' : '',
			'1' == $the_query->post_count ? 'penci-irp-one-item' : '',
			$inline_style
		);

		if( !empty( $atts['title'] ) ) {
			$output.= '<div class="penci-irp-heading"><span>' . do_shortcode( $atts['title'] ) . '</span></div>';
		}

		$output.= '<ul>';

		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			if ( 'grid' == $atts['style'] ) {

				$image_type = ( penci_get_theme_mod( 'penci_archive_image_type' ) ? penci_get_theme_mod( 'penci_archive_image_type' ) : 'landscape' );

				$output .= '<li  class="penci-post-item penci-imgtype-' . esc_attr( $image_type ) . '">';
				$output .= '<div class="penci_media_object ' . ( 'yes' == $atts['thumbright'] ? 'penci_mobj-image-right' : '' ) . '">';
				$output .= '<div class="penci_mobj__img">';

				if( 'true' == $atts['wpblock'] ){
					$output .= Penci_Helper_Shortcode::get_image_holder( array(
						'image_size' => 'penci-thumb-280-186',
						'class'      => '',
						'image_type' => $image_type,
						'use_penci_lazy' => false
					) );
				}else{
					$output .= Penci_Helper_Shortcode::get_image_holder( array(
						'image_size' => 'penci-thumb-280-186',
						'class'      => '',
						'image_type' => $image_type
					) );
				}

				$output .= '</div>';
				$output .= '<div class="penci_post_content penci_mobj__body">';
				$output .= '<div class="penci__post-title-wrapper"><a class="penci__post-title" href="' . get_the_permalink() . '">' . penci_trim_post_title( get_the_ID(), 55 ) . '</a></div>';
				$output .= Penci_Helper_Shortcode::get_post_meta( array( 'date', 'view' ), $atts );
				$output .= '</div></div>';
				$output .= '</li>';

			} else {
				$output .= '<li> <a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
			}
		}
		wp_reset_postdata();

		$post = $post_current;

		$output .= '</ul></div>';

		return $output;
	}
}