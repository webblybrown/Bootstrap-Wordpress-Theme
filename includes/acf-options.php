<?php
if(function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title' => 'Site Options',
    'menu_title' => 'Site Options',
    'menu_slug' => 'site-options',
    'capability' => 'edit_posts',
    'redirect' => false
  ]);
  acf_add_options_sub_page([
    'page_title' => 'Example',
    'menu_title' => 'Example',
    'parent_slug' => 'site-options',
    'capability' => 'manage_options'
  ]);


  function acf_show_admin() {
    return current_user_can('manage_options');
  }
  add_filter('acf/settings/show_admin', 'acf_show_admin');
}
