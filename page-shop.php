<?php
/**
 * Template for Shop page
 *
 * Template Name: Shop
 *
 * @package WordPress
 * @subpackage IMS
 */

if (!defined('WPINC')) {
    die;
}

get_header( 'shop' );

// Main Loop
while (have_posts()) : the_post(); ?>

    <!-- Pagetitle Section
    ============================================= -->
    <section class="pagetitle">
        <div class="uk-container">
            <div class="uk-position-relative uk-visible-toggle" tabindex="-1" uk-slideshow="min-height: 460;max-height: 460;autoplay: true;autoplay-interval: 4000">
                <div class="uk-position-relative">
                    <?php if( have_rows('shop_slider') ): ?>
                        <ul class="uk-slideshow-items">
                            <?php while ( have_rows('shop_slider') ) : the_row(); ?>
                                <li>
									<?php if( get_sub_field('choose_link') == 'page_link' ) { ?>
                                    <a href="<?php the_sub_field('page_link'); ?>" class="uk-text-center uk-height-large uk-flex uk-flex-middle" style="background: url(<?php the_sub_field('image'); ?>) no-repeat center left; background-size: cover">
										<?php } else { ?>
                                    <a href="<?php the_sub_field('category_link'); ?>" class="uk-text-center uk-height-large uk-flex uk-flex-middle" style="background: url(<?php the_sub_field('image'); ?>) no-repeat center left; background-size: cover">
										<?php } ?>
                                        <div class="uk-container uk-container-small">
                                            <div class="uk-width-2-5@l uk-width-1-2@m uk-width-2-3@s">
                                                <div class="border-wrap uk-position-relative uk-margin-bottom">
                                                    <?php the_sub_field('content'); ?>
<!-- 													<a href="" class="uk-button-link"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow.svg" height="18" width="53" uk-svg> Link test</a> -->
                                                </div>
												<?php if( get_sub_field('logo_image') ) { ?>
                                                	<img src="<?php the_sub_field('logo_image'); ?>" height="65" width="90">
												<?php } ?>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>

                        <a class="uk-position-center-left uk-position-small uk-visible@s" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-visible@s" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                    
                        <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section> <!-- Section end -->

    <?php if( have_rows('product_type_repeater') ): ?>
        <!--  Product Type Section
        ============================================= -->
        <section class="product-type section-xsmall">
            <div class="uk-container">
                <div class="uk-child-width-1-3@l uk-child-width-1-2@s uk-flex-middle uk-flex-center uk-grid-small" uk-grid>
                    <?php while ( have_rows('product_type_repeater') ) : the_row();
                        // Get product type data
                        $term = get_sub_field('product_categories');
                        $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
                        $image_url = wp_get_attachment_url( $thumbnail_id );

                        if( $term ): ?>
                            <div>
                                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="uk-transition-toggle uk-inline home-box">
                                    <?php if($image_url) { ?>
                                        <img src="<?php echo $image_url; ?>">
                                    <?php } else { ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/beef.jpg">
                                    <?php } ?>

                                    <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-default"></div>

                                    <div class="uk-position-top-left uk-position-small">
                                        <h2><?php echo esc_html( $term->name ); ?></h2>

<!--                                         <h4><?php echo esc_html( $term->description ); ?></h4> -->
            							<h4><?php the_field('product_subtitle', $term); ?></h4>

                                        <span class="uk-button-link"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow.svg" height="18" width="53" uk-svg></span>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section> <!-- Section end -->
    <?php endif; ?>

    <!-- Promo Section
    ============================================= -->
    <section class="promo">
        <div class="uk-container">
            <div class="uk-height-medium uk-flex uk-flex-middle" style="background: url(<?php the_field('promo_image'); ?>) no-repeat center left; background-size: cover">
                <div class="uk-container uk-container-small">
                    <div class="uk-width-1-2@m uk-width-2-3@s">
                        <div>
                            <?php the_field('promo_content'); ?>

                            <a href="<?php the_field('promo_discover_more_link'); ?>" class="uk-button-link"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow.svg" height="18" width="53" uk-svg class="uk-margin-small-right">Discover more</a>
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
            <div class="uk-text-center uk-margin-bottom title-border uk-position-relative">
                <h1><?php the_field('top_sellers_title'); ?></h1>
            </div>
            <div class="uk-text-center uk-margin-large-bottom">
				<?php the_field('top_sellers_content'); ?>
            </div>

            <div class="uk-child-width-1-4@m uk-child-width-1-2@s uk-flex-middle uk-flex-center uk-text-center uk-grid-small" uk-grid>
                <?php
                    // Query arguments
                    $mypost = array(
                        'post_type'         => 'product',
                        'meta_key'          => 'total_sales',
                        'orderby'           => 'meta_value_num',
                        'posts_per_page'    => '4',
                    );

                    $loop = new WP_Query( $mypost );

                    if( $loop->have_posts() ) : 
                        while( $loop->have_posts() ) : $loop->the_post(); 
                            wc_get_template_part( 'content', 'product' ); 
                        endwhile;

                    wp_reset_postdata();
                    endif;
                ?>
            </div>
        </div>
    </section> <!-- Section end -->

    <?php include('partials/mailing-list.php'); ?>

<?php endwhile;

get_footer(); ?>