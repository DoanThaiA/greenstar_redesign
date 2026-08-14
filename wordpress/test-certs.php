<?php
require_once('wp-load.php');
$certs = new WP_Query([
    'post_type' => 'gs_certification',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);
echo "Count: " . $certs->post_count . "\n";
foreach($certs->posts as $p) {
    echo $p->ID . " - " . $p->post_title . "\n";
}
