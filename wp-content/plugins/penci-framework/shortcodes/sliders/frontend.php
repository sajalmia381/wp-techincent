<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$unique_id = 'penci-slider--' . rand( 1000, 100000 );

$column_number = Penci_Global_Blocks::get_col_number();

$class    = array();
$class [] = $atts['class'];
$class [] = $atts['style_slider'];
$class [] = isset( $atts['each_item_style'] ) ? $atts['each_item_style'] : '';
$class [] = $unique_id;
$class [] = 'penci-vc-column-' . $column_number;
$class [] = ( isset( $atts['title_meta_align'] ) && $atts['title_meta_align'] ) ? 'penci-text-align-' . $atts['title_meta_align'] : '';
$class [] = isset( $atts['css'] ) && $atts['css'] ? vc_shortcode_custom_css_class( $atts['css'], '' ) : '';

//print_rm($atts);
$style_slider = ! empty( $atts['style_slider'] ) ? $atts['style_slider'] : 'style-1';

if ( 'style-17' == $style_slider && $atts['_content_above'] ) {
	$class [] = 'penci-content-above-img';
}

$query_slider = Penci_Pre_Query::do_query( $atts );

if ( ! $query_slider->have_posts() ) {
	return;
}

/**
 * Default slider
 * 3 item show on the screen.
 */
$data_items     = '3';
$data_autowidth = 0;
$data_margin    = '3';
$data_center    = 0;

$slider_1_screen = array(
	'style-26',
	'style-25',
	'style-3',
	'style-8',
	'style-11',
	'style-15',
	'style-16',
	'style-17',
	'style-19',
	'style-20',
	'style-21',
	'style-22',
	'style-23',
	'style-24'
);

// 1 item show on the screen.
if ( in_array( $atts['style_slider'], $slider_1_screen ) ) {
	$data_items  = '1';
	$data_margin = '0';
} // 2 items show on the screen.
elseif ( in_array( $atts['style_slider'], array( 'style-4', 'style-10' ) ) ) {
	$data_items = '2';
} // 4 items show on the screen.
elseif ( in_array( $atts['style_slider'], array( 'style-2', 'style-6', 'style-13', 'style-14' ) ) ) {
	$data_items = '4';
} // 5 items show on the screen.
elseif ( in_array( $atts['style_slider'], array( 'style-1' ) ) ) {
	$data_items = '5';
}

// Set non grid content. Try using width style on divs.
if ( in_array( $atts['style_slider'], array( 'style-1', 'style-7', 'style-14', 'style-27', 'style-28' ) ) ) {
	$data_autowidth = 1;
}

if ( 'style-7' == $atts['style_slider'] ) {
	$data_items = '1';
}

if ( 'style-18' == $atts['style_slider'] ) {
	$data_center = 1;
	$data_items  = 2;
	$data_margin = '0';
}

if ( 'style-10' == $atts['style_slider'] || 'style-9' == $atts['style_slider'] ) {
	$data_margin = '4';
}


if ( 'style-27' == $atts['style_slider'] ) {
	$data_autowidth = 1;
	$data_margin    = '4';
}

// Data slider
$data = 'data-style="' . esc_attr( $atts['style_slider'] ) . '"';
$data .= ' data-items="' . esc_attr( $data_items ) . '"';
$data .= ' data-autowidth="' . esc_attr( $data_autowidth ) . '"';
$data .= ' data-auto="' . ( empty( $atts['auto_play'] ) ? 1 : 0 ) . '"';
$data .= ' data-autotime="' . ( ! empty( $atts['auto_time'] ) ? $atts['auto_time'] : 4000 ) . '"';
$data .= ' data-speed="' . ( ! empty( $atts['speed'] ) ? $atts['speed'] : 800 ) . '"';
$data .= ' data-loop="' . ( ! empty( $atts['disable_loop'] ) ? 1 : 0 ) . '"';
$data .= ' data-dots="0"';
$data .= ' data-nav="1"';
$data .= ' data-magrin="' . $data_margin . '"';
$data .= ' data-center="' . $data_center . '"';

if ( 'style-17' == $atts['style_slider'] ) {
	$data .= ' data-autoheight="1"';
}

if ( 'style-14' == $atts['style_slider'] ) {
	$data    .= ' data-autoheight1="1"';
	$data    .= ' data-autoheight2="1"';
	$class[] = 'mobile';
}

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( $class ) ), 'penci_sliders', $atts ) );

if ( $atts['title'] ):
	$class_heading = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
	?>
	<div id="<?php echo esc_attr( $unique_id ); ?>_headding" class="penci-block-vc penci-heading-slider <?php echo esc_attr( implode( ' ', $class_heading ) ); ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
	</div>
	<?php
endif;

if ( in_array( $atts['style_slider'], array( 'style-12', 'style-13', 'style-14' ) ) ) {
	echo '<div id="' . esc_attr( $unique_id ) . '" data-ride="penci_sliders" class="penci-slider-sync penci-owl-featured-area penci-fadeInUp ' . esc_attr( $class ) . '" ' . $data . '>';
	include dirname( __FILE__ ) . "/{$style_slider}.php";
	echo '</div>';
}  else {
	echo '<div id="' . esc_attr( $unique_id ) . '" data-ride="penci_sliders" class="penci-owl-carousel-slider penci-owl-featured-area  penci-owl-carousel-style ' . esc_attr( $class ) . '" ' . $data . '>';
	include dirname( __FILE__ ) . "/{$style_slider}.php";
	echo '</div>';
}

$id_slider = '#' . $unique_id;

$css_custom = Penci_Helper_Shortcode::get_general_css_custom( '#' . $unique_id . '_headding', $atts );

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => '#' . $unique_id . '_headding' . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_title',
	'font-size'    => '',
	'media'        => '961',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_slider . ' h3, ' . $id_slider . ' .penci_slider__title { %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'post_meta',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_slider . ' .penci-slider__meta .penci-slider__meta-item,' . $id_slider . ' .penci_post-meta,' . $id_slider . ' .penci-slider__meta{ %s !important; }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_post_cat_css_custom( $id_slider, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'cat',
	'font-size'    => '10px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_slider . ' .penci-slider__cat .penci-cat-name{ %s }',
), $atts
);

if ( $atts['font_size_title_big_item'] || $atts['post_title_font_size'] ) {
	if ( $atts['font_size_title_big_item'] ) {
		$css_custom .= '@media (min-width: 961px){' . $id_slider . ' .item__big-thumb .penci_slider__title,' . $id_slider . ' .penci-big_items h3{ font-size:' . $atts['font_size_title_big_item'] . ' !important; } }';
	}
	if ( 'style-8' == $atts['style_slider'] ) {
		$css_custom .= '@media (min-width: 961px){' . $id_slider . ' .item__medium-thumb .penci_slider__title{ font-size:' . $atts['font_size_title_big_item'] . ' !important; } }';
	}

	if ( 'style-10' == $atts['style_slider'] ) {
		$css_custom .= '@media (min-width: 961px){' . $id_slider . ' .penci-item-mag.penci-slider__big-item h3{ font-size:' . $atts['font_size_title_big_item'] . ' !important; } }';
	}

	if ( 'style-19' == $atts['style_slider'] ) {
		$css_custom .= '@media (min-width: 961px){' . $id_slider . ' .penci-item-1 .penci_slider__title{ font-size:' . $atts['font_size_title_big_item'] . ' !important; } }';
	}

}

if ( $atts['font_size_title_small_item'] ) {

	if ( 'style-26' == $atts['style_slider'] ) {
		$css_custom .= '@media (min-width: 961px){' . $id_slider . ' .penci-item-mag.item__small_thumb h3{ font-size:' . $atts['font_size_title_small_item'] . ' !important; } }';
	}
}

if ( $atts['nav_text_color'] ) {
	$css_custom .= sprintf( '%s  .owl-nav .owl-prev,%s .owl-nav .owl-next { color:%s !important; }', $id_slider, $id_slider, $atts['nav_text_color'] );
}
if ( $atts['nav_bg_color'] ) {
	$css_custom .= sprintf( '%s  .owl-nav .owl-prev,%s .owl-nav .owl-next{ background-color:%s !important; }', $id_slider, $id_slider, $atts['nav_bg_color'] );
}

// Title and meta
if ( in_array( $atts['style_slider'], array( 'style-12', 'style-13', 'style-14' ) ) ) {
	if ( $atts['post_title_color'] ) {
		$css_custom .= sprintf( '%s .penci-small_items h3 a{ color:%s !important; }', $id_slider, $atts['post_title_color'] );
	}
	if ( $atts['post_title_hcolor'] ) {
		$css_custom .= sprintf( '%s .penci-small_items h3 a:hover{ color:%s !important; }', $id_slider, $atts['post_title_hcolor'] );
	}

	if ( $atts['meta_color'] ) {
		$css_custom .= sprintf( '%s .penci-small_items .penci_post-meta,%s .penci-small_items .penci-slider__meta{ color:%s !important;  }', $id_slider, $id_slider, $atts['meta_color'] );
	}
	if ( $atts['meta_hcolor'] ) {
		$css_custom .= sprintf( '%s .penci-small_items .penci-slider__meta a:hover{ color:%s !important;  }', $id_slider, $atts['meta_hcolor'] );
	}

	if ( $atts['post_title_bigp_color'] ) {
		$css_custom .= sprintf( '%s .penci-big_items h3 a{ color:%s !important; }', $id_slider, $atts['post_title_bigp_color'] );
	}
	if ( $atts['post_title_bigp_hcolor'] ) {
		$css_custom .= sprintf( '%s .penci-big_items h3 a:hover{ color:%s !important; }', $id_slider, $atts['post_title_bigp_hcolor'] );
	}

	if ( $atts['meta_bigp_color'] ) {
		$css_custom .= sprintf( '%s .penci-big_items .penci-slider__meta{ color:%s !important;  }', $id_slider, $atts['meta_bigp_color'] );
	}
	if ( $atts['meta_bigp_hcolor'] ) {
		$css_custom .= sprintf( '%s .penci-big_items .penci-slider__meta a:hover{ color:%s !important;  }', $id_slider, $atts['meta_bigp_hcolor'] );
	}
} else {
	if ( $atts['post_title_color'] ) {
		$css_custom .= sprintf( '%s h3 a{ color:%s !important; }', $id_slider, $atts['post_title_color'] );
	}
	if ( $atts['post_title_hcolor'] ) {
		$css_custom .= sprintf( '%s h3 a:hover{ color:%s !important; }', $id_slider, $atts['post_title_hcolor'] );
	}

	if ( $atts['meta_color'] ) {
		$css_custom .= sprintf( '%s .penci__general-meta .penci_post-meta,%s .penci-slider__meta{ color:%s !important;  }', $id_slider, $id_slider, $atts['meta_color'] );
	}
	if ( $atts['meta_hcolor'] ) {
		$css_custom .= sprintf( '%s .penci__general-meta .penci_post-meta a:hover,%s .penci-slider__meta a:hover{ color:%s !important;  }', $id_slider, $id_slider, $atts['meta_hcolor'] );
	}
}


if ( $atts['border_color'] ) {
	$css_custom .= sprintf( '%s .penci-small_items .owl-item.active .penci-item-mag:before{ background-color:%s; }', $id_slider, $atts['border_color'] );
}

if ( $atts['centerbox_bg'] ) {
	$css_custom .= sprintf( '%s.style-20 .penci-featured-content .featured-slider-overlay{ background-color:%s; }', $id_slider, $atts['centerbox_bg'] );
}

if ( $atts['turn_on_uppercase'] ) {
	$css_custom .= sprintf( '%s.style-12 .penci-big_items h3{ text-transform: uppercase; }', $id_slider );
}

if ( $atts['centerbox_bg_opacity'] && '0.7' != $atts['centerbox_bg_opacity'] ) {
	$css_custom .= sprintf( '%s.style-20 .penci-featured-content .featured-slider-overlay{ opacity:%s; }', $id_slider, $atts['centerbox_bg_opacity'] );
}

/**
 * Check speed style 12
 */
if ( $atts['speed'] && '800' != $atts['speed'] ) {

	$slider_speed = $atts['speed'];
	$slider_cat   = ( $slider_speed - 100 ) / 1000;
	$slider_text  = ( $slider_speed - 200 ) / 1000;
	$slider_title = $slider_cat + 0.2;
	$slider_meta  = $slider_title + 0.2;

	$css_custom .= sprintf( '%s .penci-slider__text{ animation-delay:%ss;  -webkit-animation-delay: %ss; }', $id_slider, $slider_text, $slider_text );
	$css_custom .= sprintf( '%s .penci-slider__cat{ animation-delay:%ss;  -webkit-animation-delay: %ss; }', $id_slider, $slider_cat, $slider_cat );
	$css_custom .= sprintf( '%s  h3{ animation-delay:%ss; -webkit-animation-delay: %ss; }', $id_slider, $slider_title, $slider_title );
	$css_custom .= sprintf( '%s .penci-slider__meta{ animation-delay:%ss; -webkit-animation-delay: %ss; }', $id_slider, $slider_meta, $slider_meta );
}


if ( 'style-23' == $atts['style_slider'] && $atts['slider_overlay_bg'] ) {

	if ( ! is_rtl() ) {
		$css_custom .= $id_slider . ".style-23 .penci-slider-overlay{ 
		 background: -moz-linear-gradient(left, transparent 26%, " . $atts['slider_overlay_bg'] . "  65%);
	    background: -webkit-gradient(linear, left top, right top, color-stop(26%, " . $atts['slider_overlay_bg'] . " ), color-stop(65%, transparent));
	    background: -webkit-linear-gradient(left, transparent 26%, " . $atts['slider_overlay_bg'] . " 65%);
	    background: -o-linear-gradient(left, transparent 26%, " . $atts['slider_overlay_bg'] . " 65%);
	    background: -ms-linear-gradient(left, transparent 26%, " . $atts['slider_overlay_bg'] . " 65%);
	    background: linear-gradient(to right, transparent 26%, " . $atts['slider_overlay_bg'] . " 65%);
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='" . $atts['slider_overlay_bg'] . "', endColorstr='" . $atts['slider_overlay_bg'] . "', GradientType=1);
		 }";
	} else {
		$css_custom .= $id_slider . ".style-23 .penci-slider-overlay{ 
		 background: -moz-linear-gradient(right, transparent 26%, " . $atts['slider_overlay_bg'] . "  65%);
	    background: -webkit-gradient(linear, right top, left top, color-stop(26%, " . $atts['slider_overlay_bg'] . " ), color-stop(65%, transparent));
	    background: -webkit-linear-gradient(right, transparent 26%, " . $atts['slider_overlay_bg'] . " 65%);
	    background: -o-linear-gradient(right, transparent 26%, " . $atts['slider_overlay_bg'] . " 65%);
	    background: -ms-linear-gradient(right, transparent 26%, " . $atts['slider_overlay_bg'] . " 65%);
	    background: linear-gradient(to left, transparent 26%, " . $atts['slider_overlay_bg'] . " 65%);
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='" . $atts['slider_overlay_bg'] . "', endColorstr='" . $atts['slider_overlay_bg'] . "', GradientType=1);
		 }";
	}
}

if ( 'style-13' == $atts['style_slider'] ) {
	if ( $atts['dis_bottom_text_nav_slider13'] ) {
		$css_custom .= sprintf( '%s.penci-owl-featured-area.style-13 .penci-small_items{ display: none !important; }', $id_slider );
	}

	if ( $atts['readmore_text_color'] ) {
		$css_custom .= sprintf( '%s.penci-owl-featured-area.style-13 .button-read-more{ color: %s; }', $id_slider, $atts['readmore_text_color'] );
	}
	if ( $atts['readmore_bg_color'] ) {
		$css_custom .= sprintf( '%s.penci-owl-featured-area.style-13 .button-read-more{ background-color: %s; }', $id_slider, $atts['readmore_bg_color'] );
	}
	if ( $atts['readmore_border_color'] ) {
		$css_custom .= sprintf( '%s.penci-owl-featured-area.style-13 .button-read-more{ border-color: %s; }', $id_slider, $atts['readmore_border_color'] );
	}
	if ( $atts['readmore_hover_text_color'] ) {
		$css_custom .= sprintf( '%s.penci-owl-featured-area.style-13 .button-read-more:hover{ color: %s; }', $id_slider, $atts['readmore_hover_text_color'] );
	}
	if ( $atts['readmore_hover_bg_color'] ) {
		$css_custom .= sprintf( '%s.penci-owl-featured-area.style-13 .button-read-more:hover{ background-color: %s !important; }', $id_slider, $atts['readmore_hover_bg_color'] );
	}
	if ( $atts['readmore_hover_border_color'] ) {
		$css_custom .= sprintf( '%s.penci-owl-featured-area.style-13 .button-read-more:hover{ border-color: %s !important;; }', $id_slider, $atts['readmore_hover_border_color'] );
	}

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'readmore',
		'font-size'    => '',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_slider . '.penci-owl-featured-area.style-13 .button-read-more{ %s; }',
	), $atts
	);
}

if ( 'style-13' == $atts['style_slider'] && $atts['background_big_item'] ) {
	$css_custom .= sprintf( '%s.penci-owl-featured-area.style-13 .penci-featured-content{ background-color: %s !important; }', $id_slider, $atts['background_big_item'] );
}

if ( 'style-28' == $atts['style_slider'] ) {
	if ( $atts['fea_item_s28width'] ) {
		$css_custom .= '@media screen and (min-width: 480px) {';
		$css_custom .= sprintf( '%s.penci-owl-featured-area.style-28 .penci-image-holder{ width:%s; }', $id_slider, $atts['fea_item_s28width'] );
		$css_custom .= '}';
	}
}

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
