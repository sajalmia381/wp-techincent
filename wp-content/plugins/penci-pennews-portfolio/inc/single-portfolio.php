<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
		$single_hide_img  = get_theme_mod( 'penci_hide_portfolio_featured_img' );
		$align_post_title = get_theme_mod( 'penci_portfolio_align_post_title' );

		$pfl_single_use_option_current  = get_post_meta( get_the_ID(), 'penci_pfl_use_opt_current_page', true );
		$pre_align_post_title   = get_post_meta( get_the_ID(), 'penci_pfl_align_post_title', true );

		if( $pfl_single_use_option_current ){
			$align_post_title = $pre_align_post_title;
		}

		$align_title     = 'penci-title-' . ( $align_post_title ? $align_post_title : 'center' );
		?>
		<div class="penci-container">
			<div class="penci-container__content">
				<div class="penci-wide-content penci-sticky-content">
					<div class="penci-content-post <?php echo esc_attr( ! $single_hide_img && penci_post_formats() ? '' : 'hide_featured_image' ); ?>">
						<?php
						while ( have_posts() ) : the_post();
							if ( ! get_theme_mod( 'penci_hide_portfolio_breadcrumb' ) ) : penci_breadcrumbs( array( 'taxonomy' => 'portfolio-category' ) ); endif;
							?>
							<article id="post-<?php the_ID(); ?>" class="portfolio type-portfolio">
								<header class="entry-header penci-entry-header">
									<?php the_title( '<h1 class="entry-title penci-entry-title ' . $align_title . '">', '</h1>' );  ?>
								</header><!-- .entry-header -->
								<div class="penci-entry-content entry-content">
									<div class="portfolio-page-content">
										<?php /* Thumbnail */
										if ( has_post_thumbnail() && ! get_theme_mod( 'penci_hide_portfolio_featured_img' ) ) {
											echo '<div class="single-portfolio-thumbnail">';
											the_post_thumbnail( 'penci-full-thumb' );
											echo '</div>';
										}
										?>
										<div class="portfolio-detail">
											<?php the_content(); ?>
										</div>
									</div>
								</div><!-- .entry-content -->
								<div class="penci-pfl-detail">
									<?php
									include PENCI_PORTFOLIO__DIR . "/template/info-portfolio.php";
									include PENCI_PORTFOLIO__DIR . "/template/pagination.php";
									include PENCI_PORTFOLIO__DIR . "/template/related-portfolio.php";

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() && get_theme_mod( 'penci_show_portfolio_comments' ) ) {
										comments_template();
									}
									?>
								</div>
							</article>
						<?php endwhile; ?>
					</div>
				</div>
				<?php get_sidebar( 'portfolio-left' ); ?>
				<?php get_sidebar( 'portfolio-right' ); ?>
			</div>
		</div>
	</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();

