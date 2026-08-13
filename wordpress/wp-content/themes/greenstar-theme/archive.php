<?php
/**
 * Category Archive Template for News
 *
 * Includes the exact same layout as home.php for category archives.
 *
 * @package greenstar-theme
 */

// Since home.php already conditionally handles is_archive(), we can just include it.
require get_template_directory() . '/home.php';
