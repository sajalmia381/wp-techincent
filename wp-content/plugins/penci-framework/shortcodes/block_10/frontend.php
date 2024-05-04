<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'block_10' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_block_10', $atts ) );

$query_slider = Penci_Pre_Query::do_query( $atts );

if ( ! $query_slider->have_posts() ) {
	return;
}

$items = include dirname( __FILE__ ) . "/content-items.php";
$data_filter = Penci_Helper_Shortcode::get_data_filter( 'block_10',$atts, $content );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-block_10 <?php echo esc_attr( $class ); ?>" data-current="1" data-blockUid="<?php echo esc_attr( $unique_id ); ?>" <?php echo $data_filter; ?>>
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		<?php Penci_Helper_Shortcode::get_pull_down_filter( $atts, 'block_10', $block_content_id ); ?>
		<?php Penci_Helper_Shortcode::get_slider_nav( $block_content_id, $atts, $query_slider ); ?>
	</div>
	<div id="<?php echo esc_attr( $block_content_id ); ?>" class="penci-block_content">
		<?php  echo $items; ?>
	</div>
	<?php Penci_Helper_Shortcode::get_pagination( $atts, $query_slider ); ?>
</div>
<?php
$is_widget = Penci_Helper_Shortcode::check_blockvc_is_widget( $atts );

$id_block_10 = '#' . $unique_id;

$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_block_10, $atts );
$css_custom .= Penci_Helper_Shortcode::get_post_meta_css_custom( $id_block_10, $atts );
$css_custom .= Penci_Helper_Shortcode::get_ajax_loading_css_custom( $id_block_10, $atts );
$css_custom .= Penci_Helper_Shortcode::get_pagination_css_custom( $id_block_10, $atts );
$css_custom .= Penci_Helper_Shortcode::get_text_filter_css_custom( $id_block_10, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_pagination( $id_block_10, $atts );

if ( !empty( $atts['meta_bg'] ) ) : $css_custom .= sprintf( '%s .penci-posted-on{ background-color:%s; }', $id_block_10, $atts['meta_bg'] ); endif;
if ( ! empty( $atts['meta_color'] ) ) : $css_custom .= sprintf( '%s .penci-posted-on a{ color:%s; }', $id_block_10, $atts['meta_color'] ); endif;
if ( !empty( $atts['meta_hover_color'] ) ) : $css_custom .= sprintf( '%s .penci-posted-on a:hover{ color:%s; }', $id_block_10, $atts['meta_hover_color'] ); endif;
if ( !empty( $atts['border_post_title_color'] ) ) :
 $css_custom .= sprintf( '%s .penci-post-item,%s .penci-block__title' .
                         ',%s .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:first-child'.
                         '{ border-color:%s; }',
 	$id_block_10, $id_block_10, $id_block_10, $atts['border_post_title_color'] ); 
endif;

if ( !empty( $atts['border_post_title_color'] ) ) :
	$css_custom .= sprintf( '@media screen and (min-width: 480px){' .
	                        ',%s .penci-vc-column-2 .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2),'.
	                        ',%s .penci-vc-column-3 .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(1),'.
	                        ',%s .penci-vc-column-3 .penci-block_content__items:not(.penci-block-items__1) .penci-post-item:nth-child(2)'.
	                        '{ border-color:%s; } }',
		$id_block_10,$id_block_10,$id_block_10, $atts['border_post_title_color'] );
endif;


$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_block_10, $atts );


$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_meta',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto', $is_widget ),
	'template'     => $id_block_10 . ' .penci-posted-on{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_title',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani', $is_widget ),
	'template'     => $id_block_10 . ' .penci__post-title{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}

Penci_Helper_Shortcode::get_block_script( $unique_id, $atts, $content );

