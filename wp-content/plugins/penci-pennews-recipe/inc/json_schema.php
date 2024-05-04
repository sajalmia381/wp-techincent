<?php
add_action( 'penci_amp_post_template_head', 'penci_recipe_json_schema' );
add_action( 'wp_head', 'penci_recipe_json_schema' );

if ( ! function_exists( 'penci_recipe_json_schema' ) ):
	function penci_recipe_json_schema() {
		global $post;
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'penci_recipe' ) ) {
			$recipe_id = $id = get_the_ID();
			if ( ! empty( $id ) && is_numeric( $id ) ) {
				$recipe_id = $id;
			}

			$penci_recipe = get_post_meta( $recipe_id, 'penci_recipe', true );

			$recipe_title        = isset( $penci_recipe['penci_recipe_title'] ) ? $penci_recipe['penci_recipe_title'] : '';
			$recipe_servings     = isset( $penci_recipe['penci_recipe_servings'] ) ? $penci_recipe['penci_recipe_servings'] : '';
			$recipe_preptime_fm  = isset( $penci_recipe['penci_recipe_preptime_format'] ) ? $penci_recipe['penci_recipe_preptime_format'] : '';
			$recipe_cooktime_fm  = isset( $penci_recipe['penci_recipe_cooktime_format'] ) ? $penci_recipe['penci_recipe_cooktime_format'] : '';
			$recipe_calories     = isset( $penci_recipe['penci_recipe_calories'] ) ? $penci_recipe['penci_recipe_calories'] : 200;
			$recipe_fat          = isset( $penci_recipe['penci_recipe_fat'] ) ? $penci_recipe['penci_recipe_fat'] : '20 grams';
			$recipe_ingredients  = isset( $penci_recipe['penci_recipe_ingredients'] ) ? $penci_recipe['penci_recipe_ingredients'] : '';
			$recipe_instructions = isset( $penci_recipe['penci_recipe_instructions'] ) ? $penci_recipe['penci_recipe_instructions'] : '';

			$recipe_keywords      = isset( $penci_recipe['penci_recipe_keywords'] ) ? $penci_recipe['penci_recipe_keywords'] : '';
			$recipe_cuisine       = isset( $penci_recipe['penci_recipe_cuisine'] ) ? $penci_recipe['penci_recipe_cuisine'] : '';
			$recipe_videoid       = isset( $penci_recipe['penci_recipe_videoid'] ) ? $penci_recipe['penci_recipe_videoid'] : '';
			$recipe_videotitle    = isset( $penci_recipe['penci_recipe_videotitle'] ) ? $penci_recipe['penci_recipe_videotitle'] : '';
			$recipe_videoduration = isset( $penci_recipe['penci_recipe_videoduration'] ) ? $penci_recipe['penci_recipe_videoduration'] : '';
			$recipe_videodate     = isset( $penci_recipe['penci_recipe_videodate'] ) ? $penci_recipe['penci_recipe_videodate'] : '';
			$recipe_videodes      = isset( $penci_recipe['penci_recipe_videodes'] ) ? $penci_recipe['penci_recipe_videodes'] : '';

			if ( $recipe_instructions ) {
				$json_recipe_instructions = pencipennews_recipe_reverse_wpautop( $recipe_instructions );
			}

			$json_recipe_ingredients = $recipe_ingredients_array = array();
			if ( $recipe_ingredients ):
				$recipe_ingredients_trim  = wp_strip_all_tags( $recipe_ingredients );
				$recipe_ingredients_array = preg_split( '/\r\n|[\r\n]/', $recipe_ingredients_trim );
			endif;
			if ( $recipe_ingredients ) {
				if ( ! get_theme_mod( 'penci_recipe_ingredients_visual' ) ) {
					foreach ( $recipe_ingredients_array as $ingredient ) {
						if ( $ingredient ) {
							$ing_trim = trim( $ingredient );
							$str_ing  = substr( $ing_trim, 0, 2 );
							$str_echo = substr( $ing_trim, 2 );

							$json_recipe_ingredients[] = $str_ing == '==' ? $str_echo : $ingredient;
						}
					}
				} else {
					$json_recipe_ingredients[] = pencipennews_recipe_reverse_wpautop( $recipe_ingredients );
				}

			}

			$rate_number = 5;
			$rate_total  = get_post_meta( $recipe_id, 'penci_recipe_rate_total', true );
			$rate_people = get_post_meta( $recipe_id, 'penci_recipe_rate_people', true );
			if ( $rate_total && $rate_people ) {
				$rate_number = number_format( intval( $rate_total ) / intval( $rate_people ), 1 );
			}

			$excerpt = penci_recipe_get_the_excerpt();
			if ( ! $excerpt ) {
				$excerpt = get_the_title();
			}

			$json_recipe = array(
				'@context'           => 'https://schema.org/',
				'@type'              => 'Recipe',
				'name'               => $recipe_title,
				'image'              => get_the_post_thumbnail_url( $recipe_id, 'penci-thumb-square' ),
				'author'             => array(
					'@type' => 'Person',
					'name'  => pencipennews_recipe_get_post_author(),
				),
				'description'        => $excerpt,
				'datePublished'      => get_the_date( 'Y-m-d' ),
				'recipeCategory'     => pencipennews_recipe_get_post_category( $recipe_id ),
				'keywords'           => $recipe_keywords ? $recipe_keywords : wp_strip_all_tags( get_the_title() ),
				'recipeCuisine'      => $recipe_cuisine ? $recipe_cuisine : 'European',
				'recipeYield'        => $recipe_servings,
				'prepTime'           => 'PT' . $recipe_preptime_fm,
				'totalTime'          => 'PT' . $recipe_cooktime_fm,
				'cookTime'           => 'PT' . $recipe_cooktime_fm,
				'nutrition'          => array(
					'@type'      => 'NutritionInformation',
					'calories'   => $recipe_calories,
					'fatContent' => $recipe_fat,
				),
				'aggregateRating'    => array(
					'@type'       => 'AggregateRating',
					'ratingValue' => $rate_number,
					'reviewCount' => 5,
				),
				'recipeIngredient'   => $json_recipe_ingredients,
				'recipeInstructions' => $json_recipe_instructions,
				'expires'            => get_the_date( 'Y-m-d' )
			);

			if ( $recipe_videoid && $recipe_videotitle && $recipe_videoduration && $recipe_videodate && $recipe_videodes ) {
				$json_recipe['video'] = array(
					'@type'        => 'VideoObject',
					'name'         => $recipe_videotitle,
					'description'  => $recipe_videodes,
					'thumbnailUrl' => 'https://img.youtube.com/vi/' . $recipe_videoid . '/maxresdefault.jpg',
					'contentUrl'   => 'https://www.youtube.com/watch?v=' . $recipe_videoid,
					'embedUrl'     => 'https://www.youtube.com/embed/' . $recipe_videoid,
					'uploadDate'   => $recipe_videodate,
					'duration'     => 'PT' . $recipe_videoduration,
				);
			}

			?>
			<script type="application/ld+json" class="penci-recipe-schema"><?php echo wp_json_encode( $json_recipe ); ?></script>
			<?php
		}
	}
endif;

if ( ! function_exists( 'pencipennews_recipe_get_post_author' ) ) {
	function pencipennews_recipe_get_post_author() {
		global $post;

		$post_author = isset( $post->post_author ) ? $post->post_author : '';
		$author      = get_the_author_meta( 'display_name', $post_author );

		return $author ? $author : 'author';
	}
}

if ( ! function_exists( 'pencipennews_recipe_reverse_wpautop' ) ) {
	function pencipennews_recipe_reverse_wpautop( $str ) {
		$str = wpautop( do_shortcode( htmlspecialchars_decode( $str ) ) );

		$str = str_replace( array( "\n", '<ol>', '</ol>', '<ul>', '</ul>' ), array( '', '', '', '', '' ), $str );

		// Strip all <p> tags
		$str = str_replace( "<p>", "", $str );
		$str = str_replace( "<li>", "", $str );

		// Replace </p> with a known delimiter
		$str = str_replace( "</p>", "::|::", $str );
		$str = str_replace( "</li>", "::|::", $str );

		$str     = substr( $str, 0, - 5 );
		$str_arr = array();

		if ( $str ) {
			$str     = wp_strip_all_tags( $str );
			$str_arr = explode( "::|::", $str );
		}

		return $str_arr;
	}
}

if ( ! function_exists( 'pencipennews_recipe_get_post_category' ) ):
	function pencipennews_recipe_get_post_category( $id ) {
		$cat_return   = 'Uncategorized';
		$the_category = get_the_category( $id );

		if ( ! empty( $the_category ) ) {
			$cat_return = $the_category[0]->name;
		}

		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', $id );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term );
			if ( ! is_wp_error( $term ) ) {
				$cat_return = $term->name;
			}
		}

		return $cat_return;
	}
endif;