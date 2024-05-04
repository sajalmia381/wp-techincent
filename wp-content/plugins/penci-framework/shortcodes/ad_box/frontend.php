<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if( ! $show_on_shortcode ) {
	return;
}

$css = $bordertop_color = $title_color = $title_hover_color = $background_title_color = $border_title_color = '';

extract( $atts );

$unique_id = 'penci-banner_box--' . rand( 1000, 100000 );
$class     = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );

$default_src = vc_asset_url( 'vc/no_image.png' );
$style       = $border_color = '';

$img_id = preg_replace( '/[^\d]/', '', $image );

$class_lazy = $data_src = '';
if( function_exists( 'penci_check_lazyload_type' ) ) {
	$class_lazy = penci_check_lazyload_type( 'class', null, false );
	$data_src = penci_check_lazyload_type( 'src', $default_src, false );
}

$img = Penci_Helper_Shortcode::getImageBySize( array(
	'attach_id'  => $img_id,
	'thumb_size' => $img_size,
	'class'      => 'penci-image-holder penci-banner-image ' . $class_lazy,
) );

if ( $img ) {
	$image_string = $img;
} else {
	$image_string = '<img class="penci-banner-image' . $class_lazy . '" src="' . $default_src . '" ' . $data_src . ' />';
}

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( $class ) ), 'penci_banner_box', $atts ) );
?>
	<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-banner-box penci-list-banner <?php echo esc_attr( $class ); ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
		<div class="penci-block_content">
			<div class="penci-promo-item penci-banner-has-text">
				<?php
				if ( ! empty( $atts['link'] ) ) {
					$target = ! empty( $atts['img_link_target'] ) ? ' target="' . esc_attr( $atts['img_link_target'] ) . '"' : '';
					$target .= isset( $atts['enable_nofollow'] ) && $atts['enable_nofollow'] ? ' rel="nofollow"' : '';
					echo '<a class="penci-promo-link" href="' . esc_attr( $atts['link'] ) . '"' . $target . '></a>';
				}
				echo $image_string;

				if ( $atts['banner_text'] ) :
					?>
					<div class="penci-promo-text">
						<h4><?php echo $atts['banner_text']; ?></h4>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php

$id_block_ad = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_block_ad, $atts );
$css_custom  .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_block_ad, $atts );

if ( ! $atts['show_banner_border'] ) {
	$css_custom .= sprintf( '%s .penci-promo-item.penci-banner-has-text:after{ content: none; }', $id_block_ad );
} elseif ( $atts['banner_border_color'] ) {
	$css_custom .= sprintf( '%s .penci-promo-item.penci-banner-has-text:after{ border-color:%s; }', $id_block_ad, $atts['banner_border_color'] );
}

if ( $atts['banner_text_bgcolor'] ) : $css_custom .= sprintf( '%s .penci-promo-text h4{ background-color:%s; }', $id_block_ad, $atts['banner_text_bgcolor'] ); endif;
if ( $atts['banner_text_color'] ) : $css_custom .= sprintf( '%s .penci-promo-text h4{ color:%s; }', $id_block_ad, $atts['banner_text_color'] ); endif;

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'banner_text',
	'font-size'    => '12px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_block_ad . ' .penci-promo-text h4{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
