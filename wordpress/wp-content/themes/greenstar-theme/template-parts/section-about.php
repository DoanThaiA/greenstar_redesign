<?php
/**
 * Template Part: About / Features Section
 *
 * @package greenstar-theme
 */

$features = array(
    array(
        'icon'  => '🚚',
        'title' => __( 'Nationwide Delivery', 'greenstar-theme' ),
        'desc'  => __( 'Fast and reliable shipping network ensuring products reach you wherever you are.', 'greenstar-theme' ),
    ),
    array(
        'icon'  => '🏷️',
        'title' => __( 'Competitive Prices', 'greenstar-theme' ),
        'desc'  => __( 'Optimized production and direct supply chain to offer the best market value.', 'greenstar-theme' ),
    ),
    array(
        'icon'  => '⭐',
        'title' => __( 'Genuine Products', 'greenstar-theme' ),
        'desc'  => __( '100% authentic, certified agricultural products with guaranteed origin.', 'greenstar-theme' ),
    ),
    array(
        'icon'  => '📦',
        'title' => __( 'Diverse Selection', 'greenstar-theme' ),
        'desc'  => __( 'From premium rice noodles to specialized freeze-dried coffee.', 'greenstar-theme' ),
    ),
    array(
        'icon'  => '⚙️',
        'title' => __( 'Optimized Services', 'greenstar-theme' ),
        'desc'  => __( 'Dedicated support and streamlined processes for B2B and B2C clients.', 'greenstar-theme' ),
    ),
);


?>

<section class="about-section section-py" id="about" aria-labelledby="about-title">
    <div class="container">

        <!-- Section heading -->
        <div class="text-center" data-reveal>
            <span class="section-label"><?php esc_html_e( 'Why Choose GreenStar', 'greenstar-theme' ); ?></span>
            <h2 class="section-title" id="about-title">
                <?php esc_html_e( 'Vietnam\'s Leading Rice-Based Product Manufacturer', 'greenstar-theme' ); ?>
            </h2>
            <p class="section-subtitle">
                <?php esc_html_e( 'From seed to shipment, we control every step of the process to deliver the highest quality natural products to global markets.', 'greenstar-theme' ); ?>
            </p>
        </div>

        <!-- Features grid -->
        <div class="features-grid">
            <?php foreach ( $features as $i => $feature ) : ?>
                <div class="feature-card" data-reveal data-reveal-delay="<?php echo esc_attr( $i * 100 ); ?>">
                    <div class="feature-card__icon" aria-hidden="true">
                        <?php echo $feature['icon']; ?>
                    </div>
                    <h3 class="feature-card__title"><?php echo esc_html( $feature['title'] ); ?></h3>
                    <p class="feature-card__desc"><?php echo esc_html( $feature['desc'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>




    </div><!-- .container -->
</section><!-- .about-section -->
