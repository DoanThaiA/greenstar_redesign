<?php
/**
 * Footer template – GreenStar Vietnam
 *
 * @package greenstar-theme
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">

            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <span class="site-logo__name" style="font-family:var(--font-heading);font-size:1.4rem;color:var(--color-accent);font-weight:700;">
                            <?php bloginfo( 'name' ); ?>
                        </span>
                    <?php endif; ?>
                </a>

                <p><?php esc_html_e( 'Vietnam\'s leading manufacturer of premium freeze-dried herbs, vegetables and natural supplements. Supplying quality natural ingredients to 30+ countries worldwide.', 'greenstar-theme' ); ?></p>

                <!-- Social links -->
                <div class="social-links" aria-label="<?php esc_attr_e( 'Social Media', 'greenstar-theme' ); ?>">
                    <?php
                    $socials = array(
                        'facebook'  => array( 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',  'label' => 'Facebook' ),
                        'instagram' => array( 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>', 'label' => 'Instagram' ),
                        'linkedin'  => array( 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>', 'label' => 'LinkedIn' ),
                        'youtube'   => array( 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-youtube"><path d="M2.5 7.17c0-1.6 1.3-2.9 2.9-2.9h13.2c1.6 0 2.9 1.3 2.9 2.9v9.66c0 1.6-1.3 2.9-2.9 2.9H5.4c-1.6 0-2.9-1.3-2.9-2.9V7.17z"/><path d="m10 15 5-3-5-3v6z"/></svg>', 'label' => 'YouTube' ),
                    );
                    foreach ( $socials as $network => $data ) :
                        $url = get_theme_mod( "greenstar_{$network}", '#' );
                    ?>
                        <a href="<?php echo esc_url( $url ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="<?php echo esc_attr( $data['label'] ); ?>">
                            <?php echo $data['icon']; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Products column -->
            <div class="footer-col">
                <h4><?php esc_html_e( 'Our Products', 'greenstar-theme' ); ?></h4>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-1',
                    'container'      => false,
                    'fallback_cb'    => function() {
                        echo '<ul>';
                        $items = array(
                            __( 'Freeze-Dried Vegetables', 'greenstar-theme' ) => '/products/',
                            __( 'Freeze-Dried Fruits',     'greenstar-theme' ) => '/products/',
                            __( 'Herbal Powders',          'greenstar-theme' ) => '/products/',
                            __( 'Spices & Seasonings',     'greenstar-theme' ) => '/products/',
                            __( 'Mushroom Extracts',       'greenstar-theme' ) => '/products/',
                            __( 'View All Products',       'greenstar-theme' ) => '/products/',
                        );
                        foreach ( $items as $label => $path ) {
                            echo '<li><a href="' . esc_url( home_url( $path ) ) . '">' . esc_html( $label ) . '</a></li>';
                        }
                        echo '</ul>';
                    },
                ) );
                ?>
            </div>

            <!-- Company column -->
            <div class="footer-col">
                <h4><?php esc_html_e( 'Company', 'greenstar-theme' ); ?></h4>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-2',
                    'container'      => false,
                    'fallback_cb'    => function() {
                        echo '<ul>';
                        $items = array(
                            __( 'About GreenStar', 'greenstar-theme' ) => '/about/',
                            __( 'Our Story',        'greenstar-theme' ) => '/about/',
                            __( 'Certifications',   'greenstar-theme' ) => '/certifications/',
                            __( 'Production',       'greenstar-theme' ) => '/production/',
                            __( 'News & Updates',   'greenstar-theme' ) => '/news/',
                            __( 'Contact Us',       'greenstar-theme' ) => '/contact/',
                        );
                        foreach ( $items as $label => $path ) {
                            echo '<li><a href="' . esc_url( home_url( $path ) ) . '">' . esc_html( $label ) . '</a></li>';
                        }
                        echo '</ul>';
                    },
                ) );
                ?>
            </div>

            <!-- Contact column -->
            <div class="footer-col">
                <h4><?php esc_html_e( 'Get In Touch', 'greenstar-theme' ); ?></h4>
                <ul class="footer-contact">
                    <li>
                        <span class="icon" aria-hidden="true">📍</span>
                        <?php echo esc_html( get_theme_mod( 'greenstar_address', __( 'Ho Chi Minh City, Vietnam', 'greenstar-theme' ) ) ); ?>
                    </li>
                    <li>
                        <span class="icon" aria-hidden="true">📞</span>
                        <?php
                        $phone = get_theme_mod( 'greenstar_phone', '+84 28 3823 0000' );
                        echo '<a href="tel:' . esc_attr( preg_replace( '/\s+/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a>';
                        ?>
                    </li>
                    <li>
                        <span class="icon" aria-hidden="true">✉</span>
                        <?php
                        $email = get_theme_mod( 'greenstar_email', 'info@greenstar.vn' );
                        echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
                        ?>
                    </li>
                    <li>
                        <span class="icon" aria-hidden="true">🕐</span>
                        <?php esc_html_e( 'Mon – Fri: 8:00 AM – 5:30 PM (ICT)', 'greenstar-theme' ); ?>
                    </li>
                </ul>
            </div>

        </div><!-- .footer-grid -->
    </div><!-- .container -->

    <!-- Footer bottom bar -->
    <div class="footer-bottom">
        <div class="container" style="display:contents;">
            <span>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.
                <?php esc_html_e( 'All rights reserved.', 'greenstar-theme' ); ?>
            </span>
            <span>
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'greenstar-theme' ); ?></a>
                &nbsp;·&nbsp;
                <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'greenstar-theme' ); ?></a>
            </span>
        </div>
    </div><!-- .footer-bottom -->

</footer><!-- #colophon -->

<!-- Scroll-to-top button -->
<button class="scroll-top" id="scroll-to-top" aria-label="<?php esc_attr_e( 'Scroll to top', 'greenstar-theme' ); ?>">
    ↑
</button>

<?php wp_footer(); ?>
</body>
</html>
