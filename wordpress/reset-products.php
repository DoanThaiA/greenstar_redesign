<?php
require 'wp-load.php';
$posts = get_posts(['post_type' => 'gs_product', 'numberposts' => -1]);
foreach ($posts as $p) {
    wp_delete_post($p->ID, true); // force delete
}
echo "Deleted all old products.\n";
require 'setup-data.php';
echo "Ran setup-data.php.\n";
