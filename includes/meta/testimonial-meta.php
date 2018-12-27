<?php

/**
 * Create the Testimonial meta boxes
 */

add_action('add_meta_boxes', 'zilla_metabox_testimonials');

if ( ! function_exists( 'zilla_metabox_testimonials' ) ) :

function zilla_metabox_testimonials() {

  $fields            = array();
  $portfolio_vals    = array();
  $portfolio_vals[0] = __( 'Choose a Portfolio Post', 'hype' );

  $args = array( 'post_type' => 'portfolio',
    'posts_per_page' => '-1'
  );

  $portfolio_posts = get_posts( $args );

  foreach ( $portfolio_posts as $post ) {
      $portfolio_vals[ $post->ID ] = $post->post_title;
  }

  $fields[] = array(
    'name' => __( 'Author', 'zilla' ),
    'desc' => __( 'Person writing the testimonial.', 'zilla' ),
    'id'   => '_zilla_testimonial_author',
    'type' => 'text',
    'std'  => __( '', 'zilla' )
  );

  $fields[] = array(
    'name' => __( 'Description', 'zilla' ),
    'desc' => __( 'Description for someone writing the testimonial', 'zilla' ),
    'id'   => '_zilla_testimonial_author_company',
    'type' => 'text',
    'std'  => __( '', 'zilla' )
  );

  $fields[] = array(
    'name'    => __( 'Portfolio Project', 'zilla' ),
    'desc'    => __( 'The portfolio project associated to this testimonial (if applicable).', 'zilla' ),
    'id'      => '_zilla_testimonial_portfolio',
    'type'    => 'select',
    'options' =>  $portfolio_vals,
    'std'     => __( '', 'zilla' )
  );

  $meta_box = array(
    'id'       => 'zilla-metabox-testimonial-info',
    'title'    => __( 'Testimonial Info', 'zilla' ),
    'page'     => 'hype-testimonial',
    'context'  => 'normal',
    'priority' => 'high',
    'fields'   => $fields
  );
  zilla_add_meta_box( $meta_box );
}

endif;