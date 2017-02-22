<?php

/* Many of the filters use `__return_false`, which is this:
 * https://codex.wordpress.org/Function_Reference/_return_false
 */

// Output updated HTML5 markup
add_theme_support( 'html5', array(
  'comment-list',
  'comment-form',
  'search-form',
  'gallery',
  'caption',
  'widgets',
 ) );

// Lets WP handle <title>, required nowadays
add_theme_support( 'title-tag' );

// <meta name="generator">, RSS <generator>, etc.
add_filter( 'the_generator', '__return_false' );

/* Turn off X-Pingback. Turns out "xmlrpc_enabled" doesn't: 
 * https://core.trac.wordpress.org/browser/trunk/src/wp-includes/class-wp-xmlrpc-server.php#L252
 * "Contrary to the way it's named, this filter does not control whether XML-RPC is *fully* enabled"
 */
add_filter( 'pings_open', '__return_false' );

// <link rel="EditURI" type="application/rsd+xml">
remove_action( 'wp_head', 'rsd_link' );

// <link rel="wlwmanifest" type="application/wlwmanifest+xml">
remove_action( 'wp_head', 'wlwmanifest_link' );

// <link rel="shortlink">
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
// Link: <https://example.com/?p=foo>; rel="shortlink"
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );

// <link rel="index"> (no longer part of WHATWG HTML5)
remove_action( 'wp_head', 'index_rel_link' );

// <link rel='https://api.w.org/'>
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
// Link: <https://example.com/?rest_route=/>; rel="https://api.w.org/"
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

// wpemoji shim
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'embed_head', 'print_emoji_detection_script' );
// <link rel='dns-prefetch' href='//s.w.org' />
add_filter( 'emoji_svg_url', '__return_false' );

// <script src='https://example.com/wp-includes/js/wp-embed.min.js'>
remove_action( 'wp_head', 'wp_oembed_add_host_js' );



function wordprep_remove_attachment_pages() {
  global $post, $wp_query;

  if ( is_attachment() ) {
    if ( $post->post_parent ) {
      wp_redirect( get_permalink( $post->post_parent ), 301 );

      exit;
    }

    return $wp_query->set_404();
  }
}
add_action( 'template_redirect', 'wordprep_remove_attachment_pages' );



// Let's not play that game
foreach ( array( 'the_content', 'the_title', 'wp_title' ) as $filter ) {
  remove_filter( $filter, 'capital_P_dangit', 11 );
}
remove_filter( 'comment_text', 'capital_P_dangit', 31 );
