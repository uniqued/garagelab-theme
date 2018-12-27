<?php
/**
 * Shopify shortcode functionality
 *
 * Eventually, some or all of this code could go into an actual plugin
 *
 * @package Hype
 */

if ( ! function_exists( 'zillacommerce_customizer_options' ) ) :
/**
 * Retrieve Customizer Options
 */
function zillacommerce_customizer_options( $context = 'product', $args = '' ) {

  if ( $context === 'cart' ) {
    $options = array(
      'cart_title' => get_theme_mod( 'shopify_cart_title', __( 'Your cart', 'zillacommerce' ) ),
      'cart_button_text' => __( 'Cart', 'zillacommerce' ),
      'cart_total_text' => __( 'Subtotal', 'zillacommerce' ),
      'empty_cart_text' => __( 'Your cart is empty', 'zillacommerce' ),
      'checkout_button_text' => __( 'Checkout', 'zillacommerce' ),
      'discount_notice_text' => __( 'Shipping and discount codes are added at checkout.', 'zillacommerce' ),
      'sticky' => 'true',
      'embed_type' => 'cart',
      'button_background_color' => str_replace( '#', '' , get_theme_mod( 'shopify_button_background', '#56c7d9' )  ),
      'button_text_color' => str_replace( '#', '' , get_theme_mod( 'shopify_button_color', '#ffffff' )  ),
      'accent_color' => str_replace( '#', '' , get_theme_mod( 'shopify_accent_color', '#3d3d3d' )  ),
      'background_color' => str_replace( '#', '' , get_theme_mod( 'shopify_container_background', '#ffffff' )  ),
      'text_color' => str_replace( '#', '' , get_theme_mod( 'shopify_text_color', '#758086' ) )
    );
  } else {
    $options = array(
      'buy_button_text' => get_theme_mod( 'shopify_buy_now_text', __( 'Buy Now', 'zillacommerce' ) ),
      'buy_button_out_of_stock_text' => get_theme_mod( 'shopify_sold_out_text', __( 'Out of Stock', 'zillacommerce' ) ),
      'buy_button_product_unavailable_text' => __( 'Unavailable', 'zillacommerce' ),
      'next_page_button_text' => __( 'Show More', 'zillacommerce' ),
      'discount_notice_text' => __( 'Shipping and discount codes are added at checkout.', 'zillacommerce' ),
      'display_size' => 'compact',
      'has_image' => 'false',
      'product_title_color' => str_replace( '#', '' , get_theme_mod( 'shopify_text_color', '#758086' ) )
    );

    if ( $args['type'] === 'collection' ) {
      $options['collection_handle'] = $args['handle'];
      $options['product_handle']    = '';
      $options['product_name']      = '';
      $options['embed_type']        = 'collection';
      $options['has_image']         = 'true';
      $options['background_color']  = str_replace( '#', '' , get_theme_mod( 'shopify_container_background', '#ffffff' ) );
      $options['product_modal']     = 'true';
      $optiosn['redirect_to']       = 'modal';
    } else {
      $options['collection_handle'] = '';
      $options['product_handle']    = $args['handle'];
      $options['product_name']      = ucwords( str_replace( '-', ' ', $args['handle'] ) );
      $options['embed_type']        = 'product';
      $options['has_image']         = 'false';
      $options['product_modal']     = 'false';
      $options['redirect_to']       = 'cart';
    }
  }

  $options['shop'] = get_theme_mod( 'shopify_shop_url', '' );
  $options['button_background_color'] = str_replace( '#', '' , get_theme_mod( 'shopify_button_background', '#56c7d9' )  );
  $options['button_text_color'] = str_replace( '#', '' , get_theme_mod( 'shopify_button_color', '#ffffff' )  );
  $options['accent_color'] = str_replace( '#', '' , get_theme_mod( 'shopify_accent_color', '#3d3d3d' )  );
  $options['background_color'] = str_replace( '#', '' , get_theme_mod( 'shopify_container_background', '#ffffff' )  );
  $options['text_color'] = str_replace( '#', '' , get_theme_mod( 'shopify_text_color', '#758086' ) );
  return $options;
}
endif;

if ( ! function_exists( 'zillacommerce_options_markup' ) ) :
/**
 * Shopify Options Markup
 */
function zillacommerce_options_markup( $options ) {
  $class      = '';
  $attributes = [];

  foreach ( $options as $key => $value ) {
    $attributes[] = sprintf(
      'data-%s="%s"',
      $key,
      esc_attr( $value )
    );
  }

  if ( $options['embed_type'] === 'product' ) {
    $class = ' class="zillacommerce-product"';
  }

  return sprintf( '<div %s %s></div>', implode( ' ', $attributes ), $class );
}
endif;

if ( ! function_exists( 'zillacommerce_display_product' ) ) :
/**
 * Display Shopify Product or Collection
 */
function zillacommerce_display_product( $atts ) {
  $args = shortcode_atts( array(
    'handle' => '',
    'type' => '',
  ), $atts );

  $options    = zillacommerce_customizer_options( 'product', $args );
  $attributes = [];

  return zillacommerce_options_markup( $options );
}
endif;

if ( ! function_exists( 'zillacommerce_register_shortcodes' ) ) :
/**
 * Register all Shopify Shortcodes
 */
function zillacommerce_register_shortcodes() {
  add_shortcode( 'shopify-product', 'zillacommerce_display_product' );
}
endif;
add_action( 'init', 'zillacommerce_register_shortcodes' );

if ( ! function_exists( 'zillacommerce_show_cart') ) :
/**
 * Output Cart Script
 **/
function zillacommerce_show_cart() {
  $options = zillacommerce_customizer_options( 'cart' );
  ?>

  <aside class="shopify-cart">
    <?php echo zillacommerce_options_markup( $options ); ?>
  </aside>
<?php }
endif;
add_action( 'wp_footer', 'zillacommerce_show_cart', 100 );

if ( ! function_exists( 'zillacommerce_menu' ) ) :
/**
 * Add Shopify settings to the menu
 */
function zillacommerce_menu() {
  global $submenu;

  add_menu_page( __( 'Shopify Settings', 'zillacommerce' ), __( 'Shopify', 'zillacommerce' ), 'manage_options', 'shopify-settings', 'zillacommerce_settings', get_template_directory_uri() . '/zillacommerce/images/shopify_glyph.png', 21 );
  add_submenu_page( 'shopify-settings', __( 'Shopify Settings', 'zillacommerce' ), __( 'Shopify Settings', 'zillacommerce' ), 'manage_options', 'shopify-settings' );
  $permalink = admin_url( 'customize.php?autofocus[control]=shopify_cart_title' );
  $submenu['shopify-settings'][] = array( __( 'Appearance', 'zillacommerce' ), 'manage_options', $permalink );
}
endif;
add_action( 'admin_menu', 'zillacommerce_menu' );

if ( ! function_exists( 'zillacommerce_settings' ) ) :
/**
 * Show Shopify iframe to edit products etc.
 */
function zillacommerce_settings() {
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  } ?>
  <div class="wrap">
    <iframe class="zillacommerce-admin" src="<?php echo esc_url( "https://widgets.shopifyapps.com/embed_admin/settings?ref=pixel-union-support" ); ?>"></iframe>
  </div>
<?php }
endif;

if ( ! function_exists( 'zillacommerce_media_buttons' ) ) :
/**
 * Add Button to add a product on the page editor
 */
function zillacommerce_media_buttons( $editor_id = 'content' ) {
  global $pagenow;

  // Only run on add/edit screens
  if ( in_array( $pagenow, array('post.php', 'page.php', 'post-new.php', 'post-edit.php') ) ) {
    $output = '<a href="https://widgets.shopifyapps.com/embed_admin/embeds/picker?ref=pixel-union-support&TB_iframe=true"
      id="zillacommerce-add-product"
      class="thickbox button"
      title="' . __( 'Add Product', 'zillacommerce' ) . '">' .
      sprintf( '<img src="%s" title="%s" />',
      esc_attr( get_template_directory_uri() . '/zillacommerce/images/shopify_glyph.png' ),
      esc_attr__( 'Shopify Glyph', 'zillacommerce' ) ) .
      __( ' Add Product', 'zillacommerce' ) .
    '</a>';
  }
  echo $output;
}
endif;
add_action( 'media_buttons', 'zillacommerce_media_buttons', 30 );

if ( ! function_exists( 'zillacommerce_update_shop' ) ) :
/**
 * Update the shop url
 */
function zillacommerce_update_shop() {
  $shop = $_POST['shop'];

  set_theme_mod( 'shopify_shop_url', $shop );

  die;
}
endif;
add_action( 'wp_ajax_zillacommerce_update_shop', 'zillacommerce_update_shop' );
