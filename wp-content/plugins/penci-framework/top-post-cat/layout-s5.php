<?php
$query_cat_grid = new WP_Query( array(
	'posts_per_page' => penci_get_number_of_cat_top_grid(),
	'cat'            => get_queried_object_id(),
) );
if ( ! $query_cat_grid->have_posts() ) {
	return;
}

$post_placeholder  = 2 - intval( $query_cat_grid->post_count );
?>
	<div class="penci-category-grid penci-catgrid-s5">
		<div class="penci-container">
			<div class="penci-pitems-wrap clearfix">
				<?php
				$cat_grid_i = 1;
				while ( $query_cat_grid->have_posts() ) :
					$query_cat_grid->the_post();

					$post_id = get_the_ID();
					?>
					<article <?php post_class( 'penci-post-item penci-pitem-big  penci-text-below-img penci-pitem-' . $cat_grid_i ); ?>>
						<?php
						echo Penci_Helper_Shortcode::get_image_holder_pre( array(
							'image_size'  => 'penci-thumb-480-480',
							'class'       => 'penci-gradient',
							'show_icon'   => true,
							'size_icon'   => 'icon_pos_right',
							'hide_review' => true,
						) );
						?>
						<div class="penci-post-info">
							<?php
							echo Penci_Helper_Shortcode::get_post_meta( array( 'cat' ), array( 'hide_cat' => false ), false );
							echo Penci_Helper_Shortcode::get_markup_title_post( 10 );
							?>
						</div>
					</article>

					<?php

					if ( $post_placeholder && $cat_grid_i == $query_cat_grid->post_count ) {
						for( $i = 1; $i <= $post_placeholder; $i ++ ) {
							$cat_grid_i2 = $cat_grid_i + $i;
							?>
							<article <?php post_class( 'penci-post-item penci-pitem-small penci-pitem-placeholder penci-pitem-' . $cat_grid_i2 ); ?>>
								<?php
								echo Penci_Helper_Shortcode::get_image_holder_pre( array(
									'hide_review' => true,
								) );
								?>
							</article>
							<?php
						}
					}

					$cat_grid_i ++;
				endwhile;
				?>
			</div>
		</div>
	</div>
<?php
wp_reset_postdata();