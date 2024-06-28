<?php
/**
 * Theme Listing Template
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

$mtc_listing_order = get_post_meta( get_the_ID(), MTCTHEME_PREFIX . 'listing_section_order', true );

get_header();
?>
<div class="listing">
	<div class="container">
		<?php
		$mtc_id    = get_the_ID();
		$mtc_index = 1;
		// Banner.
		get_template_part(
			'templates/partials/listing/listing-section',
			'banner',
			array(
				'mtc_id'    => $mtc_id,
				'mtc_index' => $mtc_index,
			)
		);
		++$mtc_index;
		// Page Menu.
		get_template_part(
			'templates/partials/listing/listing-section',
			'page-menu',
			array(
				'mtc_id'            => $mtc_id,
				'mtc_index'         => $mtc_index,
				'mtc_listing_order' => $mtc_listing_order,
			)
		);
		++$mtc_index;
		if ( ! empty( $mtc_listing_order ) ) {
			foreach ( $mtc_listing_order as $mtc_section ) {
				switch ( $mtc_section ) {
					case 'about':
						// About.
						get_template_part(
							'templates/partials/listing/listing-section',
							'about',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'testimonial':
						// Reviews.
						get_template_part(
							'templates/partials/listing/listing-section',
							'reviews',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'cta_1':
						// Call to Action 1.
						get_template_part(
							'templates/partials/listing/listing-section',
							'cta',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
								'mtc_cta'   => 1,
							)
						);
						++$mtc_index;
						break;

					case 'price':
						// Price.
						get_template_part(
							'templates/partials/listing/listing-section',
							'price',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'package':
						// Packages.
						get_template_part(
							'templates/partials/listing/listing-section',
							'packages',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'cta_2':
						// Call to Action 2.
						get_template_part(
							'templates/partials/listing/listing-section',
							'cta',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
								'mtc_cta'   => 2,
							)
						);
						++$mtc_index;
						break;

					case 'doctor':
						// Doctors.
						get_template_part(
							'templates/partials/listing/listing-section',
							'doctors',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'cta_3':
						// Call to Action 3.
						get_template_part(
							'templates/partials/listing/listing-section',
							'cta',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
								'mtc_cta'   => 3,
							)
						);
						++$mtc_index;
						break;

					case 'membership':
						// Memberships.
						get_template_part(
							'templates/partials/listing/listing-section',
							'memberships',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'awards':
						// Awards.
						get_template_part(
							'templates/partials/listing/listing-section',
							'awards',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'cta_4':
						// Call to Action 4.
						get_template_part(
							'templates/partials/listing/listing-section',
							'cta',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
								'mtc_cta'   => 4,
							)
						);
						++$mtc_index;
						break;

					case 'gallery':
						// Gallery.
						get_template_part(
							'templates/partials/listing/listing-section',
							'gallery',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'cta_5':
						// Call to Action 5.
						get_template_part(
							'templates/partials/listing/listing-section',
							'cta',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
								'mtc_cta'   => 5,
							)
						);
						++$mtc_index;
						break;

					case 'video':
						// Videos.
						get_template_part(
							'templates/partials/listing/listing-section',
							'videos',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'cta_6':
						// Call to Action 6.
						get_template_part(
							'templates/partials/listing/listing-section',
							'cta',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
								'mtc_cta'   => 6,
							)
						);
						++$mtc_index;
						break;

					case 'travel':
						// Travel.
						get_template_part(
							'templates/partials/listing/listing-section',
							'travel',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'hotels':
						// Hotels.
						get_template_part(
							'templates/partials/listing/listing-section',
							'hotels',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'cta_7':
						// Call to Action 7.
						get_template_part(
							'templates/partials/listing/listing-section',
							'cta',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
								'mtc_cta'   => 7,
							)
						);
						++$mtc_index;
						break;

					case 'info':
						// Info.
						get_template_part(
							'templates/partials/listing/listing-section',
							'info',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
						break;

					case 'faq':
						// FAQ.
						get_template_part(
							'templates/partials/listing/listing-section',
							'faq',
							array(
								'mtc_id'    => $mtc_id,
								'mtc_index' => $mtc_index,
							)
						);
						++$mtc_index;
				}
			}
		}
		?>
	</div>
</div>
<?php
get_footer();
