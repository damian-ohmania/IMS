<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

    <!-- Section
    ============================================= -->
    <section class="uk-section section-large">
        <div class="uk-container">
            <?php
                $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'You might also like', 'woocommerce' ) );

                if ( $heading ) : ?>
                    <div class="uk-text-center uk-margin-large-bottom title-border uk-position-relative">
                        <h4><?php echo esc_html( $heading ); ?></h4>
						<?php the_field('single_product_you_might_also_like_subtitle', 'option'); ?>
                    </div>
                <?php endif;
            ?>

            <div class="uk-child-width-1-4@m uk-child-width-1-2@s uk-flex-middle uk-flex-center uk-text-center uk-grid-small" uk-grid>
                <?php
                    foreach ( $related_products as $related_product ) :
                        $post_object = get_post( $related_product->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                        wc_get_template_part( 'content', 'product' );
                    endforeach;
                ?>
            </div>
        </div>
    </section> <!-- Section end -->

	<?php
endif;

wp_reset_postdata();