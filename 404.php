<?php
/**
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

$mtc_theme_options = get_option( 'mtctheme_theme_options' );

get_header();
?>
<div class="template-404">
	<div class="container">
		<?php
		if ( ! empty( $mtc_theme_options['404_image_id'] ) ) {
			echo '<div class="image">';
			echo wp_get_attachment_image( $mtc_theme_options['404_image_id'], 'full' );
			echo '</div>';
		}

		if ( ! empty( $mtc_theme_options['404_title'] ) ) {
			echo '<h1 class="title">' . esc_html( $mtc_theme_options['404_title'] ) . '</h1>';
		}

		if ( ! empty( $mtc_theme_options['404_subtitle'] ) ) {
			echo '<p class="subtitle">' . esc_html( $mtc_theme_options['404_subtitle'] ) . '</p>';
		}

		if ( ! empty( $mtc_theme_options['404_url'] ) ) {
			echo '<div class="buttons">';
			echo '<a class="home" href="' . esc_url( home_url() ) . '">Back to Home</a>';
			echo '<a class="quote" href="' . esc_url( $mtc_theme_options['404_url'] ) . '">Request a Quote</a>';
			echo '</div>';
		}
		?>
	</div>
</div>
<?php
get_footer();
