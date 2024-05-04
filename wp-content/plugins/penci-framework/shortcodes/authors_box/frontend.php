<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
global $wpdb;

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if( ! $show_on_shortcode ) {
	return;
}
$css = $user_roles = $sort_by = '';

extract( $atts );

$unique_id = 'penci-author_box--' . rand( 1000, 100000 );
$class     = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( $class ) ), 'penci_authors_box', $atts ) );
?>
	<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-authors-box <?php echo esc_attr( $class ); ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
		<div class="penci-block_content">
			<?php
			$users_args = array();

			if ( empty( $sort_by ) ) {
				$users_args['orderby'] = 'display_name';
			} else {

				$users_args['orderby'] = 'post_count';
				$users_args['order']   = 'DESC';
			}

			if( isset( $atts['author_limit'] ) && $atts['author_limit'] ) {
				$users_args['number'] = $atts['author_limit'];
			}

			if ( ! empty( $user_roles ) ) {
				$role__in = array();

				$roles_explode = explode( ',', $user_roles );
				foreach ( $roles_explode as $role ) {
					$role__in[] = trim( $role );
				}

				$users_args['role__in'] = $role__in;
			}

			$authors = get_users( $users_args );

			$output = '';
			if ( ! empty( $authors ) ) {

				$output .= '<div class="penci-list-authors">';

				foreach ( $authors as $author ) {

					$output .= '<div class="penci-author-item penci-author-' . $author->ID . '">';
					$output .= '<div class="penci_media_object">';

					$output .= '<div class="penci_mobj__img">';
					$output .= '<a href="' . get_author_posts_url( $author->ID ) . '">' . get_avatar( $author->user_email, '80' ) . '</a>';
					$output .= '</div>';

					$output .= '<div class="penci-authors-details penci-author-content penci_mobj__body">';

					$output .= '<div class="penci-authors-name">';
					$output .= '<h5><a href="' . get_author_posts_url( $author->ID ) . '">' . $author->display_name . '</a></h5>';
					$output .= '</div>';

					if ( ! $atts['hide_count_post'] || ! $atts['hide_count_comment'] ):
						$output .= '<div class="penci-author-post-comment">';

						if ( ! $atts['hide_count_post'] ) {
							$output .= '<span class="penci-author-post-count">';
							$output .= count_user_posts( $author->ID ) . ' ';
							$output .= function_exists( 'penci_get_tran_setting' ) ? penci_get_tran_setting( 'penci_posts_text' ) : esc_html__( 'Posts', 'penci-framework' );
							$output .= '</span>';
						}

						if ( ! $atts['hide_count_comment'] ) {
							$output        .= '<span class="penci-author-comments-count">';
							$comment_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) AS total FROM $wpdb->comments WHERE comment_approved = 1 AND user_id = %d", $author->ID ) );
							$output        .= $comment_count . ' ';
							$output        .= function_exists( 'penci_get_tran_setting' ) ? penci_get_tran_setting( 'penci_comment_text' ) : esc_html__( 'Comments', 'penci-framework' );
							$output        .= '</span>';
						}
						$output .= '</div>';
					endif;

					if ( ! $atts['hide_desc'] ) {
						$output .= '<div class="author-description">' . wp_trim_words( $author->description, $atts['post_desc_length'], '...' ) . '</div>';
					}

					if ( ! $atts['hide_contact_info'] ):
						$output .= '<div class="penci-author-social">';

						$user_url   = get_the_author_meta( 'user_url', $author->ID );
						$facebook   = get_the_author_meta( 'facebook', $author->ID );
						$twitter    = get_the_author_meta( 'twitter', $author->ID );
						$googleplus = get_the_author_meta( 'googleplus', $author->ID );
						$instagram  = get_the_author_meta( 'instagram', $author->ID );
						$pinterest  = get_the_author_meta( 'pinterest', $author->ID );
						$tumblr     = get_the_author_meta( 'tumblr', $author->ID );


						$target =  ' target="_blank"';
						if( ! get_theme_mod( 'penci_dis_noopener' ) ) {
							$target .= ' rel="noopener"';
						}

						if ( $user_url ) {
							$output .= '<a' . $target . ' class="author-social" href="' . $user_url . '"><i class="fa fa-globe"></i></a>';
						}

						if ( $facebook ) {
							$output .= '<a' . $target . ' class="author-social" href="http://facebook.com/' . $facebook . '"><i class="fa fa-facebook"></i></a>';
						}

						if ( $twitter ) {
							$output .= '<a' . $target . ' class="author-social" href="http://twitter.com/' . $twitter . '"><i class="fa fa-twitter"></i></a>';
						}

						if ( $googleplus ) {
							$output .= '<a' . $target . ' class="author-social" href="http://plus.google.com/' . $googleplus . '?rel=author"><i class="fa fa-google-plus"></i></a>';
						}

						if ( $instagram ) {
							$output .= '<a' . $target . ' class="author-social" href="http://instagram.com/' . $instagram . '"><i class="fa fa-instagram"></i></a>';
						}

						if ( $pinterest ) {
							$output .= '<a' . $target . ' class="author-social" href="http://pinterest.com/' . $pinterest . '"><i class="fa fa-pinterest"></i></a>';
						}

						if ( $tumblr ) {
							$output .= '<a' . $target . ' class="author-social" href="http://' . $tumblr . '.tumblr.com/"><i class="fa fa-tumblr"></i></a>';
						}
						$output .= '</div><!-- .penci-author-socail -->';
					endif;;

					$output .= '</div>';

					$output .= '</div>';
					$output .= '</div> <!-- .penci-author-item -->';
				}

				$output .= '</div>';
			}

			echo $output;

			?>
		</div>
	</div>
<?php

$id_authors_block = '#' . $unique_id;
$css_custom       = Penci_Helper_Shortcode::get_general_css_custom( $id_authors_block, $atts );
$css_custom       .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_authors_block, $atts );

if ( $atts['authorbox_username_color'] ) {
	$css_custom .= $id_authors_block . ' .penci-authors-name a{ color:' . esc_attr( $atts['authorbox_username_color'] ) . '; }';
}

if ( $atts['authorbox_username_hcolor'] ) {
	$css_custom .= $id_authors_block . ' .penci-authors-name a:hover{ color:' . esc_attr( $atts['authorbox_username_hcolor'] ) . '; }';
}

if ( $atts['authorbox_comment_post_color'] ) {
	$css_custom .= $id_authors_block . ' .penci-author-post-comment span{ color:' . esc_attr( $atts['authorbox_comment_post_color'] ) . '; }';
}

if ( $atts['authorbox_comment_post_bgcolor'] ) {
	$css_custom .= $id_authors_block . ' .penci-author-post-comment span{ background-color: ' . esc_attr( $atts['authorbox_comment_post_bgcolor'] ) . '; }';
}

if ( $atts['authorbox_social_color'] ) {
	$css_custom .= $id_authors_block . ' .penci-author-content .author-social{ color:' . esc_attr( $atts['authorbox_social_color'] ) . '; }';
}

if ( $atts['authorbox_social_hcolor'] ) {
	$css_custom .= $id_authors_block . ' .penci-author-content .author-social:hover{ color:' . esc_attr( $atts['authorbox_social_hcolor'] ) . '; }';
}

if ( $atts['authorbox_desc_color'] ) {
	$css_custom .= $id_authors_block . ' .author-description{ color:' . esc_attr( $atts['authorbox_desc_color'] ) . '; }';
}



if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
