<?php
/**
 * Template Part: News Card
 *
 * Used to display a single post within the news grid.
 *
 * @package greenstar-theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'news-card' ); ?>>
    
    <div class="news-card__img">
        <a href="<?php the_permalink(); ?>">
            <?php 
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) );
            } else {
                // Fallback placeholder
                echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/placeholder.jpg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
            }
            ?>
        </a>
        
        <?php 
        // Display the first category as a badge over the image
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<span class="news-card__badge">' . esc_html( $categories[0]->name ) . '</span>';
        }
        ?>
    </div>

    <div class="news-card__body">
        <div class="news-card__date">
            <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
        </div>
        
        <h3 class="news-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <div class="news-card__excerpt">
            <?php 
            // Get excerpt and trim it cleanly
            $excerpt = get_the_excerpt();
            $excerpt = wp_trim_words( $excerpt, 20, '...' );
            echo wp_kses_post( wpautop( $excerpt ) ); 
            ?>
        </div>
        
        <div class="news-card__footer">
            <a href="<?php the_permalink(); ?>" class="news-readmore">
                <?php esc_html_e( 'Read Article', 'greenstar-theme' ); ?>
            </a>
        </div>
    </div>

</article>
