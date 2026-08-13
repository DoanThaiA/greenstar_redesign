<?php
/**
 * The main blog / news template file
 *
 * Used for the blog index page (home.php) and category archives (archive.php).
 *
 * @package greenstar-theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <!-- News Hero -->
    <section class="news-hero" aria-labelledby="news-hero-title">
        <div class="container news-hero__container">
            <?php if ( is_archive() ) : ?>
                <h1 class="news-hero__title" id="news-hero-title"><?php single_term_title(); ?></h1>
                <?php the_archive_description( '<div class="news-hero__subtitle">', '</div>' ); ?>
            <?php else : ?>
                <h1 class="news-hero__title" id="news-hero-title"><?php esc_html_e( 'News & Updates', 'greenstar-theme' ); ?></h1>
                <p class="news-hero__subtitle">
                    <?php esc_html_e( 'Stay updated with the latest news, industry trends, and announcements from GreenStar Vietnam.', 'greenstar-theme' ); ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Category Filter Bar -->
    <nav class="news-filter" aria-label="<?php esc_attr_e( 'News Categories', 'greenstar-theme' ); ?>">
        <div class="container">
            <div class="news-filter__list">
                <?php
                // "All News" link
                $blog_page_id = get_option( 'page_for_posts' );
                $all_news_url = $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/' );
                $is_all_active = is_home() && ! is_archive() ? ' active' : '';
                
                echo '<a href="' . esc_url( $all_news_url ) . '" class="news-filter__link' . esc_attr( $is_all_active ) . '">' . esc_html__( 'All News', 'greenstar-theme' ) . '</a>';

                // Category links
                $categories = get_categories( array(
                    'hide_empty' => true,
                ) );
                
                if ( ! empty( $categories ) ) {
                    $current_cat_id = is_category() ? get_queried_object_id() : 0;
                    
                    foreach ( $categories as $category ) {
                        $active_class = ( $current_cat_id === $category->term_id ) ? ' active' : '';
                        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="news-filter__link' . esc_attr( $active_class ) . '">' . esc_html( $category->name ) . '</a>';
                    }
                }
                ?>
            </div>
        </div>
    </nav>

    <!-- Main Grid Section -->
    <section class="news-grid-section">
        <div class="container">
            
            <?php if ( have_posts() ) : ?>

                <?php 
                // Featured Post (Only show on the first page, and if it's the main blog page or a category)
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $is_first_page = ( $paged === 1 );
                
                if ( $is_first_page ) : 
                    the_post(); // Load first post data
                ?>
                    <div class="news-featured">
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'news-featured__card' ); ?>>
                            
                            <div class="news-featured__img">
                                <a href="<?php the_permalink(); ?>">
                                    <?php 
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) );
                                    } else {
                                        echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/placeholder.jpg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                    }
                                    ?>
                                </a>
                            </div>

                            <div class="news-featured__content">
                                <div class="news-meta">
                                    <?php 
                                    $cats = get_the_category();
                                    if ( ! empty( $cats ) ) {
                                        echo '<span class="news-meta__cat">' . esc_html( $cats[0]->name ) . '</span>';
                                    }
                                    ?>
                                    <span class="news-meta__date"><time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></span>
                                </div>
                                
                                <h2 class="news-featured__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="news-featured__excerpt">
                                    <?php 
                                    $excerpt = get_the_excerpt();
                                    echo wp_kses_post( wpautop( wp_trim_words( $excerpt, 35, '...' ) ) ); 
                                    ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="news-readmore">
                                    <?php esc_html_e( 'Read Full Story', 'greenstar-theme' ); ?>
                                </a>
                            </div>
                            
                        </article>
                    </div>
                <?php endif; // End Featured Post ?>

                <!-- Remaining Posts Grid -->
                <?php if ( have_posts() ) : ?>
                    <div class="news-grid">
                        <?php 
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/content', 'news-card' );
                        endwhile; 
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Pagination -->
                <div class="news-pagination">
                    <?php 
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '&larr; ' . __( 'Prev', 'greenstar-theme' ),
                        'next_text' => __( 'Next', 'greenstar-theme' ) . ' &rarr;',
                    ) ); 
                    ?>
                </div>

            <?php else : ?>

                <!-- No posts found -->
                <div class="text-center" style="padding: 4rem 1rem;">
                    <span style="font-size: 4rem; opacity: 0.5;">📰</span>
                    <h2 class="section-title" style="margin-top: 1.5rem;">
                        <?php esc_html_e( 'No News Articles Found', 'greenstar-theme' ); ?>
                    </h2>
                    <p style="color: var(--color-text-light); margin-top: 1rem;">
                        <?php esc_html_e( 'We currently do not have any news articles in this category. Please check back later.', 'greenstar-theme' ); ?>
                    </p>
                </div>

            <?php endif; ?>

        </div>
    </section>

    <?php 
    // Include standard CTA at the bottom
    get_template_part( 'template-parts/section', 'cta' ); 
    ?>

</main><!-- #primary -->

<?php get_footer(); ?>
