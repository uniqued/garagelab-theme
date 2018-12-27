<?php

/**
 * Modify portfolio meta boxes
 */


remove_action( 'tzp_portfolio_audio_meta_box_fields', 'tzp_render_portfolio_audio_fields', 10 );
add_action( 'tzp_portfolio_audio_meta_box_fields', 'hype_render_portfolio_audio_fields', 11 );

if ( ! function_exists( 'hype_render_portfolio_audio_fields' ) ) :
/**
 * Portfolio Audio Fields
 *
 * Used to output the portfolio audio fields(overwrite the plugin)
 *
 * @since 0.1.0
 * @param int $post_id The ID of the portfolio post
 */
function hype_render_portfolio_audio_fields( $post_id ) {
  ?>
  <div class="tzp-field">
    <div class="tzp-left">
      <label for='_tzp_audio_title'><?php _e( 'Title:', 'zilla-portfolio' ); ?></label>
    </div>
    <div class="tzp-right">
      <input type="text" name="_tzp_audio_title" id="_tzp_audio_title" value="<?php echo esc_attr( get_post_meta( $post_id, '_tzp_audio_title', true ) ); ?>" class="text" />
      <p class='tzp-desc howto'><?php _e( 'Enter a title for the audio clip, if desired.', 'zilla-portfolio' ); ?></p>
    </div>
  </div>

  <div class="tzp-field">
    <div class="tzp-left">
      <label for='_tzp_audio_subtitle'><?php _e( 'Subtitle:', 'zilla-portfolio' ); ?></label>
    </div>
    <div class="tzp-right">
      <input type="text" name="_tzp_audio_subtitle" id="_tzp_audio_subtitle" value="<?php echo esc_attr( get_post_meta( $post_id, '_tzp_audio_subtitle', true ) ); ?>" class="text" />
      <p class='tzp-desc howto'><?php _e( 'Enter a subtitle for the audio clip, if desired.', 'zilla-portfolio' ); ?></p>
    </div>
  </div>

  <div class="tzp-field">
    <div class="tzp-left">
      <label for='_tzp_audio_file_mp3'><?php _e( '.mp3 File:', 'zilla-portfolio' ); ?></label>
    </div>
    <div class="tzp-right">
      <input type="text" name="_tzp_audio_file_mp3" id="_tzp_audio_file_mp3" value="<?php echo esc_attr( get_post_meta( $post_id, '_tzp_audio_file_mp3', true ) ); ?>" class="file" />
      <input type="button" class="tzp-upload-file-button button" name="_tzp_audio_file_mp3_button" data-post-id="<?php echo $post_id; ?>" id="_tzp_audio_file_mp3_button" value="<?php esc_attr_e( 'Browse', 'zilla-portfolio' ); ?>" />
      <p class='tzp-desc howto'><?php _e( 'Insert an .mp3 file, if desired.', 'zilla-portfolio' ); ?></p>
    </div>
  </div>

  <div class="tzp-field">
    <div class="tzp-left">
      <label for='_tzp_audio_file_ogg'><?php _e( '.ogg File:', 'zilla-portfolio' ); ?></label>
    </div>
    <div class="tzp-right">
      <input type="text" name="_tzp_audio_file_ogg" id="_tzp_audio_file_ogg" value="<?php echo esc_attr( get_post_meta( $post_id, '_tzp_audio_file_ogg', true ) ); ?>" class="file" />
      <input type="button" class="tzp-upload-file-button button" name="_tzp_audio_file_ogg_button" data-post-id="<?php echo $post_id; ?>" id="_tzp_audio_file_ogg_button" value="<?php esc_attr_e( 'Browse', 'zilla-portfolio' ); ?>" />
      <p class='tzp-desc howto'><?php _e( 'Insert an .ogg file, if desired.', 'zilla-portfolio' ); ?></p>
    </div>
  </div>
  <?php
}
endif;