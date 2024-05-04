<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Penci_Management_Review_Columns' ) ):
	class Penci_Management_Review_Columns{
		public function __construct() {
			if( isset( $_GET['comment_type'] ) && 'penci_review' == $_GET['comment_type'] ) {
				add_filter( 'manage_edit-comments_columns', array( $this, 'add_comments_columns' ) );
				add_action( 'manage_comments_custom_column', array( $this, 'comments_custom_column' ), 10, 2 );
			}
			
			add_action( 'add_meta_boxes_comment', array( $this, 'add_meta_box' ) );
			add_action( 'comment_edit_redirect', array( $this, 'save_comment' ),10,2 );
		}
		
		public function add_meta_box( $comment ) {
			if( 'penci_review' != $comment->comment_type ){
				return;
			}
			
			add_meta_box( 'penci-user-review-setting', esc_html__( 'Review Option','penci' ), array( $this, 'render_meta_box_content' ), 'comment', 'normal', 'high' );
		}
		
		public function render_meta_box_content( $comment ){
			$comment_ID = $comment->comment_ID;
			$title = get_comment_meta( $comment_ID, 'review_title', true );
			$review_verified = get_comment_meta( $comment_ID, 'review_verified', true );
			$review_ratings = get_comment_meta( $comment_ID, 'review_rating' , false );


			wp_nonce_field( 'penci_review_custom_box', 'penci_review_custom_box_nonce' );
			?>
			<p>
				<span class="penci-format-row"><?php esc_html_e( 'Review Title :','penci' ); ?></span>
				<input type="text" name="penci_reivew_title" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
			</p>
			<ul class="penci-scores-rateYo penci-stars">
				<?php 
				foreach ( (array)$review_ratings as $review_rating ){
					$review_rating_title = isset( $review_rating['title'] ) ? $review_rating['title'] : '';
					$review_rating_number = isset( $review_rating['number'] ) ? $review_rating['number'] : 0;
					$review_rating_id     = isset( $review_rating['id'] ) ? $review_rating['id'] : 0;
					?>
					<li>
						<div class="penci-format-row"><?php echo $review_rating_title; ?> :</div>
						<div class="penci-review-star-criteria">
							<div class="penci-reivew-star-rateYo" <?php echo ( $review_rating_number ? ' data-rating="' . esc_attr( $review_rating_number ) . '"' : '' ); ?>></div>
							<?php if( $review_rating_id ): ?>
							<input type="hidden" name="penci_review_rating[<?php echo esc_attr( $review_rating_id ); ?>][number]" value="<?php echo esc_attr( $review_rating_number ); ?>" class="penci-reivew-star-value">
							<input type="hidden" name="penci_review_rating[<?php echo esc_attr( $review_rating_id ); ?>][title]" value="<?php echo $review_rating_title; ?>">
							<?php endif; ?>
						</div>
					</li>
					<?php
				}
				?>
			</ul>
			<p>
				<span class="penci-format-row"><?php esc_html_e( 'Verified Badge :', 'penci' ); ?></span>
				<select name="penci_reivew_verified_badge" id="penci_reivew_verified_badge">
					<option value="unverify" <?php selected( $review_verified, 'unverify' ) ?>>Unverify</option>
					<option value="verify" <?php selected( $review_verified, 'verify' ) ?>>Verify</option>
				</select>
			</p>
			<?php
			
		}

		public function save_comment(  $location, $comment_id ){
			global $wpdb;

			if ( ! isset( $_POST['penci_review_custom_box_nonce'] ) ) {
				return $location;
			}

			$nonce = $_POST['penci_review_custom_box_nonce'];

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, 'penci_review_custom_box' ) ) {
				return $location;
			}

			$results = $wpdb->get_results( "
						SELECT meta_id,meta_value
						FROM {$wpdb->commentmeta}
						WHERE comment_id = '{$comment_id}' AND meta_key = 'review_rating'
					", ARRAY_A
			);

			$total_ratings = 0;
			$order_ratings = 0;

			$new_ratings = isset( $_POST['penci_review_rating'] ) ? $_POST['penci_review_rating'] : '';
			foreach ( $results as $result ) {
				$old_rating = maybe_unserialize( $result['meta_value'] );

				$old_rating_id = isset( $old_rating['id'] ) ? $old_rating['id'] : '';
				$rating        = isset( $new_ratings[ $old_rating_id ] ) ? $new_ratings[ $old_rating_id ] : array();

				if ( $rating ) {
					$rating_title  = isset( $rating['title'] ) ? $rating['title'] : '';
					$rating_number = isset( $rating['number'] ) ? $rating['number'] : '';

					$wpdb->update(
						$wpdb->commentmeta,
						array( 'meta_value' => serialize( array( 'id' => $old_rating_id, 'title' => $rating_title, 'number' => $rating_number ) ) ),
						array( 'meta_id' => $result['meta_id'] ),
						array( '%s' ), array( '%s' )
					);

					$total_ratings += $rating_number;
					$order_ratings ++;
				}
			}

			if ( $total_ratings && $order_ratings ) {
				$review_score = number_format( $total_ratings / $order_ratings, 2 );
				update_comment_meta( $comment_id, 'review_score', $review_score );
			}

			$title          = isset( $_POST['penci_reivew_title'] ) ? $_POST['penci_reivew_title'] : '';
			$verified_badge = isset( $_POST['penci_reivew_verified_badge'] ) ? $_POST['penci_reivew_verified_badge'] : '';
			update_comment_meta( $comment_id, 'review_title', $title );

			if ( $verified_badge ) {
				update_comment_meta( $comment_id, 'review_verified', $verified_badge );

				Penci_User_Review_Ajax::update_verified_badge( $comment_id, $verified_badge );
			}

			$comment_current = get_comment( $comment_id );

			if( isset( $comment_current->comment_post_ID ) && $comment_current->comment_post_ID ){
				Penci_User_Review_Ajax::update_user_total_ratings( $comment_current->comment_post_ID );
			}

			return $location;

		}

		public function add_comments_columns( $columns ) {
			$column_thumbnail = array( 'urreview_criteria' => 'Criteria' );
			$column_shortcode = array( 'urreview_title' => 'Title' );
			$columns          = array_slice( $columns, 0, 2, true ) + $column_shortcode + array_slice( $columns, 2, null, true );
			$columns          = array_slice( $columns, 0, 4, true ) + $column_thumbnail + array_slice( $columns, 4, null, true );

			return $columns;
		}

		public function comments_custom_column( $column, $comment_ID ){
			switch ( $column ) {
				case 'urreview_title':
					$urreview_title = get_comment_meta( $comment_ID, 'review_title', true );
					$review_verified = get_comment_meta( $comment_ID, 'review_verified', true );

					if( $urreview_title ){
						echo '<p>' . $urreview_title . '</p>';
					}elseif( ! $review_verified ){
						echo '--';
					}

					if( 'verify' == $review_verified ){
						echo '<span class="button button-verify-badge" style=" background: #be2459; color: #fff;border: 0;">Verified</span>';
					}

					break;
				case 'urreview_criteria':
					$review_ratings = get_comment_meta( $comment_ID, 'review_rating' , false );
					echo '<ul>';
					foreach ( (array)$review_ratings as $review_rating ){
						$review_rating_title = isset( $review_rating['title'] ) ? $review_rating['title'] : '';
						$review_rating_number = isset( $review_rating['number'] ) ? $review_rating['number'] : 0;
						if ( $review_rating_title && $review_rating_number ) {

							echo '<li>';
							echo '<div><strong>' . $review_rating_title . '<strong></div>';

							echo '<div>';
							for ( $i = 1; $i <= 5; $i ++ ) {
								echo '<span class="dashicons  ' . ( $i <= $review_rating_number ? 'dashicons-star-filled' : 'dashicons-star-empty' ) . '"></span>';
							}
							echo '</div>';

							echo '</li>';
						}
					}
					echo '</ul>';
					break;

			}
		}
	}

	new Penci_Management_Review_Columns;
endif;