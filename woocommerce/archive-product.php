<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id; ?>

<!-- Section
============================================= -->
<section class="section-small">
    <div class="uk-container uk-container-small uk-text-center">
        <div class="border-wrap uk-position-relative uk-margin">
            <h1><?php woocommerce_page_title(); ?></h1>
			
            <h4><?php the_field('product_subtitle', $taxonomy . '_' . $term_id);; ?></h4>
        </div>
        <?php the_archive_description(); ?>
    </div>
</section> <!-- Section end -->

<!-- Section
============================================= -->
<section class="uk-section">
	<div class="uk-container">
		<div class="uk-margin-large-bottom uk-position-relative">
			<div class="uk-flex uk-flex-wrap uk-flex-center uk-flex-left@m">
				<form>
					<?php echo do_shortcode("[product_categories_dropdown]"); ?>
				</form>
				<?php woocommerce_catalog_ordering(); ?>
			</div>
		</div>

		<div class="uk-child-width-1-4@m uk-child-width-1-2@s uk-flex-center uk-text-center uk-grid-small" uk-grid>
			<?php
				if ( have_posts() ) :
					woocommerce_product_subcategories();

					while ( have_posts() ) : the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile; // end of the loop.
				elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :
					/**
					 * woocommerce_no_products_found hook.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				endif;
			?>
		</div>
		
		<div class="uk-margin-medium-top">
			<?php woocommerce_pagination(); ?>
		</div>
	</div>
</section> <!-- Section end -->

<?php include dirname(__FILE__).'/../partials/mailing-list.php';

get_footer( 'shop' );
