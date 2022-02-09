<?php
namespace Roots\WStheme\Setup;


function register_cposts_taxonomies() {
	$args = array(
		'labels'    => array(
			'name'           => 'Sedi',
			'singular_name'  => 'Sede',
			'menu_name'      => 'Sedi',
			'add_new'        => 'Aggiungi sede',
			'all_items'      => 'Tutte le sedi',
			'edit_item'      => 'Modifica sede',
			'add_new_item'   => 'Crea nuova sede',
			'new_item'       => 'Nuova sede',
			'new_item_name'  => 'Nome nuova sede',
			'view_item'      => 'Visualizza sede',
			'update_item'    => 'Aggiorna sede',
			'search_items'   => 'Cerca sede',
			'not_found'      => 'Nessuna sede trovata'
		),
		'show_in_rest' => true, // necessario per WP5
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-location',
		'menu_position' => 20,
		'has_archive' => true,
		'hierarchical' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'supports' => array('title', 'thumbnail'),
	);
	register_post_type("sedi", $args);
	
	unset($args);

	$args = array(
		'labels' => array(
			'name' => 'Settori',
			'singular_name' => 'Settore',
			'menu_name' => 'Settori',
			'all_items' => 'Tutti i settori',
			'edit_item' => 'Modifica settore',
			'view_item' => 'Visualizza settore',
			'update_item' => 'Aggiorna settore',
			'add_new_item' => 'Aggiungi nuovo settore',
			'new_item_name' => 'Nome nuovo settore'
		),
		'hierarchical' => true,
		'show_admin_column' => true,
		'capabilities' => array(
			'manage_terms' => 'manage_categories',
			'edit_terms'   => 'edit_categories',
			'delete_terms' => 'delete_categories',
			'assign_terms' => 'assign_categories'
		),
		'show_in_rest' => true, // necessario per WP5
		//'rest_base' => 'trasporti',
		//'rest_controller_class' => 'WP_REST_Terms_Controller',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'update_count_callback' => '_update_generic_term_count'
	);
	register_taxonomy("settori-sedi", array("sedi"), $args);

	$args = array(
		'labels' => array(
			'name' => 'Nazioni',
			'singular_name' => 'Nazione',
			'menu_name' => 'Nazioni',
			'all_items' => 'Tutte le nazioni',
			'edit_item' => 'Modifica nazione',
			'view_item' => 'Visualizza nazione',
			'update_item' => 'Aggiorna nazione',
			'add_new_item' => 'Aggiungi nuova nazione',
			'new_item_name' => 'Nome nuova nazione'
		),
		'hierarchical' => true,
		'show_admin_column' => true,
		'capabilities' => array(
			'manage_terms' => 'manage_categories',
			'edit_terms'   => 'edit_categories',
			'delete_terms' => 'delete_categories',
			'assign_terms' => 'assign_categories'
		),
		'show_in_rest' => true, // necessario per WP5
		//'rest_base' => 'trasporti',
		//'rest_controller_class' => 'WP_REST_Terms_Controller',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'update_count_callback' => '_update_generic_term_count'
	);
	register_taxonomy("nazione-sedi", array("sedi"), $args);
}
add_action('init', __NAMESPACE__ . '\\register_cposts_taxonomies');


/*--------------------------------------------------
Inclusione JQUERY
--------------------------------------------------*/
function switch_jquery(){
    if ( !is_admin() ){
        wp_deregister_script('jquery');
        wp_register_script('jquery', ( get_template_directory_uri() . '/dist/js/jquery-2.1.1.min.js'), array(), '2.1.1', false);
        wp_enqueue_script('jquery');
        wp_register_script( 'vendor', get_template_directory_uri() . '/dist/js/vendor.min.js', array(), '1.0', true );
        wp_enqueue_script( 'vendor' );
    }
}
//add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\switch_jquery', 1);

