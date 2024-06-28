<?php
/**
 * Reviewer Single Template
 *
 * Single template for reviewer post type
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
	while ( have_posts() ) {
		the_post();
		$mtc_theme_options = get_option( 'mtctheme_theme_options' );

		echo '<div class="template-single-reviewer">';
		echo '<div class="container">';
		if ( ! empty( $mtc_theme_options['single_reviewer_title'] ) ) {
			echo '<h1>' . $mtc_theme_options['single_reviewer_title'] . '</h1>';
		}

		if ( ! empty( $mtc_theme_options['single_reviewer_content'] ) ) {
			echo wpautop( do_shortcode( $mtc_theme_options['single_reviewer_content'] ) );
		}

		get_template_part(
			'templates/partials/components/mtc-reviewer',
			null,
			array(
				'mtc_id'   => get_the_ID(),
				'mtc_type' => 'landscape',
			)
		);

		echo '</div>';
		echo '</div>';

	}
}
get_footer();
