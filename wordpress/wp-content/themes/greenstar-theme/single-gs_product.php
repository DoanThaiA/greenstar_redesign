<?php
/**
 * The template for displaying a single gs_product.
 *
 * @package greenstar-theme
 */

// Helper: prepend a key=>value pair to an associative array
if ( ! function_exists( 'array_unshift_assoc' ) ) {
    function array_unshift_assoc( &$arr, $key, $val ) {
        $arr = array_merge( array( $key => $val ), $arr );
    }
}

get_header();

while ( have_posts() ) :
    the_post();

    // ── Core data ──────────────────────────────────────────────────────────
    $product_id    = get_the_ID();
    $product_title = get_the_title();

    // Category
    $terms         = get_the_terms( $product_id, 'gs_category' );
    $primary_term  = ( ! is_wp_error( $terms ) && ! empty( $terms ) ) ? $terms[0] : null;

    // Meta fields
    $price         = get_post_meta( $product_id, 'gs_price', true )        ?: __( 'Contact for quotation', 'greenstar-theme' );
    $gallery_ids   = get_post_meta( $product_id, 'gs_gallery', true );      // JSON string of IDs
    $gallery_ids   = $gallery_ids ? json_decode( $gallery_ids, true ) : array();
    $short_specs   = get_post_meta( $product_id, 'gs_short_specs', true );  // newline-separated bullets
    $certifications= get_post_meta( $product_id, 'gs_certifications', true ) ?: '';
    $splash_id     = get_post_meta( $product_id, 'gs_splash_image', true );

    // Spec table fields
    $spec_fields = array(
        'gs_origin'       => __( 'Origin',        'greenstar-theme' ),
        'gs_manufacturer' => __( 'Manufacturer',  'greenstar-theme' ),
        'gs_net_weight'   => __( 'Net Weight',     'greenstar-theme' ),
        'gs_packaging'    => __( 'Packaging',      'greenstar-theme' ),
        'gs_certifications'=> __( 'Certifications','greenstar-theme' ),
        'gs_shelf_life'   => __( 'Shelf Life',     'greenstar-theme' ),
        'gs_ingredients'  => __( 'Ingredients',    'greenstar-theme' ),
        'gs_color'        => __( 'Color',          'greenstar-theme' ),
        'gs_strand_size'  => __( 'Strand Size',    'greenstar-theme' ),
        'gs_style'        => __( 'Style',          'greenstar-theme' ),
        'gs_labeling'     => __( 'Labeling',       'greenstar-theme' ),
        'gs_specification'=> __( 'Specification',  'greenstar-theme' ),
    );
    $specs_data = array();
    foreach ( $spec_fields as $key => $label ) {
        $val = get_post_meta( $product_id, $key, true );
        if ( $val ) {
            $specs_data[ $label ] = $val;
        }
    }
    // Always include Product Name at top
    array_unshift_assoc( $specs_data, __( 'Product Name', 'greenstar-theme' ), $product_title );

    // Build gallery array (featured + extras)
    $images = array();
    if ( has_post_thumbnail() ) {
        $images[] = get_the_post_thumbnail_url( $product_id, 'large' );
    }
    if ( ! empty( $gallery_ids ) ) {
        foreach ( $gallery_ids as $gid ) {
            $src = wp_get_attachment_image_url( $gid, 'large' );
            if ( $src ) {
                $images[] = $src;
            }
        }
    }
    if ( empty( $images ) ) {
        $images[] = GREENSTAR_URI . '/assets/images/placeholder.jpg';
    }

endwhile;
?>

<div class="gsp-detail-wrap">

    <!-- ── Breadcrumb ──────────────────────────────────────────────────── -->
    <div class="gsp-breadcrumb-bar">
        <div class="container">
            <nav class="gsp-breadcrumb" aria-label="breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'greenstar-theme' ); ?></a>
                <span class="sep" aria-hidden="true">/</span>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'gs_product' ) ); ?>"><?php esc_html_e( 'Products', 'greenstar-theme' ); ?></a>
                <?php if ( $primary_term ) : ?>
                    <span class="sep" aria-hidden="true">/</span>
                    <a href="<?php echo esc_url( get_term_link( $primary_term ) ); ?>"><?php echo esc_html( $primary_term->name ); ?></a>
                <?php endif; ?>
                <span class="sep" aria-hidden="true">/</span>
                <span class="current" aria-current="page"><?php echo esc_html( $product_title ); ?></span>
            </nav>
        </div>
    </div>

    <!-- ── Hero: Gallery + Info ────────────────────────────────────────── -->
    <section class="gsp-hero-section" id="product-hero">
        <div class="container">
            <div class="gsp-hero-grid">

                <!-- Gallery column -->
                <div class="gsp-gallery" id="gsp-gallery">
                    <div class="gsp-gallery__main" id="gsp-main-image-wrap">
                        <img
                            src="<?php echo esc_url( $images[0] ); ?>"
                            alt="<?php echo esc_attr( $product_title ); ?>"
                            id="gsp-main-image"
                            class="gsp-gallery__main-img"
                        />
                        <?php if ( count( $images ) > 1 ) : ?>
                        <div class="gsp-gallery__nav">
                            <button class="gsp-gallery__arrow gsp-gallery__prev" aria-label="<?php esc_attr_e( 'Previous image', 'greenstar-theme' ); ?>">&#8249;</button>
                            <button class="gsp-gallery__arrow gsp-gallery__next" aria-label="<?php esc_attr_e( 'Next image', 'greenstar-theme' ); ?>">&#8250;</button>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if ( count( $images ) > 1 ) : ?>
                    <div class="gsp-gallery__thumbs" id="gsp-thumbs" role="list">
                        <?php foreach ( $images as $i => $src ) : ?>
                        <button
                            class="gsp-gallery__thumb <?php echo $i === 0 ? 'active' : ''; ?>"
                            data-index="<?php echo esc_attr( $i ); ?>"
                            data-src="<?php echo esc_url( $src ); ?>"
                            aria-label="<?php printf( esc_attr__( 'View image %d', 'greenstar-theme' ), $i + 1 ); ?>"
                            role="listitem"
                        >
                            <img src="<?php echo esc_url( $src ); ?>" alt="" loading="lazy" />
                        </button>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div><!-- .gsp-gallery -->

                <!-- Info panel column -->
                <div class="gsp-info-panel">

                    <?php if ( $primary_term ) : ?>
                    <a href="<?php echo esc_url( get_term_link( $primary_term ) ); ?>" class="gsp-category-badge">
                        <?php echo esc_html( $primary_term->name ); ?>
                    </a>
                    <?php endif; ?>

                    <h1 class="gsp-product-title"><?php echo esc_html( $product_title ); ?></h1>

                    <div class="gsp-price-block">
                        <span class="gsp-price-label"><?php esc_html_e( 'Price:', 'greenstar-theme' ); ?></span>
                        <span class="gsp-price-value"><?php echo esc_html( $price ); ?></span>
                    </div>

                    <?php if ( $short_specs ) : ?>
                    <ul class="gsp-short-specs">
                        <?php
                        $lines = array_filter( array_map( 'trim', explode( "\n", $short_specs ) ) );
                        foreach ( $lines as $line ) :
                        ?>
                        <li><?php echo esc_html( $line ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <div class="gsp-cta-group">
                        <a href="#gsp-inquiry" class="btn btn-primary gsp-btn-quote">
                            <?php esc_html_e( 'Get a Quote', 'greenstar-theme' ); ?>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline gsp-btn-sample">
                            <?php esc_html_e( 'Request Sample', 'greenstar-theme' ); ?>
                        </a>
                    </div>

                    <?php if ( $certifications ) : ?>
                    <div class="gsp-cert-row">
                        <span class="gsp-cert-label"><?php esc_html_e( 'Certifications:', 'greenstar-theme' ); ?></span>
                        <div class="gsp-cert-chips">
                            <?php
                            $certs = array_filter( array_map( 'trim', explode( ',', $certifications ) ) );
                            foreach ( $certs as $cert ) :
                            ?>
                            <span class="gsp-cert-chip"><?php echo esc_html( $cert ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Share row -->
                    <div class="gsp-share-row">
                        <span class="gsp-share-label"><?php esc_html_e( 'Share:', 'greenstar-theme' ); ?></span>
                        <?php $share_url = urlencode( get_permalink() ); ?>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener noreferrer" class="gsp-share-btn gsp-share-btn--fb" aria-label="Share on Facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo urlencode( $product_title ); ?>" target="_blank" rel="noopener noreferrer" class="gsp-share-btn gsp-share-btn--tw" aria-label="Share on Twitter">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                        </a>
                        <a href="https://pinterest.com/pin/create/button/?url=<?php echo $share_url; ?>" target="_blank" rel="noopener noreferrer" class="gsp-share-btn gsp-share-btn--pt" aria-label="Share on Pinterest">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.08 3.16 9.44 7.63 11.18-.1-.96-.2-2.44.04-3.5.22-.94 1.47-6.27 1.47-6.27s-.38-.75-.38-1.86c0-1.74 1.01-3.05 2.27-3.05 1.07 0 1.59.8 1.59 1.76 0 1.07-.68 2.68-1.03 4.17-.29 1.24.62 2.25 1.84 2.25 2.21 0 3.69-2.84 3.69-6.2 0-2.56-1.73-4.35-4.21-4.35-2.87 0-4.55 2.15-4.55 4.37 0 .87.33 1.79.75 2.3a.3.3 0 0 1 .07.28c-.08.31-.25 1-.28 1.14-.04.17-.15.21-.34.13-1.25-.58-2.03-2.42-2.03-3.89 0-3.16 2.3-6.07 6.63-6.07 3.48 0 6.19 2.48 6.19 5.8 0 3.46-2.18 6.24-5.2 6.24-1.02 0-1.97-.53-2.3-1.15l-.62 2.33c-.23.87-.84 1.96-1.25 2.62.94.29 1.94.45 2.97.45 6.63 0 12-5.37 12-12S18.63 0 12 0z"/></svg>
                        </a>
                    </div>

                </div><!-- .gsp-info-panel -->

            </div><!-- .gsp-hero-grid -->
        </div>
    </section>

    <!-- ── Tabs: Description / Specifications ──────────────────────────── -->
    <section class="gsp-tabs-section">
        <div class="container">
            <div class="gsp-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Product information', 'greenstar-theme' ); ?>">
                <button class="gsp-tab-btn active" role="tab" aria-selected="true" aria-controls="tab-description" id="tab-btn-description">
                    <?php esc_html_e( 'Description', 'greenstar-theme' ); ?>
                </button>
                <button class="gsp-tab-btn" role="tab" aria-selected="false" aria-controls="tab-specs" id="tab-btn-specs">
                    <?php esc_html_e( 'Specifications', 'greenstar-theme' ); ?>
                </button>
            </div>

            <!-- Description tab -->
            <div class="gsp-tab-panel" id="tab-description" role="tabpanel" aria-labelledby="tab-btn-description">
                <?php
                $content = get_the_content( null, false, $product_id );
                if ( $content ) :
                ?>
                <div class="gsp-description-content">
                    <?php echo apply_filters( 'the_content', $content ); ?>
                </div>
                <?php else : ?>
                <div class="gsp-description-content">
                    <h2><?php echo esc_html( $product_title ); ?> | <?php esc_html_e( 'GreenStar Vietnam', 'greenstar-theme' ); ?></h2>
                    <p><?php esc_html_e( 'GreenStar Vietnam specializes in manufacturing and exporting premium rice-based products to global markets. Our products are produced in modern facilities, meeting international standards including HACCP, ISO, FDA, and Halal certifications.', 'greenstar-theme' ); ?></p>
                    <p><?php esc_html_e( 'We offer flexible packaging options to suit your business needs — from standard retail packs to private-label solutions for international distributors.', 'greenstar-theme' ); ?></p>
                </div>
                <?php endif; ?>

                <?php if ( $splash_id ) : ?>
                <div class="gsp-splash-image">
                    <?php echo wp_get_attachment_image( $splash_id, 'full', false, array( 'alt' => esc_attr( $product_title ) ) ); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Specifications tab -->
            <div class="gsp-tab-panel" id="tab-specs" role="tabpanel" aria-labelledby="tab-btn-specs" hidden>
                <?php if ( ! empty( $specs_data ) ) : ?>
                <div class="gsp-spec-table-wrap">
                    <table class="gsp-spec-table">
                        <thead>
                            <tr>
                                <th scope="col"><?php esc_html_e( 'ITEM', 'greenstar-theme' ); ?></th>
                                <th scope="col"><?php esc_html_e( 'SPECIFICATION', 'greenstar-theme' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $specs_data as $label => $value ) : ?>
                            <tr>
                                <td class="spec-item"><?php echo esc_html( $label ); ?></td>
                                <td class="spec-value"><?php echo esc_html( $value ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- ── Manufacturing Process ───────────────────────────────────────── -->
    <section class="gsp-process-section" id="manufacturing-process">
        <div class="container">
            <div class="gsp-section-header text-center">
                <span class="section-label"><?php esc_html_e( 'How We Make It', 'greenstar-theme' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Our Manufacturing Process', 'greenstar-theme' ); ?></h2>
                <p class="section-subtitle"><?php esc_html_e( 'State-of-the-art production facilities ensuring the highest quality standards at every step.', 'greenstar-theme' ); ?></p>
            </div>
            <div class="gsp-process-steps">
                <?php
                $steps = array(
                    array(
                        'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2.5"/><path d="M16 28c0-4.418 3.582-8 8-8s8 3.582 8 8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><circle cx="24" cy="18" r="3" fill="currentColor"/></svg>',
                        'label' => __( 'Raw Material Inspection', 'greenstar-theme' ),
                        'desc'  => __( 'Carefully select premium quality raw materials', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 36V20l12-8 12 8v16" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"/><path d="M20 36v-8h8v8" stroke="currentColor" stroke-width="2.5"/><path d="M24 12V8M18 28a6 6 0 0 1 12 0" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>',
                        'label' => __( 'Thorough Washing', 'greenstar-theme' ),
                        'desc'  => __( 'Ingredients are systematically washed to remove dust and impurities', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="10" y="18" width="28" height="20" rx="3" stroke="currentColor" stroke-width="2.5"/><path d="M16 18V14a8 8 0 0 1 16 0v4" stroke="currentColor" stroke-width="2.5"/><path d="M24 28v-4M20 26h8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>',
                        'label' => __( 'Processing', 'greenstar-theme' ),
                        'desc'  => __( 'Precision processing using modern machinery', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 38V24l10-6 10 6v14" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"/><rect x="20" y="28" width="8" height="10" stroke="currentColor" stroke-width="2.5"/><path d="M10 24h28" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>',
                        'label' => __( 'Drying & Preservation', 'greenstar-theme' ),
                        'desc'  => __( 'Ensures maximum nutrition and extended shelf life', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="10" y="14" width="28" height="20" rx="3" stroke="currentColor" stroke-width="2.5"/><path d="M17 24h14M17 20h8M17 28h10" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M20 34l4 6 4-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'label' => __( 'Quality Control', 'greenstar-theme' ),
                        'desc'  => __( 'Rigorous testing to meet international standards', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="10" y="10" width="28" height="28" rx="4" stroke="currentColor" stroke-width="2.5"/><path d="M16 24l6 6 10-12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'label' => __( 'Inner Packaging', 'greenstar-theme' ),
                        'desc'  => __( 'Sealed for freshness and convenience', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="16" width="32" height="24" rx="3" stroke="currentColor" stroke-width="2.5"/><path d="M8 22h32" stroke="currentColor" stroke-width="2.5"/><path d="M16 16V10h16v6" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"/></svg>',
                        'label' => __( 'Outer Packaging', 'greenstar-theme' ),
                        'desc'  => __( 'Packed into cartons, ready for distribution', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 38L18 14l6 12 6-8 8 20" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'label' => __( 'Export Ready', 'greenstar-theme' ),
                        'desc'  => __( 'Delivered to global markets with full documentation', 'greenstar-theme' ),
                    ),
                );
                ?>
                <div class="gsp-process-track">
                    <?php foreach ( $steps as $i => $step ) : ?>
                    <div class="gsp-process-step">
                        <div class="gsp-process-step__num"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></div>
                        <div class="gsp-process-step__icon"><?php echo $step['icon']; ?></div>
                        <h4 class="gsp-process-step__label"><?php echo esc_html( $step['label'] ); ?></h4>
                        <p class="gsp-process-step__desc"><?php echo esc_html( $step['desc'] ); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Applications ────────────────────────────────────────────────── -->
    <section class="gsp-applications-section">
        <div class="container">
            <div class="gsp-section-header text-center">
                <span class="section-label"><?php esc_html_e( 'Versatile Usage', 'greenstar-theme' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Applications & Industries', 'greenstar-theme' ); ?></h2>
            </div>
            <div class="gsp-applications-grid">
                <?php
                $applications = array(
                    array(
                        'icon' => '🏭',
                        'title'=> __( 'Food Manufacturing', 'greenstar-theme' ),
                        'desc' => __( 'Use as a core ingredient for ready-made noodles, soups, and packaged foods.', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '🛒',
                        'title'=> __( 'Retail & Supermarkets', 'greenstar-theme' ),
                        'desc' => __( 'Offer premium dried rice products under your own private label brand.', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '🍽️',
                        'title'=> __( 'Food Service & Restaurants', 'greenstar-theme' ),
                        'desc' => __( 'Ideal for Asian restaurants, hotels, and catering with consistent quality.', 'greenstar-theme' ),
                    ),
                    array(
                        'icon' => '🌿',
                        'title'=> __( 'Health & Wellness', 'greenstar-theme' ),
                        'desc' => __( 'Gluten-free and natural ingredients for health-conscious consumers.', 'greenstar-theme' ),
                    ),
                );
                foreach ( $applications as $app ) :
                ?>
                <div class="gsp-app-card">
                    <div class="gsp-app-card__icon"><?php echo $app['icon']; ?></div>
                    <h3 class="gsp-app-card__title"><?php echo esc_html( $app['title'] ); ?></h3>
                    <p class="gsp-app-card__desc"><?php echo esc_html( $app['desc'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── Related Products ────────────────────────────────────────────── -->
    <?php
    $related_args = array(
        'post_type'      => 'gs_product',
        'posts_per_page' => 4,
        'post__not_in'   => array( get_the_ID() ),
        'orderby'        => 'rand',
    );
    if ( $primary_term ) {
        $related_args['tax_query'] = array(
            array(
                'taxonomy' => 'gs_category',
                'field'    => 'term_id',
                'terms'    => $primary_term->term_id,
            ),
        );
    }
    $related_query = new WP_Query( $related_args );
    if ( $related_query->have_posts() ) :
    ?>
    <section class="gsp-related-section">
        <div class="container">
            <div class="gsp-section-header text-center">
                <span class="section-label"><?php esc_html_e( 'You May Also Like', 'greenstar-theme' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Related Products', 'greenstar-theme' ); ?></h2>
            </div>
            <div class="gsp-related-grid">
                <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                    <?php get_template_part( 'template-parts/content', 'product-card' ); ?>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata();
    endif;
    ?>

    <!-- ── Inquiry CTA ─────────────────────────────────────────────────── -->
    <section class="gsp-inquiry-section" id="gsp-inquiry">
        <div class="container">
            <div class="gsp-inquiry-grid">

                <div class="gsp-inquiry-info">
                    <span class="section-label"><?php esc_html_e( 'Interested in this product?', 'greenstar-theme' ); ?></span>
                    <h2 class="gsp-inquiry-title"><?php esc_html_e( 'Request a Quote or Sample', 'greenstar-theme' ); ?></h2>
                    <p class="gsp-inquiry-desc"><?php esc_html_e( 'Contact us for pricing, MOQ details, private label options, and bulk order information. Our team responds within 24 hours.', 'greenstar-theme' ); ?></p>
                    <ul class="gsp-inquiry-contacts">
                        <?php $phone = get_theme_mod( 'greenstar_phone', '0933 898 896' ); ?>
                        <?php $email = get_theme_mod( 'greenstar_email', 'ketoangreenstar2023@gmail.com' ); ?>
                        <li>
                            <span class="gsp-inquiry-contact-icon">📞</span>
                            <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $phone) ); ?>"><?php echo esc_html( $phone ); ?></a>
                        </li>
                        <li>
                            <span class="gsp-inquiry-contact-icon">✉</span>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                        </li>
                    </ul>
                </div>

                <div class="gsp-inquiry-form-wrap">
                    <form class="gsp-inquiry-form" id="gsp-inquiry-form" novalidate>
                        <?php wp_nonce_field( 'gsp_inquiry_nonce', 'gsp_nonce' ); ?>
                        <input type="hidden" name="product_name" value="<?php echo esc_attr( $product_title ); ?>">
                        <input type="hidden" name="product_url" value="<?php echo esc_url( get_permalink() ); ?>">

                        <div class="gsp-form-row gsp-form-row--2col">
                            <div class="gsp-form-field">
                                <label for="gsp-name"><?php esc_html_e( 'Your Name *', 'greenstar-theme' ); ?></label>
                                <input type="text" id="gsp-name" name="gsp_name" required placeholder="<?php esc_attr_e( 'Enter your full name', 'greenstar-theme' ); ?>">
                            </div>
                            <div class="gsp-form-field">
                                <label for="gsp-company"><?php esc_html_e( 'Company', 'greenstar-theme' ); ?></label>
                                <input type="text" id="gsp-company" name="gsp_company" placeholder="<?php esc_attr_e( 'Company name (optional)', 'greenstar-theme' ); ?>">
                            </div>
                        </div>

                        <div class="gsp-form-row gsp-form-row--2col">
                            <div class="gsp-form-field">
                                <label for="gsp-email"><?php esc_html_e( 'Email Address *', 'greenstar-theme' ); ?></label>
                                <input type="email" id="gsp-email" name="gsp_email" required placeholder="<?php esc_attr_e( 'your@email.com', 'greenstar-theme' ); ?>">
                            </div>
                            <div class="gsp-form-field">
                                <label for="gsp-phone"><?php esc_html_e( 'Phone / WhatsApp', 'greenstar-theme' ); ?></label>
                                <input type="tel" id="gsp-phone" name="gsp_phone" placeholder="<?php esc_attr_e( '+1 234 567 8900', 'greenstar-theme' ); ?>">
                            </div>
                        </div>

                        <div class="gsp-form-field">
                            <label for="gsp-message"><?php esc_html_e( 'Message *', 'greenstar-theme' ); ?></label>
                            <textarea id="gsp-message" name="gsp_message" rows="4" required placeholder="<?php echo esc_attr( sprintf( __( "I'm interested in %s. Please send pricing and MOQ details.", 'greenstar-theme' ), $product_title ) ); ?>"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary gsp-submit-btn" id="gsp-submit-btn">
                            <span class="gsp-btn-text"><?php esc_html_e( 'Send Inquiry', 'greenstar-theme' ); ?></span>
                            <span class="gsp-btn-spinner" aria-hidden="true"></span>
                        </button>

                        <div class="gsp-form-status" id="gsp-form-status" aria-live="polite"></div>
                    </form>
                </div>

            </div>
        </div>
    </section>

</div><!-- .gsp-detail-wrap -->

<?php
// Pass data to JS
wp_localize_script( 'gsp-single', 'gspData', array(
    'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
    'nonce'    => wp_create_nonce( 'gsp_inquiry_nonce' ),
    'images'   => $images,
    'i18n'     => array(
        'sending' => __( 'Sending…', 'greenstar-theme' ),
        'success' => __( 'Thank you! We will contact you shortly.', 'greenstar-theme' ),
        'error'   => __( 'Something went wrong. Please try again.', 'greenstar-theme' ),
    ),
) );

get_footer();
