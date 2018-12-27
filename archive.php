<?php
/**
 * The main template_file
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hype
 */
global $post;
get_header();
?>

<?php if ( have_posts() ) : ?>


  <div id="main" data-menu-offset="-165">

  <div id="posts" class="skrollr-content">
    <div class="inner-width">
      <?php get_search_form(); ?>
    </div>
    <?php /* Start the Loop */ ?>
    <div class="archive-posts">
      <?php hype_print_posts(); ?>
    </div>

  </div><!-- #posts -->

<?php else : ?>

  <?php get_template_part( 'no-results', 'archive' ); ?>

<?php endif; ?>

<?php get_footer(); ?>