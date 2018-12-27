<?php
/**
 * Shop Content.
 *
 * @package Hype
 */

?>

<?php zilla_post_before(); ?>

<article <?php post_class(); ?>>
  <?php zilla_post_start(); ?>

  <?php
  if ( has_post_thumbnail() ) :
    ?>
    <div class="inner-width-800">
      <div class="featured-image">
        <?php hype_post_thumbnail( get_the_ID(), 'full' ); ?>
      </div>
    </div>

    <?php
  endif;
  ?>
  <div class="inner-width">

    <?php

    hype_print_post_format_media( get_the_ID() );

    the_content();

    // Shopify Collection & Cart
    //shopify_dev
    $shop_url = get_theme_mod( 'shopify_shop_url' );
    $resource_type = get_post_meta( get_the_ID(), '_zilla_shopify_resource_type', true );
    $collection_handle = get_post_meta( get_the_ID(), '_zilla_shopify_collection', true );
    $product_handle = get_post_meta( get_the_ID(), '_zilla_shopify_product', true );

    $cart_title = get_theme_mod( 'shopify_cart_title' );
    $cart_button_text = get_theme_mod( 'shopify_cart_button_text' );
    $buy_now_text = get_theme_mod( 'shopify_buy_now_text' );
    $sold_out_text = get_theme_mod( 'shopify_sold_out_text' );

    $shopify_button_background = str_replace( '#', '' , get_theme_mod( 'shopify_button_background', '#56c7d9' )  );
    $shopify_button_color = str_replace( '#', '' , get_theme_mod( 'shopify_button_color', '#ffffff' )  );
    $shopify_accent_color = str_replace( '#', '' , get_theme_mod( 'shopify_accent_color', '#3d3d3d' )  );
    $shopify_container_background = str_replace( '#', '' , get_theme_mod( 'shopify_container_background', '#ffffff' )  );
    $shopify_text_color = str_replace( '#', '' , get_theme_mod( 'shopify_text_color', '#1d1d1d' )  );
    ?>

    <section class="shopify-collection">
      <?php if ( 'collection' === $resource_type ) : ?>
        <div data-accent_color="<?php esc_attr_e( $shopify_accent_color ); ?>" data-background_color="<?php esc_attr_e( $shopify_container_background ); ?>" data-button_background_color="<?php esc_attr_e( $shopify_button_background ); ?>" data-button_text_color="<?php esc_attr_e( $shopify_button_color ); ?>" data-cart_button_text="<?php esc_attr_e( $cart_button_text ); ?>" data-cart_title="<?php esc_attr_e( $cart_title ); ?>" data-cart_total_text="Total" data-checkout_button_text="Checkout" data-discount_notice_text="Shipping and discount codes are added at checkout." data-embed_type="cart" data-empty_cart_text="Your cart is empty." data-shop="<?php esc_attr_e( $shop_url ); ?>" data-sticky="true" data-text_color="<?php esc_attr_e( $shopify_text_color ); ?>"></div>
        <div data-background_color="<?php esc_attr_e( $shopify_container_background ); ?>" data-button_background_color="<?php esc_attr_e( $shopify_button_background ); ?>" data-button_text_color="<?php esc_attr_e( $shopify_button_color ); ?>" data-buy_button_out_of_stock_text="<?php esc_attr_e( $sold_out_text ); ?>" data-buy_button_product_unavailable_text="Unavailable" data-buy_button_text="<?php esc_attr_e( $buy_now_text ); ?>" data-collection_handle="<?php esc_attr_e( $collection_handle ); ?>" data-display_size="compact" data-embed_type="collection" data-has_image="true" data-next_page_button_text="Next page" data-product_handle="" data-product_modal="true" data-product_name="" data-product_title_color="<?php esc_attr_e( $shopify_text_color ); ?>" data-redirect_to="modal" data-shop="<?php esc_attr_e( $shop_url ); ?>"></div>
      <?php else: ?>
        <div data-embed_type="product" data-shop="<?php esc_attr_e( $shop_url ); ?>" data-product_name="<?php esc_attr_e( $product_handle ); ?>" data-product_handle="<?php esc_attr_e( $product_handle ); ?>" data-has_image="true" data-display_size="compact" data-redirect_to="modal" data-buy_button_text="<?php esc_attr_e( $buy_now_text ); ?>" data-buy_button_out_of_stock_text="<?php esc_attr_e( $sold_out_text ); ?>" data-buy_button_product_unavailable_text="Unavailable" data-button_background_color="<?php esc_attr_e( $shopify_container_background ); ?>" data-button_text_color="ffffff" data-background_color="ffffff" data-product_modal="true" data-product_title_color="<?php esc_attr_e( $shopify_text_color ); ?>" data-next_page_button_text="Next page"></div>
      <?php endif; ?>
    </section>

    <aside class="shopify-cart">
      <div data-checkout_button_text="Checkout" data-cart_button_text="Cart" data-button_text_color="<?php esc_attr_e( $shopify_button_color ); ?>" data-button_background_color="<?php esc_attr_e( $shopify_button_background ); ?>" data-background_color="<?php esc_attr_e( $shopify_container_background ); ?>" data-text_color="<?php esc_attr_e( $shopify_text_color ); ?>" data-accent_color="<?php esc_attr_e( $shopify_accent_color ); ?>" data-cart_title="<?php esc_attr_e( $cart_title ); ?>" data-discount_notice_text="Shipping and discount codes are added at checkout." data-cart_total_text="Total" data-sticky="true" data-empty_cart_text="Your cart is empty." data-embed_type="cart" data-shop="<?php esc_attr_e( $shop_url ); ?>"></div>
    </aside>
  </div>
</article>
