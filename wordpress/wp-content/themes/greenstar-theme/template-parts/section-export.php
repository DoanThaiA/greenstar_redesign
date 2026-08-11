<?php
/**
 * Template Part: Global Export Section
 *
 * @package greenstar-theme
 */

$export_countries = array(
    __( 'United States', 'greenstar-theme' ),
    __( 'Germany', 'greenstar-theme' ),
    __( 'Japan', 'greenstar-theme' ),
    __( 'Australia', 'greenstar-theme' ),
    __( 'South Korea', 'greenstar-theme' ),
    __( 'United Kingdom', 'greenstar-theme' ),
    __( 'Canada', 'greenstar-theme' ),
    __( 'France', 'greenstar-theme' ),
    __( 'Netherlands', 'greenstar-theme' ),
    __( 'Singapore', 'greenstar-theme' ),
    __( 'UAE', 'greenstar-theme' ),
    __( 'New Zealand', 'greenstar-theme' ),
);
?>

<section class="export-section section-py" id="global-export" aria-labelledby="export-title">
    <div class="container">
        <div class="export-inner">

            <!-- Left: Content -->
            <div class="export-content" data-reveal>
                <span class="section-label"><?php esc_html_e( 'Global Reach', 'greenstar-theme' ); ?></span>
                <h2 class="section-title" id="export-title">
                    <?php esc_html_e( 'Export to 30+ Countries Worldwide', 'greenstar-theme' ); ?>
                </h2>
                <p class="section-subtitle">
                    <?php esc_html_e( 'From our farms in Vietnam\'s fertile highlands to supermarket shelves and supplement brands across the globe — GreenStar has a proven track record of reliable international supply.', 'greenstar-theme' ); ?>
                </p>

                <!-- Stats -->
                <div class="export-stats">
                    <div class="export-stat">
                        <span class="export-stat__num" data-count="30" data-suffix="+">30+</span>
                        <span class="export-stat__label"><?php esc_html_e( 'Countries', 'greenstar-theme' ); ?></span>
                    </div>
                    <div class="export-stat">
                        <span class="export-stat__num" data-count="500" data-suffix="+">500+</span>
                        <span class="export-stat__label"><?php esc_html_e( 'Global Partners', 'greenstar-theme' ); ?></span>
                    </div>
                    <div class="export-stat">
                        <span class="export-stat__num" data-count="200" data-suffix="t">200t</span>
                        <span class="export-stat__label"><?php esc_html_e( 'Annual Production', 'greenstar-theme' ); ?></span>
                    </div>
                    <div class="export-stat">
                        <span class="export-stat__num" data-count="15" data-suffix="+">15+</span>
                        <span class="export-stat__label"><?php esc_html_e( 'Years Exporting', 'greenstar-theme' ); ?></span>
                    </div>
                </div>

                <!-- Country dots -->
                <div class="map-dots" aria-label="<?php esc_attr_e( 'Countries we export to', 'greenstar-theme' ); ?>">
                    <?php foreach ( $export_countries as $country ) : ?>
                        <span class="map-dot"><?php echo esc_html( $country ); ?></span>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top:2rem;">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                       class="btn btn-white"
                       id="export-contact-btn">
                        <?php esc_html_e( 'Start Exporting With Us', 'greenstar-theme' ); ?> &rarr;
                    </a>
                </div>
            </div>

            <!-- Right: World map SVG (simplified) -->
            <div class="export-map" aria-hidden="true" data-reveal data-reveal-delay="200">
                <svg viewBox="0 0 1000 500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="World Map">
                    <title><?php esc_html_e( 'World Map showing GreenStar export locations', 'greenstar-theme' ); ?></title>
                    <!-- Simplified world continents -->
                    <g fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="1">
                        <!-- North America -->
                        <path d="M60,80 L200,70 L220,130 L190,180 L150,200 L100,190 L70,150 Z"/>
                        <!-- South America -->
                        <path d="M140,220 L200,210 L220,310 L180,380 L140,360 L120,300 Z"/>
                        <!-- Europe -->
                        <path d="M420,60 L500,55 L510,110 L480,130 L440,120 L415,100 Z"/>
                        <!-- Africa -->
                        <path d="M430,150 L510,140 L530,270 L490,320 L450,300 L420,250 L415,180 Z"/>
                        <!-- Asia -->
                        <path d="M520,55 L750,45 L780,100 L760,180 L700,200 L600,190 L540,150 L515,110 Z"/>
                        <!-- Southeast Asia / Vietnam region -->
                        <path d="M680,160 L720,155 L730,220 L700,240 L675,220 L668,185 Z" fill="rgba(139,195,74,0.7)" stroke="rgba(139,195,74,0.9)"/>
                        <!-- Australia -->
                        <path d="M720,270 L820,260 L840,340 L800,370 L740,350 L715,310 Z"/>
                        <!-- Japan -->
                        <circle cx="760" cy="130" r="12" fill="rgba(255,255,255,0.4)"/>
                    </g>

                    <!-- Export location dots -->
                    <!-- USA -->
                    <circle cx="140" cy="140" r="6" fill="#8bc34a" opacity="0.9"/>
                    <circle cx="140" cy="140" r="12" fill="rgba(139,195,74,0.25)"/>
                    <!-- Germany -->
                    <circle cx="468" cy="88" r="6" fill="#8bc34a" opacity="0.9"/>
                    <!-- Japan -->
                    <circle cx="762" cy="128" r="6" fill="#8bc34a" opacity="0.9"/>
                    <!-- Australia -->
                    <circle cx="775" cy="310" r="6" fill="#8bc34a" opacity="0.9"/>
                    <!-- UK -->
                    <circle cx="440" cy="75" r="6" fill="#8bc34a" opacity="0.9"/>
                    <!-- Vietnam (origin) -->
                    <circle cx="700" cy="200" r="9" fill="#f5a623" opacity="1"/>
                    <circle cx="700" cy="200" r="18" fill="rgba(245,166,35,0.25)"/>
                    <!-- Korea -->
                    <circle cx="740" cy="120" r="6" fill="#8bc34a" opacity="0.9"/>
                    <!-- UAE -->
                    <circle cx="580" cy="175" r="6" fill="#8bc34a" opacity="0.9"/>
                    <!-- Canada -->
                    <circle cx="120" cy="100" r="6" fill="#8bc34a" opacity="0.9"/>
                    <!-- France -->
                    <circle cx="455" cy="90" r="5" fill="#8bc34a" opacity="0.9"/>

                    <!-- Connection lines from Vietnam -->
                    <g stroke="rgba(139,195,74,0.3)" stroke-width="1" fill="none" stroke-dasharray="4,4">
                        <line x1="700" y1="200" x2="140" y2="140"/>
                        <line x1="700" y1="200" x2="468" y2="88"/>
                        <line x1="700" y1="200" x2="762" y2="128"/>
                        <line x1="700" y1="200" x2="775" y2="310"/>
                        <line x1="700" y1="200" x2="440" y2="75"/>
                        <line x1="700" y1="200" x2="580" y2="175"/>
                    </g>
                </svg>
            </div>

        </div><!-- .export-inner -->
    </div><!-- .container -->
</section><!-- .export-section -->
