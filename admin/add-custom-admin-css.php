<?php

/**
 * Adds custom CSS to the WordPress admin area.
 *
 * @return void
 */
function add_custom_admin_css()
{
    echo '<style>/* Write your CSS here */</style>';
}
add_action('admin_head', 'add_custom_admin_css');
