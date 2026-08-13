<?php
/**
 * GreenStar Vietnam Theme – Functions & Definitions
 *
 * @package greenstar-theme
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Theme version constant
define( 'GREENSTAR_VERSION', '1.0.0' );
define( 'GREENSTAR_DIR', get_template_directory() );
define( 'GREENSTAR_URI', get_template_directory_uri() );

/* ==========================================================================
   1. Theme Setup
   ========================================================================== */
function greenstar_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'greenstar-theme', GREENSTAR_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );

    // Custom image sizes
    add_image_size( 'greenstar-hero',    1920, 900, true );
    add_image_size( 'greenstar-card',    600,  400, true );
    add_image_size( 'greenstar-thumb',   300,  300, true );
    add_image_size( 'greenstar-gallery', 800,  600, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary'  => __( 'Primary Navigation', 'greenstar-theme' ),
        'footer-1' => __( 'Footer Column 1 – Products', 'greenstar-theme' ),
        'footer-2' => __( 'Footer Column 2 – Company', 'greenstar-theme' ),
    ) );

    // Switch default core markup for various outputs to HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
        'height'               => 96,
        'width'                => 260,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => false,
    ) );

    // Custom header support
    add_theme_support( 'custom-header', array(
        'default-image'      => '',
        'default-text-color' => '2d7a2d',
        'width'              => 1920,
        'height'             => 900,
        'flex-height'        => true,
    ) );

    // Custom background support
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );

    // Responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Gutenberg: wide/full alignment support
    add_theme_support( 'align-wide' );

    // Editor styles
    add_editor_style( 'assets/css/main.css' );
}
add_action( 'after_setup_theme', 'greenstar_setup' );

/* ==========================================================================
   2. Enqueue Scripts & Styles
   ========================================================================== */
function greenstar_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'greenstar-fonts',
        'https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap',
        array(),
        null
    );

    // Main stylesheet (theme definition)
    wp_enqueue_style(
        'greenstar-style',
        get_stylesheet_uri(),
        array(),
        GREENSTAR_VERSION
    );

    // Main CSS
    wp_enqueue_style(
        'greenstar-main',
        GREENSTAR_URI . '/assets/css/main.css',
        array( 'greenstar-fonts' ),
        filemtime( GREENSTAR_DIR . '/assets/css/main.css' )
    );

    // Responsive CSS
    wp_enqueue_style(
        'greenstar-responsive',
        GREENSTAR_URI . '/assets/css/responsive.css',
        array( 'greenstar-main' ),
        GREENSTAR_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'greenstar-main',
        GREENSTAR_URI . '/assets/js/main.js',
        array(),
        GREENSTAR_VERSION,
        true   // load in footer
    );

    // Localize script for AJAX and site URL
    wp_localize_script( 'greenstar-main', 'greenstarData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'greenstar_nonce' ),
        'siteUrl' => get_site_url(),
    ) );

    // Comment reply script (only when needed)
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'greenstar_scripts' );

/* ==========================================================================
   3. Widget Areas
   ========================================================================== */
function greenstar_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'greenstar-theme' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in the blog sidebar.', 'greenstar-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'greenstar-theme' ),
        'id'            => 'footer-widgets',
        'description'   => __( 'Add widgets here to appear in the footer.', 'greenstar-theme' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'greenstar_widgets_init' );

/* ==========================================================================
   4. Custom Walker for Primary Navigation
   ========================================================================== */
class Greenstar_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent  = str_repeat( "\t", $depth );
        $output .= "\n{$indent}<ul class=\"nav-dropdown\">\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id  = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
        $id  = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= "<li{$id}{$class_names}>";

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';
        $atts['class']  = in_array( 'current-menu-item', $classes ) ? 'active' : '';

        $atts  = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
        $attrs = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value  = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attrs .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $has_children = in_array( 'menu-item-has-children', $classes );

        $item_output  = $args->before ?? '';
        $item_output .= "<a{$attrs}>";
        $item_output .= ( $args->link_before ?? '' ) . esc_html( $title ) . ( $args->link_after ?? '' );
        if ( $has_children && $depth === 0 ) {
            $item_output .= ' <span class="caret" aria-hidden="true">▾</span>';
        }
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/* ==========================================================================
   5. Helper Functions
   ========================================================================== */

/**
 * Get the GreenStar custom logo or fallback text logo.
 */
function greenstar_logo() {
    if ( has_custom_logo() ) {
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo" rel="home" aria-label="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
        the_custom_logo();
        echo '</a>';
    } else {
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo" rel="home">';
        echo '<span class="site-logo__text">';
        echo '<span class="site-logo__name">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
        $desc = get_bloginfo( 'description', 'display' );
        if ( $desc ) {
            echo '<span class="site-logo__tagline">' . esc_html( $desc ) . '</span>';
        }
        echo '</span></a>';
    }
}

/**
 * Render the primary navigation menu.
 */
function greenstar_primary_nav() {
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_class'     => 'main-nav',
        'container'      => 'nav',
        'container_id'   => 'site-navigation',
        'container_class'=> 'main-nav',
        'walker'         => new Greenstar_Nav_Walker(),
        'fallback_cb'    => 'greenstar_nav_fallback',
        'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
    ) );
}

/**
 * Fallback navigation when no menu is assigned.
 */
function greenstar_nav_fallback() {
    echo '<nav class="main-nav" id="site-navigation" aria-label="' . esc_attr__( 'Primary Navigation', 'greenstar-theme' ) . '">';
    echo '<ul role="menubar">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'greenstar-theme' ) . '</a></li>';
    
    // Get product categories
    $categories = get_terms( array(
        'taxonomy'   => 'gs_category',
        'hide_empty' => false,
    ) );
    
    if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
        echo '<li class="menu-item-has-children gs-mega-menu-item"><a href="' . esc_url( get_post_type_archive_link( 'gs_product' ) ) . '">' . esc_html__( 'Products', 'greenstar-theme' ) . '</a>';
        echo '<div class="gs-mega-menu-wrapper">';
        
        echo '<div class="gs-mega-menu-cats">';
        foreach ( $categories as $category ) {
            // Get category image if we had a taxonomy meta, else placeholder
            $img_url = esc_url( GREENSTAR_URI . '/assets/images/placeholder.jpg' );
            echo '<a href="' . esc_url( get_term_link( $category ) ) . '" class="gs-mega-cat">';
            echo '<div class="gs-mega-cat-img"><img src="' . $img_url . '" alt="' . esc_attr( $category->name ) . '"></div>';
            echo '<span class="gs-mega-cat-name">' . esc_html( $category->name ) . '</span>';
            echo '</a>';
        }
        echo '</div>'; // .gs-mega-menu-cats
        
        echo '</div></li>'; // .gs-mega-menu-wrapper, li
    } else {
        echo '<li><a href="' . esc_url( get_post_type_archive_link( 'gs_product' ) ) . '">' . esc_html__( 'Products', 'greenstar-theme' ) . '</a></li>';
    }
    
    echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About Us', 'greenstar-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'greenstar-theme' ) . '</a></li>';
    echo '</ul></nav>';
}

/**
 * Output Social links (configurable via Customizer or hardcoded defaults).
 */
function greenstar_social_links( $class = '' ) {
    $socials = array(
        'facebook'  => array( 'url' => get_theme_mod( 'greenstar_facebook', '#' ), 'icon' => 'f', 'label' => 'Facebook' ),
        'instagram' => array( 'url' => get_theme_mod( 'greenstar_instagram', '#' ), 'icon' => 'in', 'label' => 'Instagram' ),
        'linkedin'  => array( 'url' => get_theme_mod( 'greenstar_linkedin',  '#' ), 'icon' => 'li', 'label' => 'LinkedIn' ),
        'youtube'   => array( 'url' => get_theme_mod( 'greenstar_youtube',   '#' ), 'icon' => 'yt', 'label' => 'YouTube' ),
    );
    echo '<div class="social-links ' . esc_attr( $class ) . '">';
    foreach ( $socials as $network => $data ) {
        echo '<a href="' . esc_url( $data['url'] ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $data['label'] ) . '">';
        echo esc_html( $data['icon'] );
        echo '</a>';
    }
    echo '</div>';
}

/* ==========================================================================
   6. Customizer Settings
   ========================================================================== */
function greenstar_customize_register( $wp_customize ) {

    /* GreenStar Panel */
    $wp_customize->add_panel( 'greenstar_panel', array(
        'title'    => __( 'GreenStar Theme Options', 'greenstar-theme' ),
        'priority' => 30,
    ) );

    /* --- Hero Section --- */
    $wp_customize->add_section( 'greenstar_hero', array(
        'title' => __( 'Hero Section', 'greenstar-theme' ),
        'panel' => 'greenstar_panel',
    ) );

    $hero_settings = array(
        'greenstar_hero_badge'    => array( 'default' => __( 'Premium Quality Rice Noodles & Coffee', 'greenstar-theme' ), 'label' => 'Hero Badge Text' ),
        'greenstar_hero_title'    => array( 'default' => __( 'From Vietnam\'s Farms\nTo The World', 'greenstar-theme' ), 'label' => 'Hero Title' ),
        'greenstar_hero_subtitle' => array( 'default' => __( 'GreenStar Vietnam Import-Export JSC is a leading representative in delivering the finest nutritional values of Vietnamese cuisine to global markets.', 'greenstar-theme' ), 'label' => 'Hero Subtitle' ),
        'greenstar_hero_cta1'     => array( 'default' => __( 'View Products', 'greenstar-theme' ), 'label' => 'Hero Primary CTA Label' ),
        'greenstar_hero_cta2'     => array( 'default' => __( 'Contact Us', 'greenstar-theme' ), 'label' => 'Hero Secondary CTA Label' ),
    );

    foreach ( $hero_settings as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'greenstar_hero', 'type' => 'textarea' ) );
    }

    $wp_customize->add_setting( 'greenstar_hero_bg', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'greenstar_hero_bg', array(
        'label'     => __( 'Hero Background Image', 'greenstar-theme' ),
        'section'   => 'greenstar_hero',
        'mime_type' => 'image',
    ) ) );


    /* --- Contact Info --- */
    $wp_customize->add_section( 'greenstar_contact', array(
        'title' => __( 'Contact Info', 'greenstar-theme' ),
        'panel' => 'greenstar_panel',
    ) );

    $contact_settings = array(
        'greenstar_phone'   => array( 'default' => '0933 898 896', 'label' => 'Phone Number' ),
        'greenstar_email'   => array( 'default' => 'ketoangreenstar2023@gmail.com',  'label' => 'Email Address' ),
        'greenstar_address' => array( 'default' => '4th Floor, Viet Tower, No. 1 Thai Ha, Dong Da, Hanoi', 'label' => 'Address' ),
        'greenstar_hours'   => array( 'default' => 'Business Hours: 8:00 AM – 5:00 PM', 'label' => 'Business Hours' ),
    );

    foreach ( $contact_settings as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'greenstar_contact' ) );
    }

    /* --- Social Links --- */
    $wp_customize->add_section( 'greenstar_social', array(
        'title' => __( 'Social Links', 'greenstar-theme' ),
        'panel' => 'greenstar_panel',
    ) );

    foreach ( array( 'facebook', 'instagram', 'linkedin', 'youtube' ) as $network ) {
        $wp_customize->add_setting( "greenstar_{$network}", array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "greenstar_{$network}", array(
            'label'   => ucfirst( $network ) . ' URL',
            'section' => 'greenstar_social',
            'type'    => 'url',
        ) );
    }

    /* --- CTA Section --- */
    $wp_customize->add_section( 'greenstar_cta', array(
        'title' => __( 'CTA Banner Section', 'greenstar-theme' ),
        'panel' => 'greenstar_panel',
    ) );

    $wp_customize->add_setting( 'greenstar_cta_title', array( 'default' => __( 'We Are Now Exporting GreenStar Products Worldwide', 'greenstar-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'greenstar_cta_title', array( 'label' => 'CTA Title', 'section' => 'greenstar_cta' ) );

    $wp_customize->add_setting( 'greenstar_cta_subtitle', array( 'default' => __( 'Partner with us for premium quality, reliable supply and competitive pricing. We support international distributors.', 'greenstar-theme' ), 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'greenstar_cta_subtitle', array( 'label' => 'CTA Subtitle', 'section' => 'greenstar_cta', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'greenstar_cta_btn_label', array( 'default' => __( 'Become Our Distributor', 'greenstar-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'greenstar_cta_btn_label', array( 'label' => 'CTA Button Label', 'section' => 'greenstar_cta' ) );

    $wp_customize->add_setting( 'greenstar_cta_btn_url', array( 'default' => '#contact', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'greenstar_cta_btn_url', array( 'label' => 'CTA Button URL', 'section' => 'greenstar_cta', 'type' => 'url' ) );

    $wp_customize->add_setting( 'greenstar_cta_video_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'greenstar_cta_video_url', array( 'label' => 'Video URL (YouTube embed URL)', 'section' => 'greenstar_cta', 'type' => 'url' ) );
}
add_action( 'customize_register', 'greenstar_customize_register' );

/* ==========================================================================
   7. Custom Post Types
   ========================================================================== */

/**
 * Register 'Product' custom post type.
 */
function greenstar_register_cpts() {
    register_post_type( 'gs_product', array(
        'labels' => array(
            'name'               => __( 'Products', 'greenstar-theme' ),
            'singular_name'      => __( 'Product', 'greenstar-theme' ),
            'add_new'            => __( 'Add New Product', 'greenstar-theme' ),
            'add_new_item'       => __( 'Add New Product', 'greenstar-theme' ),
            'edit_item'          => __( 'Edit Product', 'greenstar-theme' ),
            'new_item'           => __( 'New Product', 'greenstar-theme' ),
            'view_item'          => __( 'View Product', 'greenstar-theme' ),
            'search_items'       => __( 'Search Products', 'greenstar-theme' ),
            'not_found'          => __( 'No products found.', 'greenstar-theme' ),
            'not_found_in_trash' => __( 'No products found in Trash.', 'greenstar-theme' ),
        ),
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-carrot',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'products' ),
        'taxonomies'         => array( 'gs_category' ),
    ) );

    /* Product Category taxonomy */
    register_taxonomy( 'gs_category', 'gs_product', array(
        'labels' => array(
            'name'              => __( 'Product Categories', 'greenstar-theme' ),
            'singular_name'     => __( 'Category', 'greenstar-theme' ),
            'search_items'      => __( 'Search Categories', 'greenstar-theme' ),
            'all_items'         => __( 'All Categories', 'greenstar-theme' ),
            'parent_item'       => __( 'Parent Category', 'greenstar-theme' ),
            'edit_item'         => __( 'Edit Category', 'greenstar-theme' ),
            'update_item'       => __( 'Update Category', 'greenstar-theme' ),
            'add_new_item'      => __( 'Add New Category', 'greenstar-theme' ),
            'new_item_name'     => __( 'New Category Name', 'greenstar-theme' ),
            'menu_name'         => __( 'Categories', 'greenstar-theme' ),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'product-category' ),
    ) );
}
add_action( 'init', 'greenstar_register_cpts' );

/* ==========================================================================
   8. Miscellaneous
   ========================================================================== */

// Excerpt length
add_filter( 'excerpt_length', function() { return 20; }, 999 );
add_filter( 'excerpt_more',   function() { return '…'; } );

// Body classes helper
add_filter( 'body_class', function( $classes ) {
    if ( is_front_page() ) $classes[] = 'home-page';
    if ( is_singular( 'gs_product' ) ) $classes[] = 'single-product';
    return $classes;
} );

/**
 * Handle custom sorting for gs_product archives.
 */
function greenstar_product_sorting( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'gs_product' ) || is_tax( 'gs_category' ) ) ) {
        // Set posts per page to 9 to perfectly fill a 3-column grid
        $query->set( 'posts_per_page', 9 );
        
        $orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : 'menu_order';

        switch ( $orderby ) {
            case 'date':
                $query->set( 'orderby', 'date' );
                $query->set( 'order', 'DESC' );
                break;
            case 'title_asc':
                $query->set( 'orderby', 'title' );
                $query->set( 'order', 'ASC' );
                break;
            case 'title_desc':
                $query->set( 'orderby', 'title' );
                $query->set( 'order', 'DESC' );
                break;
            case 'menu_order':
            default:
                $query->set( 'orderby', 'menu_order title' );
                $query->set( 'order', 'ASC' );
                break;
        }
    }
}
add_action( 'pre_get_posts', 'greenstar_product_sorting' );

/**
 * Append product categories to the Products menu item if it exists.
 */
function greenstar_append_product_categories_to_menu( $items, $args ) {
    // Only apply to primary menu
    if ( $args->theme_location !== 'primary' ) {
        return $items;
    }

    $products_item_id = 0;
    foreach ( $items as $item ) {
        // Simple heuristic: if the title is Products or URL is /products/
        if ( strtolower( $item->title ) === 'products' || strpos( $item->url, '/products' ) !== false ) {
            $products_item_id = $item->ID;
            // Add class for dropdown
            $item->classes[] = 'menu-item-has-children';
            break;
        }
    }

    if ( $products_item_id ) {
        $categories = get_terms( array(
            'taxonomy'   => 'gs_category',
            'hide_empty' => false,
        ) );
        if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
            $order = 1;
            foreach ( $categories as $category ) {
                $new_item = new stdClass();
                $new_item->ID = 100000 + $category->term_id; // Fake ID
                $new_item->db_id = $new_item->ID;
                $new_item->title = $category->name;
                $new_item->url = get_term_link( $category );
                $new_item->menu_order = $order++;
                $new_item->menu_item_parent = $products_item_id;
                $new_item->type = 'custom';
                $new_item->object = 'custom';
                $new_item->object_id = $new_item->ID;
                $new_item->classes = array( 'menu-item', 'menu-item-type-custom', 'menu-item-object-custom' );
                $new_item->target = '';
                $new_item->attr_title = '';
                $new_item->description = '';
                $new_item->xfn = '';
                $new_item->status = 'publish';
                $items[] = $new_item;
            }
        }
    }

    return $items;
}
add_filter( 'wp_nav_menu_objects', 'greenstar_append_product_categories_to_menu', 10, 2 );

/**
 * Fix active menu classes for the Products custom post type archive.
 */
function greenstar_fix_nav_classes( $classes, $item, $args ) {
    if ( is_post_type_archive( 'gs_product' ) || is_tax( 'gs_category' ) || is_singular( 'gs_product' ) ) {
        // If the item URL is the home URL, remove current classes
        if ( trailingslashit( $item->url ) === trailingslashit( home_url( '/' ) ) ) {
            $classes = array_diff( $classes, array( 'current-menu-item', 'current_page_item' ) );
        }
        // Add current class to Products menu item
        if ( strtolower( $item->title ) === 'products' || strpos( $item->url, '/products' ) !== false ) {
            $classes[] = 'current-menu-item';
        }
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'greenstar_fix_nav_classes', 10, 3 );

