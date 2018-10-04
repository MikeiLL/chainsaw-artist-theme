<h1 class="page-title">Portfolio</h1>
<div class="portfolio-gallery">
<?php while (have_posts()) : the_post(); ?>
  <div class="container" style="min-height:500px;">
    <div class="row" style="min-height:500px;">
      <div class="col-md" style="min-height:500px;background-size:cover;background-image:url('<?php echo get_the_post_thumbnail_url($post->ID, 'medium'); ?>')">

      </div>
      <div class="col-md">
        <h2><?php the_title( ); ?></h2>
        <?php
        if(get_field('introduction'))
          {
            echo '<blockquote>' . get_field('introduction') . '</blockquote>';
          }
        ?>
        <?php
        if(get_field('challenges'))
          {
            echo '<p><strong>Challenges</strong>: ' . get_field('challenges') . '</p>';
          }
        ?>
        <?php
        if(get_field('skills_used'))
          {
            echo '<p><strong>Skills Used</strong>: ' . get_field('skills_used') . '</p>';
          }
        ?>
        <?php
        if(get_field('materials'))
          {
            echo '<p><strong>Materials</strong>: ' . get_field('materials') . '</p>';
          }
        ?>
        <?php
        if(get_field('lessons_learned'))
          {
            echo '<p><strong>Lessons Learned</strong>: ' . get_field('lessons_learned') . '</p>';
          }
        ?>
        <?php
        if(get_field('client'))
          {
            echo '<p><strong>Client</strong>: ' . get_field('client') . '</p>';
          }
        ?>
        <?php // get_template_part('templates/content', 'portfolio'); ?>
      </div>
    </div>
  </div>

<?php endwhile; ?>

</div>
