<?php
/**
 * Page Template: About Us
 *
 * Template Name: About Page
 *
 * @package greenstar-theme
 */

get_header();
?>

<main id="primary" class="site-main about-page" role="main">

    <?php
    /**
     * 1. About Hero
     * Full-width hero with breadcrumb, H1, subtitle, and stats bar.
     */
    get_template_part( 'template-parts/about', 'hero' );

    /**
     * 2. Our Story
     * Simple two-column section: image left, narrative text right.
     */
    get_template_part( 'template-parts/about', 'story' );

    /**
     * 3. CTA Banner
     * Full-width dark banner with CTAs — reused from homepage.
     */
    get_template_part( 'template-parts/section', 'cta' );
    ?>

</main><!-- #primary -->

<?php get_footer(); ?>
