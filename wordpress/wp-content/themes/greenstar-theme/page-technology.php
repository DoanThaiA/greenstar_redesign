<?php
/**
 * Template Name: Our Technology
 *
 * @package greenstar-theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <!-- Hero Section -->
    <section class="tech-hero" aria-labelledby="tech-hero-title">
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
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                    </svg>
                </div>
                
                <div class="tech-overview__content">
                    <p>
                        With a factory and production area covering 1,000 square meters, along with a modern and well-invested production line, Truong Phuc Vina has the capacity to supply up to 500 tons of key products such as dried rice vermicelli, dried pho noodles, and glass noodles. The production process is strictly controlled at every stage, from raw material selection to processing and packaging, ensuring consistent quality and food safety standards.
                    </p>
                    <p>
                        Thanks to its stable manufacturing capacity and efficient operations, Truong Phuc Vina is always able to maintain a reliable and sufficient supply for partners, even during peak demand periods. This strong production capability allows the company to meet large-volume orders, support long-term cooperation, and respond flexibly to the requirements of both domestic and international markets.
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
                <button type="button" class="tech-gallery__nav tech-gallery__nav--prev" aria-label="<?php esc_attr_e( 'Previous', 'greenstar-theme' ); ?>">&#10094;</button>

                <div class="tech-gallery__grid">

                    <div class="gallery-item">
                        <?php echo wp_get_attachment_image( 366, 'large', false, array( 'alt' => 'Factory Floor' ) ); ?>
                    </div>

                    <div class="gallery-item">
                        <?php echo wp_get_attachment_image( 367, 'large', false, array( 'alt' => 'Drying Area' ) ); ?>
                    </div>

                    <div class="gallery-item">
                        <?php echo wp_get_attachment_image( 368, 'large', false, array( 'alt' => 'Processing Machinery' ) ); ?>
                    </div>

                    <div class="gallery-item">
                        <?php echo wp_get_attachment_image( 369, 'large', false, array( 'alt' => 'Loading Truck' ) ); ?>
                    </div>

                    <div class="gallery-item">
                        <?php echo wp_get_attachment_image( 370, 'large', false, array( 'alt' => 'Container Loading' ) ); ?>
                    </div>

                    <div class="gallery-item">
                        <?php echo wp_get_attachment_image( 371, 'large', false, array( 'alt' => 'Packaged Products' ) ); ?>
                    </div>

                </div>

                <button type="button" class="tech-gallery__nav tech-gallery__nav--next" aria-label="<?php esc_attr_e( 'Next', 'greenstar-theme' ); ?>">&#10095;</button>
            </div>
        </div>
    </section>

    <!-- Standard CTA -->
    <?php get_template_part( 'template-parts/section', 'cta' ); ?>

</main><!-- #primary -->

<?php
get_footer();
