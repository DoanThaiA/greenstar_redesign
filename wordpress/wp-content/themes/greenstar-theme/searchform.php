<?php
/**
 * Custom search form
 *
 * @package greenstar-theme
 */
?>
<form role="search" method="get" class="header-search__form search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'greenstar-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'greenstar-theme' ); ?>" />
    <button type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'submit button', 'greenstar-theme' ); ?></button>
</form>
