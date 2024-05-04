<?php
add_action( 'widgets_init', 'penci_register_instagram_widgets' );
/**
 * Register widgets
 */
function penci_register_instagram_widgets() {

	register_widget( 'Penci_Instagram_Widget' );
}

class Penci_Instagram_Widget extends WP_Widget {

	/**
	 * Initialize the plugin by registering widget and loading public scripts
	 *
	 */
	public function __construct() {

		parent::__construct( 'penci_instagram', __( '.PenNews Instagram', 'penci-framework' ), array(
				'classname'   => 'penci-instagram',
				'description' => __( 'A widget that displays instagram images ', 'penci-framework' )
			)
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );

	}

	/**
	 * Enqueue admin side scripts and styles
	 *
	 * @param  string $hook
	 */
	public function admin_enqueue( $hook ) {

		if ( 'widgets.php' != $hook ) {
			return;
		}

		wp_enqueue_style( 'penci-insta-admin-styles', PENCI_ADDONS_URL . 'assets/css/insta-admin.css', array(), PENCI_FW_VERSION );

		wp_enqueue_script( 'penci-insta-admin-script', PENCI_ADDONS_URL . 'assets/js/insta-admin.js', array( 'jquery' ), PENCI_FW_VERSION, true );
	}

	/**
	 * The Public view of the Widget
	 *
	 * @return mixed
	 */
	public function widget( $args, $instance ) {

		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		Penci_Instagram::display_images( $instance );

		echo $after_widget;

		$instance = wp_parse_args( (array) $instance, $this->get_default() );
		$id_instagram = '#' . $args['widget_id'];
		$css_custom = '';

		if( $instance['username_color'] ) {
			$css_custom .= sprintf( '%s .penci-insta-user a{ color: %s !important; }',$id_instagram, $instance['username_color']  );
		}
		if( $instance['username_hcolor'] ) {
			$css_custom .= sprintf( '%s .penci-insta-user a:hover{ color: %s !important; }',$id_instagram, $instance['username_hcolor']  );
		}

		if( $instance['followers_color'] ) {
			$css_custom .= sprintf( '%s .penci-insta-followers{ color: %s !important; }',$id_instagram, $instance['followers_color']  );
		}
		
		$css_button_follow = $css_button_follow_hover = '';

		if( $instance['follow_color'] ) {
			$css_button_follow .= 'color: ' . $instance['follow_color'] . ' !important;';
		}

		if( $instance['follow_bgcolor'] ) {
			$css_button_follow .= 'background-color: ' . $instance['follow_bgcolor'] . ' !important;';
		}


		if( $css_button_follow ) {
			$css_custom .= sprintf( '%s .penci-insta-button{ %s }',$id_instagram, $css_button_follow  );
		}

		if( $instance['follow_hcolor'] ) {
			$css_button_follow_hover .= 'color: ' . $instance['follow_hcolor'] . ' !important;';
		}

		if( $instance['follow_bghcolor'] ) {
			$css_button_follow_hover .= 'background-color: ' . $instance['follow_bghcolor'] . ' !important;';
		}

		if( $css_button_follow_hover ) {
			$css_custom .= sprintf( '%s .penci-insta-button:hover{ %s }',$id_instagram, $css_button_follow_hover  );
		}

		if( $instance['fsize_username'] ) {
			$css_custom .= sprintf( '%s .penci-insta-user h4{ font-size: %spx }',$id_instagram, $instance['fsize_username']  );
		}
		if( $instance['username_fontfamily'] && function_exists( 'penci_google_fonts_parse_attributes' ) ) {
			$css_custom .= sprintf( '%s .penci-insta-user h4{ font-family: %s; }',$id_instagram, penci_google_fonts_parse_attributes( $instance['username_fontfamily'] )  );
		}

		if( $instance['fstyle_username'] ) {
			$css_custom .= sprintf( '%s .penci-insta-user h4{ font-weight: %s; }',$id_instagram, $instance['fstyle_username']  );
		}

		if( $instance['fsize_followers'] ) {
			$css_custom .= sprintf( '%s .penci-insta-meta{ font-size: %spx }',$id_instagram, $instance['fsize_followers']  );
		}


		if ( $css_custom ) {
			echo '<style>';
			echo $css_custom;
			echo '</style>';
		}
	}

	/**
	 * Update the widget settings
	 *
	 * @param    array $new_instance New instance values
	 * @param    array $old_instance Old instance values
	 *
	 * @return array
	 */
	public function update( $new_instance, $instance ) {
		$instance['hashtag']       = $new_instance['hashtag'];
		$instance['blocked_users'] = $new_instance['blocked_users'];
		$instance['insta_user_id'] = $new_instance['insta_user_id'];
		$instance['search_for']    = $new_instance['search_for'];

		$instance['title']              = strip_tags( $new_instance['title'] );
		$instance['username']           = $new_instance['username'];
		$instance['access_token']       = $new_instance['access_token'];
		$instance['template']           = $new_instance['template'];
		$instance['images_number']      = $new_instance['images_number'];
		$instance['columns']            = $new_instance['columns'];
		$instance['refresh_hour']       = $new_instance['refresh_hour'];
		$instance['image_size']         = $new_instance['image_size'];
		$instance['image_type']         = $new_instance['image_type'];
		$instance['onclick']            = $new_instance['onclick'];
		$instance['caption_words']      = $new_instance['caption_words'];
		$instance['speed']              = $new_instance['speed'];
		$instance['icon_size']          = $new_instance['icon_size'];
		$instance['hide_button_follow'] = isset( $new_instance['hide_button_follow'] ) && $new_instance['hide_button_follow'] ? 1 : 0;
		$instance['hide_video_icon']    = isset( $new_instance['hide_video_icon'] ) && $new_instance['hide_video_icon'] ? 1 : 0;
		$instance['hide_avatar']        = isset( $new_instance['hide_avatar'] ) && $new_instance['hide_avatar'] ? 1 : 0;
		$instance['hide_username']      = isset( $new_instance['hide_username'] ) && $new_instance['hide_username'] ? 1 : 0;
		$instance['hide_followers']     = isset( $new_instance['hide_followers'] ) && $new_instance['hide_followers'] ? 1 : 0;

		$instance['fsize_username']  = $new_instance['fsize_username'];
		$instance['username_color']  = $new_instance['username_color'];
		$instance['username_hcolor'] = $new_instance['username_hcolor'];
		$instance['fsize_followers'] = $new_instance['fsize_followers'];
		$instance['followers_color'] = $new_instance['followers_color'];
		$instance['follow_color']    = $new_instance['follow_color'];
		$instance['follow_bgcolor']  = $new_instance['follow_bgcolor'];
		$instance['follow_hcolor']   = $new_instance['follow_hcolor'];
		$instance['follow_bghcolor'] = $new_instance['follow_bghcolor'];
		$instance['username_fontfamily'] = $new_instance['username_fontfamily'];
		$instance['fstyle_username']     = $new_instance['fstyle_username'];

		return $instance;
	}


	/**
	 * Widget Settings Form
	 *
	 * @return mixed
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->get_default() );
		?>
		<div class="penci-container">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title:', 'penci-framework' ); ?></strong></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
			</p>
			<p>
				<label><?php _e( 'Username:', 'penci-framework' ); ?></label>
				<input  class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" class="inline-field-text" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e( 'Instagram Access Token:', 'penci-framework' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $instance['access_token']; ?>">
				<span class="penci-description">Please fill the Instagram Access Token here. You can get Instagram Access Token via <a href="http://pencidesign.com/penci_instagram/" target="_blank">http://pencidesign.com/penci_instagram</a></span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'insta_user_id' ); ?>"><?php _e( 'Instagram User ID', 'penci-framework' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'insta_user_id' ); ?>" name="<?php echo $this->get_field_name( 'insta_user_id' ); ?>" value="<?php echo $instance['insta_user_id']; ?>"/>
				<span class="penci-description">Please enter the User ID for this Profile ( Eg: 123456789987654321 )  You can get User ID via <a href="http://pencidesign.com/penci_instagram/" target="_blank">http://pencidesign.com/penci_instagram/</a></span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'images_number' ); ?>"><strong><?php _e( 'Number of images to show:', 'penci-framework' ); ?></strong>
					<input class="small-text" id="<?php echo $this->get_field_id( 'images_number' ); ?>" name="<?php echo $this->get_field_name( 'images_number' ); ?>" value="<?php echo $instance['images_number']; ?>"/>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'refresh_hour' ); ?>"><strong><?php _e( 'Check for new images every:', 'penci-framework' ); ?></strong>
					<input class="small-text" id="<?php echo $this->get_field_id( 'refresh_hour' ); ?>" name="<?php echo $this->get_field_name( 'refresh_hour' ); ?>" value="<?php echo $instance['refresh_hour']; ?>"/>
					<span><?php _e( 'hours', 'penci-framework' ); ?></span>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'template' ); ?>"><strong><?php _e( 'Template', 'penci-framework' ); ?></strong>
					<select class="widefat" name="<?php echo $this->get_field_name( 'template' ); ?>" id="<?php echo $this->get_field_id( 'template' ); ?>">
						<option value="slider" <?php echo ( $instance['template'] == 'slider' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Slider - Overlay Text', 'penci-framework' ); ?></option>
						<option value="thumbs" <?php echo ( $instance['template'] == 'thumbs' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Thumbnails', 'penci-framework' ); ?></option>
						<option value="thumbs-no-border" <?php echo ( $instance['template'] == 'thumbs-no-border' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Thumbnails - Without Border', 'penci-framework' ); ?></option>
					</select>
				</label>
			</p>
			<p class="<?php if ( 'thumbs' != $instance['template'] && 'thumbs-no-border' != $instance['template'] ) {
				echo 'hidden';
			} ?>">
				<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><strong><?php _e( 'Number of Columns:', 'penci-framework' ); ?></strong>
					<input class="small-text" id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" value="<?php echo $instance['columns']; ?>"/>
					<span class='penci-description'><?php _e( 'max is 10 ( only for thumbnails template )', 'penci-framework' ); ?></span>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'image_type' ); ?>"><strong><?php _e( 'Image Type', 'penci-framework' ); ?></strong></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'image_type' ); ?>" name="<?php echo $this->get_field_name( 'image_type' ); ?>">
					<option value="square" <?php echo ( $instance['image_type'] == 'square' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Square', 'penci-framework' ); ?></option>
					<option value="vertical" <?php echo ( $instance['image_type'] == 'vertical' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Vertical', 'penci-framework' ); ?></option>
					<option value="landscape" <?php echo ( $instance['image_type'] == 'landscape' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Landscape', 'penci-framework' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><strong><?php _e( 'Image Size', 'penci-framework' ); ?></strong></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
					<option value="640" <?php echo ( $instance['image_size'] == '640' ) ? ' selected="selected"' : ''; ?>><?php _e( '640 x 640', 'penci-framework' ); ?></option>
					<option value="480" <?php echo ( $instance['image_size'] == '480' ) ? ' selected="selected"' : ''; ?>><?php _e( '480 x 480', 'penci-framework' ); ?></option>
					<option value="320" <?php echo ( $instance['image_size'] == '320' ) ? ' selected="selected"' : ''; ?>><?php _e( '320 x 320', 'penci-framework' ); ?></option>
					<option value="240" <?php echo ( $instance['image_size'] == '240' ) ? ' selected="selected"' : ''; ?>><?php _e( '240 x 240', 'penci-framework' ); ?></option>
					<option value="150" <?php echo ( $instance['image_size'] == '150' ) ? ' selected="selected"' : ''; ?>><?php _e( '150 x 150', 'penci-framework' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><strong><?php _e( 'Select Icon Size', 'penci-framework' ); ?></strong></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'icon_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_size' ); ?>">
					<option value="small" <?php echo ( $instance['icon_size'] == 'small' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Small', 'penci-framework' ); ?></option>
					<option value="" <?php echo ( $instance['icon_size'] == '' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Normal', 'penci-framework' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'onclick' ); ?>"><strong><?php _e( 'On click action', 'penci-framework' ); ?></strong></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'onclick' ); ?>" name="<?php echo $this->get_field_name( 'onclick' ); ?>">
					<option value="link_image" <?php echo ( $instance['onclick'] == 'link_image' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Link to image', 'penci-framework' ); ?></option>
					<option value="lightbox" <?php echo ( $instance['onclick'] == 'lightbox' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Open Lightbox', 'penci-framework' ); ?></option>
					<option value="none" <?php echo ( $instance['onclick'] == 'none' ) ? ' selected="selected"' : ''; ?>><?php _e( 'None', 'penci-framework' ); ?></option>
				</select>
				<span class='penci-description'><?php _e( 'This option only apply to thumbnails template', 'penci-framework' ); ?></span>
			</p>
			<p>
				<input class="checkbox" type="checkbox"<?php checked( $instance['hide_video_icon'] ); ?> id="<?php echo $this->get_field_id('hide_video_icon'); ?>" name="<?php echo $this->get_field_name('hide_video_icon'); ?>" />
				<label for="<?php echo $this->get_field_id('hide_video_icon'); ?>"><?php _e('Hide Video Icon'); ?></label>
				<br/>
				<input class="checkbox" type="checkbox"<?php checked( $instance['hide_button_follow'] ); ?> id="<?php echo $this->get_field_id('hide_button_follow'); ?>" name="<?php echo $this->get_field_name('hide_button_follow'); ?>" /> <label for="<?php echo $this->get_field_id('hide_button_follow'); ?>"><?php _e('Hide button follow'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox"<?php checked( $instance['hide_avatar'] ); ?> id="<?php echo $this->get_field_id('hide_avatar'); ?>" name="<?php echo $this->get_field_name('hide_avatar'); ?>" /> <label for="<?php echo $this->get_field_id('hide_avatar'); ?>"><?php _e('Hide avatar'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox"<?php checked( $instance['hide_username'] ); ?> id="<?php echo $this->get_field_id('hide_username'); ?>" name="<?php echo $this->get_field_name('hide_username'); ?>" /> <label for="<?php echo $this->get_field_id('hide_username'); ?>"><?php _e('Hide username'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox"<?php checked( $instance['hide_followers'] ); ?> id="<?php echo $this->get_field_id('hide_followers'); ?>" name="<?php echo $this->get_field_name('hide_followers'); ?>" /> <label for="<?php echo $this->get_field_id('hide_followers'); ?>"><?php _e('Hide followers'); ?></label>
			</p>
			<p class="penci-field-item penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12">
				<label for="widget-penci-widget__block_6-1-link_filter_typography">Username settings</label>
			</p>
			<?php
				$google_fonts = function_exists( 'penci_all_fonts' ) ? penci_all_fonts() : array();
			?>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id( 'username_fontfamily' ); ?>"><strong><?php _e( 'Custom font family for Username', 'penci-framework' ); ?></strong></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'username_fontfamily' ); ?>" name="<?php echo $this->get_field_name( 'username_fontfamily' ); ?>">
				<?php  foreach ( $google_fonts as $key_font => $label_font ) : ?>
					<option value="<?php echo $key_font; ?>" <?php echo ( $instance['username_fontfamily'] == $key_font ) ? ' selected="selected"' : ''; ?>><?php echo $label_font; ?></option>
				<?php endforeach; ?>
				</select>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id( 'fstyle_username' ); ?>"><strong><?php _e( 'Custom font style for Username:', 'penci-framework' ); ?></strong></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'fstyle_username' ); ?>" name="<?php echo $this->get_field_name( 'fstyle_username' ); ?>">
					<option value="100" <?php echo ( $instance['fstyle_username'] == '100' ) ? ' selected="selected"' : ''; ?>>100</option>
					<option value="200" <?php echo ( $instance['fstyle_username'] == '200' ) ? ' selected="selected"' : ''; ?>>200</option>
					<option value="300" <?php echo ( $instance['fstyle_username'] == '300' ) ? ' selected="selected"' : ''; ?>>300</option>
					<option value="400" <?php echo ( $instance['fstyle_username'] == '400' ) ? ' selected="selected"' : ''; ?>>400</option>
					<option value="500" <?php echo ( $instance['fstyle_username'] == '500' ) ? ' selected="selected"' : ''; ?>>500</option>
					<option value="600" <?php echo ( $instance['fstyle_username'] == '600' ) ? ' selected="selected"' : ''; ?>>600</option>
					<option value="700" <?php echo ( $instance['fstyle_username'] == '700' ) ? ' selected="selected"' : ''; ?>>700</option>
					<option value="800" <?php echo ( $instance['fstyle_username'] == '800' ) ? ' selected="selected"' : ''; ?>>800</option>
					<option value="900" <?php echo ( $instance['fstyle_username'] == '900' ) ? ' selected="selected"' : ''; ?>>900</option>
				</select>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id( 'fsize_username' ); ?>"><strong><?php _e( 'Custom font size for Username:', 'penci-framework' ); ?></strong></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'fsize_username' ); ?>" name="<?php echo $this->get_field_name( 'fsize_username' ); ?>" value="<?php echo $instance['fsize_username']; ?>"/>
				<span class='penci-description'><?php _e( 'Numberic values only, unit is pixel', 'penci-framework' ); ?></span>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id('username_color'); ?>"><?php esc_html_e( 'Username color','penci-framework' ); ?></label>
				<span class="penci-picker-container">
				<input id="<?php echo esc_attr( $this->get_field_id( 'username_color' ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $this->get_field_name( 'username_color' ) ); ?>" value="<?php echo $instance['username_color']; ?>" / >
				</span>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id('username_hcolor'); ?>"><?php esc_html_e( 'Username hover color','penci-framework' ); ?></label>
				<span class="penci-picker-container">
				<input id="<?php echo esc_attr( $this->get_field_id( 'username_hcolor' ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $this->get_field_name( 'username_hcolor' ) ); ?>" value="<?php echo $instance['username_hcolor']; ?>" / >
				</span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'fsize_followers' ); ?>"><strong><?php _e( 'Custom font size of Followers:', 'penci-framework' ); ?></strong></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'fsize_followers' ); ?>" name="<?php echo $this->get_field_name( 'fsize_followers' ); ?>" value="<?php echo $instance['fsize_followers']; ?>"/>
				<span class='penci-description'><?php _e( 'Numeric values only, unit is pixel', 'penci-framework' ); ?></span>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id('followers_color'); ?>"><?php esc_html_e( 'Followers color','penci-framework' ); ?></label>
				<span class="penci-picker-container">
				<input id="<?php echo esc_attr( $this->get_field_id( 'followers_color' ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $this->get_field_name( 'followers_color' ) ); ?>" value="<?php echo $instance['followers_color']; ?>" / >
				</span>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id('follow_color'); ?>"><?php esc_html_e( 'Button follow text color','penci-framework' ); ?></label>
				<span class="penci-picker-container">
				<input id="<?php echo esc_attr( $this->get_field_id( 'follow_color' ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $this->get_field_name( 'follow_color' ) ); ?>" value="<?php echo $instance['follow_color']; ?>" / >
				</span>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id('follow_bgcolor'); ?>"><?php esc_html_e( 'Button follow border color','penci-framework' ); ?></label>
				<span class="penci-picker-container">
				<input id="<?php echo esc_attr( $this->get_field_id( 'follow_bgcolor' ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $this->get_field_name( 'follow_bgcolor' ) ); ?>" value="<?php echo $instance['follow_bgcolor']; ?>" / >
				</span>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id('follow_hcolor'); ?>"><?php esc_html_e( 'Button follow text hover color','penci-framework' ); ?></label>
				<span class="penci-picker-container">
				<input id="<?php echo esc_attr( $this->get_field_id( 'follow_hcolor' ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $this->get_field_name( 'follow_hcolor' ) ); ?>" value="<?php echo $instance['follow_hcolor']; ?>" / >
				</span>
			</p>
			<p class="penci-field-item">
				<label for="<?php echo $this->get_field_id('follow_bghcolor'); ?>"><?php esc_html_e( 'Button follow background hover color','penci-framework' ); ?></label>
				<span class="penci-picker-container">
				<input id="<?php echo esc_attr( $this->get_field_id( 'follow_bghcolor' ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $this->get_field_name( 'follow_bghcolor' ) ); ?>" value="<?php echo $instance['follow_bghcolor']; ?>" / >
				</span>
			</p>
			<div class="penci-advanced-input">
				<div class="penci-slider-options <?php if ( 'thumbs' == $instance['template'] || 'thumbs-no-border' == $instance['template'] ) {
					echo 'hidden';
				} ?>">
					<h4 class="penci-advanced-title"><?php _e( 'Advanced Slider Options', 'penci-framework' ); ?></h4>
					<p>
						<label for="<?php echo $this->get_field_id( 'caption_words' ); ?>"><?php _e( 'Number of words in caption:', 'penci-framework' ); ?>
							<input class="small-text" id="<?php echo $this->get_field_id( 'caption_words' ); ?>" name="<?php echo $this->get_field_name( 'caption_words' ); ?>" value="<?php echo $instance['caption_words']; ?>"/>
						</label>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Slide Speed:', 'penci-framework' ); ?>
							<input class="small-text" id="<?php echo $this->get_field_id( 'speed' ); ?>" name="<?php echo $this->get_field_name( 'speed' ); ?>" value="<?php echo $instance['speed']; ?>"/>
							<span><?php _e( 'milliseconds', 'penci-framework' ); ?></span>
							<span class='penci-description'><?php _e( '1000 milliseconds = 1 second', 'penci-framework' ); ?></span>
						</label>
					</p>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Selected array function echoes selected if in array
	 *
	 * @param  array $haystack The array to search in
	 * @param  string $current The string value to search in array;
	 *
	 * @return string
	 */
	public function selected( $haystack, $current ) {

		if ( is_array( $haystack ) && in_array( $current, $haystack ) ) {
			selected( 1, 1, true );
		}
	}
	
	public function get_default(){
		return array(
			'hashtag'          => '',
			'blocked_users'    => '',
			'insta_user_id'     => '',
			'search_for'       => 'username',

			'title'              => '',
			'username'           => '',
			'access_token'       => '',
			'template'           => 'thumbs-no-border',
			'images_number'      => 9,
			'columns'            => 3,
			'refresh_hour'       => 5,
			'image_size'         => '480',
			'image_type'         => 'square',
			'onclick'            => 'link_image',
			'caption_words'      => 100,
			'speed'              => 600,
			'auto_play'          => '',
			'disable_loop'       => '',
			'auto_time'          => 4000,
			'hide_button_follow' => 0,
			'hide_video_icon'    => 0,
			'icon_size'          => 'small',
			'hide_avatar'        => 0,
			'hide_username'      => 0,
			'hide_followers'     => 0,

			'fsize_username'  => '',
			'username_color'  => '',
			'username_hcolor' => '',
			'fsize_followers' => '',
			'followers_color' => '',
			'follow_color'    => '',
			'follow_bgcolor'  => '',
			'follow_hcolor'   => '',
			'follow_bghcolor' => '',
			'username_fontfamily' => 'Mukta Vaani, 200:300:400:regular:500:600:700:800, sans-serif',
			'fstyle_username' => '600'
		);
	}
}

