<?php
$single_style        = penci_get_setting( 'penci_single_template' );
$single_hide_img     = false;
$align_title         = 'penci-title-' . penci_get_setting( 'penci_single_align_post_title' );
$single_loadmore     = penci_get_setting( 'penci_auto_load_prev_post' );
$featured_image_size = penci_single_optimize_featured_img_size( 'style-4' );


$dis_jarallax       = get_theme_mod( 'penci_dis_jarallax_single' );
$dis_jarallax_pmt   = get_post_meta( get_the_ID(), 'dis_jarallax_fea_img', true );
$use_option_current = get_post_meta( get_the_ID(), 'penci_use_option_current_single', true );
if( $dis_jarallax_pmt && $use_option_current ){
	$dis_jarallax = true;
}
$post_thumb_url      = penci_post_formats( $featured_image_size, false, ! $dis_jarallax );
?>

<?php while ( have_posts() ) : the_post(); $pheader_show = penci_check_page_title_show(); ?>
	<div class="entry-media penci-entry-media">
		<?php if ( $post_thumb_url && ! $single_hide_img ): ?>
			<?php echo ( $post_thumb_url ); ?>
		<?php endif; ?>
	</div>
	<div class="penci-container">
		<div class="penci-container__content<?php penci_class_pos_sidebar_content(); ?>">
			<div class="penci-wide-content penci-content-novc penci-sticky-content penci-content-single-inner">
				<div class="theiaStickySidebar">
				<div class="penci-content-post noloaddisqus <?php echo esc_attr( ! $single_hide_img && $post_thumb_url ? '' : 'hide_featured_image' ); ?>" data-url="<?php the_permalink() ?>" data-id="<?php the_ID(); ?>" data-title="<?php get_the_guid(); ?>">
					<?php

						if ( ! penci_get_setting( 'penci_hide_single_breadcrumb' ) && ! $pheader_show ) : penci_breadcrumbs( ); endif;
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'penci-single-artcontent' ); ?>>
							<header class="entry-header penci-entry-header <?php echo esc_attr( $align_title ); ?>">
								<?php
								if ( ! penci_get_setting( 'penci_hide_single_category' ) ) {
									echo '<div class="penci-entry-categories">';
									penci_get_categories();
									echo '</div>';
								}
								if( ! $pheader_show ) {
									the_title( '<h1 class="entry-title penci-entry-title ' . $align_title . '">', '</h1>' );
								}
								$subtitle_show = penci_check_page_subtitle_show();
								$post_subtitle = get_post_meta( get_the_ID(), 'penci_post_subtitle', true );
								if( $subtitle_show && $post_subtitle ) {
									echo '<h2 class="penci-post-subtitle">' . do_shortcode( $post_subtitle ) . '</h2>';
								}
								?>

								<div class="entry-meta penci-entry-meta">
									<?php penci_posted_on(); ?>
								</div><!-- .entry-meta -->
								<?php
								if ( ! penci_get_setting( 'penci_hide_single_social_share_top' ) ) {
									get_template_part( 'template-parts/social-share' );
								}
								?>
							</header><!-- .entry-header -->
							<?php get_template_part( 'template-parts/single/entry-content' ); ?>

							<footer class="penci-entry-footer">
								<?php
								penci_entry_footer();
								penci_get_tags_source_via();

								if ( ! penci_get_setting( 'penci_hide_single_social_share_bottom' ) ) {
									get_template_part( 'template-parts/social-share' );
								}
								?>
							</footer><!-- .entry-footer -->
						</article>
						<?php

						get_template_part( 'template-parts/post_pagination' );
						get_template_part( 'template-parts/author-box' );
						get_template_part( 'template-parts/related_posts' );
						get_template_part( 'template-parts/comment-box' );

					endwhile; // End of the loop.
					?>
				</div>
				<?php get_template_part( 'template-parts/animation-loadpost' ); ?>
				</div>
			</div>
			<?php get_sidebar( 'second' ); ?>
			<?php get_sidebar(); ?>
		</div>

	</div>
<?php
