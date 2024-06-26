<?php

class Penci_Post_Gallery {

	public function __construct() {

		add_action( 'admin_init', array( $this, 'add_options_to_gallery_setting' ), 20 );
		add_filter( 'post_gallery', array( $this, 'custom_markup_for_gallery' ), 10, 3 );
	}

	/**
	 * Initialises the WP actions.
	 *  - admin_print_scripts
	 */
	public function add_options_to_gallery_setting() {
		add_action( 'wp_enqueue_media', array( $this, 'wp_enqueue_media' ) );
		add_action( 'print_media_templates', array( $this, 'print_media_templates' ) );
	}

	/**
	 * Enqueues the script.
	 */
	public function wp_enqueue_media() {

		if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' ) {
			return;
		}

		wp_enqueue_script( 'penci-custom-gallery-options', get_template_directory_uri() . '/js/admin-gallery.js', array( 'jquery', 'media-views' ) );

	}

	/**
	 * Outputs the view template with the custom setting.
	 */
	public function print_media_templates() {

		if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' ) {
			return;
		}

		?>
		<script type="text/html" id="tmpl-penci-custom-gallery-options">
			<label class="setting type">
				<span><?php esc_html_e( 'Style', 'pennews' ); ?></span>
				<select class="type" name="type" data-setting="type">
					<?php
					$sizes = apply_filters( 'image_size_names_choose', array(
						'justified'     => esc_html__( 'Justified', 'pennews' ),
						'masonry'       => esc_html__( 'Masonry', 'pennews' ),
						'grid'          => esc_html__( 'Grid', 'pennews' ),
						'single-slider' => esc_html__( 'Single Slider', 'pennews' ),
						'none'          => esc_html__( 'None', 'pennews' )
					) );

					foreach ( $sizes as $value => $name ) { ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, 'justified' ); ?>>
							<?php echo esc_html( $name ); ?>
						</option>
					<?php } ?>
				</select>
			</label>
		</script>
		<?php
	}

	/**
	 * Hook to change markup for gallery
	 *
	 * @param $string
	 * @param $attr
	 *
	 * @return string|void
	 */
	public function custom_markup_for_gallery( $string, $attr ) {

		$data_height = '150';
		if ( is_numeric( penci_get_theme_mod( 'penci_image_height_gallery' ) ) && ( 60 < penci_get_theme_mod( 'penci_image_height_gallery' ) ) ) {
			$data_height = penci_get_theme_mod( 'penci_image_height_gallery' );
		}

		$id      = '';
		$type    = 'justified';
		$columns = '3';

		if ( isset( $attr['ids'] ) ) {
			$id = $attr['ids'];
		}
		if ( isset( $attr['type'] ) ) {
			$type = $attr['type'];
		}
		if ( $type == 'grid' ):
			$type = 'masonry grid';
		endif;

		if ( isset( $attr['columns'] ) && in_array( $attr['columns'], array( '2', '3', '4' ) ) ) {
			$columns = $attr['columns'];
		}

		if ( $type == 'none' ) {
			return;
		}

		$output = '<div class="penci-post-gallery-container ' . $type . ' column-' . $columns . '" data-height="' . $data_height . '" data-margin="3">';

		if ( $type == 'masonry' || $type == 'masonry grid' ):
			$output .= '<div class="inner-gallery-masonry-container">';
		endif;
		if ( $type == 'single-slider' ):
			$output .= '<div class="penci-owl-carousel-slider" data-autoheight="1" data-items="1" data-autotime="4000" data-speed="600" data-loop="0" data-nav="1">';
		endif;

		$order   = isset( $attr['order'] ) ? $attr['order'] : '';
		$orderby = isset( $attr['orderby'] ) ? $attr['orderby'] : '';

		$posts = get_posts(
			array(
				'post_type' => 'attachment',
				'order'     => $order,
				'orderby'   => $orderby,
				'include'   => $id
			)
		);

		if ( $posts ) {
			foreach ( $posts as $imagePost ) {
				$caption = '';
				if ( $imagePost->post_excerpt ):
					$caption = $imagePost->post_excerpt;
				endif;

				$get_full    = wp_get_attachment_image_src( $imagePost->ID, 'full' );
				$get_masonry = wp_get_attachment_image_src( $imagePost->ID, 'penci-masonry-thumb' );

				if ( $type == 'single-slider' ):
					$output      .= '<figure>';
					$get_masonry = wp_get_attachment_image_src( $imagePost->ID, 'penci-slider-thumb' );
				endif;

				if ( $type == 'masonry grid' ):
					$get_masonry = wp_get_attachment_image_src( $imagePost->ID, 'penci-thumb' );
				endif;

				$output .= '<a class="item-gallery-' . $type . '" href="' . $get_full[0] . '" title="' . $caption . '" data-rel="penci-gallery-image-content">';

				if ( $type == 'masonry' || $type == 'masonry grid' ):
					$output .= '<div class="inner-item-masonry-gallery">';
				endif;
				$output .= '<img src="' . $get_masonry[0] . '" alt="">';
				if ( $type == 'masonry' || $type == 'masonry grid' ):
					$output .= '</div>';
				endif;
				$output .= '</a>';

				if ( $type == 'single-slider' ):
					$output .= '</figure>';
				endif;

			}
		}

		if ( $type == 'masonry' || $type == 'single-slider' || $type == 'masonry grid' ):
			$output .= '</div>';
		endif;

		$output .= '</div>';

		return $output;
	}

}

new Penci_Post_Gallery;