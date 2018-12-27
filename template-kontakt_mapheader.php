<?php
/**
 * Template Name: Contact Map Header
 *
 * Custom page template for displaying a contact form in page
 *
 * @package Hype
 * @since 1.0
 */
get_header(); ?>

<div class="map_overlay" onclick="style.pointerEvents='none'"></div>
		 <iframe frameborder="0" style="border:0" class="osm_map" src="http://www.openstreetmap.org/export/embed.html?bbox=6.788579821586609%2C51.25041118420143%2C6.7906343936920175%2C51.251373150930604&amp;layer=mapnik&amp;marker=51.25089133066904%2C6.789607107639313" style="border: 0px;margin-top:0px;"></iframe>
		 

   <div id="main" data-menu-offset="<?php echo $offset; ?>">
<?php
if ( function_exists( 'jetpack_the_site_logo' ) && ! $show_title ) {
  $offset = -127;
} else {
  $offset = -100;
}
?>
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