<?php
/**
 * Content in mega menu
 *
 * @since 1.0
 * @return HTML inner mega menu
 */

function penci_return_html_mega_menu( $row, $width,$dis_ajax_filter, $list_cats, $sub_cat ) {

	if( isset( $list_cat['sub_cat'] ) ) {
		unset($list_cat['sub_cat']);
	}
	/* Check rows to show number posts */
	if ( ! isset ( $row ) || empty( $row ) ): $row = '1'; endif;

	$col             = 'col-mn-6 mega-row-1';
	$numbers         = 6;
	$count_list_cats = count( (array)$list_cats );

	$arr_has_mega    = penci_mega_get_tax_support();

	if ( 'fullwidth' == $width ) {
		$col     = 'col-mn-8 mega-row-1';
		$numbers = 8;
	}

	if ( 'width1080' == $width || 'width1170' == $width ) {
		$col     = 'col-mn-5 mega-row-1';
		$numbers = 5;
	}

	if ( ! empty( $list_cats ) && 1 == $sub_cat ) {

		if ( 'fullwidth' == $width ) {
			$col     = 'col-mn-7 mega-row-1';
			$numbers = 7;
		} elseif( 'container' == $width ) {
			$col     = 'col-mn-5 mega-row-1';
			$numbers = 5;
		}elseif ( 'width1080' == $width || 'width1170' == $width ) {
			$col     = 'col-mn-4 mega-row-1';
			$numbers = 4;
		}else {
			$col     = 'col-mn-3 mega-row-1';
			$numbers = 3;
		}
	}

	if ( '2' == $row ) {
		$col     = 'col-mn-6 mega-row-2';
		$numbers = 12;

		if ( 'fullwidth' == $width ) {
			$col     = 'col-mn-8 mega-row-2';
			$numbers = 16;
		}

		if ( 'width1080' == $width || 'width1170' == $width ) {
			$col     = 'col-mn-5 mega-row-2';
			$numbers = 10;
		}

		if ( ! empty( $list_cats ) && 1 == $sub_cat ) {
			if ( 'fullwidth' == $width ) {
				$col     = 'col-mn-7 mega-row-2';
				$numbers = 14;
			} elseif( 'container' == $width ) {
				$col     = 'col-mn-5 mega-row-2';
				$numbers = 10;
			}elseif ( 'width1080' == $width || 'width1170' == $width ) {
				$col     = 'col-mn-4 mega-row-2';
				$numbers = 8;
			}else {
				$col     = 'col-mn-3 mega-row-2';
				$numbers = 6;
			}
		}
	}
	ob_start();
	?>
	<?php if ( ! empty( $list_cats ) && 1 == $sub_cat ): ?>
		<?php
		$class_child_cat = $col;
		$class_child_cat .= penci_get_theme_mod( 'penci_mega_child_cat_style' ) ? ' penci-child_cat-' . penci_get_theme_mod( 'penci_mega_child_cat_style' ) : ' penci-child_cat-style-1';
		?>
		<div class="penci-mega-child-categories <?php echo esc_attr( $class_child_cat ); ?>">
			<?php $i = 1;
			foreach ( $list_cats as $list_cat ): ?>
				<?php
				$cat_id = isset( $list_cat['object_id'] ) ? $list_cat['object_id'] : '';
				$title  = isset( $list_cat['title'] ) ? $list_cat['title'] : '';
				$tax    = isset( $list_cat['object'] ) ? $list_cat['object'] : '';

				if ( empty( $cat_id ) || ! in_array( $tax, $arr_has_mega ) ) {
					continue;
				}

				printf( '<a class="mega-cat-child %s" data-id="penci-mega-%s" href="%s"><span>%s</span></a>',
					( $i == 1 ) ? ' cat-active mega-cat-child-loaded' : '',
					esc_attr( $cat_id ),
					esc_url( get_category_link( $cat_id ) ),
					sanitize_text_field( $title )
				);
				?>
				<?php $i ++; endforeach; ?>
		</div>
	<?php endif; ?>
	<?php $content_megamenu_style = penci_get_theme_mod( 'penci_mega_child_cat_style' ) ? ' penci-content-megamenu-' . penci_get_theme_mod( 'penci_mega_child_cat_style' ) : ' penci-content-megamenu-style-1';  ?>
	<div class="penci-content-megamenu<?php echo esc_attr( $content_megamenu_style ); ?>">
		<div class="penci-mega-latest-posts <?php echo esc_attr( $col ); ?> <?php if ( 1 == $sub_cat ): echo 'penci-post-border-bottom'; endif; ?>">
			<?php $j = 1;
			foreach ( $list_cats as $list_cat ): ?>
				<?php
				$cat_id = isset( $list_cat['object_id'] ) ? intval( $list_cat['object_id'] ) : '';
				$tax    = isset( $list_cat['object'] ) ? $list_cat['object'] : '';

				if ( empty( $cat_id ) || empty( $tax ) || ! in_array( $tax, $arr_has_mega ) ) {
					continue;
				}

				$post_type = 'post';
				if ( 'product_cat' == $tax || 'product_tag' == $tax ) {
					$post_type = 'product';
				}elseif( 'portfolio-category' == $tax ){
					$post_type = 'portfolio';
				}elseif ( ! in_array( $tax, array( 'category', 'post_tag' ) ) ) {
					$post_type = array();
					foreach ( get_post_types( array( 'public' => true ) ) as $posttype ) {
						if( ! in_array( $posttype, array( 'attachment', 'penci_slider' ) ) ) {
							$post_type[] = $posttype;
						}
					}
				}

				$unique_id        = 'penci_megamenu__' . rand( 1000, 100000 );
				$block_content_id = $unique_id . 'block_content';

				$atts_data_filter = array(
					'showposts'    => $numbers,
					'style_pag'    => 'next_prev',
					'post_types'   => $post_type,
					'block_id'     => $unique_id,
					'paged'        => 1,
					'unique_id'    => $unique_id,
					'shortcode_id' => 'megamenu',
					'cat_id'       => $cat_id,
					'tax'          => $tax
				);

				$data_filter = Penci_Helper_Shortcode::get_data_filter( 'megamenu', $atts_data_filter );

				?>
				<div class="penci-mega-row penci-mega-<?php echo esc_attr( $cat_id ); ?><?php if ( $j == 1 ): echo ' row-active'; endif; ?>" data-current="1" data-blockUid="<?php echo esc_attr( $unique_id ); ?>" <?php echo $data_filter; ?>>
					<div id="<?php echo esc_attr( $block_content_id ); ?>" class="penci-block_content penci-mega-row_content">
						<?php
						$content_ajax = '';

						$attr = array(
							'post_type'           => $post_type,
							'posts_per_page'      => $numbers,
							'ignore_sticky_posts' => 1,
							'post_status'         => 'publish',
							'update_meta_cache' => true,
							'tax_query'           => array(
								array(
									'taxonomy' => $tax,
									'field'    => 'id',
									'terms'    => $cat_id,
								),
							),
						);
						$post_mega_numbers = $numbers;
						$attr = apply_filters( 'penci_args_support_polylang', $attr );
						$latest_mega = $result_query = new WP_Query( $attr );
						$total_pages = isset( $latest_mega->max_num_pages ) ? $latest_mega->max_num_pages : 1;

						ob_start();
						include( PENCI_ADDONS_DIR . "mega-menu/list-posts.php" );
						$content_items = ob_get_clean();

						if( $j == 1 ) {
							echo $content_items;
						}else {
							$content_ajax = $content_items;

							if( $total_pages < 2 ) {
								$atts_data_filter['megahidePagNext'] = 1;
							}
						}
						?>
					</div>
					<?php Penci_Helper_Shortcode::get_block_script( $unique_id, $atts_data_filter, $content_ajax ); ?>

					<?php if( 'on' != $dis_ajax_filter && ( $j != 1 || ( $j == 1 && $total_pages > 1 ) ) ): ?>

					<span class="penci-slider-nav">
						<a class="penci-mega-pag penci-slider-prev penci-pag-disabled" data-block_id="<?php echo esc_attr( $block_content_id ); ?>" href="#"><i class="fa fa-angle-left"></i></a>
						<a class="penci-mega-pag penci-slider-next <?php echo( $total_pages < 2 ? 'penci-pag-disabled' : '' ); ?>" data-block_id="<?php echo esc_attr( $block_content_id ); ?>" href="#"><i class="fa fa-angle-right"></i></a>
					</span>
					<?php endif; ?>
				</div>
				<?php $j ++; endforeach; ?>
				<?php echo apply_filters( 'penci_after_block_items', '', '' ); ?>
		</div>
	</div>

	<?php
	$return = ob_get_clean();

	return $return;
}


