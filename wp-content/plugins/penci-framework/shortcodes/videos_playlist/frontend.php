<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( ! get_theme_mod( 'penci_youtube_api_key' ) && preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $atts['videos_list'], $matches ) ) {
	if( is_user_logged_in() ){
		?>
		<div class="penci-missing-settings">
			<span>Video Playlist</span>
			<strong>Youtube Api key</strong> is empty. Please go to Customize > General Options > YouTube API Key and enter an api key :)
		</div>
		<style>.penci-missing-settings { font-size: 13px; font-weight: normal; text-align: left; padding: 20px; outline: 2px dashed #d4d4d4; color: #131313; font-family: Verdana, Geneva, sans-serif; cursor: pointer; margin-top: 10px; margin-bottom: 10px; } .penci-missing-settings span { font-size: 11px; position: relative; margin-right: 10px; background-color: red; color: #fff; font-weight: bold; padding: 5px 10px; }</style>
		<?php
		return;
	}

	return;
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}
extract( $atts );

$rand_video_list = rand( 1000, 100000 );
$unique_id       = 'penci-videos-playlist--' . rand( 1000, 100000 );
$class           = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class           = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( $class ) ), 'penci_videos_playlist', $atts ) );

$videos_list     = get_transient( 'penci-shortcode-playlist-' . $atts['block_id'] );
$videos_list_key = get_transient( 'penci-shortcode-playlist-key' . $atts['block_id'] );

if ( empty( $videos_list ) || $atts['videos_list'] != $videos_list_key ) {
	$videos_list = Penci_Video_List::get_video_infos( $atts['videos_list'] );
	set_transient( 'penci-shortcode-playlist-' . $atts['block_id'], $videos_list, 18000 );
	set_transient( 'penci-shortcode-playlist-key' . $atts['block_id'], $atts['videos_list'], 18000 );
}

$videos_count = is_array( $videos_list ) ? count( (array)$videos_list ) : 0;
?>
	<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-videos-playlist <?php echo esc_attr( $class ); ?>">
		<?php if ( ! empty( $atts['title'] ) && 'style-video_list' != $atts['style_block_title'] ): ?>
			<div class="penci-block-heading">
				<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
			</div>
		<?php endif; ?>
		<div class="penci-block_content">
			<?php if ( ! empty( $videos_list ) ): ?>
				<div class="penci-video-play">
					<?php foreach ( (array)$videos_list as $key => $video ): ?>
						<?php
						if ( $key > 0 ) {
							continue;
						}
						?>
						<div class="fluid-width-video-wrapper"><iframe class="penci-video-frame" id="video-<?php echo esc_attr( $rand_video_list ) ?>-1" src="<?php echo esc_attr( $video['id'] ) ?>" width="100%" height="434" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen async></iframe></div>
					<?php endforeach; ?>
				</div>

				<div class="penci-video-nav">
					<?php if ( ! empty( $atts['title'] ) && 'style-video_list' == $atts['style_block_title'] ): ?>
						<div class="penci-playlist-title">
							<div class="playlist-title-icon"><span class="fa fa-play" aria-hidden="true"></span></div>
							<h2>
								<?php
								echo( ! empty( $atts['block_title_url'] ) ? '<a href=" ' . esc_url( $atts['block_title_url'] ) . ' " title="' . $atts['title'] . '">' : '<span>' );
								echo( ! empty( $atts['add_title_icon'] ) && ! empty( $atts['title_icon'] ) && 'left' == $atts['title_i_align'] ? '<i class="fa-pos-left ' . $atts['title_icon'] . '"></i>' : '' );
								echo esc_html( $atts['title'] );
								echo ( ! empty( $atts['add_title_icon'] ) && ! empty( $atts['title_icon'] ) && 'right' == $atts['title_i_align'] ? '<i class="fa-pos-right ' . $atts['title_icon'] . '"></i>' : '' );
								echo( ! empty( $atts['block_title_url'] ) ? '</a >' : '</span>' );
								?>
							</h2>
							<span class="penci-videos-number">
						<span class="penci-video-playing">1</span> /
						<span class="penci-video-total"><?php echo( $videos_count ) ?></span>
								<?php
								if(  function_exists( 'penci_get_tran_setting' ) ){
									echo penci_get_tran_setting( 'penci_social_video_text' );
								}else{
									esc_html_e( 'Videos', 'penci-framework' );
								}
								?>
					</span>
						</div>
					<?php endif; ?>
					<?php
					$class_nav = ( ! empty( $atts['title'] ) && 'style-video_list' == $atts['style_block_title'] ) ? ' playlist-has-title' : '';
					$class_nav .= $videos_count > 3 ? ' penci-custom-scroll' : '';

					$direction = is_rtl() ? ' dir="rtl"' : '';
					?>
					<div class="penci-video-playlist-nav<?php echo esc_attr( $class_nav ); ?>"<?php echo ( $direction ); ?>>
						<?php
						$video_number = 0;
						foreach ( $videos_list as $video ):
							$video_number ++;
							?>
							<a data-name="video-<?php echo esc_attr( $rand_video_list . '-' . $video_number ) ?>" data-src="<?php echo esc_attr( $video['id'] ) ?>" class="penci-video-playlist-item penci-video-playlist-item-<?php echo esc_attr( $video_number ); ?>">
							<span class="penci_media_object">
								<span class="penci_mobj__img">
									<?php if( ! $atts['hide_order_number'] ): ?>
									<span class="penci-video-number"><?php echo esc_attr( $video_number ) ?></span>
									<span class="penci-video-play-icon"><i class="fa fa-play"></i></span>
									<span class="penci-video-paused-icon"><i class="fa fa-pause"></i></span>
									<?php
									endif;


									$class_lazy = $data_src = '';
									if( function_exists( 'penci_check_lazyload_type' ) ) {
										$class_lazy = penci_check_lazyload_type( 'class', null, false );
										$data_src = penci_check_lazyload_type( 'src', esc_attr( $video['thumb'] ), false );
									}

									printf( '<span class="penci-image-holder penci-video-thumbnail%s" %s href="%s"><span class="screen-reader-text">%s</span></span>',
										$class_lazy,
										$data_src,
										esc_attr( $video['thumb'] ),
										esc_html__( 'Thumbnail youtube', 'penci-framework' )
									);
									?>
								</span>
								<span class="penci_mobj__body">
									<span class="penci-video-title" title="<?php echo esc_attr( $video['title'] ); ?>"><?php echo wp_trim_words( $video['title'],$atts['post_standard_title_length'],'...' ); ?></span>
									<?php if( ! $atts['hide_duration'] ): ?>
									<span class="penci-video-duration"><?php echo esc_attr( $video['duration'] ) ?></span>
									<?php endif; ?>
								</span>
							</span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php

$id_block_video = '#' . $unique_id;


$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_block_video, $atts );

if ( 'style-video_list' == $atts['style_block_title'] ) {

	if ( $atts['background_title_color'] ) {
		$css_custom .= sprintf( '%s .penci-video-nav .penci-playlist-title{ background-color:%s; }', $id_block_video, $atts['background_title_color'] );
	}

	if ( $atts['title_color'] ) {
		$css_custom .= sprintf( '%s .penci-video-nav .penci-playlist-title,%s .penci-video-nav .penci-playlist-title h2{ color:%s; }', $id_block_video,$id_block_video, $atts['title_color'] );
	}
	if ( $atts['title_hover_color'] ) {
		$css_custom .= sprintf( '%s .penci-video-nav .penci-playlist-title a:hover{ color:%s; }', $id_block_video, $atts['title_hover_color'] );
	}
}

if ( $atts['video_title_color'] ) : $css_custom .= sprintf( '%s .penci-video-nav .penci-video-playlist-item{ color:%s; }', $id_block_video, $atts['video_title_color'] ); endif;
if ( $atts['video_title_hover_color'] ) :
	$css_custom .= sprintf( '%s .penci-video-nav .penci-video-playlist-item:hover,%s .penci-video-nav .penci-video-playlist-item.is-playing{ color:%s; }', $id_block_video,$id_block_video, $atts['video_title_hover_color'] );
endif;
if ( $atts['duration_color'] ) :
	$css_custom .= sprintf(
		'%s .penci-video-nav .penci-video-playlist-item .penci-video-duration,' .
		'%s .penci-video-nav .penci-video-playlist-item .penci-video-paused-icon,' .
		'%s .penci-video-nav .penci-video-playlist-item .penci-video-play-icon,' .
		'%s .penci-video-nav .penci-video-playlist-item .penci-video-number{ color:%s; }',
		$id_block_video, $id_block_video, $id_block_video, $id_block_video, $atts['duration_color'] );
endif;

if ( $atts['order_number_bgcolor'] ) :
	$css_custom .= sprintf(
		'.widget-area %s .penci-video-nav .penci-video-playlist-item .penci-video-number,'.
		'.widget-area %s .penci-video-nav .penci-video-playlist-item .penci-video-play-icon,'.
		'.widget-area %s .penci-video-nav .penci-video-playlist-item .penci-video-paused-icon{ background-color:%s; }',
		$id_block_video, $id_block_video, $id_block_video, $atts['order_number_bgcolor'] );
endif;
if ( $atts['order_number_color'] ) :
	$css_custom .= sprintf(
		'.penci-videos-playlist .penci-video-nav .penci-video-playlist-item .penci-video-paused-icon,
		 .penci-videos-playlist .penci-video-nav .penci-video-playlist-item .penci-video-play-icon, 
		 .penci-videos-playlist .penci-video-nav .penci-video-playlist-item .penci-video-number,'.
		'.widget-area %s .penci-video-nav .penci-video-playlist-item .penci-video-number,'.
		'.widget-area %s .penci-video-nav .penci-video-playlist-item .penci-video-play-icon,'.
		'.widget-area %s .penci-video-nav .penci-video-playlist-item .penci-video-paused-icon{ color:%s; }',
		$id_block_video, $id_block_video, $id_block_video, $atts['order_number_color'] );
endif;

if ( $atts['item_video_border-color'] ) :
	$css_custom .= sprintf(
		'%s .penci-video-nav .penci-video-playlist-nav:not(.playlist-has-title) .penci-video-playlist-item:first-child,
		%s .penci-video-nav .penci-video-playlist-nav:not(.playlist-has-title) .penci-video-playlist-item:last-child,
		%s .penci-video-nav .penci-video-playlist-item {border-color: %s;}',
		$id_block_video, $id_block_video, $id_block_video, $atts['item_video_border-color']
	);
endif;

if ( $atts['list_video_bgcolor'] ) :
	$css_custom .= sprintf(
		'%s .penci-video-nav .penci-video-playlist-nav{background-color: %s;}',
		$id_block_video, $atts['list_video_bgcolor']
	);
endif;

if ( $atts['item_video_bg_hcolor'] ) :
	$css_custom .= sprintf(
		'%s .penci-video-nav .penci-video-playlist-item:hover, %s .penci-video-nav .penci-video-playlist-item.is-playing{ background-color:%s; }
		%s .penci-video-nav .penci-video-playlist-nav:not(.playlist-has-title) .penci-video-playlist-item:hover:first-child,
		%s .penci-video-nav .penci-video-playlist-nav:not(.playlist-has-title) .penci-video-playlist-item:hover:last-child,
		%s .penci-video-nav .penci-video-playlist-item:hover {border-color: %s;}',
		$id_block_video,$id_block_video, $atts['item_video_bg_hcolor'],
		$id_block_video, $id_block_video, $id_block_video, $atts['item_video_bg_hcolor']
	);
endif;

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => $id_block_video . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title,'. $id_block_video .' .penci-video-nav .penci-playlist-title h2{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'video_title',
	'font-size'    => '13px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_block_video . ' .penci-video-nav .penci-video-playlist-item .penci-video-title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'duration_typo',
	'font-size'    => '13px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_block_video . ' .penci-video-nav .penci-video-playlist-item .penci-video-duration,' .
	                  $id_block_video . ' .penci-video-nav .penci-video-playlist-item .penci-video-paused-icon,' .
	                  $id_block_video . ' .penci-video-nav .penci-video-playlist-item .penci-video-play-icon, ' .
	                  $id_block_video . ' .penci-video-nav .penci-video-playlist-item .penci-video-number{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}