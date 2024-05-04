<?php
if ( ! class_exists( 'Penci_Pre_Query' ) ) {
	class Penci_Pre_Query {

		private static $cache_thumbnail = array();

		public static function switch_query_args( $atts ) {
			if ( isset( $atts['build_query'] ) ) {
				$build_query = $atts['build_query'];
				if ( is_array( $build_query ) ) {
					$build_query['post_status'] = 'publish';
				} else {
					$build_query .= '|post_status:publish';
				}

				$args = penci_build_args_query( $build_query, get_the_ID() );

				$limit          = isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : get_option( 'posts_per_page' );
				$paged          = isset( $atts['paged'] ) ? $atts['paged'] : 1;
				$limit_loadmore = isset( $atts['limit_loadmore'] ) ? $atts['limit_loadmore'] : '';
				$styleAction    = isset( $atts['styleAction'] ) ? $atts['styleAction'] : '';
				$offset         = isset( $atts['offset'] ) ? $atts['offset'] : 0;
				$args_offset    = 0;

				if ( isset( $args['offset'] ) && ! empty( $args['offset'] ) ) {
					$args_offset = intval( $args['offset'] );

					if ( $paged > 1 ) {
						$args['offset'] = intval( $args['offset'] ) + ( ( $paged - 1 ) * $limit );
					}
					$offset = $offset + intval( $args['offset'] );
				}

				if ( ! empty( $limit_loadmore ) && in_array( $styleAction, array( 'load_more', 'infinite' ) ) ) {
					$offset = $offset ? $offset : 0;

					if ( intval( $paged ) > 1 ) {
						$offset = intval( $limit + ( intval( $paged - 2 ) * $limit_loadmore ) );

						if ( isset( $args['offset'] ) && ! empty( $args['offset'] ) ) {
							$offset = $offset + $args_offset;

						}
					}

					$args['offset'] = $offset;
					$limit                      = $limit_loadmore;
				}

				$args['ignore_sticky_posts'] = isset( $atts['enable_stiky_post'] ) && ! $atts['enable_stiky_post'] ? 1 : 0;
				$args['posts_per_page']         = $limit;
				$args['paged']                  = ! empty( $paged ) ? $paged : 1;

				// SELECT post_id FROM wp_postmeta WHERE meta_key = ? AND meta_value = ?
				if ( isset( $atts['shortcode_id'] ) && 'block_video' == $atts['shortcode_id'] ) {
					$args['tax_query'][] = array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => array( 'post-format-video' ),
					);
				}

				if ( isset( $atts['shortcode_id'] ) && 'block_36' == $atts['shortcode_id'] ) {
					if ( isset( $atts['only_post_review'] ) && $atts['only_post_review'] ) {
						$args['meta_query'][] = array(
							'key'     => 'penci_total_review',
							'compare' => 'EXISTS',
						);
					}
				}

			} else {
				$atts = self::optimize_query_atts( $atts );
				$args = self::get_query_args( $atts );
			}
			$args['use_cat_add'] = isset( $atts['use_cat_add'] ) ? $atts['use_cat_add'] : '';

			$args = apply_filters( 'penci_args_support_polylang', $args );

			return $args;
		}

		public static function do_query( $atts ) {
			$args = self::switch_query_args( $atts );
			$result_query = self::result_query( $args );
			return $result_query;
		}

		public static function result_query( $args ) {
			$query_key    = 'query_key_' . md5( serialize( $args ) );
			$result_query = wp_cache_get( $query_key, 'pennews' );

			if ( ! $result_query ) {

				$args = apply_filters( 'penci_args_support_polylang', $args );
				$result_query = new WP_Query( $args );
				wp_reset_postdata();
				wp_cache_set( $query_key, $result_query, 'pennews' );
			}

			self::save_thub_cache( $result_query );

			return $result_query;
		}


		public static function optimize_query_atts( $atts ) {
			$used_query = array(
				'post_ids',
				'category_ids',
				'tag_slugs',
				'sort',
				'limit',
				'autors_id',
				'post_types',
				'paged',
				'shortcode_id',
				'limit_loadmore',
				'styleAction',
				'enable_stiky_post',
				'exclude_cat_id',
				'offset',
				'only_post_review'
			);

			foreach ( $atts as $k => $v ) {
				if ( ! in_array( $k, $used_query ) ) {
					unset( $atts[ $k ] );
				}
			}

			return $atts;
		}

		public static function save_thub_cache( $query ) {

			if ( ! isset( $query->post ) ) {
				return;
			}

			$posts = $query->posts;

			$thumbnails = array();

			foreach ( $posts as $result ) {
				if ( ! in_array( $result->ID, self::$cache_thumbnail ) ) {
					$thumbnails[]            = get_post_thumbnail_id( $result->ID );
					self::$cache_thumbnail[] = $result->ID;
				}
			}

			if ( ! empty( $thumbnails ) ) {
				$query = array(
					'post__in'  => $thumbnails,
					'post_type' => 'attachment',
					'showposts' => is_array( $thumbnails ) ? count( $thumbnails ) : 0
				);

				get_posts( $query );
			}
		}

		public static function get_query_args( $atts ) {

			$default = array(
				'post_ids'          => '',
				'category_ids'      => '',
				'tag_slugs'         => '',
				'sort'              => '',
				'limit'             => '',
				'autors_id'         => '',
				'post_types'        => 'post',
				'paged'             => 1,
				'shortcode_id'      => '',
				'limit_loadmore'    => '',
				'styleAction'       => '',
				'enable_stiky_post' => 0,
				'exclude_cat_id'    => '',
				'offset'            => 0
			);

			$atts = wp_parse_args( $atts, $default );

			extract( $atts );

			$penci_query_args = array(
				'post_type'              => $atts['post_types'],
				'ignore_sticky_posts'    => ! $atts['enable_stiky_post'] ? 1 : 0,
				'post_status'            => 'publish',
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,

			);

			if ( 'block_video' == $atts['shortcode_id'] ) {
				$penci_query_args['tax_query'][] = array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-video' ),
				);
			}

			if ( 'block_36' == $atts['shortcode_id'] ) {
				if( isset( $atts['only_post_review'] ) &&  $atts['only_post_review'] ) {
					$penci_query_args['meta_query'][] = array(
						'key'     => 'penci_total_review',
						'compare' => 'EXISTS',
					);
				}
			}


			if ( ! empty( $atts['category_ids'] ) ) {
				$penci_query_args['category_name'] = $atts['category_ids'];
			}

			if ( ! empty( $atts['exclude_cat_id'] ) ) {

				$exclude_cat_ids = explode( ',', $atts['exclude_cat_id'] );
				$cat_not_in      = array();
				foreach ( $exclude_cat_ids as $exclude_cat_id ) {
					$exclude_cat_id = trim( $exclude_cat_id );
					if ( is_numeric( $exclude_cat_id ) ) {
						$cat_not_in[] = $exclude_cat_id;
					}
				}

				if ( ! empty( $cat_not_in ) ) {
					$penci_query_args['category__not_in'] = $cat_not_in;
				}
			}

			if ( ! empty( $atts['tag_slug'] ) ) {
				$penci_query_args['tag'] = str_replace( ' ', '-', $atts['tag_slug'] );
			}

			if ( ! empty( $atts['autors_id'] ) ) {
				$penci_query_args['author'] = $atts['autors_id'];
			}
			$sort = $atts['sort'];

			switch ( $sort ) {
				case 'popular':
					$penci_query_args['meta_key'] = '_count-views_all';
					$penci_query_args['orderby']  = 'meta_value_num';
					$penci_query_args['order']    = 'DESC';
					break;
				case 'popular7':
					$penci_query_args['meta_key'] = '_count-views_week';
					$penci_query_args['orderby']  = 'meta_value_num';
					$penci_query_args['order']    = 'DESC';
					break;
				case 'popular_month':
					$penci_query_args['meta_key'] = '_count-views_month';
					$penci_query_args['orderby']  = 'meta_value_num';
					$penci_query_args['order']    = 'DESC';
					break;
				case 'review':
					$penci_query_args['meta_key'] = 'penci_total_review';
					$penci_query_args['orderby']  = 'meta_value_num';
					$penci_query_args['order']    = 'DESC';
					break;
				case 'random_posts':
					$penci_query_args['orderby'] = 'rand';
					break;
				case 'alphabetical_order':
					$penci_query_args['orderby'] = 'title';
					$penci_query_args['order']   = 'ASC';
					break;
				case 'comment_count':
					$penci_query_args['orderby'] = 'comment_count';
					$penci_query_args['order']   = 'DESC';
					break;
				case 'random_today':
					$penci_query_args['orderby']  = 'rand';
					$penci_query_args['year']     = date( 'Y' );
					$penci_query_args['monthnum'] = date( 'n' );
					$penci_query_args['day']      = date( 'j' );
					break;
				case 'random_7_day':
					$penci_query_args['orderby']    = 'rand';
					$penci_query_args['date_query'] = array(
						'column' => 'post_date_gmt',
						'after'  => '1 week ago'
					);
					break;
			}

			if ( ! empty( $atts['post_ids'] ) ) {

				$post_id_arr = explode( ',', $atts['post_ids'] );

				$post_in = $post_not_in = array();

				foreach ( $post_id_arr as $p_id ) {
					$pre_post_id = trim( $p_id );
					if ( ! is_numeric( $pre_post_id ) ) {
						continue;
					}

					$pre_post_id = intval( $pre_post_id );

					if ( $pre_post_id < 0 ) {
						$post_not_in [] = str_replace( '-', '', $pre_post_id );
					} else {
						$post_in [] = $pre_post_id;
					}
				}

				if ( ! empty( $post_not_in ) ) {
					if ( ! empty( $penci_query_args['post__not_in'] ) ) {
						$penci_query_args['post__not_in'] = array_merge( $penci_query_args['post__not_in'], $post_not_in );
					} else {
						$penci_query_args['post__not_in'] = $post_not_in;
					}
				}

				if ( ! empty( $post_in ) ) {
					$penci_query_args['post__in'] = $post_in;
					$penci_query_args['orderby']  = 'post__in';
				}

			}

			if ( empty( $limit ) ) {
				$limit = get_option( 'posts_per_page' );
			}

			if ( ! empty( $limit_loadmore ) && in_array( $styleAction, array( 'load_more', 'infinite' ) ) ) {
				$offset = $offset ? $offset : 0;

				if ( intval( $paged ) > 1 ) {
					$offset = intval( $limit + ( intval( $paged - 2 ) * $limit_loadmore ) );
				}

				$penci_query_args['offset'] = $offset;

				$limit = $limit_loadmore;
			}


			$penci_query_args['posts_per_page'] = $limit;
			$penci_query_args['paged']          = ! empty( $paged ) ? $paged : 1;

			return $penci_query_args;
		}
	}
}

new Penci_Pre_Query;