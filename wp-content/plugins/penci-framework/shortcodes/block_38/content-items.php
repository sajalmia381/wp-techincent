<?php
$block38_i = 1;
ob_start();
$hide_thumb = ( isset( $atts['hide_thumb'] ) ? $atts['hide_thumb'] : '' );

while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$_design_style  = ( isset( $atts['_design_style'] ) ? $atts['_design_style'] : 'standard' );
	$archive_layout = 'blog-' . $_design_style;
	$post_class     = 'penci-post-' . $archive_layout;

	$class_article_content = $entry_text = '';

	?>
	<article <?php post_class( $post_class ); ?>>

		<div class="article_content">
			<?php if ( 'blog-classic' == $archive_layout ){ ?>
				<header class="entry-header">
					<?php
					if ( empty( $atts['hide_cat'] ) && function_exists( 'penci_get_categories' ) ) {
						penci_get_categories();
					}
					echo Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length']);

					if ( 'post' === get_post_type() ) : ?>
						<div class="entry-meta">
							<?php echo Penci_Helper_Shortcode::get_post_meta( array( 'author','date','comment','view' ), $atts ); ?>
						</div><!-- .entry-meta -->
						<?php
					endif; ?>
				</header>
			<?php } ?>
			<?php if ( has_post_thumbnail() && ! $hide_thumb ): ?>
				<?php if( 'blog-overlay' == $archive_layout ): ?>  <div class="penci-entry-media-header"> <?php  endif; ?>
				<div class="entry-media classic-post-image classic-post-hasimage">
					<a class="penci-link-post" href="<?php the_permalink(); ?>">
						<?php
						penci_icon_post_format( true, 'medium-size-icon' );
						if ( ! penci_get_setting( 'archive_hide_post_review' ) && function_exists( 'penci_display_piechart_review_html' ) ) {
							penci_display_piechart_review_html( get_the_ID(), 'normal' );
						}
						the_post_thumbnail( 'penci-thumb-1920-auto' );
						?>
					</a>
				</div>
				<?php if ( 'blog-overlay' == $archive_layout ): ?>
					<header class="entry-header">
						<?php
						if ( empty( $atts['hide_cat'] ) && function_exists( 'penci_get_categories' ) ) {
							penci_get_categories();
						}
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						if( function_exists( 'penci_get_schema_markup' ) ) {
							penci_get_schema_markup( true );
						}

						if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php echo Penci_Helper_Shortcode::get_post_meta( array( 'author','date','comment','view' ), $atts );; ?>
							</div><!-- .entry-meta -->
							<?php
						endif; ?>
					</header>
				<?php endif; ?>
				<?php if( 'blog-overlay' == $archive_layout ): ?>  </div> <?php  endif; ?>
			<?php elseif( 'blog-overlay' == $archive_layout ): ?>
					<header class="entry-header">
						<?php
						if ( empty( $atts['hide_cat'] ) && function_exists( 'penci_get_categories' ) ) {
							penci_get_categories();
						}
						echo Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length']);
						if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php echo Penci_Helper_Shortcode::get_post_meta( array( 'author','date','comment','view' ), $atts );; ?>
							</div><!-- .entry-meta -->
							<?php
						endif; ?>
					</header>
			<?php endif; ?>

			<div class="entry-text">
				<?php if ( 'blog-standard' == $archive_layout ){ ?>
					<header class="entry-header">
						<?php
						if ( empty( $atts['hide_cat'] ) && function_exists( 'penci_get_categories' ) ) {
							penci_get_categories();
						}
						echo Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length']);
						if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php echo Penci_Helper_Shortcode::get_post_meta( array( 'author','date','comment','view' ), $atts );; ?>
							</div><!-- .entry-meta -->
							<?php
						endif; ?>
					</header>
				<?php } ?>

				<?php
				$excrept = function_exists( 'penci_content_limit' ) ? penci_content_limit( $atts['post_excrept_length'], $more = '...', false ) : '';
				if ( $excrept && empty( $atts['hide_excrept'] ) ) {
					echo '<div class="entry-content">' . $excrept . '</div>';
				}

				if( $atts['show_readmore'] && function_exists( 'penci_more_link' ) ){
					echo penci_more_link();
				}
				?>
				<footer class="entry-footer">
					<?php penci_get_tags(); ?>
				</footer><!-- .entry-footer -->
			</div>
		</div>
	</article><!-- #post-## -->
	<?php

	$block38_i ++;
}

$output = ob_get_clean();
return Penci_Helper_Shortcode::pre_output_content_items( $output, $atts );
