<?php
class Penci_MegaMenu_Ajax_Filter{

	function __construct() {
		add_action( 'wp_ajax_nopriv_penci_ajax_mega_menu', array( __CLASS__,'ajax_block' ) );
		add_action( 'wp_ajax_penci_ajax_mega_menu', array( __CLASS__,'ajax_block' ) );
	}

	public static function ajax_block() {

		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			die ( 'Nope!' );
		}

		$datafilter = isset( $_POST['datafilter'] ) ? $_POST['datafilter'] : '';
		$paged      = isset( $_POST['paged'] ) ? $_POST['paged'] : 1;
		$post_type  = isset( $datafilter['post_types'] ) ? $datafilter['post_types'] : 'post';
		$numbers    = isset( $datafilter['showposts'] ) ? $datafilter['showposts'] : '';
		$tax        = isset( $datafilter['tax'] ) ? $datafilter['tax'] : '';
		$cat_id     = isset( $datafilter['cat_id'] ) ? $datafilter['cat_id'] : '';


		if ( empty( $datafilter['shortcode_id'] )  ) {
			wp_send_json_success( '' ) ;
		}


		$args = array(
			'post_type'           => $post_type,
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish',
			'posts_per_page'      => $numbers,
			'paged'               => $paged,
			'tax_query'           => array(
				array(
					'taxonomy' => $tax,
					'field'    => 'id',
					'terms'    => $cat_id,
				),
			),
		);
		$args = apply_filters( 'penci_args_support_polylang', $args );
		$latest_mega = new WP_Query( $args );

		if ( ! $latest_mega->have_posts() ) {
			wp_send_json_success( array( 'items' => '', 'hidePagNext' => 1, 'hidePagPrev' => 1 , 'args' => $args ) );
		}
		$hide_pag_next = $hide_pag_prev = '';

		if ( 1 == $paged ) {
			$hide_pag_prev = 1;
		}

		if ( $latest_mega->max_num_pages == $paged ) {
			$hide_pag_next = 1;
		}

		$post_mega_numbers = $numbers;

		ob_start();
		include( PENCI_ADDONS_DIR . "mega-menu/list-posts.php" );
		$content_items = ob_get_clean();

		wp_reset_postdata();

		wp_send_json_success( array( 'items' => $content_items, 'hidePagNext' => $hide_pag_next, 'hidePagPrev' => $hide_pag_prev , 'args' => $args ) );
	}

}

new Penci_MegaMenu_Ajax_Filter;