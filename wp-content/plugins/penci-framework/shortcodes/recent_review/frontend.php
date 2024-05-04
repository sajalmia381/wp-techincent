<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'recent_review' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_recent_review', $atts );

$args_comments = array(
	'number'      => $atts['number'] ? $atts['number'] : 5,
	'status'      => 'approve',
	'post_status' => 'publish',
	'type' => 'penci_review',
);

if( 'tops_core' == $atts['review_orderby'] ){
	$args_comments['meta_key']  = 'review_score';
	$args_comments['orderby'] = 'meta_value_num';
}elseif( 'worst_score' == $atts['review_orderby'] ){
	$args_comments['meta_key']  = 'review_score';
	$args_comments['orderby'] = 'meta_value_num';
	$args_comments['order'] = 'ASC';
}elseif( 'most_helpful' == $atts['review_orderby'] ){
	$args_comments['meta_key']  = 'review_like';
	$args_comments['orderby'] = 'meta_value_num';
}

$comments = get_comments($args_comments );
if ( ! $comments ) {
	return;
}

$items = include dirname( __FILE__ ) . "/content-items.php";
$data_filter = Penci_Helper_Shortcode::get_data_filter( 'recent_review',$atts, $content );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-recent_review penci__general-meta <?php echo esc_attr( $class ); ?>" data-current="1"  data-blockUid="<?php echo esc_attr( $unique_id ); ?>" <?php echo $data_filter; ?>>
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<div id="<?php echo esc_attr( $block_content_id ); ?>" class="penci-block_content">
		<?php  echo $items; ?>
	</div>
</div>
<?php
$id_recent_reivew = '#' . $unique_id;

$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_recent_reivew, $atts );
if( $atts['author_color']  ){
	$css_custom .= $id_recent_reivew.  ' .penci-recent-rv-author h5 {color:' . esc_attr( $atts['author_color'] ) . '}';
}

if( $atts['date_color']  ){
	$css_custom .= $id_recent_reivew.  '.penci__general-meta .penci_post-meta {color:' . esc_attr( $atts['date_color'] ) . '}';
}

if( $atts['rvtitle_color']  ){
	$css_custom .= $id_recent_reivew.  ' .penci-recent-rv-title a{color:' . esc_attr( $atts['rvtitle_color'] ) . '}';
}
if( $atts['rvtitle_hcolor']  ){
	$css_custom .= $id_recent_reivew.  ' .penci-recent-rv-title a:hover {color:' . esc_attr( $atts['rvtitle_hcolor'] ) . '}';
}

if( $atts['excrept_color']  ){
	$css_custom .= $id_recent_reivew.  ' .penci-recent-rv-excrept{color:' . esc_attr( $atts['excrept_color'] ) . '}';
}
if( $atts['item_border_bottom_color']  ){
	$css_custom .= $id_recent_reivew.  ' .penci-recent-rv{border-color:' . esc_attr( $atts['item_border_bottom_color'] ) . '}';
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template' => $id_recent_reivew . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'review_author',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template' => $id_recent_reivew .' .penci-recent-rv-author h5{ %s }' ,
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'review_date',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template' => $id_recent_reivew .'.penci__general-meta .penci_post-meta{ %s }' ,
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'review_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template' => $id_recent_reivew .' penci-recent-rv-title{ %s }' ,
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'review_excrept',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template' => $id_recent_reivew .' .penci-recent-rv-excrept{ %s }' ,
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
