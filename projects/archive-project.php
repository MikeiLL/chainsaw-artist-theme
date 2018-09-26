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

global $projects_loop;

// Store column count for displaying the grid
if ( empty( $projects_loop['columns'] ) )
	$projects_loop['columns'] = apply_filters( 'projects_loop_columns', 2 );

//get_header( 'projects' ); ?>

	<?php
		/**
		 * projects_before_main_content hook
		 *
		 * @hooked projects_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action( 'projects_before_main_content' );
	?>

		<?php if ( apply_filters( 'projects_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php projects_page_title(); ?></h1>

		<?php endif; ?>

		<?php do_action( 'projects_archive_description' ); ?>
		<?php do_action( 'projects_project_categories' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * projects_before_loop hook
				 *
				 */
				//do_action( 'projects_before_loop' );
			?>
<div class="swiper-container gallery-top">

			<?php projects_project_loop_start(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php projects_get_template_part( 'content', 'project' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php projects_project_loop_end(); ?>
    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
</div> <!-- End swiper wrapper -->
 <div class="swiper-container gallery-thumbs">
    <div class="swiper-wrapper">
      <?php while ( have_posts() ) : the_post(); ?>

					<?php projects_get_template_part( 'content', 'thumb' ); ?>

				<?php endwhile; // end of the loop. ?>

    </div>
  </div>
    <script type="text/javascript">
    var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
      slidesPerView: 10,
      loop: true,
      freeMode: true,
      loopedSlides: 5, //looped slides should be the same
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
      spaceBetween: 10,
      loop:true,
      loopedSlides: 5, //looped slides should be the same
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs,
      },
      centeredSlides: true
    });
  </script>
			<?php
				/**
				 * projects_after_loop hook
				 *
				 * @hooked projects_pagination - 10
				 */
				do_action( 'projects_after_loop' );
			?>

		<?php else : ?>

			<?php projects_get_template( 'loop/no-projects-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * projects_after_main_content hook
		 *
		 * @hooked projects_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'projects_after_main_content' );
	?>

	<?php
		/**
		 * projects_sidebar hook
		 *
		 * @hooked projects_get_sidebar - 10
		 */
		// do_action( 'projects_sidebar' );
	?>

<?php // get_footer( 'projects' ); ?>
