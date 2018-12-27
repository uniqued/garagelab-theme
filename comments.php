<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to hype_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package Hype
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
  return;
?>

<section id="comments" class="comments-area">
  <div class="inner-width">
    <?php // You can start editing here -- including this comment! ?>

      <h1 class="comments-title">
        <?php
        printf( _nx( '1 Kommentar', '%1$s Kommentare', get_comments_number(), 'comments title', 'hype' ),
          number_format_i18n( get_comments_number() ) );
        ?>
      </h1>
      <?php
      $commenter = wp_get_current_commenter();
      $req = get_option( 'require_name_email' );
      $aria_req = ( $req ? " aria-required='true'" : '' );

      $fields =  array(

        'author' =>
          '<p class="comment-form-author">' .
          '<input id="author" class="comment-form-input" name="author" type="text" placeholder="'.esc_attr( 'Name', 'hype' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
          '" size="30"' . $aria_req . ' /></p>',

        'email' =>
          '<p class="comment-form-email">' .
          '<input id="email" class="comment-form-input" name="email" type="text" placeholder="'.esc_attr( 'Email', 'hype' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
          '" size="30"' . $aria_req . ' /></p>',

        'url' =>
          '<p class="comment-form-url">' .
          '<input id="url" class="comment-form-input" name="url" type="text" placeholder="'.esc_attr( 'Website', 'hype' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
          '" size="30" /></p>',
      );

      $comment_field = '<p class="comment-form-comment"><textarea id="comment" class="comment-form-textarea" name="comment" rows="5" placeholder="'.esc_attr( 'Comments', 'hype' ) . '" aria-required="true"></textarea></p>';

      $args = array(
        'comment_notes_before' => __( '', 'hype'),
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_notes_after'  => __( '<a href="#" id="cancel-comment">Cancel Reply</a>', 'hype' ),
        'comment_field'        => $comment_field,
        'class_submit'         => 'submit comment-submit button primary-button',
        'title_reply'          => __( '', 'hype' ),
        'title_reply_to'       => __( '', 'hype' )
      ); ?>
      <?php comment_form( $args ); ?>

    <?php if ( have_comments() ) : ?>

      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-above" class="comment-navigation" role="navigation">
          <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'hype' ); ?></h1>
          <div class="nav-previous"><?php previous_comments_link( __( '&larr; Ältere Kommentare', 'hype' ) ); ?></div>
          <div class="nav-next"><?php next_comments_link( __( 'Neuere Kommentare &rarr;', 'hype' ) ); ?></div>
        </nav><!-- #comment-nav-above -->
      <?php endif; // check for comment navigation ?>

      <ol class="comment-list">
        <?php
        /* Loop through and list the comments. Tell wp_list_comments()
         * to use hype_comment() to format the comments.
         * If you want to overload this in a child theme then you can
         * define hype_comment() and that will be used instead.
         * See hype_comment() in inc/template-tags.php for more.
         */
        wp_list_comments( array(
          'callback'    => 'hype_comment',
          'avatar_size' => 62,
          'reply_text'  => __( '<svg class="icon-reply-arrow"><use xlink:href="#icon-reply-arrow"></use></svg>Reply to Comment', 'hype' )
        ) );
        ?>
      </ol><!-- .comment-list -->

      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="comment-navigation" role="navigation">
          <h1 class="screen-reader-text"><?php _e( 'Kommentarnavigation', 'hype' ); ?></h1>
          <div class="nav-previous"><?php previous_comments_link( __( '&larr; Ältere Kommentare', 'hype' ) ); ?></div>
          <div class="nav-next"><?php next_comments_link( __( 'Neuere Kommentare &rarr;', 'hype' ) ); ?></div>
        </nav><!-- #comment-nav-below -->
      <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
      ?>
      <p class="no-comments"><?php _e( 'Die Kommentare sind geschlossen.', 'hype' ); ?></p>
    <?php endif; ?>

  </div>

</section><!-- #comments -->
