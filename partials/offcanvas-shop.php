<!-- Offcanvas
============================================= -->
<div id="offcanvas" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" uk-close></button>

        <?php $logo = get_field('offcanvas_logo', 'option'); ?>
        <a class="uk-navbar-item uk-padding-remove uk-margin-medium-bottom uk-flex-left" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo $logo['url']; ?>" title="<?php echo $logo['title']; ?>" alt="<?php echo $logo['alt']; ?>" heigh="60" width="100">
        </a>

        <?php // secondary navigation
            if( has_nav_menu( 'secondary' ) ){
                wp_nav_menu(array(
                    'theme_location'    => 'secondary',
                    'walker'            => new UIKit_Menu_Walker(),
                    'items_wrap'        => '<ul class="uk-nav uk-margin">%3$s</ul>'
                ));
            }
        ?> 
    </div>
</div> <!-- #offcanvas end -->