<?php
/**
 * Template Part: About Page Hero
 *
 * @package greenstar-theme
 */

// Background image (reuse hero bg from customizer, or fallback)
$hero_bg_id  = get_theme_mod( 'greenstar_hero_bg', 0 );
$hero_bg_url = $hero_bg_id
    ? wp_get_attachment_image_url( $hero_bg_id, 'greenstar-hero' )
    : get_template_directory_uri() . '/assets/images/hero-bg.jpg';
?>

<section class="about-hero" aria-labelledby="about-hero-title">

    <div class="about-hero__bg" style="background-image:url('<?php echo esc_url( $hero_bg_url ); ?>');" aria-hidden="true"></div>
    <div class="about-hero__overlay" aria-hidden="true"></div>

    <div class="container about-hero__container">

        <!-- Breadcrumb -->
        <nav class="about-hero__breadcrumb" aria-label="<?php esc_attr_e( 'breadcrumb', 'greenstar-theme' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'greenstar-theme' ); ?></a>
            <span aria-hidden="true">/</span>
            <span><?php esc_html_e( 'About Us', 'greenstar-theme' ); ?></span>
        </nav>

        <!-- Headline -->
        <div class="about-hero__content">
            <div class="about-hero__badge"><?php esc_html_e( 'Our Story', 'greenstar-theme' ); ?></div>
            <h1 class="about-hero__title" id="about-hero-title">
                <?php esc_html_e( 'About', 'greenstar-theme' ); ?>
                <span><?php esc_html_e( 'GreenStar Vietnam', 'greenstar-theme' ); ?></span>
            </h1>
            <p class="about-hero__subtitle">
                <?php esc_html_e( 'A leading representative in delivering the finest nutritional values of Vietnamese cuisine — especially rice-based products — to global markets.', 'greenstar-theme' ); ?>
            </p>
        </div>

    </div>

    <!-- Stats bar -->
    <div class="about-hero__stats-bar" aria-label="<?php esc_attr_e( 'Key statistics', 'greenstar-theme' ); ?>">
        <div class="container">
            <div class="about-hero__stats">
                <div class="about-hero__stat">
                    <span class="about-hero__stat-num">20+</span>
                    <span class="about-hero__stat-label"><?php esc_html_e( 'Years Experience', 'greenstar-theme' ); ?></span>
                </div>
                <div class="about-hero__stat">
                    <span class="about-hero__stat-num">30+</span>
                    <span class="about-hero__stat-label"><?php esc_html_e( 'Export Countries', 'greenstar-theme' ); ?></span>
                </div>
                <div class="about-hero__stat">
                    <span class="about-hero__stat-num">5</span>
                    <span class="about-hero__stat-label"><?php esc_html_e( 'Product Lines', 'greenstar-theme' ); ?></span>
                </div>
                <div class="about-hero__stat">
                    <span class="about-hero__stat-num">100%</span>
                    <span class="about-hero__stat-label"><?php esc_html_e( 'Natural Ingredients', 'greenstar-theme' ); ?></span>
                </div>
            </div>
        </div>
    </div>

</section><!-- .about-hero -->
