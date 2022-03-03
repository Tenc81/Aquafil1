<?php
namespace Roots\WStheme\Setup;


function register_cposts_taxonomies() {
	$args = array(
		'labels'    => array(
			'name'           => 'Articoli localizzati',
			'singular_name'  => 'Articolo localizzato',
			'menu_name'      => 'Local News',
			'add_new'        => 'Aggiungi Local News',
			'all_items'      => 'Tutte le Local News',
			'edit_item'      => 'Modifica Local News',
			'add_new_item'   => 'Crea nuova Local News',
			'new_item'       => 'Nuova Local News',
			'new_item_name'  => 'Nome nuova Local News',
			'view_item'      => 'Visualizza Local News',
			'update_item'    => 'Aggiorna Local News',
			'search_items'   => 'Cerca Local News',
			'not_found'      => 'Nessuna Local News'
		),
		'show_in_rest' => true, // necessario per WP5
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-admin-site-alt',
		'menu_position' => 5,
		'has_archive' => false,
		'hierarchical' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'supports' => array('title', 'thumbnail'),
	);
	register_post_type("localnews", $args);

	unset($args);

	$args = array(
		'labels'    => array(
			'name'           => 'Investor Relations',
			'singular_name'  => 'Pagina di Investor Relations',
			'menu_name'      => 'Sezione Investor Relations',
			'add_new'        => 'Aggiungi pagina di Investor Relations',
			'all_items'      => 'Tutte le pagine di Investor Relations',
			'edit_item'      => 'Modifica pagina di Investor Relations',
			'add_new_item'   => 'Crea nuova pagina di Investor Relations',
			'new_item'       => 'Nuova pagina di Investor Relations',
			'new_item_name'  => 'Nome nuova pagina di Investor Relations',
			'view_item'      => 'Visualizza pagina di Investor Relations',
			'update_item'    => 'Aggiorna pagina di Investor Relations',
			'search_items'   => 'Cerca pagina di Investor Relations',
			'not_found'      => 'Nessuna pagina di Investor Relations trovata'
		),
		'show_in_rest' => true, // necessario per WP5
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-chart-line',
		'menu_position' => 20,
		'has_archive' => false,
		'hierarchical' => true,
		'query_var' => true,
		'capability_type' => 'page',
		'capabilities' => array(
			'edit_post' => 'edit_investor_relation',
			'read_post' => 'read_investor_relation',
			'delete_post' => 'delete_investor_relation',
      'edit_posts' => 'edit_investor_relations',
      'edit_others_posts' => 'edit_others_investor_relations',
      'delete_posts' => 'delete_investor_relations',
      'publish_posts' => 'publish_investor_relations',
      'read_private_posts' => 'read_private_investor_relations',
			//'read' => 'read_investor_relation',
      'delete_private_posts' => 'delete_private_investor_relations',
      'delete_published_posts' => 'delete_published_investor_relations',
      'delete_others_posts' => 'delete_others_investor_relations',
      'edit_private_posts' => 'edit_private_investor_relations',
      'edit_published_posts' => 'edit_published_investor_relations'
		),
		'supports' => array('title', 'thumbnail', 'page-attributes'),
	);
	register_post_type("investor-relations", $args);

	unset($args);

	$args = array(
		'labels'    => array(
			'name'           => 'Corporate Governance',
			'singular_name'  => 'Pagina di Corporate Governance',
			'menu_name'      => 'Sezione Corporate Governance',
			'add_new'        => 'Aggiungi pagina di Corporate Governance',
			'all_items'      => 'Tutte le pagine di Corporate Governance',
			'edit_item'      => 'Modifica pagina di Corporate Governance',
			'add_new_item'   => 'Crea nuova pagina di Corporate Governance',
			'new_item'       => 'Nuova pagina di Corporate Governance',
			'new_item_name'  => 'Nome nuova pagina di Corporate Governance',
			'view_item'      => 'Visualizza pagina di Corporate Governance',
			'update_item'    => 'Aggiorna pagina di Corporate Governance',
			'search_items'   => 'Cerca pagina di Corporate Governance',
			'not_found'      => 'Nessuna pagina di Corporate Governance trovata'
		),
		'show_in_rest' => true, // necessario per WP5
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-groups',
		'menu_position' => 21,
		'has_archive' => false,
		'hierarchical' => true,
		'query_var' => true,
		'capability_type' => 'page',
		'capabilities' => array(
			'edit_post' => 'edit_corporate_governance',
			'read_post' => 'read_corporate_governance',
			'delete_post' => 'delete_corporate_governance',
      'edit_posts' => 'edit_corporate_governances',
      'edit_others_posts' => 'edit_others_corporate_governances',
      'delete_posts' => 'delete_corporate_governances',
      'publish_posts' => 'publish_corporate_governances',
      'read_private_posts' => 'read_private_corporate_governances',
			//'read' => 'read_investor_relation',
      'delete_private_posts' => 'delete_private_corporate_governances',
      'delete_published_posts' => 'delete_published_corporate_governances',
      'delete_others_posts' => 'delete_others_corporate_governances',
      'edit_private_posts' => 'edit_private_corporate_governances',
      'edit_published_posts' => 'edit_published_corporate_governances'
		),
		'supports' => array('title', 'thumbnail', 'page-attributes'),
	);
	register_post_type("corporate-governance", $args);

	unset($args);

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
		'menu_position' => 30,
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
			'name' => 'Categorie Local News',
			'singular_name' => 'Categoria Local News',
			'menu_name' => 'Categorie Local News',
			'all_items' => 'Tutti le Categorie Local News',
			'edit_item' => 'Modifica Categoria Local News',
			'view_item' => 'Visualizza Categoria Local News',
			'update_item' => 'Aggiorna Categoria Local News',
			'add_new_item' => 'Aggiungi nuova Categoria Local News',
			'new_item_name' => 'Nome nuova Categoria Local News'
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
	register_taxonomy("localnews_category", array("localnews"), $args);

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

