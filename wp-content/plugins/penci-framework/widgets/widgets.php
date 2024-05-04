<?php

require PENCI_ADDONS_DIR . 'widgets/widget-custom-html.php';
require PENCI_ADDONS_DIR . 'widgets/general-fields.php';

add_action( 'widgets_init', 'penci_register_widgets' );
/**
 * Register widgets
 */
function penci_register_widgets()
{

	register_widget( 'Penci_Widget_Custom_HTML' );
	// Visual Composer Addons
	if ( ! defined( 'WPB_VC_VERSION' ) ) {
		return;
	}

	$disable_shortcode = get_theme_mod( 'pennews_shortcode_manage' );
	$disable_shortcode = $disable_shortcode ? (array) $disable_shortcode : array();

	if ( ! in_array( 'block_6', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Block_6' );
	}
	if ( ! in_array( 'block_7', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Block_7' );
	}
	if ( ! in_array( 'block_10', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Block_10' );
	}
	if ( ! in_array( 'block_11', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Block_11' );
	}
	if ( ! in_array( 'block_15', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Block_15' );
	}
	if ( ! in_array( 'block_16', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Block_16' );
	}
	if ( ! in_array( 'block_23', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Block_23' );
	}
	if ( ! in_array( 'block_25', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Block_25' );
	}
	if ( ! in_array( 'social_counter', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Social_Counter' );
	}
	if ( ! in_array( 'ad_box', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Ad_Box' );
	}
	if ( ! in_array( 'authors_box', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Authors_Box' );
	}
	if ( ! in_array( 'popular_category', $disable_shortcode ) ) {
		register_widget( 'Penci_WidgetPopular_Categories' );
	}
	if ( ! in_array( 'pinterest', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Pinterest' );
	}
	if ( ! in_array( 'latest_tweets', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Latest_Tweets' );
	}
	if ( ! in_array( 'facebook_page', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Facebook_Page' );
	}
	if ( ! in_array( 'about_us', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_About_Us' );
	}
	if ( ! in_array( 'videos_playlist', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Videos_Playlist' );
	}
	if ( ! in_array( 'weather', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Weather' );
	}
	if ( ! in_array( 'login_form', $disable_shortcode ) ) {
		register_widget( 'Penci_Widget_Login_Form' );
	}

	if( class_exists( 'Penci_Reivew_Template' ) && ! in_array( 'recent_review', $disable_shortcode ) ){
		register_widget( 'Penci_Widget_Recent_Reviews' );
	}

}

class Penci_Widget_Login_Form extends Penci_Framework_Widget {
	var $block_id = 'login_form';
}

class Penci_Widget_Videos_Playlist extends Penci_Framework_Widget {
	var $block_id = 'videos_playlist';
}

class Penci_Widget_Weather extends Penci_Framework_Widget {
	var $block_id = 'weather';
}

class Penci_Widget_About_Us extends Penci_Framework_Widget {
	var $block_id = 'about_us';
}

class Penci_Widget_Block_6 extends Penci_Framework_Widget {
	var $block_id = 'block_6';
}

class Penci_Widget_Block_7 extends Penci_Framework_Widget {
	var $block_id = 'block_7';
}

class Penci_Widget_Block_10 extends Penci_Framework_Widget {
	var $block_id = 'block_10';
}

class Penci_Widget_Block_11 extends Penci_Framework_Widget {
	var $block_id = 'block_11';
}

class Penci_Widget_Block_15 extends Penci_Framework_Widget {
	var $block_id = 'block_15';
}
class Penci_Widget_Block_16 extends Penci_Framework_Widget {
	var $block_id = 'block_16';
}

class Penci_Widget_Block_23 extends Penci_Framework_Widget {
	var $block_id = 'block_23';
}

class Penci_Widget_Block_25 extends Penci_Framework_Widget {
	var $block_id = 'block_25';
}

class Penci_Widget_Social_Counter extends Penci_Framework_Widget {
	var $block_id = 'social_counter';
}

class Penci_Widget_Ad_Box extends Penci_Framework_Widget {
	var $block_id = 'ad_box';
}

class Penci_Widget_Authors_Box extends Penci_Framework_Widget {
	var $block_id = 'authors_box';
}

class Penci_WidgetPopular_Categories extends Penci_Framework_Widget {
	var $block_id = 'popular_category';
}

class Penci_Widget_Pinterest extends Penci_Framework_Widget {
	var $block_id = 'pinterest';
}
class Penci_Widget_Latest_Tweets extends Penci_Framework_Widget {
	var $block_id = 'latest_tweets';
}
class Penci_Widget_Facebook_Page extends Penci_Framework_Widget {
	var $block_id = 'facebook_page';
}

class Penci_Widget_Recent_Reviews extends Penci_Framework_Widget {
	var $block_id = 'recent_review';
}

