<?php
/**
 * The main template file (blog / archive fallback)
 *
 * Used when no more specific template matches.
 *
 * @package greenstar-theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <div class="container" style="padding-top:4rem;padding-bottom:4rem;">

        <?php if ( have_posts() ) : ?>

            <header class="page-header text-center" style="margin-bottom:3rem;">
                <h1 class="section-title"><?php the_archive_title(); ?></h1>
                <?php the_archive_description( '<p class="section-subtitle" style="margin:0 auto;">', '</p>' ); ?>
            </header>

            <div class="product-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'product-card' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="product-card__img">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'greenstar-card', array( 'alt' => get_the_title() ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="product-card__body">
                            <h2 class="product-card__name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="product-card__desc"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="product-card__link">
                                <?php esc_html_e( 'Read More', 'greenstar-theme' ); ?> →
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php the_posts_navigation(); ?>

        <?php else : ?>

            <div class="text-center" style="padding:5rem 1rem;">
                <span style="font-size:4rem;">🌿</span>
                <h2 class="section-title" style="margin-top:1.5rem;"><?php esc_html_e( 'Nothing Found', 'greenstar-theme' ); ?></h2>
                <p class="section-subtitle" style="margin:1rem auto 2rem;">
                    <?php esc_html_e( 'It looks like nothing was found at this location. Try a search below.', 'greenstar-theme' ); ?>
                </p>
                <?php get_search_form(); ?>
            </div>

        <?php endif; ?>

    </div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer();
