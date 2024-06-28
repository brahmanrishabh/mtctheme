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
?>
<div class="main">
	<div class="container">
		<h1>MTC</h1>
	</div>
</div>
<?php
get_footer();
