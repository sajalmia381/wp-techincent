<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Penci_Review_Comment' ) ):
	class Penci_Review_Comment {

		private static $comment_type = 'penci_review';

		/**
		 * Hook and methods
		 */
		public static function init() {
			// Secure review.
			add_filter( 'comments_clauses', array( __CLASS__, 'exclude_review_comments' ), 10, 1 );
			add_filter( 'comment_feed_where', array( __CLASS__, 'exclude_review_comments_from_feed_where' ) );

			// Count comments.
			//add_filter( 'wp_count_comments', array( __CLASS__, 'wp_count_comments' ), 10, 2 );

			// Delete review count cache whenever there is a new review or review status changes.
			add_action( 'wp_insert_comment', array( __CLASS__, 'delete_reviews_count_cache' ) );
			add_action( 'wp_set_comment_status', array( __CLASS__, 'delete_reviews_count_cache' ) );
			add_action( 'untrash_comment', array( __CLASS__, 'delete_reviews_count_cache' ) );
			add_action( 'trashed_comment', array( __CLASS__, 'delete_reviews_count_cache' ) );
			add_action( 'spam_comment', array( __CLASS__, 'delete_reviews_count_cache' ) );
			add_action( 'spammed_comment', array( __CLASS__, 'delete_reviews_count_cache' ) );

			add_filter( 'admin_comment_types_dropdown', array( __CLASS__, 'add_comment_type_dropdown' ) );
			add_filter( 'comment_status_links', array( __CLASS__, 'comment_status_links' ) );

			add_filter( 'admin_body_class', array( __CLASS__, 'admin_body_class' ) );

			add_filter( 'comment_row_actions', array( __CLASS__, 'comment_row_actions' ), 10, 2 );

			add_filter( 'widget_comments_args', array( __CLASS__, 'widget_comments_args' ), 10, 2 );

			add_action( 'admin_menu', array( __CLASS__, 'add_menu_reivew_comment' ) );



			if ( is_admin() ) {
				add_filter( 'parent_file', array( __CLASS__, 'parent_file' ) );
				//add_filter( 'admin_title', array( __CLASS__, 'admin_title' ) );
			}
		}

		public static function widget_comments_args( $args = array(),$instance = null ){
			$args['type__not_in'] = 'pennew_review';

			return $args;
		}

		public static function comment_row_actions( $actions, $comment ) {
			 if( isset( $comment->comment_type ) && 'penci_review' != $comment->comment_type  ){
				 return $actions;
			 }
			
			if( isset( $actions['reply'] ) ){
				unset( $actions['reply'] );
			}

			if ( isset( $comment->user_id ) && $comment->user_id && $user = get_userdata( $comment->user_id ) ) {
				$type = get_comment_meta( $comment->comment_ID, 'review_verified', true );
				$type = $type ? $type : 'unverify';

				if( ! in_array( $type, array( 'unverify','verify' ) ) ){
					$type = 'unverify';
				}

				$link = admin_url( 'admin-ajax.php' );
				$link .= "?c=$comment->comment_ID&action=penci_review_verify_badge";
				$link .= esc_html( '&nonce=' . wp_create_nonce( 'ajax-nonce' ) );
				$link .= esc_html( '&commentID=' . $comment->comment_ID );
				$link .= esc_html( '&type=' . $type );

				$text_rmverified = esc_html__( 'Remove Verified Badge', 'penci' );
				$text_verified   = esc_html__( 'Apply Verified Badge', 'penci' );
				$data_action = 'verify';

				if ( 'verify' == $type ) {
					$text_verified   = esc_html__( 'Remove Verified Badge', 'penci' );
					$text_rmverified = esc_html__( 'Apply Verified Badge', 'penci' );
					$data_action     = 'unverify';
				}

				$actions_verify = '<a href="' . $link . '" class="penci-ur-verify comment-inline"';
				$actions_verify .= 'data-action="' . esc_attr( $data_action ) . '" data-comment-id="' . esc_attr( $comment->comment_ID ) . '"';
				$actions_verify .= 'data-rmverified="' . $text_rmverified . '">' . $text_verified . '</a>';

				$actions['verify'] = $actions_verify;
			}

			return $actions;
		}

		public static function admin_body_class( $classes ) {
			if ( isset( $_GET['comment_type'] ) && 'penci_review' == $_GET['comment_type'] ) {
				$classes .= 'penci_user_review';
			}

			return $classes;
		}


		public static function add_menu_reivew_comment() {
			$page_title = 'User Reviews';

			$count_reviews = self::get_count_reviews();

			if ( isset( $count_reviews->moderated ) && $count_reviews->moderated ) {
				$page_title .= '<span class="awaiting-mod count-' . absint( $count_reviews->moderated ) . '"><span class="pending-count">' . number_format_i18n( $count_reviews->moderated ) . '</span></span>';
			}

			add_submenu_page( 'edit-comments.php', $page_title, $page_title, 'manage_options', 'penci_dashboard_review', array( __CLASS__, 'penci_review_page' ) );
			//add_menu_page( $page_title, $page_title, 'manage_options', 'penci_dashboard_review', array( __CLASS__, 'penci_review_page' ), null, 25 );

			if ( is_admin() ) {

				global $submenu;
				foreach ( $submenu['edit-comments.php'] as $key => $submenu_item ) {
					if ( isset( $submenu_item[2] ) && 'penci_dashboard_review' == $submenu_item[2] ) {
						$submenu['edit-comments.php'][ $key ][2] = 'edit-comments.php?comment_type=penci_review';
					}
				}
			}
		}

		public static function penci_review_page() {
		}

		public static function admin_title() {
			return sprintf( __( '%1$s &lsaquo; %2$s &#8212; WordPress' ), 'Review', get_bloginfo( 'name' ) );
		}

		public static function parent_file( $parent_file ) {
			global $self, $parent_file;

			if ( isset( $_SERVER['PHP_SELF'] ) ) {
				$self = preg_replace( '|^.*/wp-admin/network/|i', '', $_SERVER['PHP_SELF'] );
				$self = preg_replace( '|^.*/wp-admin/|i', '', $self );
				$self = preg_replace( '|^.*/plugins/|i', '', $self );
				$self = preg_replace( '|^.*/mu-plugins/|i', '', $self );
			}

			if ( isset( $_SERVER['QUERY_STRING'] ) && $_SERVER['QUERY_STRING'] ) {
				parse_str( $_SERVER['QUERY_STRING'], $query_string );

				if ( isset( $query_string['comment_type'] ) && 'penci_review' == $query_string['comment_type'] ) {
					$self .= '?comment_type=penci_review';
					//$parent_file = 'edit-comments.php?comment_type=penci_review';
				}
			}

			return $parent_file;
		}

		public static function exclude_review_comments( $clauses ) {
			if ( isset( $clauses['where'] ) && false === strpos( $clauses['where'], "comment_type IN ('" . self::$comment_type . "')" ) ) {
				$clauses['where'] .= ( $clauses['where'] ? ' AND ' : '' ) . " comment_type != '" . self::$comment_type . "' ";
			}

			return $clauses;
		}

		/**
		 * Exclude order comments from queries and RSS.
		 *
		 * @param  string $where The WHERE clause of the query.
		 *
		 * @return string
		 */
		public static function exclude_review_comments_from_feed_where( $where ) {
			return $where . ( $where ? ' AND ' : '' ) . " comment_type != '" . self::$comment_type . "' ";
		}

		public static function wp_count_comments( $comment_count, $post_id ) {
			global $wpdb;

			if ( 0 === $post_id ) {
				$comment_count = get_transient( 'penci_count_comments' );

				if ( ! $comment_count ) {
					$comment_count = array(
						'approved'            => 0,
						'awaiting_moderation' => 0,
						'spam'                => 0,
						'trash'               => 0,
						'post-trashed'        => 0,
						'total_comments'      => 0,
						'all'                 => 0,
					);

					$totals = $wpdb->get_results( "
						SELECT comment_approved, COUNT(*) AS total
						FROM {$wpdb->comments}
						WHERE comment_type NOT IN ('" . self::$comment_type . "')
						GROUP BY comment_approved
					", ARRAY_A
					);

					foreach ( $totals as $row ) {
						switch ( $row['comment_approved'] ) {
							case 'trash':
								$comment_count['trash'] = $row['total'];
								break;
							case 'post-trashed':
								$comment_count['post-trashed'] = $row['total'];
								break;
							case 'spam':
								$comment_count['spam']           = $row['total'];
								$comment_count['total_comments'] += $row['total'];
								break;
							case '1':
								$comment_count['approved']       = $row['total'];
								$comment_count['total_comments'] += $row['total'];
								$comment_count['all']            += $row['total'];
								break;
							case '0':
								$comment_count['awaiting_moderation'] = $row['total'];
								$comment_count['total_comments']      += $row['total'];
								$comment_count['all']                 += $row['total'];
								break;
							default:
								break;
						}
					}

					set_transient( 'penci_count_comments', $comment_count );
				}
			}

			return $comment_count;
		}


		public static function get_count_reviews( $post_id = 0 ) {
			global $wpdb;

			$post_id = (int) $post_id;

			$counts = 0;

			$default_stats = array(
				'total_reviews' => 0,
				'all'           => 0,
				'moderated'     => 0,
				'post-trashed'  => 0,
				'approved'      => 0,
				'spam'          => 0,
				'trash'         => 0,
			);

			if ( 0 === $post_id ) {

				$stats = get_transient( 'penci_count_reviews' );

				if ( ! $stats ) {

					$stats = $default_stats;

					$counts = $wpdb->get_results(
						"
						SELECT comment_approved,COUNT(*) AS total
						FROM {$wpdb->comments}
						WHERE comment_type IN ('" . self::$comment_type . "')
						GROUP BY comment_approved
						", ARRAY_A
					);
				}
			} elseif ( $post_id > 0 ) {
				$stats = get_transient( 'penci_count_reviews' . $post_id );

				if ( ! $stats ) {

					$stats = $default_stats;

					$where = $wpdb->prepare( "WHERE comment_post_ID = %d", $post_id );
					$where .= " AND comment_type IN ('" . self::$comment_type . "')";

					$counts = $wpdb->get_results( "
						SELECT comment_approved, COUNT( * ) AS total
						FROM {$wpdb->comments}
						{$where}
						GROUP BY comment_approved
					", ARRAY_A );
				}
			}

			if ( $counts ) {
				foreach ( (array) $counts as $row ) {
					switch ( $row['comment_approved'] ) {
						case 'trash':
							$stats['trash'] = $row['total'];
							break;
						case 'post-trashed':
							$stats['post-trashed'] = $row['total'];
							break;
						case 'spam':
							$stats['spam']          = $row['total'];
							$stats['total_reviews'] += $row['total'];
							break;
						case '1':
							$stats['approved']      = $row['total'];
							$stats['total_reviews'] += $row['total'];
							$stats['all']           += $row['total'];
							break;
						case '0':
							$stats['moderated']     = $row['total'];
							$stats['total_reviews'] += $row['total'];
							$stats['all']           += $row['total'];
							break;
						default:
							break;
					}
				}

			}
			$stats = (object) $stats;

			if ( 0 === $post_id ) {
				set_transient( 'penci_count_reviews', $stats );
			} elseif ( $post_id > 0 ) {
				set_transient( 'penci_count_reviews' . $post_id, $stats );
			}

			return $stats;
		}

		/**
		 * Delete reviews count cache whenever there is
		 * new review or status of a review changes.
		 * Cache will be regenerated next time Penci_Review_Comment::get_count_reviews is called
		 */
		public static function delete_reviews_count_cache( $comment_id = 0 ) {
			global $wpdb;

			delete_transient( 'penci_count_reviews' );

			if ( $comment_id ) {
				$comment_post_ID = $wpdb->get_row( "SELECT comment_post_ID FROM {$wpdb->comments} WHERE comment_ID = {$comment_id}" );

				$post_id = $comment_post_ID->comment_post_ID;

				if ( $post_id ) {
					delete_transient( 'penci_count_reviews' . $post_id );
				}
			}
		}

		public static function add_comment_type_dropdown( $comment_types ) {
			$comment_types['penci_review'] = esc_html__( 'Penci Review', 'penci' );

			return $comment_types;
		}

		public static function comment_status_links( $status_links ) {

			if ( isset( $_GET['comment_type'] ) && 'penci_review' == $_GET['comment_type'] ) {
				global $post_id, $comment_status, $comment_type;

				$num_comments = ( $post_id ) ? self::get_count_reviews( $post_id ) : self::get_count_reviews();

				$stati = array(
					/* translators: %s: all comments count */
					'all'       => _nx_noop(
						'All <span class="count">(%s)</span>',
						'All <span class="count">(%s)</span>',
						'comments'
					), // singular not used

					/* translators: %s: pending comments count */
					'moderated' => _nx_noop(
						'Pending <span class="count">(%s)</span>',
						'Pending <span class="count">(%s)</span>',
						'comments'
					),

					/* translators: %s: approved comments count */
					'approved'  => _nx_noop(
						'Approved <span class="count">(%s)</span>',
						'Approved <span class="count">(%s)</span>',
						'comments'
					),

					/* translators: %s: spam comments count */
					'spam'      => _nx_noop(
						'Spam <span class="count">(%s)</span>',
						'Spam <span class="count">(%s)</span>',
						'comments'
					),

					/* translators: %s: trashed comments count */
					'trash'     => _nx_noop(
						'Trash <span class="count">(%s)</span>',
						'Trash <span class="count">(%s)</span>',
						'comments'
					)
				);

				if ( ! EMPTY_TRASH_DAYS ) {
					unset( $stati['trash'] );
				}

				$link = admin_url( 'edit-comments.php' );
				if ( ! empty( $comment_type ) && 'all' != $comment_type ) {
					$link = add_query_arg( 'comment_type', $comment_type, $link );
				}

				foreach ( $stati as $status => $label ) {
					$current_link_attributes = '';

					if ( $status === $comment_status ) {
						$current_link_attributes = ' class="current" aria-current="page"';
					}

					if ( ! isset( $num_comments->$status ) ) {
						$num_comments->$status = 10;
					}
					$link = add_query_arg( 'comment_status', $status, $link );
					if ( $post_id ) {
						$link = add_query_arg( 'p', absint( $post_id ), $link );
					}

					$status_links[ $status ] = "<a href='$link'$current_link_attributes>" . sprintf(
							translate_nooped_plural( $label, $num_comments->$status ),
							sprintf( '<span class="%s-count">%s</span>',
								( 'moderated' === $status ) ? 'pending' : $status,
								number_format_i18n( $num_comments->$status )
							)
						) . '</a>';
				}
			}

			return $status_links;
		}
	}
endif;

Penci_Review_Comment::init();