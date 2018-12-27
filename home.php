<?php
/**
 * The main template_file
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hype
 */
global $post;
$show_title = get_option( 'show_title_instead_of_logo', '0' );


if ( function_exists( 'jetpack_the_site_logo' ) && ! $show_title ) {
  $offset = -127;
} else {
  $offset = -100;
}
get_header();
?>

<?php if ( have_posts() ) : ?>

  <div id="main" data-menu-offset="<?php echo $offset; ?>">

  <div id="posts" class="skrollr-content">
    <div class="inner-width">
      <?php
      get_template_part( 'category', 'archive' );
      ?>
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