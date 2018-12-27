<?php
/**
 * The template for displaying search forms in Hype
 *
 * @package Hype
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <span class="screen-reader-text"><?php _ex( 'Search nach:', 'label', 'hype' ); ?></span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Seite durchsuchen', 'placeholder', 'hype' ); ?>" name="s" title="<?php echo esc_attr_x( 'Suche nach:', 'label', 'hype' ); ?>">
    <label class="search-label">
      <input type="submit" class="search-submit">
      <svg class="search-icon"><use xlink:href="#icon-search"></use></svg>
    </label>
</form>