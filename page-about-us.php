<?php
/**
 * Template for About Us page
 *
 * Template Name: About Us
 *
 * @package WordPress
 * @subpackage IMS
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header();

// Main Loop
while( have_posts() ) : the_post(); ?>

<?php $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'pagetitle');  ?>
<!-- Pagetitle Section
============================================= -->
<section class="pagetitle">
    <div class="uk-container">

        <div class="uk-text-center uk-height-large uk-flex uk-flex-middle" style="background: url(<?php echo $thumbnail; ?>) no-repeat center left; background-size: cover">
            <div class="uk-container uk-container-small">
                <div class="">
                    <div class="border-wrap uk-position-relative">
                        <h1><?php the_title(); ?></h1>
						<?php if( get_field( 'pagetitle_small_title' )) { ?>
                        	<h4><?php the_field('pagetitle_small_title'); ?></h4>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section> <!-- Section end -->

<!-- Section
============================================= -->
<section class="uk-section">
    <div class="uk-container">

        <div class="uk-width-3-5@m uk-margin-auto uk-text-center">
            <?php the_content(); ?>
        </div>

    </div>
</section> <!-- Section end -->

<?php if( get_field( 'about_left_image' )) : ?>
<!--  Section
============================================= -->
<section class="uk-section-large uk-padding-remove-top">
    <div class="uk-container uk-container-small">

        <div class="uk-child-width-1-2@s uk-flex-middle uk-flex-center uk-grid-small" uk-grid>
            <div>
                <div class="uk-inline uk-light home-box">
                    <img src="<?php the_field('about_left_image'); ?>">
                </div>
            </div>

            <div>
                <div class="uk-inline uk-light home-box">
                    <img src="<?php the_field('about_right_image'); ?>">
                </div>
            </div>

        </div>

    </div>
</section> <!-- Section end -->
<?php endif; ?>

<!-- Section
============================================= -->
<!-- <section class="uk-section">
    <div class="uk-container">

        <div class="uk-width-3-5@m uk-margin-auto uk-text-center">
            <?php the_field('about_content'); ?>
        </div>

    </div>
</section>  -->
<!-- Section end -->


<?php include('partials/mailing-list.php'); ?>

<?php endwhile;

get_footer(); ?>