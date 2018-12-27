<?php
/**
 * Template Name: Contact - Map boxed
 *
 * Custom page template for displaying a contact form in page
 *
 * @package Hype
 * @since 1.0
 */
global $post;

$opts = get_option('zilla_theme_options');

/* Edit the error messages here --------------------------------------------------*/
$nameError = __( 'Required Field', 'zilla' );
$emailError = __( 'Required Field', 'zilla' );
$emailInvalidError = __( 'Invalid Email Address', 'zilla' );
$commentError = __( 'Message Required', 'zilla' );
/*--------------------------------------------------------------------------------*/

$address          = get_theme_mod( 'address' ) ? get_theme_mod( 'address' ) . ',' : '';
$city             = get_theme_mod( 'city' ) ? get_theme_mod( 'city' ) . ',' : '';
$province         = get_theme_mod( 'province' );
$postal_code      = get_theme_mod( 'postal-code' );
$phone            = get_theme_mod( 'phone' );
$email            = get_theme_mod( 'email' );
$map_iframe       = get_theme_mod( 'map_iframe' );
$contact_title    = get_post_meta( $post->ID, '_zilla_contact_title', true );
$contact_subtitle = get_post_meta( $post->ID, '_zilla_contact_subtitle', true );
$map              = get_post_meta( $post->ID, '_zilla_contact_map_embed', true );
$post_classes     = array();

if( empty( $map ) ) {
  $post_classes[] = 'no-map';
}

if( ! has_post_thumbnail() ) {
  $post_classes[] = 'no-thumb';
}

$errorMessages = array();
if (isset($_POST['submitted'])) {
  if (trim($_POST['contact-form-name']) === '') {
    $errorMessages['nameError'] = $nameError;
    $hasError = true;
  } else {
    $name = trim($_POST['contact-form-name']);
    $_POST['contact-form-name'] = '';
  }

  if (trim($_POST['contact-form-email']) === '')  {
    $errorMessages['emailError'] = $emailError;
    $hasError = true;
  } else if ( !is_email( trim($_POST['contact-form-email']) ) ) {
    $errorMessages['emailInvalidError'] = $emailInvalidError;
    $hasError = true;
  } else {
    $email = trim($_POST['contact-form-email']);
    $_POST['contact-form-email'] = '';
  }

  if (trim($_POST['comments']) === '') {
    $errorMessages['commentError'] = $commentError;
    $hasError = true;
  } else {
    if (function_exists('stripslashes')) {
      $comments = stripslashes(trim($_POST['comments']));
    } else {
      $comments = trim($_POST['comments']);
    }
    $_POST['comments'] = '';
  }

  if (!isset($hasError)) {
    $emailTo = $opts['general_contact_email'];
    if (!isset($emailTo) || ($emailTo == '') ){
      $emailTo = get_option('admin_email');
    }

    $subject = '[Contact Form] From '.$name;
    $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
    /* 	By default form will send from wordpress@yourdomain.com in order to work with
       a number of web hosts' anti-spam measures. If you want the from field to be the
       user sending the email, please uncomment the following line of code.
    */
    // $headers[] = 'From: ' . $name . ' <' . $email . '>';
    $headers[] = 'Reply-To: ' . $email;

    wp_mail( $emailTo, $subject, $body, $headers );

    $emailSent = true;
  }

}

get_header(); ?>

  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery("#contactForm").validate({
        messages: {
          contactName: '<?php echo esc_js($nameError); ?>',
          email: {
            required: '<?php echo esc_js($emailError); ?>',
            email: '<?php echo esc_js($emailInvalidError); ?>'
          },
          comments: '<?php echo esc_js($commentError); ?>'
        }
      });
    });
  </script>

  <!--BEGIN #primary .site-main-->
  <div id="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <?php zilla_page_before(); ?>
      <!--BEGIN .page-->
      <article <?php post_class( $post_classes ) ?> id="post-<?php the_ID(); ?>">
        <?php zilla_page_start(); ?>

        <?php if ( ! empty( $post->post_content ) ) : ?>
          <section class="section contact-content">
          <!--BEGIN .inner-width -->
            <div class="inner-width-800">
                <?php the_content(); ?>

              <?php if (isset($emailSent) && $emailSent == true) : ?>
                <div class="thanks">
                  <p><?php _e('Thanks, your email was sent successfully!', 'zilla') ?></p>
                </div>
              <?php  else: ?>
                <?php if (isset($hasError) || isset($captchaError)) : ?>
                  <p class="error"><?php _e('Sorry, an error occured.', 'zilla') ?><p>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </section>
        <?php endif; ?>
        <section>
            <div class="full-width">
              <div class="contact-block-container">
                <div class="contact-block contact-block-info gradient">
                  <div class="contact-company-name">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo bloginfo( 'name' ); ?></a>
                  </div>
                  <div class="contact-address">
                  <?php echo $address; ?>
                  </div>
                  <div class="contact-city-province">
                    <?php printf( '%1$s %2$s %3$s' , $postal_code, $city, $province ); ?>
                  </div>
                  <div class="contact-phone">
                    <?php echo $phone; ?>
                  </div>
                  <div class="contact-email">
                    <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                  </div>
                  <div class="contact-social">
                  <?php if ( get_theme_mod( 'twitter-handle' ) && get_theme_mod( 'social-twitter' ) ): ?>

                    <div class="menu-follow-us">
                      <?php _e( 'Follow us', 'hype' ); ?>
                      <a href="<?php echo esc_url( get_theme_mod( 'social-twitter' ) ) ?>" target="_blank">
                        <?php echo esc_html( get_theme_mod( 'twitter-handle' ) ); ?>!
                      </a>
                    </div>

                  <?php endif; ?>
                  <?php get_template_part( 'social-icons' ); ?>
                  </div>
                </div>
                <?php if( $map ) : ?>
                  <div class="contact-block contact-block-map">
				  
				 <div class="map-wrap">
				<div class="overlay" onClick="style.pointerEvents='none'"></div>
		  
				  
                    <div class="contact-map"><?php echo html_entity_decode( $map ); ?></div>
					</div>
					</div>
                  </div>
                <?php endif; ?>
              </div>
        
          </div><!-- .inner-width -->
        </section>

        <?php zilla_page_end(); ?>
        <!--END .page-->
      </article>
      <?php zilla_page_after(); ?>

    <?php endwhile; endif; ?>

    <!--END #primary .site-main-->
  </div>
</div><!-- #skrollr-body -->

<?php get_footer(); ?>