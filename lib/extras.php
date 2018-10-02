<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/* As recommended in Roots Discourse, this function is called
 * within div wrap so we can eliminate the container and have
 * full width rows and divs.
*/
function container_class() {
  if ( is_front_page() || 'something' == get_post_type() ) {
    return 'container-fluid';
  } else {
    return 'container';
  }
}
//*

// Start BNS Dynamic Copyright
if ( ! function_exists( 'bns_dynamic_copyright' ) ) {
  function bns_dynamic_copyright( $args = '' ) {
      $initialize_values = array( 'start' => '', 'copy_years' => '', 'url' => '', 'end' => '' );
      $args = wp_parse_args( $args, $initialize_values );

      /* Initialize the output variable to empty */
      $output = '';

      /* Start common copyright notice */
      empty( $args['start'] ) ? $output .= sprintf( __('Copyright') ) : $output .= $args['start'];

      /* Calculate Copyright Years; and, prefix with Copyright Symbol */
      if ( empty( $args['copy_years'] ) ) {
        /* Get all posts */
        $all_posts = get_posts( 'post_status=publish&order=ASC' );
        /* Get first post */
        $first_post = $all_posts[0];
        /* Get date of first post */
        $first_date = $first_post->post_date_gmt;

        /* First post year versus current year */
        $first_year = substr( $first_date, 0, 4 );
        if ( $first_year == '' ) {
          $first_year = date( 'Y' );
        }

      /* Add to output string */
        if ( $first_year == date( 'Y' ) ) {
        /* Only use current year if no posts in previous years */
          $output .= ' &copy; ' . date( 'Y' );
        } else {
          $output .= ' &copy; ' . $first_year . "-" . date( 'Y' );
        }
      } else {
        $output .= ' &copy; ' . $args['copy_years'];
      }

      /* Create URL to link back to home of website */
      empty( $args['url'] ) ? $output .= ' <a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) .'</a>  ' : $output .= ' ' . $args['url'];

      /* End common copyright notice */
      empty( $args['end'] ) ? $output .= ' ' . sprintf( __('All rights reserved.') ) : $output .= ' ' . $args['end'];

      /* Construct and sprintf the copyright notice */
      $output = sprintf( __('<span class="copyright" id="bns-dynamic-copyright"> %1$s </span><!-- #bns-dynamic-copyright -->'), $output );
      $output = apply_filters( 'bns_dynamic_copyright', $output, $args );

      echo $output;
  }
}
// End BNS Dynamic Copyright

add_filter('woocommerce_show_page_title', '__return_false');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

// Display Front Page Gallery
function mz_noahkenin_add_frontpage_gallery() {
  $args = array(
    'post_type' => 'otw_pm_portfolio'
  );
  $gallery_results = new \WP_Query($args);
  $result = '<div class="gallery_wrapper">';
  $count = 0;
  global $post;
  if( $gallery_results->have_posts() ):
      while( $gallery_results->have_posts() ): $gallery_results->the_post();
        // If we don't have an image, continue, at least for now until we support video or other format.
        if (empty(unserialize(get_post_meta(get_the_ID())['otw_pm_meta_data'][0])['img_url'])) continue;
        if ($count == 0):
          $result .= '<div style="height:500px;background-size:cover;background-image:url('. unserialize(get_post_meta(get_the_ID())['otw_pm_meta_data'][0])['img_url'] . ')"></div>';
        else:
          if ($count == 1):
            $result .= '  <div class="container">';
            $result .= '    <div class="row">';
          endif;
          $result .= '        <div class="col" style="height:120px;background-size:cover;background-image:url(' . unserialize(get_post_meta(get_the_ID())['otw_pm_meta_data'][0])['img_url'] . ')"></div>';
          if ($count == 4):
            $result .= '    </div>';
            $result .= '  </div>';
          endif;
        endif;
        $count++;
        if ($count == 5) break;
      endwhile;
  endif;
  wp_reset_postdata();
  $result .= "</div>";
  return $result;
}
add_shortcode('mz_frontpage_gallery', __NAMESPACE__ . '\\mz_noahkenin_add_frontpage_gallery');


