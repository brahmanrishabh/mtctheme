<?php
/**
 * The sidebar containing the main widget area.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

echo '<aside id="secondary" class="widget-area">';
// Embed MTC Form Shortcode.
echo '<div class="mtc-form-widget">';
echo do_shortcode( '[mtcform]' );
echo '</div>';

// Embed Location cards on blog page.
if ( is_single() ) {
	echo '<div class="location-cards">';
	// Get current post location taxonomy.
	$mtc_location = get_the_terms( get_the_ID(), 'location' );
	if ( ! empty( $mtc_location ) ) {
		$mtc_location_parent = get_term( $mtc_location[0]->parent, 'location' )->slug;
		$mtc_location        = $mtc_location[0]->term_id;
	}
	// Get current post procedure taxonomy.
	$mtc_procedure = get_the_terms( get_the_ID(), 'procedure' );
	if ( ! empty( $mtc_procedure ) ) {
		$mtc_procedure_name = $mtc_procedure[0]->slug;
		$mtc_procedure      = $mtc_procedure[0]->term_id;
	}

	if ( ! empty( $mtc_location ) && ! empty( $mtc_procedure ) ) {
		// Get listings for current location and procedure sorted by listing order.
		$mtc_args = array(
			'post_type'      => 'listing',
			'posts_per_page' => 2,
			'tax_query'      => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'location',
					'field'    => 'term_id',
					'terms'    => $mtc_location,
				),
				array(
					'taxonomy' => 'procedure',
					'field'    => 'term_id',
					'terms'    => $mtc_procedure,
				),
			),
			'meta_query'     => array(
				array(
					'key'     => MTCTHEME_PREFIX . 'listing_order',
					'compare' => 'EXISTS',
				),
			),
			'orderby'        => 'meta_value_num',
			'meta_key'       => MTCTHEME_PREFIX . 'listing_order',
			'order'          => 'ASC',
		);

		$mtc_query = new WP_Query( $mtc_args );

		if ( $mtc_query->have_posts() ) {
			while ( $mtc_query->have_posts() ) {
				$mtc_query->the_post();
				$mtc_listing_id = get_the_ID();

				get_template_part( 'templates/partials/components/mtc-sidebar-listing-card', null, array( 'listingid' => $mtc_listing_id ) );
			}
			echo '<div class="see-more"><a target="_blank" href="' . esc_url( home_url( '/listing/search/' . $mtc_procedure_name . '/' . $mtc_location_parent ) ) . '">See More</a></div>';
		}

		wp_reset_postdata();
	}

	echo '</div>';
}

dynamic_sidebar( 'sidebar-1' );
echo '</aside>';
