<?php
/*
 * The default template for posts
 */  

get_header();

// Main Loop
while( have_posts() ) : the_post(); ?>

<!-- Blog
============================================= -->
<section id="blog">
    <div class="uk-container">
        <div class="uk-width-3-4@m uk-margin-auto">
			<article class="uk-margin-xlarge-bottom">
				<div class="article-thumbnail uk-inline uk-margin-medium-bottom">
					<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'pagetitle'); ?>
					<img class="transition" src="<?php echo $featured_img_url; ?>" alt="<?php the_title(); ?>" uk-img>
				</div>

				<h2 class="uk-margin-remove-top">
					<?php the_title(); ?>
				</h2>
				<?php the_content(); ?>
			</article>
		</div>
    </div>
</section> <!-- #blog end -->

<?php endwhile;

get_footer(); ?>