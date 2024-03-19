<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>">
    <div class="section-large uk-padding-remove" uk-grid>
        <div class="uk-width-2-5@m">
            <div class="uk-position-relative">
                <?php
                    /**
                     * Hook: woocommerce_before_single_product_summary.
                     *
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action( 'woocommerce_before_single_product_summary' );
                ?>
            </div>
        </div>

        <div class="uk-width-expand@m">
            <div class="uk-position-relative uk-height-1-1">
                <div class="uk-margin-medium-bottom title-border title-border-left uk-position-relative">
                    <h1><?php the_title(); ?></h1>

					<p><?php the_field('product_subtitle'); ?></p>
                </div>

                <?php the_content(); ?>

                <div class="uk-visible">
                    <div>
						<?php
						$productIcons = get_field('product_icons');
						if( $productIcons ): ?>
						<ul class="uk-flex custom-list">
							<?php if( $productIcons && in_array('britain', $productIcons) ) { ?>
                            <li class="uk-margin-small-right" uk-tooltip="Made in Britain"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/britain.svg"></li>
							<?php } ?>
							<?php if( $productIcons && in_array('barbeque', $productIcons) ) { ?>
                            <li class="uk-margin-small-right" uk-tooltip="Suitable for Barbeque"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bbq.svg"></li>
							<?php } ?>
							<?php if( $productIcons && in_array('frozen', $productIcons) ) { ?>
                            <li class="uk-margin-small-right" uk-tooltip="Suitable for Frozen"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/frozen.svg"></li>
							<?php } ?>
						</ul>
						<?php endif; ?>

                        <?php 
                            if ( $product->is_type( 'simple' ) ) : ?>
                                <div class="uk-flex uk-flex-wrap uk-flex-top">
                                    <div class="price-bar uk-flex uk-flex-middle uk-flex-between uk-flex-wrap uk-margin-small-bottom">
										<?php if(get_field( 'pack_sizes' )) : ?>
											<p><?php the_field( 'pack_sizes' ); ?></p>
										<?php else : ?>
											<p><?php the_field( 'per' ); ?></p>
										<?php endif; ?>
                                        <div>
                                            <?php woocommerce_template_single_price(); ?>
                                        </div>
                                    </div>

                                    <?php woocommerce_template_single_add_to_cart(); ?>
                                </div>
                            <?php elseif ( $product->is_type( 'variable' ) ) :
                                // Loop through available variation data
                                foreach ( $product->get_available_variations() as $variation_data ) :
                                    $url = '?add-to-cart=' . $variation_data['variation_id']; // The dynamic variation ID (URL)

                                    // Get variation name and price
                                    $variation_id       = $variation_data['variation_id'];
                                    $product_variation  = wc_get_product( $variation_id ); 
                                    $variation_name     = $product_variation->get_attribute( 'specification' );
                                    $variation_price    = $product_variation->get_price_html();

                                    // Loop through variation product attributes data
                                    foreach ( $variation_data['attributes'] as $attr_key => $term_slug ) :
                                        // Button text
                                        $button_text = __("Add to cart", "woocommerce"); 

                                        $url .= '&' . $attr_key . '=' . $term_slug . '&quantity=' . 1; // Adding the product attribute name with the term value (to Url)
                                    endforeach; ?>

                                    <div class="uk-flex uk-flex-wrap uk-flex-top uk-margin-small-bottom">
                                        <div class="price-bar uk-flex uk-flex-middle uk-flex-between uk-flex-wrap uk-margin-small-bottom">
                                            <p class="uk-margin-right"><?php echo $variation_name; ?></p>

                                            <div>
                                                <p class="price"><?php echo $variation_price; ?></p>
                                            </div>
                                        </div>

                                        <div class="uk-flex uk-flex-middle uk-margin-small-right uk-margin-small-bottom">
                                            <?php
                                                do_action( 'woocommerce_before_add_to_cart_quantity' );

                                                woocommerce_quantity_input(
                                                    array(
                                                        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product_variation->get_min_purchase_quantity(), $product_variation ),
                                                        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product_variation->get_max_purchase_quantity(), $product_variation ),
                                                        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product_variation->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                                                    )
                                                );

                                                do_action( 'woocommerce_after_add_to_cart_quantity' );
                                            ?>
                                        </div>

                                        <?php
                                            // Displaying the custom variations add to cart buttons
                                            if( isset( $button_text ) ) :
                                                echo '<a href="' . $url . '" class="uk-button uk-button-primary uk-margin-small-bottom">' . $button_text . '</a> ';
                                            endif;
                                        ?>
                                    </div>

                                    <?php
                                endforeach;
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <div class="section-large uk-padding-remove nutrition-info" uk-grid>
        <?php if( have_rows('nutrition') ): ?>
            <?php while ( have_rows('nutrition') ) : the_row(); ?>
				<?php if( get_sub_field('amount_per_serving') ) : ?>
                <div class="uk-width-2-5@m">
                    <div class="nutrition">
                        <h3>Nutrition</h3>
                        <p>Typical values <span>per <?php the_sub_field('amount_per_serving'); ?></span></p>
                        <p>Energy <span><?php the_sub_field('energy_in_kj'); ?>kJ / <?php the_sub_field('energy_in_cal'); ?>kcal</span></p>
                        <p>Total Fat <span><?php the_sub_field('total_fat'); ?>g</span></p>
                        <p>Saturated Fat <span><?php the_sub_field('saturated_fat'); ?>g</span></p>
                        <p hidden>Polyunsaturated Fat <span><?php the_sub_field('polyunsaturated_fat'); ?>g</span></p> 
                        <p hidden>Monounsaturated Fat <span><?php the_sub_field('monounsaturated_fat'); ?>g</span></p> 
                        <p hidden>Cholesterol <span><?php the_sub_field('cholesterol'); ?>g</span></p>
                        <p>Sodium <span><?php the_sub_field('sodium'); ?>g</span></p>
                        <p hidden>Potassium  <span><?php the_sub_field('potassium'); ?>g</span></p>
                        <p>Carbohydrate <span><?php the_sub_field('total_carbohydrates'); ?>g</span></p>
                        <p>Sugars <span><?php the_sub_field('sugars'); ?>g</span></p>
                        <p>Protein <span><?php the_sub_field('protein'); ?>g</span></p>
                        <p hidden>Calcium <span><?php the_sub_field('calcium'); ?>g</span></p>
                        <p hidden>Iron <span><?php the_sub_field('iron'); ?>g</span></p>
                        <p hidden>Fibre <span><?php the_sub_field('fibre'); ?>g</span></p>
                        <p hidden>Vitamin A <span><?php the_sub_field('vitamin_a'); ?>g</span></p>
                        <p hidden>Vitamin C <span><?php the_sub_field('vitamin_c'); ?>g</span></p>
                    </div>
                </div>
				<?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if( get_field('recipe') ): ?>
            <div class="uk-width-expand@m">
                <h3>Recipe</h3>
                <p>Our cooking tips for <?php the_title(); ?>.</p>
                <div id="recipe-wrapper" class="recipe" style="display:none">
                    <p><strong>Ingredients</strong></p>
                    <?php the_field('recipe'); ?>
                </div>
                <a class="uk-button uk-margin-top" id="button">Recipe Suggestion</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
