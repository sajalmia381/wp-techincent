<?php
/**
 * This file has all the main shortcode functions
 */
if ( ! function_exists( 'penci_refresh_mce' ) ) {
	function penci_refresh_mce( $ver ) {
		$ver += 3;

		return $ver;
	}
}
// init process for button control
add_filter( 'tiny_mce_version', 'penci_refresh_mce' );

add_action( 'init', 'penci_pre_add_shortcode_buttons' );
if ( ! function_exists( 'penci_pre_add_shortcode_buttons' ) ) {
	function penci_pre_add_shortcode_buttons() {
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
			return;

		if( is_admin() || ( isset( $_GET['vc_editable'] ) && 'true' == $_GET['vc_editable'] ) ){
			// Add only in Rich Editor mode
			if ( get_user_option( 'rich_editing' ) == 'true' ) {
				add_filter( "mce_external_plugins", "penci_pre_add_shortcodes_tinymce_plugin" );
				add_filter( 'mce_buttons', 'penci_pre_register_shortcode_buttons' );
			}
		}
	}
}
if ( ! function_exists( 'penci_pre_register_shortcode_buttons' ) ) {
	function penci_pre_register_shortcode_buttons( $buttons ) {
		array_unshift( $buttons, 'penci_pre_shortcodes_button', 'separator' );

		return $buttons;
	}
}
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
if ( ! function_exists( 'penci_pre_add_shortcodes_tinymce_plugin' ) ) {
	function penci_pre_add_shortcodes_tinymce_plugin( $plugin_array ) {

		$link_mce = plugin_dir_url( __FILE__ ) . 'js/mce.js';

		$plugin_array['penci_pre_shortcodes_button'] = $link_mce;

		return $plugin_array;
	}
}

if( ! function_exists( 'penci_add_tinymce_buttons' ) ) {
	function penci_add_tinymce_buttons( $buttons ) {
		//Add style selector to the beginning of the toolbar
		array_unshift( $buttons, 'styleselect' );

		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'penci_add_tinymce_buttons' );

function my_custom_js() {
	$post_type = get_post_type();

	if( 'post' == $post_type ) {
		return;
	}
	
	$taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
	
    ?>
    <script type="text/javascript">
	var $taxonomies_current = [{ text: 'Recent Posts', value: 'recent_posts' }<?php foreach ( $taxonomy_objects as $key => $object ) :  ?>,{ text: '<?php echo $object->label; ?>', value: '<?php echo $key; ?>' }<?php endforeach; ?>];
	</script>
	<?php
}
add_action('admin_head', 'my_custom_js');