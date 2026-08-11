<?php
/**
 * Template Part: Media Mentions Section
 *
 * @package greenstar-theme
 */

$media_logos = array(
    'TinMoi'  => '📰 TinMới',
    'Zing'    => '⚡ Zing.vn',
    '24h'     => '⏰ 24h',
    'Dantri'  => '📝 Dân Trí',
);
?>

<section class="media-section section-py" style="background-color: var(--color-off-white);" id="media" aria-labelledby="media-title">
    <div class="container">
        
        <div class="text-center" data-reveal>
            <span class="section-label"><?php esc_html_e( 'Media & Press', 'greenstar-theme' ); ?></span>
            <h2 class="section-title" id="media-title">
                <?php esc_html_e( 'Trusted by Leading News Outlets', 'greenstar-theme' ); ?>
            </h2>
        </div>

        <div class="media-grid" style="display:flex; flex-wrap:wrap; justify-content:center; gap:3rem; margin-top:3rem; align-items:center; filter:grayscale(100%); opacity:0.7;" data-reveal data-reveal-delay="200">
            <?php foreach ( $media_logos as $name => $logo ) : ?>
                <div class="media-item" style="font-size:2rem; font-weight:bold; color:var(--color-dark); display:flex; align-items:center; gap:0.5rem; transition:all var(--transition);">
                    <?php echo esc_html( $logo ); ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<style>
.media-item:hover { filter: grayscale(0%); opacity: 1 !important; color: var(--color-primary) !important; cursor: default; }
</style>
