<header class="banner">
  <div class="container">
    <nav class="navbar navbar-expand-md navbar-light bg-faded">
       <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <?php
       if (has_nav_menu('primary_navigation')) :
         wp_nav_menu([
           'theme_location'  => 'primary_navigation',
           'container'       => 'div',
           'container_id'    => 'bs4navbar',
           'container_class' => 'collapse navbar-collapse',
           'menu_id'         => false,
           'menu_class'      => 'navbar-nav mr-auto',
           'depth'           => 2,
           'fallback_cb'     => 'bs4navwalker::fallback',
           'walker'          => new bs4navwalker()
         ]);
      endif;
       ?>

    </nav>
  </div>
</header>
