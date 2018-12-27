<?php

/**
 * Create the Team Member meta boxes
 */

add_action('add_meta_boxes', 'zilla_metabox_team_members' );

if ( ! function_exists( 'zilla_metabox_team_members' ) ) :

function zilla_metabox_team_members() {

  add_meta_box( 'zilla-team-member-disclaimer',
    __( 'Disclaimer', 'zilla' ),
    'zilla_team_member_disclaimer_meta_callback',
    'hype-team-member',
    'normal',
    'high'
  );

  $subtitle_fields[] = array(
    'name' => __( 'Employee Title', 'zilla' ),
    'desc' => __( '', 'zilla' ),
    'id'   => '_zilla_subtitle',
    'type' => 'text',
    'std'  => __( '', 'zilla' )
  );

  $subtitle_meta_box = array(
    'id'       => 'zilla-metabox-page-subtitle',
    'title'    => __( 'Employee Info', 'zilla' ),
    'page'     => 'hype-team-member',
    'context'  => 'normal',
    'priority' => 'high',
    'fields'   => $subtitle_fields
  );

  zilla_add_meta_box( $subtitle_meta_box );

  $fields = array();

  $fields[] = array(
    'name' => __( 'Facebook', 'zilla' ),
    'desc' => __( 'Link to Facebook page.', 'zilla' ),
    'id'   => '_zilla_facebook',
    'type' => 'text',
    'std'  => __( '', 'zilla' )
  );

  $fields[] = array(
    'name' => __( 'Twitter', 'zilla' ),
    'desc' => __( 'Link to Twitter page.', 'zilla' ),
    'id'   => '_zilla_twitter',
    'type' => 'text',
    'std'  => __( '', 'zilla' )
  );

  $fields[] = array(
    'name' => __( 'LinkedIn', 'zilla' ),
    'desc' => __( 'Link to LinkedIn profile.', 'zilla' ),
    'id'   => '_zilla_linkedin',
    'type' => 'text',
    'std'  => __( '', 'zilla' )
  );

  $meta_box = array(
    'id'       => 'zilla-metabox-social',
    'title'    => __( 'Social Networks', 'zilla' ),
    'page'     => 'hype-team-member',
    'context'  => 'normal',
    'priority' => 'high',
    'fields'   => $fields
  );
  zilla_add_meta_box( $meta_box );
}

endif;

if ( ! function_exists( 'zilla_team_member_disclaimer_meta_callback' ) ) :

function zilla_team_member_disclaimer_meta_callback() {
  printf( '<h3>%1$s <span class="disclaimer">%2$s</span></h3>',
    __( 'Quick Note: ' , 'zilla' ),
    __( 'When this information is output in the about template the description will be cut to 100 characters', 'zilla' )
  );
}

endif;