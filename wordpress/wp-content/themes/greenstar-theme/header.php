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

<!-- ================================================
     Top Bar
     ================================================ -->
<div class="top-bar" role="banner">
    <div class="container">
        <div class="top-bar__inner">

            <div class="top-bar__contact">
                <?php $phone = get_theme_mod( 'greenstar_phone', '0933 898 896' ); ?>
                <?php $hours = get_theme_mod( 'greenstar_hours', 'Business Hours: 8:00 AM – 5:00 PM' ); ?>

                <span>
                    <span aria-hidden="true">🕒</span>
                    <?php echo esc_html( $hours ); ?>
                </span>

                <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" style="color:var(--color-primary);font-weight:700;">
                    <span aria-hidden="true">📞</span>
                    <?php esc_html_e( 'Hotline:', 'greenstar-theme' ); ?> <?php echo esc_html( $phone ); ?>
                </a>
            </div>

            <div class="top-bar__social" aria-label="<?php esc_attr_e( 'Social Media Links', 'greenstar-theme' ); ?>">
                <?php
                $socials = array(
                    'facebook'  => array( 'icon' => 'f',  'label' => 'Facebook' ),
                    'instagram' => array( 'icon' => 'ig', 'label' => 'Instagram' ),
                    'linkedin'  => array( 'icon' => 'in', 'label' => 'LinkedIn' ),
                    'youtube'   => array( 'icon' => 'yt', 'label' => 'YouTube' ),
                );
                foreach ( $socials as $network => $data ) :
                    $url = get_theme_mod( "greenstar_{$network}", '#' );
                    if ( '#' === $url ) continue;
                ?>
                    <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"
                       aria-label="<?php echo esc_attr( $data['label'] ); ?>">
                        <?php echo esc_html( $data['icon'] ); ?>
                    </a>
                <?php endforeach; ?>
            </div>

        </div><!-- .top-bar__inner -->
    </div><!-- .container -->
</div><!-- .top-bar -->


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
