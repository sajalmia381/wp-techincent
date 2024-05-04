<?php
$prefix = 'penci_';
$portfolio_id = get_the_ID();
$portfolio_desc = get_post_meta( $portfolio_id, $prefix . 'pfl_desc', true );
$portfolio_info = get_post_meta( $portfolio_id, $prefix . 'pfl_info', true );


if ( $portfolio_desc || $portfolio_info ):
	$properties_block = get_theme_mod( 'penci_pfl_properties_block' );

	?>
	<div class="penci-plf-single-info<?php echo ( $properties_block ?  ' pfl_properties_block' : '' ); ?>">
		<div class="penci-plf-info-inner">
			<?php if( $portfolio_desc ){ ?>
			<div class="penci-plf-desc">
				<div class="penci-col-inner">
					<div class="penci-entry-content entry-content">
					<?php
					$portfolio_desc = wpautop( preg_replace( '/<\/?p\>/', "\n", $portfolio_desc ) . "\n" );
					echo do_shortcode( shortcode_unautop( $portfolio_desc ) )
					?>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php if( $portfolio_info ){ ?>
			<div class="penci-plf-info">
				<div class="penci-pfl-info-inner penci-col-inner">
				<?php
				foreach( (array)$portfolio_info as $portfolio_info_item  ) {
					$label = isset( $portfolio_info_item['label'] ) ? $portfolio_info_item['label'] : '';
					$value = isset( $portfolio_info_item['value'] ) ? $portfolio_info_item['value'] : '';

					if( $label && $value ) {
						echo '<div class="penci-pfl-info-item">';
						echo'<span class="penci-pfl-info-label">' . do_shortcode( $label ) . '</span>';
						echo'<span class="penci-pfl-info-value">' . do_shortcode( $value ) . '</span>';
						echo'</div>';
					}
				}

				if ( ! get_theme_mod( 'penci_hide_portfolio_socail_share' ) ) {
					include PENCI_PORTFOLIO__DIR . "/template/social-share.php";
				}
				?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
<?php endif; ?>