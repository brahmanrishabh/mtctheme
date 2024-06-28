<?php
/**
 * Theme Footer
 *
 * Common footer for all pages.
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
global $post;
$mtctheme_options = get_option( 'mtctheme_theme_options' );
?>
<footer>
	<div class="container">
		<div class="contact">
			<h5>Contact Us</h5>
			<?php
			
			if ( ! empty( $mtctheme_options['address_content'] ) ) {
				?>
			<div class="address_content">				
				<?php echo wpautop( $mtctheme_options['address_content'] ); ?>
			</div>
			<?php
			}
			
			if ( ! empty( $mtctheme_options['address'] ) ) {
				?>
			<div class="address">
				<i class="mtc-location"></i>
				<?php echo wpautop( $mtctheme_options['address'] ); ?>
			</div>
			<?php
			}

			if ( ! empty( $mtctheme_options[ 'phone_' . MTCTHEME_GEOMETAKEY ] ) ) {
				?>
			<div class="phone">
				<i class="mtc-phone"></i>
				<div>
					<?php
					foreach ( $mtctheme_options['phone_' . MTCTHEME_GEOMETAKEY ] as $mtc_index => $mtc_phone ) {
						?>
					<a href="tel:<?php echo esc_attr( $mtc_phone ); ?>"><?php echo esc_html( $mtc_phone ); ?></a>
					<?php
					}
					?>
				</div>
			</div>
			<?php
			}

			?>
			
			
				<div class="email">
				<i class="mtc-email"></i>
				<div>
					<?php if ( ! empty( $mtctheme_options['email'] ) ) { ?>
					<a href="mailto:<?php echo $mtctheme_options['email'] ; ?>">
					<?php echo  $mtctheme_options['email']; ?>
					</a>
					<?php } ?>
					</div>
					</div>
			

			<div class="social">
				<?php
				if ( ! empty( $mtctheme_options['facebook'] ) ) {
					?>
				<a class="facebook" target="_blank" href="<?php echo esc_attr( $mtctheme_options['facebook'] ); ?>"><i
						class="mtc-facebook"></i></a>
				<?php
				}

				if ( ! empty( $mtctheme_options['twitter'] ) ) {
					?>
				<a class="twitter" target="_blank" href="<?php echo esc_attr( $mtctheme_options['twitter'] ); ?>"><i
						class="mtc-twitter"></i></a>
				<?php
				}

				if ( ! empty( $mtctheme_options['youtube'] ) ) {
					?>
				<a class="youtube" target="_blank" href="<?php echo esc_attr( $mtctheme_options['youtube'] ); ?>"><i
						class="mtc-youtube"></i></a>
				<?php
				}

				if ( ! empty( $mtctheme_options['instagram'] ) ) {
					?>
				<a class="instagram" target="_blank" href="<?php echo esc_attr( $mtctheme_options['instagram'] ); ?>"><i
						class="mtc-instagram"></i></a>
				<?php 
				}
				
				if ( ! empty( $mtctheme_options['linkedin'] ) ) {
					?>
				<a class="linkedin" target="_blank" href="<?php echo esc_attr( $mtctheme_options['linkedin'] ); ?>"><i
						class="mtc-linkedin"></i></a>
				<?php 
				}
				if ( ! empty( $mtctheme_options['pinterest'] ) ) {
					?>
				<a class="pinterest" target="_blank" href="<?php echo esc_attr( $mtctheme_options['pinterest'] ); ?>"><i
						class="mtc-pinterest"></i></a>
				<?php 
				}
				
				
				
				if ( ! empty( $mtctheme_options['yelp'] ) ) {
					?>
				<a class="yelp" target="_blank" href="<?php echo esc_attr( $mtctheme_options['yelp'] ); ?>"><i
						class="mtc-yelp"></i></a>
				<?php 
				}
				
				
				if ( ! empty( $mtctheme_options['google'] ) ) {
					?>
				<a class="google" target="_blank" href="<?php echo esc_attr( $mtctheme_options['google'] ); ?>"><i
						class="mtc-google"></i></a>
				<?php 
				}
				
				?>
			</div>

		</div>
		<div class="links">
			<h5>Quick Links</h5>
			<nav>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'quick-links',
						'menu_class'     => 'quick-links',
						'container'      => 'ul',
						'link_before'    => '<i class="mtc-chevron-right"></i><p>',
						'link_after'     => '</p>',

					)
				);
				?>
			</nav>
		</div>
		<div class="support">
			<h5>Support</h5>
			<nav>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'support',
						'menu_class'     => 'support',
						'container'      => 'ul',
						'link_before'    => '<i class="mtc-chevron-right"></i><p>',
						'link_after'     => '</p>',
					)
				);
				?>
			</nav>
		</div>
		<div class="recent">
			<h5>Featured Blogs</h5>
			<?php
			if ( is_singular( 'listing' ) ) {
				$mtc_featured_blogs = get_post_meta( get_the_id(), MTCTHEME_PREFIX . 'listing_featured_blogs_' . MTCTHEME_GEOMETAKEY, true );
			} elseif ( is_home() ) {
				$mtc_options        = get_option( 'mtctheme_theme_options' );
				$mtc_featured_blogs = ! empty( $mtc_options[ 'featured_blogs_' . MTCTHEME_GEOMETAKEY ] ) ? $mtc_options[ 'featured_blogs_' . MTCTHEME_GEOMETAKEY ] : array();
			} else {
				$mtc_featured_blogs = get_post_meta( get_the_id(), MTCTHEME_PREFIX . 'featured_blogs_' . MTCTHEME_GEOMETAKEY, true );
			}
			if ( empty( $mtc_featured_blogs ) ) {
				$mtc_theme_options  = get_option( 'mtctheme_theme_options' );
				$mtc_featured_blogs = ! empty( $mtc_options[ 'featured_blogs_' . MTCTHEME_GEOMETAKEY ] ) ? $mtc_options[ 'featured_blogs_' . MTCTHEME_GEOMETAKEY ] : array();
			}
			if ( ! empty( $mtc_featured_blogs ) ) {
				echo '<ul>';
				foreach ( $mtc_featured_blogs as $mtc_featured_blog ) {
					echo '<li>
						<a target="_blank" href="' . esc_attr( get_the_permalink( $mtc_featured_blog ) ) . '">
							<i class="mtc-chevron-right"></i>
							<p class="title">' . esc_html( get_the_title( $mtc_featured_blog ) ) . '</p>
						</a>
					</li>';
				}
				echo '</ul>';
			}
			?>
		</div>
		<div class="copy">
			<?php
			if ( ! empty( $mtctheme_options['copy-text'] ) ) {
				echo wpautop( $mtctheme_options['copy-text'] );
			}
			?>
		</div>
	</div>
</footer>
<?php
wp_footer();

// Current page template.
if ( is_user_logged_in() ) { // Check if the user is logged in to limit this to users who are logged in.
	global $template;
	echo '<div id="template-info" style="margin: 0; padding: 10px; background-color: #fff; color: #000; position: fixed; bottom: 0; right: 0; z-index: 9999;">Template: ' . basename( $template ) . '<span></span></div>';
	echo "
        <script>
        jQuery(document).ready(function($) {
            function updateWindowSize() {
                var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                var height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                $('#template-info span').html(' | Width: ' + width + 'px, Height: ' + height + 'px');
            }
            updateWindowSize();
            $(window).resize(updateWindowSize);
        });
        </script>
    ";
}


?>


</body>

</html>