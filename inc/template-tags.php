<?php

// Return post entry meta information
function roots_entry_meta() {
  echo '<em class="meta-entry"><i class="icon-calendar pull-left"></i><time class="updated pull-left" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('Posted on %s at %s.', 'roots'), get_the_date(), get_the_time()) .'</time><span class="pull-right">' .comments_number( 'No comments', 'One comment', '% comment' ) .'</span></em>';

  //echo '<p class="byline author vcard">'. __('Written by', 'roots') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
}
