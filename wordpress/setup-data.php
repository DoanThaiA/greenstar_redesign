<?php
// Load WordPress core
require_once( dirname( __FILE__ ) . '/wp-load.php' );

echo "Starting data setup...\n";

// 1. Create Categories
$categories = [
    'Coffee' => 'coffee',
    'Noodles' => 'noodles',
    'Rice Paper' => 'rice-paper',
];

$term_ids = [];
foreach ($categories as $name => $slug) {
    if (!term_exists($name, 'gs_category')) {
        $result = wp_insert_term($name, 'gs_category', ['slug' => $slug]);
        if (!is_wp_error($result)) {
            $term_ids[$name] = $result['term_id'];
            echo "Created category: $name\n";
        }
    } else {
        $term = get_term_by('name', $name, 'gs_category');
        $term_ids[$name] = $term->term_id;
        echo "Category exists: $name\n";
    }
}

// 2. Products Data
$products = [
    ['title' => 'Freeze-Dried Instant Coffee – 30g Paper Box', 'category' => 'Coffee'],
    ['title' => 'Freeze-Dried Instant Coffee 45g | Premium Vietnamese Coffee', 'category' => 'Coffee'],
    ['title' => 'Aeroco 99 Ground Coffee for Phin Brewing – 250g Box', 'category' => 'Coffee'],
    ['title' => 'Aeroco 85 Ground Coffee for Phin Brewing – 250g Box', 'category' => 'Coffee'],
    ['title' => 'Aeroco 95 Ground Coffee for Phin Brewing – 250g Box', 'category' => 'Coffee'],
    ['title' => 'Drip Bag Coffee – 60g', 'category' => 'Coffee'],
    ['title' => 'A5 Roasted Coffee Beans – 500g', 'category' => 'Coffee'],
    ['title' => 'A7 Roasted Coffee Beans – 500g', 'category' => 'Coffee'],
    ['title' => 'A4 Roasted Coffee Beans – 500g', 'category' => 'Coffee'],
    ['title' => 'A3 Roasted Coffee Beans – 500g', 'category' => 'Coffee'],
    ['title' => 'A2 Roasted Coffee Beans – 500g', 'category' => 'Coffee'],
    ['title' => 'A4 Ground Coffee for Phin Brewing – 250g', 'category' => 'Coffee'],
    ['title' => 'A1 Ground Coffee for Phin Brewing – 250g', 'category' => 'Coffee'],
    ['title' => 'A9 Espresso Roasted Coffee Beans – 500g', 'category' => 'Coffee'],
    ['title' => 'Drip Bag Coffee – 120g', 'category' => 'Coffee'],
    ['title' => 'Blend Ground Coffee for Phin Brewing – 250g', 'category' => 'Coffee'],
    ['title' => 'A8 Ground Coffee – 250g', 'category' => 'Coffee'],
    ['title' => 'Arabica Coffee Tea – 50g Box', 'category' => 'Coffee'],
    ['title' => 'Dried Rice Vermicelli', 'category' => 'Noodles'],
    ['title' => 'Freshly Dried Rice Vermicelli', 'category' => 'Noodles'],
    ['title' => 'Dried Pho Noodles', 'category' => 'Noodles'],
    ['title' => 'Freshly Dried Pho Noodles', 'category' => 'Noodles'],
    ['title' => 'Glass Noodles', 'category' => 'Noodles'],
    ['title' => 'Rice Paper', 'category' => 'Rice Paper'],
];

foreach ($products as $prod) {
    // Check if exists
    $existing = get_page_by_title($prod['title'], OBJECT, 'gs_product');
    if (!$existing) {
        $post_id = wp_insert_post([
            'post_title'   => $prod['title'],
            'post_type'    => 'gs_product',
            'post_status'  => 'publish',
        ]);
        
        if (!is_wp_error($post_id)) {
            // Assign category
            $cat_id = $term_ids[$prod['category']];
            wp_set_object_terms($post_id, [$cat_id], 'gs_category');
            
            // Set price meta
            update_post_meta($post_id, 'price', 'Price: Contact for quotation');
            echo "Created product: " . $prod['title'] . "\n";
        }
    } else {
        echo "Product exists: " . $prod['title'] . "\n";
    }
}

echo "Data setup complete.\n";
?>
