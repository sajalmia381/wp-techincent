<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Penci review Shortcode
 * Use penci_review to display the review on single a post
 */
if( ! function_exists( 'penci_review_shortcode_function' ) ) {
	function penci_review_shortcode_function( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'id' => '',
			'wpblock' => ''
		), $atts ) );

		$review_id = get_the_ID();
		if ( ! empty( $id ) && is_numeric( $id ) ) {
			$review_id = $id;
		}

		// Get review meta
		$penci_review = get_post_meta( $review_id, 'penci_review', true );

		if( empty( $penci_review ) ) {
			return;
		}


		$review_style = isset( $penci_review['penci_review_style'] ) ? $penci_review['penci_review_style'] : 'style_1';
		$review_title = isset( $penci_review['penci_review_title'] ) ? $penci_review['penci_review_title'] : '';
		$review_des   = isset( $penci_review['penci_review_des'] ) ? $penci_review['penci_review_des'] : '';
		$review_good  = isset( $penci_review['penci_review_good'] ) ? $penci_review['penci_review_good'] : '';
		$review_bad   = isset( $penci_review['penci_review_bad'] ) ? $penci_review['penci_review_bad'] : '';

		$review_ct_image    = isset( $penci_review['penci_review_ct_image'] ) ? $penci_review['penci_review_ct_image'] : '';
		$review_address     = isset( $penci_review['penci_review_address'] ) ? $penci_review['penci_review_address'] : '';
		$review_phone       = isset( $penci_review['penci_review_phone'] ) ? $penci_review['penci_review_phone'] : '';
		$review_website     = isset( $penci_review['penci_review_website'] ) ? $penci_review['penci_review_website'] : '';
		$review_price       = isset( $penci_review['penci_review_price'] ) ? $penci_review['penci_review_price'] : '';
		$review_linkbuy     = isset( $penci_review['penci_review_linkbuy'] ) ? $penci_review['penci_review_linkbuy'] : '';
		$review_textbuy     = isset( $penci_review['penci_review_textbuy'] ) ? $penci_review['penci_review_textbuy'] : '';
		$schema_markup_type = isset( $penci_review['penci_review_schema_markup'] ) ? $penci_review['penci_review_schema_markup'] : '';
		$img_size_pre       = isset( $penci_review['penci_review_img_size'] ) ? $penci_review['penci_review_img_size'] : '';

		$schema_options_val = get_post_meta( $review_id, 'penci_review_schema_options', true );
		$schema_type_val    = isset( $schema_options_val[ $schema_markup_type ] ) ? $schema_options_val[ $schema_markup_type ] : array();

		// Turn review good and bad into an array
		$review_good_array = '';
		$review_bad_array  = '';
		if ( $review_good ):
			$review_good_array = preg_split( '/\r\n|[\r\n]/', $review_good );
		endif;
		if ( $review_bad ):
			$review_bad_array = preg_split( '/\r\n|[\r\n]/', $review_bad );
		endif;

		// Global score and based number point
		$total_score = 0;
		$total_num   = 0;
		$post_author_id = get_post_field( 'post_author', $review_id );
		$author_name = get_the_author_meta( 'display_name', $post_author_id );

		$rate_total  = get_post_meta( $review_id, 'penci_review_rate_total', true );
		$rate_total  = $rate_total ? $rate_total : 0;
		$rate_people = get_post_meta( $review_id, 'penci_review_rate_people', true );
		$rate_people = $rate_people ? $rate_people : 0;
		$rate_number = 0;
		if( $rate_total && $rate_people ){
			$rate_number = number_format( intval( $rate_total ) / intval( $rate_people ), 1 );
		}
		$allow_rate = 1;
		if( isset( $_COOKIE[ 'penci_review_rate_postid_'.$review_id ] ) ){
			$allow_rate = 0;
		}

		$text_vote = esc_html__( 'votes', 'penci' );
		if( get_theme_mod( 'penci_review_voted_text' ) ) {
			$text_vote = do_shortcode( get_theme_mod( 'penci_review_voted_text' ) );
		}


		$no_rate_text = esc_html__( 'Be the first one !', 'penci' );
		if( get_theme_mod( 'penci_review_no_rate_text' ) ) {
			$no_rate_text = do_shortcode( get_theme_mod( 'penci_review_no_rate_text' ) );
		}

		$user_rating_text = esc_html__( 'User Rating:', 'penci' );
		if( get_theme_mod( 'penci_review_user_rating_text' ) ) {
			$user_rating_text = do_shortcode( get_theme_mod( 'penci_review_user_rating_text' ) );
		}

		$review_rating_text = esc_html__( 'Author Review:', 'penci' );
		if( get_theme_mod( 'penci_review_author_rating_text' ) ) {
			$review_rating_text = do_shortcode( get_theme_mod( 'penci_review_author_rating_text' ) );
		}

		// Hide featured image
		$hide_img     = penci_predata_customize_pmeta( $penci_review, 'penci_rv_hide_featured_img', 'penci_rv_hide_featured_img' );
		$hide_desc    = penci_predata_customize_pmeta( $penci_review, 'penci_rv_dis_desc', 'penci_rv_dis_desc' );
		$hide_goodbad = penci_predata_customize_pmeta( $penci_review, 'penci_rv_dis_goodbad', 'penci_rv_dis_goodbad' );
		$hide_point   = penci_predata_customize_pmeta( $penci_review, 'penci_rv_dis_point', 'penci_rv_dis_point' );
		$hide_schema   = penci_predata_customize_pmeta( $penci_review, 'penci_review_hide_schema', 'penci_rv_hide_schema'  );

		$simple_author     = get_theme_mod( 'penci_rv_enable_sim_author' );
		$ctp_simple_author = isset( $penci_review['penci_rv_enable_sim_author'] ) ? $penci_review['penci_rv_enable_sim_author'] : '';
		if( 'enable' == $ctp_simple_author ){
			$simple_author = true;
		}elseif( 'disable' == $ctp_simple_author ){
			$simple_author = false;
		}

		$total_average               = penci_get_review_average_score( $review_id );
		$simple_author_total_average = number_format( $total_average / 2, 0 );

		ob_start();
		?>
		<aside class="wrapper-penci-review <?php echo( $review_style ? 'penci-review-' . $review_style : '' ); ?>">
			<div class="penci-review">
				<div class="penci-review-container penci-review-count">
					<?php
					$img_size = get_theme_mod( 'penci_review_img_size', 'thumbnail' );
					if ( $img_size_pre ) {
						$img_size = $img_size_pre;
					}

					$url_review_ct_image = wp_get_attachment_image_url( $review_ct_image, $img_size );
					if ( ! $url_review_ct_image && has_post_thumbnail( $review_id ) ) {
						$url_review_ct_image = get_the_post_thumbnail_url( $review_id, $img_size );
					}

					if ( $url_review_ct_image && ! $hide_img ): ?>
						<div class="penci-review-thumb">
							<img src="<?php echo $url_review_ct_image; ?>" alt="<?php echo esc_attr( $review_title ); ?>"/>
						</div>
					<?php endif; ?>
					<?php if ( $review_title ) : ?>
						<h4 class="penci-review-title"><?php echo $review_title; ?></h4>
					<?php endif; ?>
					<div class="penci-review-metas">
						<?php
						if( $review_price && ! get_theme_mod( 'penci_review_hide_price' ) ){
							$price_text = penci_review_tran_setting( 'penci_review_price_text' );
							echo '<div class="penci-review-meta penci-review-price"><strong>' . $price_text . '</strong> ' . $review_price . '</div>';
						}
						if( $review_phone && ! get_theme_mod( 'penci_review_hide_phone' ) ){
							echo '<div class="penci-review-meta penci-review-phone"><i class="fa fa-phone"></i><a href="tel:' . $review_phone . '">' . $review_phone . '</a></div>';
						}
						if( $review_address && ! get_theme_mod( 'penci_review_hide_address' ) ){
							echo '<div class="penci-review-meta penci-review-address"><i class="fa fa-map-marker"></i>' . $review_address . '</div>';
						}
						if( $review_website && ! get_theme_mod( 'penci_review_hide_website' ) ){
							echo '<div class="penci-review-meta penci-review-website"><i class="fa fa-globe"></i><a href="' . esc_url( $review_website ) . '" target="_blank">' . $review_website . '</a></div>';
						}
						if ( $review_textbuy && ! get_theme_mod( 'penci_review_hide_btnbuy' ) ) {
							$prefix = $suffix = 'div';

							if ( $review_linkbuy ) {
								$prefix = 'a href="' . esc_url( $review_linkbuy ) . '" ';
								$suffix = 'a';
							}
							echo '<' . $prefix . ' class="penci-review-btnbuy button" target="_blank">' . $review_textbuy . '</' . $suffix . '>';
						}
						?>
					</div>
					<?php if( ! $hide_schema ): ?>
					<div class="penci-review-schemas">
						<?php
						$schema_fields = Penci_Review_Schema_Markup::get_schema_types( $schema_markup_type );
						if( $schema_fields ){
							foreach ( $schema_fields as $schema_field ){
								if( isset( $schema_type_val[$schema_field['name']] ) && $schema_type_val[$schema_field['name']] ){
									echo '<div class="penci-review-schema"><strong>' . $schema_field['label'] . ' : </strong>' . $schema_type_val[$schema_field['name']] . '</div>';
								}
							}
						}
						?>
					</div>
					<?php endif; ?>

					<?php if ( $review_des && ! $hide_desc ) : ?>
						<div class="penci-review-desc"><p><?php echo $review_des; ?></p></div>
					<?php endif; ?>
					<span style="display: none !important;">
					<span><?php echo  ( $author_name ? $author_name : get_bloginfo( 'description', 'display' ) ); ?></span></span>
					<?php
					if( ! $hide_point ){
						include dirname( __FILE__ ) . "/templates/{$review_style}.php";
					}
					?>
				</div>
				<?php if( ! $hide_goodbad ){ ?>
				<div class="penci-review-container penci-review-point">
					<div class="penci-review-row">
						<?php if ( $review_good_array || $review_bad_array ) : ?>
							<div class="penci-review-stuff">
								<div class="penci-review-row<?php if ( ! $review_good_array || ! $review_bad_array ) : echo ' full-w'; endif; ?>">
									<?php if ( $review_good_array ) : ?>
										<div class="penci-review-good">
											<h5 class="penci-review-title"><?php if ( get_theme_mod( 'penci_review_good_text' ) ) {
													echo get_theme_mod( 'penci_review_good_text' );
												} else {
													esc_html_e( 'The Goods', 'penci' );
												} ?></h5>
											<ul>
												<?php foreach ( $review_good_array as $good ) : ?>
													<?php if ( $good ) : ?>
														<li><?php echo $good; ?></li>
													<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										</div>
									<?php endif; ?>
									<?php if ( $review_bad_array ) : ?>
										<div class="penci-review-good penci-review-bad">
											<h5 class="penci-review-title"><?php if ( get_theme_mod( 'penci_review_bad_text' ) ) {
													echo get_theme_mod( 'penci_review_bad_text' );
												} else {
													esc_html_e( 'The Bads', 'penci' );
												} ?></h5>
											<ul>
												<?php foreach ( $review_bad_array as $bad ) : ?>
													<?php if ( $bad ) : ?>
														<li><?php echo $bad; ?></li>
													<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="penci-review-average<?php if ( ! $review_good_array && ! $review_bad_array ) : echo ' full-w'; endif; ?>">
							<div class="penci-review-score-total<?php if ( get_theme_mod( 'penci_review_hide_average' ) ): echo ' only-score'; endif; ?>">
								<div class="penci-review-score-num">
									<?php
									echo penci_get_review_average_score_format( $review_id, $total_average );
									?>
									<span style="display: none !important;"><?php echo number_format( $total_average / 2, 2, '.', '' ); ?></span>
									<span style="display: none !important;">5</span>
								</div>
								<?php if ( 'style_3' == $review_style ) : ?>
									<div class="penci-review-score-num-star">
										<?php

										$star = $total_average / 2;
										for ( $i = 1; $i <= 5; $i ++ ) {
											if ( $i <= $star ) {
												echo '<i class="fa fa-star"></i>';
											} else {
												echo '<i class="fa fa-star-o"></i>';
											}

										}
										?>
									</div>
								<?php else: ?>
									<div class="penci-review-process">
										<span class="penci-process-run" data-width="<?php echo number_format( $total_average, 1, '.', '' ); ?>" <?php echo ( isset( $wpblock ) && $wpblock ? 'style="width: ' . $total_average . '0%"' : '' ); ?>></span>
									</div>
								<?php endif; ?>
								<?php if ( ! get_theme_mod( 'penci_review_hide_average' ) ): ?>
									<span><?php if ( get_theme_mod( 'penci_review_average_text' ) ) {
											echo get_theme_mod( 'penci_review_average_text' );
										} else {
											esc_html_e( 'Average Score', 'penci' );
										} ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php } // End hide good bad ?>
				<?php if( $simple_author ){  ?>
					<div class="penci-review-container penci-usewr-review">
						<div class="penci-review-text">
							<div class="penci-review-point">
							<span class="penci-numbers-rate">
								<?php echo $review_rating_text; ?>
								<span class="penci-rate-number"><?php echo $simple_author_total_average; ?>/5</span>
							</span>
							</div>
							<div class="penci-review-score">
								<?php
								penci_get_preview_rating_markup( array(
									'rate'     => $simple_author_total_average,
									'format'   => true,
									'show'     => true,
									'position' => 'relative',
								) );
								?>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if( get_theme_mod( 'penci_user_review_enable' ) ){ ?>
					<?php if( $penci_ur_review_scores = get_post_meta( get_the_ID(), 'penci_ur_review_scores', true ) ){ ?>
					<div class="penci-review-container penci-usewr-review">
						<div class="penci-review-text">
							<div class="penci-review-point">
							<span class="penci-numbers-rate">
								<?php echo $user_rating_text; ?>
								<span class="penci-rate-number"><?php echo $penci_ur_review_scores; ?>/5</span>
							</span>
							</div>
							<div class="penci-review-score">
								<?php
								penci_get_preview_rating_markup( array(
									'rate'     => $penci_ur_review_scores,
									'format'   => true,
									'show'     => true,
									'position' => 'relative',
								) );
								?>
							</div>
						</div>
					</div>
					<?php } ?>
				<?php }else if( ! get_theme_mod( 'penci_review_hide_user_rating' ) ){ ?>
				<div class="penci-review-container penci-usewr-review">
					<div class="penci-review-text">
						<div class="penci-review-point">
							<span class="penci-numbers-rate">
								<?php echo $user_rating_text; ?>
								<span class="penci-rate-number"><?php echo ( $rate_number ? $rate_number : '' ); ?>/5</span>
								<small>( <span class="penci-number-people"><?php echo ( $rate_people ? $rate_people : $no_rate_text ) ?></span><span class="penci-text-votes<?php echo ( ! $rate_people ? ' penci-hide-text-votes' : '' ) ?>"> <?php echo $text_vote; ?></span> )</small>
							</span>
						</div>
						<div class="penci-review-score">
							<div class="penci_rateyo_reivew" class="penci_rateyo_reivew" data-allow="<?php esc_attr_e( $allow_rate )?>" data-rate="<?php echo intval( $rate_number ); ?>" data-postid="<?php esc_attr_e( $review_id );?>" data-people="<?php echo $rate_people; ?>" data-total="<?php echo $rate_total; ?>"></div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</aside>
		<?php

//		if( 'none' != $schema_markup_type && $schema_type_val ) {
//			Penci_Review_Schema_Markup::output_schema( array(
//				'penci_review'    => $penci_review,
//				'schema_type'     => $schema_markup_type,
//				'schema_type_val' => $schema_type_val,
//				'ratingValue'     => $simple_author_total_average,
//				'post_id'         => $review_id
//			) );
//		}

		return ob_get_clean();
	}
}

add_shortcode( 'penci_review', 'penci_review_shortcode_function' );
