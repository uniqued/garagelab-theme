<?php
/**
 * The template part for displaying social icons.
 *
 * @package Hype
 *
 */
?>

<div class="social-icons">
  <?php $mods = get_theme_mods() ?>
  <?php if ( $mods ) : ?>
    <?php foreach( $mods as $k => $v ): ?>

      <?php if ( strpos( $k, 'social-' ) !== FALSE ) : ?>

        <?php $icon_name = esc_html( str_replace( 'social-', '', $k ) ); ?>
        <?php $icon_url = esc_url($v); ?>

        <?php if ( $icon_url ) : ?>
          <span class="<?php echo $k ?>">
            <a href="<?php echo $icon_url; ?>" target="_blank"><svg class="social-icon"><use xlink:href="#icon-<?php echo $icon_name; ?>-hype"></use></svg></a>
          </span>
        <?php endif; ?>

      <?php endif; ?>

    <?php endforeach; ?>
  <?php endif; ?>
</div>