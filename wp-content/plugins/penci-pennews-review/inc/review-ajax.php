<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Penci_User_Review_Ajax' ) ):
	 class Penci_User_Review_Ajax{
		public function __construct() {
			add_action( 'wp_ajax_nopriv_penci_review_user_rating', array( $this,'ajax_user_rating' ) );
			add_action( 'wp_ajax_penci_review_user_rating', array( $this,'ajax_user_rating' ) );

			add_action( 'wp_ajax_nopriv_penci_review_user_like', array( $this,'ajax_user_like' ) );
			add_action( 'wp_ajax_penci_review_user_like', array( $this,'ajax_user_like' ) );

			add_action( 'wp_ajax_nopriv_penci_review_user_dislike', array( $this,'ajax_user_dislike' ) );
			add_action( 'wp_ajax_penci_review_user_dislike', array( $this,'ajax_user_dislike' ) );

			add_action( 'wp_ajax_nopriv_penci_review_verify_badge', array( $this, 'ajax_verify_badge' ) );
			add_action( 'wp_ajax_penci_review_verify_badge', array( $this, 'ajax_verify_badge' ) );
		}

		 public static function ajax_verify_badge() {
			 $nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
			 if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
				 die ( 'Nope!' );
			 }

			 $comment_id = isset( $_POST['commentID'] ) ? $_POST['commentID'] : '';
			 $type       = isset( $_POST['type'] ) ? $_POST['type'] : '';

			 $status = update_comment_meta( $comment_id, 'review_verified', $type );


			 if ( $status ) {
				 self::update_verified_badge( $comment_id, $type );
				 wp_send_json_success( array( 'type' => ( 'verify' == $type ? 'unverify' : 'verify' ) ) );
			 } else {
				 wp_send_json_error();
			 }


		 }

		 public function ajax_user_rating(){
			 $nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
			 if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
				 die ( 'Nope!' );
			 }

			 $data = isset( $_POST['data'] ) ? $_POST['data'] : '';

			 $errors = array();

			 if ( empty( $data ) ) {
				 wp_send_json_error( array( 'mess' => esc_html__( 'The form was not submitted correctly', 'penci' ) ) );
			 }

			 parse_str( $data, $pre_data );

			 $postID = isset( $pre_data['penci_reivew_postID'] ) ? trim( $pre_data['penci_reivew_postID'] ) : '';

			 if ( empty( $postID ) ) {
				 wp_send_json_error( array( 'mess' => esc_html__( 'The form was not submitted correctly', 'penci' ) ) );
			 }


			 $current_user_id = 0;
			 $name    = isset( $pre_data['penci_reivew_author'] ) ? trim( $pre_data['penci_reivew_author'] ) : '';
			 $email   = isset( $pre_data['penci_reivew_email'] ) ? trim( $pre_data['penci_reivew_email'] ) : '';
			 $title   = isset( $pre_data['penci_reivew_title'] ) ? $pre_data['penci_reivew_title'] : '';
			 $comment = isset( $pre_data['penci_reivew_comment'] ) ? $pre_data['penci_reivew_comment'] : '';
			 $ratings  = isset( $pre_data['penci_review_rating'] ) ? $pre_data['penci_review_rating'] : '';
			 $req      = get_theme_mod( 'penci_review_require_name_email', true );

			 if ( is_user_logged_in() ) {
				 $current_user_id   = get_current_user_id();
				 $current_user_info = get_userdata( $current_user_id );

				 $name  = isset( $current_user_info->display_name ) ? $current_user_info->display_name : '';
				 $email = isset( $current_user_info->user_email ) ? $current_user_info->user_email : '';
			 }

			 if ( $name ) {
				 $name = sanitize_text_field( stripslashes_deep( $name ) );
			 } elseif( $req ) {
				 $errors[] = ( get_theme_mod( 'penci_review_namereq_text' ) ? get_theme_mod( 'penci_review_namereq_text' ) : esc_html__( 'Your name is required', 'penci' ) ) . '<br>';
			 }

			 if( $req ) {
				 if ( ! $email ) {
					 $errors[] = ( get_theme_mod( 'penci_review_emailreq_text' ) ? get_theme_mod( 'penci_review_emailreq_text' ) : esc_html__( 'Your email is required', 'penci' ) ) . '<br>';

				 } elseif ( ! is_email( $email ) ) {
					 $errors[] = ( get_theme_mod( 'penci_review_emailvaild_text' ) ? get_theme_mod( 'penci_review_emailvaild_text' ) : esc_html__( 'Your email is not valid', 'penci' ) ) . '<br>';

				 }
			 }

			 $comment = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", stripslashes_deep( $comment ) ) ) );
			 $title   = sanitize_text_field( stripslashes_deep( $title ) );

			 if( $errors ){
				 wp_send_json_error( array( 'mess' => implode( '', $errors ) ) );
			 }

			 $moderation = get_theme_mod( 'penci_review_moderation' );
			 $comment_approved = $moderation ? 0 : 1;

			 $data_insert_comment = array(
				 'comment_post_ID'      => $postID,
				 'comment_author'       => $name,
				 'comment_author_email' => $email,
				 'comment_author_url'   => '',
				 'comment_content'      => $comment,
				 'comment_agent'        => 'PenciReview',
				 'comment_type'         => 'penci_review',
				 'comment_parent'       => 0,
				 'user_id'              => $current_user_id,
				 'comment_approved'     => $comment_approved,
			 );

			 $allow_comment = $this->allow_comment( $data_insert_comment );

			 if( $allow_comment ){
				 wp_send_json_error( array( 'mess' => $allow_comment ) );
			 }

			 $comment_id = wp_insert_comment( $data_insert_comment );

			 if( ! $comment_id ){
				 $mess_error = get_theme_mod( 'penci_review_error_text' ) ? get_theme_mod( 'penci_review_error_text' ) : esc_html__( 'Error during rate process', 'penci' );
				 wp_send_json_error( array( 'mess' => $mess_error ) );
			 }

			 update_comment_meta( $comment_id, 'review_title', $title );
			 update_comment_meta( $comment_id, 'review_verified', '' );
			 update_comment_meta( $comment_id, 'review_like', 0 );
			 update_comment_meta( $comment_id, 'review_dislike', 0 );

			 $total_ratings = 0;
			 $order_ratings = 0;
			 foreach ( (array) $ratings as $rating_id => $rating ) {
				 $rating_title  = isset( $rating['title'] ) ? $rating['title'] : '';
				 $rating_number = isset( $rating['number'] ) ? $rating['number'] : '';

				 if ( ! $rating_title && ! $rating_number ) {
					 continue;
				 }

				 add_comment_meta( $comment_id, 'review_rating', array(
					 'id'     => $rating_id,
					 'title'  => $rating_title,
					 'number' => $rating_number
				 ) );

				 $total_ratings += $rating_number;
				 $order_ratings ++;
			 }

			 if ( $total_ratings && $order_ratings ) {
				 $review_score = number_format( $total_ratings / $order_ratings, 2 );
				 update_comment_meta( $comment_id, 'review_score', $review_score );
			 }

			 $link_reload = get_permalink( $postID ) . '#review-' . $postID . '-comment';

			 $mess = get_theme_mod( 'penci_review_thankyou_text' ) ? get_theme_mod( 'penci_review_thankyou_text' ) : esc_html__( 'Thank you for your rating.', 'penci' );
			 if( ! $moderation ){
				 $link_reload = add_query_arg( 'user_review_id',  $comment_id, get_permalink( $postID ) );
			 }else{
				 $mess .= '. ' . ( get_theme_mod( 'penci_urreview_awaiting_approval' ) ? get_theme_mod( 'penci_urreview_awaiting_approval' ) : esc_html__( 'Your review awaiting approval.', 'penci' ) );
			 }

			self::update_user_total_ratings( $postID );


			 wp_send_json_success( array( 'meta_id' => $comment_id, 'link_reload' => $link_reload, 'mess' => $mess ) );
		 }

		 public function ajax_user_like() {
			 $nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
			 if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
				 die ( 'Nope!' );
			 }

			 $comment_id = isset( $_POST['commentID'] ) ? $_POST['commentID'] : '';
			 $likeCount  = isset( $_POST['likeCount'] ) ? $_POST['likeCount'] : '';

			 $cookie_name = 'penci_ur_like_' . $comment_id;

			 if ( isset( $_COOKIE[ $cookie_name ] ) && 'increase' == $_COOKIE[ $cookie_name ] ) {
				 $likeCount    = $likeCount - 1;
				 $cookie_value = 'reduced';

			 } else {
				 $likeCount    = $likeCount + 1;
				 $cookie_value = 'increase';
			 }

			 $result = update_comment_meta( $comment_id, 'review_like', $likeCount );

			 if ( false === $result ) {
			 	$mess_like_error = get_theme_mod( 'penci_review_likeerror_text' ) ? get_theme_mod( 'penci_review_likeerror_text' ) : esc_html__( 'Unable to judge this review', 'penci' );
				 wp_send_json_error( array( 'mess' => $mess_like_error ) );
			 }

			 self::update_review_user_judgements( $comment_id, 'like', $cookie_value );



			 // Set the cookie
			 setcookie( $cookie_name, $cookie_value, time() + 60 * 60 * 24 * 30, '/' );

			 wp_send_json_success( array( 'likeCount' => $likeCount, 'mess' => '' ) );
		 }

		 public function ajax_user_dislike(){
			 $nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
			 if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
				 die ( 'Nope!' );
			 }

			 $comment_id = isset( $_POST['commentID'] ) ? $_POST['commentID'] : '';
			 $likeCount  = isset( $_POST['likeCount'] ) ? $_POST['likeCount'] : '';

			 $cookie_name = 'penci_ur_dislike_' . $comment_id;

			 if ( isset( $_COOKIE[ $cookie_name ] ) && 'increase' == $_COOKIE[ $cookie_name ] ) {
				 $likeCount    = $likeCount - 1;
				 $cookie_value = 'reduced';

			 } else {
				 $likeCount    = $likeCount + 1;
				 $cookie_value = 'increase';
			 }

			 $result = update_comment_meta( $comment_id, 'review_dislike', $likeCount );

			 if ( false === $result ) {
				 $mess_like_error = get_theme_mod( 'penci_review_likeerror_text' ) ? get_theme_mod( 'penci_review_likeerror_text' ) : esc_html__( 'Unable to judge this review', 'penci' );
				 wp_send_json_error( array( 'mess' => $mess_like_error ) );
			 }

			 self::update_review_user_judgements( $comment_id, 'dislike', $cookie_value );

			 // Set the cookie
			 setcookie( $cookie_name, $cookie_value, time() + 60 * 60 * 24 * 30, '/' );

			 wp_send_json_success( array( 'likeCount' => $likeCount, 'mess' => '' ) );
		 }

		 public function allow_comment( $commentdata ) {
			 global $wpdb;

			 $dupe = $wpdb->prepare(
				 "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_parent = 0 AND comment_approved != 'trash' AND ( comment_author = %s ",
				 wp_unslash( $commentdata['comment_post_ID'] ),
				 wp_unslash( $commentdata['comment_author'] )
			 );
			 if ( $commentdata['comment_author_email'] ) {
				 $dupe .= $wpdb->prepare(
					 "AND comment_author_email = %s ",
					 wp_unslash( $commentdata['comment_author_email'] )
				 );
			 }
			 $dupe .= $wpdb->prepare(
				 ") AND comment_content = %s LIMIT 1",
				 wp_unslash( $commentdata['comment_content'] )
			 );

			 $dupe_id = $wpdb->get_var( $dupe );


			 if ( $dupe_id ) {
				 $text_duplicate =  esc_html__('Duplicate review detected; it looks as though you&#8217;ve already review that!','penci');
				 return function_exists( 'penci_review_duplicate' ) ? penci_get_tran_setting( 'penci_review_duplicate' ) : $text_duplicate;
			 }

			 return '';
		 }

		 public static function update_user_total_ratings( $postID ) {
			 global $wpdb;
			 $comments = $wpdb->get_results( "
						SELECT comment_ID
						FROM {$wpdb->comments}
						WHERE comment_post_ID = '" . $postID . "' AND comment_type = 'penci_review' AND comment_approved != 'trash'
					", ARRAY_A
			 );

			 if ( ! $comments ) {
				 return;
			 }

			 $comments = (array) $comments;

			 $review_scores = 0;
			 foreach ( $comments as $comment ) {
				 $comment_id = $comment['comment_ID'];

				 $review_score = get_comment_meta( $comment_id, 'review_score', true );
				 if ( ! $review_score ) {
					 $ratings = get_comment_meta( $comment_id, 'review_rating', false );

					 $total_ratings = 0;
					 $order_ratings = 0;
					 if ( $ratings ) {
						 foreach ( (array) $ratings as $rating ) {
							 $rating_title  = isset( $rating['title'] ) ? $rating['title'] : '';
							 $rating_number = isset( $rating['number'] ) ? $rating['number'] : 0;

							 if ( $rating_title || $rating_number ) {
								 $total_ratings += $rating_number;
								 $order_ratings ++;
							 }
						 }
					 }

					 if ( $total_ratings && $order_ratings ) {
						 $review_score = number_format( $total_ratings / $order_ratings, 2 );
					 }

					 if ( $review_score ) {
						 update_comment_meta( $comment_id, 'review_score', $review_score );
					 }
				 }
				 $review_scores += intval( $review_score );
			 }

			 if ( $review_scores ) {

				 $count_comment     = count( (array)$comments );
				 $pre_review_scores = number_format( $review_scores / $count_comment, 2 );
				 update_post_meta( $postID, 'penci_ur_review_scores', $pre_review_scores );
			 }
		 }

		 public static function update_verified_badge( $comment_id, $type ) {
			 $comment = get_comment( $comment_id );

			 if ( isset( $comment->user_id ) && $comment->user_id && $user = get_userdata( $comment->user_id ) ) {

				 $user_id        = $comment->user_id;
				 $verified_badge = get_user_meta( $user_id, 'verified_badge', true );

				 if ( 'unverify' == $type && $verified_badge > 0 ) {
					 $verified_badge = $verified_badge - 1;
				 } elseif ( 'verify' == $type ) {
					 $verified_badge = $verified_badge + 1;
				 }

				 update_user_meta( $user_id, 'verified_badge', $verified_badge );
			 }
		 }

		 public static function update_review_user_judgements( $comment_id, $type, $status ) {
			 $comment = get_comment( $comment_id );

			 if ( isset( $comment->user_id ) && $comment->user_id && $user = get_userdata( $comment->user_id ) ) {

				 $user_id        = $comment->user_id;

				 if ( 'like' == $type ) {
					 $review_like = get_user_meta( $user_id, 'review_like', true );

					 if ( 'reduced' == $status && $review_like > 0 ) {
						 $review_like = $review_like - 1;
					 } elseif ( 'increase' == $status ) {
						 $review_like = $review_like + 1;
					 }

					 update_user_meta( $user_id, 'review_like', intval( $review_like ) );

				 } elseif ( 'dislike' == $type ) {
					 $review_dislike = get_user_meta( $user_id, 'review_dislike', true );

					 error_log( $review_dislike );
					 if ( 'reduced' == $status && $review_dislike > 0 ) {
						 $review_dislike = $review_dislike - 1;
					 } elseif ( 'increase' == $status ) {
						 $review_dislike = $review_dislike + 1;
					 }

					 update_user_meta( $user_id, 'review_dislike', intval( $review_dislike ) );
				 }
			 }
		 }
	 }
endif;


/**
 * Functions callback when rating voted
 *
 * @since 1.0
 */
if ( ! function_exists( 'penci_pennews_rateyo_reivew' ) ) {
	add_action( 'wp_ajax_nopriv_penci_pennews_rateyo_reivew', 'penci_pennews_rateyo_reivew' );
	add_action( 'wp_ajax_penci_pennews_rateyo_reivew', 'penci_pennews_rateyo_reivew' );
	function penci_pennews_rateyo_reivew() {
		$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			die ( 'Nope!' );
		}

		$postid = isset( $_POST['postid'] ) ? $_POST['postid'] : '';
		$rating = isset( $_POST['rating'] ) ? $_POST['rating'] : '';

		if ( empty( $postid ) ) {
			wp_send_json_error();
		}

		// Get rate meta in post
		$rate_total  = get_post_meta( $postid, 'penci_review_rate_total', true );
		$rate_people = get_post_meta( $postid, 'penci_review_rate_people', true );

		// Update rate meta to post
		$update_rate_total = intval( $rating ) + intval( $rate_total );
		update_post_meta( $postid, 'penci_review_rate_total', $update_rate_total );
		$update_rate_people = intval( $rate_people ) + 1;
		update_post_meta( $postid, 'penci_review_rate_people', $update_rate_people );

		setcookie( 'penci_review_rate_postid_' . $postid, rand(), time() + ( 86400 * 30 ), "/" );

		wp_reset_postdata();
		wp_send_json_success( array( 'rate_total' => $update_rate_total, 'rate_people' => $update_rate_people ) );
	}
}