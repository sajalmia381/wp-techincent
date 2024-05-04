<?php

class Penci_Post_Views_Count {

	public $options;

	public function __construct() {

		$this->options = array(
			'time'       => 0,
			'format'     => ' (%count%)',
			'in_content' => false,
			'no_members' => false,
			'no_admins'  => false,
		);

			if( get_theme_mod( 'penci_dis_countview_module' ) ) {
			return '';
		}

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

		add_action( 'save_post', array( $this, 'save_post' ) );

		if( penci_get_theme_mod( 'penci_enable_ajax_view' ) ) {
			add_action( 'wp_footer', array( $this, 'ajax_footer_script' ), 999 );
			add_filter( 'query_vars', array( $this, 'ajax_query_vars' ) );
			add_action( 'wp', array( $this, 'ajax_count' ) );
		}else{
			add_action('penci_view_count', array($this, 'pvc_main'));
		}

		add_action( 'wp_ajax_nopriv_penci_count_view_load_more', array($this,'penci_count_view_load_more_callback' ) );
		add_action( 'wp_ajax_penci_count_view_load_more', array($this,'penci_count_view_load_more_callback' ) );
	}

	/**
	 * Adds our special query var
	 */
	function ajax_query_vars( $query_vars ) {
		$query_vars[] = 'penci_spp_count';
		$query_vars[] = 'penci_spp_post_id';

		return $query_vars;
	}

	/**
	 * Adds counting code to footer
	 */
	function ajax_footer_script() {
		if((is_single() || is_singular()) && in_array(get_post_type(get_the_ID()), self::get_post_types())) :
			?>
			<script type="text/javascript">
				function PenciSimplePopularPosts_AddCount(id, endpoint)
				{
					var xmlhttp;
					var params = "/?penci_spp_count=1&penci_spp_post_id=" + id + "&cachebuster=" +  Math.floor((Math.random() * 100000));
					// code for IE7+, Firefox, Chrome, Opera, Safari
					if (window.XMLHttpRequest)
					{
						xmlhttp=new XMLHttpRequest();
					}
					// code for IE6, IE5
					else
					{
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange=function()
					{
						if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
							var data = JSON.parse( xmlhttp.responseText );
							document.getElementsByClassName( "penci-post-countview-number" )[0].innerHTML = data.visits;
						}
					}
					xmlhttp.open("GET", endpoint + params, true);
					xmlhttp.send();
				}
				PenciSimplePopularPosts_AddCount(<?php echo get_the_ID(); ?>, '<?php echo get_site_url(); ?>');
			</script>
			<?php
		endif;
	}

	/**
	 * Count function
	 *
	 */
	function ajax_count()  {
		/**
		 * Endpoint for counting visits
		 */
		if(intval(get_query_var('penci_spp_count')) === 1 && intval(get_query_var('penci_spp_post_id')) !== 0)
		{

			//JSON response
			header('Content-Type: application/json');
			$id = intval(get_query_var('penci_spp_post_id'));
			$timings = $this->get_timings();

			foreach ( $timings as $time ) {
				$meta_key = '_count-views_' . $time;

				$count = (int) get_post_meta( $id, $meta_key, true );
				$count = $count + 1;
				update_post_meta( $id, $meta_key, $count );
			}

			$current_count = get_post_meta($id, '_count-views_all', true);

			echo json_encode( array( 'status' => 'OK', 'visits' => intval( $current_count ) ) );
			die();
		}
	}

	public function penci_count_view_load_more_callback() {
		$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			die ( 'Nope!' );
		}

		$postid  = isset( $_POST['postid'] ) ? $_POST['postid'] : '';

		if( $postid ) {
			$timings = $this->get_timings();

			foreach ( $timings as $time ) {

				$meta_key = '_count-views_' . $time;

				$count = (int) get_post_meta( $postid, $meta_key, true );
				$count = $count + 1;

				update_post_meta( $postid, $meta_key, $count );
			}

			$current_count = get_post_meta( $postid, '_count-views_all', true);

			wp_send_json_success( $current_count );
		}

		die();
	}

	public function pvc_main() {

		if ( ! is_singular() || is_page() ) {
			return;
		}

		$post_types = self::get_post_types();

		$options = $this->options;
		$timings = $this->get_timings();
		
		if ( ! ( ( $options['no_members'] == 'on' && is_user_logged_in() ) || ( $options['no_admins'] == 'on' && current_user_can( 'administrator' ) ) ) &&
		     ! empty( $_SERVER['HTTP_USER_AGENT'] ) &&
		     ( defined( 'DOING_AJAX' ) || is_singular( $post_types ) )
		) {
			foreach ( $timings as $time ) {

				$meta_key = '_count-views_' . $time;

				$count = (int) get_post_meta( get_the_ID(), $meta_key, true );
				++ $count;

				update_post_meta( get_the_ID(), $meta_key, $count );
			}
		}
	}

	public static function get_post_types() {

		$post_types = get_post_types();

		if ( empty( $post_types ) ) {
			return array();
		}

		unset( $post_types['attachment'] );
		unset( $post_types['revision'] );
		unset( $post_types['nav_menu_item'] );
		unset( $post_types['customize_changeset'] );
		unset( $post_types['custom_css'] );
		unset( $post_types['page'] );
		unset( $post_types['oembed_cache'] );
		unset( $post_types['user_request'] );
		unset( $post_types['vc4_templates'] );
		unset( $post_types['wpcf7_contact_form'] );
		unset( $post_types['vc_grid_item'] );
		unset( $post_types['penci_slider'] );
		unset( $post_types['mc4wp-form'] );

		return $post_types;
	}

	public function add_meta_boxes() {

		$post_types = self::get_post_types();

		add_meta_box(
			'penci_pvc_meta_box',
			esc_html__( 'Penci Post Views Count' ),
			array( $this, 'add_meta_box' ),
			$post_types,
			'side'
		);
	}

	public function add_meta_box() {
		?>
		<div id="pencipvc_box">
			<?php esc_html_e( '(Click number views to edit it )', 'penci-framework' ); ?>
			<table style="width:100%">
				<?php
				global $post;
				$timings = $this->get_timings();
				foreach ( $timings as $time):
					$meta_key = '_count-views_' . $time;

					$count    = (int) get_post_meta( $post->ID, $meta_key, true );

					printf( '<tr>' . __(
							'<td style="width: 25px;text-transform: capitalize;">%1$s:</td> <td><span class="hide-if-no-js toggle_views penci-toggle-views" onclick="jQuery(this).hide().next(\'span\').show().find(\'input:visible\').select();" title="%3$s">%2$d</span>' .
							'<span class="hide-if-js">' .
							'<input type="hidden" name="old_views_%1$s" value="%2$d" />' .
							'<input onblur="jQuery(jQuery(this).parent()).hide().prev(\'span\').text(jQuery(this).val()).show();" type="number" min="0" size="2" name="new_views_%1$s" value="%2$d" />' .
							'</span> views', 'penci-framework' . '</td></tr>', 'penci-framework' ),
						esc_html( $time ), (int) $count, __( 'Click to edit me!', 'penci-framework' )
					);
				
				endforeach;
				?>
			</table>
			<label><input type="checkbox" name="pencipvc_reset" value="on"/> <?php _e( 'Check me to reset all views', 'penci-framework' ); ?></label>
			<?php wp_nonce_field( 'pencipvc-reset_' . $post->ID, 'pencipvc_reset_nonce', true, true ); ?>
		</div>
		<style>.penci-toggle-views {
				cursor: pointer;
				padding: 0 5px;
				background: #ebebeb;
			}</style>
		<?php
	}

	function save_post() {

		if ( ! isset($_POST['pencipvc_reset_nonce'])) {
			return;
		}
		
		global $post;

		check_admin_referer('pencipvc-reset_' . $post->ID, 'pencipvc_reset_nonce');

		$times = $this->get_timings();

		foreach ($times as $time) {
			$count = isset($_POST['pencipvc_reset']) ? 0 : (int) $_POST['new_views_' . $time];

			update_post_meta($post->ID, '_count-views_' . $time, $count);
		}
	}

	function get_timings() {
		return array( 'all','week', 'month', 'year');
	}

}

new Penci_Post_Views_Count;


if ( ! function_exists( 'penciframework_get_post_countview' ) ) {
	function penciframework_get_post_countview( $post_id, $show = false ) {
		return function_exists( 'penci_get_post_countview' ) ? penci_get_post_countview( $post_id, $show ) : 0;
	}
}
