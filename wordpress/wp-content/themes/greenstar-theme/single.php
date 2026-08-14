<?php
/**
 * The template for displaying all single posts
 *
 * @package greenstar-theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <div class="container single-news-container">
        
        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'news-detail-main' ); ?>>
                
                <header class="news-detail-header">
                    <h1 class="news-detail-title"><?php the_title(); ?></h1>
                    
                    <div class="news-detail-meta">
                        <?php 
                        $cats = get_the_category();
                        if ( ! empty( $cats ) ) {
                            echo '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '" class="cat-link">' . esc_html( $cats[0]->name ) . '</a>';
                        }
                        ?>
                        <span class="date">
                            <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
                        </span>
                        <span class="author">
                            <?php esc_html_e( 'By', 'greenstar-theme' ); ?> <?php the_author(); ?>
                        </span>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="news-detail-featured-image">
                        <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="news-content">
                    <?php the_content(); ?>
                </div>
                
                <div class="news-share">
                    <span class="news-share__label"><?php esc_html_e( 'Share this article:', 'greenstar-theme' ); ?></span>
                    <div class="news-share__links">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn" aria-label="Share on Facebook">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn" aria-label="Share on Twitter">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M23.95,4.57a10,10,0,0,1-2.82.77,4.96,4.96,0,0,0,2.16-2.72,9.9,9.9,0,0,1-3.12,1.19,4.92,4.92,0,0,0-8.39,4.49A14,14,0,0,1,1.67,3.15,4.92,4.92,0,0,0,3.2,9.72,4.9,4.9,0,0,1,1,9.11v.06a4.93,4.93,0,0,0,3.95,4.83,4.86,4.86,0,0,1-2.22.08,4.93,4.93,0,0,0,4.6,3.42A9.9,9.9,0,0,1,0,19.54a13.94,13.94,0,0,0,7.55,2.21,13.9,13.9,0,0,0,14-13.73c0-.21,0-.42-.01-.63A10,10,0,0,0,24,4.59Z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn" aria-label="Share on LinkedIn">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20.45,20.45h-3.56v-5.36c0-1.28-.02-2.92-1.78-2.92-1.78,0-2.05,1.39-2.05,2.83v5.45h-3.56V9h3.41v1.56h.05c.48-.9,1.64-1.85,3.37-1.85,3.61,0,4.28,2.37,4.28,5.45v6.29ZM5.34,7.43A2.06,2.06,0,1,1,7.4,5.37,2.06,2.06,0,0,1,5.34,7.43ZM7.12,20.45H3.56V9h3.56Z"/></svg>
                        </a>
                    </div>
                </div>

                <?php
                // Previous/next post navigation.
                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Article:', 'greenstar-theme' ) . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Article:', 'greenstar-theme' ) . '</span> <span class="nav-title">%title</span>',
                    )
                );
                ?>

            </article><!-- #post-<?php the_ID(); ?> -->

            <!-- Sidebar -->
            <aside class="news-sidebar" role="complementary">
                
                <!-- Categories Widget -->
                <div class="sidebar-widget">
                    <h3 class="widget-title"><?php esc_html_e( 'News Categories', 'greenstar-theme' ); ?></h3>
                    <div class="widget-categories">
                        <ul>
                            <?php
                            $categories = get_categories( array( 'hide_empty' => true ) );
                            foreach ( $categories as $category ) {
                                echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Recent Posts Widget -->
                <div class="sidebar-widget">
                    <h3 class="widget-title"><?php esc_html_e( 'Recent Articles', 'greenstar-theme' ); ?></h3>
                    <ul class="widget-recent-posts">
                        <?php
                        $recent_posts = new WP_Query( array(
                            'post_type'           => 'post',
                            'posts_per_page'      => 3,
                            'post_status'         => 'publish',
                            'ignore_sticky_posts' => true,
                            'post__not_in'        => array( get_the_ID() )
                        ) );
                        if ( $recent_posts->have_posts() ) :
                            while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
                                ?>
                                <li class="widget-recent-post">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="recent-post-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'thumbnail', array( 'alt' => get_the_title() ) ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="recent-post-info">
                                        <h4 class="recent-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <span class="recent-post-date"><time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></span>
                                    </div>
                                </li>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>

            </aside>

        <?php endwhile; // End of the loop. ?>

    </div><!-- .container -->

    <!-- Related Posts Section -->
    <?php
    $current_cats = get_the_category();
    if ( ! empty( $current_cats ) ) {
        $cat_ids = wp_list_pluck( $current_cats, 'term_id' );
        $related_args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'category__in'   => $cat_ids,
            'post__not_in'   => array( get_the_ID() ),
            'orderby'        => 'date',
            'order'          => 'DESC'
        );
        $related_query = new WP_Query( $related_args );

        if ( $related_query->have_posts() ) :
            ?>
            <section class="related-posts-section">
                <div class="container">
                    <h2 class="section-title" style="margin-bottom: 2.5rem; text-align: center;"><?php esc_html_e( 'You may also be interested in', 'greenstar-theme' ); ?></h2>
                    <div class="news-grid">
                        <?php 
                        while ( $related_query->have_posts() ) : $related_query->the_post();
                            get_template_part( 'template-parts/content', 'news-card' );
                        endwhile; 
                        ?>
                    </div>
                </div>
            </section>
            <?php
            wp_reset_postdata();
        endif;
    }
    ?>

    <?php get_template_part( 'template-parts/section', 'cta' ); ?>

</main><!-- #primary -->

<?php
get_footer();
