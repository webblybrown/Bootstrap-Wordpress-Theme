<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
<!--[if lt IE 9]>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <header>
  <div class="container">
  <div class="row">
    <div class="col-md-6 text-left">
      <a href="<?php echo site_url(); ?>"><img src="<?php the_field('logo', 'options'); ?>" class="wow fadeInDown" /></a>
    </div>
    <div class="col-md-6 text-right">
      <ul>
        <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php the_field('address', 'options'); ?></li>
        <li><i class="fa fa-phone" aria-hidden="true"></i> <?php the_field('phone_number', 'options'); ?></li>
        <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a></li>
      </ul>
    </div>
  </div>
</div>
</header>
      <nav class="site-nav">
        <div class="mini-nav">
          <div class="w">
            <?php wp_nav_menu(array('theme_location' => 'mini-nav')); ?>
          </div>
        </div>
        </div>
      </nav>
  <nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
</div>

    <div class="nav-walker">
        <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
            );
        ?>
    </div>
    </div>
</nav>



