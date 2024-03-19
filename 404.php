<?php
/**
 * IMS 404 page
 *
 * @package WordPress
 * @subpackage IMS
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header();
?>


<!-- About Block
============================================= -->
<section class="uk-section">

<div class="uk-container">
    <div class="uk-width-3-4@m">
        <div class="content uk-padding-large uk-padding-remove-top uk-position-relative">
            <h2><?php _e("Ooopps! The Page you were looking for, couldn't be found.", "butcher" ); ?></h2>
            <p><?php _e( "Try something else by browsing the links above", "butcher" ); ?></p>
        </div>
    </div>
</div>

</section> <!-- end Block -->

<?php get_footer(); ?>