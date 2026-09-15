<?php
/**
 * Template Part: Certifications Section
 *
 * @package greenstar-theme
 */

// Referenced by file path (not attachment ID / CPT posts): the numeric
// media library ID and post IDs for the same content can differ between
// environments (local vs demo have separate databases with independent ID
// sequences), so this section renders directly from files bundled with the
// theme rather than from the gs_certification post type.
$certs_images = array(
    'cert-food-safety-hungyen.jpg' => __( 'Food Safety Certificate', 'greenstar-theme' ),
    'cert-halal.jpg'                => __( 'Halal Certificate', 'greenstar-theme' ),
    'cert-iso22000.jpg'             => __( 'ISO 22000:2018 Certificate', 'greenstar-theme' ),
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

        <?php if ( ! empty( $certs_images ) ) : ?>
            <!-- Certs slider -->
            <div class="certs-slider-wrapper">
                <button class="cert-slider-btn prev" aria-label="<?php esc_attr_e( 'Previous', 'greenstar-theme' ); ?>">❮</button>
                <div class="certs-grid" id="certs-grid">
                    <?php foreach ( $certs_images as $gs_file => $gs_title ) :
                        $img_url = content_url( "uploads/2026/09/{$gs_file}" );
                    ?>
                        <div class="cert-card" data-reveal>
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $gs_title ); ?>" class="cert-card__img" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="cert-slider-btn next" aria-label="<?php esc_attr_e( 'Next', 'greenstar-theme' ); ?>">❯</button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const grid = document.getElementById('certs-grid');
                    const prev = document.querySelector('.cert-slider-btn.prev');
                    const next = document.querySelector('.cert-slider-btn.next');
                    if(grid && prev && next) {
                        prev.addEventListener('click', () => {
                            const itemWidth = grid.children[0].offsetWidth + 24; // 1.5rem gap approx 24px
                            grid.scrollBy({ left: -itemWidth, behavior: 'smooth' });
                        });
                        next.addEventListener('click', () => {
                            const itemWidth = grid.children[0].offsetWidth + 24;
                            grid.scrollBy({ left: itemWidth, behavior: 'smooth' });
                        });
                    }

                    // Lightbox Logic
                    const lightbox = document.getElementById('cert-lightbox');
                    const lightboxImg = document.getElementById('cert-lightbox-img');
                    const closeBtn = document.querySelector('.cert-lightbox-close');
                    const certImages = document.querySelectorAll('.cert-card__img');

                    if (lightbox && lightboxImg) {
                        certImages.forEach(img => {
                            img.addEventListener('click', function() {
                                lightboxImg.src = this.src;
                                lightbox.classList.add('active');
                            });
                        });

                        const closeLightbox = () => {
                            lightbox.classList.remove('active');
                            // Clear src after fade out to avoid ghost image on next open
                            setTimeout(() => { lightboxImg.src = ''; }, 300);
                        };

                        closeBtn.addEventListener('click', closeLightbox);
                        lightbox.addEventListener('click', function(e) {
                            if (e.target !== lightboxImg) {
                                closeLightbox();
                            }
                        });
                        
                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                                closeLightbox();
                            }
                        });
                    }
                });
            </script>
        <?php else : ?>
            <p class="text-center" style="color: #888;"><?php esc_html_e( 'No certifications found. Add them in the WordPress Admin under "Certifications".', 'greenstar-theme' ); ?></p>
        <?php endif; ?>

        <!-- Lightbox HTML -->
        <div id="cert-lightbox" class="cert-lightbox">
            <span class="cert-lightbox-close" aria-label="<?php esc_attr_e( 'Close', 'greenstar-theme' ); ?>">&times;</span>
            <img class="cert-lightbox-content" id="cert-lightbox-img" alt="<?php esc_attr_e( 'Zoomed Certification', 'greenstar-theme' ); ?>">
        </div>

    </div><!-- .container -->
</section><!-- .certs-section -->
