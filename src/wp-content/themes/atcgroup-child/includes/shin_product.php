<?php
// Change add to cart text on single product page
add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single');
function woocommerce_add_to_cart_button_text_single()
{
  return __('Thêm vào danh sách của tôi', 'woocommerce');
}

function wc_remove_quantity_fields($return, $product)
{
  return true;
}
add_filter('woocommerce_is_sold_individually', 'wc_remove_quantity_fields', 10, 2);

add_filter(
  'woocommerce_short_description',
  'single_product_short_description',
  10,
  1
);
function single_product_short_description($post_excerpt)
{
  global $product;
  if (is_single($product->id))
    $post_excerpt = $product->get_description();

  return $post_excerpt;
}

add_action('woocommerce_single_product_summary', 'related_product', 35);
function related_product()

{
  global $product;
  $categories = get_the_terms($product->id, 'product_cat');
  $args = array(
    'category' => $categories->slug,
    'orderby'  => 'name',
    'limit' => 2,
  );
  $products = wc_get_products($args);
?>
  <section class="related-product">
    <h3>Các dịch vụ liên quan:</h3>
    <div class="product-items">
      <?php foreach ($products as $product) : ?>
        <?php ?>
        <div class="product-item">
          <div class=" small-6 medium-4">
            <div class="image-product">
              <a href="<?php echo get_permalink($product->get_id()); ?>">
                <?php echo $product->get_image(); ?>
              </a>
            </div>
          </div>
          <div class=" small-6 medium-8">
            <div class="content-product">
              <div class="product-title-loop">
                <a href="<?php echo get_permalink($product->get_id()); ?>">
                  <?php echo $product->get_name(); ?>
                </a>
              </div>
              <?php if ($average = $product->get_average_rating()) : ?>
                <?php echo '<div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $average) . '"><span style="width:' . (($average / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __('out of 5', 'woocommerce') . '</span></div>'; ?>
              <?php endif; ?>
              <?php echo $product->get_price_html(); ?>
              <div class="product-short-description">
                <?php echo $product->get_short_description(); ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </section>

<?php


}



function wc_remove_reviews_tab($tabs)
{
  unset($tabs['description']);
  unset($tabs['reviews']);
  return $tabs;
}
add_filter('woocommerce_product_tabs', 'wc_remove_reviews_tab', 98);

function wishlistProduct()
{
  echo do_shortcode('[block id="408"]');
}
add_action('woocommerce_after_single_product', 'wishlistProduct', 20);
