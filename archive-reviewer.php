<?php
/**
 * Theme Index Template
 *
 * Common index for all pages. This is the default template if no other
 * template is found.
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
if ( have_posts() ) {
	$mtc_theme_options = get_option( 'mtctheme_theme_options' );
	echo '<div class="template-archive-reviewer">';
	echo '<div class="container">';

	if ( ! empty( $mtc_theme_options['single_reviewer_title'] ) ) {
		echo '<h1>' . $mtc_theme_options['single_reviewer_title'] . '</h1>';
	}

	if ( ! empty( $mtc_theme_options['single_reviewer_content'] ) ) {
		echo wpautop( do_shortcode( $mtc_theme_options['single_reviewer_content'] ) );
	}
	echo '<div class="mtc-carousel-wrap">';
	echo '<div class="mtc-carousel">';
	while ( have_posts() ) {
		the_post();

		get_template_part(
			'templates/partials/components/mtc-reviewer',
			null,
			array(
				'mtc_id' => get_the_ID(),
			)
		);


	}

	echo '</div>'; // .mtc-carousel.
	echo '</div>'; // .mtc-carousel-wrap.
	echo '</div>'; // .container.
	echo '</div>'; // .template-archive-reviewer.
}
get_footer();
