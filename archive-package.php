<?php
/**
 * Theme Archive: Package
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

$mtc_theme_options = get_option( 'mtctheme_theme_options' );

$mtc_locations = get_terms(
	array(
		'taxonomy'   => 'location',
		'hide_empty' => false,
		'meta_key'   => MTCTHEME_PREFIX . 'location_' . MTCTHEME_GEOMETAKEY,
		'orderby'    => 'meta_value_num',
		'order'      => 'ASC',
		'parent'     => 0,
	)
);

// Initialize array to store locations that have packages.
$mtc_locations_with_packages = array();

foreach ( $mtc_locations as $mtc_location ) {
	$mtc_has_package = false;

	// Check if the location itself has packages.
	$mtc_packages = get_posts(
		array(
			'post_type'      => 'package',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'tax_query'      => array(
				array(
					'taxonomy' => 'location',
					'field'    => 'id',
					'terms'    => $mtc_location->term_id,
				),
			),
		)
	);

	if ( ! empty( $mtc_packages ) ) {
		$mtc_has_package = true;
	} else {
		// Check if any child locations have packages.
		$mtc_child_locations = get_terms(
			array(
				'taxonomy'   => 'location',
				'hide_empty' => false,
				'parent'     => $mtc_location->term_id,
			)
		);

		foreach ( $mtc_child_locations as $mtc_child ) {
			$mtc_child_packages = get_posts(
				array(
					'post_type'      => 'package',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'tax_query'      => array(
						array(
							'taxonomy' => 'location',
							'field'    => 'id',
							'terms'    => $mtc_child->term_id,
						),
					),
				)
			);

			if ( ! empty( $mtc_child_packages ) ) {
				$mtc_has_package = true;
				break; // Break the loop if a child with packages is found.
			}
		}
	}

	// If location or its children have packages, add to the array to display.
	if ( $mtc_has_package ) {
		array_push( $mtc_locations_with_packages, $mtc_location );
	}
}



echo '<div class="template-archive-package">';
echo '<div class="container">';
echo '<h1 class="section-title">' . esc_html( $mtc_theme_options['archive_package_title'] ) . '</h1>';
echo wpautop( do_shortcode( $mtc_theme_options['archive_package_content'] ) );
echo '<div id="location-tabs" class="wrap-tabs tabs-content">';

// Location Nav.
get_template_part(
	'templates/partials/components/mtc-location-nav',
	null,
	array(
		'mtc_locations' => $mtc_locations_with_packages,
	)
);

// Package Tabs.
echo '<div class="tabs-content">';
$mtc_x = 0;
foreach ( $mtc_locations_with_packages as $mtc_tab ) {
	$mtc_location_id     = $mtc_tab->term_id;
	$mtc_title           = ! empty( $mtc_tab->name ) ? $mtc_tab->name : '';
	$mtc_sanitized_title = ! empty( $mtc_tab->slug ) ? $mtc_tab->slug : '';
	$mtc_active          = ( 0 === $mtc_x ) ? 'active' : '';

	echo '<div id="tab-content-' . esc_attr( $mtc_x ) . '-' . esc_attr( $mtc_sanitized_title ) . '" class="tab-content ' . esc_attr( $mtc_active ) . '">';
	echo '<div class="mtc-package-cards">';
	$mtc_packages = get_posts(
		array(
			'post_type'      => 'package',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'tax_query'      => array(
				array(
					'taxonomy' => 'location',
					'field'    => 'slug',
					'terms'    => $mtc_tab->slug,
				),
			),
		)
	);
	foreach ( $mtc_packages as $mtc_package ) {
		get_template_part(
			'templates/partials/components/mtc-package-card',
			null,
			array(
				'id' => $mtc_package->ID,
			)
		);
	}
	echo '</div>'; // mtc-package-cards.
	echo '</div>'; // tab-content.
	++$mtc_x;
}

echo '</div>'; // tabs-content.
echo '</div>'; // wrap-tabs.
echo '</div>'; // container.
echo '</div>'; // template-archive-package.
get_footer();
