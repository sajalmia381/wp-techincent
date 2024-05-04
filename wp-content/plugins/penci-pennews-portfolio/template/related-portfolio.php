<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( get_theme_mod( 'penci_portfolio_related_project' ) ) {
	return;
}

$categories = wp_get_object_terms( $post->ID, 'portfolio-category', array( 'fields' => 'ids' ) );

$numbers_related = get_theme_mod( 'penci_portfolio_related_amount' );
$number_cols     = get_theme_mod( 'penci_portfolio_related_col' );

$args = array();

if ( $categories ) {
	$args = array(
		'post_type'           => 'portfolio',
		'post__not_in'        => array( get_the_ID() ),
		'posts_per_page'      => $numbers_related ? $numbers_related : 3,
		'ignore_sticky_posts' => 1,
		'tax_query'           => array(
			array(
				'taxonomy' => 'portfolio-category',
				'field'    => 'term_id',
				'terms'    => $categories
			),
		)
	);
}

$portfolio_query = new WP_Query( $args );
if ( ! $portfolio_query->have_posts() ) {
	return;
}

if( function_exists( 'penci_get_tran_setting' ) ) {
	$related_text =  penci_get_tran_setting('penci_portfolio_related_text');
}else {
	$related_text = esc_html__( 'Related Projects', 'pennews' );
}

?>
<div class="penci-post-related penci-pfl-related">
	<div class="post-title-box"><h4 class="post-box-title"><?php echo $related_text; ?></h4></div>
	<div class="post-related_content wrapper-penci-portfolio penci-portfolio-below_img">
		<div class="penci-portfolio penci-portfolio-wrap column-<?php echo ( $number_cols ? $number_cols : 3 ); ?>">
			<?php
				$image_thumb = 'penci-thumb-480-320';
				$style = 'grid';
				if( class_exists( 'Penci_Helper_Shortcode' ) ) {
					//$image_thumb = Penci_Helper_Shortcode::get_image_size_by_type( $image_thumb, $image_type );
				}

				$portfolio_i = 0;
				while ( $portfolio_query->have_posts() ):
					$portfolio_query->the_post();
					include PENCI_PORTFOLIO__DIR . "/template/content-portfolio.php";

					$portfolio_i ++;
				endwhile;
				wp_reset_postdata();
			?>
		</div>
	</div>
</div>
