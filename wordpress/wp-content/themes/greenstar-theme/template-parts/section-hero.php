<?php
/**
 * Template Part: Hero Section
 *
 * @package greenstar-theme
 */

// Get hero settings
$hero_badge    = __( 'ABOUT GREENSTAR', 'greenstar-theme' );
$hero_title    = "Premium Vietnamese\nRice Products";
$hero_subtitle = __( 'With over 20 years of experience, Greenstar brings the best of Vietnamese cuisine to the world. We specialize in exporting high-quality rice noodles, pho, and rice paper to global markets.', 'greenstar-theme' );

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
                <?php echo wp_kses_post( $hero_badge ); ?>
            </div>

            <!-- Title -->
            <h1 class="hero__title">
                <?php echo $title_html; // Already escaped above ?>
            </h1>

            <!-- Description -->
            <p class="hero__desc"><?php echo esc_html( $hero_subtitle ); ?></p>

            <!-- CTAs removed per user request -->

        </div>
    </div><!-- .container -->

    <!-- Key Stats Bar -->
    <div class="hero__stats" aria-label="<?php esc_attr_e( 'Key Statistics', 'greenstar-theme' ); ?>">
        <div class="container">
            <div class="hero__stats-inner">
                <div class="hero__stat">
                    <span class="hero__stat-num" data-count="20" data-suffix="+">20+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Years Experience', 'greenstar-theme' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-num" data-count="7" data-suffix="+">7+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Product Categories', 'greenstar-theme' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-num" data-count="5" data-suffix="+">5+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Major Markets', 'greenstar-theme' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-num" data-count="100" data-suffix="%">100%</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Committed Team', 'greenstar-theme' ); ?></span>
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
