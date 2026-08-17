<?php
/**
 * Template Part: Product Categories Section
 *
 * Displays product categories registered under 'gs_category' taxonomy.
 * Falls back to hardcoded defaults when no categories exist yet.
 *
 * @package greenstar-theme
 */

// Fetch categories from taxonomy
$product_cats = get_terms( array(
    'taxonomy'   => 'gs_category',
    'hide_empty' => false,
    'parent'     => 0,
    'number'     => 10,
) );

$use_fallback = is_wp_error( $product_cats ) || empty( $product_cats );

// Icon mapping for our custom categories
$custom_icons = array(
    'dried-rice-vermicelli' => '🍜',
    'dried-pho-noodles'     => '🍲',
    'rice-paper'            => '🌯',
    'glass-noodle'          => '🍝',
    'coffee'                => '☕',
);


?>

<section class="products-section section-py" style="background-color: #f4f7f4; border-top: 1px solid #e2e8e2; border-bottom: 1px solid #e2e8e2;" id="categories" aria-labelledby="categories-title">
    <div class="container">

        <!-- Heading -->
        <div class="text-center" data-reveal>
            <span class="section-label"><?php esc_html_e( 'Our Product Range', 'greenstar-theme' ); ?></span>
            <h2 class="section-title" id="categories-title">
                <?php esc_html_e( 'All Natural GreenStar Products', 'greenstar-theme' ); ?>
            </h2>
            <p class="section-subtitle">
                <?php esc_html_e( 'Explore our extensive catalogue of naturally sourced, clean-label products suitable for the food, supplement and cosmetics industries.', 'greenstar-theme' ); ?>
            </p>
        </div>

        <!-- Category grid -->
        <div class="category-grid" data-reveal>
            <?php if ( $use_fallback ) : ?>
                <?php foreach ( $fallback_cats as $i => $cat ) : ?>
                    <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"
                       class="category-card"
                       id="cat-<?php echo esc_attr( $cat['slug'] ); ?>">
                        <span class="category-card__img" style="display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:var(--color-light-gray);">
                            <?php echo $cat['icon']; ?>
                        </span>
                        <span class="category-card__name"><?php echo esc_html( $cat['name'] ); ?></span>
                        <span class="category-card__count"><?php esc_html_e( 'View Products', 'greenstar-theme' ); ?></span>
                    </a>
                <?php endforeach; ?>

            <?php else : ?>
                <?php foreach ( $product_cats as $cat ) :
                    $cat_link  = get_term_link( $cat );
                    $cat_img   = get_term_meta( $cat->term_id, 'gs_category_image', true );
                    $cat_icon  = get_term_meta( $cat->term_id, 'gs_category_icon', true );
                    if ( ! $cat_icon && isset( $custom_icons[ $cat->slug ] ) ) {
                        $cat_icon = $custom_icons[ $cat->slug ];
                    } elseif ( ! $cat_icon ) {
                        $cat_icon = '🌿';
                    }
                ?>
                    <a href="<?php echo esc_url( is_wp_error( $cat_link ) ? '#' : $cat_link ); ?>"
                       class="category-card"
                       id="cat-<?php echo esc_attr( $cat->slug ); ?>">
                        <?php if ( $cat_img ) : ?>
                            <img src="<?php echo esc_url( $cat_img ); ?>"
                                 alt="<?php echo esc_attr( $cat->name ); ?>"
                                 class="category-card__img"
                                 loading="lazy">
                        <?php else : ?>
                            <span class="category-card__img" aria-hidden="true"
                                  style="display:flex;align-items:center;justify-content:center;font-size:2.5rem;background:var(--color-light-gray);">
                                <?php echo esc_html( $cat_icon ); ?>
                            </span>
                        <?php endif; ?>
                        <span class="category-card__name"><?php echo esc_html( $cat->name ); ?></span>
                        <span class="category-card__count">
                            <?php
                            /* translators: %d: product count */
                            printf( _n( '%d product', '%d products', $cat->count, 'greenstar-theme' ), $cat->count );
                            ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- View all link -->
        <div class="text-center" style="margin-top:2.5rem;">
            <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"
               class="btn btn-primary"
               id="view-all-categories-btn">
                <?php esc_html_e( 'View All Products', 'greenstar-theme' ); ?> &rarr;
            </a>
        </div>

    </div><!-- .container -->
</section><!-- .products-section -->
