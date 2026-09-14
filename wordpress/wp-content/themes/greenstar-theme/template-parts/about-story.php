<?php
/**
 * Template Part: About – Our Story (two-column)
 *
 * @package greenstar-theme
 */
?>

<section class="about-story section-py" id="our-story" aria-labelledby="story-title">
    <div class="container">
        <div class="about-story__grid">

            <!-- Left: Main Image -->
            <div class="about-story__images" aria-hidden="true">
                <div class="about-story__img-main">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-products-diagram.jpg' ); ?>"
                         alt="<?php esc_attr_e( 'Main products included: rice vermicelli, pho, glass noodles, rice paper', 'greenstar-theme' ); ?>"
                         class="about-story__photo">
                </div>
            </div>

            <!-- Right: Text content matching the old design -->
            <div class="about-story__content">
                <span class="section-label" style="margin-bottom: 0.5rem; display: block; color: var(--color-primary); font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;">
                    <?php esc_html_e( 'About Us', 'greenstar-theme' ); ?>
                </span>
                
                <h2 class="section-title" id="story-title" style="margin-bottom: 1.5rem; font-size: clamp(1.6rem, 2.6vw, 2.2rem);">
                    <?php esc_html_e( 'Introduction of GreenStar Vietnam Trading, Production and Import–Export Company Limited', 'greenstar-theme' ); ?>
                </h2>

                <p class="about-story__para" style="font-size: 1.2rem; margin-bottom: 1.5rem;">
                    <strong><?php esc_html_e( 'GreenStar Vietnam Company', 'greenstar-theme' ); ?></strong>
                    <?php esc_html_e( 'is a typical representative in providing and introducing to consumers the best nutritional values of Vietnamese cuisine, especially products made from rice – a traditional and well-known ingredient of Vietnam. We aim to bring you distinctive product experiences and unique flavors such as rice vermicelli, fresh rice noodles, dried rice noodles, dried pho noodles, fresh pho noodles, glass noodles (mung bean noodles), rice paper for spring rolls, and more.', 'greenstar-theme' ); ?>
                </p>

                <p class="about-story__para" style="font-size: 1.2rem; margin-bottom: 2rem;">
                    <?php esc_html_e( "With more than 20 years of experience in the export rice noodle processing industry, under the wise, dedicated, and visionary leadership of the company's management, together with a team of key personnel who are fully committed to the company's shared mission, GreenStar Vietnam has successfully exported numerous orders to markets around the world, including Japan, South Korea, Thailand, Taiwan, Russia, and others.", 'greenstar-theme' ); ?>
                </p>

                <div class="about-story__cta">
                    <a href="<?php echo esc_url( greenstar_translated_page_url( 109, '/contact/' ) ); ?>" class="btn btn-primary" id="about-contact-btn">
                        <?php esc_html_e( 'Contact Us', 'greenstar-theme' ); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section><!-- .about-story -->
