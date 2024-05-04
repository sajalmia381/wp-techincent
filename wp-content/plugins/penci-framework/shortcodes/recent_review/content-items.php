<?php
$output = '';
if ( is_array( $comments ) && $comments ) {
	$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
	_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );


	foreach ( (array) $comments as $comment ) {

		$comment_id = $comment->comment_ID;
		$post_id = $comment->comment_post_ID;
		$author_email = $comment->comment_author_email;

		$author_img    = get_avatar( $author_email, 80 );
		$creview_score = get_comment_meta( $comment_id, 'review_score', true );

		$output .= '<div class="penci-recent-rv">';
		$output .= '<div class="penci-recent-rv-header">';

		if ( $author_img && ! $atts['hide_author_img'] ) {
			$output .= '<div class="penci-recent-rv-img">' . $author_img . '</div>';
		}

		$output .= '<div class="penci-recent-rv-author"><h5>' . get_comment_author( $comment ) . '</h5></div>';

		if ( ! $atts['hide_review_date'] ) {
			$output .= '<div class="penci-recent-rv-date penci_post-meta"><i class="fa fa-clock-o"></i>' . get_comment_date( '', $comment ) . '</div>';
		}

		if ( $creview_score && ! $atts['hide_review_rating'] && function_exists( 'penci_get_preview_rating_markup' ) ) {
			$output .= '<div class="penci-recent-rv-score penci-review-score">';
			$output .=  penci_get_preview_rating_markup( array(
				'rate'     => $creview_score,
				'format'   => true,
				'position' => 'relative',
			)  );
			$output .= '</div>';
		}

		$output .= '</div>';

		if( ! $atts['hide_rvtitle'] ) {
			$review_title = get_comment_meta( $comment_id, 'review_title', true );
			if ( $review_title ) {
				$review_title = wp_trim_words( $review_title, $atts['rvtitle_length'], '' );
				$url    = add_query_arg( 'user_review_id', $comment_id, get_permalink( $post_id ) );
				$output .= '<h3 class="penci-recent-rv-title"><a href="' . $url . '">' . $review_title . '</a></h3>';
			}
		}

		if( ! $atts['hide_excrept'] ){
			$comment_text = get_comment_text( $comment );
			$comment_text = wp_trim_words( $comment_text, $atts['excrept_length'], '' );
			if ( $comment_text ) {
				$comment_text .= '...';
			}
			$output .= '<div class="penci-recent-rv-excrept">' . $comment_text . '</div>';
		}

		$output .= '</div>';
	}
}

return $output;