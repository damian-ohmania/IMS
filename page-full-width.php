<?php
/**
 * Template for Full Width Elementor page
 *
 * Template Name: Custom Elementor
 *
 * @package WordPress
 * @subpackage IMS
 */

if (!defined('WPINC')) {
    die;
}

get_header();

// Main Loop
while (have_posts()) : the_post(); ?>

<div class="uk-container">

	<div>
		<?php the_content(); ?>
	</div>

</div>

<?php endwhile;

get_footer(); ?>