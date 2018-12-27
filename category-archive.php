<?php $categories = get_categories(); ?>
<?php if ( $categories ) : ?>
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
        <?php foreach( $categories as $cat ) : ?>
          <li>
            <a href="<?php echo get_category_link ( $cat->cat_ID ); ?>"><?php echo esc_html ( $cat->name ); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </span>

    <?php get_search_form(); ?>

    </div>
  </header>
<?php endif; ?>