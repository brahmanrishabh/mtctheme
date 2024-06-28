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

$mtc_id                       = get_option( 'page_on_front' );
$mtc_meta                     = get_post_meta( $mtc_id );
$mtc_search_background_image  = isset( $mtc_meta[ MTCTHEME_PREFIX . 'search_background_image' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'search_background_image' ][0] ) : '';
$mtc_search_title             = isset( $mtc_meta[ MTCTHEME_PREFIX . 'search_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'search_title' ][0] ) : '';
$mtc_search_content           = isset( $mtc_meta[ MTCTHEME_PREFIX . 'search_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'search_content' ][0] ) : '';
$mtc_search_button_text       = isset( $mtc_meta[ MTCTHEME_PREFIX . 'search_button_text' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'search_button_text' ][0] ) : '';
$mtc_search_button_url        = isset( $mtc_meta[ MTCTHEME_PREFIX . 'search_button_url' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'search_button_url' ][0] ) : '';
$mtc_video_title              = isset( $mtc_meta[ MTCTHEME_PREFIX . 'video_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'video_title' ][0] ) : '';
$mtc_video_content            = isset( $mtc_meta[ MTCTHEME_PREFIX . 'video_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'video_content' ][0] ) : '';
$mtc_video_tabs               = isset( $mtc_meta[ MTCTHEME_PREFIX . 'video_tabs' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'video_tabs' ][0] ) : '';
$mtc_cta_inline_1_title       = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_1_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_1_title' ][0] ) : '';
$mtc_cta_inline_1_button_text = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_1_button_text' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_1_button_text' ][0] ) : '';
$mtc_cta_inline_1_button_url  = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_1_button_url' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_1_button_url' ][0] ) : '';
$mtc_us_image                 = isset( $mtc_meta[ MTCTHEME_PREFIX . 'us_image' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'us_image' ][0] ) : '';
$mtc_location_title           = isset( $mtc_meta[ MTCTHEME_PREFIX . 'location_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'location_title' ][0] ) : '';
$mtc_location_content         = isset( $mtc_meta[ MTCTHEME_PREFIX . 'location_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'location_content' ][0] ) : '';
$mtc_cta_1_title              = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_1_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_1_title' ][0] ) : '';
$mtc_cta_1_subtitle           = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_1_subtitle' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_1_subtitle' ][0] ) : '';
$mtc_cta_1_button_text        = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_1_button_text' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_1_button_text' ][0] ) : '';
$mtc_cta_1_button_url         = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_1_button_url' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_1_button_url' ][0] ) : '';
$mtc_procedure_title          = isset( $mtc_meta[ MTCTHEME_PREFIX . 'procedure_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'procedure_title' ][0] ) : '';
$mtc_procedure_content        = isset( $mtc_meta[ MTCTHEME_PREFIX . 'procedure_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'procedure_content' ][0] ) : '';
$mtc_help_title               = isset( $mtc_meta[ MTCTHEME_PREFIX . 'help_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'help_title' ][0] ) : '';
$mtc_help_content             = isset( $mtc_meta[ MTCTHEME_PREFIX . 'help_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'help_content' ][0] ) : '';
$mtc_help_images              = isset( $mtc_meta[ MTCTHEME_PREFIX . 'help_images' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'help_images' ][0] ) : '';
$mtc_cta_2_title              = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_2_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_2_title' ][0] ) : '';
$mtc_cta_2_subtitle           = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_2_subtitle' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_2_subtitle' ][0] ) : '';
$mtc_cta_2_button_text        = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_2_button_text' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_2_button_text' ][0] ) : '';
$mtc_cta_2_button_url         = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_2_button_url' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_2_button_url' ][0] ) : '';
$mtc_hospital_title           = isset( $mtc_meta[ MTCTHEME_PREFIX . 'hospital_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'hospital_title' ][0] ) : '';
$mtc_hospital_content         = isset( $mtc_meta[ MTCTHEME_PREFIX . 'hospital_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'hospital_content' ][0] ) : '';
$mtc_hospital_images          = isset( $mtc_meta[ MTCTHEME_PREFIX . 'hospital_images' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'hospital_images' ][0] ) : '';
$mtc_review_title             = isset( $mtc_meta[ MTCTHEME_PREFIX . 'review_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'review_title' ][0] ) : '';
$mtc_review_content           = isset( $mtc_meta[ MTCTHEME_PREFIX . 'review_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'review_content' ][0] ) : '';
$mtc_reviews_type             = isset( $mtc_meta[ MTCTHEME_PREFIX . 'testimonial_type' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'testimonial_type' ][0] ) : '';
$mtc_reviews                  = isset( $mtc_meta[ MTCTHEME_PREFIX . 'reviews' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'reviews' ][0] ) : '';
$mtc_wpbr_ids                 = isset( $mtc_meta[ MTCTHEME_PREFIX . 'wpbr' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'wpbr' ][0] ) : '';
$mtc_featured_on_title        = isset( $mtc_meta[ MTCTHEME_PREFIX . 'featured_on_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'featured_on_title' ][0] ) : '';
$mtc_featured_on_image_id     = isset( $mtc_meta[ MTCTHEME_PREFIX . 'featured_on_image' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'featured_on_image_id' ][0] ) : '';
$mtc_package_title            = isset( $mtc_meta[ MTCTHEME_PREFIX . 'package_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'package_title' ][0] ) : '';
$mtc_package_content          = isset( $mtc_meta[ MTCTHEME_PREFIX . 'package_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'package_content' ][0] ) : '';
$mtc_packages                 = isset( $mtc_meta[ MTCTHEME_PREFIX . 'packages' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'packages' ][0] ) : '';
$mtc_cta_inline_2_title       = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_2_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_2_title' ][0] ) : '';
$mtc_cta_inline_2_button_text = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_2_button_text' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_2_button_text' ][0] ) : '';
$mtc_cta_inline_2_button_url  = isset( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_2_button_url' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'cta_inline_2_button_url' ][0] ) : '';
$mtc_blog_title               = isset( $mtc_meta[ MTCTHEME_PREFIX . 'blog_title' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'blog_title' ][0] ) : '';
$mtc_blog_content             = isset( $mtc_meta[ MTCTHEME_PREFIX . 'blog_content' ][0] ) ? maybe_unserialize( $mtc_meta[ MTCTHEME_PREFIX . 'blog_content' ][0] ) : '';
$mtc_enable_links_for_region  = isset( $mtc_meta[ MTCTHEME_PREFIX . 'enable_links_for_region' ][0] ) ? $mtc_meta[ MTCTHEME_PREFIX . 'enable_links_for_region' ][0] : 'off';
$mtc_region_for_links         = isset( $mtc_meta[ MTCTHEME_PREFIX . 'region_for_links' ][0] ) ? $mtc_meta[ MTCTHEME_PREFIX . 'region_for_links' ][0] : '';
$mtc_locations                = get_terms(
	array(
		'taxonomy'   => 'location',
		'hide_empty' => true,
		'meta_key'   => MTCTHEME_PREFIX . 'location_' . MTCTHEME_GEOMETAKEY,
		'orderby'    => 'meta_value_num',
		'order'      => 'ASC',
		'parent'     => 0,
	)
);

if ( 'written' === $mtc_reviews_type ) {
	$mtc_wpbr = false;
} else {
	$mtc_wpbr = true;
}


echo '<div class="template-front-page">';
echo '<div class="container">';

/**
 * Search Section
 */
if ( ! empty( $mtc_search_background_image ) ) {
	echo '<div class="search-section full-width" style="background-image: url(' . esc_attr( $mtc_search_background_image ) . ');">';
} else {
	echo '<div class="search-section full-width">';
}

if ( ! empty( $mtc_search_title ) ) {
	echo '<h1 class="search-section__title"><i class="mtc-medical-circle-fill"></i>' . esc_html( $mtc_search_title ) . '</h1>';
}
if ( ! empty( $mtc_search_content ) ) {
	echo '<div class="search-section__content">';
	echo wpautop( do_shortcode( $mtc_search_content ) );
	echo '</div>'; // .search-section__content.
}
echo '<form class="search-section__form" action="' . esc_attr( home_url( 'listing/search' ) ) . '" method="get">';
$mtc_procedures = mtc_get_procedures_with_listings();
$mtc_locations = mtc_get_locations_with_listings();
?>
<div class="search-section__form__select search-section__form__select--procedure" >
<?php 
if ( ! empty( $mtc_procedures ) ) { ?>
<input class="procedure-value" type="text" value=""  placeholder="Select Procedure" data-hidden-field="procedure_hidden" data-placeholder="Select Procedure" autocomplete="off" onkeypress="return false;" inputmode="none"></input>
<input type="hidden" id="procedure_hidden" name="procedure" value=""/>
<span class="procedure-icon"><i class="dvi-chevron-down"></i></span>          
		  <ul class="procedure-list ">
        <?php
        $html = '';
        foreach ($mtc_procedures as $procedure ) {
          if ($procedure->name == "Abroad" || $procedure->name == "Generic") {
            continue;
          }
         
          $html .= '<li class="parent" data-slug="' . $procedure->slug . '" data-id = "'. $procedure->term_id .'">';
          $html .= '<span class="name">' . $procedure->name . '</span>';
         
         
          if ( ! empty( $procedure->children ) ) {
			//$html .= '<i class="dvi-plus"></i>';           
            foreach ($procedure->children as $child) {
             // $html .= "<li class='child closed' data-slug='". $child->slug ."' data-id = '". $child->term_id ."'>" . $child->name . "</li>";
            }
            
          }
          $html .= '</li>';          
        }
        echo $html;
        ?>
      </ul>

<?php 

} ?>
</div>
<div class="search-section__form__select search-section__form__select--location" >
<?php
if ( ! empty( $mtc_locations ) ) { ?>
<input class="location-value" type="text" value="" placeholder="Select Location"  data-hidden-field="location_hidden" data-placeholder="Select Location" autocomplete="off" onkeypress="return false;" inputmode="none"></input>
<input type="hidden" id="country" name="country" value=""/>
<input type="hidden" id="city" name="city" value=""/>
<span class="location-icon"><i class="dvi-chevron-down"></i></span>              
			<ul class="location-list ">
        <?php
        $html = '';
        foreach ($mtc_locations as $location ) {
          if ($location->name == "Abroad" || $location->name == "Generic") {
            continue;
          }
         
          $html .= '<li class="parent hidden" data-id="' . $location->term_id . '" data-slug = "' . $location->slug . '">';
          $html .= '<span class="name">' . $location->name . '</span>';
         
          // $html .= $location->name;
          if ( ! empty( $location->children ) ) {
			$html .= '<i class="dvi-plus"></i>';
            // $html .= '<ul>';
            foreach ( $location->children as $child ) {
              $html .= "<li class='child closed hidden' data-id = '" .  $child->term_id . "' data-slug = '". $child->slug . "' data-parent_slug = '" . $location->slug . "'>" . $child->name . "</li>";
            }
            // $html .= '</ul>';
          }
          $html .= '</li>';          
        }
        echo $html;
        ?>
      </ul>

<?php 

}
?>
</div>
<?php

echo '<input type="hidden" name="post_type" value="listing">';

echo '<button type="submit" class="search-section__form__submit"><i class="mtc-search"></i>Search</button>';

echo '</form>'; // .search-section__form.

if ( ! empty( $mtc_search_button_text ) && ! empty( $mtc_search_button_url ) ) {
	echo '<a href="' . esc_url( $mtc_search_button_url ) . '" class="search-section__quote"><span>' . esc_html( $mtc_search_button_text ) . '</span></a>';
}

echo '</div>'; // .search-section.


/**
 * Video Section
 */
echo '<div id="video-section" class="video-section tabs-content">';

if ( ! empty( $mtc_video_title ) ) {
	echo '<h2 class="section-title video-section__title">' . esc_html( $mtc_video_title ) . '</h2>';
}

if ( ! empty( $mtc_video_content ) ) {
	echo '<div class="video-section__content">';
	echo wpautop( do_shortcode( $mtc_video_content ) );
	echo '</div>'; // .video-section__content.
}

if ( ! empty( $mtc_video_tabs ) ) {
	echo '<div class="wrap-tabs">';

	echo '<div class="tabs-content">';
	$mtc_x = 0;
	foreach ( $mtc_video_tabs as $mtc_tab ) {
		$mtc_title           = ! empty( $mtc_tab['title'] ) ? maybe_unserialize( $mtc_tab['title'] ) : '';
		$mtc_sanitized_title = sanitize_title( $mtc_title );
		$mtc_active          = ( 0 === $mtc_x ) ? ' active' : '';
		$mtc_testimonials    = ! empty( $mtc_tab['videos'] ) ? maybe_unserialize( $mtc_tab['videos'] ) : '';

		echo '<div id="tab-content-' . esc_html( $mtc_x ) . '-' . esc_html( $mtc_sanitized_title ) . '" class="tab-content ' . esc_html( $mtc_active ) . '">';
		echo '<div class="video-gallery">';
		foreach ( $mtc_testimonials as $mtc_testimonial ) {

			$mtc_video_title     = isset( $mtc_testimonial['title'] ) ? $mtc_testimonial['title'] : '';
			$mtc_video_url       = isset( $mtc_testimonial['url'] ) ? $mtc_testimonial['url'] : '';
			$mtc_video_id        = mtc_get_youtube_id( $mtc_video_url );
			$mtc_video_highlight = isset( $mtc_testimonial['description'] ) ? $mtc_testimonial['description'] : '';

			echo '<div class="video-gallery__item">';
			echo '<div class="video-container">';
			if ( ! empty( $mtc_video_id ) ) {
				echo '<lite-youtube videoid="' . esc_attr( $mtc_video_id ) . '" posterquality="maxresdefault">';
				echo '<a class="lite-youtube-fallback" href="' . esc_attr( $mtc_video_url ) . '">Watch on YouTube: "' . esc_attr( $mtc_video_highlight ) . '"</a>';
				echo '</lite-youtube>';
			}
			if ( ! empty( $mtc_video_title ) ) {
				echo '<h6>' . esc_html( $mtc_video_title ) . '</h6>';
			}
			if ( ! empty( $mtc_video_highlight ) ) {
				echo wpautop( do_shortcode( $mtc_video_highlight ) );
			}
			echo '</div>'; // video-container.
			echo '</div>'; // video-gallery__item.


		}
		echo '</div>'; // video-gallery.
		echo '</div>'; // tab-content.
		++$mtc_x;
	}
	echo '</div>'; // tabs-content.

	echo '<nav class="tabs-nav">';
		$mtc_x = 0;
	foreach ( $mtc_video_tabs as $mtc_tab ) {
		$mtc_title           = ! empty( $mtc_tab['title'] ) ? maybe_unserialize( $mtc_tab['title'] ) : '';
		$mtc_sanitized_title = sanitize_title( $mtc_title );
		$mtc_active          = ( 0 === $mtc_x ) ? 'active' : '';

		echo '<button id="tab-nav-' . esc_attr( $mtc_x ) . '-' . esc_attr( $mtc_sanitized_title ) . '" class="tab-link ' . esc_attr( $mtc_active ) . '" onclick="mtc_tabs(event, \'tab-content-' . esc_attr( $mtc_x ) . '-' . esc_attr( $mtc_sanitized_title ) . '\')">' . esc_html( $mtc_title ) . '</button>';
		++$mtc_x;
	}
		echo '</nav>';

		echo '</div>'; // wrap-tabs.
}
if ( ! empty( $mtc_cta_inline_1_title ) && ! empty( $mtc_cta_inline_1_button_text ) ) {
	echo '<div class="cta-inline">';
	echo '<h4 class="cta-inline__title">' . esc_html( $mtc_cta_inline_1_title ) . '</h4>';
	echo '<a href="' . esc_url( $mtc_cta_inline_1_button_url ) . '" class="cta-inline__button">' . esc_html( $mtc_cta_inline_1_button_text ) . '</a>';
	echo '</div>'; // .cta-inline.
}


echo '</div>'; // .video-section.

/**
 * US Section
 */
if ( ! empty( $mtc_us_image ) ) {
	echo '<div class="us-section full-width">';
	echo '<img src="' . esc_attr( $mtc_us_image ) . '" alt="Medical Tourism Corporation" />';
	echo '</div>'; // .us-section.
}

/**
 * Location Section
 */
echo '<div class="location-section">';
if ( ! empty( $mtc_location_title ) ) {
	echo '<h2 class="section-title location-section__title">' . esc_html( $mtc_location_title ) . '</h2>';
}
if ( ! empty( $mtc_location_content ) ) {
	echo '<div class="location-section__content">';
	echo wpautop( do_shortcode( $mtc_location_content ) );
	echo '</div>'; // .location-section__content.
}

if ( ! empty( $mtc_locations ) ) {
	get_template_part(
		'templates/partials/pages/page-section',
		'locations',
		array(
			'locations' => $mtc_locations,
		)
	);
}
echo '<a class="location-section__link" href="/destinations">Explore all locations</a>';
echo '</div>'; // .location-section.

/**
 * CTA 1 Section
 */
if ( ! empty( $mtc_cta_1_title ) && ! empty( $mtc_cta_1_button_text ) ) {
	get_template_part(
		'templates/partials/pages/page-section',
		'cta',
		array(
			'title'    => $mtc_cta_1_title,
			'subtitle' => $mtc_cta_1_subtitle,
			'button'   => $mtc_cta_1_button_text,
			'url'      => $mtc_cta_1_button_url,
		)
	);
}

/**
 * Procedure Section
 */
echo '<div class="procedure-section">';
if ( ! empty( $mtc_procedure_title ) ) {
	echo '<h2 class="section-title procedure-section__title">' . esc_html( $mtc_procedure_title ) . '</h2>';
}
if ( ! empty( $mtc_procedure_content ) ) {
	echo '<div class="procedure-section__content">';
	echo wpautop( do_shortcode( $mtc_procedure_content ) );
	echo '</div>'; // .location-section__content.
}

if ( ! empty( $mtc_procedures ) ) {
	get_template_part(
		'templates/partials/pages/page-section',
		'procedures',
		array(
			'procedures' => $mtc_procedures,
		)
	);
}

echo '<a class="procedure-section__link" href="/medical-procedures">Browse all procedures</a>';

echo '</div>'; // .procedure-section.

/**
 * Help Section
 */
echo '<div class="help-section">';
if ( ! empty( $mtc_help_title ) ) {
	echo '<h2 class="section-title help-section__title">' . esc_html( $mtc_help_title ) . '</h2>';
}
if ( ! empty( $mtc_help_content ) ) {
	echo '<div class="help-section__content">';
	echo wpautop( do_shortcode( $mtc_help_content ) );
	echo '</div>'; // .help-section__content.
}
if ( ! empty( $mtc_help_images ) ) {
	echo '<div class="help-section__images">';
	foreach ( $mtc_help_images as $mtc_help_image ) {
		echo '<div class="help-section__images__image">';
		if ( ! empty( $mtc_help_image['image'] && ! empty( $mtc_help_image['caption'] ) ) ) {
			echo '<img src="' . esc_attr( $mtc_help_image['image'] ) . '" alt="' . esc_attr( $mtc_help_image['caption'] ) . '" />';
		}
		if ( ! empty( $mtc_help_image['caption'] ) ) {
			echo '<p class="help-section__images__image__caption">' . esc_html( $mtc_help_image['caption'] ) . '</p>';
		}
		echo '</div>'; // .help-section__image.
	}
	echo '</div>'; // .help-section__images.
}

echo '</div>'; // .help-section.

/**
 * CTA 2 Section
 */
if ( ! empty( $mtc_cta_2_title ) && ! empty( $mtc_cta_2_button_text ) ) {
	get_template_part(
		'templates/partials/pages/page-section',
		'cta',
		array(
			'title'    => $mtc_cta_2_title,
			'subtitle' => $mtc_cta_2_subtitle,
			'button'   => $mtc_cta_2_button_text,
			'url'      => $mtc_cta_2_button_url,
		)
	);
}

/**
 * Hospital Section
 */
echo '<div class="hospital-section">';
if ( ! empty( $mtc_hospital_title ) ) {
	echo '<h2 class="section-title hospital-section__title">' . esc_html( $mtc_hospital_title ) . '</h2>';
}
if ( ! empty( $mtc_hospital_content ) ) {
	echo '<div class="hospital-section__content">';
	echo wpautop( do_shortcode( $mtc_hospital_content ) );
	echo '</div>'; // .hospital-section__content.
}
if ( ! empty( $mtc_hospital_images ) ) {
	echo '<div class="hospital-section__images">';
	foreach ( $mtc_hospital_images as $mtc_hospital_image ) {
		echo '<div class="hospital-section__images__image">';
		if ( ! empty( $mtc_hospital_image['image'] && ! empty( $mtc_hospital_image['caption'] ) ) ) {
			echo '<img src="' . esc_attr( $mtc_hospital_image['image'] ) . '" alt="' . esc_attr( $mtc_hospital_image['caption'] ) . '" />';
		}
		if ( ! empty( $mtc_hospital_image['caption'] ) ) {
			echo '<p class="hospital-section__images__image__caption">' . esc_html( $mtc_hospital_image['caption'] ) . '</p>';
		}
		echo '</div>'; // .hospital-section__image.
	}
	echo '</div>'; // .hospital-section__images.
}
echo '</div>'; // .hospital-section.

/**
 * Review Section
 */
echo '<div class="review-section">';
if ( ! empty( $mtc_review_title ) ) {
	echo '<h2 class="section-title review-section__title">' . esc_html( $mtc_review_title ) . '</h2>';
}

if ( ! empty( $mtc_review_content ) ) {
	echo '<div class="review-section__content">';
	echo wpautop( do_shortcode( $mtc_review_content ) );
	echo '</div>'; // .review-section__content.
}

if ( ! empty( $mtc_reviews ) && false === $mtc_wpbr ) {
	get_template_part(
		'templates/partials/components/mtc-review-carousel',
		null,
		array(
			'written_testimonials' => $mtc_reviews,
		)
	);
} elseif ( ! empty( $mtc_wpbr_ids ) && true === $mtc_wpbr ) {
	$mtc_reviews = array();

	if ( ! empty( $mtc_wpbr_ids ) ) {
		foreach ( $mtc_wpbr_ids as $mtc_wpbr_id ) {
			$mtc_wpbr_reviews = mtc_get_reviews_by_source_id( $mtc_wpbr_id );
			foreach ( $mtc_wpbr_reviews as $mtc_wpbr_review ) {
				$mtc_reviews[] = $mtc_wpbr_review;
			}
		}
		get_template_part(
			'templates/partials/components/mtc-review-carousel',
			null,
			array(
				'reviews' => $mtc_reviews,
			)
		);
	}
}

echo '<a class="review-section__link" href="/testimonials">More success stories</a>';

echo '</div>'; // .review-section.


/**
 * Featured On Section
 */
if ( ! empty( $mtc_featured_on_title ) && ! empty( $mtc_featured_on_image_id ) ) {
	get_template_part(
		'templates/partials/pages/page-section',
		'featured-on',
		array(
			'title' => $mtc_featured_on_title,
			'image' => $mtc_featured_on_image_id,
		)
	);
}

/**
 * Package Section
 */
echo '<div class="package-section">';
if ( ! empty( $mtc_package_title ) ) {
	echo '<h2 class="section-title package-section__title">' . esc_html( $mtc_package_title ) . '</h2>';
}
if ( ! empty( $mtc_package_content ) ) {
	echo '<div class="package-section__content">';
	echo wpautop( do_shortcode( $mtc_package_content ) );
	echo '</div>'; // .package-section__content.
}
if ( ! empty( $mtc_packages ) ) {
	echo '<div class="package-section__packages">';
	foreach ( $mtc_packages as $mtc_package ) {
		echo '<div class="package-section__packages__package">';
		if ( ! empty( $mtc_package['image'] ) && ! empty( $mtc_package['title'] ) ) {
			echo '<img src="' . esc_attr( $mtc_package['image'] ) . '" alt="' . esc_attr( $mtc_package['title'] ) . '" />';
		}
		if ( ! empty( $mtc_package['title'] ) ) {
			echo '<h5>' . esc_html( $mtc_package['title'] ) . '</h5>';
		}
		if ( ! empty( $mtc_package['price'] ) ) {
			echo '<p>' . esc_html( $mtc_package['price'] ) . '</p>';
		}

		echo '</div>'; // .package-section__packages__package.
	}
	echo '</div>'; // .package-section__packages.
}

if ( ! empty( $mtc_cta_inline_2_title ) && ! empty( $mtc_cta_inline_2_button_text ) ) {
	echo '<div class="cta-inline">';
	echo '<h4 class="cta-inline__title">' . esc_html( $mtc_cta_inline_2_title ) . '</h4>';
	echo '<a href="' . esc_url( $mtc_cta_inline_2_button_url ) . '" class="cta-inline__button">' . esc_html( $mtc_cta_inline_2_button_text ) . '</a>';
	echo '</div>'; // .cta-inline.
}

echo '<a class="package-section__link" href="/packages">Show all packages</a>';

echo '</div>'; // .package-section.

/**
 * Blog Section
 */
echo '<div class="blog-section">';
if ( ! empty( $mtc_blog_title ) ) {
	echo '<h2 class="section-title blog-section__title">' . esc_html( $mtc_blog_title ) . '</h2>';
}
if ( ! empty( $mtc_blog_content ) ) {
	echo '<div class="blog-section__content">';
	echo wpautop( do_shortcode( $mtc_blog_content ) );
	echo '</div>'; // .blog-section__content.
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

if ( 'on' === $mtc_enable_links_for_region ) {
	
	$mtc_region = $mtc_region_for_links !=='default' ? 'region="' . $mtc_region_for_links . '" ' : '';	
	echo do_shortcode( "[region_links $mtc_region ]" );
}

wp_reset_postdata();

echo '<a class="blog-section__link" href="/blog">Show all blogs</a>';

echo '</div>'; // .blog-section.

echo '</div>'; // .container.
echo '</div>'; // .template-front-page.

get_footer();
