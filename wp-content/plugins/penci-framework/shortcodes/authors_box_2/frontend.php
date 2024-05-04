<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if( ! $show_on_shortcode ) {
	return;
}
list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'author_box_2' );

$column_number = Penci_Global_Blocks::get_col_number();

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ), $atts['columns'] ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_authors_box_2', $atts ) );

$class_col = 'penci-col-12';

if( 1 != $column_number  ) {
	if( 'columns-2' == $atts['columns'] ) {
		$class_col = 'penci-col-6';
	}elseif( 'columns-3' == $atts['columns'] ) {
		$class_col = 'penci-col-4';
	}elseif( 'columns-4' == $atts['columns'] ) {
		$class_col = 'penci-col-3';
	}
}

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-authors-box_2  <?php echo esc_attr( $class ); ?>">
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<div class="penci-block_content">
		<div class="penci-image-box__cotnent">
			<?php
			$output = '';
			$users_args = array(
				'number'  => $atts['number'],
				'order'   => $atts['order'],
				'orderby' => $atts['order_by'],
				'offset'  => $atts['offset']
			);

			if ( ! empty( $atts['roles'] ) ) {
				$role__in = array();

				$roles_explode = explode( ',', $atts['roles'] );
				foreach ( $roles_explode as $role ) {
					$role__in[] = trim( $role );
				}

				$users_args['role__in'] = $role__in;
			}

			if ( ! empty( $atts['include'] ) ) {
				$include = array();

				$include_explode = explode( ',', $atts['include'] );
				foreach ( $include_explode as $role ) {
					$include[] = trim( $role );
				}

				$users_args['include'] = $include;
			}

			if ( ! empty( $atts['exclude'] ) ) {
				$exclude = array();

				$exclude_explode = explode( ',', $atts['exclude'] );
				foreach ( $exclude_explode as $role ) {
					$exclude[] = trim( $role );
				}

				$users_args['exclude'] = $exclude;
			}

			$authors = get_users( $users_args );

			if ( ! empty( $authors ) ) {

				$output .= '<div class="penci-list-authors penci-row">';

				$i = 0;
				foreach ( $authors as $key => $author ) {
					$output .= '<div class="penci-author-col-item ' . $class_col . '">';
					$output .= '<div class="penci-author-item penci-author-' . $author->ID . '">';
					$output .= '<a href="' . get_author_posts_url( $author->ID ) . '">' . get_avatar( $author->user_email, '100' ) . '</a>';
					$output .= '<div class="penci-authors-details penci-author-content">';

					$output .= '<div class="penci-authors-name">';
					$output .= '<h5><a href="' . get_author_posts_url( $author->ID ) . '">' . $author->display_name . '</a></h5>';
					$output .= '</div>';

					if ( ! $atts['hide_desc'] && $author->description ) {
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

					if ( ! $atts['hide_posts_url'] ) {
						$text_viewallp = function_exists( 'penci_get_tran_setting' ) ? penci_get_tran_setting( 'penci_tran_text_viewallp' ) : esc_html__( 'View all posts', 'penci-framework' );
						$output .= '<a href="' . get_author_posts_url( $author->ID ) . '" class="button">' . esc_attr( $text_viewallp ) . '</a>';
					}
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
</div>
<?php

$id_image_box = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_image_box, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_image_box, $atts );

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'img_box_text',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template' => $id_image_box .'.penci-image-box .penci-fea-in h4 span span{ %s }' ,
), $atts
);


if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
