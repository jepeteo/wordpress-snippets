<?php

/**
 *  Add description to menu items by extending Walker_Nav_Menu 
 *  It works for elementor menu widget
 *  Tested with Elementor 3.18.0 - WordPress 6.4.2 - PHP 8.1.27 - Theme: Hello Elementor 3.0.1 
 */

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{
    /**
     * Start element output.
     *
     * @param string $output    The menu output.
     * @param object $item      The current menu item.
     * @param int    $depth     Depth of the current menu item.
     * @param array  $args      An array of menu arguments.
     * @param int    $id        Current menu item ID.
     */

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $output .= '<li id="menu-item-' . $item->ID . '" class="' . esc_attr(implode(' ', $item->classes)) . ' menu-item-' . $item->ID . '">';

        $attributes = '';
        !empty($item->attr_title) && $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        !empty($item->target) && $attributes .= ' target="' . esc_attr($item->target) . '"';
        !empty($item->xfn) && $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        !empty($item->url) && $attributes .= ' href="' . esc_url($item->url) . '"';

        // Add a custom class to the <a> tag
        $attributes .= ' class="elementor-item"';

        // Include menu description directly within the <a> tag
        $item_output = sprintf(
            '%1$s<a%2$s><span>%3$s%4$s%5$s</span><span class="menu-description">%6$s</span></a>%7$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters('the_title', $item->title, $item->ID),
            $args->link_after,
            !empty($item->description) ? esc_html($item->description) : '', // Check if description is available
            $args->after
        );

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
    }
}

/**
 * Replace the default Walker in the menu.
 *
 * @param array $args An array of menu arguments.
 *
 * @return array Modified array of menu arguments.
 */
function replace_walker($args)
{
    return array_merge($args, array(
        'walker' => new Custom_Walker_Nav_Menu(),
    ));
}
add_filter('wp_nav_menu_args', 'replace_walker');
