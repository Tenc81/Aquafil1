<?php
namespace Roots\WStheme\Theme;

/*---------------------------------------------------
Register Custom Menus
--------------------------------------------------*/
register_nav_menus( array(
    'main_menu' => 'Menù principale su header',
    'secondary_menu' => 'Menù secondario su header',
    'footer_menu' => 'Menù secondario su footer',
) );


/*---------------------------------------------------
Register Sidebar
--------------------------------------------------*/
function widgets_init() {
    register_sidebar([
      'name'          => __('Primary', 'wstheme'),
      'id'            => 'sidebar-primary',
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
    ]);

    register_sidebar([
      'name'          => __('Footer', 'wstheme'),
      'id'            => 'sidebar-footer',
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
    ]);

    register_sidebar([
      'name'          => __('Corporate data', 'wstheme'),
      'id'            => 'corporate-widget',
      'before_widget' => '<div class="col-sm-10 offset-sm-2">',
      'after_widget'  => '</div>',
      'before_title'  => '',
      'after_title'   => ''
    ]);

    register_sidebar([
      'name'          => __('Social', 'wstheme'),
      'id'            => 'social-widget',
      'before_widget' => '<div class="col-sm-20 offset-sm-2 offset-md-0 col-md-2">',
      'after_widget'  => '</div>',
      'before_title'  => '',
      'after_title'   => ''
    ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');
?>
