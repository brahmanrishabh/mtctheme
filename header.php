<?php
/**
 * Theme Header
 *
 * Common header for all pages.
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

if ( ! is_admin() && ! session_id() ) {
	session_start();
}

// Geolocate visitor.
$mtc_ip = mtc_get_user_ip();
if ( empty( $_SESSION['metakey'] ) || ( ! empty( $_SESSION['ip'] ) && $_SESSION['ip'] !== $mtc_ip ) ) {
	$mtc_ipstack              = mtc_geolocate_visitor( $mtc_ip );
	$_SESSION['metakey']      = ! empty( $mtc_ipstack['metakey'] ) ? $mtc_ipstack['metakey'] : MTCTHEME_PREFIX . 'location_usca';
	$_SESSION['currency']     = ! empty( $mtc_ipstack['currency']['code'] ) ? $mtc_ipstack['currency']['code'] : 'INR';
	$_SESSION['country']      = ! empty( $mtc_ipstack['country_name'] ) ? $mtc_ipstack['country_name'] : 'India';
	$_SESSION['country_code'] = ! empty( $mtc_ipstack['country_code'] ) ? strtolower( $mtc_ipstack['country_code'] ) : 'in';
	$_SESSION['state']        = ! empty( $mtc_ipstack['region_name'] ) ? $mtc_ipstack['region_name'] : '';
	$_SESSION['city']         = ! empty( $mtc_ipstack['city'] ) ? $mtc_ipstack['city'] : '';
	$_SESSION['ip']           = ! empty( $mtc_ipstack['ip'] ) ? $mtc_ipstack['ip'] : '';
}
! defined( 'MTCTHEME_GEOMETAKEY') ? define( 'MTCTHEME_GEOMETAKEY', $_SESSION['metakey'] ) : '';
! defined( 'MTCTHEME_CURRENCY') ? define( 'MTCTHEME_CURRENCY', $_SESSION['currency'] ) : '';
! defined( 'MTCTHEME_COUNTRY') ? define( 'MTCTHEME_COUNTRY', $_SESSION['country'] ) : '';
! defined( 'MTCTHEME_COUNTRYCODE') ?  define( 'MTCTHEME_COUNTRYCODE', $_SESSION['country_code'] ) : '';
! defined( 'MTCTHEME_STATE') ?  define( 'MTCTHEME_STATE', $_SESSION['state'] ) : '';
! defined( 'MTCTHEME_CITY') ?  define( 'MTCTHEME_CITY', $_SESSION['city'] ) : '';
! defined( 'MTCTHEME_IP') ?  define( 'MTCTHEME_IP', $_SESSION['ip'] ) : '';

if ( empty( $_SESSION['referrer'] ) ) {
	if ( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
		$_SESSION['referrer'] = $_SERVER['HTTP_REFERER'];
	} else {
		$_SESSION['referrer'] = 'Direct';
	}
}
if ( empty( $_SESSION['first_page_visited'] ) ) {
	$_SESSION['first_page_visited'] = mtc_get_current_url();
}
if ( empty( $_SESSION['web_source'] ) ) {
	if ( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
		$_SESSION['web_source'] = $_SERVER['HTTP_REFERER'];
	} else {
		$_SESSION['web_source'] = site_url();
	}
}
$_SESSION['form_submit_page_source'] = mtc_get_current_url();

$mtctheme_options = get_option( 'mtctheme_theme_options' );

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>


		<!-- REMOVE -->
		<meta name="robots" content="noindex">
	</head>

	<body <?php body_class( 'post-type-' . get_post_type() ); ?>>
		<header>
			<div class="container">
			<div id="first-row-cover">
			<div id="first-row">
			
			<!-- Mobile Menu Icon -->
				<div class="mobile-menu-icon">
					<span></span>
					<span></span>
					<span></span>
				</div>
			<!-- Logo Block -->
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php
						if ( ! empty( $mtctheme_options['logo'] ) ) {
							?>
						<img src="<?php echo esc_url( $mtctheme_options['logo'] ); ?>" alt="Logo" />
							<?php
						} else {
							bloginfo( 'name' );
						}
						?>
					</a>
				</div>
				
		<div id="custom-header-links">		
    <?php 
	
	for ($i = 1; $i <= 3; $i++) : 
        $link_url = $mtctheme_options['header_group' . $i ][0]['header_link_url' . $i ];
        $link_text = $mtctheme_options['header_group' . $i ][0]['header_link_text' . $i ];
        $link_image = $mtctheme_options['header_group' . $i ][0]['header_image' . $i ];
    ?>
        <?php if ( $link_url || $link_image || $link_text ) { ?>
		<?php if( $link_url ){ ?>
            <a target="_blank" href="<?php echo esc_url($link_url); ?>" class="custom-header-link">
		<?php } ?>
                <?php if ($link_image) : ?>
                    <img src="<?php echo esc_url($link_image); ?>" alt="<?php echo esc_attr($link_text); ?>">
                <?php else : ?>
                    <span><?php echo esc_html($link_text); ?></span>
                <?php endif; ?>
				<?php if( $link_url ){ ?>
				</a>
			<?php } ?>
        <?php }  ?>
    <?php endfor; ?>
</div>

<div class="contact">
<div class="call">				
					<?php if ( ! empty( $mtctheme_options[ 'phone_' . MTCTHEME_GEOMETAKEY ] ) ) { ?>
					<a href="tel:<?php echo $mtctheme_options['phone_' . MTCTHEME_GEOMETAKEY][0] ; ?>">
					<?php echo  $mtctheme_options['phone_' . MTCTHEME_GEOMETAKEY ][0]; ?>
					</a>
					<?php } ?>				
			</div>
			
<div class="email">
					<?php if ( ! empty( $mtctheme_options['email'] ) ) { ?>
					<a href="mailto:<?php echo $mtctheme_options['email'] ; ?>">
					<?php echo  $mtctheme_options['email']; ?>
					</a>
					<?php } ?>
					</div>
					
			</div>

			<div class="schedule">				
					<a href="<?php echo esc_url( home_url( '/schedule-call/' ) ); ?>">
					<?php esc_html_e( 'Schedule A Call', 'mtctheme' ); ?>
				</a>			
			</div>
			
			
</div>
</div>
<div id="second-row-cover">
<div id="second-row">

				<!-- Navigation Block -->
				<nav>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'location_' . MTCTHEME_GEOMETAKEY,
							'menu_class'     => 'main-menu',
							'container'      => 'ul',
						)
					);
					?>
				</nav>

				

			<!-- Call Block -->
			</div>
			</div>
			</div>
		</header>

		<?php
		// Get Breadcrumbs.
		get_template_part( 'templates/partials/components/mtc-breadcrumbs' );
