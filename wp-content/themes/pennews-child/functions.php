<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'penci-style-child', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ), wp_get_theme()->get( 'Version' ) );

}

/* Update post api with feature image */ 
function prepare_post_images($data, $post, $request) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnails = wp_get_attachment_image_src( $thumbnail_id, 'penci-thumb-auto-400' );
	
	$_data['feature_images'] = $thumbnails[0];
	$data->data = $_data;
	return $data;
}

add_filter('rest_prepare_post', 'prepare_post_images', 10, 3);

add_filter('rest_prepare_portfolio', 'prepare_post_images', 10, 3);


// Write by Mia, For wp-json api
add_action( 'rest_api_init', function () {
    add_action('rest_pre_serve_request', function () {
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-WP-Wpml-Language', true);
        header("Access-Control-Allow-Methods: GET, OPTIONS");
		header("Access-Control-Allow-Origin: *");
    } );
}, 15 );