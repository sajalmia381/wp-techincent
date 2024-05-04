<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$unique_id = 'penci-popular-cat--' . rand( 1000, 100000 );
$class     = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );

$c          = ! empty( $atts['count'] ) ? '1' : '0';
$h          = ! empty( $atts['hierarchical'] ) ? '1' : '0';
$limit      = ! empty( $atts['limit'] ) ? $atts['limit'] : 6;
$exclude    = ! empty( $atts['hide_uncat'] ) ? '1' : '';
$hide_empty = empty( $atts['count'] ) ? false : true;

$cat_args = array(
	'show_count'   => $c,
	'hierarchical' => $h,
	'hide_empty'   => $hide_empty,
	'number'       => $limit,
	'title_li'     => '',
	'exclude'      => $exclude
);

if ( 'default' == $atts['cat_type'] ) {
	$cat_args['orderby'] = 'count';
	$cat_args['order']   = 'DESC';
}
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_popular_category', $atts ) );

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-popular-cat  widget penci-block-vc widget_categories <?php echo esc_attr( trim( $class ) ); ?>">
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<ul>
		<?php
		wp_list_categories( $cat_args );
		?>
	</ul>
</div>
<?php
$is_widget = Penci_Helper_Shortcode::check_blockvc_is_widget( $atts );
$id_pp_cats = '#' . $unique_id;
$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_pp_cats, $atts );
if ( $atts['link_color'] ) : $css_custom .= sprintf( '%s.widget_categories li,%s.widget_categories li a{ color:%s; }', $id_pp_cats,$id_pp_cats, $atts['link_color'] ); endif;
if ( $atts['link_hover_color'] ) : $css_custom .= sprintf( '%s.widget_categories li a:hover{ color:%s; }', $id_pp_cats, $atts['link_hover_color'] ); endif;
if ( $atts['post_counts'] ) : $css_custom .= sprintf( '%s.widget_categories li .category-item-count{ color:%s; }', $id_pp_cats, $atts['post_counts'] ); endif;


$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald', $is_widget ),
	'template'     => $id_pp_cats . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'link_cat',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto', $is_widget ),
	'template'     => $id_pp_cats . '.widget_categories li,' . $id_pp_cats . '.widget_categories li a{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
