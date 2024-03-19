<?php
/**
 * Template for Checkout page
 *
 * Template Name: Checkout
 *
 * @package WordPress
 * @subpackage IMS
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header('shop');

// Main Loop
while( have_posts() ) : the_post(); ?>

<!-- Section
============================================= -->
<section class="uk-section">
    <div class="uk-container">

        <ul class="uk-breadcrumb">
            <li><a href="shop/">Shop</a></li>
            <li><span>Checkout</span></li>
        </ul>
        <?php the_content(); ?>

    </div>
</section> <!-- Section end -->

<?php include('partials/mailing-list.php'); ?>

<?php endwhile;

get_footer(); ?>