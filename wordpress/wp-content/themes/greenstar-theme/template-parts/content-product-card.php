<?php
/**
 * Template part for displaying a product card
 *
 * @package greenstar-theme
 */

$price = get_post_meta( get_the_ID(), 'price', true );
if ( empty( $price ) ) {
    $price = __( 'Contact for quotation', 'greenstar-theme' );
}
?>

<article class="gs-product-card" id="product-<?php the_ID(); ?>">
    <div class="gs-product-card__img-wrapper">
        <a href="<?php the_permalink(); ?>" class="gs-product-card__img-link" aria-label="<?php echo esc_attr( sprintf( __( 'View details for %s', 'greenstar-theme' ), get_the_title() ) ); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'greenstar-card' ); ?>
            <?php else : ?>
                <!-- No placeholder image needed, blob background is applied via CSS -->
            <?php endif; ?>
        </a>
    </div>
    
    <div class="gs-product-card__body">
        <h3 class="gs-product-card__title">
            <?php
            $raw_title = get_the_title();
            // Remove weights and suffixes like " - 250g", " 45g | Premium" for cleaner card display
            $display_title = preg_replace('/\s*(?:[-–|]\s*)?\d+[gG]\b.*$/u', '', $raw_title);
            ?>
            <a href="<?php the_permalink(); ?>"><?php echo esc_html( trim( $display_title ) ); ?></a>
        </h3>
        <p class="gs-product-card__price"><?php echo esc_html( $price ); ?></p>
    </div>
</article>
