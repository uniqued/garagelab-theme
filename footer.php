<?php
/**
 * The template for displaying the footer.
 *
 * @package Hype
 */

      $address                = get_theme_mod( 'address' ) ;
      $city                   = get_theme_mod( 'city' ) ;
      $province               = get_theme_mod( 'province' );
      $postal_code            = get_theme_mod( 'postal-code' );
      $phone                  = get_theme_mod( 'phone' ) ? get_theme_mod( 'phone' ) . ' |' : '';
      $email                  = get_theme_mod( 'email' );
      $top_footer_text        = get_theme_mod( 'top_footer_text' );
      $top_footer_button_text = get_theme_mod( 'top_footer_button_text' );
      $top_footer_button_link = get_theme_mod( 'top_footer_button_link' );
      $show_title             = get_option( 'show_title_instead_of_logo', '0' );


      zilla_footer_before(); ?>
      <footer class="site-footer">
        <?php if ( ! is_page_template( 'template-contact.php' ) ) : ?>
          <div class="site-footer-top">
            <div class="inner-width">
              <div class="site-footer-top-left">
                <?php echo html_entity_decode($top_footer_text);  ?>
              </div>
              <div class="site-footer-top-right">
                <?php if ( $top_footer_button_text && $top_footer_button_link ) : ?>
                  <a class="button secondary-button site-footer-top-button" href="<?php echo esc_url( $top_footer_button_link ); ?>">
                    <?php echo esc_html( $top_footer_button_text ); ?><svg class="right-arrow-icon"><use xlink:href="#icon-down-arrow"></use></svg>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php zilla_footer_start(); ?>
		<div class="inner-width">
        <div class="home-news-block">
          <div class="site-footer-inner-logo">
           <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home" itemprop="url">
           <!------------------------------------------------------------------------------>
			<picture><!--[if IE 9]><video style="display: none;"><![endif]-->
			<source media="(max-width: 768px)" srcset="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo_Small.svg" type="image/svg+xml">
			<source srcset="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo.svg" type="image/svg+xml"><!--[if IE 9]></video><![endif]-->
			<img src="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo.png" alt="GarageLab">
			</picture>
			<!------------------------------------------------------------------------------>
           </a>
		  </div>
          <div class="site-footer-contact-info">
            <div class="site-footer-address">
			<?php echo ( $address ); ?><br/><br/>
              <?php echo ( $postal_code ); ?>   <?php echo ( $city ); ?><br/>	
	
				
            </div>
            <div class="site-footer-phone-email">
              <?php printf( '%1$s <a class="site-footer-contact-email" href="mailto:%2$s">%2$s</a>', $phone, $email ); ?>
            </div>
            <div class="site-footer-social-icons">
			<h5 class="widgettitle">Folge uns:</h3>
              <?php get_template_part( 'social-icons' ); ?>
            </div>
            <?php if (get_theme_mod( 'copyright' ) ): ?>

            <div class="site-footer-inner-bottom">

                <div class="copyright">
                  <?php echo get_theme_mod( 'copyright' ); ?>
                </div>

            </div>
            <?php endif; ?>

          </div>
        </div><!-- site-footer-inner -->
		  <div class="home-news-block">
		  	<?php if ( is_active_sidebar( 'footerintern-sidebar' ) ) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'footerintern-sidebar' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
		  </div>
		  	  <div class="home-news-block">
		  	<?php if ( is_active_sidebar( 'footermeta-sidebar' ) ) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'footermeta-sidebar' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
		  </div>
	</div>
        <?php zilla_footer_end(); ?>
      </footer>
      <?php zilla_footer_after(); ?>

    <?php zilla_content_end(); ?>
  </div><!-- #skrollr-body -->
  </div><!-- #content -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>