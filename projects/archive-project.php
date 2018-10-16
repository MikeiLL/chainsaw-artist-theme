<?php
/**
 * The Template for displaying project archives, including the main showcase page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/projects/archive-project.php
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

  $args = array(
    'post_type' => 'project'
  );
  //var_dump(get_post_type_archive_link( 'project' ));
  //var_dump( get_intermediate_image_sizes() );

  $gallery_results = new \WP_Query($args);
  $result = '';
  global $post;
  $thumbnails = 1;
  $type = 'archives';

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
  echo $result;
