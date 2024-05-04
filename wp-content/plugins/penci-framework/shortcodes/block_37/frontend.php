<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );

$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}


list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'block_37' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );

$class['penci-vc-column'] = isset( $atts['column'] ) ? 'penci-block-col-' . $atts['column'] : '';
$class[] = $atts['enable_line'] ? 'penci-line-bototm' : '';
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_block_37', $atts ) );

$query_slider = Penci_Pre_Query::do_query( $atts );

if ( ! $query_slider->have_posts() ) {
	return;
}

$items = include dirname( __FILE__ ) . "/content-items.php";
$data_filter = Penci_Helper_Shortcode::get_data_filter( 'block_37',$atts, $content );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-block_37 penci__general-meta <?php echo esc_attr( $class ); ?>" data-current="1" data-blockUid="<?php echo esc_attr( $unique_id ); ?>" <?php echo $data_filter; ?>>
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		<?php Penci_Helper_Shortcode::get_pull_down_filter( $atts, 'block_37', $block_content_id ); ?>
		<?php Penci_Helper_Shortcode::get_slider_nav( $block_content_id, $atts, $query_slider ); ?>
	</div>
	<div id="<?php echo esc_attr( $block_content_id ); ?>" class="penci-block_content">
		<?php  echo $items; ?>
	</div>
	<?php Penci_Helper_Shortcode::get_pagination( $atts, $query_slider ); ?>
</div>
<?php
$id_block_37 = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_block_37, $atts );
$css_custom .= Penci_Helper_Shortcode::get_post_cat_css_custom( $id_block_37, $atts );
$css_custom .= Penci_Helper_Shortcode::get_ajax_loading_css_custom( $id_block_37, $atts );
$css_custom .= Penci_Helper_Shortcode::get_text_filter_css_custom( $id_block_37, $atts );
$css_custom .= Penci_Helper_Shortcode::get_pagination_css_custom( $id_block_37, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_block_37, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_pagination( $id_block_37, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_cat( $id_block_37, $atts );

if ( 'custom' == $atts['image_type'] ) {
	if ( $atts['image_ratio'] ) {
		$css_custom .= $id_block_37 . '.penci-imgtype-custom .penci-image-holder:before{ padding-top: ' . floatval( $atts['image_ratio'] ) * 100 . '%; }';
	}
}

if( $atts['posttitle_on_upper'] ) {
	$css_custom .= $id_block_37 . ' .penci__post-title{ text-transform: uppercase; }';
}
if( $atts['padding_top_title'] ) {
	$css_custom .= $id_block_37 . ' .penci__post-title{ padding-top: ' . esc_attr( $atts['padding_top_title'] ) . '; }';
}

if( $atts['padding_bottom_title'] ) {
	$css_custom .= $id_block_37 . ' .penci__post-title,' . $id_block_37 . ' .penci-line-bototm .penci__post-title{ padding-bottom: ' . esc_attr( $atts['padding_bottom_title'] ) . '; }';
}

if( $atts['padding_top_meta'] ) {
	$css_custom .= $id_block_37 . '.penci__general-meta .penci_post-meta,'. $id_block_37 . ' .penci-price{ padding-top: ' . esc_attr( $atts['padding_top_meta'] ) . '; }';
}

if( $atts['padding_bottom_meta'] ) {
	$css_custom .= $id_block_37 . '.penci__general-meta .penci_post-meta,'. $id_block_37 . ' .penci-price{ padding-bottom: ' . esc_attr( $atts['padding_bottom_meta'] ) . '; }';
}

if( $atts['meta_color'] ) {
	$css_custom .= $id_block_37 . '.penci__general-meta .penci_post-meta,'. $id_block_37 . ' .penci-price{ color: ' . esc_attr( $atts['meta_color'] ) . '; }';
}

// Content
$css_content = '';

if( $atts['bg_content_color'] ) {
	$css_content .= 'background-color: ' . esc_attr( $atts['bg_content_color'] ) . ';';
}

if( $atts['text_align'] ) {
	$css_content .= 'text-align: ' . esc_attr( $atts['text_align'] ) . ';';

	if( $atts['enable_line'] ){
		if( 'center' == $atts['text_align'] ) {
			$css_custom .= '.rtl ' . $id_block_37 . ' .penci__post-title:after,'. $id_block_37 . ' .penci__post-title:after{ left: 50%; right:auto; margin-left: -20px;  }';
		}elseif( 'right' == $atts['text_align'] ) {
			$css_custom .= '.rtl ' . $id_block_37 . ' .penci__post-title:after,'. $id_block_37 . ' .penci__post-title:after{ right: 0; left: auto;  }';
		}elseif( 'left' == $atts['text_align'] ) {
			$css_custom .= '.rtl ' . $id_block_37 . ' .penci__post-title:after,'. $id_block_37 . ' .penci__post-title:after{ left: 0; right: auto;  }';
		}
	}
}

if( $atts['padding_content_lr'] ) {
	$css_content .= 'padding-left: ' . esc_attr( $atts['padding_content_lr'] ) . ';';
	$css_content .= 'padding-right: ' . esc_attr( $atts['padding_content_lr'] ) . ';';
}

if( $css_content ) {
	$css_custom .= $id_block_37 . ' .penci_post_content{ ' . $css_content . ' }';
}

// Desc
$css_desc = '';
if( $atts['padding_top_desc'] ) {
	$css_desc .= 'padding-top: ' . esc_attr( $atts['padding_top_desc'] ) . ';';
}

if( $atts['padding_bottom_desc'] ) {
	$css_desc .= 'padding-bottom: ' . esc_attr( $atts['padding_bottom_desc'] ) . ';';
}

if( $atts['desc_color'] ) {
	$css_desc .= 'color: ' . esc_attr( $atts['desc_color'] ) . ';';
}

if( $css_desc ) {
	$css_custom .= $id_block_37 . ' .penci-post-excerpt{ ' . $css_desc . '; }';
}

if( $atts['line_color'] ) {
	$css_custom .= $id_block_37 . ' .penci__post-title:after{ color:' . $atts['line_color'] . '; }';
}

// Content
if ( $atts['bg_content_hcolor'] ) {
	$css_custom .= $id_block_37 . ' .penci_post_content{ cursor: pointer; }';
	$css_custom .= $id_block_37 . ' .penci_post_content:hover{ background-color: ' . esc_attr( $atts['bg_content_hcolor'] ) . '; }';
}

if ( $atts['meta_color_hover'] ) {
	$css_custom .= $id_block_37 . ' .penci_post_content:hover .penci_post-meta,';
	$css_custom .= $id_block_37 . ' .penci_post_content:hover .penci-post-excerpt,';
	$css_custom .= $id_block_37 . ' .penci_post_content:hover .penci-price';
	$css_custom .='{ color: ' . esc_attr( $atts['meta_color_hover'] ) . ' !important; }';
}

if ( $atts['meta_color_hover'] ) {
	$css_custom .= $id_block_37 . ' .penci_post_content:hover .penci_post-meta,';
	$css_custom .= $id_block_37 . ' .penci_post_content:hover .penci-post-excerpt,';
	$css_custom .= $id_block_37 . ' .penci_post_content:hover .penci-price';
	$css_custom .='{ color: ' . esc_attr( $atts['meta_color_hover'] ) . ' !important; }';
}

if( $atts['post_title_hover_color'] ) {
	$css_custom .= $id_block_37 . ' .penci_post_content:hover .penci__post-title a{ color: ' . esc_attr( $atts['post_title_hover_color'] ) . ' !important; }';
}


$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_title',
	'font-size'    => '16px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template' => $id_block_37 .' .penci__post-title{ %s; }' ,
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_meta',
	'font-size'    => '16px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template' => $id_block_37 . '.penci__general-meta .penci_post-meta,'. $id_block_37 . ' .penci-price{ %s; }' ,
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_excrept',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_block_37 . ' .penci-post-excerpt{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}


Penci_Helper_Shortcode::get_block_script( $unique_id, $atts, $content );

