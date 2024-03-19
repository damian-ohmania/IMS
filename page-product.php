<?php
/**
 * Template for Product page
 *
 * Template Name: Product
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

   <!--  Section
    ============================================= -->
    <section>
        <div class="uk-container">

            <ul class="uk-breadcrumb">
                <li><a href="">Beef</a></li>
                <li><a href="">Bbq Meats</a></li>
                <li><span>Rump Steaks</span></li>
            </ul>

            <div uk-grid>

                <div class="uk-width-auto@m">
                    <div>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product.jpg">
                    </div>
                </div>
                
                <div class="uk-width-expand@m">
                    <div class="uk-position-relative uk-height-1-1">
                    <div class="uk-margin-medium-bottom title-border title-border-left uk-position-relative">
                        <h2>Rump Steaks</h2>
                        <p>Yorkshire Rump Steak 227g (8oz).</p>
                    </div>
                    <p>Text here about the product…</p>
                    <div class="uk-position-bottom-left uk-visible@l">
                        <div>
                            <ul class="uk-flex">
                                <li class="uk-margin-small-right" uk-tooltip="Made in Britain"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/img.png"></li>
                                <li class="uk-margin-small-right" uk-tooltip="Suitable for Barbeque"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/img1.png"></li>
                                <li class="uk-margin-small-right" uk-tooltip="Suitable for Frozen"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/img2.png"></li>
                            </ul>
                            <div class="uk-flex uk-flex-wrap uk-margin-small-bottom">
                                <div class="price-bar uk-flex uk-flex-middle uk-flex-around uk-flex-wrap">
                                    <p class="uk-margin-small-right">5 per pack  |  142g – 170g</p>
                                    <p class="uk-margin-medium-left"><strong>£000.00</strong></p>
                                </div>
                                <div class="price-bar gold uk-flex uk-flex-middle">
                                    <p><span class="uk-margin-right">-</span>1<span class="uk-margin-left">+</span></p>
                                </div>
                                <a href="" class="uk-button uk-button-primary">Add To Basket</a>
                            </div>

                            <div class="uk-flex uk-flex-wrap uk-margin-small-bottom">
                                <div class="price-bar uk-flex uk-flex-middle uk-flex-around uk-flex-wrap">
                                    <p class="uk-margin-small-right">5 per pack  |  142g – 170g</p>
                                    <p class="uk-margin-medium-left"><strong>£000.00</strong></p>
                                </div>
                                <div class="price-bar gold uk-flex uk-flex-middle">
                                    <p><span class="uk-margin-right">-</span>1<span class="uk-margin-left">+</span></p>
                                </div>
                                <a href="" class="uk-button uk-button-primary">Add To Basket</a>
                            </div>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/pay.png">
                        </div>
                    </div>
                    </div>
                </div>

                <div class="uk-width-1-1 uk-hidden@l">
                    <div class="uk-flex uk-flex-bottom">
                        <div>
                            <ul class="uk-flex">
                                <li class="uk-margin-small-right"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/britain.svg" height="40" width="40"></li>
                                <li class="uk-margin-small-right"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bbq.svg" height="40" width="40"></li>
                                <li class="uk-margin-small-right"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/frozen.svg" height="40" width="40"></li>
                            </ul>
                            <div class="uk-flex uk-flex-wrap uk-margin-small-bottom">
                                <div class="price-bar uk-flex uk-flex-middle uk-flex-around uk-flex-wrap">
                                    <p class="uk-margin-small-right">5 per pack  |  142g – 170g</p>
                                    <p class="uk-margin-medium-left"><strong>£000.00</strong></p>
                                </div>
                                <div class="price-bar uk-flex uk-flex-middle">
                                    <p><span class="uk-margin-small-right">-</span>1<span class="uk-margin-small-left">+</span></p>
                                </div>
                                <a href="" class="uk-button uk-button-primary">Add To Basket</a>
                            </div>

                            <div class="uk-flex uk-flex-wrap uk-margin-small-bottom">
                                <div class="price-bar uk-flex uk-flex-middle uk-flex-around">
                                    <p class="uk-margin-small-right">5 per pack  |  142g – 170g</p>
                                    <p class="uk-margin-medium-left"><strong>£000.00</strong></p>
                                </div>
                                <div class="price-bar uk-flex uk-flex-middle">
                                    <p><span class="uk-margin-small-right">-</span>1<span class="uk-margin-small-left">+</span></p>
                                </div>
                                <a href="" class="uk-button uk-button-primary">Add To Basket</a>
                            </div>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/applePay.svg" height="65" width="100">
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section> <!-- Section end -->

    <!-- Section
    ============================================= -->
    <section class="uk-section section-large">
        <div class="uk-container">

            <div class="uk-text-center uk-margin-large-bottom title-border uk-position-relative">
                <h4>You might also like</h4>
            </div>

            <div class="uk-child-width-1-4@m uk-child-width-1-2@s uk-flex-middle uk-flex-center uk-text-center uk-grid-small" uk-grid>
                <div>
                    <a href="product-page/" class="product-box uk-text-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product-img.jpg">
                        <div class="product-box-inner transition">
                            <h5>Product name</h5>
                            <p>Variable weight text</p>
                            <span class="price">£0.00</span>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="product-page/" class="product-box uk-text-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product-img.jpg">
                        <div class="product-box-inner transition">
                            <h5>Product name</h5>
                            <p>Variable weight text</p>
                            <span class="price">£0.00</span>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="product-page/" class="product-box uk-text-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product-img.jpg">
                        <div class="product-box-inner transition">
                            <h5>Product name</h5>
                            <p>Variable weight text</p>
                            <span class="price">£0.00</span>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="product-page/" class="product-box uk-text-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product-img.jpg">
                        <div class="product-box-inner transition">
                            <h5>Product name</h5>
                            <p>Variable weight text</p>
                            <span class="price">£0.00</span>
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </section> <!-- Section end -->

    <?php include('partials/mailing-list.php'); ?>

<?php endwhile;

get_footer(); ?>