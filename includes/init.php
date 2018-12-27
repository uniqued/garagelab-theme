<?php

$incdir = get_template_directory() . '/includes/';

/**
 * Responsive Image
 */
require $incdir . 'responsive-image.php';

/**
 * Custom template tags for this theme.
 */
require $incdir . 'template-tags.php';

/**
 * Testimonials
 */
require $incdir . 'testimonials.php';

/**
 * Portfolio
 */
require $incdir . 'portfolio.php';

/**
 * Team Members
 */
require $incdir . 'team-members.php';

/**
 * Customizer additions.
 */
require $incdir . 'customizer.php';

/**
 * Shopify Shortcode.
 */
//require get_template_directory() . '/zillacommerce/init.php';

/**
 * Install Required Plugins
 */
require $incdir . 'class-tgm-plugin-activation.php';

/**
 * Load Jetpack compatibility file.
 */
if ( file_exists( get_template_directory() . '/includes/jetpack.php' ) ) {
  require $incdir . 'jetpack.php';
}

/**
 * Custom widgets & widget overrides.
 */
require $incdir . 'custom-widgets.php';

/**
 * Load Theme Meta.
 */
require $incdir . 'meta/page-meta.php';
require $incdir . 'meta/post-meta.php';
require $incdir . 'meta/testimonial-meta.php';
require $incdir . 'meta/team-member-meta.php';
require $incdir . 'meta/portfolio-meta.php';

add_action( 'tgmpa_register', 'zilla_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function zilla_register_required_plugins() {
  /**
   * Array of plugin arrays. Required keys are name and slug.
   * If the source is NOT from the .org repo, then source is also required.
   */
  $plugins = array(
    array(
      'name'     => 'ZillaPortfolio',
      'slug'     => 'zillaportfolio',
      'required' => true
    ),
    array(
      'name'     => 'Jetpack',
      'slug'     => 'jetpack',
      'required' => false
    ),
    array(
      'name'               => 'ZillaShortcodes', // The plugin name.
      'slug'               => 'zilla-shortcodes', // The plugin slug (typically the folder name).
      'source'             => 'http://themezilla-free-downloads.s3.amazonaws.com/zilla-shortcodes-2.0.2.zip', // The plugin source.
      'required'           => false, // If false, the plugin is only 'recommended' instead of required.
      'external_url'       => 'http://www.themezilla.com/plugins/zillashortcodes', // If set, overrides default API URL and points to an external URL.
    ),
    array(
      'name'               => 'ZillaDribbbler', // The plugin name.
      'slug'               => 'zilla-dribbbler', // The plugin slug (typically the folder name).
      'source'             => 'http://themezilla-free-downloads.s3.amazonaws.com/zilla-dribbbler-1.0.zip', // The plugin source.
      'required'           => false, // If false, the plugin is only 'recommended' instead of required.
      'external_url'       => 'http://www.themezilla.com/plugins/zilladribbbler', // If set, overrides default API URL and points to an external URL.
    )
  );

  $theme_text_domain = 'hype';

  /**
   * Config settings
   */
  $config = array(
    'domain'           => 'hype',                    // Text domain - likely want to be the same as your theme.
    'default_path'     => '',                          // Default absolute path to pre-packaged plugins
    'parent_menu_slug' => 'themes.php',                // Default parent menu slug
    'parent_url_slug'  => 'themes.php',                // Default parent URL slug
    'menu'             => 'install-required-plugins',  // Menu slug
    'has_notices'      => true,                        // Show admin notices or not
    'is_automatic'     => false,                       // Automatically activate plugins after installation or not
    'message'          => '',                          // Message to output right before the plugins table
    'strings'          => array(
      'page_title'                     => __( 'Install Required Plugins', 'hype' ),
      'menu_title'                     => __( 'Install Plugins', 'hype' ),
      'installing'                     => __( 'Installing Plugin: %s', 'zilla' ), // %1$s = plugin name
      'oops'                           => __( 'Something went wrong with the plugin API.', 'hype' ),
      'notice_can_install_required'    => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
      'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
      'notice_cannot_install'          => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
      'notice_can_activate_required'   => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
      'notice_can_activate_recommended'=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
      'notice_cannot_activate'         => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
      'notice_ask_to_update'           => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
      'notice_cannot_update'           => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
      'install_link'                   => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
      'activate_link'                  => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
      'return'                         => __( 'Return to Required Plugins Installer', 'hype' ),
      'plugin_activated'               => __( 'Plugin activated successfully.', 'hype' ),
      'complete'                       => __( 'All plugins installed and activated successfully. %s', 'hype' ), // %s = dashboard link
      'nag_type'                       => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
    )
  );

  tgmpa( $plugins, $config );

}
