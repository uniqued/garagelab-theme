<?php
/**
* Hype Testimonials
*
* @package Hype
*/

add_action( 'init', 'hype_register_testimonials');
if ( ! function_exists( 'hype_register_testimonials' ) ) :
/**
 * Register Testimonial Post Type
 */

function hype_register_testimonials() {
  $labels = array(
    'name'          => __( 'Testimonials', 'hype' ),
    'singular_name' => __( 'testimonial', 'hype' ),
    'add_new_item'  => __( 'Add New Testimonial', 'hype' ),
    'edit_item'     => __( 'Edit Testimonial', 'hype' ),
    'new_item'      => __( 'New Testimonial', 'hype' ),
    'view_item'     => __( 'View Testimonial', 'hype' )
  );

  $supports = array(
    'editor',
    'thumbnail',
    'revisions',
    'title'
  );

  $args = array(
    'label'         => __( 'testimonials', 'hype' ),
    'labels'        => $labels,
    'description'   => __( 'Here is the testimonials section', 'hype' ),
    'menu_position' => 23,
    'menu_icon'     => __( 'dashicons-format-quote', 'hype' ),
    'public'        => true,
    'show_in_menu'  => true,
    'supports'      => $supports
  );

  register_post_type( 'hype-testimonial' , $args );
}

endif;
