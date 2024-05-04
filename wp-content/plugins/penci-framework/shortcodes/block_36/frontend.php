<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'block_36' );

$column_number = Penci_Global_Blocks::get_col_number();

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_block_36', $atts ) );

$query_slider = Penci_Pre_Query::do_query( $atts );

if ( ! $query_slider->have_posts() ) {
	return;
}

$items = include dirname( __FILE__ ) . "/content-items.php";
$data_filter = Penci_Helper_Shortcode::get_data_filter( 'block_36',$atts, $content );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-block_36 penci__general-meta <?php echo esc_attr( $class ); ?>" data-current="1" data-blockUid="<?php echo esc_attr( $unique_id ); ?>" <?php echo $data_filter; ?>>
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		<?php Penci_Helper_Shortcode::get_pull_down_filter( $atts, 'block_36', $block_content_id ); ?>
		<?php Penci_Helper_Shortcode::get_slider_nav( $block_content_id, $atts, $query_slider ); ?>
	</div>
	<div id="<?php echo esc_attr( $block_content_id ); ?>" class="penci-block_content">
		<?php  echo $items; ?>
	</div>
	<?php Penci_Helper_Shortcode::get_pagination( $atts, $query_slider ); ?>
</div>
<?php
$id_block_36 = '#' . $unique_id;
$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_block_36, $atts );
$css_custom .= Penci_Helper_Shortcode::get_post_meta_css_custom( $id_block_36, $atts );
$css_custom .= Penci_Helper_Shortcode::get_load_more_css_custom( $id_block_36, $atts );
$css_custom .= Penci_Helper_Shortcode::get_ajax_loading_css_custom( $id_block_36, $atts );
$css_custom .= Penci_Helper_Shortcode::get_text_filter_css_custom( $id_block_36, $atts );
$css_custom .= Penci_Helper_Shortcode::get_pagination_css_custom( $id_block_36, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_pagination( $id_block_36, $atts );

if ( !empty( $atts['border_post_title_color'] ) ) :
	$css_custom .= sprintf( '%s .penci-post-item,%s .penci-block__title{ border-color:%s; }',
		$id_block_36,$id_block_36, $atts['border_post_title_color'] );
endif;

if ( !empty( $atts['border_post_title_color'] ) && '2' == $column_number ) :
	$css_custom .= sprintf( '%s.penci-vc-column-2.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			%s.penci-vc-column-2.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			%s.penci-vc-column-2.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			%s.penci-vc-column-2.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),{ border-color:%s; }',
		$id_block_36,$id_block_36,$id_block_36,$id_block_36, $atts['border_post_title_color'] );
endif;

if ( !empty( $atts['border_post_title_color'] ) && '3' == $column_number ) :
	$css_custom .= sprintf( '%s.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			%s.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			%s.penci-vc-column-3.penci-block-load_more .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),
			%s.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(3),
			%s.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),
			%s.penci-vc-column-3.penci-block-infinite .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),{ border-color:%s; }',
		$id_block_36,$id_block_36,$id_block_36,$id_block_36,$id_block_36,$id_block_36, $atts['border_post_title_color'] );
endif;

if ( !empty( $atts['review_color'] ) ) {
	$css_custom .= sprintf( '%s .penci-chart-text{ color:%s; }', $id_block_36, $atts['review_color'] );
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_block_36, $atts );

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_title',
	'font-size'    => '14px',
	'media'        => '650',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_block_36 . ' .penci__post-title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_meta',
	'font-size'    => '12px',
	'media'        => '650',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_block_36 . '.penci__general-meta .penci_post-meta{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}

Penci_Helper_Shortcode::get_block_script( $unique_id, $atts, $content );

