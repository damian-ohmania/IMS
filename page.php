<?php
/**
 * IMS default page template
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

<!-- Page
============================================= -->
<section class="uk-section">

    <div class="uk-container uk-container-small">

        <div class="uk-text-center uk-margin-large-bottom">
            <h1><?php the_title(); ?></h1>
        </div>

        <div>
            <?php the_content(); ?>
        </div>

    </div>

</section> <!-- end Page -->
<?php endwhile;

get_footer(); ?>