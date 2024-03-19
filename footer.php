        <!-- Footer
        ============================================= -->
        <footer>
            <div class="uk-container">
                <div class="uk-margin-medium">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-svg.svg" heigh="95" width="100">
                </div>
                <?php get_sidebar(); ?>
                
            </div>
        </footer> <!-- Footer end -->
        
        <?php wp_footer(); ?>
    </body>
</html>
<?php echo do_shortcode('[activecampaign form=1]'); ?>
<?php echo do_shortcode('[activecampaign form=7]'); ?>