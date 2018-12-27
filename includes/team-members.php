<?php
/**
 * Team members functionality.
 *
 * @package Hype
 */

add_action( 'init', 'hype_register_team_members' );
if ( ! function_exists( 'hype_register_team_members' ) ) :
/**
 * Register Team Members Post Type
 */

function hype_register_team_members() {
  $labels = array(
    'name'          => __( 'Team Members', 'hype' ),
    'singular_name' => __( 'team member', 'hype' ),
    'add_new_item'  => __( 'Add New Team Member', 'hype' ),
    'edit_item'     => __( 'Edit Team Member', 'hype' ),
    'new_item'      => __( 'New Team Member', 'hype' ),
    'view_item'     => __( 'View Team Member', 'hype' )
  );

  $supports = array(
    'title',
    'editor',
    'thumbnail',
    'revisions'
  );

  $args = array(
    'label'         => __( 'team members', 'hype' ),
    'labels'        => $labels,
    'description'   => __( 'Here is the team members section', 'hype' ),
    'menu_position' => 22,
    'menu_icon'     => __( 'dashicons-groups', 'hype' ),
    'public'        => true,
    'show_in_menu'  => true,
    'supports'      => $supports
  );

  register_post_type( 'hype-team-member' , $args );
}

endif;
