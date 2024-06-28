<?php
/**
 * Template Name: Blog Home
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

$mtc_search_q    = ! empty( $wp_query->query_vars['search'] ) ? sanitize_text_field( urldecode( $wp_query->query_vars['search'] ) ) : '';
$mtc_procedure_q = ! empty( $wp_query->query_vars['procedure'] ) ? $wp_query->query_vars['procedure'] : '';
$mtc_country_q   = ! empty( $wp_query->query_vars['country'] ) ? $wp_query->query_vars['country'] : '';
$mtc_city_q      = ! empty( $wp_query->query_vars['city'] ) ? $wp_query->query_vars['city'] : '';

// Reset country and city when procedure is selected
if ( isset( $_GET['procedure'] ) && $_GET['procedure'] !== $mtc_procedure_q ) {
	$mtc_procedure_q = sanitize_text_field( $_GET['procedure'] );
	$mtc_country_q   = '';
	$mtc_city_q      = '';
}

// Reset city when country is selected
if ( isset( $_GET['country'] ) && $_GET['country'] !== $mtc_country_q ) {
	$mtc_country_q = sanitize_text_field( $_GET['country'] );
	$mtc_city_q    = '';
}

if ( isset( $_GET['city'] ) ) {
	$mtc_city_q = sanitize_text_field( $_GET['city'] );
}


$mtc_theme_options      = get_option( 'mtctheme_theme_options' );
$mtc_title              = ! empty( $mtc_theme_options['archive_blog_title'] ) ? $mtc_theme_options['archive_blog_title'] : 'Blog';
$mtc_content            = ! empty( $mtc_theme_options['archive_blog_content'] ) ? $mtc_theme_options['archive_blog_content'] : '';
$mtc_title_latest_blogs = ! empty( $mtc_theme_options['archive_blog_title_latest_blogs'] ) ? $mtc_theme_options['archive_blog_title_latest_blogs'] : 'Latest Blogs';
$mtc_content_lower      = ! empty( $mtc_theme_options['archive_blog_content_lower'] ) ? $mtc_theme_options['archive_blog_content_lower'] : '';
$mtc_procedures         = get_terms(
	array(
		'taxonomy'   => 'procedure',
		'hide_empty' => true,
		'order'      => 'ASC',
		'orderby'    => 'meta_value_num',
		'meta_key'   => MTCTHEME_PREFIX . 'procedure_' . MTCTHEME_GEOMETAKEY,
		'parent'     => 0,
	)
);

if ( ! empty( $mtc_procedure_q ) ) {
	$mtc_countries = get_countries_by_procedure( $mtc_procedure_q );
} else {
	$mtc_countries = array();
}

if ( ! empty( $mtc_procedure_q ) && ! empty( $mtc_country_q ) ) {
	$mtc_cities = get_cities_by_procedure_and_country( $mtc_procedure_q, $mtc_country_q );
} else {
	$mtc_cities = array();
}



echo '<div class="template-blog-home">';
echo '<div class="container">';
if ( ! empty( $mtc_title ) ) {
	echo '<h1 class="section-title centered">' . esc_html( $mtc_title ) . '</h1>';
}

if ( ! empty( $mtc_content ) && empty( $mtc_search_q ) && empty( $mtc_procedure_q ) ) {
	echo wpautop( do_shortcode( $mtc_content ) );
}


echo '<div class="search">';

echo '<form id="blog-filters-form" action="' . esc_url( home_url( 'blog' ) ) . '" method="GET">';
echo '<div class="blog-search">';
echo '<input name="search" type="text" class="blog-search__input" placeholder="Search destinations, procedures and more..." value="' . esc_attr( $mtc_search_q ) . '">';
echo '<button type="submit" class="blog-search__submit"><i class="mtc-search"></i></button>';
echo '</div>'; // blog-search.

echo '<div class="or">';
echo '<span>or</span>';
echo '<hr>';
echo '</div>'; // or.

echo '<div class="blog-filters">';

// echo '<select class="blog-filters__select" id="procedure" name="procedure" onchange="this.form.submit()">';
echo '<select class="blog-filters__select" id="procedure" name="procedure">';
echo '<option value="">All Procedures</option>';
foreach ( $mtc_procedures as $mtc_procedure ) {
	if ( ! empty( $mtc_procedure_q ) && $mtc_procedure_q === $mtc_procedure->slug ) {
		echo '<option value="' . esc_attr( $mtc_procedure->slug ) . '" selected>' . esc_html( $mtc_procedure->name ) . '</option>';
	} else {
		echo '<option value="' . esc_attr( $mtc_procedure->slug ) . '">' . esc_html( $mtc_procedure->name ) . '</option>';
	}
}
echo '</select>'; // procedure.

// Check if procedure query variable is set and not empty.
if ( ( ! empty( $mtc_procedure_q ) ) ) {
	// echo '<select class="blog-filters__select" id="country" name="country" onchange="this.form.submit()">';
	echo '<select class="blog-filters__select" id="country" name="country">';
	echo '<option value="">All Countries</option>';
	foreach ( $mtc_countries as $mtc_country ) {
		$selected = ( ! empty( $mtc_country_q ) && $mtc_country_q === $mtc_country->slug ) ? ' selected' : '';
		echo '<option value="' . esc_attr( $mtc_country->slug ) . '"' . $selected . '>' . esc_html( $mtc_country->name ) . '</option>';
	}
	echo '</select>'; // country.
} else {
	// echo '<select class="blog-filters__select" id="country" name="country" onchange="this.form.submit()">';
	echo '<select class="blog-filters__select" id="country" name="country">';
	// Procedure query variable is empty, display a message or handle as needed.
	echo '<option value="">All Countries</option>';
	echo '</select>'; // country.
}

// echo '<select class="blog-filters__select" id="city" name="city" onchange="this.form.submit()">';
echo '<select class="blog-filters__select" id="city" name="city">';
if ( ! empty( $mtc_country_q ) ) {
	echo '<option value="">All Cities</option>';
	foreach ( $mtc_cities as $mtc_city ) {
		if ( ! empty( $mtc_city_q ) && $mtc_city_q === $mtc_city->slug ) {
			echo '<option value="' . esc_attr( $mtc_city->slug ) . '" selected>' . esc_html( $mtc_city->name ) . '</option>';
		} else {
			echo '<option value="' . esc_attr( $mtc_city->slug ) . '">' . esc_html( $mtc_city->name ) . '</option>';
		}
	}
} else {
	// Procedure query variable is empty, display a message or handle as needed.
	echo '<option value="">All Cities</option>';
}
echo '</select>'; // city.

echo '</div>'; // blog-filters.

echo '</form>';

echo '</div>'; // search.

// Conditionally set is_home and is_archive
if ( ! empty( $mtc_search_q ) || ! empty( $mtc_procedure_q ) || 'all' === $mtc_procedure_q || ! empty( $mtc_country_q ) || 'all' === $mtc_country_q || ! empty( $mtc_city_q ) || 'all' === $mtc_city_q ) {
	$wp_query->is_home    = false;
	$wp_query->is_archive = true;
	$wp_query->is_paged   = get_query_var( 'paged' ) > 1;
} else {
	$wp_query->is_home    = true;
	$wp_query->is_archive = false;
	$wp_query->is_paged   = false;
}

// Set up the custom query arguments.
$mtc_args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 6,
	'paged'          => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
	'meta_query'     => array(
		'relation' => 'OR',
		array(
			'key'     => 'mtctheme_featured',
			'value'   => 'on',
			'compare' => '=',
		),
		array(
			'key'     => 'mtctheme_featured',
			'value'   => 'off',
			'compare' => '=',
		),
		array(
			'key'     => 'mtctheme_featured',
			'compare' => 'NOT EXISTS', // This will include posts without the mtctheme_featured key.
		),
	),
	'orderby'        => array(
		'meta_value' => 'DESC', // This ensures that featured posts are at the top.
		'date'       => 'DESC', // This will then sort all posts by date.
	),
);

// Then add these filters to your 'tax_query' if they are set.
$mtc_tax_query = array( 'relation' => 'AND' );
if ( ! empty( $mtc_procedure_q ) && 'all' !== $mtc_procedure_q ) {
	$mtc_tax_query[] = array(
		'taxonomy' => 'procedure',
		'field'    => 'slug',
		'terms'    => sanitize_text_field( $mtc_procedure_q ),
	);
}
if ( ! empty( $mtc_country_q ) && 'all' !== $mtc_country_q ) {
	$mtc_tax_query[] = array(
		'taxonomy' => 'location',
		'field'    => 'slug',
		'terms'    => sanitize_text_field( $mtc_country_q ),
	);
}
if ( ! empty( $mtc_city_q ) && 'all' !== $mtc_city_q ) {
	$mtc_tax_query[] = array(
		'taxonomy' => 'location',
		'field'    => 'slug',
		'terms'    => sanitize_text_field( $mtc_city_q ),
	);
}

// Only add the tax_query if there are any filters selected.
if ( count( $mtc_tax_query ) > 1 ) { // More than just the relation.
	$mtc_args['tax_query'] = $mtc_tax_query;
}

// Check for a search term and sanitize it.
if ( ! empty( $mtc_search_q ) ) {
	$mtc_search_term = sanitize_text_field( $mtc_search_q );
	$mtc_args['s']   = $mtc_search_term;
}

// The Query.
$mtc_query = new WP_Query( $mtc_args );

// The Loop.
if ( $mtc_query->have_posts() ) {
	echo '<div class="blog-featured">';
	while ( $mtc_query->have_posts() ) {
		$mtc_query->the_post();

		get_template_part(
			'templates/partials/components/mtc-blog-card',
			null,
			array(
				'mtc_id' => get_the_ID(),
			)
		);
	}
	echo '</div>'; // blog-featured.
	// Pagination (place outside the loop).
	$mtc_total_pages = $mtc_query->max_num_pages;
	if ( $mtc_total_pages > 1 ) {
		$mtc_current_page = max( 1, get_query_var( 'paged' ) );
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
	echo '<p>No posts found.</p>';
}
wp_reset_postdata();

if ( ! empty( $mtc_content_lower ) && empty( $mtc_search_q ) && empty( $mtc_procedure_q ) ) {
	echo wpautop( do_shortcode( $mtc_content_lower ) );
}

// Set up the custom query arguments.
$mtc_args = array(
	'post_type'      => 'post',
	'posts_per_page' => 6,
	'orderby'        => 'date',
	'order'          => 'DESC',
);

// The Query.
$mtc_query = new WP_Query( $mtc_args );

// The Loop.
if ( $mtc_query->have_posts() ) {
	echo '<h2 class="section-title">' . $mtc_title_latest_blogs . '</h2>';
	echo '<div class="blog-latest">';
	echo '<div class="mtc-carousel-wrap">';

	echo '<div class="mtc-carousel">';
	while ( $mtc_query->have_posts() ) {
		$mtc_query->the_post();
		// Your loop code (display the post title, content, etc.).
		get_template_part(
			'templates/partials/components/mtc-blog-card',
			null,
			array(
				'mtc_id' => get_the_ID(),
			)
		);
	}
	echo '</div>'; // mtc-carousel.
	echo '</div>'; // mtc-carousel-wrap.
	echo '</div>'; // blog-latest.
}
wp_reset_postdata();

echo '</div>'; // container.
echo '</div>'; // template-blog-home.

get_footer();