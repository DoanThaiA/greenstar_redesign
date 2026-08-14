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
define( 'GREENSTAR_VERSION', '1.0.1' );
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

    // Single product CSS + JS
    if ( is_singular( 'gs_product' ) ) {
        wp_enqueue_style(
            'gsp-single',
            GREENSTAR_URI . '/assets/css/single-product.css',
            array( 'greenstar-main' ),
            filemtime( GREENSTAR_DIR . '/assets/css/single-product.css' )
        );
        wp_enqueue_script(
            'gsp-single',
            GREENSTAR_URI . '/assets/js/single-product.js',
            array(),
            filemtime( GREENSTAR_DIR . '/assets/js/single-product.js' ),
            true
        );
    }

    // About page CSS (only on pages using the About Page template)
    if ( is_page_template( 'page-about.php' ) ) {
        wp_enqueue_style(
            'greenstar-about',
            GREENSTAR_URI . '/assets/css/about.css',
            array( 'greenstar-main' ),
            filemtime( GREENSTAR_DIR . '/assets/css/about.css' )
        );
    }

    // News/Blog CSS (for home.php and archive.php)
    if ( is_home() || is_archive() || is_category() ) {
        // Only enqueue if it's not a product archive
        if ( ! is_post_type_archive( 'gs_product' ) && ! is_tax( 'gs_category' ) ) {
            wp_enqueue_style(
                'greenstar-news',
                GREENSTAR_URI . '/assets/css/news.css',
                array( 'greenstar-main' ),
                filemtime( GREENSTAR_DIR . '/assets/css/news.css' )
            );
        }
    }

    // Single News/Blog CSS
    if ( is_single() && 'post' === get_post_type() ) {
        wp_enqueue_style(
            'greenstar-single-news',
            GREENSTAR_URI . '/assets/css/single-news.css',
            array( 'greenstar-main' ),
            filemtime( GREENSTAR_DIR . '/assets/css/single-news.css' )
        );
    }

    // Technology Page CSS
    if ( is_page_template( 'page-technology.php' ) ) {
        wp_enqueue_style(
            'greenstar-technology',
            GREENSTAR_URI . '/assets/css/technology.css',
            array( 'greenstar-main' ),
            filemtime( GREENSTAR_DIR . '/assets/css/technology.css' )
        );
    }

    // Contact Page CSS
    if ( is_page_template( 'page-contact.php' ) ) {
        wp_enqueue_style(
            'greenstar-contact',
            GREENSTAR_URI . '/assets/css/contact.css',
            array( 'greenstar-main' ),
            filemtime( GREENSTAR_DIR . '/assets/css/contact.css' )
        );
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
        $custom_logo_markup = get_custom_logo();
        $custom_logo_markup = str_replace( 'custom-logo-link', 'site-logo', $custom_logo_markup );
        echo $custom_logo_markup;
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
            $cat_img = get_term_meta( $category->term_id, 'gs_category_image', true );
            $img_url = $cat_img ? esc_url( $cat_img ) : esc_url( GREENSTAR_URI . '/assets/images/placeholder.jpg' );
            $cat_link = get_term_link( $category );
            if ( is_wp_error( $cat_link ) ) {
                $cat_link = '#';
            }
            echo '<a href="' . esc_url( $cat_link ) . '" class="gs-mega-cat">';
            echo '<div class="gs-mega-cat-img"><img src="' . $img_url . '" alt="' . esc_attr( $category->name ) . '"></div>';
            echo '<span class="gs-mega-cat-name">' . esc_html( $category->name ) . '</span>';
            echo '</a>';
        }
        echo '</div>'; // .gs-mega-menu-cats
        
        echo '</div></li>'; // .gs-mega-menu-wrapper, li
    } else {
        echo '<li><a href="' . esc_url( get_post_type_archive_link( 'gs_product' ) ) . '">' . esc_html__( 'Products', 'greenstar-theme' ) . '</a></li>';
    }
    
    
    $about_active = ( is_page_template( 'page-about.php' ) || is_page( array( 'about', 'about-us', 99 ) ) ) ? ' class="current_page_item"' : '';
    echo '<li' . $about_active . '><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About Us', 'greenstar-theme' ) . '</a></li>';
    
    $news_active = ( is_home() || is_archive() || is_category() ) && ! is_post_type_archive( 'gs_product' ) ? ' class="current_page_item"' : '';
    $news_page_id = get_option( 'page_for_posts' );
    $news_url = $news_page_id ? get_permalink( $news_page_id ) : home_url( '/news/' );
    echo '<li' . $news_active . '><a href="' . esc_url( $news_url ) . '">' . esc_html__( 'News', 'greenstar-theme' ) . '</a></li>';
    
    $tech_active = is_page_template( 'page-technology.php' ) ? ' class="current_page_item"' : '';
    echo '<li' . $tech_active . '><a href="' . esc_url( home_url( '/our-technology/' ) ) . '">' . esc_html__( 'Our Technology', 'greenstar-theme' ) . '</a></li>';
    
    echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'greenstar-theme' ) . '</a></li>';
    echo '</ul></nav>';
}

/**
 * Force add Our Technology to the primary menu if it's a custom menu.
 */
add_filter( 'wp_nav_menu_items', 'greenstar_add_tech_to_menu', 10, 2 );
function greenstar_add_tech_to_menu( $items, $args ) {
    if ( $args->theme_location === 'primary' ) {
        if ( strpos( $items, 'Our Technology' ) === false && strpos( $items, 'our-technology' ) === false && strpos( $items, 'nha-may' ) === false ) {
            $tech_active = is_page_template( 'page-technology.php' ) ? ' current-menu-item current_page_item' : '';
            // Insert it before the Contact link or just at the end if Contact is not found
            $tech_link = '<li class="menu-item' . $tech_active . '"><a href="' . esc_url( home_url( '/nha-may/' ) ) . '">' . esc_html__( 'Our Technology', 'greenstar-theme' ) . '</a></li>';
            
            // Try to insert before Contact link
            if ( strpos( $items, 'Contact' ) !== false ) {
                $items = preg_replace( '/(<li[^>]*><a[^>]*>Contact<\/a><\/li>)/i', $tech_link . '$1', $items );
            } else {
                $items .= $tech_link;
            }
        }
    }
    return $items;
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

/**
 * Automatically insert the 5 required product categories and delete any others.
 */
function greenstar_insert_required_categories() {
    if ( ! get_option( 'gs_custom_categories_inserted_v3' ) ) {
        $cats = array(
            'Dried Rice Vermicelli',
            'Dried Pho Noodles',
            'Rice Paper',
            'Glass Noodle',
            'Coffee'
        );
        
        // Insert required ones
        foreach ( $cats as $cat ) {
            if ( ! term_exists( $cat, 'gs_category' ) ) {
                wp_insert_term( $cat, 'gs_category' );
            }
        }
        
        // Delete any others
        $all_terms = get_terms( array( 'taxonomy' => 'gs_category', 'hide_empty' => false ) );
        if ( ! is_wp_error( $all_terms ) ) {
            foreach ( $all_terms as $term ) {
                $term_name = htmlspecialchars_decode( $term->name );
                if ( ! in_array( $term_name, $cats, true ) ) {
                    wp_delete_term( $term->term_id, 'gs_category' );
                }
            }
        }
        
        update_option( 'gs_custom_categories_inserted_v3', true );
    }
}
add_action( 'init', 'greenstar_insert_required_categories' );

/* ==========================================================================
   8. Product Meta Boxes
   ========================================================================== */

/**
 * Register meta boxes for gs_product.
 */
function gsp_register_meta_boxes() {
    add_meta_box(
        'gsp-product-fields',
        __( 'Product Details', 'greenstar-theme' ),
        'gsp_render_product_meta_box',
        'gs_product',
        'normal',
        'high'
    );
    add_meta_box(
        'gsp-product-gallery',
        __( 'Product Gallery (additional images)', 'greenstar-theme' ),
        'gsp_render_gallery_meta_box',
        'gs_product',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'gsp_register_meta_boxes' );

/**
 * Render the main product fields meta box.
 */
function gsp_render_product_meta_box( $post ) {
    wp_nonce_field( 'gsp_save_product_meta', 'gsp_product_nonce' );

    $fields = array(
        'gs_price'         => array( 'label' => 'Price',          'type' => 'text',     'placeholder' => 'Contact for quotation' ),
        'gs_origin'        => array( 'label' => 'Origin',         'type' => 'text',     'placeholder' => 'Vietnam (Hanoi)' ),
        'gs_manufacturer'  => array( 'label' => 'Manufacturer',   'type' => 'text',     'placeholder' => 'Truong Phuc Vina' ),
        'gs_net_weight'    => array( 'label' => 'Net Weight',      'type' => 'text',     'placeholder' => '400g' ),
        'gs_packaging'     => array( 'label' => 'Packaging',       'type' => 'text',     'placeholder' => 'Bagged' ),
        'gs_certifications'=> array( 'label' => 'Certifications',  'type' => 'text',     'placeholder' => 'HACCP, ISO, FDA, Halal' ),
        'gs_shelf_life'    => array( 'label' => 'Shelf Life',      'type' => 'text',     'placeholder' => '24 months' ),
        'gs_ingredients'   => array( 'label' => 'Ingredients',     'type' => 'text',     'placeholder' => 'Rice' ),
        'gs_color'         => array( 'label' => 'Color',           'type' => 'text',     'placeholder' => 'White' ),
        'gs_strand_size'   => array( 'label' => 'Strand Size',     'type' => 'text',     'placeholder' => '1.2mm' ),
        'gs_style'         => array( 'label' => 'Style',           'type' => 'text',     'placeholder' => 'Noodle strands' ),
        'gs_labeling'      => array( 'label' => 'Labeling',        'type' => 'text',     'placeholder' => 'Private label available' ),
        'gs_specification' => array( 'label' => 'Specification',   'type' => 'text',     'placeholder' => '400g/pack, 40 packs/carton' ),
        'gs_short_specs'   => array( 'label' => 'Short Specs (one bullet per line, shown above CTA)', 'type' => 'textarea', 'placeholder' => "Raw material: Rice\nType: Rice vermicelli, 1mm strand\nNet weight: 400g per pack" ),
        'gs_splash_image'  => array( 'label' => 'Splash / Editorial Image URL (optional)', 'type' => 'text', 'placeholder' => 'https://…' ),
    );

    echo '<table class="form-table">';
    foreach ( $fields as $key => $f ) {
        $val = get_post_meta( $post->ID, $key, true );
        echo '<tr>';
        echo '<th scope="row"><label for="' . esc_attr( $key ) . '">' . esc_html( $f['label'] ) . '</label></th>';
        echo '<td>';
        if ( $f['type'] === 'textarea' ) {
            echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="4" style="width:100%;">' . esc_textarea( $val ) . '</textarea>';
        } else {
            echo '<input type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" placeholder="' . esc_attr( $f['placeholder'] ) . '" style="width:100%;">';
        }
        echo '</td></tr>';
    }
    echo '</table>';
}

/**
 * Render gallery meta box.
 */
function gsp_render_gallery_meta_box( $post ) {
    wp_enqueue_media();
    $gallery_ids = get_post_meta( $post->ID, 'gs_gallery', true );
    $ids_arr     = $gallery_ids ? json_decode( $gallery_ids, true ) : array();
    ?>
    <div id="gsp-gallery-wrap">
        <div id="gsp-gallery-preview" style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:8px;">
            <?php foreach ( $ids_arr as $id ) : ?>
                <div class="gsp-gal-item" style="position:relative;">
                    <?php echo wp_get_attachment_image( $id, array( 60, 60 ) ); ?>
                    <button type="button" class="gsp-gal-remove" data-id="<?php echo esc_attr( $id ); ?>" style="position:absolute;top:0;right:0;background:red;color:#fff;border:none;cursor:pointer;font-size:10px;padding:1px 4px;">✕</button>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="hidden" id="gs_gallery" name="gs_gallery" value="<?php echo esc_attr( $gallery_ids ); ?>">
        <button type="button" class="button" id="gsp-add-gallery-images"><?php _e( 'Add Gallery Images', 'greenstar-theme' ); ?></button>
    </div>
    <script>
    jQuery(function($){
        var frame;
        var ids = <?php echo json_encode( $ids_arr ); ?>;

        function renderPreviews() {
            var html = '';
            ids.forEach(function(id){
                html += '<div class="gsp-gal-item" style="position:relative;"><img src="" style="width:60px;height:60px;object-fit:cover;"><button type="button" class="gsp-gal-remove" data-id="'+id+'" style="position:absolute;top:0;right:0;background:red;color:#fff;border:none;cursor:pointer;font-size:10px;padding:1px 4px;">✕</button></div>';
            });
            // simple: just update hidden field, previews already set on load
            $('#gs_gallery').val(JSON.stringify(ids));
        }

        $('#gsp-add-gallery-images').on('click', function(e){
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({ title: 'Select Gallery Images', button: { text: 'Add to Gallery' }, multiple: true });
            frame.on('select', function(){
                var selection = frame.state().get('selection');
                selection.each(function(att){
                    if (ids.indexOf(att.id) === -1) {
                        ids.push(att.id);
                        var preview = '<div class="gsp-gal-item" style="position:relative;"><img src="'+att.attributes.sizes.thumbnail.url+'" style="width:60px;height:60px;object-fit:cover;"><button type="button" class="gsp-gal-remove" data-id="'+att.id+'" style="position:absolute;top:0;right:0;background:red;color:#fff;border:none;cursor:pointer;font-size:10px;padding:1px 4px;">✕</button></div>';
                        $('#gsp-gallery-preview').append(preview);
                    }
                });
                $('#gs_gallery').val(JSON.stringify(ids));
            });
            frame.open();
        });

        $(document).on('click', '.gsp-gal-remove', function(){
            var rmId = parseInt($(this).data('id'), 10);
            ids = ids.filter(function(i){ return i !== rmId; });
            $(this).closest('.gsp-gal-item').remove();
            $('#gs_gallery').val(JSON.stringify(ids));
        });
    });
    </script>
    <?php
}

/**
 * Save product meta fields.
 */
function gsp_save_product_meta( $post_id ) {
    if ( ! isset( $_POST['gsp_product_nonce'] ) || ! wp_verify_nonce( $_POST['gsp_product_nonce'], 'gsp_save_product_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array(
        'gs_price', 'gs_origin', 'gs_manufacturer', 'gs_net_weight',
        'gs_packaging', 'gs_certifications', 'gs_shelf_life', 'gs_ingredients',
        'gs_color', 'gs_strand_size', 'gs_style', 'gs_labeling',
        'gs_specification', 'gs_splash_image',
    );
    foreach ( $text_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
    // Textarea fields
    if ( isset( $_POST['gs_short_specs'] ) ) {
        update_post_meta( $post_id, 'gs_short_specs', sanitize_textarea_field( $_POST['gs_short_specs'] ) );
    }
    // Gallery (JSON array of IDs)
    if ( isset( $_POST['gs_gallery'] ) ) {
        $gallery_raw = stripslashes( $_POST['gs_gallery'] );
        $gallery_arr = json_decode( $gallery_raw, true );
        if ( is_array( $gallery_arr ) ) {
            $gallery_arr = array_map( 'absint', $gallery_arr );
            update_post_meta( $post_id, 'gs_gallery', json_encode( $gallery_arr ) );
        }
    }
}
add_action( 'save_post_gs_product', 'gsp_save_product_meta' );

/**
 * AJAX handler for product inquiry form.
 */
function gsp_handle_inquiry() {
    check_ajax_referer( 'gsp_inquiry_nonce', 'gsp_nonce' );

    $name         = sanitize_text_field( $_POST['gsp_name']    ?? '' );
    $company      = sanitize_text_field( $_POST['gsp_company'] ?? '' );
    $email        = sanitize_email(      $_POST['gsp_email']   ?? '' );
    $phone        = sanitize_text_field( $_POST['gsp_phone']   ?? '' );
    $message      = sanitize_textarea_field( $_POST['gsp_message'] ?? '' );
    $product_name = sanitize_text_field( $_POST['product_name'] ?? '' );
    $product_url  = esc_url_raw( $_POST['product_url'] ?? '' );

    if ( ! $name || ! $email || ! $message ) {
        wp_send_json_error( __( 'Please fill in all required fields.', 'greenstar-theme' ) );
    }

    $to      = get_theme_mod( 'greenstar_email', get_option( 'admin_email' ) );
    $subject = sprintf( '[GreenStar Inquiry] %s – from %s', $product_name, $name );
    $body    = "Product: {$product_name}\nURL: {$product_url}\n\n";
    $body   .= "Name: {$name}\nCompany: {$company}\nEmail: {$email}\nPhone: {$phone}\n\nMessage:\n{$message}";
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    );

    $sent = wp_mail( $to, $subject, $body, $headers );
    if ( $sent ) {
        wp_send_json_success();
    } else {
        wp_send_json_error( __( 'Could not send email. Please contact us directly.', 'greenstar-theme' ) );
    }
}
add_action( 'wp_ajax_gsp_inquiry',        'gsp_handle_inquiry' );
add_action( 'wp_ajax_nopriv_gsp_inquiry', 'gsp_handle_inquiry' );

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


/* ==========================================================================
   9. Category Image Uploader in Admin
   ========================================================================== */

// 1. Enqueue media script on taxonomy pages
function greenstar_category_image_enqueue( $hook_suffix ) {
    if ( in_array( $hook_suffix, array( 'edit-tags.php', 'term.php' ) ) ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'greenstar_category_image_enqueue' );

// 2. Add field to "Add New Category" form
function greenstar_add_category_image_field() {
    ?>
    <div class="form-field term-group">
        <label for="gs_category_image"><?php _e( 'Category Image', 'greenstar-theme' ); ?></label>
        <input type="hidden" id="gs_category_image" name="gs_category_image" value="">
        <div id="category-image-wrapper"></div>
        <p>
            <input type="button" class="button button-secondary gs_tax_media_button" id="gs_tax_media_button" name="gs_tax_media_button" value="<?php _e( 'Add Image', 'greenstar-theme' ); ?>" />
            <input type="button" class="button button-secondary gs_tax_media_remove" id="gs_tax_media_remove" name="gs_tax_media_remove" value="<?php _e( 'Remove Image', 'greenstar-theme' ); ?>" style="display:none;" />
        </p>
    </div>
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#gs_tax_media_button').on('click', function(e) {
            e.preventDefault();
            if ( frame ) { frame.open(); return; }
            frame = wp.media({ title: 'Select or Upload Category Image', button: { text: 'Use this image' }, multiple: false });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#gs_category_image').val(attachment.url);
                $('#category-image-wrapper').html('<img src="'+attachment.url+'" style="max-width:100%; height:auto;" />');
                $('#gs_tax_media_remove').show();
            });
            frame.open();
        });
        $('#gs_tax_media_remove').on('click', function(e){
            e.preventDefault();
            $('#gs_category_image').val('');
            $('#category-image-wrapper').html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}
add_action( 'gs_category_add_form_fields', 'greenstar_add_category_image_field', 10, 2 );

// 3. Add field to "Edit Category" form
function greenstar_edit_category_image_field( $term, $taxonomy ) {
    $image_url = get_term_meta( $term->term_id, 'gs_category_image', true );
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="gs_category_image"><?php _e( 'Category Image', 'greenstar-theme' ); ?></label></th>
        <td>
            <input type="hidden" id="gs_category_image" name="gs_category_image" value="<?php echo esc_attr( $image_url ); ?>">
            <div id="category-image-wrapper">
                <?php if ( $image_url ) : ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" style="max-width: 150px; height: auto;" />
                <?php endif; ?>
            </div>
            <p>
                <input type="button" class="button button-secondary gs_tax_media_button" id="gs_tax_media_button" name="gs_tax_media_button" value="<?php _e( 'Upload/Edit Image', 'greenstar-theme' ); ?>" />
                <input type="button" class="button button-secondary gs_tax_media_remove" id="gs_tax_media_remove" name="gs_tax_media_remove" value="<?php _e( 'Remove Image', 'greenstar-theme' ); ?>" <?php echo $image_url ? '' : 'style="display:none;"'; ?> />
            </p>
        </td>
    </tr>
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#gs_tax_media_button').on('click', function(e) {
            e.preventDefault();
            if ( frame ) { frame.open(); return; }
            frame = wp.media({ title: 'Select or Upload Category Image', button: { text: 'Use this image' }, multiple: false });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#gs_category_image').val(attachment.url);
                $('#category-image-wrapper').html('<img src="'+attachment.url+'" style="max-width:150px; height:auto;" />');
                $('#gs_tax_media_remove').show();
            });
            frame.open();
        });
        $('#gs_tax_media_remove').on('click', function(e){
            e.preventDefault();
            $('#gs_category_image').val('');
            $('#category-image-wrapper').html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}
add_action( 'gs_category_edit_form_fields', 'greenstar_edit_category_image_field', 10, 2 );

// 4. Save the image
function greenstar_save_category_image( $term_id, $tt_id ) {
    if ( isset( $_POST['gs_category_image'] ) ) {
        update_term_meta( $term_id, 'gs_category_image', sanitize_url( $_POST['gs_category_image'] ) );
    }
}
add_action( 'created_gs_category', 'greenstar_save_category_image', 10, 2 );
add_action( 'edited_gs_category', 'greenstar_save_category_image', 10, 2 );

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

