<?php
/**
 * Default Sidebar
 *
 * @package WordPress
 * @subpackage Cosco Shipping
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<div class="sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
    <ul class="uk-child-width-1-4@l" uk-grid>
        <?php if ( ! dynamic_sidebar('main-widget') ) :
            dynamic_sidebar('main-widget');
        endif; // end sidebar widget area ?>    
    </ul>
</div>
