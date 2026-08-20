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

                <p><?php esc_html_e( 'Green Star Vietnam Import–Export Joint Stock Company is a leading representative in delivering and introducing the finest nutritional values of Vietnamese cuisine, especially rice-based products, one of Vietnam\'s most iconic and traditional ingredients, to customers worldwide.', 'greenstar-theme' ); ?></p>

                <?php $zalo_url = get_theme_mod( 'greenstar_zalo', 'https://zalo.me/0933898896' ); ?>
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
                        $cats = get_terms( array(
                            'taxonomy'   => 'gs_category',
                            'parent'     => 0,
                            'hide_empty' => false,
                        ) );
                        if ( ! is_wp_error( $cats ) ) {
                            foreach ( $cats as $cat ) {
                                echo '<li><a href="' . esc_url( get_term_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
                            }
                        }
                        echo '<li><a href="' . esc_url( home_url( '/products/' ) ) . '">' . esc_html__( 'View All Products', 'greenstar-theme' ) . '</a></li>';
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
                        <?php echo esc_html( get_theme_mod( 'greenstar_address', __( '4th Floor, Viet Tower Building, No. 1 Thai Ha Street, Trung Liet Ward, Dong Da District, Hanoi, Vietnam', 'greenstar-theme' ) ) ); ?>
                    </li>
                    <li>
                        <span class="icon" aria-hidden="true">📞</span>
                        <?php
                        $phone = get_theme_mod( 'greenstar_phone', '0933 898 896' );
                        echo '<a href="tel:' . esc_attr( preg_replace( '/\s+/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a>';
                        ?>
                    </li>
                    <li>
                        <span class="icon" aria-hidden="true">✉</span>
                        <?php
                        $email = get_theme_mod( 'greenstar_email', 'ketoangreenstar2023@gmail.com' );
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

<!-- Zalo floating contact button -->
<div class="zalo-float-widget">
    <a href="<?php echo esc_url( $zalo_url ); ?>" target="_blank" rel="noopener noreferrer" class="zalo-float-widget__link" aria-label="Zalo">
        <span class="zalo-float-widget__ring"></span>
        <span class="zalo-float-widget__circle">
            <img src="<?php echo esc_url( GREENSTAR_URI . '/assets/images/zalo-icon.png' ); ?>" alt="Zalo">
        </span>
    </a>
</div>

<!-- Phone floating contact button -->
<?php
$phone_raw  = get_theme_mod( 'greenstar_phone', '0933 898 896' );
$phone_tel  = preg_replace( '/\s+/', '', $phone_raw );
?>
<div class="phone-float-widget">
    <a href="tel:<?php echo esc_attr( $phone_tel ); ?>" class="phone-float-widget__link" aria-label="<?php esc_attr_e( 'Call us', 'greenstar-theme' ); ?>">
        <span class="phone-float-widget__bar"><?php echo esc_html( $phone_raw ); ?></span>
        <span class="phone-float-widget__ring"></span>
        <span class="phone-float-widget__circle">
            <img src="<?php echo esc_url( GREENSTAR_URI . '/assets/images/phone-icon.png' ); ?>" alt="<?php esc_attr_e( 'Phone', 'greenstar-theme' ); ?>">
        </span>
    </a>
</div>

<!-- Scroll-to-top button -->
<button class="scroll-top" id="scroll-to-top" aria-label="<?php esc_attr_e( 'Scroll to top', 'greenstar-theme' ); ?>">
    ↑
</button>

<?php wp_footer(); ?>
</body>
</html>
