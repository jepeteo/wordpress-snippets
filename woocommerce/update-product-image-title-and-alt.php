<?php

/**
 * Updates the image title and alt attributes with the product title.
 *
 * @param array $image_details The image details.
 * @return array The updated image details.
 */
function update_product_image_title_and_alt($image_details)
{
    global $product;

    // Get the product title
    $product_title = get_the_title($product->get_id());

    // Update the image title and alt attributes with the product title
    $image_details['alt'] = $image_details['title'] = $product_title;

    return $image_details;
}
add_filter('woocommerce_gallery_image_html_attachment_image_params', 'update_product_image_title_and_alt');
