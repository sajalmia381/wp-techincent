<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;
$queried_object = $wp_query->get_queried_object();
get_header(); ?>
	<div id="primary" class="content-area penci-archive">
		<main id="main" class="site-main">
			<div class="penci-container">
				<div class="penci-container__content">
					<div class="penci-wide-content penci-sticky-content">
						<div id="penci-archive__content" class="penci-archive__content ">
							<?php
							$image_thumb = Pennew_Portfolio_Helper::get_image_size();

							$hide_title      = get_theme_mod( 'penci_hide_archive_title' );
							$align_title     = get_theme_mod( 'penci_archive_align_post_title' );
							$align_title     = $align_title ? $align_title : 'center';
							$hide_breadcrumb = get_theme_mod( 'penci_hide_archive_breadcrumb' );
							$column          = get_theme_mod( 'penci_portfolio_column' ) ? get_theme_mod( 'penci_portfolio_column' ) : 3;
							$_effect         = get_theme_mod( 'penci_portfolio_item_style' ) ? get_theme_mod( 'penci_portfolio_item_style' ) : 'slidenfade-one';
							?>
							<?php if ( ! $hide_breadcrumb ) : penci_breadcrumbs( $args = '' ); endif; ?>
							<?php if ( is_home() && ! is_front_page() && ! $hide_title ) : ?>
								<header class="entry-header penci-entry-header penci-archive-entry-header">
									<h1 class="page-title penci-page-title penci-title-<?php echo esc_attr( $align_title ); ?>"><?php single_post_title(); ?></h1>
								</header>
							<?php elseif ( is_archive() && ! $hide_title ) : ?>
								<header class="entry-header penci-entry-header penci-archive-entry-header">
									<?php the_archive_title( '<h1 class="page-title penci-page-title penci-title-' . $align_title . '">', '</h1>' ); ?>
								</header>
							<?php endif; ?>
							<?php
							if ( have_posts() ) : ?>
								<?php
								$item_style = get_theme_mod( 'penci_portfolio_item_style' );
								$item_style = $item_style ? $item_style : 'text_overlay';
								$unique_id  = 'penci-portfolio' . '--' . rand( 1000, 100000 );

								$class = 'wrapper-penci-portfolio';
								$class .= ' penci-portfolio-' . $item_style;
								$class .= ' penci-portfolio-' . get_theme_mod( 'penci_portfolio_effect' );
								?>
								<div id="<?php echo $unique_id; ?>" class="<?php echo $class; ?>">
									<div class="penci-portfolio penci-portfolio-wrap column-<?php echo esc_attr( $column ); ?>">
										<?php
										$portfolio_i = 0;
										while ( have_posts() ): the_post();
											include PENCI_PORTFOLIO__DIR . "/template/content-portfolio.php";
											$portfolio_i ++;
										endwhile;
										?>
									</div>
									<?php
									$style_pag     = get_theme_mod( 'penci_portfolio_style_pag' );
									$numbermore    = get_theme_mod( 'penci_portfolio_numbermore' );
									$pag_pos       = get_theme_mod( 'penci_portfolio_pag_pos' );
									$layout        = get_theme_mod( 'penci_portfolio_layout' );
									$cat_showposts = get_theme_mod( 'penci_portfolio_cat_showposts' );
									$cat_showposts = $cat_showposts ? $cat_showposts : 12;
									$build_query   = 'size:' . $cat_showposts . '|post_type:portfolio|tax_query:' . $queried_object->term_id;

									$pag_atts = array(
										'style_pag'   => $style_pag ? $style_pag : 'load_more',
										'numbermore'  => $numbermore ? $numbermore : 6,
										'pag_pos'     => $pag_pos ? $pag_pos : 'center',
										'style'       => $layout ? $layout : 'masonry',
										'build_query' => $build_query,
									);


									$data_query    = PenciLoopSettings::parseData( $build_query );
									$query_builder = new PenciLoopQueryBuilder( $data_query );
									$query         = $query_builder->build_args();

									$category_query = array_merge( $query, array(
										'paged'              => 0,
										'posts_per_page'     => - 1,
										'portfolio_category' => '',
										'fields'             => 'ids'
									) );

									$all_items_count = count( get_posts( $category_query ) );

									$query_args = array(
										'post_status'    => 'publish',
										'posts_per_page' => $cat_showposts,
										'post_type'      => 'portfolio',
										'tax_query'      => array(
											array(
												'taxonomy' => 'portfolio-category',
												'field'    => 'term_id',
												'terms'    => array( $queried_object->term_id ),
											),
										),
									);

									Pennew_Portfolio_Helper::get_html_pagination( false, $pag_atts, $data_query );


									$portfolio_data_js = array(
										'atts'         => $pag_atts,
										'instanceId'   => $unique_id,
										'data_query'   => $data_query,
										'query'        => $query,
										'count'        => $all_items_count,
										'countByTerms' => array( $queried_object->slug => $all_items_count ),
										'currentTerm'  => $queried_object->slug,
										'currentTax'   => '',
									);

									?>
									<script type="text/javascript">
										portfolioDataJs.push( <?php echo json_encode( $portfolio_data_js ); ?> );
									</script>
								</div>

							<?php endif; ?>
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