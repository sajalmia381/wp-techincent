<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Adds Penci review meta box to the post editing screen
 */
if ( ! function_exists( 'Penci_Review_Add_Custom_Metabox' ) ) {
	function Penci_Review_Add_Custom_Metabox() {
		new Penci_Review_Add_Custom_Metabox_Class();
	}
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'Penci_Review_Add_Custom_Metabox' );
	add_action( 'load-post-new.php', 'Penci_Review_Add_Custom_Metabox' );
}

/**
 * The Class.
 */
if ( ! class_exists( 'Penci_Review_Add_Custom_Metabox_Class' ) ) {
	class Penci_Review_Add_Custom_Metabox_Class {

		/**
		 * Hook into the appropriate actions when the class is constructed.
		 */
		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );
		}

		/**
		 * Adds the meta box container.
		 */
		public function add_meta_box( $post_type ) {
			$post_types = array( 'post' );
			if ( in_array( $post_type, $post_types ) ) {
				add_meta_box(
					'penci_review_meta'
					, esc_html__( 'Add A Review For This Posts', 'penci' )
					, array( $this, 'render_meta_box_content' )
					, $post_type
					, 'advanced'
					, 'default'
				);
			}
		}

		/**
		 * Save the meta when the post is saved.
		 *
		 * @param int $post_id The ID of the post being saved.
		 */
		public function save( $post_id ) {
			/*
			 * We need to verify this came from the our screen and with proper authorization,
			 * because save_post can be triggered at other times.
			 */

			// Check if our nonce is set.
			if ( ! isset( $_POST['penci_review_custom_box_nonce'] ) ) {
				return $post_id;
			}

			$nonce = $_POST['penci_review_custom_box_nonce'];

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, 'penci_review_custom_box' ) ) {
				return $post_id;
			}

			// If this is an autosave, our form has not been submitted,
			//     so we don't want to do anything.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}

			// Check the user's permissions.
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}

			$total_score = 0;
			$total_num   = 0;

			$remove_review_old    = isset( $_POST['penci_remove_review_old'] ) ? $_POST['penci_remove_review_old'] : '';
			update_post_meta( $post_id, 'penci_remove_review_old', $remove_review_old );

			if( isset( $_POST['penci_review_schema_options'] ) ) {
				update_post_meta( $post_id, 'penci_review_schema_options', $_POST['penci_review_schema_options'] );
			}

			$penci_review = array(
				'penci_review_style' => isset( $_POST['penci_review_style'] ) ? $_POST['penci_review_style'] : '',
				'penci_review_title' => isset( $_POST['penci_review_title'] ) ? $_POST['penci_review_title'] : '',
				'penci_review_des'   => isset( $_POST['penci_review_des'] ) ? $_POST['penci_review_des'] : '',
				'penci_review_good'  => isset( $_POST['penci_review_good'] ) ? $_POST['penci_review_good'] : '',
				'penci_review_bad'   => isset( $_POST['penci_review_bad'] ) ? $_POST['penci_review_bad'] : '',

				'penci_review_ct_image'      => isset( $_POST['penci_review_custom_image'] ) ? $_POST['penci_review_custom_image'] : '',
				'penci_review_address'       => isset( $_POST['penci_review_address'] ) ? $_POST['penci_review_address'] : '',
				'penci_review_phone'         => isset( $_POST['penci_review_phone'] ) ? $_POST['penci_review_phone'] : '',
				'penci_review_website'       => isset( $_POST['penci_review_website'] ) ? $_POST['penci_review_website'] : '',
				'penci_review_price'         => isset( $_POST['penci_review_price'] ) ? $_POST['penci_review_price'] : '',
				'penci_review_linkbuy'       => isset( $_POST['penci_review_linkbuy'] ) ? $_POST['penci_review_linkbuy'] : '',
				'penci_review_textbuy'       => isset( $_POST['penci_review_textbuy'] ) ? $_POST['penci_review_textbuy'] : '',
				'penci_review_schema_markup' => isset( $_POST['penci_review_schema_markup'] ) ? $_POST['penci_review_schema_markup'] : 'thing',
				'penci_review_img_size'      => isset( $_POST['penci_review_img_size'] ) ? $_POST['penci_review_img_size'] : 'thing',

				'penci_user_review_enable'   => isset( $_POST['penci_user_review_enable'] ) ? $_POST['penci_user_review_enable'] : '',
				'penci_rv_dis_point'         => isset( $_POST['penci_rv_dis_point'] ) ? $_POST['penci_rv_dis_point'] : '',
				'penci_rv_dis_goodbad'       => isset( $_POST['penci_rv_dis_goodbad'] ) ? $_POST['penci_rv_dis_goodbad'] : '',
				'penci_rv_dis_desc'          => isset( $_POST['penci_rv_dis_desc'] ) ? $_POST['penci_rv_dis_desc'] : '',
				'penci_rv_enable_sim_author' => isset( $_POST['penci_rv_enable_sim_author'] ) ? $_POST['penci_rv_enable_sim_author'] : '',
				'penci_rv_hide_featured_img' => isset( $_POST['penci_rv_hide_featured_img'] ) ? $_POST['penci_rv_hide_featured_img'] : '',
				'penci_rv_show_schema'       => isset( $_POST['penci_rv_show_schema'] ) ? $_POST['penci_rv_show_schema'] : '',
			);

			if( ! $remove_review_old ){
				$review_1    = isset( $_POST['penci_review_1'] ) ? $_POST['penci_review_1'] : '';
				$review_1num = isset( $_POST['penci_review_1_num'] ) ? $_POST['penci_review_1_num'] : '';
				$review_2    = isset( $_POST['penci_review_2'] ) ? $_POST['penci_review_2'] : '';
				$review_2num = isset( $_POST['penci_review_2_num'] ) ? $_POST['penci_review_2_num'] : '';
				$review_3    = isset( $_POST['penci_review_3'] ) ? $_POST['penci_review_3'] : '';
				$review_3num = isset( $_POST['penci_review_3_num'] ) ? $_POST['penci_review_3_num'] : '';
				$review_4    = isset( $_POST['penci_review_4'] ) ? $_POST['penci_review_4'] : '';
				$review_4num = isset( $_POST['penci_review_4_num'] ) ? $_POST['penci_review_4_num'] : '';
				$review_5    = isset( $_POST['penci_review_5'] ) ? $_POST['penci_review_5'] : '';
				$review_5num = isset( $_POST['penci_review_5_num'] ) ? $_POST['penci_review_5_num'] : '';

				$penci_review['penci_review_1']     = $review_1;
				$penci_review['penci_review_1_num'] = $review_1num;
				$penci_review['penci_review_2']     = $review_2;
				$penci_review['penci_review_2_num'] = $review_2num;
				$penci_review['penci_review_3']     = $review_3;
				$penci_review['penci_review_3_num'] = $review_3num;
				$penci_review['penci_review_4']     = $review_4;
				$penci_review['penci_review_4_num'] = $review_4num;
				$penci_review['penci_review_5']     = $review_5;
				$penci_review['penci_review_5_num'] = $review_5num;

				if ( $review_1 && $review_1num ):
					$total_score = $total_score + $review_1num;
					$total_num   = $total_num + 1;
				endif;

				if ( $review_2 && $review_2num ):
					$total_score = $total_score + $review_2num;
					$total_num   = $total_num + 1;
				endif;

				if ( $review_3 && $review_3num ):
					$total_score = $total_score + $review_3num;
					$total_num   = $total_num + 1;
				endif;

				if ( $review_4 && $review_4num ):
					$total_score = $total_score + $review_4num;
					$total_num   = $total_num + 1;
				endif;

				if ( $review_5 && $review_5num ):
					$total_score = $total_score + $review_5num;
					$total_num   = $total_num + 1;
				endif;
			}


			update_post_meta( $post_id, 'penci_review', $penci_review );

			if( isset( $_POST['penci_review_more'] ) && $_POST['penci_review_more'] ) {
				$penci_review_more = $_POST['penci_review_more'];
				update_post_meta( $post_id,'penci_review_more',$_POST['penci_review_more'] );

				foreach ( (array)$penci_review_more as $review_more ){
					if( ! isset( $review_more['number'] ) ) {
						continue;
					}
					$total_score = $total_score + intval( $review_more['number'] );
					$total_num   = $total_num + 1;
				}
			}

			if ( $total_score && $total_num ) {
				update_post_meta( $post_id, 'penci_total_review', ( $total_score / $total_num ) );
			}
		}


		/**
		 * Render Meta Box content.
		 *
		 * @param WP_Post $post The post object.
		 */
		public function render_meta_box_content( $post ) {

			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'penci_review_custom_box', 'penci_review_custom_box_nonce' );

			// Use get_post_meta to retrieve an existing value from the database.
			$penci_review = get_post_meta( $post->ID, 'penci_review', true );

			$review_style    = isset( $penci_review['penci_review_style'] ) ? $penci_review['penci_review_style'] : '';
			$review_title    = isset( $penci_review['penci_review_title'] ) ? $penci_review['penci_review_title'] : '';
			$review_des      = isset( $penci_review['penci_review_des'] ) ? $penci_review['penci_review_des'] : '';
			$review_good     = isset( $penci_review['penci_review_good'] ) ? $penci_review['penci_review_good'] : '';
			$review_bad      = isset( $penci_review['penci_review_bad'] ) ? $penci_review['penci_review_bad'] : '';
			$review_address  = isset( $penci_review['penci_review_address'] ) ? $penci_review['penci_review_address'] : '';
			$review_phone    = isset( $penci_review['penci_review_phone'] ) ? $penci_review['penci_review_phone'] : '';
			$review_website  = isset( $penci_review['penci_review_website'] ) ? $penci_review['penci_review_website'] : '';
			$review_price    = isset( $penci_review['penci_review_price'] ) ? $penci_review['penci_review_price'] : '';
			$review_linkbuy  = isset( $penci_review['penci_review_linkbuy'] ) ? $penci_review['penci_review_linkbuy'] : '';
			$review_textbuy  = isset( $penci_review['penci_review_textbuy'] ) ? $penci_review['penci_review_textbuy'] : '';
			$schema_value    = isset( $penci_review['penci_review_schema_markup'] ) ? $penci_review['penci_review_schema_markup'] : 'thing';
			$review_img_size = isset( $penci_review['penci_review_img_size'] ) ? $penci_review['penci_review_img_size'] : '';

			$review_ct_image     = isset( $penci_review['penci_review_ct_image'] ) ? $penci_review['penci_review_ct_image'] : '';
			$url_review_ct_image = wp_get_attachment_thumb_url( $review_ct_image );

			$penci_review_more = get_post_meta( $post->ID, 'penci_review_more', true );
			// Display the form, using the current value.
			?>

			<div class="penci-table-meta">
				<h3>Review settings</h3>
				<p>You can display your review for this post by using the following shortcode: <span class="penci-review-shortcode">[penci_review id="<?php echo $post->ID; ?>"]</span><br>If you do not need this feature, you should go to <strong>Plugins > Installed Plugins > and deactivate plugin
						"Penci
						Review"</strong></p>
				<p>
					<label for="penci_review_style" class="penci-format-row">Review Style:</label>
					<select name="penci_review_style" id="penci_review_style">
						<option value="<?php echo esc_attr( 'style_1' ) ?>" <?php selected( $review_style, 'style_1' ) ?>><?php esc_html_e( 'Points Review','penci' ) ?></option>
						<option value="<?php echo esc_attr( 'style_2' ) ?>" <?php selected( $review_style, 'style_2' ) ?>><?php esc_html_e( 'Percent Review','penci' ) ?></option>
						<option value="<?php echo esc_attr( 'style_3' ) ?>" <?php selected( $review_style, 'style_3' ) ?>><?php esc_html_e( 'Stars Review','penci' ) ?></option>
					</select>
				</p>
				<p>
					<label for="penci_review_title" class="penci-format-row">Review Title:</label>
					<input style="width:100%;" type="text" name="penci_review_title" id="penci_review_title" value="<?php echo $review_title; ?>">
				</p>
				<div class="penci-grid-2">
					<p>
						<label for="penci_review_title" class="penci-format-row"><?php esc_html_e( 'Adress','penci' ); ?></label>
						<input style="width:100%;" type="text" name="penci_review_address" id="penci_review_address" value="<?php echo esc_attr( $review_address ); ?>">
					</p>
					<p>
						<label for="penci_review_title" class="penci-format-row"><?php esc_html_e( 'Phone','penci' ); ?></label>
						<input style="width:100%;" type="text" name="penci_review_phone" id="penci_review_phone" value="<?php echo esc_attr( $review_phone ); ?>">
					</p>
					<p>
						<label for="penci_review_title" class="penci-format-row"><?php esc_html_e( 'Website','penci' ); ?></label>
						<input style="width:100%;" type="text" name="penci_review_website" id="penci_review_website" value="<?php echo esc_attr( $review_website ); ?>">
					</p>
					<p>
						<label for="penci_review_title" class="penci-format-row"><?php esc_html_e( 'Product Price','penci' ); ?></label>
						<input style="width:100%;" type="text" name="penci_review_price" id="penci_review_price" value="<?php echo esc_attr( $review_price ); ?>">
					</p>
					<p>
						<label for="penci_review_title" class="penci-format-row"><?php esc_html_e( 'Link for Buy','penci' ); ?></label>
						<input style="width:100%;" type="text" name="penci_review_linkbuy" id="penci_review_linkbuy" value="<?php echo esc_attr( $review_linkbuy ); ?>">
					</p>
					<p>
						<label for="penci_review_title" class="penci-format-row"><?php esc_html_e( 'Custom "Buy Now" Text','penci' ); ?></label>
						<input style="width:100%;" type="text" name="penci_review_textbuy" id="penci_review_textbuy" value="<?php echo esc_attr( $review_textbuy ); ?>">
					</p>

				</div>
				<div>
					<label for="penci_review_type" class="penci-format-row"><?php esc_html_e( 'Custom Image for Reviews Box', 'penci' ); ?>:</label>
					<div class="penci-widget-image media-widget-control" style="max-width: 150px;">
						<input name="penci_review_custom_image" type="hidden" class="penci-widget-image__input" value="<?php echo esc_attr( $review_ct_image ); ?>">
						<img src="<?php echo esc_url( $url_review_ct_image ); ?>" class="penci-widget-image__image<?php echo $review_ct_image ? '' : ' hidden'; ?>">
						<div class="placeholder <?php echo( $url_review_ct_image ? 'hidden' : '' ); ?>"><?php _e( 'No image selected' ); ?></div>
						<button class="button penci-widget-image__select"><?php esc_html_e( 'Select' ); ?></button>
						<button class="button penci-widget-image__remove"><?php esc_html_e( 'Remove' ); ?></button>
					</div>
				</div>
				<div class="penci-grid-2" style="clear:both;">
					<p>
						<label for="penci_review_img_size" class="penci-format-row"><?php esc_html_e( 'Image size','penci' ); ?></label>
						<input style="width:100%;" type="text" name="penci_review_img_size" id="penci_review_img_size" value="<?php echo esc_attr( $review_img_size ); ?>">
						<span class="penci-recipe-description">Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme).</span>
					</p>
				</div>
				<?php $list_schema  = Penci_Review_Schema_Markup::get_list_schema(); ?>
				<p>
					<label for="penci_review_schema_markup" class="penci-format-row penci-format-row2"><?php esc_html_e( 'Reviewed Item Schema', 'penci' ); ?></label>
					<select name="penci_review_schema_markup" id="penci_review_schema_markup">
						<?php
						foreach ( $list_schema as $schema_type => $schema_label ) {
							echo '<option value="' . $schema_type . '" ' . selected( $schema_value, $schema_type, false ) . '>' . $schema_label . '</option>';
						}
						?>
					</select>
				</p>
				<div id="penci_review_schema_options" >
					<?php
					foreach ( $list_schema as $schema_type => $schema_label ) {
						if( 'Thing' == $schema_type || 'none' == $schema_type  ){
							continue;
						}

						Penci_Review_Schema_Markup::get_schema_filed( $schema_type, $schema_value, $post->ID  );
					}
					?>
				</div>
				<p>
					<label for="penci_review_des" class="penci-format-row">Description:</label>
					<textarea style="width:100%; height:120px;" name="penci_review_des" id="penci_review_des"><?php echo $review_des; ?></textarea>
					<span class="penci-recipe-description">You can write some description for your review here.</span>
				</p>

				<a id="pennews-add-review" class="button" href="#"><?php  esc_html_e( 'Add New Review' , 'penci' ); ?></a>
				<input type="hidden" name="penci_remove_review_old" value="1">
				<ul id="pennews-add-review-list" class="ui-sortable">
					<?php
					$penci_review_more_index = 0;

					$remove_review_old = get_post_meta( $post->ID,'penci_remove_review_old', true );

					if( ! $remove_review_old ){
						$arr_review_number = array( 'penci_review_1', 'penci_review_2', 'penci_review_3', 'penci_review_4', 'penci_review_5' );

						$review_id    = isset( $review_id ) ? $review_id : get_the_ID();
						$penci_review = get_post_meta( $review_id, 'penci_review', true );

						foreach ( $arr_review_number as $review_number_item ) {
							$penci_review_more_index ++;

							$review_1    = isset( $penci_review[ $review_number_item ] ) ? $penci_review[ $review_number_item ] : '';
							$review_1num = isset( $penci_review[ $review_number_item . '_num' ] ) ? $penci_review[ $review_number_item . '_num' ] : '';
							?>
							<li class="penci-review-item penci-review-item-<?php echo esc_attr( $penci_review_more_index ); ?>">
								<span class="penci-format-row">Review Title for Point</span>
								<input style="width:250px;" type="text" name="penci_review_more[<?php echo $penci_review_more_index; ?>][title]" value="<?php echo esc_attr( $review_1 ); ?>">
								<div class="clearfix"></div>
								<span class="penci-format-row">Review Number for Point</span>
								<input style="width:250px;" type="number" name="penci_review_more[<?php echo $penci_review_more_index; ?>][number]" value="<?php echo esc_attr( $review_1num ); ?>">
								<input type="hidden" name="penci_review_more[<?php echo $penci_review_more_index; ?>][id]" value="id_<?php echo rand( 1000, 100000000 ); ?>">
								<span class="penci-recipe-description">Minimum is 1, Maximum is 10. Example: 8</span>
								<a class="button penci-btn-remove-review"><span class="dashicons dashicons-trash"></span> Delete</a>
							</li>
							<?php
						}
					}

					if ( $penci_review_more && is_array( $penci_review_more ) ) {
						foreach ( $penci_review_more as $review_more ) {
							$penci_review_more_index ++;


							$review_more_id = isset( $review_more['id'] ) ? $review_more['id'] : 'id_' . rand( 1000, 100000000 );
							$review_more_title = isset( $review_more['title'] ) ? $review_more['title'] : '';
							$review_more_number = isset( $review_more['number'] ) ? $review_more['number'] : '';
							?>
							<li class="penci-review-item penci-review-item-<?php echo esc_attr( $penci_review_more_index ); ?>">
								<span class="penci-format-row">Review Title for Point</span>
								<input style="width:250px;" type="text" name="penci_review_more[<?php echo $penci_review_more_index; ?>][title]" value="<?php echo esc_attr( $review_more_title ); ?>">
								<div class="clearfix"></div>
								<span class="penci-format-row">Review Number for Point</span>
								<input style="width:250px;" type="number" name="penci_review_more[<?php echo $penci_review_more_index; ?>][number]" value="<?php echo esc_attr( $review_more_number ); ?>">
								<input type="hidden" name="penci_review_more[<?php echo $penci_review_more_index; ?>][id]" value="<?php echo esc_attr( $review_more_id ); ?>">
								<span class="penci-recipe-description">Minimum is 1, Maximum is 10. Example: 8</span>
								<a class="button penci-btn-remove-review"><span class="dashicons dashicons-trash"></span> Delete</a>
							</li>
							<?php
						}
					}
					?>
				</ul>
				<script>var ReviewIndex = <?php echo ( $penci_review_more_index + 1 ); ?>;</script>
				<p>
					<label for="penci_review_good" class="penci-format-row">The Goods:</label>
					<textarea style="width:100%; height:120px;" name="penci_review_good" id="penci_review_good"><?php echo $review_good; ?></textarea>
					<span class="penci-recipe-description">Type each the good on a new line.</span>
				</p>
				<p>
					<label for="penci_review_bad" class="penci-format-row">The Bads:</label>
					<textarea style="width:100%; height:120px;" name="penci_review_bad" id="penci_review_bad"><?php echo $review_bad; ?></textarea>
					<span class="penci-recipe-description">Type each the bad on a new line.</span>
				</p>

				<?php
				$list_checkbox = array(
					'penci_user_review_enable'   => esc_html__( 'Users review tab', 'penci' ),
					'penci_rv_dis_point'         => esc_html__( 'Author Review Points on [penci_review] shortcodes', 'penci' ),
					'penci_rv_dis_goodbad'       => esc_html__( 'The goods & the bads & AVERAGE SCORE on [penci_review] shortcodes', 'penci' ),
					'penci_rv_dis_desc'          => esc_html__( 'Review descriptions', 'penci' ),
					'penci_rv_enable_sim_author' => esc_html__( 'Simple Author Review', 'penci' ),
					'penci_rv_hide_featured_img' => esc_html__( 'Featured Image on Reviews Box', 'penci' ),
					'penci_rv_hide_schema'       => esc_html__( 'Show Reviewed Schema Info', 'penci' ),
				);

				foreach ( $list_checkbox as $id => $title ) {
					$checkbox_value = isset( $penci_review[$id] ) ? $penci_review[$id] : '';
					?>
					<p>
						<label for="<?php echo esc_attr( $id ); ?>" class="penci-format-row penci-format-row2"><?php echo $title; ?></label>
						<select name="<?php echo esc_attr( $id ); ?>" id="<?php echo esc_attr( $id ); ?>">
							<option value="" <?php selected( $checkbox_value, '' ) ?>><?php esc_html_e( 'Default' ) ?></option>
							<option value="enable" <?php selected( $checkbox_value, 'enable' ) ?>><?php esc_html_e( 'Enable' ) ?></option>
							<option value="disable" <?php selected( $checkbox_value, 'disable' ) ?>><?php esc_html_e( 'Disable' ) ?></option>
						</select>
					</p>
					<?php
				}
				?>
			</div>

			<?php
		}
	}
}
