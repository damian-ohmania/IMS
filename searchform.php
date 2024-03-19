<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
?>

<form role="search" method="get" class="search-form uk-search uk-search-large uk-flex uk-flex-center uk-flex-wrap" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="ims-search-form">
		<span class="screen-reader-text"><?php _e( 'Search for:', 'twentytwenty' ); ?></span>
        
		<input type="search" id="ims-search-form" class="uk-search-input uk-text-center" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    
    <input type="hidden" name="post_type" value="product" />
    
	<input type="submit" class="search-submit" value="Search" />
</form>
