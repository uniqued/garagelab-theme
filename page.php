<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Hype
 */

get_header(); ?>

  <div id="main">

    <?php
    while ( have_posts() ) : the_post();

      get_template_part( 'content', 'page' );

    endwhile;

    ?>
  <?php zilla_comments_before(); ?>
  <?php // If comments are open or we have at least one comment, load up the comment template
  if ( comments_open() || '0' != get_comments_number() )
    comments_template();
  ?>
  <?php zilla_comments_after(); ?>
  <div><!-- #main -->
</div><!-- #skrollr-body -->
<?php get_template_part( 'sidebar' ); ?>

<?php get_footer(); ?>