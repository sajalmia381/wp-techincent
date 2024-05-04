<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$atts_limit = 5;
if( 'style-1' ==  $atts['style'] || 'style-5' ==  $atts['style'] ) {
	$atts_limit = 4;
}elseif( 'style-3' ==  $atts['style'] ) {
	$atts_limit = 3;
}elseif( 'style-6' ==  $atts['style'] ) {
	$atts_limit = 2;
}
$atts['limit'] = $atts_limit;

if ( isset( $atts['build_query'] ) ) {
	$atts['build_query'] = PenciLoopSettings::updateArgsQuerySize( $atts['build_query'], $atts_limit );
}

$atts['shortcode_id'] = 'block_video';
$unique_id = 'penci_block_video__' . rand( 1000,100000 );
$block_content_id = $unique_id . 'block_content';

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ),$atts['style'] ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_block_video', $atts ) );
$args = Penci_Pre_Query::get_query_args( $atts );

$query_slider = Penci_Pre_Query::do_query( $atts );
if ( ! $query_slider->have_posts() ) {
	return;
}

$items = include dirname( __FILE__ ) . "/content-items.php";
$data_filter = Penci_Helper_Shortcode::get_data_filter( 'block_video',$atts );

?>

<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-block_video <?php echo esc_attr( $class ); ?>" data-current="1" data-blockUid="<?php echo esc_attr( $unique_id ); ?>" <?php echo $data_filter; ?>>
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		<?php Penci_Helper_Shortcode::get_slider_nav( $block_content_id, $atts, $query_slider ); ?>
	</div>
	<div id="<?php echo esc_attr( $block_content_id ); ?>" class="penci-block_content">
		<?php  echo $items; ?>
	</div>
</div>
<?php
$id_block_video = '#' . $unique_id;
$css_custom   = Penci_Helper_Shortcode::get_general_css_custom( $id_block_video, $atts );
$css_custom .= Penci_Helper_Shortcode::get_post_meta_css_custom( $id_block_video, $atts );
$css_custom .= Penci_Helper_Shortcode::get_ajax_loading_css_custom( $id_block_video, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_block_video, $atts );

$template_post_title  = '@media screen and (min-width: 768px ) {';
$template_post_title  .= $id_block_video . '.penci-block_video .block_video_first_item .penci__post-title, ';
$template_post_title .= $id_block_video . '.penci-block_video .penci__post-title,';
$template_post_title .= $id_block_video . '.penci-block_video .first-items .penci__post-title{ %s }}';

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_title',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template' =>  $template_post_title,
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_meta',
	'font-size'    => '12px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template' => $id_block_video .'.penci-block_video .penci_post-meta, ' . $id_block_video .'.penci-block_video .penci_post-meta a, ' . $id_block_video .'.penci-block_video .penci_post-meta span{ %s; }' ,
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}

Penci_Helper_Shortcode::get_block_script( $unique_id, $atts, $content );