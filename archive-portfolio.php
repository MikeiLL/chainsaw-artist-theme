<div class="portfolio-gallery">
<?php while (have_posts()) : the_post(); ?>
  <div><?php the_title( true ); ?></div>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php //get_template_part('templates/content', 'portfolio'); ?>
<?php endwhile; ?>

</div>
