<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Penci_Reivew_Template' ) ):
	class Penci_Reivew_Template{
		public function __construct(){
			add_action( 'penci_pennew_review_hook', array(  $this, 'pennew_review_hook' ) );
		}

		public function pennew_review_hook(){
			$this->reviews_template();
		}

		public function reviews_template( ) {
			global $post;


			if ( !(is_single() || is_page() ) || empty($post) ){
				return;
			}

			if ( post_password_required() ) {
				return;
			}
			$comment_numbers = get_comments_number();
			?>
			<div class="penci-post-reviews  penci-post-reviews-<?php the_ID(); ?> <?php if ( $comment_numbers == 0 ): echo ' no-review-yet'; endif; ?>" id="reviews">
				<?php $this->review_form( ); ?>
			</div> <!-- end comments div -->
			<?php
		}

		function review_form( ) {

			$post_id = get_the_ID();

			$penci_review_more = get_post_meta( $post_id, 'penci_review_more', true );

			

			$req      = get_theme_mod( 'penci_review_require_name_email', true );
			$html_req = ( $req ? " required='required'" : '' );
			$html5    = '';

			$author_field = $email_field = $url_field = '';
			if ( ! is_user_logged_in() ) {
				$author_field = '<p class="comment-form-author">';
				$author_field .= '<label for="author">';
				$author_field .= get_theme_mod( 'penci_rv_form_namefield_text' ) ?  get_theme_mod( 'penci_rv_form_namefield_text' ) : __( 'Name' );
				$author_field .= ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ';
				$author_field .= '<input id="author" name="penci_reivew_author" type="text" value="" size="30" maxlength="245"' . $html_req . ' />';
				$author_field .= '</p>';

				$email_field = '<p class="comment-form-email">';
				$email_field .= '<label for="email">';
                $email_field .= get_theme_mod( 'penci_rv_form_emailfield_text' ) ?  get_theme_mod( 'penci_rv_form_emailfield_text' ) : __( 'Email' );
                $email_field .= ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ';
				$email_field .= '<input id="email" name="penci_reivew_email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . ' />';
				$email_field .= '</p>';
			}

			$url_field = '<p class="comment-form-url">';
			$url_field .= '<label for="url">';
			$url_field .= get_theme_mod( 'penci_rv_form_titlefield_text' ) ?  get_theme_mod( 'penci_rv_form_titlefield_text' ) : __( 'Title' );
			$url_field .= '</label> ';
			$url_field .= '<input id="url" name="penci_reivew_title" type="text" value="" size="30" maxlength="245" />';
			$url_field .= '</p>';


			$comment_field = '<p class="comment-form-comment">';
			$comment_field .= '<textarea id="comment" name="penci_reivew_comment" cols="45" rows="8" maxlength="65525"></textarea>';
			$comment_field .= '</p>';
			?>
			<div class="post-comments">
				<div class="penci-usewr-review">
					<?php Penci_Reivew_Template::get_post_user_reivew(); ?>
				</div>
				<div id="respond" class="comment-respond">
					<h3 class="comment-reply-title"><span><?php echo ( function_exists( 'penci_get_tran_setting' ) ?  penci_get_tran_setting( 'penci_rv_form_title_text' ) : esc_html__( 'Leave a review', 'penci' ) ); ?></span></h3>
					<form id="penci-review-form" class="comment-form penci-review-form">
						<input type="hidden" name="penci_reivew_postID" value="<?php echo esc_attr( $post_id ); ?>">
						<?php
						echo $comment_field;
						echo $author_field . $email_field . $url_field;
						?>
						<div class="clear">
						<ul class="penci-scores-rateYo penci-stars">
							<?php $this->get_criterias( $post_id );  ?>
						</ul>
						</div>
						<p class="form-submit">
							<?php
							 $value_submit =  get_theme_mod( 'penci_comment_label_submit' );
							 $value_submit =  $value_submit ?  $value_submit : esc_html__( 'Submit','penci' );
							 ?>
							<input name="submit" type="submit" id="submit" class="submit" value="<?php echo $value_submit; ?>">
							<span class="penci-review-spinner"><i class="fa fa-spinner fa-pulse"></i></span>
						</p>
					</form>
					<div class="penci-review-mess"></div>
				</div>
			</div>
			<?php
		}

		function get_criterias( $post_id = null ){
			if( empty( $post_id ) ){
				$post_id = get_the_ID();
			}

			$penci_review = get_post_meta( $post_id, 'penci_review', true );

			if( empty( $penci_review ) || ! is_array( $penci_review ) ) {
				return;
			}

			$remove_review_old = get_post_meta( $post_id,'penci_remove_review_old', true );
			if( ! $remove_review_old ) {
				$arr_review_number = array( 'penci_review_1', 'penci_review_2', 'penci_review_3', 'penci_review_4', 'penci_review_5' );

				$penci_review = (array)$penci_review;

				foreach ( $arr_review_number as $review_number_item ) {
					$review_1    = isset( $penci_review[ $review_number_item ] ) ? $penci_review[ $review_number_item ] : '';
					if ($review_1 ) {
						$this->criteria_markup( $review_1, $review_number_item );
					}
				}
			}

			$penci_review_more = get_post_meta( $post_id, 'penci_review_more', true );
			if ( $penci_review_more && is_array( $penci_review_more ) ) {
				foreach ( $penci_review_more as $key => $review_more ) {
					$review_more_title = isset( $review_more['title'] ) ? $review_more['title'] : '';
					$review_more_id = isset( $review_more['id'] ) ? $review_more['id'] : $key;
					if ( $review_more_title ) {
						$this->criteria_markup( $review_more_title, $review_more_id );
					}
				}
			}
		}

		function criteria_markup( $title, $id = '', $rating = '' ) {
			?>
			<li class="penci-review-item">
				<span class="penci-format-row"><?php echo $title; ?></span>
				<div class="penci-review-star-criteria">
					<div class="penci-reivew-star-rateYo" <?php echo ( $rating ? ' data-rating="' . esc_attr( $rating ) . '"' : '' ); ?>></div>
					<?php if( $id ): ?>
					<input type="hidden" name="penci_review_rating[<?php echo esc_attr( $id ); ?>][number]" value="0" class="penci-reivew-star-value">
					<input type="hidden" name="penci_review_rating[<?php echo esc_attr( $id ); ?>][title]" value="<?php echo $title; ?>">
					<?php endif; ?>
				</div>
			</li>
			<?php
		}

		public static function get_post_user_reivew(){
			$post_id = get_the_ID();
			$reviews = get_comments( array( 'post_id' => $post_id, 'type' => 'penci_review', 'status'  => 1,'order'   => 'ASC' ) );

			if( ! $reviews || ! is_array( $reviews ) ){
				return;
			}
			$review_numbers = count( (array)$reviews );

			echo '<div class="post-comments  post-comments-' . $post_id . ( ( $review_numbers == 0 ) ? '  no-comment-yet' : '' ) . '">';
			echo '<div class="post-title-box"><h4 class="post-box-title">';
			echo self::get_review_number_text( $review_numbers );
			echo '</h4></div>';
			echo '<div class="comments penci-user-reviews">';

			wp_list_comments( array(
				'avatar_size' => 100,
				'max_depth'   => 5,
				'style'       => 'div',
				'reivew_order' => self::get_admin_reviews_order(),
				'callback'    => array( __CLASS__,'review_template' ),
				'type'        => 'penci_review'
			),$reviews );

			$max_page = self::get_review_pages_count( $reviews );

			if( $max_page > 1 ) {
				echo "<div id='comments_pagination' class='penci-pagination'>";
				self::paginate_reviews_links( array(
						'total' => $max_page,
						'add_fragment' => '#review-' . $post_id . '-comment',
					)
				);
				echo "</div>";
			}

			echo '</div>';
			echo '</div>';
		}

		public static function paginate_reviews_links( $args = array() ) {
			global $wp_rewrite;

			if ( ! is_singular() )
				return;

			$page = get_query_var('cpage');
			if ( !$page )
				$page = 1;

			$defaults = array(
				'base' => add_query_arg( 'cpage', '%#%' ),
				'format' => '',
				'total' => '',
				'current' => $page,
				'echo' => true,
				'add_fragment' => '',
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;'
			);
			if ( $wp_rewrite->using_permalinks() )
				$defaults['base'] = user_trailingslashit(trailingslashit(get_permalink()) . $wp_rewrite->comments_pagination_base . '-%#%', 'commentpaged');

			$args = wp_parse_args( $args, $defaults );

			$page_links = paginate_links( $args );

			if ( $args['echo'] )
				echo $page_links;
			else
				return $page_links;
		}

		public static function get_review_pages_count( $comments = null, $threaded = null ) {

			if ( empty($comments) )
				return 0;

			if ( ! get_option( 'page_comments' ) ) {
				return 1;
			}

			$per_page = (int) get_option('comments_per_page');
			if ( 0 === $per_page )
				return 1;

			$count = ceil( count( (array)$comments ) / $per_page );

			return $count;
		}

		public static function review_template(  $comment, $args, $depth ){
			$GLOBALS['comment'] = $comment;
			$comment_id = get_comment_ID();

			$user_id  = $comment->user_id;
			$author_email = $comment->comment_author_email;
			$author_img = get_avatar( $author_email, $args['avatar_size'] );

			$comment_verified = get_comment_meta( $comment_id, 'review_verified', true );
			$creview_score = get_comment_meta( $comment_id, 'review_score', true );

			$attr_date = 'datetime="' . get_comment_time( 'Y-m-d\TH:i:sP' ) . '"';
			$attr_date .= 'title="' . get_comment_time( 'l, F j, Y, g:i a' ) . '"';
			$attr_date .= 'itemprop="commentTime"';

			?>
		<div <?php comment_class( 'penci-user-review penci-ur-' .$comment_id ); ?> id="penci-ur-<?php comment_ID() ?>" itemprop="" itemscope="itemscope" itemtype="http://schema.org/UserComments">
			<meta itemprop="discusses" content="<?php echo esc_attr( get_the_title() ); ?>"/>
			<link itemprop="url" href="#comment-<?php comment_ID() ?>">
			<div class="thecomment">
				<?php if( $author_img ): ?>
					<div class="author-img penci-userreview-img">
						<?php echo $author_img; ?>
					</div>
				<?php endif; ?>
				<div class="comment-text">
					<span class="author penci-userreview-author"  itemprop="creator" itemtype="http://schema.org/Person">
						<span itemprop="name"><?php echo get_comment_author_link(); ?></span>
						<?php if( 'verify' == $comment_verified && ! get_theme_mod( 'penci_urv_verified' ) ): ?>
							<span class="penci-userreview-badge"><?php echo ( function_exists( 'penci_review_verified_text' ) ? penci_get_tran_setting( 'penci_review_verified_text' ) : esc_html__( 'Verified', 'penci' ) ); ?></span>
						<?php endif; ?>
					</span>
					<?php if( ! get_theme_mod( 'penci_urv_verified' ) ): ?>
					<span class="date penci-userreview-date" <?php echo ( $attr_date ); ?>><i class="fa fa-clock-o"></i><?php printf( __( '%1$s at %2$s','pennews' ), get_comment_date( '', $comment ), get_comment_time() ); ?></span>
					<?php endif; ?>

					<div class="penci-userreview-metas">
						<?php
						if( $user_id ){
							$verified_badge = get_user_meta( $user_id, 'verified_badge', true );
							$review_like = get_user_meta( $user_id, 'review_like', true );

							$review_by_user = get_comments(array(
								'type' => 'penci_review',
								'user_id' => $user_id,
								'count' => true,
							));

							if( $review_by_user && ! get_theme_mod( 'penci_urv_review_count' ) ){
								echo '<span class="badge-star penci-ur-review_count"><i class="fa fa-star"></i>';
								echo '<strong>' . $review_by_user . '</strong> ';
								echo ( get_theme_mod( 'penci_review_more' ) ? get_theme_mod( 'penci_review_more' ) : esc_html__( 'reviews', 'penci' ) );
								echo '</span>';
							}

							if( $verified_badge && ! get_theme_mod( 'penci_urv_verified_badges' ) ){
								echo '<span class="badge-verified penci-ur-badge-verified"><i class="dashicons dashicons-awards"></i>';
								echo '<strong>' . $verified_badge . '</strong> ';
								echo ( get_theme_mod( 'penci_review_ver_badges_text' ) ? get_theme_mod( 'penci_review_ver_badges_text' ) : esc_html__( 'verified badges', 'penci' ) );
								echo '</span>';
							}

							if( $review_like && ! get_theme_mod( 'penci_urv_received_judgements' ) ){
								echo '<span class="badge-star penci-ur-received-judgements"><i class="fa fa-thumbs-o-up"></i>';
								echo '<strong>' . $review_like . '</strong> ';
								echo ( get_theme_mod( 'penci_review_received_jud_text' ) ? get_theme_mod( 'penci_review_received_jud_text' ) : esc_html__( 'received judgements', 'penci' ) );
								echo '</span>';
							}
						}
						?>
					</div>
					<?php if( $creview_score ): ?>
					<div class="penci-userreview-numeric-score">
						<span><?php echo number_format( $creview_score, 1, '.', '' ); ?></span><i>/ 5</i>
					</div>
					<?php endif; ?>
					<div class="comment-content penci-userreview-comment" itemprop="commentText">
						<?php
						$review_title = get_comment_meta( $comment_id, 'review_title', true );
						if( $review_title ){
							echo '<h6 class="penci-userreview-title">' . $review_title . '</h6>';
						}
						comment_text();
						?>
					</div>
					<?php
					$ratings = get_comment_meta( $comment_id, 'review_rating', false );

					if( $ratings && $args['reivew_order'] ){
						$pre_ratings = array();
						foreach ( (array)$ratings as $rating ){
							$rating_id = isset( $rating['id'] ) ? $rating['id'] : '';
							$rating_title = isset( $rating['title'] ) ? $rating['title'] : '';
							$rating_number = isset( $rating['number'] ) ? $rating['number'] : 0;

							if( $rating_title || $rating_number ){
								$criteria_item = '<li>';
								$criteria_item .= '<label class="penci-user-title-criteria penci-review-text">' . $rating_title . '</label>';
								$criteria_item .= '<div class="penci-review-star-criteria">';
								$criteria_item .= penci_get_preview_rating_markup( array(
									'rate'     => $rating_number,
									'format'   => true,
									'position' => 'relative',
								) );
								$criteria_item .= '</div>';
								$criteria_item .= '</li>';

								$pre_ratings[$rating_id] = $criteria_item;
							}
						}

						if( $pre_ratings ){
							echo '<ul class="penci-user-review-criteria">';

							foreach ( (array) $args['reivew_order'] as $criteria_order ) {
								if ( isset( $pre_ratings[ $criteria_order ] ) && $pre_ratings[ $criteria_order ] ) {
									echo $pre_ratings[ $criteria_order ];
									unset( $pre_ratings[ $criteria_order ] );
								}
							}
							echo '</ul>';
						}

					}

					$hide_share = get_theme_mod( 'penci_review_sharing' );
					$hide_like  = get_theme_mod( 'penci_review_like_dislike' );
					if( ! $hide_share || ! $hide_like  ){
						echo '<div class="penci-user-review-action">';

						$url = add_query_arg( 'user_review_id',  $comment_id, get_permalink( get_the_ID() ) );

						if(  ! $hide_share ){
							echo self::get_review_sharing( $url, $review_title );
						}

						if( ! $hide_like ){
							echo self::get_review_like_dislike( $comment_id );
						}

						echo '</div>';
					}
					?>
				</div>
			</div>
			<?php
		}


		public static function get_review_number_text( $number ){
			if ( $number > 1 ) {
				$output = number_format_i18n( $number ) . ' ' . ( get_theme_mod( 'penci_review_more' ) ? get_theme_mod( 'penci_review_more' ) : esc_html__( 'reviews', 'penci' ) );
			} elseif ( $number == 0 ) {
				$output = get_theme_mod( 'penci_review_zero' ) ? get_theme_mod( 'penci_review_zero' ) : esc_html__( '0 review', 'penci' );
			} else {
				$output = get_theme_mod( 'penci_review_one' ) ? get_theme_mod( 'penci_review_one' ) : esc_html__( '1 review', 'penci' );
			}

			return $output;
		}

		public static function get_reviews_number(){
			$review = get_post_meta( get_the_ID(), 'penci_review_rating' );
			if( ! $review || is_array( $review ) ){
				return 0;
			}
			return count( (array)$review );
		}

		public static function get_review_date( $date ){
			return mysql2date(get_option('date_format'), $date );
		}

		public static function get_review_time( $date ) {
			return mysql2date( get_option( 'time_format' ), $date, true );
		}

		public static function get_review_sharing( $link,$text  ){
			$html = '<div class="penci-u-review-sharing">';

			if( ! get_theme_mod( 'penci_hide_ur_share_facebook' ) ) {
				$html .= sprintf(
					'<a class="penci-ur-social" target="_blank" title="%s" href="%s"><i class="fa fa-facebook"></i></a>',
					esc_html__( 'Share this on Facebook', 'penci' ),
					htmlentities( add_query_arg( array(
						'u' => rawurlencode( $link ),
					), 'https://www.facebook.com/sharer/sharer.php' ) )
				);
			}

			// Twitter
			if( ! get_theme_mod( 'penci_hide_ur_share_twitter' ) ) {
				$html .= sprintf(
					'<a class="penci-ur-social" target="_blank" title="%s" href="%s"><i class="fa fa-twitter"></i></a>',
					esc_html__( 'Tweet on Twitter', 'penci' ),
					htmlentities( add_query_arg( array(
						'url'  => rawurlencode( $link ),
						'text' => rawurlencode( $text ),
					), 'https://twitter.com/intent/tweet' ) )
				);
			}

			// Google+
			if( ! get_theme_mod( 'penci_hide_ur_share_google_plus' ) ) {
				$html .= sprintf(
					'<a class="penci-ur-social" target="_blank" title="%s" href="%s"><i class="fa fa-google-plus"></i></a>',
					esc_html__( 'Share on Google+', 'penci' ),
					htmlentities( add_query_arg( array(
						'url' => rawurlencode( $link ),
					), 'https://plus.google.com/share' ) )
				);
			}

			// Email+
			if( ! get_theme_mod( 'penci_hide_ur_share_email' ) ) {
				$html .= sprintf(
					'<a class="penci-ur-social" target="_blank" title="%s" href="%s"><i class="fa fa-envelope"></i></a>',
					esc_html__( 'Share on Email', 'penci' ),
					esc_url( 'mailto:?subject=' . $text . '&BODY=' . $link )
				);
			}

			// Link
			if( ! get_theme_mod( 'penci_hide_ur_share_link' ) ) {
				$html .= sprintf(
					'<a class="penci-ur-social" target="_blank" title="%s" href="%s"><i class="fa fa-globe"></i></a>',
					esc_html__( ' Standard Link', 'penci' ),
					$link
				);
			}

			$html .= '</div>';

			return $html;
		}

		public static function get_review_like_dislike( $comment_id ) {
			$post_id = get_the_ID();

			$like    = get_comment_meta( $comment_id, 'review_like', true );
			$dislike = get_comment_meta( $comment_id, 'review_dislike', true );

			$html = '<div class="penci-ur-like-dislike">';
			$html .= '<span class="penci-review-spinner"><i class="fa fa-spinner fa-pulse"></i></span>';
			$html .= '<a href="#" class="penci-ur-like" data-post_id="' . $post_id . '" data-comment_id="' . $comment_id . '" data-count="' . intval( $like ) . '">';
			$html .= '<i class="fa fa-thumbs-o-up"></i><span class="penci-share-number">' . intval( $like ) . '</span></a>';
			$html .= '<a href="#" class="penci-ur-dislike" data-post_id="' . $post_id . '" data-comment_id="' . $comment_id . '" data-count="' . intval( $dislike ) . '">';
			$html .= '<i class="fa fa-thumbs-o-down"></i><span class="penci-share-number">' . intval( $dislike ) . '</span></a>';
			$html .= '<div class="penci-review-judge-mess"></div>';
			$html .= '</div>';

			return $html;
		}

		public static function get_admin_reviews_order(){
			$output = array();
			$post_id = get_the_ID();
			$remove_review_old = get_post_meta( $post_id,'penci_remove_review_old', true );
			if( ! $remove_review_old ) {
				$arr_review_number = array( 'penci_review_1', 'penci_review_2', 'penci_review_3', 'penci_review_4', 'penci_review_5' );
				$penci_review = get_post_meta( $post_id, 'penci_review', true ) ;

				$penci_review = (array)$penci_review;

				foreach ( $arr_review_number as $review_number_item ) {
					$review_1    = isset( $penci_review[ $review_number_item ] ) ? $penci_review[ $review_number_item ] : '';
					if ( $review_1 ) {
						$output[] = $review_number_item;
					}
				}
			}

			$penci_review_more = get_post_meta( $post_id, 'penci_review_more', true );
			if ( $penci_review_more && is_array( $penci_review_more ) ) {
				foreach ( $penci_review_more as $key => $review_more ) {
					$review_more_title = isset( $review_more['title'] ) ? $review_more['title'] : '';
					$review_more_id = isset( $review_more['id'] ) ? $review_more['id'] : $key;
					if ( $review_more_title ) {
						$output[] = $review_more_id;
					}
				}
			}

			return $output;
		}
	}
endif;