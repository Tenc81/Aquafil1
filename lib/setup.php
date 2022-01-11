<?php

namespace Roots\WStheme\Setup;


/*--------------------------------------------------
Inclusione JQUERY
--------------------------------------------------*/
function switch_jquery(){
    if ( !is_admin() ){
        wp_deregister_script('jquery');
        wp_register_script('jquery', ( get_template_directory_uri() . '/dist/js/jquery-2.1.1.min.js'), null, '2.1.1', false);
        wp_enqueue_script('jquery');
        wp_register_script( 'vendor', get_template_directory_uri() . '/dist/js/vendor.min.js', null, '1.0', true );
        wp_enqueue_script( 'vendor' );
    }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\switch_jquery', 1);

