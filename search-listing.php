<?php
/**
 * Listing Search Results Page Template
 *
 * PHP version 8.3+
 *
 * @category Template
 * @package  MTCTheme
 * @author   Anand Kapre <anand@kapre.email>
 * @license  GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://www.medicaltourismco.com/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $wp_query;
$mtc_procedure_q = ! empty( $wp_query->query_vars['procedure'] ) ? $wp_query->query_vars['procedure'] : '';
$mtc_country_q   = ! empty( $wp_query->query_vars['country'] ) ? $wp_query->query_vars['country'] : '';
$mtc_city_q      = ! empty( $wp_query->query_vars['city'] ) ? $wp_query->query_vars['city'] : '';
$mtc_page        = ! empty( $wp_query->query_vars['page'] ) ? $wp_query->query_vars['page'] : 0;
$mtc_args        = array(
	'post_type'      => 'listing',
	'posts_per_page' => 6,
	'post_status'    => 'publish',
	'paged'          => $mtc_page, // Use 'paged', not 'page' for pagination.
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

// Initialize tax_query array.
$mtc_tax_query = array();

if ( ! empty( $mtc_procedure_q ) && 'all' !== $mtc_procedure_q ) {
	$mtc_tax_query[] = array(
		'taxonomy' => 'procedure',
		'field'    => 'slug',
		'terms'    => $mtc_procedure_q,
	);
}

if ( ! empty( $mtc_country_q ) && 'all' !== $mtc_country_q ) {
	$mtc_tax_query[] = array(
		'taxonomy' => 'location',
		'field'    => 'slug',
		'terms'    => $mtc_country_q,
	);
}

if ( ! empty( $mtc_city_q ) && 'all' !== $mtc_city_q ) {
	$mtc_tax_query[] = array(
		'taxonomy' => 'location',
		'field'    => 'slug',
		'terms'    => $mtc_city_q,
	);
}

// If there are multiple tax queries, set the relation.
if ( count( $mtc_tax_query ) > 1 ) {
	$mtc_tax_query['relation'] = 'AND';
}

// Add tax_query to the main args only if not empty.
if ( ! empty( $mtc_tax_query ) ) {
	$mtc_args['tax_query'] = $mtc_tax_query;
}


$mtc_query = new WP_Query( $mtc_args );

echo '<div class="template-search-listing">';
echo '<div class="container">';

// debug( $wp_query );
echo '<div class="page-header">';
echo '<h1 class="section-title">Search Results</h1>';
echo '<a href="' . esc_url( home_url() ) . '" class="home-button">Back to home</a>';
echo '</div>'; // .page-header.
echo '<p>Showing results for <strong>"';
if ( ! empty( $mtc_procedure_q ) ) {
	echo esc_html( get_term_by( 'slug', $mtc_procedure_q, 'procedure' )->name );
}

if ( ! empty( $mtc_country_q ) ) {
	echo ' in ';
}
if ( ! empty( $mtc_city_q ) ) {
	echo esc_html( get_term_by( 'slug', $mtc_city_q, 'location' )->name ) . ', ';
}
if ( ! empty( $mtc_country_q ) ) {
	echo esc_html( get_term_by( 'slug', $mtc_country_q, 'location' )->name );
}
echo '"</strong></p>';

echo '<div class="template-search-listing__filters">';
echo '<form class="template-search-listing__filters__form" id="listing-filters-form" action="' . esc_attr( home_url( 'listing/search/' ) ) . '" method="get">';

// Hidden Procedure
echo '<input type="hidden" name="procedure" id="procedure" value="' . esc_attr( $mtc_procedure_q ) . '">';

// Country Filter
echo '<div class="template-search-listing__filters__country form-group">';
$mtc_countries = get_countries_by_procedure( $mtc_procedure_q, 'listing' );
echo '<select name="country" id="country" class="mtc-select">';
echo '<option value="all">All Countries</option>';
foreach ( $mtc_countries as $mtc_country ) {
	echo '<option value="' . esc_attr( $mtc_country->slug ) . '"';
	if ( $mtc_country->slug === $mtc_country_q ) {
		echo ' selected';
	}
	echo '>' . esc_html( $mtc_country->name ) . '</option>';
}
echo '</select>';
echo '</div>'; // .template-search-listing__filters__country

// City Filter
echo '<div class="template-search-listing__filters__city form-group">';
$mtc_cities = get_cities_by_procedure_and_country( $mtc_procedure_q, $mtc_country_q, 'listing' );
echo '<select name="city" id="city" class="mtc-select">';
echo '<option value="all">All Cities</option>';
foreach ( $mtc_cities as $mtc_city ) {
	echo '<option value="' . esc_attr( $mtc_city->slug ) . '"';
	if ( $mtc_city->slug === $mtc_city_q ) {
		echo ' selected';
	}
	echo '>' . esc_html( $mtc_city->name ) . '</option>';
}
echo '</select>';
echo '</div>'; // .template-search-listing__filters__city

echo '</form>'; // .template-search-listing__filters__form
mtc_currency_convertor_dropdown();
echo '</div>'; // .template-search-listing__filters

echo '<div class="template-search-listing__results">';
if ( $mtc_query->have_posts() ) {
	while ( $mtc_query->have_posts() ) {
		$mtc_query->the_post();
		get_template_part(
			'templates/partials/components/mtc-listing-card',
			null,
			array(
				'listingid' => get_the_ID(),
				'class'     => 'listing-card--search',
			)
		);
	}

	echo '</div>'; // .template-search-listing__results.

	$mtc_total_pages = $mtc_query->max_num_pages;
	if ( $mtc_total_pages > 1 ) {
		$mtc_current_page = max( 1, get_query_var( 'page' ) );
		echo '<div class="pagination">';
		echo paginate_links(
			array(
				'base'      => get_pagenum_link( 1 ) . '%_%',
				'format'    => 'page/%#%',
				'current'   => $mtc_current_page,
				'total'     => $mtc_total_pages,
				'mid_size'  => 1,
				'end_size'  => 1,
				'prev_text' => '<i class="mtc-left"></i>',
				'next_text' => '<i class="mtc-right"></i>',
			)
		);
		echo '</div>'; // pagination.
	}
} else {
	echo '<p>No results found.</p>';
	echo '</div>'; // .template-search-listing__results.
}

// Locations.
get_template_part(
	'templates/partials/misc/misc-section',
	'locations',
);

echo '</div>'; // .container.
echo '</div>'; // .template-search-listing.

get_footer();
