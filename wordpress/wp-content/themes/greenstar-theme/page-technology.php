<?php
/**
 * Template Name: Our Technology
 *
 * @package greenstar-theme
 */

get_header();

// Background image (reuse hero bg from customizer, same as Home/About)
$hero_bg_id  = get_theme_mod( 'greenstar_hero_bg', 0 );
$hero_bg_url = $hero_bg_id
    ? wp_get_attachment_image_url( $hero_bg_id, 'greenstar-hero' )
    : get_template_directory_uri() . '/assets/images/hero-bg.jpg';
?>

<main id="primary" class="site-main" role="main">

    <!-- Hero Section -->
    <section class="tech-hero" aria-labelledby="tech-hero-title">
        <div class="tech-hero__bg" style="background-image:url('<?php echo esc_url( $hero_bg_url ); ?>');" aria-hidden="true"></div>
        <div class="tech-hero__overlay" aria-hidden="true"></div>
        <div class="container tech-hero__container">
            <h1 class="tech-hero__title" id="tech-hero-title"><?php esc_html_e( 'Our Technology', 'greenstar-theme' ); ?></h1>
            <p class="tech-hero__subtitle">
                <?php esc_html_e( 'State-of-the-art facilities and strict quality control processes ensuring the highest standards of food safety.', 'greenstar-theme' ); ?>
            </p>
        </div>
    </section>

    <!-- Factory Overview -->
    <section class="tech-overview">
        <div class="container">
            <div class="tech-overview__grid">
                
                <div class="tech-overview__icon">
                    <img src="<?php echo esc_url( content_url( 'uploads/2026/09/tech-facility-1.jpg' ) ); ?>"
                         alt="<?php esc_attr_e( 'GreenStar Vietnam Factory', 'greenstar-theme' ); ?>"
                         loading="lazy">
                </div>
                
                <div class="tech-overview__content">
                    <h2 class="section-title" style="margin-bottom: 1.5rem; font-size: clamp(1.6rem, 2.6vw, 2.2rem);">
                        <?php esc_html_e( 'Message From Us', 'greenstar-theme' ); ?>
                    </h2>
                    <p>
                        <?php esc_html_e( 'First of all, GreenStar Vietnam would like to extend our sincere greetings and best wishes for good health, prosperity, and success to our valued customers and business partners.', 'greenstar-theme' ); ?>
                    </p>
                    <p>
                        <?php esc_html_e( 'GreenStar Vietnam is a professional manufacturer, exporter, and OEM supplier of rice-based food products in Vietnam. We specialize in the production, import–export, and OEM manufacturing of rice noodles, including dried rice noodles, dried pho noodles, glass noodles (mung bean noodles), fresh rice noodles, fresh pho noodles, and rice paper for spring rolls, serving both domestic and international markets.', 'greenstar-theme' ); ?>
                    </p>
                    <p>
                        <?php esc_html_e( 'With a strong commitment to cooperation and sustainable growth, we aim to become a reliable OEM partner and trusted exporter of Vietnamese rice noodle products for organizations, enterprises, and individual clients worldwide. Our products are manufactured under strict quality control processes to meet international export standards, ensuring consistency, food safety, and customer satisfaction.', 'greenstar-theme' ); ?>
                    </p>
                    <p>
                        <?php esc_html_e( 'Through continuous improvement and dedication, GreenStar Vietnam is committed to providing our partners with high-quality products, competitive pricing, reliable supply, and professional OEM services. We always prioritize credibility, attentiveness, and long-term cooperation in every partnership.', 'greenstar-theme' ); ?>
                    </p>
                    <p>
                        <?php esc_html_e( 'For all these reasons, we firmly believe that our customers and partners will be fully satisfied.', 'greenstar-theme' ); ?>
                        <br>
                        <?php esc_html_e( 'We sincerely wish you success and prosperity in your business.', 'greenstar-theme' ); ?>
                    </p>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Factory Gallery -->
    <section class="tech-gallery">
        <div class="container">
            <h2 class="tech-gallery__title"><?php esc_html_e( 'Our Facilities', 'greenstar-theme' ); ?></h2>
            <div class="tech-gallery__carousel">
                <div class="tech-gallery__grid">
                    <?php
                    // Referenced by file path (not attachment ID): the numeric media
                    // library ID for the same file can differ between environments
                    // (local vs demo have separate databases with independent ID
                    // sequences), so an ID that means "factory photo" here could
                    // resolve to a completely different, pre-existing image there.
                    $tech_gallery_images = array(
                        1  => __( 'Production Line Warehouse', 'greenstar-theme' ),
                        2  => __( 'Empty Factory Warehouse', 'greenstar-theme' ),
                        3  => __( 'Cold Storage Entrance', 'greenstar-theme' ),
                        4  => __( 'Storage Room', 'greenstar-theme' ),
                        5  => __( 'Drying Trays', 'greenstar-theme' ),
                        6  => __( 'Production Corridor', 'greenstar-theme' ),
                        7  => __( 'Processing Equipment Corridor', 'greenstar-theme' ),
                        8  => __( 'Processing Machinery', 'greenstar-theme' ),
                        9  => __( 'Drying Chambers', 'greenstar-theme' ),
                        10 => __( 'Storage Area', 'greenstar-theme' ),
                        11 => __( 'Factory Exterior Gate', 'greenstar-theme' ),
                        12 => __( 'Factory Building', 'greenstar-theme' ),
                    );
                    foreach ( $tech_gallery_images as $gs_i => $gs_alt ) :
                        $gs_url = content_url( "uploads/2026/09/tech-facility-{$gs_i}.jpg" );
                        ?>
                        <div class="gallery-item">
                            <img src="<?php echo esc_url( $gs_url ); ?>" alt="<?php echo esc_attr( $gs_alt ); ?>" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Standard CTA -->
    <?php get_template_part( 'template-parts/section', 'cta' ); ?>

</main><!-- #primary -->

<?php
get_footer();
