<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PenNews
 */
get_header(); ?>
<?php
$cat_layout_style = penci_get_taxomony_layout_style( 'category' );
?>
	<div id="primary" class="content-area penci-archive">
		<main id="main" class="site-main" >
			<?php
			$cat_top_pstyle     = penci_get_setting( 'penci_cat_top_pstyle' );
			if ( $cat_top_pstyle ) {
				$query_cat_grid = new WP_Query( array(
					'posts_per_page' => penci_get_number_of_cat_top_grid(),
					'cat'            => get_queried_object_id(),
				) );
				if ( $query_cat_grid->have_posts() ) {
					$count_post_cat_top = intval( $query_cat_grid->post_count );
				}

				do_action( 'pennews/top-post-cat/layout', $cat_top_pstyle, $query_cat_grid );
			}
			?>
			<div class="penci-container">
				<div class="penci-container__content<?php penci_class_pos_sidebar_content(); ?>">
					<div class="penci-wide-content penci-content-novc penci-sticky-content">
						<div class="theiaStickySidebar">
						<div  id="penci-archive__content" class="penci-archive__content penci-layout-<?php echo esc_attr( $cat_layout_style ); ?>">
							<?php
							$pcat_hide_title = penci_get_theme_mod( 'penci_hide_pagecat_title' );
							$pcat_hide_desc  = penci_get_theme_mod( 'penci_hide_pagecat_desc' );
							$align_title     = penci_get_theme_mod( 'penci_archive_align_post_title' );
							$hide_breadcrumb = penci_get_theme_mod( 'penci_hide_archive_breadcrumb' );
							?>
							<?php if( ! $hide_breadcrumb ) : penci_breadcrumbs( $args = '' );  endif; ?>
							<?php if( ! $pcat_hide_title || ! $pcat_hide_desc ) : ?>
								<header class="entry-header penci-entry-header penci-archive-entry-header">
									<?php
									if( ! $pcat_hide_title ){
										the_archive_title( '<h1 class="page-title penci-page-title penci-title-' . $align_title . '">', '</h1>' );
									}
									if( ! $pcat_hide_desc ) {
										the_archive_description( '<div class="penci-taxonomy-description penci-title-' . $align_title . '">', '</div>' );
									}
									?>
								</header>
							<?php endif; ?>
							<?php penci_render_google_adsense( 'penci_archive_ad_above' ); ?>
							<div class="penci-archive__list_posts">
								<?php
								if ( have_posts() ) :

									$post_i = 1;
									while ( have_posts() ) : the_post();

										if ( in_array( $cat_layout_style, array( 'blog-standard', 'blog-classic', 'blog-overlay' ) ) ) {
											set_query_var( 'penci_acsb_layout_style', $cat_layout_style );
											get_template_part( 'template-parts/content', 'classis' );
										}else {
											get_template_part( 'template-parts/content', 'category' );
										}

										penci_get_markup_infeed_ad( array(
											'order_ad'   => penci_get_setting( 'penci_archive_infeedad_order' ),
											'order_post' => $post_i,
											'code'       => penci_get_theme_mod( 'penci_archive_infeedad_code' ),
											'echo'       => true
										) );

										$post_i ++;
									endwhile;
								else :
									get_template_part( 'template-parts/content', 'none' );
								endif;
								?>
							</div>
							<?php
							penci_posts_pagination();
							penci_render_google_adsense( 'penci_archive_ad_below' );
							?>
						</div>
						</div>
					</div>
					<?php get_sidebar( 'second' ); ?>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

