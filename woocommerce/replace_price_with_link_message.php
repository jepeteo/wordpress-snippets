<?php/**
/**
 * Replaces the product price with a link message if no price is available.
 *
 * @param string $price The product price.
 * @param object $product The product object.
 * @return string The updated product price or link message.
 */
function replace_price_with_link_message($price, $product)
{
    // Guard: exit early if the product price is not empty or zero
    if ($product->get_price() !== '' && $product->get_price() !== 0) {
        return $price;
    }

    // Return an link message instead of the product price
    return '<span class="message-instead-price"><a href="#link_to_contact_page">Contact Us</a></span>';
}

// Hook the function to the 'woocommerce_get_price_html' filter
add_filter('woocommerce_get_price_html', 'replace_price_with_link_message', 100, 2);