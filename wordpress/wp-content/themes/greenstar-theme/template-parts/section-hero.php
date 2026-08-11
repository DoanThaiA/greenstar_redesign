<?php
/**
 * Template Part: Hero Section
 *
 * @package greenstar-theme
 */

// Get hero settings from Customizer
$hero_badge    = get_theme_mod( 'greenstar_hero_badge',    __( 'Natural &amp; Certified Products', 'greenstar-theme' ) );
$hero_title    = get_theme_mod( 'greenstar_hero_title',    "From Vietnam's Farms\nTo The World" );
$hero_subtitle = get_theme_mod( 'greenstar_hero_subtitle', __( 'GreenStar Vietnam produces premium freeze-dried herbs, vegetables and natural supplements — trusted by partners in over 30 countries.', 'greenstar-theme' ) );
$hero_cta1     = get_theme_mod( 'greenstar_hero_cta1',     __( 'Explore Products', 'greenstar-theme' ) );
$hero_cta2     = get_theme_mod( 'greenstar_hero_cta2',     __( 'Contact Us', 'greenstar-theme' ) );

// Hero background image
$hero_bg_id  = get_theme_mod( 'greenstar_hero_bg', 0 );
$hero_bg_url = $hero_bg_id
    ? wp_get_attachment_image_url( $hero_bg_id, 'greenstar-hero' )
    : get_template_directory_uri() . '/assets/images/hero-bg.jpg';

// Parse title to highlight last word with <span>
$title_parts = preg_split( '/(\n)/', trim( $hero_title ) );
$title_html  = '';
foreach ( $title_parts as $part ) {
    // Wrap the last word of each line in the accent span
    $words     = explode( ' ', trim( $part ) );
    $last_word = array_pop( $words );
    $line      = implode( ' ', $words );
    $title_html .= ( $line ? esc_html( $line ) . ' ' : '' ) . '<span>' . esc_html( $last_word ) . '</span><br>';
}
?>

<section class="hero" id="hero" aria-label="<?php esc_attr_e( 'Homepage Hero', 'greenstar-theme' ); ?>">

    <!-- Background -->
    <div class="hero__bg" style="background-image:url('<?php echo esc_url( $hero_bg_url ); ?>');" aria-hidden="true"></div>
    <div class="hero__overlay" aria-hidden="true"></div>

    <div class="container">
        <div class="hero__content" data-reveal>

            <!-- Badge -->
            <div class="hero__badge">
                <span>🌿</span>
                <?php echo wp_kses_post( $hero_badge ); ?>
            </div>

            <!-- Title -->
            <h1 class="hero__title">
                <?php echo $title_html; // Already escaped above ?>
            </h1>

            <!-- Description -->
            <p class="hero__desc"><?php echo esc_html( $hero_subtitle ); ?></p>

            <!-- CTAs -->
            <div class="hero__actions">
                <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"
                   class="btn btn-primary btn-lg"
                   id="hero-cta-primary">
                    <?php echo esc_html( $hero_cta1 ); ?> &rarr;
                </a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                   class="btn btn-outline btn-lg"
                   style="color:#fff;border-color:rgba(255,255,255,.6);"
                   id="hero-cta-secondary">
                    <?php echo esc_html( $hero_cta2 ); ?>
                </a>
            </div>

        </div>
    </div><!-- .container -->

    <!-- Key Stats Bar -->
    <div class="hero__stats" aria-label="<?php esc_attr_e( 'Key Statistics', 'greenstar-theme' ); ?>">
        <div class="container">
            <div class="hero__stats-inner">
                <div class="hero__stat">
                    <span class="hero__stat-num" data-count="15" data-suffix="+">15+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Years Experience', 'greenstar-theme' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-num" data-count="30" data-suffix="+">30+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Countries Exported', 'greenstar-theme' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-num" data-count="200" data-suffix="+">200+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Products Available', 'greenstar-theme' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-num" data-count="500" data-suffix="+">500+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Global Partners', 'greenstar-theme' ); ?></span>
                </div>
            </div>
        </div>
    </div><!-- .hero__stats -->

    <!-- Scroll indicator -->
    <div class="hero__scroll" aria-hidden="true">
        <div class="hero__scroll-icon"></div>
        <span><?php esc_html_e( 'Scroll', 'greenstar-theme' ); ?></span>
    </div>

</section><!-- .hero -->
