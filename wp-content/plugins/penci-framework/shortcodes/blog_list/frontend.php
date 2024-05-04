<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'blog_list' );

$column_number = Penci_Global_Blocks::get_col_number();

$class = Penci_Framework_Helper::get_class_block( array(
	'penci-text-' . $atts['text_align'],
	$this->getCSSAnimation( $atts['css_animation'] )
	), $atts );

if( $atts['_column'] ){
	$class['penci-vc-column'] = 'penci-vc-column-' . $atts['_column'];
}

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_blog_list', $atts ) );

$query_slider = Penci_Pre_Query::do_query( $atts );

if ( ! $query_slider->have_posts() ) {
	return;
}

$items = include dirname( __FILE__ ) . "/content-items.php";
$data_filter = Penci_Helper_Shortcode::get_data_filter( 'blog_list',$atts, $content );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-blog_list penci__general-meta <?php echo esc_attr( $class ); ?>" data-current="1" data-blockUid="<?php echo esc_attr( $unique_id ); ?>" <?php echo $data_filter; ?>>
	<h2 class="penci-block-title"><?php echo do_shortcode( $atts['block_title'] ); ?></h2>
	<div id="<?php echo esc_attr( $block_content_id ); ?>" class="penci-block_content">
		<?php  echo $items; ?>
	</div>
	<?php Penci_Helper_Shortcode::get_pagination( $atts, $query_slider ); ?>
</div>
<?php
$id_blog_list = '#' . $unique_id;
$css_custom = '';

if ( $atts['post_border_color'] ) {
	$css_custom .= $id_blog_list . '  .penci-post-item:after { 
	background: ' . esc_attr( $atts['post_border_color'] ) . ';
	background: -webkit-gradient(linear, 0 0, 100% 0, from(transparent), to(transparent), color-stop(50%, ' . esc_attr( $atts['post_border_color'] ) . ')); }';
}

if ( $atts['block_title_color'] ) {
	$css_custom .= $id_blog_list . ' .penci-block-title{ color : ' . esc_attr( $atts['block_title_color'] ) . '; }';
}

if ( $atts['post_title_color'] ) {
	$css_custom .= $id_blog_list . ' .penci__post-title a{ color : ' . esc_attr( $atts['post_title_color'] ) . '; }';
}
if ( $atts['post_title_hover_color'] ) {
	$css_custom .= $id_blog_list . ' .penci__post-title a:hover{ color : ' . esc_attr( $atts['post_title_hover_color'] ) . '; }';
}

if ( $atts['cat_color'] ) {
	$css_custom .= $id_blog_list . ' .penci-post-cat a{ color : ' . esc_attr( $atts['cat_color'] ) . '; }';
}
if ( $atts['cat_hover_color'] ) {
	$css_custom .= $id_blog_list . ' .penci-post-cat a:hover{ color : ' . esc_attr( $atts['cat_hover_color'] ) . '; }';
}

if ( $atts['meta_color'] ) {
	$css_custom .= $id_blog_list . ' .penci_post-meta{ color : ' . esc_attr( $atts['meta_color'] ) . '; }';
}
if ( $atts['meta_hover_color'] ) {
	$css_custom .= $id_blog_list . ' .penci_post-meta a:hover{ color : ' . esc_attr( $atts['meta_hover_color'] ) . '; }';
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '42px',
	'media'        => '768',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_blog_list . ' .penci-block-title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_title',
	'font-size'    => '24px',
	'media'        => '768',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_blog_list . ' .penci__post-title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'cat',
	'font-size'    => '14px',
	'media'        => '768',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_blog_list . ' .penci-post-cat a{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_meta',
	'font-size'    => '14px',
	'media'        => '768',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_blog_list . '.penci-blog_list .penci_post-meta .entry-meta-item,' . $id_blog_list . '.penci__general-meta .penci_post-meta{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}

Penci_Helper_Shortcode::get_block_script( $unique_id, $atts, $content );

