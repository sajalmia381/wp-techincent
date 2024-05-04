<?php

$source = $images = $custom_srcs = $img_size = $external_img_size = $css = $class = $gal_images  = '';
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}
$unique_id = 'penci-gallery--' . rand( 1000,100000 );
extract( $atts );

$gal_style = ! empty( $atts['style_gallery'] ) ? $atts['style_gallery'] : 'style-1';

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ), $gal_style ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_image_gallery', $atts ) );

if( empty( $images ) ) {
	return;
}

$images = explode( ',', $images );

$gal_images = include dirname( __FILE__ ) . "/content/{$gal_style}.php";

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci_gallery <?php echo esc_attr( $class ); ?>">
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<div class="penci-block_content">
		<?php echo $gal_images; ?>
	</div>
</div>
<?php

$id_gallery = '#' . $unique_id;
$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_gallery, $atts );

if ( $atts['post_title_color'] ) : $css_custom .= sprintf( '%s.style-1 .penci-gal-item .penci__gallery-caption span, %s.style-2 .penci-gal-item .penci__gallery-caption span, %s.style-3 .penci-gal-item .penci__gallery-caption span{ color:%s !important; }', $id_gallery,$id_gallery,$id_gallery, $atts['post_title_color']
); endif;

if ( 'style-1' == $gal_style && $atts['speed'] && '600' != $atts['speed'] ) {
	$slider_title = ( $atts['speed'] - 100 ) / 1000;
	$css_custom   .= sprintf( '%s.penci_gallery.style-1 .penci-big_items h3{ animation-duration:%ss;  -webkit-animation-delay: %ss; }', $id_gallery, $slider_title, $slider_title );
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => $id_gallery . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_title',
	'font-size'    => '20px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_gallery . '.style-1 .penci-gal-item .penci__gallery-caption,' . $id_gallery . '.style-2 .penci-gal-item .penci__gallery-caption, ' . $id_gallery . '.style-3 .penci-gal-item .penci__gallery-caption{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
