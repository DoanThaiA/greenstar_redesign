<?php
/**
 * Template Part: Certifications Section
 *
 * @package greenstar-theme
 */

$certifications = array(
    array(
        'icon'  => '🏆',
        'name'  => 'ISO 22000:2018',
        'body'  => __( 'Food Safety Management System Certification', 'greenstar-theme' ),
    ),
    array(
        'icon'  => '🔬',
        'name'  => 'TSL Test Report',
        'body'  => __( 'Rigorous laboratory testing for quality and safety compliance', 'greenstar-theme' ),
    ),
    array(
        'icon'  => '✅',
        'name'  => 'Export Standards',
        'body'  => __( 'Meeting strict international requirements for global export', 'greenstar-theme' ),
    ),
    array(
        'icon'  => '🌿',
        'name'  => 'Natural Origin',
        'body'  => __( 'Certified 100% natural agricultural ingredients', 'greenstar-theme' ),
    ),
);
?>

<section class="certs-section section-py" id="certifications" aria-labelledby="certs-title">
    <div class="container">

        <!-- Heading -->
        <div class="cert-intro" data-reveal>
            <span class="section-label"><?php esc_html_e( 'Quality Assurance', 'greenstar-theme' ); ?></span>
            <h2 class="section-title" id="certs-title">
                <?php esc_html_e( 'Our Certifications', 'greenstar-theme' ); ?>
            </h2>
            <p class="section-subtitle">
                <?php esc_html_e( 'GreenStar Vietnam upholds the highest international quality, safety and sustainability standards — giving our global partners complete confidence.', 'greenstar-theme' ); ?>
            </p>
        </div>

        <!-- Certs grid -->
        <div class="certs-grid">
            <?php foreach ( $certifications as $i => $cert ) : ?>
                <div class="cert-card" data-reveal data-reveal-delay="<?php echo esc_attr( $i * 100 ); ?>">
                    <div class="cert-card__icon" aria-hidden="true">
                        <?php echo $cert['icon']; ?>
                    </div>
                    <div class="cert-card__name"><?php echo esc_html( $cert['name'] ); ?></div>
                    <div class="cert-card__body"><?php echo esc_html( $cert['body'] ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>

    </div><!-- .container -->
</section><!-- .certs-section -->
