<?php
/**
 * Theme Functions
 *
 * Entire theme's function definitions.
 *
 * PHP version 8.3+
 *
 * @category Functions
 * @package  MTCTheme
 * @author   Anand Kapre <anand@kapre.email>
 * @license  GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://www.medicaltourismco.com/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Constants.
 */
define( 'MTCTHEME_VER', mtc_get_theme_version() );
define( 'MTCTHEME_DIR', get_template_directory() );
define( 'MTCTHEME_URL', get_template_directory_uri() );
define( 'MTCTHEME_PREFIX', 'mtctheme_' );
define( 'MTCTHEME_GOOGLE_API_KEY', 'AIzaSyCn6AbDs0LeW-nLQQ5oY_94mUeBd8Ea9jg' );

/**
 * Includes
 */
// Include Custom Post Types.
foreach ( glob( MTCTHEME_DIR . '/includes/custom-post-types/*.php' ) as $mtcfilename ) {
	require_once $mtcfilename;
}


// Include Custom Taxonomies.
foreach ( glob( MTCTHEME_DIR . '/includes/custom-taxonomies/*.php' ) as $mtcfilename ) {
	require_once $mtcfilename;
}

// CMB2 & its plugins.
require_once MTCTHEME_DIR . '/includes/cmb2/init.php';
require_once MTCTHEME_DIR . '/includes/cmb2-tabs/cmb2-tabs.php';
require_once MTCTHEME_DIR . '/includes/cmb-field-select2/cmb-field-select2.php';
require_once MTCTHEME_DIR . '/includes/cmb_field_map/cmb-field-map.php';
require_once MTCTHEME_DIR . '/includes/cmb2-post-search-field/cmb2_post_search_field.php';
require_once MTCTHEME_DIR . '/includes/cmb2-field-ajax-search/cmb2-field-ajax-search.php';
require_once MTCTHEME_DIR . '/includes/cmb2-conditionals/cmb2-conditionals.php';
require_once MTCTHEME_DIR . '/includes/cmb2-field-order/cmb2-field-order.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-imgcap.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-faq.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-menu.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-price-table.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-pros-cons.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-repeatable-wysiwyg.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-tabs-content.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-meta-video.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-youtube.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-toggle.php';
require_once MTCTHEME_DIR . '/includes/cmb2-fields-custom/cmb2-field-tabs-doctor.php';
require_once MTCTHEME_DIR . '/includes/cmb2-field-docs/cmb2-field-docs.php';

// Include Custom Metaboxes.
foreach ( glob( MTCTHEME_DIR . '/includes/custom-metaboxes/*.php' ) as $mtcfilename ) {
	require_once $mtcfilename;
}

// Include Misc.
require_once MTCTHEME_DIR . '/includes/shortcodes.php';

/**
 * Custom Admin Footer Text.
 */
function mtctheme_custom_admin_footer() {
	// Get the current theme data.
	$theme = wp_get_theme();

	// Get the WordPress version.
	$wp_version = get_bloginfo( 'version' );

	// Get the current theme version.
	$theme_version = $theme->get( 'Version' );

	// Customize the footer text.
	echo esc_html( 'WordPress Version: ' . $wp_version . ' | ' . $theme->get( 'Name' ) . ' Version: ' . $theme_version );
}
add_filter( 'update_footer', 'mtctheme_custom_admin_footer', 9999 );

/**
 * Debug Function
 *
 * @param mixed  $input   Input to be printed.
 * @param string $heading Heading for the input.
 *
 * @return void
 */
if ( ! function_exists( 'debug' ) ) {
	function debug( $input, $heading = null ) {
		echo '<pre>';
		if ( ! empty( $heading ) ) {
			echo '<h5>' . esc_html( $heading ) . '</h5>';
		}
		print_r( $input );
		echo '</pre>';
	}
}

/**
 * Function to write to log file
 *
 * @param mixed $log Log to be written.
 *
 * @return void
 */
function write_log( $log ) {
	if ( true === WP_DEBUG ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}


/**
 * Get the theme version
 *
 * @return string
 */
function mtc_get_theme_version() {
	$theme_data = wp_get_theme();
	return $theme_data->get( 'Version' );
}

/**
 * Add Image Sizes
 */
add_image_size( 'card-round', 120, 120, true );
add_image_size( 'card-round-large', 225, 225, true );
add_image_size( 'card-procedure', 350, 240, true );

/**
 * Register Menus.
 *
 * @return void
 */
function mtc_register_menus() {
	register_nav_menus(
		array(
			 'location_usca' => __( 'Menu USCA' ),
			 'location_eume' => __( 'Menu EUME' ),
			'location_aunz' => __( 'Menu AUNZ' ),
			'main-menu'   => __( 'Main Menu', 'mtctheme' ),
			'quick-links' => __( 'Quick Links', 'mtctheme' ),
			'support'     => __( 'Support', 'mtctheme' ),
			// 'fine-print'        => __( 'Fine Print' ),
		)
	);
}
add_action( 'init', 'mtc_register_menus' );

/**
 * Scripts & Styles.
 *
 * Frontend with no conditions, Add Custom styles to wp_head.
 *
 * @return void
 */
function mtc_styles_scripts() {
	// Frontend scripts.
	if ( ! is_admin() ) {
		if ( is_singular( 'listing' ) || is_page_template( 'templates/template-page-about.php' ) || is_page_template( 'templates/template-page-connect.php' ) ) {
			wp_enqueue_script(
				'googlemaps',
				// '//maps.googleapis.com/maps/api/js?key=' . MTCTHEME_GOOGLE_API_KEY . '&v=3&callback=initMap#asyncload',
				'//maps.googleapis.com/maps/api/js?key=' . MTCTHEME_GOOGLE_API_KEY,
				array(),
				null,
				true
			);
		}
		// Enqueue jQuery.
		wp_enqueue_script( 'jquery' );

		// Enqueue vendors first.
		wp_enqueue_script(
			'vendor',
			MTCTHEME_URL . '/assets/js/vendor.min.js',
			array( 'jquery' ),
			MTCTHEME_VER,
			true
		);

		// Enqueue custom JS after vendors.
		wp_enqueue_script(
			'custom',
			MTCTHEME_URL . '/assets/js/custom.min.js',
			array( 'jquery' ),
			MTCTHEME_VER,
			true
		);

		// Enqueue lite youtube.
		wp_enqueue_script(
			'lite-youtube',
			MTCTHEME_URL . '/assets/js/lite-youtube.js',
			array(),
			MTCTHEME_VER,
			true
		);

		// Enqueue popper.
		wp_enqueue_script( 'popper', MTCTHEME_URL . '/assets/js/popper.min.js', array( 'jquery' ), null, true );

		// Enqueue tippy.
		wp_enqueue_script( 'tippy', MTCTHEME_URL . '/assets/js/tippy-bundle.umd.min.js', array( 'jquery' ), null, true );

		// SASS styles.
		wp_enqueue_style(
			'styles',
			MTCTHEME_URL . '/style.css',
			array(),
			MTCTHEME_VER
		);

		// Custom styles.
		if ( file_exists( MTCTHEME_DIR . '/css-edits.css' ) ) {
			wp_enqueue_style(
				'css-edits',
				MTCTHEME_URL . '/css-edits.css',
				array(),
				MTCTHEME_VER
			);
		}

		$php_vars['currency']             = MTCTHEME_CURRENCY;
		$php_vars['nonce']                = wp_create_nonce( 'mtc_nonce' );
		$php_vars['ajaxurl']              = admin_url( 'admin-ajax.php' );
		$php_vars['location_placeholder'] = esc_html__( 'All Locations', 'mtctheme' );
		wp_localize_script( 'custom', 'php_vars', $php_vars );
		wp_localize_script( 'admin', 'php_vars', $php_vars );
	}
}

add_action( 'wp_enqueue_scripts', 'mtc_styles_scripts' );

/**
 * Add type="module" to script tag.
 *
 * @param string $tag    Script tag.
 * @param string $handle Script handle.
 * @param string $src    Script source.
 *
 * @return string
 */
function mtc_add_type_attribute( $tag, $handle, $src ) {
	// if not your script, do nothing and return original $tag.
	if ( 'lite-youtube' !== $handle ) {
		return $tag;
	}

	// change the script tag by adding type="module" and return it.
	$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	return $tag;
}
add_filter( 'script_loader_tag', 'mtc_add_type_attribute', 10, 3 );


/**
 * Admin Scripts & Styles.
 *
 * @return void
 */
function mtc_admin_styles_scripts() {
	// Admin scripts.
	if ( is_admin() ) {
		// Enqueue TinyMCE.
		wp_enqueue_editor();
		wp_enqueue_media();

		// Enqueue jQuery.
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );

		// Enqueue Custom Admin JS.
		wp_enqueue_script(
			'admin',
			MTCTHEME_URL . '/assets/js/admin.js',
			array( 'jquery', 'jquery-ui-autocomplete', 'wp-tinymce' ),
			MTCTHEME_VER,
			true
		);

		wp_enqueue_script(
			'cmb2-conditionals',
			MTCTHEME_URL . '/includes/cmb2-conditionals/cmb2-conditionals.js',
			array( 'jquery' ),
		);

		$screen = get_current_screen();

		// Prepare the data you want to send.
		$screen_data = array(
			'id'   => $screen->id,
			'base' => $screen->base,
		);
		wp_localize_script(
			'admin',
			'ajax_object',
			array(
				'ajaxurl'    => admin_url( 'admin-ajax.php' ),
				'screenData' => $screen_data,
			)
		);

		// Enqueue Custom Admin CSS.
		wp_enqueue_style(
			'admin',
			MTCTHEME_URL . '/assets/css/admin/admin.css',
			array(),
			MTCTHEME_VER
		);
	}
}

add_action( 'admin_enqueue_scripts', 'mtc_admin_styles_scripts', 9999 );

/**
 * WordPress Cache Busting made simple.
 *
 * @param string $src URL of the script.
 *
 * @return string
 */
function mtc_set_styles_scripts_version( $src ) {

	$_src = $src;
	if ( strpos( $_src, '//' ) === 0 ) {
		$_src = 'http:' . $_src;
	}

	$_src = wp_parse_url( $_src );

	// Give up if malformed URL.
	if ( false === $_src ) {
		return $src;
	}

	// Check if it's a local URL.
	$wordpress_url = wp_parse_url( home_url() );
	if ( isset( $_src['host'] ) && $_src['host'] !== $wordpress_url['host'] ) {
		return $src;
	}

	$file_path = ABSPATH . $_src['path'];
	if ( file_exists( $file_path ) && strpos( $src, 'ver=' ) !== false ) {
		$src = add_query_arg( 'ver', hash_file( 'md5', $file_path ), $src );
	}

	return $src;
}

/**
 * Add versioning to CSS and JS files.
 *
 * @return void
 */
function mtc_styles_scripts_version() {
	add_filter( 'style_loader_src', 'mtc_set_styles_scripts_version', 9999 );
	add_filter( 'script_loader_src', 'mtc_set_styles_scripts_version', 9999 );
}

add_action( 'init', 'mtc_styles_scripts_version' );

/**
 * Disable Gutenberg editor on the backend.
 */
add_filter( 'use_block_editor_for_post', '__return_false', 10 );
add_filter( 'use_block_editor_for_page', '__return_false', 10 );

/**
 * Disable main editor for posts.
 *
 * @return void
 */
function mtc_disable_content_editor() {
	remove_post_type_support( 'post', 'editor' );
}
add_action( 'init', 'mtc_disable_content_editor' );

/**
 * Add Post Thumbnails Support.
 */
add_theme_support( 'post-thumbnails' );

/**
 * TinyMCE Plugins
 *
 * @param array $plugins Array of plugins.
 *
 * @return array
 */
function mtctheme_add_plugins_to_tinymce( $plugins ) {
	$plugins['inline-codes']  = MTCTHEME_URL . '/includes/tinymce/plugins/mtctheme/inline-codes-plugin.js';
	$plugins['metabox-codes'] = MTCTHEME_URL . '/includes/tinymce/plugins/mtctheme/metabox-shortcodes-plugin.js';
	$plugins['table']         = MTCTHEME_URL . '/includes/tinymce/plugins/table/plugin.min.js';
	return $plugins;
}
add_filter( 'mce_external_plugins', 'mtctheme_add_plugins_to_tinymce' );

/**
 * TinyMCE Custom CSS
 */
function mtctheme_enqueue_custom_tinymce_stylesheet() {
	global $typenow;
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	wp_register_style( 'tinymce-custom', MTCTHEME_URL . '/includes/tinymce/plugins/mtctheme/tinymce-custom.css', false );
	wp_enqueue_style( 'tinymce-custom' );
}
add_action( 'admin_head', 'mtctheme_enqueue_custom_tinymce_stylesheet' );

/**
 * TinyMCE Buttons Row 1
 *
 * @param array $buttons Array of buttons.
 *
 * @return array
 */
function mtctheme_tinymce_buttons_row_1( $buttons ) {
	$buttons = array(
		'formatselect',
		'bold',
		'italic',
		'bullist',
		'numlist',
		// 'blockquote',
		'alignleft',
		'aligncenter',
		'alignright',
		'link',
		'wp_more',
		'spellchecker',
		'fullscreen',
		'wp_adv',
	);
	return $buttons;
}
add_filter( 'mce_buttons', 'mtctheme_tinymce_buttons_row_1' );

/**
 * TinyMCE Buttons Row 2
 *
 * @param array $buttons Array of buttons.
 *
 * @return array
 */
function mtctheme_tinymce_buttons_row_2( $buttons ) {
	$id       = get_the_id();
	$template = get_post_meta( $id, '_wp_page_template', true );
	if ( 'templates/template-page-fine-print.php' === $template ) {
		$custom = array( 'blue', 'reference', 'abbreviation', 'donotread', 'columns', 'table' );
		foreach ( $custom as $button ) {
			array_unshift( $buttons, $button );
		}
	} else {
		// $custom = array( 'redo', 'undo', 'indent', 'outdent', 'charmap', 'removeformat', 'pastetext', 'forecolor', 'hr', 'strikethrough', 'reference', 'abbreviation', 'donotread', 'columns', 'table', 'metaboxes' );
		// foreach ( $custom as $button ) {
		// array_unshift( $buttons, $button );
		// }
		// $buttons = array( 'metaboxes', 'table', 'columns', 'donotread', 'abbreviation', 'reference', 'box', 'question', 'strikethrough', 'hr', 'forecolor', 'pastetext', 'removeformat', 'charmap', 'outdent', 'indent', 'undo', 'redo' );
		$buttons = array( 'metaboxes', 'table', 'columns', 'accordion', 'tabs', 'carousel', 'heading', 'abbreviation', 'reference', 'box', 'question', 'quote', 'cta', 'youtube', 'bibliography', 'donotread' );
	}
	return $buttons;
}
add_filter( 'mce_buttons_2', 'mtctheme_tinymce_buttons_row_2' );

/**
 * Re-orders tabs in the WordPress Admin menu.
 *
 * @param array $menu_ord Menu order.
 *
 * @return array
 */
function mtc_custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) {
		return true;
	}
	return array(
		'index.php',
		'separator1',
		'edit.php?post_type=page',
		'edit.php',
		'edit.php?post_type=listing',
		'edit.php?post_type=doctor',
		'edit.php?post_type=package',
		'edit.php?post_type=testimonial',
		'wpbr',
		'edit.php?post_type=hotel',
		'edit.php?post_type=reviewer',
		'link-manager.php',
		'upload.php',
		'edit-comments.php',
		'mtctheme_theme_options',
		'mtc_form_options',
		'separator2',
		'themes.php',
		'plugins.php',
		'users.php',
		'tools.php',
		'test',
		'options-general.php',
	);
}
add_filter( 'custom_menu_order', 'mtc_custom_menu_order' );
add_filter( 'menu_order', 'mtc_custom_menu_order' );


/**
 * Get a list of posts.
 *
 * Generic options callback function to return an array of posts.
 *
 * @param string $post_type   The post type to query.
 * @param array  $custom_args Custom arguments to pass to WP_Query.
 *
 * @return array An array of posts.
 */
function mtc_get_post_options( $post_type = 'post', $custom_args = array() ) {
	// Default arguments.
	$default_args = array(
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'no_found_rows'  => true,
		'cache_results'  => false,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);

	// Merge default arguments with custom arguments.
	$args = wp_parse_args( $custom_args, $default_args );

	$posts        = new WP_Query( $args );
	$post_options = array();

	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) {
			$posts->the_post();
			if ( 'listing' === $post_type ) {
				$location = get_the_terms( get_the_ID(), 'location' );
				$location = ! empty( $location ) ? $location[0]->name : '';
			}
			if ( ! empty( $location ) ) {
				$post_options[ get_the_ID() ] = get_the_title() . ', ' . $location;
			} else {
				$post_options[ get_the_ID() ] = get_the_title();
			}
		}
	}

	wp_reset_postdata();
	return $post_options;
}


/**
 * Get a list of doctors.
 *
 * @return array An array of posts.
 */
function mtc_get_doctor_options() {
	return mtc_get_post_options( 'doctor' );
}

/**
 * Get a list of packages.
 *
 * @return array An array of posts.
 */
function mtc_get_package_options() {
	return mtc_get_post_options( 'package' );
}

/**
 * Get a list of Written Testimonials
 *
 * @return array An array of posts.
 */
function mtc_get_written_testimonial_options() {
	// return mtc_get_post_options( 'wpbr_review_source' );
	// return mtc_get_post_options( 'wpbr_collection' );.
	return mtc_get_post_options(
		'testimonial',
		array(
			'meta_key'   => MTCTHEME_PREFIX . 'testimonial_type',
			'meta_value' => 'text',
		)
	);
}

/**
 * Get a list of WPBR Reviews
 *
 * @return array An array of posts.
 */
function mtc_get_wpbr_reviews_options() {
	return mtc_get_post_options( 'wpbr_review_source' );
	// return mtc_get_post_options( 'wpbr_collection' );.
}

/**
 * Get a list of Listings
 */
function mtc_get_listing_options() {
	return mtc_get_post_options( 'listing' );
}

/**
 * Get a list of Reviewers
 */
function mtc_get_reviewer_options() {
	return mtc_get_post_options( 'reviewer' );
}

/**
 * Get a list of Hotels
 */
function mtc_get_hotel_options() {
	return mtc_get_post_options( 'hotel' );
}

/**
 * Get a list of Video Testimonials
 *
 * @return array An array of posts.
 */
function mtc_get_video_testimonial_options() {
	return mtc_get_post_options(
		'testimonial',
		array(
			'meta_key'   => MTCTHEME_PREFIX . 'testimonial_type',
			'meta_value' => 'video',
		)
	);
}

/**
 * Get a list of parent procedures
 */
function mtc_get_procedure_options() {
	$procedures        = get_terms(
		array(
			'taxonomy'   => 'procedure',
			'parent'     => 0,
			'hide_empty' => false,
		)
	);
	$procedure_options = array();
	foreach ( $procedures as $procedure ) {
		$procedure_options[ $procedure->term_id ] = $procedure->name;
	}
	return $procedure_options;
}

/**
 * Get a list of all procedures
 */
function mtc_get_all_procedure_options() {
	$procedures        = get_terms(
		array(
			'taxonomy'   => 'procedure',
			'hide_empty' => false,
		)
	);
	$procedure_options = array();
	foreach ( $procedures as $procedure ) {
		$procedure_options[ $procedure->term_id ] = $procedure->name;
	}
	return $procedure_options;
}

/**
 * Get a list of locations
 */
function mtc_get_location_options() {
	$locations        = get_terms(
		array(
			'taxonomy'   => 'location',
			'parent'     => 0,
			'hide_empty' => false,
		)
	);
	$location_options = array();
	foreach ( $locations as $location ) {
		$location_options[ $location->term_id ] = $location->name;
	}
	return $location_options;
}

/**
 * AJAX response function for mtc_tabs_doctor_autocomplete
 */
function mtc_tabs_doctor_autocomplete_ajax_handler() {
	$options = mtc_get_doctor_options();
	$results = array();
	foreach ( $options as $id => $title ) {
		$results[] = array(
			'label' => $title,
			'value' => $id,
		);
	}
	wp_send_json( $results );
}

add_action( 'wp_ajax_mtc_tabs_doctor_autocomplete_ajax_handler', 'mtc_tabs_doctor_autocomplete_ajax_handler' );

/**
 * AJAX response function to get post title by ID
 */
function mtc_get_post_title_by_id_ajax_handler() {
	// // Verify the nonce first.
	// if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mtc_nonce' ) ) {
	// wp_die( 'Nonce verification failed', 'Unauthorized Access', array( 'response' => 403 ) );
	// }
	$post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
	if ( $post_id > 0 ) {
		$post_title = get_the_title( $post_id );
		wp_send_json_success( array( 'title' => $post_title ) );
	} else {
		wp_send_json_error();
	}
}

add_action( 'wp_ajax_get_post_title_by_id', 'mtc_get_post_title_by_id_ajax_handler' );

/**
 * Get Names from IDs
 *
 * @param array $field_args Field arguments.
 * @param array $field      Field object.
 *
 * @return void
 */
function mtctheme_get_names_from_ids_cb( $field_args, $field ) {
	$ids = explode( ', ', $field->value );
	echo '<ul>';
	foreach ( $ids as $id ) {
		echo esc_html( '<li>' . get_the_title( $id ) . '</li>' );
	}
	echo '</ul>';
}


/**
 * Get preview of oEmbed URL
 *
 * @return void
 */
function mtc_get_oembed_preview_callback() {
	$oembed_url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';
	if ( ! empty( $oembed_url ) ) {
		$embed_code = wp_oembed_get( $oembed_url );
		if ( $embed_code ) {
			echo wp_kses_post( $embed_code );
		} else {
			echo 'Invalid oEmbed URL.';
		}
	}
	// this is required to terminate immediately and return a proper response.
	wp_die();
}

add_action( 'wp_ajax_get_oembed_preview', 'mtc_get_oembed_preview_callback' );


/**
 * Extract YouTube ID from URL
 *
 * @param string $url YouTube URL.
 *
 * @return string|bool
 */
function mtc_get_youtube_id( $url ) {
	$pattern =
		'%(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com/watch\?v=)([\w-]{11})(?:&|$)%';

	$result = preg_match( $pattern, $url, $matches );
	if ( $result ) {
		return $matches[1];
	}

	return false;
}

/**
 * Create lite-youtube embed
 *
 * @param string $video_id  Video ID.
 * @param string $video_url Video URL.
 * @param string $title    Title.
 *
 * @return string
 */
function mtc_create_lite_youtube_embed( $video_id, $video_url, $title ) {
	return '<lite-youtube videoid="' . $video_id . '" posterquality="maxresdefault">
<a class="lite-youtube-fallback" href="' . $video_url . '">Watch on YouTube: "' . $title . '"</a>
</lite-youtube>';
}

/**
 * Return Media attachment along with all details using attachment ID
 *
 * @param int $attachment_id Attachment ID.
 *
 * @return array
 */
function mtc_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption'     => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href'        => get_permalink( $attachment->ID ),
		'src'         => $attachment->guid,
		'title'       => $attachment->post_title,
	);
}

/**
 * Disable editor, posts and featured image on specific page templates
 *
 * @return void
 */
function mtc_disable_editor_thumbnail_on_page_templates() {
	if ( isset( $_GET['post'] ) ) {
		$id       = $_GET['post'];
		$template = get_post_meta( $id, '_wp_page_template', true );
		switch ( $template ) {
				// Disable Editor & Featured Image (supports multiple case args).
			case 'front-page.php':
			case 'templates/template-page-how-this-works.php':
			case 'templates/template-page-news.php':
			case 'templates/template-page-thank-you.php':
			case 'templates/template-page-add-a-partner.php':
			case 'templates/template-page-add-a-partner-form.php':
			case 'templates/template-page-request-quote.php':
			case 'templates/template-page-about.php':
			case 'templates/template-page-connect.php':
			case 'templates/template-page-procedures.php':
			case 'templates/template-page-destinations.php':
			case 'templates/template-page-testimonials.php':
				remove_post_type_support( 'page', 'editor' );
				remove_post_type_support( 'page', 'thumbnail' );
				break;
			default:
				// Don't remove any other template.
				break;
		}

		if ( mtc_show_if_front_page() ) {
			remove_post_type_support( 'page', 'editor' );
			remove_post_type_support( 'page', 'thumbnail' );
		}
	}
}
add_action( 'init', 'mtc_disable_editor_thumbnail_on_page_templates' );

/**
 * Clean empty fields from the post_section group field before saving.
 *
 * @param int    $post_id The ID of the post being saved.
 * @param array  $field_args The field arguments.
 * @param array  $field The field object.
 * @param object $cmb2 The CMB2 instance.
 */
function mtc_clean_empty_fields_on_save( $post_id, $field_args, $field, $cmb2 ) {
	if ( isset( $_GET['post'] ) ) {
		$id       = $_GET['post'];
		$template = get_post_meta( $id, '_wp_page_template', true );
		switch ( $template ) {
			case 'templates/template-page-how-this-works.php':
				$metakey = 'faq';
				break;
			default:
				$metakey = '';
				break;
		}

		$group_values = get_post_meta( $post_id, MTCTHEME_PREFIX . $metakey, true );

		if ( empty( $group_values ) ) {
			return;
		}

		$group_values = mtc_clean_recursive( $group_values );

		// Uncomment the line below to update the meta field with cleaned data.
		update_post_meta( $post_id, MTCTHEME_PREFIX . $metakey, $group_values );
	}
}
add_action( 'cmb2_save_page_fields_mtctheme_how_this_works_metabox', 'mtc_clean_empty_fields_on_save', 10, 3 );

/**
 * Recursively clean empty elements from an array.
 *
 * @param array $value The array/string to clean.
 * @return array The cleaned array.
 */
function mtc_clean_recursive( $value ) {
	if ( ! is_array( $value ) ) {
		// If it's not an array, return the value as is, unless it's an empty string.
		return ( is_string( $value ) && empty( $value ) ) ? null : $value;
	}

	foreach ( $value as $key => &$sub_value ) {
		$sub_value = mtc_clean_recursive( $sub_value );

		// Remove the element if it's null or an empty array.
		if ( null === $sub_value || ( is_array( $sub_value ) && empty( $sub_value ) ) ) {
			unset( $value[ $key ] );
		}
	}

	return $value;
}

/**
 * Add Favicon
 *
 * @return void
 */
function mtc_add_favicon() {
	echo '<link rel="shortcut icon" href="' . esc_attr( get_stylesheet_directory_uri() ) . '/favicon.ico" />';
}
add_action( 'wp_head', 'mtc_add_favicon' );
// add_action( 'admin_head', 'mtc_add_favicon' );.

/**
 * Get all the reviews for a listing
 *
 * @param int $id Listing ID.
 *
 * @return array
 */
function mtc_get_listing_reviews( $id ) {
	$reviews      = array();
	$testimonials = get_post_meta( $id, MTCTHEME_PREFIX . 'listing_testimonials', true );
	if ( ! empty( $testimonials ) ) {
		$args = array(
			'post_type'      => 'wpbr_review',
			'posts_per_page' => -1,
			'post_parent'    => $testimonials,
		);

		$posts = new WP_Query( $args );

		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) {
				$posts->the_post();
				$id        = get_the_ID();
				$reviews[] = array(
					'title'   => get_the_title(),
					'content' => get_the_content(),
					'meta'    => get_post_meta( $id ),
				);
			}
		}

		wp_reset_postdata();
	}
	return $reviews;
}

/**
 * Get all the reviews by source id
 *
 * @param int $source_id Source ID.
 *
 * @return array
 */
function mtc_get_reviews_by_source_id( $source_id ) {
	$reviews = array();
	$args    = array(
		'post_type'      => 'wpbr_review',
		'posts_per_page' => -1,
		'post_parent'    => $source_id,
	);

	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) {
			$posts->the_post();
			$id        = get_the_ID();
			$reviews[] = array(
				'title'   => get_the_title(),
				'content' => get_the_content(),
				'meta'    => get_post_meta( $id ),
			);
		}
	}

	wp_reset_postdata();

	return $reviews;
}

/**
 * Maybe create the currency table
 */
function mtc_currency_converter_maybe_create_table() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name      = $wpdb->prefix . 'mtc_currency';
	$sql             = "CREATE TABLE $table_name (
id mediumint(9) NOT NULL AUTO_INCREMENT,
name text(3) NOT NULL,
symbol text(5) NOT NULL,
value float(20) NOT NULL,
UNIQUE KEY id (id)
) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	maybe_create_table( $table_name, $sql );
}
add_action( 'after_setup_theme', 'mtc_currency_converter_maybe_create_table' );

/**
 * Get the exchange rate from the API.
 */
function mtc_get_exchange_rates() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'mtc_currency';
	$response   = wp_remote_get( 'https://v6.exchangerate-api.com/v6/02d9e57796fc17938896a25c/latest/USD' );
	$jsondata   = wp_remote_retrieve_body( $response );
	$data       = json_decode( $jsondata, true );
	if ( ! empty( $data ) && 'success' === $data['result'] ) {
		/*Check if values exist*/
		$run_once = get_option( 'currency_check' );
		if ( ! $run_once ) {
			/*Insert values if they done exist*/
			$symbols = array(
				'USD' => '$',
				'CAD' => '$',
				'THB' => '฿',
				'INR' => '₹',
				'AUD' => '$',
				'CNY' => '¥',
				'DKK' => 'Kr.',
				'IDR' => 'Rp',
				'MXN' => '$',
				'PHP' => '₱',
				'COP' => '$',
				'EUR' => '€',
				'KRW' => '₩',
				'NZD' => '$',
				'GBP' => '£',
				'CRC' => '₡',
				'HKD' => '$',
				'MYR' => 'RM',
				'NOK' => 'kr',
				'SGD' => '$',
				'VND' => '₫',
				'AED' => 'د.إ',
				'AFN' => '؋',
			);
			foreach ( $data['conversion_rates'] as $key => $value ) {
				$wpdb->insert(
					$table_name,
					array(
						'name'   => $key,
						'value'  => $value,
						'symbol' => $symbols[ $key ],
					),
					array( '%s', '%f', '%s' )
				);
			}
			write_log( 'Conversion Rates Inserted' );
			update_option( 'currency_check', true );
		} else {
			foreach ( $data['conversion_rates'] as $key => $value ) {
				/*Update values if they do exist*/
				$wpdb->update( $table_name, array( 'value' => $value ), array( 'name' => $key ), array( '%f' ), array( '%s' ) );
			}
			write_log( 'Conversion Rates Updated' );
		}
		write_log( 'Conversion Rates API Success' );
	} else {
		write_log( 'Conversion Rates API Error' );
	}
}

/**
 * Get the currency convertor dropdown
 *
 * @param string $tableid Table ID.
 *
 * @return void
 */
function mtc_currency_convertor_dropdown( $tableid = '' ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'mtc_currency';
	$data       = $wpdb->get_results( "SELECT * FROM $table_name" );

	echo '<div class="currency-convertor">';
	echo 'Select your Currency';
	echo '<select class="mtc-ccdd ' . esc_attr( $tableid ) . '">';

	foreach ( $data as $currency ) {
		echo '<option value="' . esc_html( $currency->name ) . '" data-rate="' . esc_html( $currency->value ) . '" data-symbol="' . esc_html( $currency->symbol ) . '">';
		echo esc_html( $currency->name ) . ' ' . esc_html( $currency->symbol );
		echo '</option>';
	}
	echo '</select>';
	echo '</div>';
}

/**
 * Add Cron Schedules
 */
add_filter(
	'cron_schedules',
	function ( $schedules ) {
		$schedules['per_minute']       = array(
			'interval' => 60,
			'display'  => __( 'One Minute', 'mtctheme' ),
		);
		$schedules['every_two_hours']  = array(
			'interval' => 7200,
			'display'  => __( 'Every Two Hours', 'mtctheme' ),
		);
		$schedules['every_four_hours'] = array(
			'interval' => 14400,
			'display'  => __( 'Every Four Hours', 'mtctheme' ),
		);
		return $schedules;
	}
);

/**
 * Clear Cron Schedules
 *
 * @return void
 */
function mtc_deactivate() {
	wp_clear_scheduled_hook( 'mtc_cron' );
}

/**
 * Cron Job to get the exchange rates
 */
add_action(
	'init',
	function () {
		add_action( 'mtc_cron', 'mtc_get_exchange_rates' );
		register_deactivation_hook( __FILE__, 'mtc_deactivate' );

		if ( ! wp_next_scheduled( 'mtc_cron' ) ) {
			wp_schedule_event( time(), 'every_four_hours', 'mtc_cron' );
		}
	}
);


/**
 * Get the user's IP Address
 *
 * @return string
 */
function mtc_get_user_ip() {
	// Get real visitor IP behind CloudFlare network.
	if ( isset( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
		$_SERVER['REMOTE_ADDR']    = $_SERVER['HTTP_CF_CONNECTING_IP'];
		$_SERVER['HTTP_CLIENT_IP'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	$client  = ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ? $_SERVER['HTTP_CLIENT_IP'] : '';
	$forward = ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';
	$remote  = ! empty( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '';
	if ( filter_var( $client, FILTER_VALIDATE_IP ) ) {
		$ip = $client;
	} elseif ( filter_var( $forward, FILTER_VALIDATE_IP ) ) {
		$ip = $forward;
	} else {
		$ip = $remote;
	}

	return $ip;
}

/**
 * Geolocate Visitor by IP
 *
 * @param string $ip IP Address.
 *
 * @return array
 */
function mtc_geolocate_visitor( $ip ) {
	$data = array();
	$ch   = curl_init();
	curl_setopt( $ch, CURLOPT_URL, 'http://api.ipstack.com/' . $ip . '?access_key=bb73fa63c33773ddcfb3f8b976b8caaf' );
	curl_setopt( $ch, CURLOPT_HTTPGET, 1 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$results = json_decode( curl_exec( $ch ), true );
	curl_close( $ch );
	// array of middle east countries in ISO 3166-1 alpha-2 format.
	$middleeast = array( 'AE', 'AF', 'AM', 'AZ', 'BH', 'CY', 'DZ', 'EG', 'GE', 'IL', 'IQ', 'IR', 'JO', 'KW', 'LB', 'OM', 'PS', 'QA', 'SA', 'SY', 'TR', 'YE' );

	if ( 'EU' === $results['continent_code'] || in_array( $results['country_code'], $middleeast ) ) {
		$results['metakey'] = 'eume';
	} elseif ( 'AU' === $results['country_code'] || 'NZ' === $results['country_code'] ) {
		$results['metakey'] = 'aunz';
	} else {
		$results['metakey'] = 'usca';
	}
	return $results;
}

/**
 * Get Current URL
 *
 * @return string
 */
function mtc_get_current_url() {
	$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https://' : 'http://';
	$url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $url;
}

/**
 * Truncate reviews
 *
 * @param string $input_string String to truncate.
 * @param string $read_more_link Read more link.
 * @param int    $limit Limit.
 *
 * @return string
 */
function mtc_truncate_review( $input_string, $read_more_link = '#', $limit = 150 ) {
	if ( strlen( $input_string ) > $limit ) {
		// Truncate the string to 150 characters.
		$input_string = substr( $input_string, 0, $limit ) . '... ';

		// Add the read more link.
		$input_string .= '<a target="_blank" href="' . esc_attr( $read_more_link ) . '">Read more</a>';
	}

	return $input_string;
}


/**
 * Enqueue scripts asynchronously.
 *
 * @param string $url Script URL.
 *
 * @return string
 */
function mtc_add_async_forscript( $url ) {
	if ( strpos( $url, '#asyncload' ) === false ) {
		return $url;
	} elseif ( is_admin() ) {
		return str_replace( '#asyncload', '', $url );
	} else {
		return str_replace( '#asyncload', '', $url ) . ' async="async"';
	}
}
add_filter( 'clean_url', 'mtc_add_async_forscript', 11, 1 );


/**
 * Function to update Hotel Metadata from Google Places API
 */
function mtc_update_hotel_metadata_with_google_data() {
	// Get all published posts of the hotel post type.
	$args = array(
		'post_type'      => 'hotel',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_query'     => array(
			array(
				'key'     => MTCTHEME_PREFIX . 'hotel_place_id',
				'compare' => 'EXISTS',
			),
		),
	);

	$hotel_posts     = get_posts( $args );
	$total_posts     = count( $hotel_posts );
	$completed_posts = 0;

	foreach ( $hotel_posts as $post ) {
		$placeid = get_post_meta( $post->ID, MTCTHEME_PREFIX . 'hotel_place_id', true );

		// Make the CURL request to Google Maps API.
		$api_url = 'https://maps.googleapis.com/maps/api/place/details/json';
		$api_key = 'AIzaSyAZx19-pN4sdXpKlebq5deua2RnTsty3Q8';

		$curl_url =
			"$api_url?fields=place_id,rating,user_ratings_total,formatted_address,photos&place_id=$placeid&key=$api_key";

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $curl_url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$response = curl_exec( $ch );
		curl_close( $ch );

		// Parse the JSON response.
		$data = json_decode( $response, true );

		if ( $data && isset( $data['result'] ) ) {
			$rating             = $data['result']['rating'];
			$user_ratings_total = $data['result']['user_ratings_total'];
			$address            = $data['result']['formatted_address'];

			// Check if the post already has an image.
			$existing_image_id = get_post_meta( $post->ID, MTCTHEME_PREFIX . 'hotel_image_id', true );

			if ( empty( $existing_image_id ) && ! empty( $data['result']['photos'][0] ) ) {
				$photoreference = $data['result']['photos'][0]['photo_reference'];
				$api_url        = 'https://maps.googleapis.com/maps/api/place/photo';
				$curl_url       = "$api_url?maxwidth=120&photo_reference=$photoreference&key=$api_key";
				$ch             = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $curl_url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				$photo = curl_exec( $ch );
				curl_close( $ch );

				// Check if the response is a redirect.
				if ( strpos( $photo, '302 Moved' ) !== false ) {
					// Extract the new URL.
					preg_match( '/<A HREF="(.*?)">/', $photo, $matches );
					if ( ! empty( $matches[1] ) ) {
						$curl_url = $matches[1];
						$ch       = curl_init();
						curl_setopt( $ch, CURLOPT_URL, $curl_url );
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
						$photo = curl_exec( $ch );
						curl_close( $ch );
					}
				}

				// Save the photo data to a file in /tmp directory.
				$file_path = '/tmp/' . $post->ID . '.jpg';
				file_put_contents( $file_path, $photo );

				// Prepare the file for upload to WordPress.
				$file_array = array(
					'name'     => $post->ID . '.jpg',
					'tmp_name' => $file_path,
				);

				// Check for download errors.
				if ( is_wp_error( $file_array ) ) {
					@unlink( $file_path );
					return $file_array;
				}

				// Upload the photo to WordPress.
				$id = media_handle_sideload( $file_array, $post->ID );

				// Check for upload errors.
				if ( is_wp_error( $id ) ) {
					@unlink( $file_path );
					return $id;
				}

				// Update the post meta data.
				update_post_meta( $post->ID, MTCTHEME_PREFIX . 'hotel_image', $id );
				update_post_meta( $post->ID, MTCTHEME_PREFIX . 'hotel_image_id', $id );
			}

			// Update the metadata fields.
			update_post_meta( $post->ID, MTCTHEME_PREFIX . 'hotel_rating', $rating );
			update_post_meta( $post->ID, MTCTHEME_PREFIX . 'hotel_reviews', $user_ratings_total );
			update_post_meta( $post->ID, MTCTHEME_PREFIX . 'hotel_address', $address );
		}

		// Log or print progress.
		++$completed_posts;
		$progress_percent = ( $completed_posts / $total_posts ) * 100;
		// error_log( "Progress: $completed_posts / $total_posts ($progress_percent%)" );
		// Or you can use echo instead of error_log if you prefer printing to the screen.
		echo "Progress: $completed_posts / $total_posts ($progress_percent%)<br>";
	}
}
add_action( 'update_hotel_metadata', 'mtc_update_hotel_metadata_with_google_data' );

/**
 * Schedule the function to run once a week
 *
 * @return void
 */
function mtc_schedule_hotel_metadata_update() {
	if ( ! wp_next_scheduled( 'update_hotel_metadata' ) ) {
		wp_schedule_event( time(), 'weekly', 'update_hotel_metadata' );
	}
}
add_action( 'wp', 'mtc_schedule_hotel_metadata_update' );

/**
 * Save all meta data to revision
 *
 * @param int    $post_id Post ID.
 * @param object $post Post object.
 *
 * @return void
 */
function mtc_save_all_meta_to_revision( $post_id, $post ) {
	$parent_id = wp_is_post_revision( $post_id );
	if ( $parent_id ) {
		$parent_meta = get_post_meta( $parent_id );

		foreach ( $parent_meta as $key => $values ) {
			if ( 0 === strpos( $key, MTCTHEME_PREFIX ) ) {
				$value = $values[0];

				// Check if the value is a serialized string, and unserialize it if necessary.
				if ( is_serialized( $value, true ) ) {
					$unserialized_value = maybe_unserialize( $value );
					add_metadata( 'post', $post_id, $key, $unserialized_value );
				} else {
					add_metadata( 'post', $post_id, $key, $value );
				}
			}
		}
	}
}
add_action( 'save_post', 'mtc_save_all_meta_to_revision', 10, 2 );

/**
 * Restore all meta data from revision
 *
 * @param int $post_id Post ID.
 * @param int $revision_id Revision ID.
 *
 * @return void
 */
function mtc_restore_all_meta_from_revision( $post_id, $revision_id ) {
	$revision_meta = get_post_meta( $revision_id );

	foreach ( $revision_meta as $key => $values ) {
		$value = $values[0];
		// Check if the value is a serialized string, and unserialize it if necessary.
		if ( is_serialized( $value, true ) ) {
			$unserialized_value = maybe_unserialize( $value );
			update_post_meta( $post_id, $key, $unserialized_value );
		} else {
			update_post_meta( $post_id, $key, $value );
		}
	}
}
add_action( 'wp_restore_post_revision', 'mtc_restore_all_meta_from_revision', 10, 2 );


/**
 * Trigger a revision when a CMB2 field is updated.
 *
 * @param int    $object_id The ID of the object being saved.
 * @param array  $updated   An array of fields that were updated.
 * @param object $cmb       The CMB2 object.
 * @param object $update_object The updated object.
 *
 * @return void
 */
function mtc_trigger_revision_on_cmb2_save( $object_id, $updated, $cmb, $update_object ) {
	// Ensure this is not an autosave or a revision being saved.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || wp_is_post_revision( $object_id ) || wp_is_post_autosave( $object_id ) || empty( $cmb ) ) {
		return;
	}

	// Get the post object to create a revision from.
	$post = get_post( $object_id );
	if ( ! $post || 'page' === $post->post_type ) {
		return;
	}

	// Store all meta data in the post content temporarily.
	$meta_data              = get_post_meta( $object_id );
	$post_content_temporary = '<!-- META DATA -->
	';
	foreach ( $meta_data as $key => $values ) {
		if ( 0 === strpos( $key, MTCTHEME_PREFIX ) ) {
			$value                   = $values[0];
			$post_content_temporary .= $key . ' = ' . json_encode( maybe_unserialize( $value ), JSON_PRETTY_PRINT ) . '
			';
		}
	}

	// Remove the action to prevent infinite loop.
	remove_action( 'cmb2_save_post_fields', 'mtc_trigger_revision_on_cmb2_save', 10 );

	// Update the post, which should trigger a revision due to the content change.
	wp_update_post(
		array(
			'ID'           => $object_id,
			'post_content' => $post_content_temporary,
		)
	);

	// Re-hook the action.
	add_action( 'cmb2_save_post_fields', 'mtc_trigger_revision_on_cmb2_save', 10, 4 );
}
add_action( 'cmb2_save_post_fields', 'mtc_trigger_revision_on_cmb2_save', 10, 4 );

/**
 * Return summary field content from the post section metadata.
 *
 * @param int $id Post ID.
 *
 * @return string
 */
function mtc_get_post_summary( $id ) {
	$summary  = '';
	$limit    = 100;
	$postmeta = get_post_meta( $id, MTCTHEME_PREFIX . 'synopsis', true );
	if ( empty( $postmeta ) ) {
		return $summary;
	}
	$summary = wp_strip_all_tags( $postmeta, true );
	$summary = substr( $postmeta, 0, $limit ) . '... ';

	return $summary;
}

/**
 * Rewrite Rules
 */
function mtc_rewrite_rules() {
	// Rewrite blog/page/{pagenumber}.
	add_rewrite_rule(
		'blog/page/([^/]*)/?$',
		'index.php?paged=$matches[1]&post_type=post',
		'top'
	);
	// Rewrite blog/search/{search-term}/.
	add_rewrite_rule(
		'blog/search/([^/]*)/?$',
		'index.php?search=$matches[1]&post_type=post',
		'top'
	);
	// Rewrite blog/search/{search-term}/page/{pagenumber}.
	add_rewrite_rule(
		'blog/search/([^/]*)/page/([^/]*)/?$',
		'index.php?search=$matches[1]&paged=$matches[2]&post_type=post',
		'top'
	);
	// Rewrite blog/search/{search-term}/{procedure}/.
	add_rewrite_rule(
		'blog/search/([^/]*)/([^/]*)/?$',
		'index.php?search=$matches[1]&procedure=$matches[2]&post_type=post',
		'top'
	);
	// Rewrite blog/search/{search-term}/{procedure}/page/{pagenumber}.
	add_rewrite_rule(
		'blog/search/([^/]*)/([^/]*)/page/([^/]*)/?$',
		'index.php?search=$matches[1]&procedure=$matches[2]&paged=$matches[3]&post_type=post',
		'top'
	);
	// Rewrite blog/search/{search-term}/{procedure}/{country}/.
	add_rewrite_rule(
		'blog/search/([^/]*)/([^/]*)/([^/]*)/?$',
		'index.php?search=$matches[1]&procedure=$matches[2]&country=$matches[3]&post_type=post',
		'top'
	);
	// Rewrite blog/search/{search-term}/{procedure}/{country}/page/{pagenumber}.
	add_rewrite_rule(
		'blog/search/([^/]*)/([^/]*)/([^/]*)/page/([^/]*)/?$',
		'index.php?search=$matches[1]&procedure=$matches[2]&country=$matches[3]&paged=$matches[4]&post_type=post',
		'top'
	);
	// Rewrite blog/search/{search-term}/{procedure}/{country}/{city}/.
	add_rewrite_rule(
		'blog/search/([^/]*)/([^/]*)/([^/]*)/([^/]*)/?$',
		'index.php?search=$matches[1]&procedure=$matches[2]&country=$matches[3]&city=$matches[4]&post_type=post',
		'top'
	);
	// Rewrite blog/search/{search-term}/{procedure}/{country}/{city}/page/{pagenumber}.
	add_rewrite_rule(
		'blog/search/([^/]*)/([^/]*)/([^/]*)/([^/]*)/page/([^/]*)/?$',
		'index.php?search=$matches[1]&procedure=$matches[2]&country=$matches[3]&city=$matches[4]&paged=$matches[5]&post_type=post',
		'top'
	);
	// Rewrite blog/{procedure}/.
	add_rewrite_rule(
		'blog/([^/]*)/?$',
		'index.php?procedure=$matches[1]&post_type=post',
		'top'
	);
	// Rewrite blog/{procedure}/page/{pagenumber}.
	add_rewrite_rule(
		'blog/([^/]*)/page/([^/]*)/?$',
		'index.php?procedure=$matches[1]&paged=$matches[2]&post_type=post',
		'top'
	);
	// Rewrite blog/{procedure}/{country}/.
	add_rewrite_rule(
		'blog/([^/]*)/([^/]*)/?$',
		'index.php?procedure=$matches[1]&country=$matches[2]&post_type=post',
		'top'
	);
	// Rewrite blog/{procedure}/{country}/page/{pagenumber}.
	add_rewrite_rule(
		'blog/([^/]*)/([^/]*)/page/([^/]*)/?$',
		'index.php?procedure=$matches[1]&country=$matches[2]&paged=$matches[3]&post_type=post',
		'top'
	);
	// Rewrite blog/{procedure}/{country}/{city}/.
	add_rewrite_rule(
		'blog/([^/]*)/([^/]*)/([^/]*)/?$',
		'index.php?procedure=$matches[1]&country=$matches[2]&city=$matches[3]&post_type=post',
		'top'
	);
	// Rewrite blog/{procedure}/{country}/{city}/page/{pagenumber}.
	add_rewrite_rule(
		'blog/([^/]*)/([^/]*)/([^/]*)/page/([^/]*)/?$',
		'index.php?procedure=$matches[1]&country=$matches[2]&city=$matches[3]&paged=$matches[4]&post_type=post',
		'top'
	);
	// Rewrite request-quote/{listingslug}/.
	add_rewrite_rule(
		'request-quote/([^/]*)/?$',
		'index.php?listingslug=$matches[1]',
		'top'
	);
	// // Rewrite listing/search/{procedure}.
	// add_rewrite_rule(
	// 'listing/search/([^/]*)/?$',
	// 'index.php?procedure=$matches[1]&post_type=listing',
	// 'top'
	// );
	// // Rewrite listing/search/{procedure}/page/{pagenumber}.
	// add_rewrite_rule(
	// 'listing/search/([^/]*)/page/([^/]*)/?$',
	// 'index.php?procedure=$matches[1]&paged=$matches[2]&post_type=listing',
	// 'top'
	// );
	// // Rewrite listing/search/{country}.
	// add_rewrite_rule(
	// 'listing/search/([^/]*)/?$',
	// 'index.php?country=$matches[1]&post_type=listing',
	// 'top'
	// );
	// // Rewrite listing/search/{country}/page/{pagenumber}.
	// add_rewrite_rule(
	// 'listing/search/([^/]*)/page/([^/]*)/?$',
	// 'index.php?country=$matches[1]&paged=$matches[2]&post_type=listing',
	// 'top'
	// );
	// Rewrite listing/search/{procedure}/{country}.
	add_rewrite_rule(
		'listing/search/([^/]*)/([^/]*)/?$',
		'index.php?procedure=$matches[1]&country=$matches[2]&post_type=listing',
		'top'
	);
	// Rewrite listing/search/{procedure}/{country}/page/{pagenumber}.
	add_rewrite_rule(
		'listing/search/([^/]*)/([^/]*)/page/([^/]*)/?$',
		'index.php?procedure=$matches[1]&country=$matches[2]&page=$matches[3]&post_type=listing',
		'top'
	);
	// Rewrite listing/search/{procedure}/{country}/{city}.
	add_rewrite_rule(
		'listing/search/([^/]*)/([^/]*)/([^/]*)/?$',
		'index.php?procedure=$matches[1]&country=$matches[2]&city=$matches[3]&post_type=listing',
		'top'
	);
	// Rewrite listing/search/{procedure}/{country}/{city}/page/{pagenumber}.
	add_rewrite_rule(
		'listing/search/([^/]*)/([^/]*)/([^/]*)/page/([^/]*)/?$',
		'index.php?procedure=$matches[1]&country=$matches[2]&city=$matches[3]&page=$matches[4]&post_type=listing',
		'top'
	);
}
add_action( 'init', 'mtc_rewrite_rules' );


/**
 * Template Redirects
 */
function mtc_custom_redirects() {
	global $wp_query;

	// Current URL
	$current_url = home_url( add_query_arg( null, null ) );

	// Components of the new URL.
	$search    = ! empty( $wp_query->query_vars['search'] ) ? sanitize_text_field( $wp_query->query_vars['search'] ) : '';
	$procedure = ! empty( $wp_query->query_vars['procedure'] ) ? sanitize_text_field( $wp_query->query_vars['procedure'] ) : '';
	$country   = ! empty( $wp_query->query_vars['country'] ) ? sanitize_text_field( $wp_query->query_vars['country'] ) : '';
	$city      = ! empty( $wp_query->query_vars['city'] ) ? sanitize_text_field( $wp_query->query_vars['city'] ) : '';
	$paged     = ! empty( $wp_query->query_vars['paged'] ) ? intval( $wp_query->query_vars['paged'] ) : '';
	$page      = ! empty( $wp_query->query_vars['page'] ) ? intval( $wp_query->query_vars['page'] ) : '';
	$post_type = ! empty( $wp_query->query_vars['post_type'] ) ? sanitize_text_field( $wp_query->query_vars['post_type'] ) : '';
	$listing   = ! empty( $wp_query->query_vars['listing'] ) ? sanitize_text_field( $wp_query->query_vars['listing'] ) : '';

	if ( 'listing' === $post_type && 'search' === $listing ) {
		// Base URL for the redirect.
		$base_url = home_url( '/listing/search/' );
		$new_url  = $base_url;
		// Construct the new URL based on available query vars.
		if ( ! empty( $procedure ) ) {
			$new_url .= $procedure . '/';
		}

		if ( ! empty( $country ) ) {
			$new_url .= $country . '/';
		}

		if ( ! empty( $city ) ) {
			$new_url .= $city . '/';
		}

		if ( ! empty( $page ) ) {
			$new_url .= 'page/' . $page . '/';
		}

		$new_url = trailingslashit( $new_url );

		if ( $current_url !== $new_url ) {
			error_log( '1 Redirecting to: ' . $new_url );
			wp_redirect( $new_url, 301 );
			exit;
		}
	}

	if ( is_home() && ( ! empty( $search ) || ! empty( $procedure ) ) ) {
		// Base URL for the redirect.
		$base_url = home_url( 'blog/' );
		$new_url  = $base_url;

		// Construct the new URL.
		if ( ! empty( $search ) && ! empty( $procedure ) && ! empty( $country ) && ! empty( $city ) ) {
			$new_url .= 'search/' . $search . '/' . $procedure . '/' . $country . '/' . $city;
			error_log( 'C1' );
		} elseif ( ! empty( $search ) && ! empty( $procedure ) && ! empty( $country ) && empty( $city ) ) {
			$new_url .= 'search/' . $search . '/' . $procedure . '/' . $country;
			error_log( 'C2' );
		} elseif ( ! empty( $search ) && ! empty( $procedure ) && empty( $country ) && empty( $city ) ) {
			$new_url .= 'search/' . $search . '/' . $procedure;
			error_log( 'C3' );
		} elseif ( ! empty( $search ) && empty( $procedure ) && empty( $country ) && empty( $city ) ) {
			$new_url .= 'search/' . $search;
			error_log( 'C4' );
		} elseif ( ! empty( $procedure ) && ! empty( $country ) && ! empty( $city ) ) {
			$new_url .= $procedure . '/' . $country . '/' . $city;
			error_log( 'C5' );
		} elseif ( ! empty( $procedure ) && ! empty( $country ) ) {
			$new_url .= $procedure . '/' . $country;
			error_log( 'C6' );
		} elseif ( ! empty( $procedure ) ) {
			$new_url .= $procedure;
			error_log( 'C7' );
		}

		$new_url = trailingslashit( $new_url );

		if ( $current_url !== $new_url ) {
			error_log( '3 Redirecting to: ' . $new_url );
			error_log( '$search: ' . $search );
			error_log( '$procedure: ' . $procedure );
			error_log( '$country: ' . $country );
			error_log( '$city: ' . $city );
			wp_redirect( $new_url, 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'mtc_custom_redirects' );

/**
 * Add custom query vars
 *
 * @param array $vars Query vars.
 *
 * @return array
 */
function mtc_custom_query_vars( $vars ) {
	$vars[] = 'search';
	$vars[] = 'procedure';
	$vars[] = 'country';
	$vars[] = 'city';
	$vars[] = 'listingslug';
	return $vars;
}
add_filter( 'query_vars', 'mtc_custom_query_vars' );

/**
 * Adjust the main query based on custom query vars
 *
 * @param WP_Query $query The main query.
 *
 * @return void
 */
function mtc_adjust_main_query( $query ) {
	// Only modify the main query on the frontend for your specific page
	if ( ! is_admin() && $query->is_main_query() && isset( $query->query_vars['post_type'] ) && 'listing' === $query->query_vars['post_type'] ) {
		// Prevent 404 status by telling WordPress posts are found
		$query->is_404 = false;
		status_header( 200 ); // Set HTTP status to 200 OK

		// Modify the query only if 'all' is not in procedure or country
		$procedure = get_query_var( 'procedure', '' );
		$country   = get_query_var( 'country', '' );

		if ( 'all' === $procedure && 'all' === $country ) {
			// Example: Show all listings if both are 'all'
			$query->set( 'post_type', 'listing' );
			$query->set( 'posts_per_page', -1 ); // or any logic you need
		}

		// Further modify the query as needed...

		return $query;
	}
}
add_action( 'pre_get_posts', 'mtc_adjust_main_query' );


/**
 * Add Template Includes
 *
 * @param string $template Template.
 *
 * @return string
 */
function mtc_template_for_custom_urls( $template ) {
	global $wp_query;

	$search      = get_query_var( 'search' );
	$procedure   = get_query_var( 'procedure' );
	$listingslug = get_query_var( 'listingslug' );
	$posttype    = get_query_var( 'post_type' );

	if ( isset( $listingslug ) && ! empty( $listingslug ) ) {
		return MTCTHEME_DIR . '/templates/template-page-request-quote.php';
	}

	if ( ( ( isset( $procedure ) && ! empty( $procedure ) ) || ( isset( $search ) && ! empty( $search ) ) ) && 'post' === $posttype ) {
		return MTCTHEME_DIR . '/home.php';
	}

	if ( ( ( isset( $procedure ) && ! empty( $procedure ) ) || ( isset( $search ) && ! empty( $search ) ) ) && 'listing' === $posttype ) {
		return MTCTHEME_DIR . '/search-listing.php';
	}
	return $template;
}
add_filter( 'template_include', 'mtc_template_for_custom_urls' );


/**
 * Extract phone number from string
 *
 * @param string $string String to extract phone number from.
 *
 * @return string
 */
function mtc_extract_phone_number( $string ) {
	// Regular expression to find phone numbers in the format +1-800-661-2126.
	// Adjust the pattern as needed to accommodate different phone number formats.
	$pattern = '/\+\d{1,3}-\d{2,4}-\d{3,4}-\d{3,4}|\+\d{1,3}-\d{4,5}-\d{4}/';

	// Use preg_match to find a phone number in the string.
	if ( preg_match( $pattern, $string, $matches ) ) {
		return $matches[0]; // Return the first match found.
	} else {
		return 'No phone number found.';
	}
}

/**
 * Un-wpautop
 *
 * @param string $s String to remove <p> and <br> tags from.
 *
 * @return string
 */
function mtc_un_wpautop( $s ) {
	// remove any new lines already in there.
	$s = str_replace( "\n", '', $s );

	// remove all <p>.
	$s = str_replace( '<p>', '', $s );

	// replace <br /> with \n.
	$s = str_replace( array( '<br />', '<br>', '<br/>' ), "\n", $s );

	// replace </p> with \n\n.
	$s = str_replace( '</p>', "\n\n", $s );

	return $s;
}


/**
 * Determines if the metabox should be shown on the front page.
 *
 * @return bool True if the current page is the front page, false otherwise.
 */
function mtc_show_if_front_page() {
	// // Verify the nonce first.
	// if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mtc_nonce' ) ) {
	// wp_die( 'Nonce verification failed', 'Unauthorized Access', array( 'response' => 403 ) );
	// }
	// Get the ID of the front page.
	$front_page_id = get_option( 'page_on_front' );

	// Check if the current page is being edited and is the front page.
	$post_id = 0;
	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	}
	if ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}

	return $post_id == $front_page_id;
}

/**
 * Get Testimonial posts via AJAX
 *
 * @return void
 */
function mtc_fetch_testimonials_callback() {
	// Verify the nonce first.
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mtc_nonce' ) ) {
		wp_die( 'Nonce verification failed', 'Unauthorized Access', array( 'response' => 403 ) );
	}

	$procedure = isset( $_POST['procedure'] ) ? sanitize_text_field( $_POST['procedure'] ) : '';
	$location  = isset( $_POST['location'] ) ? sanitize_text_field( $_POST['location'] ) : '';
	$offset    = isset( $_POST['offset'] ) ? absint( $_POST['offset'] ) : 0;

	// Prepare your query based on the procedure and location.
	$args = array(
		'post_type'      => 'testimonial',
		'posts_per_page' => 4,
		'offset'         => $offset,
		'post_status'    => 'publish',
		'meta_key'       => MTCTHEME_PREFIX . 'testimonial_type',
		'meta_value'     => 'video',
		'tax_query'      => array(),
	);

	if ( ! empty( $procedure ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'procedure',
			'field'    => 'slug',
			'terms'    => $procedure,
		);
	}

	if ( ! empty( $location ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'location',
			'field'    => 'slug',
			'terms'    => $location,
		);
	}

	// Ensure proper handling of multiple conditions.
	if ( count( $args['tax_query'] ) > 1 ) {
		$args['tax_query']['relation'] = 'AND';
	}

	// Query for testimonials matching the criteria.
	$query = new WP_Query( $args );

	// Query for total count (ignoring pagination).
	$count_args = $args;
	unset( $count_args['posts_per_page'], $count_args['offset'] );
	$total_query = new WP_Query( $count_args );
	$total_posts = $total_query->found_posts;

	ob_start();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'templates/partials/components/mtc-testimonial-card', null, array( 'id' => get_the_ID() ) );
		}
	} else {
		echo 'No testimonials found.';
	}
	$response = ob_get_clean();
	wp_reset_postdata();

	// Modify response to include total post count.
	echo json_encode(
		array(
			'html'        => $response,
			'total_posts' => $total_posts,
		)
	);

	wp_die();
}
add_action( 'wp_ajax_nopriv_fetch_testimonials', 'mtc_fetch_testimonials_callback' );
add_action( 'wp_ajax_fetch_testimonials', 'mtc_fetch_testimonials_callback' );

/**
 * AJAX handler to fetch locations for a selected procedure.
 */
function mtc_fetch_locations_by_procedure() {
	// Verify nonce for security
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mtc_nonce' ) ) {
		wp_send_json_error( array( 'message' => 'Nonce verification failed' ) );
	}

	$procedure = isset( $_POST['procedure'] ) ? sanitize_text_field( $_POST['procedure'] ) : '';

	if ( empty( $procedure ) ) {
		wp_send_json_error( array( 'message' => 'Procedure is required' ) );
	}

	// Get locations associated with the selected procedure.
	$args = array(
		'post_type'      => 'testimonial',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'meta_key'       => MTCTHEME_PREFIX . 'testimonial_type',
		'meta_value'     => 'video',
		'tax_query'      => array(
			array(
				'taxonomy' => 'procedure',
				'field'    => 'slug',
				'terms'    => $procedure,
			),
		),
	);

	$testimonial_posts = get_posts( $args );

	// Collect parent location term IDs from these posts.
	$location_terms_ids = array();
	foreach ( $testimonial_posts as $post ) {
		$terms = wp_get_post_terms( $post->ID, 'location' );
		foreach ( $terms as $term ) {
			// If the term has a parent, add the parent ID
			if ( $term->parent != 0 ) {
				$location_terms_ids[] = $term->parent;
			} else {
				$location_terms_ids[] = $term->term_id;
			}
		}
	}

	// Remove duplicate term IDs.
	$location_terms_ids = array_unique( $location_terms_ids );

	// Get the term objects.
	$locations = array();
	if ( ! empty( $location_terms_ids ) ) {
		foreach ( $location_terms_ids as $term_id ) {
			$term = get_term_by( 'id', $term_id, 'location' );
			if ( $term && $term->parent == 0 ) {
				$locations[] = array(
					'id'   => $term->term_id,
					'name' => $term->name,
					'slug' => $term->slug,
				);
			}
		}
	}

	wp_send_json_success( array( 'locations' => $locations ) );
}
add_action( 'wp_ajax_fetch_locations_by_procedure', 'mtc_fetch_locations_by_procedure' );
add_action( 'wp_ajax_nopriv_fetch_locations_by_procedure', 'mtc_fetch_locations_by_procedure' );

/**
 * Return a random string of a given length
 *
 * @param int $length Length of the random string.
 *
 * @return string
 */
function mtc_get_random_string( $length = 4 ) {
	$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen( $characters );
	$randomChars      = '';

	for ( $i = 0; $i < $length; $i++ ) {
		$randomChars .= $characters[ rand( 0, $charactersLength - 1 ) ];
	}

	return $randomChars;
}


/**
 * Clean up shortcode output
 */
function mtc_cleanup_shortcode_fix( $content ) {
	$array   = array(
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']',
		']<br>'   => ']',
	);
	$content = strtr( $content, $array );
	return $content;
}


/*
* Function for post duplication. Duplicates appear as drafts. User is redirected to the edit screen.
*/
function mtc_duplicate_post_as_draft() {
	global $wpdb;

	if ( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] ) || ( isset( $_REQUEST['action'] ) && 'mtc_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die( 'No post to duplicate has been supplied!' );
	}

	// Nonce verification
	if ( ! isset( $_GET['duplicate_nonce'] ) || ! wp_verify_nonce( $_GET['duplicate_nonce'], 'duplicate_post_' . $_GET['post'] ) ) {
		wp_die( 'Security check failed' );
	}

	// Get the original post id
	$post_id = ( isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	$post    = get_post( $post_id ); // Get the original post data

	// Check if the current user can create a draft
	if ( isset( $post ) && current_user_can( 'edit_posts' ) ) {
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => get_current_user_id(),
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name . '_copy',
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title . ' (Copy)',
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order,
		);

		$new_post_id = wp_insert_post( $args ); // Insert the post by wp_insert_post() function

		// Duplicate all post meta just in one SQL query
		$post_meta_infos = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id" );
		if ( ! empty( $post_meta_infos ) ) {
			$sql_query_sel = array();
			foreach ( $post_meta_infos as $meta_info ) {
				$meta_key = $meta_info->meta_key;
				if ( $meta_key == '_wp_old_slug' ) {
					continue;
				}
				$meta_value      = addslashes( $meta_info->meta_value );
				$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			if ( ! empty( $sql_query_sel ) ) {
				$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) " . implode( ' UNION ALL ', $sql_query_sel );
				$wpdb->query( $sql_query );
			}
		}

		// Redirect to the edit post screen for the new draft
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die( 'Error! Post does not exist or you do not have edit permission.' );
	}
}
add_action( 'admin_action_mtc_duplicate_post_as_draft', 'mtc_duplicate_post_as_draft' );

/*
* Add the duplicate link to action list for post_row_actions
*/
function mtc_duplicate_post_link( $actions, $post ) {
	if ( current_user_can( 'edit_posts' ) ) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url( 'admin.php?action=mtc_duplicate_post_as_draft&post=' . $post->ID, 'duplicate_post_' . $post->ID, 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
add_filter( 'post_row_actions', 'mtc_duplicate_post_link', 10, 2 );
add_filter( 'page_row_actions', 'mtc_duplicate_post_link', 10, 2 );
add_filter( 'listing_row_actions', 'mtc_duplicate_post_link', 10, 2 );
add_filter( 'doctor_row_actions', 'mtc_duplicate_post_link', 10, 2 );
add_filter( 'package_row_actions', 'mtc_duplicate_post_link', 10, 2 );
add_filter( 'testimonial_row_actions', 'mtc_duplicate_post_link', 10, 2 );
add_filter( 'hotel_row_actions', 'mtc_duplicate_post_link', 10, 2 );
add_filter( 'reviewer_row_actions', 'mtc_duplicate_post_link', 10, 2 );



/**
 *
 */
function mtc_round_image( $imageid, $name = '', $small = false, $class = '' ) {
	$size      = ( $small ) ? 'card-round' : 'card-round-large';
	$sizeclass = ( $small ) ? 'card-round' : 'card-round-large';
	$class     = $sizeclass . ' ' . $class;
	// $class = ($class) ? 'round-small ' . $class : 'round';
	if ( empty( $imageid ) ) {
		$initials = '';
		$words    = explode( ' ', str_ireplace( 'dr. ', '', $name ) );
		foreach ( $words as $key => $value ) {
			$initials .= substr( $value, 0, 1 );
		}
		$initials = '<div class="' . $class . '"><span>' . $initials . '</span></div>';
		return $initials;
	} else {
		$image = wp_get_attachment_image( $imageid, $size );
		$image = '<div class="' . $class . '">' . $image . '</div>';
		return $image;
	}
}


/**
 * Function to process content and ensure shortcodes are rendered and lists are properly indented.
 *
 * @param string $content The content to process.
 * @return string Processed content with shortcodes rendered and properly formatted.
 */
function mtc_process_content( $content ) {
	// Process shortcodes first.
	$content = do_shortcode( $content );

	// Apply wpautop to ensure proper paragraph and list formatting.
	$content = wpautop( $content );

	return $content;
}


/**
 * Set the post lock timeout to 1 minutes (60 seconds)
 *
 * @return int The new timeout in seconds.
 */
function mtc_increase_post_lock_timeout() {
	return 60; // 1 minute
}
add_filter( 'wp_check_post_lock_window', 'mtc_increase_post_lock_timeout' );

/**
 * Get parent locations by procedure for frontend select dropdown.
 *
 * @param string $procedure_slug The slug of the procedure.
 * @param string $post_type      The post type. Default is 'post'.
 *
 * @return array
 */
function get_countries_by_procedure( $procedure_slug, $post_type = 'post' ) {
	$countries = array();

	// Debug logging
	error_log( 'Procedure: ' . $procedure_slug );
	error_log( 'Post Type: ' . $post_type );

	// Query for posts with the specified procedure
	$args = array(
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'tax_query'      => array(
			array(
				'taxonomy' => 'procedure',
				'field'    => 'slug',
				'terms'    => $procedure_slug,
			),
		),
	);

	$posts = get_posts( $args );

	// Debug logging
	error_log( 'Found Posts: ' . count( $posts ) );

	if ( ! empty( $posts ) ) {
		$all_locations = wp_get_object_terms( $posts, 'location', array( 'fields' => 'all' ) );

		// Debug logging
		error_log( 'Found Locations: ' . count( $all_locations ) );

		// Filter out parent locations
		$parent_locations = array_filter(
			$all_locations,
			function ( $location ) {
				return $location->parent === 0;
			}
		);

		// Get unique parent location IDs
		$parent_location_ids = wp_list_pluck( $parent_locations, 'term_id' );

		if ( ! empty( $parent_location_ids ) ) {
			$countries = get_terms(
				array(
					'taxonomy'   => 'location',
					'include'    => $parent_location_ids,
					'orderby'    => 'meta_value_num',
					'meta_key'   => MTCTHEME_PREFIX . 'location_' . MTCTHEME_GEOMETAKEY,
					'order'      => 'ASC',
					'hide_empty' => false, // Ensure we get all terms, even those not assigned to posts
				)
			);

			// Debug logging
			error_log( 'Parent Locations: ' . count( $countries ) );
			foreach ( $countries as $country ) {
				error_log( 'Country: ' . $country->name );
			}
		}
	}

	return $countries;
}

/**
 * Get cities by procedure and country for frontend select dropdown
 */
function get_cities_by_procedure_and_country( $procedure_slug, $country_slug, $post_type = 'post' ) {
	$cities = array();

	$country = get_term_by( 'slug', $country_slug, 'location' );

	$args = array(
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'tax_query'      => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'procedure',
				'field'    => 'slug',
				'terms'    => $procedure_slug,
			),
			array(
				'taxonomy' => 'location',
				'field'    => 'slug',
				'terms'    => $country_slug,
			),
		),
	);

	$posts = get_posts( $args );

	if ( ! empty( $posts ) ) {
		$cities = wp_get_object_terms(
			$posts,
			'location',
			array(
				'parent'   => $country->term_id,
				'meta_key' => MTCTHEME_PREFIX . 'location_' . MTCTHEME_GEOMETAKEY,
				'orderby'  => 'meta_value_num',
			)
		);
	}

	return $cities;
}


/**
 * AJAX handler to get countries by procedure.
 */
function mtc_get_countries_by_procedure_ajax() {
	mtctheme_initialize_constants(); // Ensure constants are defined
	if ( ! isset( $_GET['procedure'] ) ) {
		wp_send_json_error( 'Procedure not specified.' );
	}

	$procedure_slug = sanitize_text_field( $_GET['procedure'] );
	$countries      = get_countries_by_procedure( $procedure_slug, 'listing' );

	if ( empty( $countries ) ) {
		wp_send_json_error( 'No countries found for the specified procedure.' );
	}

	$options = '<option value="all">Select Location</option>';
	foreach ( $countries as $country ) {
		$options .= '<option value="' . esc_attr( $country->slug ) . '">' . esc_html( $country->name ) . '</option>';
	}

	wp_send_json_success( $options );
}
add_action( 'wp_ajax_get_countries_by_procedure', 'mtc_get_countries_by_procedure_ajax' );
add_action( 'wp_ajax_nopriv_get_countries_by_procedure', 'mtc_get_countries_by_procedure_ajax' );


/**
 * Initialize constants for the theme
 *
 * @return void
 */
function mtctheme_initialize_constants() {
	if ( ! defined( 'MTCTHEME_GEOMETAKEY' ) ) {
		if ( ! session_id() ) {
			session_start();
		}

		$mtc_ip = mtc_get_user_ip();
		if ( empty( $_SESSION['metakey'] ) || ( ! empty( $_SESSION['ip'] ) && $_SESSION['ip'] !== $mtc_ip ) ) {
			$mtc_ipstack         = mtc_geolocate_visitor( $mtc_ip );
			$_SESSION['metakey'] = ! empty( $mtc_ipstack['metakey'] ) ? $mtc_ipstack['metakey'] : MTCTHEME_PREFIX . 'location_usca';
		}
		define( 'MTCTHEME_GEOMETAKEY', $_SESSION['metakey'] );
	}

	if ( ! defined( 'MTCTHEME_CURRENCY' ) ) {
		define( 'MTCTHEME_CURRENCY', $_SESSION['currency'] ?? 'INR' );
	}

	if ( ! defined( 'MTCTHEME_COUNTRY' ) ) {
		define( 'MTCTHEME_COUNTRY', $_SESSION['country'] ?? 'India' );
	}

	if ( ! defined( 'MTCTHEME_COUNTRYCODE' ) ) {
		define( 'MTCTHEME_COUNTRYCODE', $_SESSION['country_code'] ?? 'in' );
	}

	if ( ! defined( 'MTCTHEME_STATE' ) ) {
		define( 'MTCTHEME_STATE', $_SESSION['state'] ?? '' );
	}

	if ( ! defined( 'MTCTHEME_CITY' ) ) {
		define( 'MTCTHEME_CITY', $_SESSION['city'] ?? '' );
	}

	if ( ! defined( 'MTCTHEME_IP' ) ) {
		define( 'MTCTHEME_IP', $_SESSION['ip'] ?? '' );
	}
}

add_action( 'init', 'mtctheme_initialize_constants' );


/**
 * Get procedures associated with listings.
 *
 * @return array
 */
function mtc_get_procedures_with_listings() {
	// Query for listing posts
	$args = array(
		'post_type'      => 'listing',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	);

	$posts = get_posts( $args );

	if ( empty( $posts ) ) {
		return array();
	}

	// Get procedure terms associated with these posts
	$procedures = wp_get_object_terms( $posts, 'procedure' );

	// Extract the term IDs
	$procedure_ids = wp_list_pluck( $procedures, 'term_id' );

	// Get the terms with additional filters
	$filtered_procedures = array();
	$all_procedures = get_terms(
		array(
			'taxonomy'   => 'procedure',
			'hide_empty' => true,
			'meta_key'   => MTCTHEME_PREFIX . 'procedure_' . MTCTHEME_GEOMETAKEY,
			'orderby'    => 'meta_value_num',
			'order'      => 'ASC',
			//'parent'     => 0,
			'include'    => $procedure_ids, // Only include procedures associated with listings
		)
	);
	foreach( $all_procedures as $procedure ) {
		if( ! $procedure->parent ){
			$filtered_procedures[ $procedure->term_id ] = $procedure;
		}		
	}
	foreach ( $filtered_procedures as $id => $procedure_parent ) {
		$filtered_procedures[$id]->children = array();
		foreach( $all_procedures as $procedure ) {
			if ( $procedure->parent && $id == $procedure->parent ) {
				$filtered_procedures[$id]->children[] = $procedure;
			}		
		}		
	}
	return $filtered_procedures;
}

/**
 * Get locations associated with listings.
 *
 * @return array
 */
function mtc_get_locations_with_listings() {
	// Query for listing posts
	$args = array(
		'post_type'      => 'listing',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	);

	$posts = get_posts( $args );

	if ( empty( $posts ) ) {
		return array();
	}

	// Get procedure terms associated with these posts
	$locations = wp_get_object_terms( $posts, 'location' );
	
	// Extract the term IDs
	$location_ids = wp_list_pluck( $locations, 'term_id' );

	// Get the terms with additional filters
	$filtered_locations = array();
	$all_locations = get_terms(
		array(
			'taxonomy'   => 'location',
			'hide_empty' => true,
			'meta_key'   => MTCTHEME_PREFIX . 'location_' . MTCTHEME_GEOMETAKEY,
			'orderby'    => 'meta_value_num',
			'order'      => 'ASC',
			//'parent'     => 0,
			'include'    => $location_ids, // Only include procedures associated with listings
		)
	);
	foreach( $all_locations as $location ) {
		if( ! $location->parent ){
			$filtered_locations[ $location->term_id ] = $location;
		}		
	}
	foreach ( $filtered_locations as $id => $location_parent ) {
		$filtered_locations[$id]->children = array();
		foreach( $all_locations as $location ) {
			if ( $location->parent && $id == $location->parent ) {
				$filtered_locations[$id]->children[] = $location;
			}		
		}		
	}
	
	return $filtered_locations;
}

add_action( 'wp_ajax_get_locations_for_procedure', 'mtc_get_locations_for_procedure' );
add_action( 'wp_ajax_nopriv_get_locations_for_procedure', 'mtc_get_locations_for_procedure' );
/**
 * Get locations for procedure.
 *
 * @param string $procedure_slug The slug of the procedure.
 * @param string $post_type      The post type. Default is 'post'.
 *
 * @return array
 */
function mtc_get_locations_for_procedure( ) {

	mtctheme_initialize_constants(); // Ensure constants are defined
	if ( ! isset( $_GET['procedure'] ) ) {
		wp_send_json_error( 'Procedure not specified.' );
	}
	
	$procedure_slug = sanitize_text_field( $_GET['procedure'] );
	$post_type = 'listing';

	// Query for posts with the specified procedure
	$args = array(
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'tax_query'      => array(
			array(
				'taxonomy' => 'procedure',
				'field'    => 'slug',
				'terms'    => $procedure_slug,
			),
		),
	);

	$posts = get_posts( $args );

	// Debug logging
	error_log( 'Found Posts: ' . count( $posts ) );

	if ( ! empty( $posts ) ) {
		$all_locations = wp_get_object_terms( $posts, 'location', array( 'fields' => 'all' ) );
	
	// Extract the term IDs
	$location_ids = wp_list_pluck( $all_locations, 'term_id' );
	$parent_ids = array_unique( wp_list_pluck( $all_locations, 'parent' ) );
	
	$res_locations = array_merge( $parent_ids, $location_ids );
	wp_send_json_success( $res_locations );
	exit;
	
	}
	
}

function customize_tinymce_settings($init_array) {
    // Do not remove span tags
    $init_array['extended_valid_elements'] = 'span[*]';
    
    return $init_array;
}
add_filter('tiny_mce_before_init', 'customize_tinymce_settings');