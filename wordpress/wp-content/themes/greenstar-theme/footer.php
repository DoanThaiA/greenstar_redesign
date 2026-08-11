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
                        'facebook'  => array( 'icon' => 'f',  'label' => 'Facebook' ),
                        'instagram' => array( 'icon' => 'ig', 'label' => 'Instagram' ),
                        'linkedin'  => array( 'icon' => 'in', 'label' => 'LinkedIn' ),
                        'youtube'   => array( 'icon' => 'yt', 'label' => 'YouTube' ),
                    );
                    foreach ( $socials as $network => $data ) :
                        $url = get_theme_mod( "greenstar_{$network}", '#' );
                    ?>
                        <a href="<?php echo esc_url( $url ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="<?php echo esc_attr( $data['label'] ); ?>">
                            <?php echo esc_html( $data['icon'] ); ?>
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
