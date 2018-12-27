<?php
global $post;

$tags        = get_the_tags();
$tag_content = '';
if ( $tags ) :
  $tag_content = '<span class="marker">' . __( 'Tags', 'hype' ) .
    '<svg class="post-small-tag-icon"><use xlink:href="#icon-tags-s"></use></svg></span>';

  foreach( $tags as $tag ) :
    $tag_content .= '<a class="tag" href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a>';
  endforeach;
endif;

if ( $tag_content ) :
  echo  '<div class="post-tags">'. $tag_content . '</div>';
endif;