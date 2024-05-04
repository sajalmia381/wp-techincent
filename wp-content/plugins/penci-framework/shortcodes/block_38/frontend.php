<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'block_38' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class[] = $atts['_design_align'] ? 'penci-design_align-' . esc_attr( $atts['_design_align'] ) : '';
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_block_38', $atts ) );

$query_slider = Penci_Pre_Query::do_query( $atts );

if ( ! $query_slider->have_posts() ) {
	return;
}

$items = include dirname( __FILE__ ) . "/content-items.php";
$data_filter = Penci_Helper_Shortcode::get_data_filter( 'block_38',$atts, $content );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-block_38 <?php echo esc_attr( $class ); ?>" data-current="1"  data-blockUid="<?php echo esc_attr( $unique_id ); ?>" <?php echo $data_filter; ?>>
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		<?php Penci_Helper_Shortcode::get_pull_down_filter( $atts, 'block_38', $block_content_id ); ?>
		<?php Penci_Helper_Shortcode::get_slider_nav( $block_content_id, $atts, $query_slider ); ?>
	</div>
	<div id="<?php echo esc_attr( $block_content_id ); ?>" class="penci-block_content">
		<?php  echo $items; ?>
	</div>
	<?php Penci_Helper_Shortcode::get_pagination( $atts, $query_slider ); ?>
	<?php

$id_block_38 = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_block_38, $atts );

$css_custom .= Penci_Helper_Shortcode::get_ajax_loading_css_custom( $id_block_38, $atts );
$css_custom .= Penci_Helper_Shortcode::get_text_filter_css_custom( $id_block_38, $atts );
$css_custom .= Penci_Helper_Shortcode::get_pagination_css_custom( $id_block_38, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_block_38, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_pagination( $id_block_38, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_readmore( $id_block_38, $atts );

if ( $atts['cat_color'] ) : $css_custom .= sprintf( '%s .penci-cat-links a{ color:%s; }', $id_block_38, $atts['cat_color'] ); endif;
if ( $atts['cat_bg_color'] ) : $css_custom .= sprintf( '%s .penci-cat-links a{ background-color:%s; }', $id_block_38, $atts['cat_bg_color'] ); endif;
if ( $atts['cat_hover_color'] ) : $css_custom .= sprintf( '%s .penci-cat-links a:hover{ color:%s; }', $id_block_38, $atts['cat_hover_color'] ); endif;
if ( $atts['cat_bghover_color'] ) : $css_custom .= sprintf( '%s .penci-cat-links a:hover{ background-color:%s; }', $id_block_38, $atts['cat_bghover_color'] ); endif;


if ( $atts['post_title_color'] ) : $css_custom .= sprintf( '%s .entry-title a{ color:%s !important; }', $id_block_38, $atts['post_title_color'] ); endif;
if ( $atts['post_title_hover_color'] ) : $css_custom .= sprintf( '%s .entry-title a:hover{ color:%s !important; }', $id_block_38, $atts['post_title_hover_color'] ); endif;

if ( $atts['meta_color'] ) : $css_custom .= sprintf( '%s .entry-meta{ color:%s; }', $id_block_38, $atts['meta_color'] ); endif;
if ( $atts['meta_hover_color'] ) : $css_custom .= sprintf( '%s .entry-meta a:hover{ color:%s !important; }', $id_block_38, $atts['meta_hover_color'] ); endif;

if ( $atts['excrept_color'] ) {
	$css_custom .= sprintf( '%s .entry-content{ color:%s; }', $id_block_38, $atts['excrept_color'] );
}


if( 'left' == $atts['_design_align'] ) {
	$css_custom .= $id_block_38. '.penci-design_align-left,';
	$css_custom .= $id_block_38. '.penci-design_align-left .entry-header,';
	$css_custom .= $id_block_38. '.penci-design_align-left .entry-title,';
	$css_custom .= $id_block_38. '.penci-design_align-left .entry-content';
	$css_custom .='{ text-align:left; }';
}elseif( 'right' == $atts['_design_align'] ) {
	$css_custom .= $id_block_38. '.penci-design_align-right,';
	$css_custom .= $id_block_38. '.penci-design_align-right .entry-header,';
	$css_custom .= $id_block_38. '.penci-design_align-right .entry-title,';
	$css_custom .= $id_block_38. '.penci-design_align-right .entry-content';
	$css_custom .='{ text-align:right; }';
}elseif( 'center' == $atts['_design_align'] ) {
	$css_custom .= $id_block_38. '.penci-design_align-right,';
	$css_custom .= $id_block_38. '.penci-design_align-right .entry-header,';
	$css_custom .= $id_block_38. '.penci-design_align-right .entry-title,';
	$css_custom .= $id_block_38. '.penci-design_align-right .entry-content';
	$css_custom .='{ text-align: center; }';
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'post_title',
		'font-size'    => '20px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani600' ),
		'template' => $id_block_38 .' .entry-title a{ %s }' ,
	), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'post_meta',
		'font-size'    => '12px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template' => $id_block_38 .' .entry-meta, ' . $id_block_38 .' .entry-meta a, ' . $id_block_38 .' .entry-meta span{ %s }' ,
	), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_excrept',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_block_38 . ' .block1_first_item .penci-post-excerpt{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}

Penci_Helper_Shortcode::get_block_script( $unique_id, $atts, $content );
?>
</div>


