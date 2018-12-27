<?php
/*
 * Template Name: Portfolio
 *
 * @package Hype
 */
global $post;

get_header();

$term         = get_queried_object()->term_id;

?>
  <main id="main">
    <div class="section full-width portfolio">
      <div class="portfolio-inner">
        <?php hype_print_portfolio_grid( false, false, $term ); ?>
      </div>
    </div>
  </main><!-- #main -->
  </div><!-- #skrollr-body -->
<?php get_footer(); ?>