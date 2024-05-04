<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$unique_id = 'penci-news_ticker--' . rand( 1000,100000 );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_news_ticker', $atts ) );

$query_slider = Penci_Pre_Query::do_query( $atts );
if ( ! $query_slider->have_posts() ) {
	return;
}
$count_news_ticker = $query_slider->post_count;
$items ='';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();
	$items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_standard_title_length'], false );
}
wp_reset_postdata();

// Data slider
$data = ' data-items="1"';
$data .= ' data-auto="' . ( empty( $atts['auto_play'] ) ? 1 : 0 ) . '"';
$data .= ' data-autotime="' . ( ! empty( $atts['auto_time'] ) ? $atts['auto_time'] : 4000 ) . '"';
$data .= ' data-speed="' . ( ! empty( $atts['speed'] ) ? $atts['speed'] : 400 ) . '"';
$data .= ' data-loop="' . ( ! empty( $atts['loop'] ) ? 1 : 0 ) . '"';
$data .= ' data-dots="0"';
$data .= ' data-nav="0"';
$data .= 'data-style="news_ticker"';
$data .= ' data-autowidth="0"';
$data .= ' data-vertical="1"';
?>

<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-news_ticker <?php echo esc_attr( $class ); ?>">
	<?php if ( ! empty( $atts['title'] ) ): ?>
		<h3 class="penci-news_ticker__title">
			<?php
			echo( ! empty( $atts['block_title_url'] ) ? '<a href=" ' . esc_url( $atts['block_title_url'] ) . ' " title="' . $atts['title'] . '">' : '<span>' );
			echo $atts['title'];
			echo ( !empty( $atts['icon_fontawesome'] ) ? '<i class="' . $atts['icon_fontawesome'] . '"></i>' : '' );
			echo( ! empty( $atts['block_title_url'] ) ? '</a >' : '</span>' );
			?>
		</h3>
	<?php endif; ?>
	<div class="penci-block_content">
		<?php if( empty( $atts['hide_nav'] ) ): ?>
		<span class="penci-slider-nav <?php echo( $count_news_ticker < 2 ? 'penci-pag-disabled' : '' ); ?>">
				<a class="penci-slider-prev" href="#"><i class="fa fa-angle-left"></i></a>
				<a class="penci-slider-next" href="#"><i class="fa fa-angle-right"></i></a>
			</span>
		<?php endif; ?>
		<div class="penci-owl-carousel-slider  penci-owl-carousel-style" <?php echo $data; ?>>
			<?php echo $items; ?>
		</div>
	</div>
</div>
<?php
$id = '#' . $unique_id;
$bg_color       		 = $atts['bg_title_color'];
$text_title_color       = $atts['title_color'];
$post_title_color       = $atts['post_title_color'];
$post_title_hover_color = $atts['post_title_hover_color'];

$css_custom  = '';
if ( $bg_color ) : $css_custom .= sprintf( '%s .penci-news_ticker__title{ background-color:%s; }', $id, $bg_color ); endif;
if ( $text_title_color ) : $css_custom .= sprintf( '%s .penci-news_ticker__title{ color:%s; }', $id, $text_title_color ); endif;
if ( $post_title_color ) : $css_custom .= sprintf( '%s .penci__post-title a{ color:%s; }', $id, $post_title_color ); endif;
if ( $post_title_hover_color ) : $css_custom .= sprintf( '%s .penci__post-title a:hover{ color:%s; }', $id, $post_title_hover_color ); endif;

if( $atts['speed'] ) {
	$css_custom .= sprintf( '.penci-news_ticker .penci-owl-carousel-slider .animated { animation-duration: %sms; }', intval( $atts['speed'] ) );
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'post_title',
		'font-size'    => '18px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
		'template' => $id .' .penci__post-title{ %s }' ,
	), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'block_title',
		'font-size'    => '14px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template' => $id .' .penci-news_ticker__title{ %s }' ,
	), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
