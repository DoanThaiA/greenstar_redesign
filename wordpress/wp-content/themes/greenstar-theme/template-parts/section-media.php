<?php
/**
 * Template Part: Partners Section
 *
 * @package greenstar-theme
 */

$partners_query = new WP_Query( array(
    'post_type'      => 'gs_partner',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order title',
    'order'          => 'ASC'
) );
?>

<section class="partners-section section-py" style="background-color: #fafafa; border-top: 1px solid #eaeaea;" id="partners" aria-labelledby="partners-title">
    <div class="container">
        
        <div class="text-center" data-reveal>
            <span class="section-label"><?php esc_html_e( 'Our Partners', 'greenstar-theme' ); ?></span>
            <h2 class="section-title" id="partners-title">
                <?php esc_html_e( 'Trusted by Global Brands', 'greenstar-theme' ); ?>
            </h2>
        </div>

        <?php if ( $partners_query->have_posts() ) : ?>
            <div class="partners-grid" data-reveal data-reveal-delay="200">
                <?php while ( $partners_query->have_posts() ) : $partners_query->the_post(); 
                    $partner_url = get_post_meta( get_the_ID(), '_gs_partner_url', true );
                    $partner_url = ! empty( $partner_url ) ? $partner_url : '#';
                    
                    $img_url = get_template_directory_uri() . '/assets/images/placeholder.jpg';
                    if ( has_post_thumbnail() ) {
                        $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    }
                ?>
                    <a href="<?php echo esc_url( $partner_url ); ?>" class="partner-card" <?php echo ( $partner_url !== '#' ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?> aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="partner-card__img" loading="lazy">
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <p class="text-center" style="margin-top: 2rem; color: #888;"><?php esc_html_e( 'No partners found. Add them in the WordPress Admin under "Partners".', 'greenstar-theme' ); ?></p>
        <?php endif; ?>

    </div>
</section>
