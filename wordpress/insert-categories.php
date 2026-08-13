<?php
require_once( dirname( __FILE__ ) . '/wp-load.php' );

$categories = [
    'Dried Rice Vermicelli',
    'Dried Pho Noodles',
    'Rice Paper',
    'Glass Noodle',
    'Coffee'
];

// First, delete existing categories to make sure we ONLY have these
$existing = get_terms( [ 'taxonomy' => 'gs_category', 'hide_empty' => false ] );
if ( ! is_wp_error( $existing ) ) {
    foreach ( $existing as $term ) {
        wp_delete_term( $term->term_id, 'gs_category' );
    }
}

// Insert new categories
foreach ( $categories as $cat ) {
    wp_insert_term( $cat, 'gs_category' );
}

echo "Categories updated successfully!";
