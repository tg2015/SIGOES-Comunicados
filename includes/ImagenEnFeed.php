<?php
function ptif_do_post_thumbnail_feeds($content) {
    global $post;
    
    // Get current options
	$ptif_size = get_option('ptif_size');
    
    if(has_post_thumbnail($post->ID)) {
        $content = '<div class="post-thumbnail-feed">' . get_the_post_thumbnail($post->ID, $ptif_size) . '</div>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'ptif_do_post_thumbnail_feeds');
add_filter('the_content_feed', 'ptif_do_post_thumbnail_feeds');

?>