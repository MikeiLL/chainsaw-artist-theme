<header class="banner">
  <div class="container">
    <nav class="navbar navbar-expand-md navbar-light bg-faded">
       <a class="brand" href="<?= esc_url(home_url('/')); ?>"><span class="sr-only sr-only-focusable"><?php bloginfo('name'); ?></span>
        <svg width="200px" height="80px" viewBox="0 0 724 99" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
            <g transform="matrix(1,0,0,1,-38.5598,-8.16039)">
                <g transform="matrix(1.55543,0,0,1.55543,-11.8911,-34.0917)">
                    <path d="M95.762,88.274L75.155,88.274L75.155,83.36C74.151,75.963 71.734,69.345 67.903,63.506C64.073,57.667 59.119,53.216 53.042,50.151L53.042,88.274L32.435,88.274L32.435,27.246L42.105,27.166C55.103,27.061 66.12,30.971 75.155,38.897L75.155,27.166L95.762,27.166L95.762,88.274Z" style="fill-rule:nonzero;"/>
                    <path d="M156.236,62.832C156.236,70.494 153.383,77.046 147.676,82.488C141.97,87.931 135.127,90.652 127.149,90.652C119.117,90.652 112.248,87.931 106.542,82.488C100.835,77.046 97.982,70.494 97.982,62.832C97.982,55.171 100.835,48.619 106.542,43.176C112.248,37.734 119.117,35.013 127.149,35.013C135.18,35.013 142.036,37.734 147.716,43.176C153.396,48.619 156.236,55.171 156.236,62.832ZM136.026,63.863C136.026,61.485 135.154,59.451 133.41,57.76C131.666,56.069 129.579,55.224 127.149,55.224C124.718,55.224 122.631,56.069 120.887,57.76C119.144,59.451 118.272,61.485 118.272,63.863C118.272,66.241 119.144,68.275 120.887,69.966C122.631,71.657 124.718,72.502 127.149,72.502C129.579,72.502 131.666,71.657 133.41,69.966C135.154,68.275 136.026,66.241 136.026,63.863Z" style="fill-rule:nonzero;"/>
                    <path d="M206.961,88.274L189.842,88.274L189.842,85.817L179.38,85.817L179.38,68.698L189.842,68.698L189.842,56.65C184.346,59.398 180.146,63.651 177.24,69.411C174.492,74.748 173.013,81.035 172.801,88.274L154.413,88.274C154.995,74.061 158.878,62.331 166.064,53.084C174.149,42.727 185.113,37.549 198.956,37.549L206.961,37.549L206.961,88.274Z" style="fill-rule:nonzero;"/>
                    <path d="M251.425,88.274L233.909,88.274L233.909,62.278L227.568,62.278L227.568,88.274L210.052,88.274L210.052,37.549L227.568,37.549L227.568,47.694L233.909,47.694L233.909,37.549L251.425,37.549L251.425,88.274Z" style="fill-rule:nonzero;"/>
                    <path d="M326.879,27.166L311.503,48.09L326.007,88.274L303.498,88.274L296.364,68.618L289.944,77.337L289.944,88.274L268.941,88.274L268.941,27.166L289.944,27.166L289.944,43.731L302.15,27.166L326.879,27.166Z" style="fill-rule:nonzero;"/>
                    <path d="M361.911,69.332L348.358,69.332L348.358,56.571L361.911,56.571L361.911,69.332ZM368.965,88.274L328.543,88.274L328.543,37.549L368.965,37.549L368.965,53.242L345.98,53.242L345.98,72.581L368.965,72.581L368.965,88.274Z" style="fill-rule:nonzero;"/>
                    <path d="M423.415,88.274L406.295,88.274L406.295,84.232C405.503,78.103 403.508,72.608 400.311,67.746C397.114,62.885 393.006,59.187 387.987,56.65L387.987,88.274L370.867,88.274L370.867,37.628L378.872,37.549C389.598,37.444 398.739,40.693 406.295,47.298L406.295,37.549L423.415,37.549L423.415,88.274Z" style="fill-rule:nonzero;"/>
                    <rect x="425.476" y="37.549" width="17.437" height="50.725" style="fill-rule:nonzero;"/>
                    <path d="M497.442,88.274L480.322,88.274L480.322,84.232C479.53,78.103 477.535,72.608 474.338,67.746C471.141,62.885 467.033,59.187 462.014,56.65L462.014,88.274L444.894,88.274L444.894,37.628L452.899,37.549C463.625,37.444 472.766,40.693 480.322,47.298L480.322,37.549L497.442,37.549L497.442,88.274Z" style="fill-rule:nonzero;"/>
                </g>
            </g>
        </svg>
      </a>
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
