<?php
/**
 * Archive Template
 *
 * The template for archive page.
 *
 * @package WordPress
 * @subpackage IMS
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header(); ?>

<!-- Pagetitle
============================================= -->
<section id="pagetitle" class="uk-margin-large">
	<div class="uk-container">
		<div class="uk-text-center">
			<?php $categories = get_the_category();
			if ( ! empty( $categories ) ) { ?>
			<h1><?php echo esc_html( $categories[0]->name ); ?></h1>
			<?php }; ?>
		</div>
	</div>
</section> <!-- #pagetitle end -->

<!-- Main
============================================= -->
<section id="main">
    <div class="uk-container">
        <div uk-grid>
			
            <?php if ( have_posts() ) : ?>
            <div class="uk-width-3-4@m uk-margin-auto">
                <div id="blog" uk-margin="margin: uk-margin-large">
					
					<?php while ( have_posts() ) : the_post(); ?>
                    <article>
                        <div class="article-thumbnail uk-inline uk-margin-medium-bottom">
                            <a href="<?php the_permalink(); ?>">
								<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'news_image'); ?>
                                <img class="transition" src="<?php echo $featured_img_url; ?>" alt="<?php the_title(); ?>" uk-img>
                            </a>
                        </div>

                        <h2 class="uk-margin-remove-top">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

						<p><?php echo butcher_excerpt(30); ?></p>

                        <a class="uk-button uk-button-primary" href="<?php the_permalink(); ?>">Read More</a>
                    </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata();
                    else : ?>
                        <h3><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'butcher' ); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section> <!-- #main end -->
    
<?php get_footer(); ?>