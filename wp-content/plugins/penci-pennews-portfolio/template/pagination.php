<?php
if ( get_theme_mod( 'penci_portfolio_next_prev_project' ) ) {
	return;
}
$prev_post              = get_previous_post();
$next_post              = get_next_post();
$portfolio_archive_link = get_post_type_archive_link( 'portfolio' );

$custom_link_page = get_theme_mod( 'penci_pfl_custom_link_page' );
if( $custom_link_page ){
	$portfolio_archive_link = $custom_link_page;
}

?>
<?php if ( ! empty( $prev_post ) || ! empty( $next_post ) ) : ?>
	<div class="penci-pfl-pagination penci-post-pagination">
		<div class="penci-pfl-prev">
		<?php if ( ! empty( $prev_post ) ): ?>
			<a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>">
		<?php  else: ?>
			<a href="#" class="penci-noclick">
		<?php endif; ?>
				<span class="penci-pfl-prev-text">
					<h5 class="penci-pfl-prev-title working-only-pc"><?php echo penci_get_tran_setting( 'penci_pfl_prev_text' ); ?></h5>
					<h5 class="penci-pfl-prev-title working-only-mobile"><i class="fa fa-long-arrow-left"></i></h5>
				</span>
			</a>
		</div>
		<div class="penci-pfl-back-wap">
			<a class="penci-pfl-back" href="<?php echo esc_url( $portfolio_archive_link ); ?>">
				<span class="penci-square-1"></span>
				<span class="penci-square-2"></span>
			</a>
		</div>
		<div class="penci-pfl-next">
			<?php if ( ! empty( $next_post ) ): ?>
			<a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>" >
			<?php  else: ?>
			<a href="#" class="penci-noclick">
			<?php endif; ?>
				<span class="penci-pfl-next-text">
					<h5 class="penci-pfl-next-title working-only-pc"><?php echo penci_get_tran_setting( 'penci_pfl_next_text' ); ?></h5>
					<h5 class="penci-pfl-next-title working-only-mobile"><i class="fa fa-long-arrow-right"></i></h5>
				</span>
			</a>
		</div>
	</div>
<?php endif; ?>