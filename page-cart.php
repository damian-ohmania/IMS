<?php
/**
 * Template for Cart page
 *
 * Template Name: Cart
 *
 * @package WordPress
 * @subpackage IMS
 */

if (!defined('WPINC')) {
    die;
}

get_header('shop');

// Main Loop
while (have_posts()) : the_post(); ?>

<!--  Section
============================================= -->
<section class="padding-bottom">
    <div class="uk-container">

        <?php the_content(); ?>

    </div>
</section> <!-- Section end -->

<?php include('partials/mailing-list.php'); ?>

<?php endwhile;

get_footer(); ?>