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
    'post_type' => 'portfolio'
  );
  //var_dump(get_post_type_archive_link( 'project' ));
  //var_dump( get_intermediate_image_sizes() );
  $gallery_results = new \WP_Query($args);
  $result = '';
  $count = 0;
  global $post; ?>
  <?php
  if( $gallery_results->have_posts() ):
      while( $gallery_results->have_posts() ): $gallery_results->the_post();
        // If we don't have an image, continue, at least for now until we support video or other format.
        if ($count == 0):
          $result .= '<div class="row">';
          $result .= '  <div class="hero-wrapper"><a href="' . get_post_type_archive_link( "portfolio" ) . '"><img class="hero__main-img" src="'. get_the_post_thumbnail_url($post->ID, 'large') . '"/></a></div>';
          $result .= '</div>';
        else:
          if ($count == 1):
            $result .= '<a href="' . get_post_type_archive_link( "portfolio" ) . '"><div class="hp-gallery-thumbs-wrapper row">';
          endif;
          $result .= '  <div class="hp-gallery-thumb" style="background-image:url(' . get_the_post_thumbnail_url($post->ID, 'medium') . ')">';
          $result .= '    <div class="hp-gallery-thumb__content">';
          $result   .= '       <h3 class="project-name">'. get_the_title() . '</h3>';
          $result .= '    </div>';
          $result .= '  </div>';
          if ($count == 5):
            $result .= '</div></a>';
          endif;
        endif;
        $count++;
        if ($count == 6) break;
      endwhile;
  endif;
  wp_reset_postdata();
  $result .= "</div>";
  return $result;
}
add_shortcode('mz_frontpage_gallery', __NAMESPACE__ . '\\mz_noahkenin_add_frontpage_gallery');

// Dequeue Projects Styles and Scripts
function wp_mz_67472455(){
  wp_dequeue_style( 'projects-slick-theme' );
  wp_dequeue_style( 'projects-slick-css' );
  wp_dequeue_script( 'projects-slick' );
}
add_action( 'wp_print_styles', __NAMESPACE__ . '\\wp_mz_67472455', 100 );

function mz_noahkenin_large_frontpage_buttons() {
$link1 = '<a href="' . get_post_type_archive_link( 'portfolio' ) . '">';
$link2 = '<a href="' . get_post_type_archive_link( 'project' ) . '">';
$link_closer = "</a>";
return <<<EOL
<div class="gallery-archive-container">
    <div class="hp-gallery hp-archive-gallery">
      {$link1}
        <div class="hp-archive-gallery__content" id="gallery_button">

        <svg class="hp-gallery__icon hp-archive-gallery__icon" id=Capa_1 style="enable-background:new 0 0 20.954 20.954"version=1.1 viewBox="0 0 20.954 20.954"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g><g><g><path d="M20.851,7.169l-7.705-3.681c-0.09-0.042-0.197-0.004-0.24,0.084l-1.677,3.51h0.913l1.232-2.579
            l6.679,3.191l-2.088,4.372l-1.177-0.561v2.311l0.723,0.346c0.091,0.043,0.197,0.004,0.241-0.084l3.185-6.668
            C20.98,7.32,20.941,7.212,20.851,7.169z"style=fill:#030104 /></g><g><path d="M0.103,7.126l7.705-3.68c0.09-0.043,0.197-0.005,0.24,0.083l1.678,3.51H8.812L7.58,4.46
            L0.901,7.651l2.089,4.372l1.176-0.561v2.311l-0.723,0.346c-0.09,0.045-0.197,0.004-0.24-0.084L0.018,7.366
            C-0.025,7.277,0.013,7.17,0.103,7.126z"style=fill:#030104 /></g><g><path d="M16.06,7.684H5.216c-0.126,0-0.229,0.102-0.229,0.228v9.385c0,0.125,0.103,0.229,0.229,0.229
            h10.845c0.127,0,0.229-0.104,0.229-0.229V7.912C16.29,7.786,16.187,7.684,16.06,7.684z M15.434,14.877h-0.688
            c-0.4-1.025-0.893-2.463-1.641-2.271c-0.876,0.223-1.315,2.271-1.315,2.271s-0.446-2.311-1.683-3.549
            c-1.238-1.237-2.437,3.549-2.437,3.549H6.033V8.723h9.401V14.877z"style=fill:#030104 /></g><g><circle cx=7.55 cy=10.042 r=0.767 style=fill:#030104 /></g><g><path d="M12.697,10.584c0.172,0,0.332-0.019,0.476-0.048c0.167,0.071,0.372,0.115,0.592,0.115
            c0.564,0,1.023-0.276,1.023-0.616c0-0.341-0.459-0.618-1.023-0.618c-0.212,0-0.409,0.04-0.572,0.106
            c-0.067-0.065-0.157-0.106-0.257-0.106h-0.149c-0.189,0-0.339,0.144-0.361,0.328c-0.458,0.048-0.798,0.213-0.798,0.413
            C11.627,10.393,12.106,10.584,12.697,10.584z"style=fill:#030104 /></g></g></g></svg>

            <br><h2 class="hp-archive-gallery__title">Portfolio</h2>
        </div>
      {$link_closer}
    </div>

    <div class="hp-archive hp-archive-gallery">
      {$link2}
        <div class="hp-archive-gallery__content" id="archive_button">

          <svg class="hp-archive__icon hp-archive-gallery__icon" style="enable-background:new 0 0 511 511"version=1.1 viewBox="0 0 511 511"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g><path d="M511,71.553H226.606L179.5,24.447l-47.106,47.106H0v383h16v32h47v-32h385v32h47v-32h16V71.553z M245.394,111.553h-43.787
          l7.197-7.197L198.197,93.75l-17.803,17.803h-18.787l27.197-27.197L178.197,73.75l-37.803,37.803h-26.787L179.5,45.66
          L245.394,111.553z M456,126.553v113H55v-113H456z M48,471.553H31v-17h17V471.553z M480,471.553h-17v-17h17V471.553z M496,439.553
          h-1h-47H63H16h-1v-353h102.394l-25,25H40v143h431v-143H266.606l-25-25H496V439.553z"/><path d="M40,414.553h431v-143H40V414.553z M55,286.553h401v113H55V286.553z"/><path d="M327,159.553H184v47h143V159.553z M312,191.553H199v-17h113V191.553z"/><path d="M184,366.553h143v-47H184V366.553z M199,334.553h113v17H199V334.553z"/></g></svg>
          <br><h2 class="hp-archive-gallery__title">Archives</h2>
        </div>
      {$link_closer}
    </div>
</div>
EOL;
}
add_shortcode('large_frontpage_buttons', __NAMESPACE__ . '\\mz_noahkenin_large_frontpage_buttons');

