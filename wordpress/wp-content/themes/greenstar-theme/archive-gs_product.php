<?php
/**
 * The template for displaying product archives.
 *
 * @package greenstar-theme
 */

get_header();

// Get the current taxonomy term if we are on a category page
$current_term = is_tax( 'gs_category' ) ? get_queried_object() : null;
$page_title = $current_term ? $current_term->name : __( 'GreenStar Products', 'greenstar-theme' );
?>

<div class="gs-archive-wrapper">
    <!-- Breadcrumbs / Top Bar -->
    <div class="gs-archive-topbar">
        <div class="container gs-archive-topbar__inner">
            <nav class="gs-breadcrumbs" aria-label="breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'greenstar-theme' ); ?></a>
                <span class="sep">/</span>
                <?php if ( $current_term ) : ?>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'gs_product' ) ); ?>"><?php esc_html_e( 'Products', 'greenstar-theme' ); ?></a>
                    <span class="sep">/</span>
                    <span class="current"><?php echo esc_html( $current_term->name ); ?></span>
                <?php else : ?>
                    <span class="current"><?php esc_html_e( 'Products', 'greenstar-theme' ); ?></span>
                <?php endif; ?>
            </nav>

            <div class="gs-archive-topbar__actions">
                <button type="button" class="gs-filter-btn" aria-label="<?php esc_attr_e( 'Filter products', 'greenstar-theme' ); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    <?php esc_html_e( 'FILTER', 'greenstar-theme' ); ?>
                </button>
                <form class="gs-sorting-form" method="get">
                    <select name="orderby" class="gs-orderby" aria-label="<?php esc_attr_e( 'Shop order', 'greenstar-theme' ); ?>" onchange="this.form.submit()">
                        <option value="menu_order" <?php selected( get_query_var('orderby'), 'menu_order' ); ?>><?php esc_html_e( 'Default sorting', 'greenstar-theme' ); ?></option>
                        <option value="date" <?php selected( get_query_var('orderby'), 'date' ); ?>><?php esc_html_e( 'Sort by latest', 'greenstar-theme' ); ?></option>
                        <option value="title_asc" <?php selected( get_query_var('orderby'), 'title_asc' ); ?>><?php esc_html_e( 'Sort by title (A-Z)', 'greenstar-theme' ); ?></option>
                        <option value="title_desc" <?php selected( get_query_var('orderby'), 'title_desc' ); ?>><?php esc_html_e( 'Sort by title (Z-A)', 'greenstar-theme' ); ?></option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="gs-archive-layout">
            <!-- Sidebar -->
            <aside class="gs-archive-sidebar">
                <div class="gs-sidebar-inner">
                    <div class="gs-widget gs-widget-search">
                        <form role="search" method="get" class="gs-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input type="hidden" name="post_type" value="gs_product" />
                            <label class="screen-reader-text" for="gs-search-input"><?php esc_html_e( 'Search for:', 'greenstar-theme' ); ?></label>
                            <input type="search" id="gs-search-input" class="gs-search-field" placeholder="<?php echo esc_attr__( 'Search anythings', 'greenstar-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                            <button type="submit" class="gs-search-submit" aria-label="<?php esc_attr_e( 'Search', 'greenstar-theme' ); ?>">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </button>
                        </form>
                    </div>

                    <div class="gs-widget gs-widget-categories">
                        <h3 class="gs-widget-title"><?php esc_html_e( 'Product Categories', 'greenstar-theme' ); ?></h3>
                        <ul class="gs-category-list">
                            <?php
                            $categories = get_terms( array(
                                'taxonomy'   => 'gs_category',
                                'hide_empty' => false,
                                'parent'     => 0,
                            ) );

                            if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                                foreach ( $categories as $category ) {
                                    $is_active = ( $current_term && $current_term->term_id === $category->term_id ) ? 'active' : '';

                                    $subcats = get_terms( array(
                                        'taxonomy'   => 'gs_category',
                                        'hide_empty' => false,
                                        'parent'     => $category->term_id,
                                    ) );
                                    $has_subcats = ! is_wp_error( $subcats ) && ! empty( $subcats );

                                    echo '<li class="cat-item ' . esc_attr( $is_active ) . ( $has_subcats ? ' has-subcats' : '' ) . '">';
                                    echo '<a href="' . esc_url( get_term_link( $category ) ) . '">';
                                    echo '<span>' . esc_html( $category->name ) . '</span>';
                                    if ( $has_subcats ) {
                                        echo '<span class="cat-item__arrow">&rsaquo;</span>';
                                    }
                                    echo '</a>';

                                    if ( $has_subcats ) {
                                        echo '<ul class="cat-item__subflyout">';
                                        foreach ( $subcats as $subcat ) {
                                            echo '<li><a href="' . esc_url( get_term_link( $subcat ) ) . '">' . esc_html( $subcat->name ) . '</a></li>';
                                        }
                                        echo '</ul>';
                                    }

                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="gs-widget-action">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'gs_product' ) ); ?>" class="btn btn-primary gs-explore-btn"><?php esc_html_e( 'Explore All Products', 'greenstar-theme' ); ?></a>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="gs-archive-main" id="primary">
                <?php if ( have_posts() ) : ?>
                    <div class="gs-products-grid">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', 'product-card' );
                        endwhile;
                        ?>
                    </div>

                    <?php
                    the_posts_pagination( array(
                        'prev_text' => '&larr; ' . esc_html__( 'Prev', 'greenstar-theme' ),
                        'next_text' => esc_html__( 'Next', 'greenstar-theme' ) . ' &rarr;',
                        'class'     => 'gs-pagination'
                    ) );
                    ?>
                <?php else : ?>
                    <p class="gs-no-products"><?php esc_html_e( 'No products found.', 'greenstar-theme' ); ?></p>
                <?php endif; ?>
            </main>
        </div>
    </div>
</div>

<?php get_footer(); ?>
