<?php
/**
 * Template Part: Featured Products Section
 *
 * Displays products from the 'gs_product' CPT in tabbed groups by category.
 * Falls back to sample cards on a fresh install.
 *
 * @package greenstar-theme
 */

// Fetch featured products (up to 8)
$featured_products = new WP_Query( array(
    'post_type'      => 'gs_product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => 'gs_featured',
            'value'   => '1',
            'compare' => '=',
        ),
    ),
) );

// Also get categories for tabs
$product_categories = get_terms( array(
    'taxonomy'   => 'gs_category',
    'hide_empty' => true,
    'number'     => 5,
) );

// Fallback product data for empty installs
$fallback_products = array(
    array(
        'name'  => __( 'Dried Rice Vermicelli', 'greenstar-theme' ),
        'desc'  => __( 'Premium dried rice vermicelli made from pure Vietnamese rice. Traditional taste, chewy texture, perfect for healthy meals.', 'greenstar-theme' ),
        'badge' => __( 'Bestseller', 'greenstar-theme' ),
        'icon'  => '🍜',
        'cat'   => 'noodles',
    ),
    array(
        'name'  => __( 'Freshly Dried Rice Vermicelli', 'greenstar-theme' ),
        'desc'  => __( 'Innovative drying technology that retains the moisture and freshness of traditional vermicelli.', 'greenstar-theme' ),
        'badge' => __( 'Premium', 'greenstar-theme' ),
        'icon'  => '🌿',
        'cat'   => 'noodles',
    ),
    array(
        'name'  => __( 'Dried Pho Noodles', 'greenstar-theme' ),
        'desc'  => __( 'Authentic flat rice noodles for Vietnam\'s famous Pho. Easy to prepare, restaurant-quality texture.', 'greenstar-theme' ),
        'badge' => __( 'Bestseller', 'greenstar-theme' ),
        'icon'  => '🍲',
        'cat'   => 'noodles',
    ),
    array(
        'name'  => __( 'Freshly Dried Pho Noodles', 'greenstar-theme' ),
        'desc'  => __( 'Soft, tender Pho noodles processed with advanced freeze-drying to lock in freshness without preservatives.', 'greenstar-theme' ),
        'badge' => '',
        'icon'  => '🥢',
        'cat'   => 'noodles',
    ),
    array(
        'name'  => __( 'Freeze-Dried Instant Coffee', 'greenstar-theme' ),
        'desc'  => __( '30g Paper Box. 100% pure Vietnamese coffee, freeze-dried to preserve maximum aroma and bold flavor.', 'greenstar-theme' ),
        'badge' => __( 'Bestseller', 'greenstar-theme' ),
        'icon'  => '☕',
        'cat'   => 'coffee',
    ),
    array(
        'name'  => __( 'Aeroco 99 Ground Coffee', 'greenstar-theme' ),
        'desc'  => __( '250g Box. Specially roasted ground coffee for traditional Phin brewing. Rich, dark, and highly aromatic.', 'greenstar-theme' ),
        'badge' => '',
        'icon'  => '🌱',
        'cat'   => 'coffee',
    ),
    array(
        'name'  => __( 'Aeroco 85 Ground Coffee', 'greenstar-theme' ),
        'desc'  => __( '250g Box. A balanced blend of premium Robusta and Arabica beans, perfect for Phin brewing.', 'greenstar-theme' ),
        'badge' => __( 'Popular', 'greenstar-theme' ),
        'icon'  => '🍂',
        'cat'   => 'coffee',
    ),
    array(
        'name'  => __( 'A7 Roasted Coffee Beans', 'greenstar-theme' ),
        'desc'  => __( '500g Bag. Whole roasted coffee beans carefully selected for espresso and specialty coffee shops.', 'greenstar-theme' ),
        'badge' => __( 'Premium', 'greenstar-theme' ),
        'icon'  => '📦',
        'cat'   => 'coffee',
    ),
);

$has_real_products = $featured_products->have_posts();
?>

<section class="featured-products section-py" id="products" aria-labelledby="products-title">
    <div class="container">

        <!-- Heading -->
        <div class="text-center" data-reveal>
            <span class="section-label"><?php esc_html_e( 'Featured Products', 'greenstar-theme' ); ?></span>
            <h2 class="section-title" id="products-title">
                <?php esc_html_e( 'Explore Our Natural Ingredients', 'greenstar-theme' ); ?>
            </h2>
            <p class="section-subtitle">
                <?php esc_html_e( 'Ethically sourced, scientifically processed and rigorously tested natural ingredients for global markets.', 'greenstar-theme' ); ?>
            </p>
        </div>

        <?php if ( ! is_wp_error( $product_categories ) && ! empty( $product_categories ) ) : ?>
            <!-- Category tabs -->
            <div class="products-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Product categories', 'greenstar-theme' ); ?>">
                <button class="tab-btn active" data-tab="all" role="tab" aria-selected="true" id="tab-all">
                    <?php esc_html_e( 'All', 'greenstar-theme' ); ?>
                </button>
                <?php foreach ( $product_categories as $cat ) : ?>
                    <button class="tab-btn" data-tab="<?php echo esc_attr( $cat->slug ); ?>"
                            role="tab" aria-selected="false" id="tab-<?php echo esc_attr( $cat->slug ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Fallback Category tabs -->
            <div class="products-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Product categories', 'greenstar-theme' ); ?>">
                <button class="tab-btn active" data-tab="all" role="tab" aria-selected="true" id="tab-all">
                    <?php esc_html_e( 'All', 'greenstar-theme' ); ?>
                </button>
                <button class="tab-btn" data-tab="noodles" role="tab" aria-selected="false" id="tab-noodles">
                    <?php esc_html_e( 'Rice Noodles', 'greenstar-theme' ); ?>
                </button>
                <button class="tab-btn" data-tab="coffee" role="tab" aria-selected="false" id="tab-coffee">
                    <?php esc_html_e( 'Premium Coffee', 'greenstar-theme' ); ?>
                </button>
            </div>
        <?php endif; ?>

        <!-- Product grid -->
        <?php if ( $has_real_products ) : ?>
            <div class="product-grid tab-panel" data-tab="all">
                <?php while ( $featured_products->have_posts() ) : $featured_products->the_post();
                    $badge = get_post_meta( get_the_ID(), 'gs_badge', true );
                ?>
                    <article class="product-card" id="product-<?php the_ID(); ?>">
                        <div class="product-card__img">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'greenstar-card', array( 'alt' => get_the_title(), 'loading' => 'lazy' ) ); ?>
                            <?php else : ?>
                                <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;font-size:4rem;background:var(--color-off-white);">🌿</div>
                            <?php endif; ?>
                            <?php if ( $badge ) : ?>
                                <span class="product-card__badge"><?php echo esc_html( $badge ); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="product-card__body">
                            <h3 class="product-card__name"><?php the_title(); ?></h3>
                            <p class="product-card__desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="product-card__link" aria-label="<?php echo esc_attr( sprintf( __( 'View details for %s', 'greenstar-theme' ), get_the_title() ) ); ?>">
                                <?php esc_html_e( 'View Details', 'greenstar-theme' ); ?> →
                            </a>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

        <?php else : ?>
            <!-- Fallback cards -->
            <div class="product-grid">
                <?php foreach ( $fallback_products as $i => $product ) : ?>
                    <article class="product-card" data-cat="<?php echo esc_attr( $product['cat'] ); ?>" data-reveal data-reveal-delay="<?php echo esc_attr( ( $i % 4 ) * 80 ); ?>">
                        <div class="product-card__img">
                            <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;font-size:4rem;background:var(--color-off-white);">
                                <?php echo $product['icon']; ?>
                            </div>
                            <?php if ( $product['badge'] ) : ?>
                                <span class="product-card__badge"><?php echo esc_html( $product['badge'] ); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="product-card__body">
                            <h3 class="product-card__name"><?php echo esc_html( $product['name'] ); ?></h3>
                            <p class="product-card__desc"><?php echo esc_html( $product['desc'] ); ?></p>
                            <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="product-card__link">
                                <?php esc_html_e( 'View Details', 'greenstar-theme' ); ?> →
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- CTA -->
        <div class="products-cta" data-reveal>
            <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"
               class="btn btn-outline"
               id="view-all-products-btn">
                <?php esc_html_e( 'Browse All Products', 'greenstar-theme' ); ?> &rarr;
            </a>
        </div>

    </div><!-- .container -->
</section><!-- .featured-products -->
