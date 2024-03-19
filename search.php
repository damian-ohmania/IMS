<?php
/**
 * Search Template
 *
 * Displays search results
 *
 */

// Exit if accessed directly

if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header(); ?>

<!-- Intro
============================================= -->
<section id="intro">
    <div class="uk-container uk-container-small uk-text-center">

        <form id="searchform" class="newsletter-form" action="<?php echo home_url( '/' ); ?>" method="get">
            <input class="newsletter-input" type="text" name="s" value="Search documentation" onblur="if (this.value == '') {this.value = 'Search documentation';}" onfocus="if (this.value == 'Search documentation') {this.value = '';}" />
            <input type="hidden" name="post_type" value="documentation" />
            <input class="uk-button uk-button-primary newsletter-button" id="searchsubmit" type="submit" alt="Search" value="Search" />
        </form>
        
    </div>
</section> <!-- #intro end -->

<!-- Main
============================================= -->
<section id="main">
    <div class="uk-container">
        <div uk-grid>
            <div class="uk-width-3-4@s">
                <div id="search-results" uk-margin>
                <?php 
                if(have_posts()) {
                while(have_posts()) : the_post(); ?>
                    <article>

                        <h2 class="uk-margin-remove-top">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <?php the_content(); ?>
                    </article>
                <?php endwhile; ?>
                <?php } else { ?>
                        <h3><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'butcher' ); ?></h3>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section> <!-- #main end -->

get_footer(); ?>