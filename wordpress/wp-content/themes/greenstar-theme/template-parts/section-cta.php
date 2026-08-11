<?php
/**
 * Template Part: CTA Banner Section
 *
 * @package greenstar-theme
 */

$cta_title     = get_theme_mod( 'greenstar_cta_title',     __( 'We Are Now Exporting GreenStar Products Worldwide', 'greenstar-theme' ) );
$cta_subtitle  = get_theme_mod( 'greenstar_cta_subtitle',  __( 'Partner with us for premium quality, reliable supply and competitive pricing. We support international distributors with full documentation and compliance support.', 'greenstar-theme' ) );
$cta_btn_label = get_theme_mod( 'greenstar_cta_btn_label', __( 'Become Our Distributor', 'greenstar-theme' ) );
$cta_btn_url   = get_theme_mod( 'greenstar_cta_btn_url',   home_url( '/contact/' ) );
$video_url     = get_theme_mod( 'greenstar_cta_video_url', '' );
?>

<section class="cta-section" id="cta-banner" aria-labelledby="cta-title">
    <div class="cta-section__bg" aria-hidden="true"></div>

    <div class="container">
        <div class="cta-section__inner" data-reveal>

            <?php if ( $video_url ) : ?>
                <button class="cta-section__icon"
                        id="cta-play-btn"
                        data-video-url="<?php echo esc_url( $video_url ); ?>"
                        aria-label="<?php esc_attr_e( 'Play our company video', 'greenstar-theme' ); ?>">
                    ▶
                </button>
            <?php else : ?>
                <div class="cta-section__icon" aria-hidden="true" style="cursor:default;">🌍</div>
            <?php endif; ?>

            <h2 class="cta-section__title" id="cta-title">
                <?php echo esc_html( $cta_title ); ?>
            </h2>

            <p class="cta-section__subtitle">
                <?php echo wp_kses_post( $cta_subtitle ); ?>
            </p>

            <div class="cta-section__newsletter" style="max-width: 500px; margin: 2rem auto; display: flex; gap: 0.5rem; background: rgba(255,255,255,0.1); padding: 0.5rem; border-radius: 50px;">
                <input type="email" placeholder="<?php esc_attr_e( 'Enter your email address...', 'greenstar-theme' ); ?>" style="flex: 1; border: none; background: transparent; color: white; padding: 0.5rem 1rem; outline: none; border-radius: 50px;" required>
                <button type="submit" class="btn btn-primary" style="border-radius: 50px; padding: 0.5rem 1.5rem; border: none;">
                    <?php esc_html_e( 'Subscribe', 'greenstar-theme' ); ?>
                </button>
            </div>

            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap; margin-top:2rem;">
                <a href="<?php echo esc_url( $cta_btn_url ); ?>"
                   class="btn btn-primary btn-lg"
                   id="cta-primary-btn">
                    <?php echo esc_html( $cta_btn_label ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"
                   class="btn btn-white btn-lg"
                   id="cta-products-btn">
                    <?php esc_html_e( 'View Product Catalogue', 'greenstar-theme' ); ?>
                </a>
            </div>

        </div>
    </div>
</section><!-- .cta-section -->
