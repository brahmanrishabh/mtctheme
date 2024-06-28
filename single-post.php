<?php
/**
 * Theme Single Template
 *
 * Common single template for all pages and post types.
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
		$mtc_reviewed_by   = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'reviewed_by', true );
		$mtc_post_sections = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'post_section', true );
		$mtc_schema_review = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'schema_review', true );
		$mtc_schema_video  = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'schema_video', true );
		$mtc_schema_faq    = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'schema_faq', true );
		$mtc_schema_rich   = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'schema_rich', true );
		$mtc_title         = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'title', true );
		$mtc_content       = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'content', true );
		// $mtc_processed_content = shortcode_unautop( $mtc_content );
		// $mtc_filtered_content  = apply_filters( 'the_content', $mtc_processed_content );
		$mtc_date = get_the_date();

		echo '<div class="main">';
		echo '<div class="container">';
		echo '<div class="post">';
		echo '<div class="post-header">';

		if ( ! empty( $mtc_reviewed_by ) ) {
			echo '<p class="reviewed-by">';
			echo 'Medically Reviewed By: ';
			$x = 1;
			foreach ( $mtc_reviewed_by as $reviewed_by ) {
				echo '<a target="_blank" href="' . esc_url( get_the_permalink( $reviewed_by ) ) . '">' . esc_html( get_the_title( $reviewed_by ) ) . '</a>';
				if ( $x < count( $mtc_reviewed_by ) ) {
					echo ', ';
				}
				++$x;
			}
			// echo '<a target="_blank" href="' . get_the_permalink( $mtc_reviewed_by ) . '">' . esc_html( get_the_title( $mtc_reviewed_by ) ) . '</a>';
			echo '</p>';
		}

		echo '<h1 class="post-title">' . esc_html( $mtc_title ) . '</h1>';
		echo '<div class="post-date">' . esc_html( $mtc_date ) . '</div>';
		echo '</div>'; // .post-header.
		echo '<div class="post-content">';
		if ( ! empty( $mtc_content ) ) {
			// echo $mtc_filtered_content;
			echo wpautop( do_shortcode( $mtc_content ) );
		}
		echo '</div>'; // .post-content.
		echo '</div>'; // .post.
		echo '<div class="post-comments">';
		// Load the comments.
		// comments_template();.
		echo '</div>';
		echo '<div class="sidebar">';
		get_sidebar();
		echo '</div>';
		echo '</div>';
		echo '</div>';


		if ( ! empty( $mtc_schema_review ) ) {
			echo $mtc_schema_review;
		}

		if ( ! empty( $mtc_schema_video ) ) {
			echo $mtc_schema_video;
		}

		if ( ! empty( $mtc_schema_faq ) ) {
			echo $mtc_schema_faq;
		}

		if ( ! empty( $mtc_schema_rich ) ) {
			echo $mtc_schema_rich;
		}
	}
}
get_footer();
