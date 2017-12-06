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
  <div class="container">
  <div class="row">
    <div class="col-md-6 text-left">
      <img src="<?php the_field('logo', 'options'); ?>" />
    </div>
    <div class="col-md-6 text-right">
      <ul>
        <li><?php the_field('address', 'options'); ?></li>
        <li><?php the_field('phone_number', 'options'); ?></li>
        <li><?php the_field('email', 'options'); ?></li>
      </ul>
    </div>
  </div>
</div>

      <nav class="site-nav">
        <div class="mini-nav">
          <div class="w">
            <?php wp_nav_menu(array('theme_location' => 'mini-nav')); ?>
          </div>
        </div>
        <div class="main-nav">
          <div class="w">
            <?php wp_nav_menu(array('theme_location' => 'main-nav')); ?>
            <ul id="home-url">
              <li>
                <a class="home-link" href="<?php echo $home_url; ?>"><span>Home</span></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

