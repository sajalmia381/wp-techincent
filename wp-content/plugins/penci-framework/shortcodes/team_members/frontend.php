<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$team_members = (array) vc_param_group_parse_atts( $atts['team_members'] );

if( empty( $team_members ) ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'image_box' );

$column_number = Penci_Global_Blocks::get_col_number();
$design_style  = 'penci-team_member-' . ( $atts['_design_style'] ? $atts['_design_style'] : 's1' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ), $atts['columns'], $design_style ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_team_members', $atts ) );

$class_col = 'penci-col-12';

if( 's3' != $atts['_design_style'] ) {
	if( 'columns-2' == $atts['columns'] ) {
		$class_col = 'penci-col-6';
	}elseif( 'columns-3' == $atts['columns'] ) {
		$class_col = 'penci-col-4';
	}elseif( 'columns-4' == $atts['columns'] ) {
		$class_col = 'penci-col-3';
	}
}

$link_target = 'target="_blank"';

if( ! get_theme_mod( 'penci_dis_noopener' ) ) {
	$link_target .= ' rel="noopener"';
}
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-team_memebers  <?php echo esc_attr( $class ); ?>">
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<div class="penci-block_content">
		<div class="penci-image-box__content">
			<div class="team_member_items penci-row">
			<?php
			foreach ( $team_members as $item ) {
				$url_img_item = PENCI_ADDONS_URL . 'assets/img/no-thumb.jpg';
				if ( isset( $item['image'] ) ) {
					$url_img_item = wp_get_attachment_url( $item['image'] );
				}

				$name_item     = isset( $item['name'] ) ? $item['name'] : '';
				$desc_item     = isset( $item['desc'] ) ? $item['desc'] : '';
				$position_item = isset( $item['position'] ) ? $item['position'] : '';

				$link_website_item   = isset( $item['link_website'] ) ? $item['link_website'] : '';
				$link_google_item    = isset( $item['link_google'] ) ? $item['link_google'] : '';
				$link_twitter_item   = isset( $item['link_twitter'] ) ? $item['link_twitter'] : '';
				$link_linkedin_item  = isset( $item['link_linkedin'] ) ? $item['link_linkedin'] : '';
				$link_instagram_item = isset( $item['link_instagram'] ) ? $item['link_instagram'] : '';
				$link_dribbble_item  = isset( $item['link_dribbble'] ) ? $item['link_dribbble'] : '';
				$link_facebook_item  = isset( $item['link_facebook'] ) ? $item['link_facebook'] : '';

				$link_youtube_item   = isset( $item['link_youtube'] ) ? $item['link_youtube'] : '';
				$link_vimeo_item     = isset( $item['link_vimeo'] ) ? $item['link_vimeo'] : '';
				$link_pinterest_item = isset( $item['link_pinterest'] ) ? $item['link_pinterest'] : '';

				$class_lazy = $data_src = '';
				if( function_exists( 'penci_check_lazyload_type' ) ) {
					$class_lazy = penci_check_lazyload_type( 'class', null, false );
					$data_src = penci_check_lazyload_type( 'src', $url_img_item, false );
				}

				$disable_lazyload = penci_get_theme_mod( 'penci_disable_lazyload' );
				?>
				<div class="penci-team_member_item <?php echo $class_col; ?>">
					<div class="penci-team_item__content">
						<?php if( ! $disable_lazyload ) { ?>
							<img class="penci-team_member-img penci-lazy" src="<?php echo get_template_directory_uri() . '/images/penci2-holder.png'; ?>" data-src="<?php echo esc_url( $url_img_item ); ?>" alt="<?php echo esc_attr( $name_item ); ?>"/>
						<?php } else { ?>
							<img class="penci-team_member-img penci-disable-lazy" src="<?php echo esc_url( $url_img_item ); ?>" alt="<?php echo esc_attr( $name_item ); ?>"/>
						<?php }?>

						<div class="penci-team_item__info">
							<?php if ( $name_item ): ?>
								<h5 class="penci-team_member_name"><?php echo $name_item; ?></h5>
							<?php endif; ?>
							<?php if ( $position_item ): ?>
								<div class="penci-team_member_pos"><?php echo $position_item; ?></div>
							<?php endif; ?>
							<?php if ( $desc_item ): ?>
								<div class="penci-team_member_desc"><?php echo $desc_item; ?></div>
							<?php endif; ?>
							<div class="penci-team_member_socails">
							<?php if ( $link_website_item ): ?>
								<a <?php echo $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_website_item ); ?>"><i class="fa fa-globe"></i></a>
							<?php endif; ?>
							<?php if ( $link_facebook_item ): ?>
								<a <?php echo $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_facebook_item ); ?>"><i class="fa fa-facebook"></i></a>
							<?php endif; ?>
							<?php if ( $link_google_item ): ?>
								<a <?php echo  $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_google_item ); ?>"><i class="fa fa-google-plus"></i></a>
							<?php endif; ?>
							<?php if ( $link_twitter_item ): ?>
								<a <?php echo  $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_twitter_item ); ?>"><i class="fa fa-twitter"></i></a>
							<?php endif; ?>
							<?php if ( $link_linkedin_item ): ?>
								<a <?php echo  $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_linkedin_item ); ?>"><i class="fa fa-linkedin"></i></a>
							<?php endif; ?>
							<?php if ( $link_instagram_item ): ?>
								<a <?php echo  $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_instagram_item ); ?>"><i class="fa fa-instagram"></i></a>
							<?php endif; ?>
							<?php if ( $link_youtube_item ): ?>
								<a <?php echo $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_youtube_item ); ?>"><i class="fa fa-youtube-play"></i></a>
							<?php endif; ?>
							<?php if ( $link_vimeo_item ): ?>
								<a <?php echo $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_vimeo_item ); ?>"><i class="fa fa-vimeo"></i></a>
							<?php endif; ?>
							<?php if ( $link_pinterest_item ): ?>
								<a <?php echo $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_pinterest_item ); ?>"><i class="fa fa-pinterest"></i></a>
							<?php endif; ?>
							<?php if ( $link_dribbble_item ): ?>
								<a <?php echo $link_target ?> class="penci-team_member_social" href="<?php echo esc_url( $link_dribbble_item ); ?>"><i class="fa fa-dribbble"></i></a>
							<?php endif; ?>
						</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			</div>
		</div>
	</div>
</div>
<?php

$id_team_member = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_team_member, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_team_member, $atts );

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'team_name',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_team_member . ' .penci-team_member_name{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'team_desc',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_team_member . ' .penci-team_member_desc{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'team_pos',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_team_member . ' .penci-team_member_pos{ %s }',
), $atts
);

// Colors
if( $atts['background_item_color'] ) {
	$css_custom .= $id_team_member . '.penci-team_memebers .penci-team_item__content:before{ background-color: ' . $atts['background_item_color'] . '; }';
}

if( $atts['op_bg_item_color'] ) {
	$css_custom .= $id_team_member . '.penci-team_memebers .penci-team_item__content:before{ opacity: ' . $atts['op_bg_item_color'] . '; }';
}
if( $atts['name_color'] ) {
	$css_custom .= $id_team_member . ' .penci-team_member_name{ color: ' . $atts['name_color'] . '; }';
}

if( $atts['desc_color'] ) {
	$css_custom .= $id_team_member . ' .penci-team_member_desc{ color: ' . $atts['desc_color'] . '; }';
}

if( $atts['pos_color'] ) {
	$css_custom .= $id_team_member . ' .penci-team_member_pos{ color: ' . $atts['pos_color'] . '; }';
}

if( $atts['social_color'] ) {
	$css_custom .= $id_team_member . ' .penci-team_member_social{ color: ' . $atts['social_color'] . '; }';
}

if( $atts['social_hcolor'] ) {
	$css_custom .= $id_team_member . ' .penci-team_member_social:hover{ color: ' . $atts['social_hcolor'] . '; }';
}

if( $atts['border_color'] ) {
	$css_custom .= $id_team_member . ' .penci-team_item__content{ border-color: ' . $atts['border_color'] . '; }';
}

//
if( $atts['height_team'] ) {
	$css_custom .= $id_team_member . ' .penci-team_member_item{ height: ' . $atts['height_team'] . '; }';
}

if( $atts['wh_img'] ) {
	$css_custom .= $id_team_member . ' .penci-team_member-img{ height: ' . $atts['wh_img'] . '; width: ' . $atts['wh_img'] . '; }';
}
if( $atts['image_circle'] ) {
	$css_custom .= $id_team_member . ' .penci-team_member-img{ border-radius: 50%; }';
}

// item team member
$item_tmember_space = '';
if( $atts['item_member_ptop'] ) {
	$item_tmember_space .= 'padding-top:' . esc_attr( $atts['item_member_ptop'] ) . ';';
}if( $atts['item_member_pbottom'] ) {
	$item_tmember_space .= 'padding-bottom:' . esc_attr( $atts['item_member_pbottom'] ) . ';';
}if( $atts['item_member_pleft'] ) {
	$item_tmember_space .= 'padding-left:' . esc_attr( $atts['item_member_pleft'] ) . ';';
}if( $atts['item_member_pright'] ) {
	$item_tmember_space .= 'padding-right:' . esc_attr( $atts['item_member_pright'] ) . ';';
}

if( $item_tmember_space ) {
	$css_custom .= $id_team_member . ' .penci-team_item__content{ ' . $item_tmember_space . ' }';
}

// Name options
$css_custom_name = '';
if( $atts['on_upper_name'] ) {
	$css_custom_name .= 'text-transform: uppercase;';
}

if( $atts['name_margin_top'] ) {
	$css_custom_name .= 'margin-top:' . $atts['name_margin_top'] . ';';
}
if( $atts['name_margin_bottom'] ) {
	$css_custom_name .= 'margin-bottom:' . $atts['name_margin_bottom'] . ';';
}

if( $atts['name_letter_spacing'] ) {
	$css_custom_name .= 'letter-spacing:' . $atts['name_letter_spacing'] . ';';
}

if( $atts['name_line_height'] ) {
	$css_custom_name .= 'line-height:' . $atts['name_line_height'] . ';';
}

if( $css_custom_name ) {
	$css_custom .= $id_team_member . ' .penci-team_member_name{ ' . $css_custom_name . ' }';
}

// Desc options
$css_custom_desc = '';
if( $atts['desc_margin_top'] ) {
	$css_custom_desc .= 'margin-top:' . $atts['desc_margin_top'] . ';';
}

if( $atts['desc_margin_bottom'] ) {
	$css_custom_desc .= 'margin-bottom:' . $atts['desc_margin_bottom'] . ';';
}

if( $atts['desc_letter_spacing'] ) {
	$css_custom_desc .= 'letter-spacing:' . $atts['desc_letter_spacing'] . ';';
}

if( $atts['desc_line_height'] ) {
	$css_custom_desc .= 'line-height:' . $atts['desc_line_height'] . ';';
}

if ( $css_custom_desc ) {
	$css_custom .= $id_team_member . ' .penci-penci-team_member_desc{ ' . $css_custom_desc . ' }';
}

// Position options
$css_custom_pos = '';

if( $atts['on_upper_pos'] ) {
	$css_custom_pos .= 'text-transform: uppercase;';
}

if( $atts['pos_margin_top'] ) {
	$css_custom_pos .= 'margin-top:' . $atts['pos_margin_top'] . ';';
}

if( $atts['pos_margin_bottom'] ) {
	$css_custom_pos .= 'margin-bottom:' . $atts['pos_margin_bottom'] . ';';
}

if( $atts['pos_letter_spacing'] ) {
	$css_custom_pos .= 'letter-spacing:' . $atts['pos_letter_spacing'] . ';';
}

if( $atts['pos_line_height'] ) {
	$css_custom_pos .= 'line-height:' . $atts['pos_line_height'] . ';';
}

if ( $css_custom_pos ) {
	$css_custom .= $id_team_member . ' .penci-team_member_pos{ ' . $css_custom_pos . ' }';
}

if ( $atts['dis_bg_block'] ) {
	$css_custom .= $id_team_member . '.penci-block-vc{ background-color:transparent !important; }';
}

if ( $atts['border_width_team'] ) {
	$css_custom .= $id_team_member . ' .penci-team_item__content{ border-width: ' . $atts['border_width_team'] . '; }';
}

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
