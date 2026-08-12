<?php
/**
 * Header template – GreenStar Vietnam
 *
 * Includes: <html>, <head>, Top Bar, sticky header with logo + nav.
 *
 * @package greenstar-theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary">
    <?php esc_html_e( 'Skip to content', 'greenstar-theme' ); ?>
</a>

<!-- Top Bar Removed -->


<!-- ================================================
     Site Header
     ================================================ -->
<header id="masthead" class="site-header" role="banner">
    <div class="container">
        <div class="header-inner">

            <!-- Logo -->
            <?php greenstar_logo(); ?>

            <!-- Primary Navigation -->
            <?php greenstar_primary_nav(); ?>

            <!-- Header Actions -->
            <div class="header-actions">

                <!-- Search -->
                <div class="header-search">
                    <button class="header-search__toggle" aria-label="<?php esc_attr_e( 'Open search', 'greenstar-theme' ); ?>">
                        🔍
                    </button>
                    <?php get_search_form(); ?>
                </div>

                <!-- Contact CTA -->
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                   class="btn btn-primary btn-sm"
                   id="header-contact-btn">
                    <?php esc_html_e( 'Get A Quote', 'greenstar-theme' ); ?>
                </a>

                <!-- Mobile hamburger -->
                <button class="nav-toggle"
                        id="nav-toggle"
                        aria-controls="site-navigation"
                        aria-expanded="false"
                        aria-label="<?php esc_attr_e( 'Toggle navigation', 'greenstar-theme' ); ?>">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

        </div><!-- .header-inner -->
    </div><!-- .container -->
</header><!-- #masthead -->

<!-- Nav overlay (mobile) -->
<div class="nav-overlay" id="nav-overlay" aria-hidden="true"></div>
