<?php
require 'wp-load.php';
$posts = get_posts(['post_type' => 'gs_product', 'numberposts' => -1]);
foreach ($posts as $p) {
    // The previous regex left a corrupted character (probably half of an en-dash).
    // Let's remove any trailing non-word characters and spaces.
    // \W matches any non-word character.
    // Alternatively, just preg_replace('/[^\w\s].*$/', '', $p->post_title) if it's at the end.
    // Let's strip the specific weird byte or just trim.
    
    // Convert encoding to clean up corrupted characters
    $clean_title = mb_convert_encoding($p->post_title, 'UTF-8', 'UTF-8');
    
    // Remove trailing spaces, hyphens, and any weird characters at the end
    $clean_title = rtrim($clean_title);
    $clean_title = preg_replace('/[^a-zA-Z0-9)]+$/u', '', $clean_title); // allow trailing parentheses just in case, but remove everything else
    $clean_title = trim($clean_title);
    
    if ($clean_title !== $p->post_title) {
        wp_update_post(['ID' => $p->ID, 'post_title' => $clean_title]);
        echo "Cleaned: $clean_title\n";
    }
}
echo "Done.";
