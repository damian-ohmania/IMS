<?php
/**
 * IMS homepage 
 * Template Name: Homepage
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

    <!-- Hero Section
    ============================================= -->
    <section class="hero-section">
        <div class="uk-container uk-container-large">
            <div class="uk-flex-middle uk-flex-center uk-grid-small" uk-grid>
                <div class="uk-width-1-2@m">
                    <div class="uk-transition-toggle uk-position-relative uk-light home-box" style="background: url(<?php the_field('shop_image'); ?>) no-repeat top center; background-size: cover" uk-height-viewport="offset-top: true">
                        <div class="uk-position-cover uk-overlay-default"></div>

                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-default"></div>

                        <div class="uk-position-center uk-text-center uk-position-small">
                            <h1><?php the_field('shop_title'); ?></h1>

                            <a href="<?php the_field('shop_link'); ?>" class="uk-button uk-margin-medium-top">Shop Now</a>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-2@m">
                    <div class="uk-transition-toggle uk-position-relative uk-light home-box" style="background: url(<?php the_field('wholesaler_image'); ?>) no-repeat top center; background-size: cover" uk-height-viewport="offset-top: true">
                        <div class="uk-position-cover uk-overlay-default"></div>

                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-default"></div>

                        <div class="uk-position-center uk-text-center uk-position-small">
                            <h1><?php the_field('wholesaler_title'); ?></h1>

                            <a href="<?php the_field('wholesaler_link'); ?>" class="uk-button uk-margin-medium-top">Discover More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Section end -->

    <!-- Section
    ============================================= -->
    <section class="uk-section-default dark-section section-large">
        <div class="uk-container uk-container-small">

            <div class="uk-width-4-5@m uk-margin-auto uk-text-center">
                <div class="border-wrap uk-position-relative uk-margin-medium-bottom">
                    <?php the_field('intro_section'); ?>
                </div>

                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-small.svg" height="65" width="90">
            </div>

        </div>
    </section> <!-- Section end -->

    <!-- Section
    ============================================= -->
    <section class="uk-position-relative home-about" uk-height-match="target: .equal-height">
        <div class="uk-width-1-2@m">
            <div class="equal-height uk-text-center">
                <img class="uk-width-1-1@s" src="<?php the_field('about_section_image'); ?>">
            </div>
        </div>

        <div class="position-top uk-width-1-1@s uk-height-1-1">
            <div class="uk-container">
                <div class="uk-grid uk-flex-right@m">
                    <div class="uk-width-1-2@m">
                        <div class="equal-height box-padding uk-flex uk-flex-middle uk-flex-center uk-flex-left@m uk-text-center uk-text-left@m">
                            <div>
                                <?php the_field('about_section_content'); ?>

                                <a href="<?php the_field('about_section_link'); ?>" class="uk-button-link"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow.svg" height="18" width="53" class="uk-margin-small-right" uk-svg><?php the_field('about_section_label'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Section end -->

    <!-- Section
    ============================================= -->
    <section class="heritage section-large uk-position-relative" style="background: url(<?php the_field('heritage_section_image'); ?>) no-repeat top center; background-size: cover">
        <div class="heritage-wrap uk-position-cover"></div>

        <div class="uk-container uk-container-small uk-position-relative">
            <div class="uk-width-4-5@m uk-margin-auto">
                <div class="uk-text-center">
                    <div class="border-wrap uk-position-relative uk-margin-medium-bottom">
                        <h2><?php the_field('heritage_section_title'); ?></h2>
                    </div>

                    <?php the_field('heritage_section_content'); ?>                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-smaller.svg" height="55" width="40">
                </div>
            </div>
        </div>
    </section> <!-- Section end -->

    <?php include('partials/mailing-list.php'); ?>

<?php endwhile;

get_footer(); ?>