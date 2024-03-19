<?php
/**
 * Template for Contact Us page
 *
 * Template Name: Contact
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

<?php include('partials/pagetitle.php'); ?>

<!-- Intro
============================================= -->
<section id="intro">
    <div class="uk-container uk-container-small uk-margin-medium-bottom uk-text-center">
        <?php the_content(); ?>
    </div>
</section> <!-- #intro end -->

<!-- Contact Form
============================================= -->
<section id="contact-form">
    <div class="uk-container uk-container-small">
        <div class="contact-us-form uk-light">
            <?php echo do_shortcode('[contact-form-7 id="6" title="Contact Us"]'); ?>
        </div>
    </div>
</section> <!-- #contact-form end -->

<?php include('partials/testimonials.php'); ?>

<?php endwhile;

get_footer(); ?>