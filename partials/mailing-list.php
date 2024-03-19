<!-- Mailing List
============================================= -->
<section id="mailing-list" class="mailing-list uk-section-primary section-small uk-preserve-color">
    <div class="uk-container uk-container-small">

        <div class="uk-width-4-5@m uk-margin-auto">
            <div class="uk-text-center">
<!--                 <?php the_field('newsletter_content', 'option'); ?>
                <?php echo do_shortcode(get_field('newsletter_shortcode', 'option')); ?> -->
				<?php echo do_shortcode('[activecampaign form=5]'); ?>
            </div>
        </div>

    </div>
</section> <!-- #Section end -->