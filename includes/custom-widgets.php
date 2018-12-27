<?php

/**
* Hype Instagram Widget
*
* Pulls in the user's Instagram feed and displays in a custom widget.
*
* @package Hype\Instagram
*
*/

if ( ! function_exists( 'hype_instagram_register' ) ) :
function hype_instagram_register() {
  register_widget( 'Hype_Instagram_Widget' );
}
endif;
add_action( 'widgets_init', 'hype_instagram_register' );

class Hype_Instagram_Widget extends WP_Widget {

  function __construct() {

    $widget_options = array(
      'classname' => 'widget_instagram',
      'description' => __( 'Connect to and share photos from your Instagram account.', 'hype' )
    );

    $control_options = array(
      'width' => 300,
      'height' => 350,
      'id_base' => 'instagram'
    );

    parent::__construct( 'instagram', 'Instagram', $widget_options, $control_options );

  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['instagram_token'] = strip_tags( $new_instance['instagram_token'] );
    $instance['quantity'] = strip_tags( $new_instance['quantity'] );
    return $instance;
  }

  function widget( $args, $instance ) {

    extract( $args );

    $title = apply_filters( 'widget_title', $instance['title'] );
    $instagram_token = $instance['instagram_token'];
    $quantity = $instance['quantity'];

    echo $before_widget;

    echo $before_title . $title . $after_title;

    echo '<ul class="widget-wrap">';

    if ( $instagram_token ) {

      $display_size = 'thumbnail';
      $result = wp_remote_get( "https://api.instagram.com/v1/users/self/media/recent/?access_token={$instagram_token}&count={$quantity}" );

      // Handle 'wp_remote_get' error
      if ( is_wp_error( $result ) ) {

        $error_message = $result->get_error_message();
        printf( '<li>%s</li>', __( "Something went wrong: {$error_message}",  'hype' ) );

      } else {

        $result = json_decode( $result['body'] );

        // Check that the wp_remote_get response contains Instagram data
        if ( array_key_exists( 'data', $result ) ) {

          $photos = $result->data;
          foreach( $photos as $photo ) {
            $img = $photo->images->{$display_size};
            if ( isset( $photo->caption->text ) ) {
              $caption = esc_attr( $photo->caption->text );
            } else {
              $caption = __( 'Instagram photo.', 'hype' );
            }
            $link = esc_url( $photo->link );
            $url  = esc_url( $img->url );
            echo "<li class='image-wrap'><a target='_blank' href='{$link}'><img src='{$url}' alt='{$caption}' /></a></li>";

          }

        // Handle 'no Instagram data' error
        } else {
          printf( '<li>%s</li>', __( "The request did not return any data. Please re-enter your Instagram token and try again.",  'hype' ) );
        }

      }

    // Handle 'no Instagram token' error
    } else {
      printf( '<li>%s</li>', __( "You must first add your Instagram token to the widget settings.",  'hype' ) );
    }

    echo '</ul>'; // END of .widget-wrap

    echo $after_widget;

  }

  function form( $instance ) {

    $defaults = array(
      'title' => 'Instagram',
      'instagram_token' => '',
      'quantity' => 6
    );
    $instance = wp_parse_args( (array) $instance, $defaults );

    ?>

    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'hype' ); ?></label>
      <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'quantity' ); ?>"><?php _e( 'Number of photos:', 'hype' ); ?></label>
      <input id="<?php echo $this->get_field_id( 'quantity' ); ?>" name="<?php echo $this->get_field_name( 'quantity' ); ?>" value="<?php echo $instance['quantity']; ?>" style="width:100%;" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'instagram_token' ); ?>"><?php _e( 'Instagram Access Token (<a href="http://blog.pixelunion.net/instagram" target="_blank">You can generate this here</a>):', 'hype' ); ?></label>
      <input id="<?php echo $this->get_field_id( 'instagram_token' ); ?>" name="<?php echo $this->get_field_name( 'instagram_token' ); ?>" value="<?php echo $instance['instagram_token']; ?>" style="width:100%;" />
    </p>

    <?php

  }

}
