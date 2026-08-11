<?php
/**
 * Front Page Template – GreenStar Vietnam Homepage
 *
 * Assembles all homepage sections via get_template_part().
 *
 * @package greenstar-theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <?php
    /**
     * Hero Section
     * Full-width hero with background image, headline, stats and scroll indicator.
     */
    get_template_part( 'template-parts/section', 'hero' );

    /**
     * About / Features Section
     * Why Choose GreenStar — feature cards, gallery, CTA.
     */
    get_template_part( 'template-parts/section', 'about' );

    /**
     * Product Categories Section
     * Visual category grid pulling from gs_category taxonomy.
     */
    get_template_part( 'template-parts/section', 'categories' );

    /**
     * Featured Products Section
     * Product cards pulling from gs_product CPT.
     */
    get_template_part( 'template-parts/section', 'products' );

    /**
     * Certifications Section
     * ISO, HACCP, Organic, GMP, EU Organic.
     */
    get_template_part( 'template-parts/section', 'certifications' );

    /**
     * Global Export Section
     * World map SVG, stats counters, country list.
     */
    get_template_part( 'template-parts/section', 'export' );

    /**
     * Media Mentions Section
     * Press logos from TinMoi, Zing, 24h
     */
    get_template_part( 'template-parts/section', 'media' );

    /**
     * CTA & Newsletter Banner Section
     * Full-width dark green banner with newsletter, dual CTAs and optional video.
     */
    get_template_part( 'template-parts/section', 'cta' );
    ?>

</main><!-- #primary -->

<?php
get_footer();
