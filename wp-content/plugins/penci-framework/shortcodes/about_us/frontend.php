<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'text-block' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_about_us', $atts ) );
?>
	<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-text-block <?php echo esc_attr( $class ); ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
		<div class="penci-block_content">
			<?php
			$align    = isset( $atts['block_text_align'] ) ? $atts['block_text_align'] : '';
			$circle   = isset( $atts['circle'] ) ? $atts['circle'] : '';
			$lazyload = isset( $atts['lazyload'] ) ? $atts['lazyload'] : '';
			$imageurl = isset( $atts['imageurl'] ) ? $atts['imageurl'] : '';
			$target   = isset( $atts['target'] ) ? $atts['target'] : '';
			$heading  = $atts['heading'];
			$title    = $atts['title'];

			$img_id      = preg_replace( '/[^\d]/', '', $atts['about_image'] );
			$image_info       = Penci_Helper_Shortcode::get_url_image_by_size( array(
				'attach_id'  => $img_id,
				'thumb_size' => $atts['img_size'],
			) );


			$image = is_array( $image_info ) && isset( $image_info[0] ) ? $image_info[0] : $image_info;

			$circle_style = $open_image = $close_image = $target_html = '';

			if( $circle ):
				$circle_style = ' style="border-radius: 50%; -webkit-border-radius: 50%;"';
			endif;

			if( $imageurl ):
				if( $target ): $target_html = ' target="_blank"'; endif;
				$open_image = '<a href="'. $imageurl .'"'. $target_html .'>';
				$close_image = '</a>';
			endif;

			$disable_lazyload = penci_get_theme_mod( 'penci_disable_lazyload' );

			?>
			<div class="about-widget<?php if( $align ): echo ' ' . $align; endif; ?>">
				<?php if ( $image ) : ?>
					<?php echo $open_image; ?>
					<?php if( ! $lazyload && ! $disable_lazyload ) { ?>
						<img class="penci-widget-about-image holder-square penci-lazy" src="<?php echo get_template_directory_uri() . '/images/penci2-holder.png'; ?>" data-src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>"<?php echo $circle_style; ?>/>
					<?php } else { ?>
						<img class="penci-widget-about-image holder-square penci-disable-lazy" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>"<?php echo $circle_style; ?>/>
					<?php }?>
					<?php echo $close_image; ?>
				<?php endif; ?>

				<?php if ( $heading ) : ?>
					<h2 class="about-me-heading"><?php echo sanitize_text_field( $heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $content ) : ?>
					<?php echo wpb_js_remove_wpautop( $content, true ); ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
<?php

$id_aboutus = '#' . $unique_id;
$css_custom    = Penci_Helper_Shortcode::get_general_css_custom( $id_aboutus, $atts );
$css_custom    .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => $id_aboutus . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);

$css_custom    .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'aboutus_hedding',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_aboutus . '  .about-widget .about-me-heading{ %s }',
), $atts
);

if( $atts['aboutus_hedding_color'] ) {
	$css_custom .=  $id_aboutus . ' .about-widget .about-me-heading{ color: ' . $atts['aboutus_hedding_color'] . '; }';
}

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
