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

// Filter out projects plugin style sheets which we don't need.
add_filter( 'projects_enqueue_styles', '__return_false' );

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
  if ( is_front_page() ) {
    return 'container-fluid';
  } else {
    return 'container';
  }
}
//*

// Start BNS Dynamic Copyright
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
// End BNS Dynamic Copyright

add_filter('woocommerce_show_page_title', '__return_false');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);




// Create a function to excplude some categories from the main query
function mz_modify_query_only_with_image( $query ) {
  // bail early if is in admin
	if( is_admin() ) return;

	// bail early if not main query
	// - allows custom code / plugins to continue working
	if( !$query->is_main_query() ) return;

  if ((is_archive('project')) && (array_key_exists('post_type', $query->query))):
    if (($query->query['post_type'] === 'portfolio') || ($query->query['post_type'] === 'project')):
      $query->set( 'meta_key', '_thumbnail_id' );
    endif;
  endif;
}


add_action( 'pre_get_posts', __NAMESPACE__ . '\\mz_modify_query_only_with_image' );

function archives_display($atts, $content){

  $atts = shortcode_atts(
		array(
			'type' => '',
			'thumbnails' => 1
		), $atts, 'mz_noah_archives_display' );

  $type = $atts['type'];
  $thumbnails = $atts['thumbnails'];

  $args = array(
    'post_type' => 'project'
  );
  //var_dump(get_post_type_archive_link( 'project' ));
  //var_dump( get_intermediate_image_sizes() );

  if (!empty($atts['type'])){
    $args['meta_query']	= array(
      'relation'		=> 'OR',
        array(
          'key'		=> 'gallery_portfolio_status',
          'value'		=> $atts['type'],
          'compare'	=> 'LIKE'
        )
      );
  }

  $gallery_results = new \WP_Query($args);
  $result = '';
  global $post; ?>
  <?php

  if( $gallery_results->have_posts() ):
    $result .= '      <div class="gallery '.$type.'">';
    while( $gallery_results->have_posts() ): $gallery_results->the_post();
      $metadata = wp_get_attachment_metadata( get_post_thumbnail_id( $post->ID ), true );
      $height = $metadata['height'];
      $width = $metadata['width'];
      $result .= '        <div class="gallery-cell single">';
      $result .= '          <img src="' . get_the_post_thumbnail_url($post->ID, 'medium') .'"';
      $result .= ' data-src="' . get_the_post_thumbnail_url($post->ID, 'full') .'"';
      $result .= ' data-width="'.$width.'"';
      $result .= ' data-height="'.$height.'"';
      $result .= ' alt="Noah Kenin Sculpture"';
      $result .= '>';
      $result .= '        </div>';
    endwhile;
    $result .= '        </div>';
    if ($thumbnails == 1):
      $result .= '      <div class="gallery-nav">';
      while( $gallery_results->have_posts() ): $gallery_results->the_post();
        $result .= '        <div class="gallery-thumbnail">';
        $result .= '          <img src="' . get_the_post_thumbnail_url($post->ID, 'project-thumbnail') .'"';
        $result .= ' alt="Noah Kenin Sculpture"';
        $result .= '>';
        $result .= '        </div>';
      endwhile;
      $result .= '        </div>';
    endif;
  endif;
  $result .= '<!-- Root element of PhotoSwipe. Must have class pswp. -->';
  $result .= '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">';
  $result .= '    <!-- Background of PhotoSwipe. ';
  $result .= '         It\'s a separate element as animating opacity is faster than rgba(). -->';
  $result .= '    <div class="pswp__bg"></div>';

  $result .= '    <!-- Slides wrapper with overflow:hidden. -->';
  $result .= '    <div class="pswp__scroll-wrap">';

  $result .= '        <!-- Container that holds slides. ';
  $result .= '            PhotoSwipe keeps only 3 of them in the DOM to save memory.';
  $result .= '            Don\'t modify these 3 pswp__item elements, data is added later on. -->';
  $result .= '        <div class="pswp__container">';
  $result .= '            <div class="pswp__item"></div>';
  $result .= '            <div class="pswp__item"></div>';
  $result .= '            <div class="pswp__item"></div>';
  $result .= '        </div>';

  $result .= '        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->';
  $result .= '        <div class="pswp__ui pswp__ui--hidden">';
  $result .= '            <div class="pswp__top-bar">';

  $result .= '                <!--  Controls are self-explanatory. Order can be changed. -->';

  $result .= '                <div class="pswp__counter"></div>';

  $result .= '                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>';

  $result .= '                <button class="pswp__button pswp__button--share" title="Share"></button>';

  $result .= '                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>';

  $result .= '                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>';

  $result .= '                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->';
  $result .= '                <!-- element will get class pswp__preloader--active when preloader is running -->';
  $result .= '                <div class="pswp__preloader">';
  $result .= '                    <div class="pswp__preloader__icn">';
  $result .= '                      <div class="pswp__preloader__cut">';
  $result .= '                        <div class="pswp__preloader__donut"></div>';
  $result .= '                      </div>';
  $result .= '                    </div>';
  $result .= '                </div>';
  $result .= '            </div>';

  $result .= '            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">';
  $result .= '                <div class="pswp__share-tooltip"></div> ';
  $result .= '            </div>';

  $result .= '            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">';
  $result .= '            </button>';

  $result .= '            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">';
  $result .= '            </button>';
  $result .= '            <div class="pswp__caption">';
  $result .= '                <div class="pswp__caption__center"></div>';
  $result .= '            </div>';
  $result .= '        </div>';
  $result .= '    </div>';
  $result .= '</div>';
  wp_reset_postdata();
  return $result;
}

add_shortcode('archives_display', __NAMESPACE__ . '\\archives_display');

