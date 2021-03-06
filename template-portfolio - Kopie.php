<?php
/*
 * Template Name: Portfolio
 *
 * @package Hype
 */
global $post;

get_header();

$show_amount            = get_theme_mod( 'portfolio_show_amount' ,'5' );
$show_dribbbler_section = FALSE;
$dribbble_button_text   = get_theme_mod( '_portfolio_dribbble_text', 'More On Dribbble' );
$dribbble_button_link   = get_theme_mod( '_portfolio_dribbble_link' );

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// check for plugin using plugin name
if ( is_plugin_active( 'zilla-dribbbler/zilla-dribbbler.php' ) ) {
  $show_dribbbler_section = TRUE;
}
?>




  <div id="main">



  
<?php
//list terms in a given taxonomy (useful as a widget for twentyten)
$taxonomy = 'portfolio-type';
$tax_terms = get_terms($taxonomy);
?>
  <header class="archive-category-header">
    <div class="inner-width">
    <span class="marker">
      <?php _e( 'Kategorie wählen:', 'hype' ); ?>
    </span>
    <span class="archive-category-container">
      <span class="archive-current-category"><?php _e( 'Kategorie', 'hype' ); ?></span>
      <svg class="archive-category-down-arrow">
        <use xlink:href="#icon-down-arrow"></use>
      </svg>
      <ul class="archive-categories">
        <?php foreach($tax_terms as $tax_term) : ?>
         	  <?php
foreach ($tax_terms as $tax_term) {
echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
}
?>
  
        <?php endforeach; ?>
      </ul>
    </span>

  
    </div>
  </header>









    <?php if ( ! empty( $post->post_content ) ) : ?>
      <div class="section portfolio-content">
        <div class="inner-width">

        <?php
          while ( have_posts() ) : the_post() ;

            get_template_part( 'content', 'simple' );

          endwhile ;
          ?>
        </div><!-- .inner-width -->
      </div><!-- .portfolio-content -->
    <?php endif; ?>
    <section class="section full-width portfolio">
      <div class="portfolio-inner">
        <?php hype_print_portfolio_grid(); ?>
      </div>
    </section>
    <?php if ( $show_dribbbler_section && is_active_sidebar( 'portfolio-sidebar' ) ) : ?>
      <section class="section portfolio-dribbbler">
        <div class="inner-width">
        <?php if ( is_active_sidebar( 'portfolio-sidebar' ) ) : ?>
	        <?php dynamic_sidebar( 'portfolio-sidebar' ); ?>
        <?php endif; ?>
        </div>
        <div class="dribbble-button-container">
          <a class="button primary-button" href="<?php echo esc_html( $dribbble_button_link ); ?>" target="_blank"><?php echo esc_html( $dribbble_button_text ); ?></a>
        </div>

      </section>
    <?php endif; ?>

  </div><!-- #main -->
  </div><!-- #skrollr-body -->
<?php get_footer(); ?>