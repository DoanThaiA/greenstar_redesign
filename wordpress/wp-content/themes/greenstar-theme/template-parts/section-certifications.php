<?php
/**
 * Template Part: Certifications Section
 *
 * @package greenstar-theme
 */

$certs_query = new WP_Query( array(
    'post_type'      => 'gs_certification',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC'
) );
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

        <?php if ( $certs_query->have_posts() ) : ?>
            <!-- Certs slider -->
            <div class="certs-slider-wrapper">
                <button class="cert-slider-btn prev" aria-label="Previous">❮</button>
                <div class="certs-grid" id="certs-grid">
                    <?php while ( $certs_query->have_posts() ) : $certs_query->the_post(); 
                        $img_url = get_template_directory_uri() . '/assets/images/placeholder.jpg';
                        if ( has_post_thumbnail() ) {
                            $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        }
                    ?>
                        <div class="cert-card" data-reveal>
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="cert-card__img" loading="lazy">
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <button class="cert-slider-btn next" aria-label="Next">❯</button>
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
            <span class="cert-lightbox-close" aria-label="Close">&times;</span>
            <img class="cert-lightbox-content" id="cert-lightbox-img" alt="Zoomed Certification">
        </div>

    </div><!-- .container -->
</section><!-- .certs-section -->
