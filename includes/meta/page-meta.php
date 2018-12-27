<?php
/**
 * Create the Page meta boxes
 */


add_action( 'add_meta_boxes', 'zilla_metabox_pages' );

if ( ! function_exists( 'zilla_metabox_pages' ) ) :

function zilla_metabox_pages() {
  global $post;

  $template_file = '';

  if ( ! empty( $_GET['post'] ) || ! empty( $_POST['post_ID'] ) ) {
    $template_file = get_post_meta( $post->ID, '_wp_page_template', TRUE );
  }

  $header_fields   = array();
  $subtitle_fields = array();
  $shop_fields = array();
  $page_fields     = array();
  $contact_fields  = array();
  $about_fields    = array();

  $amounts = array(
    '1'  => 'one',
    '2'  => 'two',
    '3'  => 'three',
    '4'  => 'four',
    '5'  => 'five',
    '6'  => 'six',
    '7'  => 'seven',
    '8'  => 'eight',
    '9'  => 'nine',
    '10' => 'ten'
  );

  $subtitle_fields[] = array(
    'name' => __( 'Subtitle', 'zilla' ),
    'desc' => __( 'Add a subtitle for the page.', 'zilla' ),
    'id'   => '_zilla_subtitle',
    'type' => 'text',
    'std'  => ''
  );

  $subtitle_meta_box = array(
    'id'       => 'zilla-metabox-page-subtitle',
    'title'    => __( 'Subtitle', 'zilla' ),
    'page'     => 'page',
    'context'  => 'normal',
    'priority' => 'high',
    'fields'   => $subtitle_fields
  );

  zilla_add_meta_box( $subtitle_meta_box );

  $header_fields[] = array(
    'name' => __( 'Hero Button Text', 'zilla' ),
    'desc' => __( 'Text to appear in the button on the hero', 'zilla' ),
    'id'   => '_zilla_hero_button_text',
    'type' => 'text',
    'std'  => __( 'view our work', 'zilla' )
  );

  $header_fields[] = array(
    'name' => __( 'Hero Button Link', 'zilla' ),
    'desc' => __( 'Link for the Hero Text', 'zilla' ),
    'id'   => '_zilla_hero_button_link',
    'type' => 'text',
    'std'  => ''
  );

  $header_fields[] = array(
    'name' => __( 'Open Hero Link in new tab', 'zilla' ),
    'desc' => __( 'Whether to open the link in a new browser tab or not', 'zilla' ),
    'id'   => '_zilla_hero_button_new_tab',
    'type' => 'checkbox',
    'std'  => ''
  );

  $header_meta_box = array(
    'id'       => 'zilla-metabox-page-header',
    'title'    => __( 'Hero Options', 'zilla' ),
    'page'     => 'page',
    'context'  => 'normal',
    'priority' => 'high',
    'fields'   => $header_fields
  );

  zilla_add_meta_box( $header_meta_box );

  $page_fields[] = array(
    'name' => __( 'Show Portfolio Items on Home Page', 'zilla' ),
    'desc' => __( 'Whether or not to show portfolio items on the home page', 'zilla' ),
    'id'   => '_zilla_home_show_portfolio',
    'type' => 'checkbox'
  );

  $page_fields[] = array(
    'name'    => __( 'Number of portfolio items on the home page', 'zilla' ),
    'desc'    => __( 'How many portfolio items to show on homepage', 'zilla' ),
    'id'      => '_zilla_home_portfolio_amount',
    'type'    => 'select',
    'options' => $amounts
  );

  $page_fields[] = array(
    'name' => __( 'Portfolio Page URL', 'zilla' ),
    'desc' => __( 'Link to portfolio page', 'zilla' ),
    'id'   => '_zilla_home_portfolio_link',
    'type' => 'text',
    'std'  => ''
  );

  $page_fields[] = array(
    'name' => __( 'Portfolio Button Text', 'zilla' ),
    'desc' => __( 'Text for portfolio page button', 'zilla' ),
    'id'   => '_zilla_home_portfolio_link_text',
    'type' => 'text',
    'std'  => 'View Full Portfolio'
  );

  $page_fields[] = array(
    'name' => __( 'Show Testimonials on Home Page', 'zilla' ),
    'desc' => __( 'Whether or not to show testimonials on the home page', 'zilla' ),
    'id'   => '_zilla_home_show_testimonials',
    'type' => 'checkbox',
    'std'  => ''
  );

  $page_fields[] = array(
    'name'    => __( 'Number of testimonials on the home page', 'zilla' ),
    'desc'    => __( 'How many testimonials to show on homepage', 'zilla' ),
    'id'      => '_zilla_home_testimonials_amount',
    'type'    => 'select',
    'options' => $amounts
  );

  $page_fields[] = array(
    'name' => __( 'Show Gallery on Home Page', 'zilla' ),
    'desc' => __( 'Whether or not to show client logos on the home page', 'zilla' ),
    'id'   => '_zilla_home_show_gallery',
    'type' => 'checkbox',
    'std'  => ''
  );

  if ( 'about.php' != $template_file ) {
    $page_fields[] = array(
      'name' => __( 'Gallery', 'zilla' ),
      'desc' => __( 'Gallery Section for the home page.', 'zilla' ),
      'id'   => '_zilla_home_gallery',
      'type' => 'images',
      'std'  => __( 'Client Logos', 'zilla' )
    );
  }

  $page_fields[] = array(
    'name' => __( 'Gallery Title', 'zilla' ),
    'desc' => __( 'Text to appear as gallery_title', 'zilla' ),
    'id'   => '_zilla_home_gallery_title',
    'type' => 'text',
    'std'  => __( 'Our Clients', 'zilla' )
  );

  $page_fields[] = array(
    'name'    => __( 'Number of gallery items on the home page', 'zilla' ),
    'desc'    => __( 'How many gallery items to show on homepage', 'zilla' ),
    'id'      => '_zilla_home_gallery_amount',
    'type'    => 'select',
    'options' => $amounts
  );

  $page_fields[] = array(
    'name' => __( 'Show Blog posts on Home Page', 'zilla' ),
    'desc' => __( 'Whether or not to show blog posts on the home page', 'zilla' ),
    'id'   => '_zilla_home_show_blog',
    'type' => 'checkbox',
    'std'  => ''
  );

  $page_fields[] = array(
    'name' => __( 'Blog Page URL', 'zilla' ),
    'desc' => __( 'Link to the blog page', 'zilla' ),
    'id'   => '_zilla_home_blog_link',
    'type' => 'text',
    'std'  => ''
  );

  $page_options_meta_box = array(
    'id'       => 'zilla-metabox-page-options',
    'title'    => __( 'Cover Page Options', 'zilla' ),
    'page'     => 'page',
    'context'  => 'normal',
    'priority' => 'high',
    'fields'   => $page_fields
  );

  zilla_add_meta_box( $page_options_meta_box );

  $contact_fields[] = array(
    'name' => __( 'Title', 'zilla' ),
    'desc' => __( 'Add a title for the contact form.', 'zilla' ),
    'id'   => '_zilla_contact_title',
    'type' => 'text',
    'std'  => __( 'Drop us a line.', 'zilla' )
  );

  $contact_fields[] = array(
    'name' => __( 'Subtitle', 'zilla' ),
    'desc' => __( 'Add a subtitle for the contact form.', 'zilla' ),
    'id'   => '_zilla_contact_subtitle',
    'type' => 'text',
    'std'  => __( 'Send us a message even if it is just to say hi!', 'zilla' )
  );

  $contact_fields[] = array(
    'name' => __( 'Google Maps Embed Code', 'zilla' ),
    'desc' => __( 'Generate your map <a href="https://developers.google.com/maps/documentation/embed/start" target="_blank">here</a>, then paste the embed code above. The map width should be 540px and height should be 600px', 'zilla' ),
    'id'   => '_zilla_contact_map_embed',
    'type' => 'textarea',
    'std'  => ''
  );

  $contact_meta_box = array(
    'id'       => 'zilla-metabox-page-contact',
    'title'    => __( 'Contact Form', 'zilla' ),
    'page'     => 'page',
    'context'  => 'normal',
    'priority' => 'high',
    'fields'   => $contact_fields
  );

  zilla_add_meta_box( $contact_meta_box );

  //About
  if ( 'about.php' == $template_file ) {
    $about_fields[] = array(
      'name' => __( 'Gallery', 'zilla' ),
      'desc' => __( 'Gallery Section for the top of the about page.', 'zilla' ),
      'id'   => '_zilla_home_gallery',
      'type' => 'images',
      'std'  => ''
    );
  }

  $about_fields[] = array(
    'name' => __( 'Team section title', 'zilla' ),
    'desc' => __( 'Title for the "Our Team" section.', 'zilla' ),
    'id'   => '_zilla_about_team_title',
    'type' => 'text',
    'std'  => __( 'Meet Our Team', 'zilla' )
  );

  $about_fields[] = array(
    'name' => __( 'Join Our Team section title', 'zilla' ),
    'desc' => __( 'Title for the "Join Our Team" section.', 'zilla' ),
    'id'   => '_zilla_join_our_team_title',
    'type' => 'text',
    'std'  => __( 'Join Our Team!', 'zilla' )
  );

  $about_fields[] = array(
    'name' => __( 'Join Our Team section subtitle', 'zilla' ),
    'desc' => __( 'Subtitle for the "Join Our Team" section.', 'zilla' ),
    'id'   => '_zilla_join_our_team_subtitle',
    'type' => 'text',
    'std'  => ''
  );

  $about_fields[] = array(
    'name' => __( 'Positions Open', 'zilla' ),
    'desc' => __( 'Please enter all positions open(separated by a comma).', 'zilla' ),
    'id'   => '_zilla_join_our_team_positions',
    'type' => 'text',
    'std'  => ''
  );

  $about_fields[] = array(
    'name' => __( 'Join Our Team call to action text', 'zilla' ),
    'desc' => __( 'Text for the "Join Our Team" section call to action.', 'zilla' ),
    'id'   => '_zilla_join_our_team_cta_text',
    'type' => 'text',
    'std'  => __( 'View All Positions', 'zilla' )
  );

  $about_fields[] = array(
    'name' => __( 'Join Our Team call to action link', 'zilla' ),
    'desc' => __( 'Link for the "Join Our Team" section call to action.', 'zilla' ),
    'id'   => '_zilla_join_our_team_cta_link',
    'type' => 'text',
    'std'  => __( '', 'zilla' )
  );

  $about_meta_box = array(
    'id'       => 'zilla-metabox-page-about',
    'title'    => __( 'Options for the about page.', 'zilla' ),
    'page'     => 'page',
    'context'  => 'normal',
    'priority' => 'high',
    'fields'   => $about_fields
  );

  zilla_add_meta_box( $about_meta_box );
}

endif;
