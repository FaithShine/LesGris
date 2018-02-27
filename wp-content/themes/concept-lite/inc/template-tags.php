<?php
/**
 * Custom template tags for this theme.
 *
 * @package Concept
 */

/**
 * Sets featured image size depending on original uploaded image
 */
function concept_post_thumbnail() {
	if ( !has_post_thumbnail()) { 
    return; 
} else {
	global $post;
    //check if post is object otherwise you're not in singular post
    if( !is_object($post) ) 
    return;
	echo '<a href="'.esc_url(get_permalink( $post->ID)).'">';
    $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '');
    $image_w = $image[1];
    $image_h = $image[2];

    if ($image_w > $image_h) { 
        the_post_thumbnail( 'concept-blog-landscape' );
    }
    elseif ($image_w == $image_h) {
         the_post_thumbnail( 'concept-blog-landscape' );
    }
    else { 
         the_post_thumbnail( 'concept-blog-portrait' );
    }
	echo '</a>';
}
}
