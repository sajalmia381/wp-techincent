<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'pinterest_widget' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_facebook_page', $atts ) );

?>
	<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci_facebook_widget <?php echo esc_attr( $class ); ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
		<div class="penci-block_content">
			<?php
			$page_url   = $atts['page_url'];
			$height     = $atts['height'];
			$faces      = $atts['faces'];
			$stream     = $atts['stream'];
			$title_page = $atts['title_page'];

			wp_enqueue_script( 'penci-facebook-js', get_template_directory_uri() . '/js/facebook.js' , '', '4.1', true );

			?>
			<div class="fb-page" data-href="<?php echo esc_url( $page_url ); ?>"<?php if( !$stream && is_numeric( $height ) && $height > 69 ): ?> data-height="<?php echo absint( $height ); ?>"<?php endif;?> data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="<?php if( !$faces) { echo 'true'; } else { echo 'false'; } ?>" data-show-posts="<?php if( !$stream) { echo 'true'; } else { echo 'false'; } ?>"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo esc_attr( $page_url ); ?>"><a href="<?php echo esc_url( $page_url ); ?>"><?php if($title_page) { echo sanitize_text_field( $title_page ); } else { echo 'Facebook'; } ?></a></blockquote></div></div>
		</div>
	</div>
<?php

$id_block_1 = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_block_1, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_block_1, $atts );

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
