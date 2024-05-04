<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'penci_recipe_the_content', 'wptexturize'                       );
add_filter( 'penci_recipe_the_content', 'convert_smilies',               20 );
add_filter( 'penci_recipe_the_content', 'wpautop'                           );
add_filter( 'penci_recipe_the_content', 'shortcode_unautop'                 );
add_filter( 'penci_recipe_the_content', 'prepend_attachment'                );
add_filter( 'penci_recipe_the_content', 'wp_make_content_images_responsive' );

/**
 * Penci Recipe Shortcode
 * Use penci_recipe to display the recipe on single a post
 */
if( ! function_exists( 'penci_pennews_recipe_shortcode_function' ) ) {
	function penci_pennews_recipe_shortcode_function( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'id' => ''
		), $atts ) );

		$recipe_id = get_the_ID();
		if ( ! empty( $id ) && is_numeric( $id ) ) {
			$recipe_id = $id;
		}

		// Get recipe meta
		$penci_recipe = get_post_meta( $recipe_id, 'penci_recipe', true );

		// Use get_post_meta to retrieve an existing value from the database.
		$recipe_title          = isset( $penci_recipe['penci_recipe_title'] ) ? $penci_recipe['penci_recipe_title'] : '';
		$recipe_servings       = isset( $penci_recipe['penci_recipe_servings'] ) ? $penci_recipe['penci_recipe_servings'] : '';
		$recipe_preptime       = isset( $penci_recipe['penci_recipe_preptime'] ) ? $penci_recipe['penci_recipe_preptime'] : '';
		$recipe_preptime_fm    = isset( $penci_recipe['penci_recipe_preptime_format'] ) ? $penci_recipe['penci_recipe_preptime_format'] : '';
		$recipe_cooktime       = isset( $penci_recipe['penci_recipe_cooktime'] ) ? $penci_recipe['penci_recipe_cooktime'] : '';
		$recipe_cooktime_fm    = isset( $penci_recipe['penci_recipe_cooktime_format'] ) ? $penci_recipe['penci_recipe_cooktime_format'] : '';
		$penci_recipe_calories = isset( $penci_recipe['penci_recipe_calories'] ) ? $penci_recipe['penci_recipe_calories'] : 200;
		$penci_recipe_fat      = isset( $penci_recipe['penci_recipe_fat'] ) ? $penci_recipe['penci_recipe_fat'] : '20 grams';
		$recipe_ingredients    = isset( $penci_recipe['penci_recipe_ingredients'] ) ? $penci_recipe['penci_recipe_ingredients'] : '';
		$recipe_instructions   = isset( $penci_recipe['penci_recipe_instructions'] ) ? $penci_recipe['penci_recipe_instructions'] : '';
		$recipe_note           = isset( $penci_recipe['penci_recipe_note'] ) ? $penci_recipe['penci_recipe_note'] : '';

		if( ! metadata_exists('post', $recipe_id, 'penci_recipe_rate_total') ){
			add_post_meta( $recipe_id, 'penci_recipe_rate_total', '5' );
		}
		if( ! metadata_exists('post', $recipe_id, 'penci_recipe_rate_people') ){
			add_post_meta( $recipe_id, 'penci_recipe_rate_people', '1' );
		}

		$rate_total          = get_post_meta( $recipe_id, 'penci_recipe_rate_total', true );
		$rate_people         = get_post_meta( $recipe_id, 'penci_recipe_rate_people', true );

		// Turn ingredients into an array
		$recipe_ingredients_array = '';
		if( $recipe_ingredients ):
			$recipe_ingredients_array = preg_split( '/\r\n|[\r\n]/', $recipe_ingredients );
		endif;

		// Rate number
		$rate_number = 5;
		if( $rate_total && $rate_people ){
			$rate_number = number_format( intval( $rate_total ) / intval( $rate_people ), 1 );
		}
		$allow_rate = 1;
		if( isset( $_COOKIE[ 'recipe_rate_postid_'.$recipe_id ] ) ){
			$allow_rate = 0;
		}

		$rand = rand(100, 9999);
		wp_enqueue_script('jquery-recipe-print');

		$excerpt = penci_recipe_get_the_excerpt();
		if( ! $excerpt ){
			$excerpt = get_the_title();
		}

		$thumb_alt = $thumb_title_html = '';
		if( has_post_thumbnail( $recipe_id ) && function_exists( 'penci_get_image_title' ) ){
			$thumb_id = get_post_thumbnail_id( $recipe_id );

			$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
			if( ! $thumb_alt && $recipe_id ) {
				$thumb_alt = wp_strip_all_tags( get_the_title( $recipe_id ) );
			}

			$thumb_alt = esc_attr( $thumb_alt );
			$thumb_title_html = penci_get_image_title( $thumb_id );
		}

		ob_start(); ?>

		<div class="wrapper-penci-recipe">
			<div class="penci-recipe" id="printrepcipe<?php echo $rand; ?>">
				<div class="penci-recipe-heading">
					<?php if ( has_post_thumbnail( $recipe_id ) && ! get_theme_mod('penci_recipe_featured_image') ): ?>
						<div class="penci-recipe-thumb">
							<img src="<?php echo get_the_post_thumbnail_url( $recipe_id, 'thumbnail' ); ?>" alt="<?php echo $thumb_alt; ?>"<?php echo $thumb_title_html; ?> width="150" height="150" />
						</div>
					<?php endif; ?>
					<div class="penci-recipe-metades">
					<?php if ( $recipe_title ) : ?>
						<h2><?php echo $recipe_title; ?></h2>
					<?php endif; ?>
					<span style="display: none !important;"><?php echo get_the_author(); ?></span>
					<?php if ( has_post_thumbnail() ): ?>
					<img src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" style="display: none !important;"/>
					<?php endif; ?>
					<span style="display: none !important;"><?php echo $excerpt; ?></span>
					<?php if ( ! get_theme_mod( 'penci_recipe_print' ) ) : ?>
						<a href="#" class="penci-recipe-print" data-print="<?php echo plugin_dir_url( __FILE__ ) . ( is_rtl() ? 'print-rtl
						.css?ver=2.3' : 'print.css?ver=2.3' ); ?>"><i class="fa fa-print"></i> <?php if( get_theme_mod( 'penci_recipe_print_text' ) ) { echo get_theme_mod( 'penci_recipe_print_text' ); } else { esc_html_e( 'Print This', 'pennews' ); } ?></a>
					<?php endif; ?>

					<?php if ( $recipe_servings || $recipe_cooktime || $recipe_preptime ) : ?>
						<div class="penci-recipe-meta">
							<?php if ( $recipe_servings ) : ?><span>
								<i class="fa fa-user"></i> <?php if( get_theme_mod( 'penci_recipe_serves_text' ) ) { echo get_theme_mod( 'penci_recipe_serves_text' ); } else { esc_html_e( 'Serves', 'pennews' ); } ?>: <span class="servings"><?php echo $recipe_servings; ?></span>
								</span>
							<?php endif; ?>
							<?php if ( $recipe_preptime ) : ?>
								<span>
							<i class="fa fa-clock-o"></i> <?php if( get_theme_mod( 'penci_recipe_prep_time_text' ) ) { echo get_theme_mod( 'penci_recipe_prep_time_text' ); } else { esc_html_e( 'Prep Time', 'soledad' ); } ?>: <time <?php if( $recipe_preptime_fm ): echo 'datetime="PT'. $recipe_preptime_fm .'" '; endif;?>><?php echo $recipe_preptime; ?></time>
							</span>
							<?php endif; ?>
							<?php if ( $recipe_cooktime ) : ?>
								<span>
							<i class="fa fa-clock-o"></i> <?php if( get_theme_mod( 'penci_recipe_cooking_text' ) ) { echo get_theme_mod( 'penci_recipe_cooking_text' ); } else { esc_html_e( 'Cooking Time', 'soledad' ); } ?>: <time <?php if( $recipe_cooktime_fm ): echo 'datetime="PT'. $recipe_cooktime_fm .'" '; endif;?>><?php echo $recipe_cooktime; ?></time>
							</span>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<div class="penci-recipe-rating penci-nutrition<?php if( ! get_theme_mod( 'penci_recipe_nutrition' ) ): echo ' penci-hide-nutrition'; endif; ?>">
						<span class="nutrition-lable"><?php if( get_theme_mod( 'penci_recipe_nutrition_text' ) ) { echo do_shortcode( get_theme_mod( 'penci_recipe_nutrition_text' ) ); } else { esc_html_e( 'Nutrition facts:', 'soledad' ); } ?></span>
						<span class="nutrition-item<?php if( get_theme_mod( 'penci_recipe_calories' ) ): echo ' penci-hide-nutrition'; endif; ?>"><?php echo $penci_recipe_calories . ' '; if( get_theme_mod( 'penci_recipe_calories_text' ) ) { echo do_shortcode( get_theme_mod( 'penci_recipe_calories_text' ) ); } else { esc_html_e( 'calories', 'soledad' ); } ?></span>
						<span class="nutrition-item<?php if( get_theme_mod( 'penci_recipe_fat' ) ): echo ' penci-hide-nutrition'; endif; ?>"><?php echo $penci_recipe_fat . ' '; if( get_theme_mod( 'penci_recipe_fat_text' ) ) { echo do_shortcode( get_theme_mod( 'penci_recipe_fat_text' ) ); } else { esc_html_e( 'fat', 'soledad' ); } ?></span>
					</div>
					<?php if ( ! get_theme_mod( 'penci_recipe_rating' ) ) : ?>
						<div class="penci-recipe-rating penci-recipe-review">
						<span class="penci-rate-text">
							<?php if( get_theme_mod( 'penci_recipe_rating_text' ) ) { echo do_shortcode( get_theme_mod( 'penci_recipe_rating_text' ) ) . ' '; } else { esc_html_e( 'Rating: ', 'soledad' ); } ?>
							<span class="penci-rate-number"><?php echo $rate_number; ?></span>/5
						</span>
							<div class="penci_rateyo" id="penci_rateyo" data-allow="<?php esc_attr_e( $allow_rate )?>" data-rate="<?php esc_attr_e( $rate_number );?>" data-postid="<?php esc_attr_e( $recipe_id );?>" data-people="<?php echo $rate_people; ?>" data-total="<?php echo $rate_total; ?>"></div>
							<span class="penci-numbers-rate">( <span class="penci-number-people"><?php echo $rate_people; ?></span> <?php if( get_theme_mod( 'penci_recipe_voted_text' ) ) { echo do_shortcode( get_theme_mod( 'penci_recipe_voted_text' ) ); } else {esc_html_e( 'voted', 'soledad' ); } ?> )</span>
						</div>
					<?php endif; ?>
					</div>
				</div>

				<?php if ( $recipe_ingredients ) : ?>
					<div class="penci-recipe-ingredients<?php if( get_theme_mod( 'penci_recipe_ingredients_visual' ) ): echo ' penci-recipe-ingre-visual'; endif; ?>">
						<h3 class="penci-recipe-title"><?php if( get_theme_mod( 'penci_recipe_ingredients_text' ) ) { echo get_theme_mod( 'penci_recipe_ingredients_text' ); } else { esc_html_e( 'Ingredients', 'soledad' ); } ?></h3>
						<?php if( ! get_theme_mod( 'penci_recipe_ingredients_visual' ) ){ ?>
							<ul>
								<?php foreach ( $recipe_ingredients_array as $ingredient ) : ?>
									<?php if ( $ingredient ) :
										$trim_ingre = trim($ingredient);
										$trim_ing = substr( $trim_ingre, 0, 2 );
										if( $trim_ing == '==' ){
											?>
											<h3 class="recipe-ingredient-heading"><?php echo substr( $ingredient, 2 ); ?></h3>
											<?php
										} else {
											?>
											<li><span><?php echo $ingredient; ?></span></li>
										<?php } ?>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						<?php } else { ?>
							<?php
							echo apply_filters( 'penci_recipe_the_content', htmlspecialchars_decode( $recipe_ingredients ) );
							?>
						<?php } ?>
					</div>
				<?php endif; ?>

				<?php if ( $recipe_instructions ) : ?>
					<div class="penci-recipe-method">
						<h3 class="penci-recipe-title"><?php if( get_theme_mod( 'penci_recipe_instructions_text' ) ) { echo get_theme_mod( 'penci_recipe_instructions_text' ); } else { esc_html_e( 'Instructions', 'soledad' ); } ?></h3>
						<?php
						echo apply_filters( 'penci_recipe_the_content', htmlspecialchars_decode( $recipe_instructions ) );
						?>
					</div>
				<?php endif; ?>

				<?php if ( $recipe_note ) : ?>
					<div class="penci-recipe-notes">
						<h3 class="penci-recipe-title"><?php if( get_theme_mod( 'penci_recipe_notes_text' ) ) { echo get_theme_mod( 'penci_recipe_notes_text' ); } else { esc_html_e( 'Notes', 'soledad' ); } ?></h3>
						<p><?php echo $recipe_note; ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}

add_shortcode( 'penci_recipe', 'penci_pennews_recipe_shortcode_function' );

if( ! function_exists( 'penci_recipe_get_the_excerpt' ) ):
function penci_recipe_get_the_excerpt( $post = null ) {
	if ( function_exists( 'is_bool' ) && is_bool( $post ) ) {
		return '';
	}

	$post = get_post( $post );
	if ( empty( $post ) ) {
		return '';
	}

	if ( function_exists( 'post_password_required' ) && post_password_required( $post ) ) {
		return __( 'There is no excerpt because this is a protected post.' );
	}

	if( $post->post_excerpt ) {
		$text = $post->post_excerpt;
		$raw_excerpt = $text;

		if ( '' == $text ) {
			$text           = get_the_content( '' );
			$text           = strip_shortcodes( $text );
			$text           = excerpt_remove_blocks( $text );
			$text           = str_replace( ']]>', ']]&gt;', $text );
			$excerpt_length = apply_filters( 'excerpt_length', 55 );
			$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
			$text           = wp_trim_words( $text, $excerpt_length, $excerpt_more );
		}
		return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
	}

	return '';
}
add_filter( 'penci_recipe_get_the_excerpt', 'penci_recipe_trim_excerpt'  );
endif;
/**
 * Penci Recipe Index
 *
 * Use penci_index to display the recipe on single a post
 */
if( ! function_exists( 'penci_pennews_recipe_index_function' ) ) {
	function penci_pennews_recipe_index_function( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'         => '',
			'cat'           => '',
			'numbers_posts' => '',
			'columns'       => '',
			'display_title' => 'yes',
			'display_cat'   => 'no',
			'primary_cat'   => 'yes',
			'display_date'  => 'yes',
			'display_image' => 'yes',
			'image_size'    => 'square',
			'cat_link'      => 'yes',
			'cat_link_text' => 'View All'
		), $atts ) );


		$index_title         = isset( $title ) ? $title : '';
		$index_cat           = isset( $cat ) ? $cat : '';
		$index_numbers_posts = isset( $numbers_posts ) ? $numbers_posts : '3';
		$index_cols          = isset( $columns ) ? $columns : '3';
		$index_display_title = isset( $display_title ) ? $display_title : 'yes';
		$index_display_cat   = isset( $display_cat ) ? $display_cat : 'no';
		$index_primary_cat   = isset( $primary_cat ) ? $primary_cat : 'yes';
		$index_display_date  = isset( $display_date ) ? $display_date : 'yes';
		$index_display_image = isset( $display_image ) ? $display_image : 'yes';
		$index_image_size    = isset( $image_size ) ? $image_size : 'square';
		$index_cat_link      = isset( $cat_link ) ? $cat_link : 'yes';
		$index_cat_text      = isset( $cat_link_text ) ? $cat_link_text : 'View All';

		$index_query = new WP_Query( array(
			'category_name'       => $index_cat,
			'posts_per_page'      => $index_numbers_posts,
			'ignore_sticky_posts' => true
		) );

		ob_start();

		$cat_link   = '';
		$open_link  = '';
		$close_link = '';
		if ( $index_cat ) :
			$index_cat = do_shortcode( $index_cat );
			$catOj     = get_category_by_slug( $index_cat );
			$cat_id    = isset( $catOj->term_id ) ? $catOj->term_id : '';
			$cat_link  = get_category_link( $cat_id );
		endif;

		if ( $index_cat_link == "yes" && $cat_link ):
			$open_link  = '<a href="' . esc_url( $cat_link ) . '">';
			$close_link = '</a>';
		endif;
		?>

		<?php if ( $index_query->have_posts() ) : ?>
			<div class="penci-recipe-index-wrap">
				<?php if ( $index_title ) : ?>
					<h4 class="recipe-index-heading">
						<span><?php echo $open_link . do_shortcode( $index_title ) . $close_link; ?></span>
						<?php if ( $index_cat_link == "yes" && $cat_link ) : ?>
							<a class="penci-index-more-link" href="<?php echo esc_url( $cat_link ); ?>"><?php echo do_shortcode( $index_cat_text ); ?> <i class="fa fa-angle-double-right"></i></a>
						<?php endif; ?>
					</h4>
				<?php endif; ?>

				<?php $columns_class = intval( 12 / $index_cols ); ?>
				<div class="penci-recipe-index penci-row">
					<?php while ( $index_query->have_posts() ) : $index_query->the_post(); ?>
						<div class="penci-recipe-index-item penci__general-meta penci-col-<?php echo esc_attr( $columns_class ); ?>">
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'penci-recipe-item  penci-imgtype-' . $index_image_size ); ?>>
								<?php if ( $index_display_image != 'no' ) : ?>
									<div class="penci-index-post-img">
										<?php
										if( 'true' == $atts['wpblock'] ){
											echo Penci_Helper_Shortcode::get_image_holder( array(
												'image_type' => $index_image_size,
												'use_penci_lazy' => false
											) );
										}else{
											echo Penci_Helper_Shortcode::get_image_holder( array( 'image_type' => $index_image_size ) );
										}
										?>
										<?php  ?>
									</div>
								<?php endif; /* End check for thumbnails */ ?>

								<?php
								if ( $index_display_cat == 'yes' ){

									if( $index_primary_cat == 'yes' ) {
										$category   = get_the_category();
										if ( class_exists( 'WPSEO_Primary_Term' ) ) {
											$category   = get_the_category();
											// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
											$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
											$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
											$term               = get_term( $wpseo_primary_term );
											if ( is_wp_error( $term ) ) {
												// Default to first category (not Yoast) if an error is returned
												$category_display = $category[0]->name;
												$category_link    = get_category_link( $category[0]->term_id );
											} else {
												// Yoast Primary category
												$category_display = $term->name;
												$category_link    = get_category_link( $term->term_id );
											}
										} else {
											// Default, display the first category in WP's list of assigned categories
											$category_display = $category[0]->name;
											$category_link    = get_category_link( $category[0]->term_id );
										}

										echo '<span class="penci-cat-links">';
										echo '<a href="' . esc_attr( $category_link ) . '">' . esc_html( $category_display ) . '</a>';
										echo '</span>';
									}else{
										penci_get_categories();
									}

								}
								?>
								<?php if ( $index_display_title != 'no' ) : ?>
									<h3 class="penci-recipe-index-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php endif; ?>

								<?php if ( $index_display_date != 'no' ) : ?>
									<span class="penci_post-meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
								<?php endif; ?>
							</article>
						</div>
					<?php endwhile; ?>
				</div>

			</div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
		<?php
		return ob_get_clean();
	}
}

add_shortcode( 'penci_index', 'penci_pennews_recipe_index_function' );
