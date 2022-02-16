<?php

/**
 * WS Theme Includes Readme
 *
 * The $wstheme_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 * To use functions on your .php files, you need to include your lib files using "use" command, for example:
 *
 * use Roots\WStheme\Custom;
 * use Roots\WStheme\ACF;
 *
 * after that, you can request your function with the correct path, in this example case:
 *
 * Custom\myCustomfunction(); or ACF\myAcfFunction(); etc
 *
 * To use a Wordpress Filter, you have to use the __NAMESPACE__ constant like this:
 *
 * add_filter('next_posts_link_attributes',  __NAMESPACE__ . '\\posts_nextlink_attributes');
 *
 * or you'll produce an error.
 *
 * For more informations you can contact mcarlett@websolute.it
 * or read the Namespace section here: roots.io/upping-php-requirements-in-your-wordpress-themes-and-plugins
 * Namespaces structure based on Sage Theme
 *
 * Websolute Rocks!
 *
 */
if ((!empty($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == "https") ||
  (!empty($_SERVER["REQUEST_SCHEME"]) && $_SERVER["REQUEST_SCHEME"] == "https") ||
  $_SERVER['SERVER_PORT'] == 443)
	$_SERVER['HTTPS']='on';

if (! defined('DOCS_DIR')) {
  if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1' ))) {
		$theme = wp_get_theme();
		$protocol = empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off' || $_SERVER['HTTPS'] === 0 ? "http://" : "https://";
		define('DOCS_DIR', $protocol.'localhost:'.$_SERVER['SERVER_PORT'].'/wp-content/themes/'.$theme->template.'/docs/');
  } else {
    define('DOCS_DIR', get_template_directory_uri().'/docs/');
  }
}

if (! defined('DOCS_DIR')) {
  define('DOCS_DIR', get_template_directory_uri().'/docs/');
}

add_theme_support('post-thumbnails');

function aquafil_enqueue_scripts(){
  wp_register_script('websolute_helper', DOCS_DIR . 'js/customizer.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script('websolute_helper');
  wp_localize_script('websolute_helper', 'ws_vars', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
    'docsDir' => DOCS_DIR,
		'post_id' => is_singular() ? get_the_ID() : 0,
		'labels' => array(
			'titolo_contatti' => __("Contatti", "wstheme"),
			'sottotitolo_contatti' => __("Per ulteriori informazioni, contattaci compilando il form sottostante:", "wstheme"),
			'nome' => __("Nome", "wstheme"),
			'cognome' => __("Cognome", "wstheme"),
			'azienda' => __("Azienda", "wstheme"),
			'email' => __("Email", "wstheme"),
			'indirizzo' => __("Indirizzo", "wstheme"),
			'citta' => __("Città", "wstheme"),
			'cap' => __("CAP", "wstheme"),
			'nazione' => __("Nazione", "wstheme"),
			'soggetto' => __("Soggetto", "wstheme"),
			'messaggio' => __("Messaggio", "wstheme"),
			'privacy' => __("Ho letto l'<a href=\"/it/privacy-policy\" target=\"_blank\">informativa</a> e do il consenso al trattamento del dato", "wstheme"),
			'invia' => __("Invia", "wstheme"),
			'inviato' => __("Inviato!", "wstheme")
		)
  ));
}
add_action('wp_enqueue_scripts', 'aquafil_enqueue_scripts', 11);


function setAnchorMenuItem($fg){

	//print_r($fg);
	$output = '';
	$hasAnchor = false;
	foreach($fg as $k => $v){
		if(strstr($k, '_attiva_sticky_item') && $v == 1){
			$hasAnchor = true;
		}
		if(strstr($k, '_label_sticky_item') && $hasAnchor == true){
			$output = '<li class="nav__item"><a href="#'.sanitize_title($v).'" (scrollTo)="\'#'.sanitize_title($v).'\'">'.$v.'</a></li>';
		}
	}

	return $output;
}


function setAnchor($fg){
	$output = '';
	$hasAnchor = false;
	foreach($fg as $k => $v){
    if(strstr($k, '_attiva_sticky_item') && $v == 1){
			$hasAnchor = true;
    }
    if(strstr($k, '_label_sticky_item') && $hasAnchor == true){
			$output = 'id="'.sanitize_title($v).'"';
    }
	}

	return $output;
}


function the_breadcrumb()
{
	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = ''; // delimiter between crumbs
	$home = 'Homepage'; // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<li class="nav__item"><span>'; // tag before the current crumb
	$after = '</span></li>'; // tag after the current crumb

	$output = '';



	global $post;
	$homeLink = get_bloginfo('url');
	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) {
			$output .= '<ul class="nav--breadcrumb"><li class="nav__item"><a class="breadcrumb__list-link link-bold 1" href="' . $homeLink . '">' . $home . '</a></li></ul>';
		}
	} else {
		$output .= '<ul class="nav--breadcrumb"><li class="nav__item"><a class="breadcrumb__list-link link-bold 2" href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
		if (is_category()) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$output .= get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
			}
			$output .= $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
		} elseif (is_search()) {
			$output .= $before . 'Search results for "' . get_search_query() . '"' . $after;
		} elseif (is_day()) {
			$output .= '<li class="nav__item"><a class="breadcrumb__list-link link-bold 3" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			$output .= '<li class="nav__item"><a class="breadcrumb__list-link link-bold 4" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
			$output .= $before . get_the_time('d') . $after;
		} elseif (is_month()) {
			$output .= '<li class="nav__item"><a class="breadcrumb__list-link link-bold 5" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			$output .= $before . get_the_time('F') . $after;
		} elseif (is_year()) {
			$output .= $before . get_the_time('Y') . $after;
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post') { //$output .= get_the_ID();
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				if($post_type->labels->singular_name != "Service" && $post_type->labels->singular_name != "Posizione Lavorativa"){
					$output .= '<li class="nav__item"><a class="breadcrumb__list-link link-bold 6" href="' . $homeLink . '/' . ($post_type->labels->singular_name == 'Case History' ? 'our-xstories' : $slug['slug'] ) . '/">' . ($post_type->labels->singular_name == 'Case History' ? 'xStories' : $post_type->labels->singular_name) . '</a></li>';
				}
				if ($showCurrent == 1) {
					$output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				}
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents($cat->term_id, true, ' ' . $delimiter . ' ');
				if ($showCurrent == 0) {
					$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
				}
				$output .= $cats;
				if ($showCurrent == 1) {
					$output .= $before . get_the_title() . $after;
				}
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			$output .= $before.$post_type->labels->singular_name . $after;
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID);
			$cat = $cat[0];
			$output .= get_category_parents($cat->term_id, true, ' ' . $delimiter . ' ');
			$output .= '<li class="nav__item"><a class="breadcrumb__list-link link-bold 7" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
			if ($showCurrent == 1) {
				$output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			}
		} elseif (is_page() && !$post->post_parent) {
			if ($showCurrent == 1) {
				$output .= $before . get_the_title() . $after;
			}
		} elseif (is_page() && $post->post_parent) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_post($parent_id);
				$breadcrumbs[] = '<li class="nav__item"><a class="breadcrumb__list-link link-bold 8" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				$output .= $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) {
					$output .= ' ' . $delimiter . ' ';
				}
			}
			if ($showCurrent == 1) {
				$output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			}
		} elseif (is_tag()) {
			$output .= $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
		} elseif (is_author()) {
			global $author;
			$userdata = get_userdata($author);
			$output .= $before . 'Articles posted by ' . $userdata->display_name . $after;
		} elseif (is_404()) {
			$output .= $before . 'Error 404' . $after;
		}
		if (get_query_var('paged')) {
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
				$output .= ' (';
			}
			$output .= __('Page') . ' ' . get_query_var('paged');
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
				$output .= ')';
			}
		}
		$output .= '</ul>';
	}



	if (defined('BREADCRUMB')) {
		echo BREADCRUMB;
	}else{
		define('BREADCRUMB', $output);
		echo BREADCRUMB;
	}

} // end the_breadcrumb()


$wstheme_includes = [
'lib/setup.php',           // Scripts and stylesheets
'lib/theme.php',           // Theme setup
'lib/custom.php',          // Custom functions
//'lib/acf.php',             // ACF functions
'lib/woocommerce.php',     // Woocoommerce functions
'lib/wpml.php'             // WPML functions
];

foreach ($wstheme_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'WStheme'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
	acf_add_options_sub_page('Generali');
	acf_add_options_sub_page('404');
}

function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}


function at_more_by_cat($cat_id = '', $limit = 3, $exclusions = null){

	if ($cat_id != '') {
		$args = array(
				'posts_per_page'   => $limit,
				'orderby'          => 'rand',
				'order'            => 'ASC',
				'include'          => '',
				'exclude'          => $exclusions == null ? [] : $exclusions,
				'meta_key'         => '',
				'meta_value'       => '',
				'post_type'        => 'post',
				'post_mime_type'   => '',
				'post_parent'      => '',
				'author'	       => '',
				'author_name'	   => '',
				'post_status'      => 'publish',
				'suppress_filters' => true,
				'fields'           => '',
				'tax_query' => array(
						array(
								'taxonomy' => 'category',
								'field' => 'term_id',
								'terms' => $cat_id
						)
				)
		);
	}

	$posts_array = get_posts( $args );
	$output = [];
	foreach($posts_array as $p){
		array_push($output, $p->ID);
	}

	return $output;
}


// deactivate new block editor until WP supports it entirely
function noblock_widget_area() {
	remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'noblock_widget_area');

function menuParse($menuId){
	$mi = wp_get_nav_menu_items($menuId);
	$mv = [];

	fill_array_menu($mi, $mv);

	return $mv;
}

function fill_array_menu($from, &$to, $search = 0) {
	$items = array_filter($from, function($item) use($search) {
		return $item->menu_item_parent == $search;
	});
	$i=0;
	foreach($items as $item) {
		$to[$i]['label'] = $item->title;
		$to[$i]['url'] = $item->url == '#' ? 'javascript:void(0);' : $item->url;
		$to[$i]['style'] = implode(' ', $item->classes);
		$to[$i]['type'] = $item->type;
		$to[$i]['obj'] = $item->object;
		$to[$i]['id'] = $item->object_id;
		$to[$i]['menu_id'] = $item->ID;
		$to[$i]['target'] = $item->target != '' ? $item->target : '_self';
		$to[$i]['rel'] = $item->xfn;
		$to[$i]['children'] = array();
		$i++;
	}
	foreach($to as $i=>$item) {
		fill_array_menu($from, $to[$i]['children'], $item['menu_id']);
	}
}

function icl_post_languages() {
  if(function_exists('wpml_get_capabilities')) {
		global $sitepress;
		$languages = apply_filters('wpml_active_languages', NULL, 'skip_missing=0&orderby=code&order=asc&link_empty_to='.get_home_url());
		$current = $sitepress->get_language_details(ICL_LANGUAGE_CODE);
    $items = '';
    if($languages && count($languages)>1) {
      $items = '
        <ul class="nav--language">
					<li class="nav__item">';
      $items .= '
						<span (click)="onMenu(5)">
							<span>'.$current["code"].'</span>
							<svg class="down">
								<use xlink:href="#arrow-down"></use>
							</svg>
							<svg class="next">
								<use xlink:href="#arrow-next"></use>
							</svg>
						</span>';
      array_splice($languages, array_search($languages[ICL_LANGUAGE_CODE], array_values($languages)), 1);
      $items .= '
            <ul class="nav--submenu" [class]="{ active: menu == 5 }">';
      foreach($languages as $lng) {
				$items .= '
							<li class="nav__item">
								<a href="'.$lng['url'].'">
									<span>'.$lng["code"].'</span>
								</a>
							</li>';
      }
      $items .= '
							<li class="nav__item back">
								<span (click)="onBack()">
									<svg>
										<use xlink:href="#back"></use>
									</svg><span>'.__("Indietro", "wstheme").'</span>
								</span>
							</li>
						</ul>
          </li>
				</ul>';
    }
    return $items;
  }
  return '';
}

/**
 * Locate template part by relative paths
 * @param array $relativePaths array of relative paths
 * @return string the path to subtemplate if it exists
 */
function locate_template_part($relativePaths) {
		switch(count($relativePaths)) {
			case 5:
				$paths = array(
					'templates/partials/' .implode('/',$relativePaths).'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'/'.$relativePaths[2].'-'.$relativePaths[3].'-'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'/'.$relativePaths[2].'-'.$relativePaths[3].'/'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'-'.$relativePaths[2].'-'.$relativePaths[3].'-'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'-'.$relativePaths[2].'-'.$relativePaths[3].'/'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'/'.$relativePaths[2].'/'.$relativePaths[3].'-'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'/'.$relativePaths[2].'/'.$relativePaths[3].'/'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'/'.$relativePaths[2].'-'.$relativePaths[3].'-'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'/'.$relativePaths[2].'-'.$relativePaths[3].'/'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'-'.$relativePaths[2].'/'.$relativePaths[3].'-'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'-'.$relativePaths[2].'/'.$relativePaths[3].'/'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'-'.$relativePaths[2].'/'.$relativePaths[3].'-'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'-'.$relativePaths[2].'/'.$relativePaths[3].'/'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'-'.$relativePaths[2].'-'.$relativePaths[3].'-'.$relativePaths[4].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'-'.$relativePaths[2].'-'.$relativePaths[3].'/'.$relativePaths[4].'.php'
				);
			break;
			case 4:
				$paths = array(
					'templates/partials/' .implode('/',$relativePaths).'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'/'.$relativePaths[2].'-'.$relativePaths[3].'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'-'.$relativePaths[2].'-'.$relativePaths[3].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'/'.$relativePaths[2].'/'.$relativePaths[3].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'/'.$relativePaths[2].'-'.$relativePaths[3].'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'-'.$relativePaths[2].'/'.$relativePaths[3].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'-'.$relativePaths[2].'/'.$relativePaths[3].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'-'.$relativePaths[2].'-'.$relativePaths[3].'.php'
				);
			break;
			case 3:
				$paths = array(
					'templates/partials/' .implode('/',$relativePaths).'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'/'.$relativePaths[2].'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'-'.$relativePaths[2].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'/'.$relativePaths[2].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'-'.$relativePaths[2].'.php'
				);
			break;
			case 2:
				$paths = array(
					'templates/partials/' .implode('/',$relativePaths).'.php',
					'templates/partials/' .$relativePaths[0] . '/' . $relativePaths[1].'.php',
					'templates/partials/' .$relativePaths[0] . '-' . $relativePaths[1].'.php'
				);
			break;								
			default:
				$paths = array(
					'templates/partials/' .implode('/',$relativePaths).'.php',
					'templates/partials/' .implode('-',$relativePaths).'.php',
				);
		}
		$template = locate_template($paths);
		return $template;
}

function acf_link_target($value, $post_id, $field) {
  if($field["type"] == "link" && is_array($value)) {
    if($value["target"] == '') {
      $value["target"] = "_self";
		}
    if($value["url"] == '#') {
      $value["url"] = "javascript:void();";
		}
	}
    return $value;
}
add_filter( "acf/format_value", "acf_link_target", 10, 3);


/*
 * Endpoints custom per rest API
 */
function custom_rest_route() {
  register_rest_route('aquafil/v1', '/countries/', array(
    'methods' => 'GET',
    'callback' => 'getCountriesData',
    'permission_callback' => '__return_true',
    'args' => array(
			'page' => array(
        'validate_callback' => function($param, $request, $key) {
          return is_numeric($param) && get_post_type(intval($param)) == 'page';
        }
      )
		)
  ));
  register_rest_route('aquafil/v1', '/sales/', array( // /wp-json/aquafil/v1/sales?page=ID
    'methods' => 'GET',
    'callback' => 'getSalesData',
    'permission_callback' => '__return_true',
    'args' => array(
			'page' => array(
        'validate_callback' => function($param, $request, $key) {
          return is_numeric($param) && get_post_type(intval($param)) == 'page';
        }
      )
		)
  ));
  register_rest_route('aquafil/v1', '/careers/', array(
    'methods' => 'GET',
    'callback' => 'getCareesData',
    'permission_callback' => '__return_true',
    'args' => array(
			'page' => array(
        'validate_callback' => function($param, $request, $key) {
          return is_numeric($param) && get_post_type(intval($param)) == 'page';
        }
      )
		)
  ));
}
add_action('rest_api_init', 'custom_rest_route');


function getCountriesData($request) {
  $data = get_transient("countries");
  if($data) {
    return $data;
  }
  $args = array(
    'posts_per_page' => 1,
		'post_type' => 'page',
    'post_status' => 'publish',
		'include' => $request->get_param("page"),
		'fields' => 'ids'
	);
  $post_ids = get_posts($args);
  if(empty($post_ids)) {
		return array();
	}
	$data = array("country" => array("label" => __("Paese", "wstheme"), "options" => array()));
  foreach($post_ids as $post_id) {
		$fields = get_fields($post_id);
		foreach($fields['sezioni'] as $section) {
			if($section['acf_fc_layout'] == 'contacts-contacts-form') {
				$countries = get_field_object('field_620d1cd1b06de');
				foreach($countries['choices'] as $label => $country) {
					array_push($data["country"]["options"], array(
						"value" => $country,
						"label" => $label
					));
				}
				break;
			}
		}
	}
  set_transient("countries", $data);
  return $data;
}


function getSalesData($request) {
  if(!isset($_GET["page"])) 
    return array(
      "code" => "rest_no_route",
      "message" => "page ID param is missing",
      "data" => array("status" => 404)
    );

  $data = get_transient("agents-".$request->get_param("page"));
  if($data) {
    return $data;
  }
  $args = array(
    'posts_per_page' => 1,
		'post_type' => 'page',
    'post_status' => 'publish',
		'include' => $request->get_param("page"),
		'meta_key' => '_wp_page_template',
		'meta_value' => 'templates/sales.php',
		'fields' => 'ids'
	);
  $post_ids = get_posts($args);
  if(empty($post_ids)) {
		return array();
	}
  $data = array("area" => array(), "country" => array("label" => __("Paese", "wstheme"), "options" => array()), "agent" => array());
  foreach($post_ids as $post_id) {
		$fields = get_fields($post_id);
		foreach($fields['sezioni'] as $section) {
			if($section['acf_fc_layout'] == 'sales-sales-list') {
				$areas = get_terms(array(
					'taxonomy' => 'settori-sedi',
					'hide_empty' => false
				));
				foreach($areas as $area) {
					array_push($data["area"], array(
						"value" => $area->slug,
						"label" => $area->name
					));
				}
				$countries = get_field_object('field_6203ae839e81a');
				foreach($countries['choices'] as $label => $country) {
					array_push($data["country"]["options"], array(
						"value" => $country,
						"label" => $label
					));
					foreach($areas as $area) {
						$agents = array_filter($section['agenti'], function($agent) use($country, $area) {
							return $agent['nazione_agente'] == $country && $agent['settore_agente'] == $area;
						});
						if(!empty($agents)) {
							foreach($agents as $agent) {
								array_push($data["agent"], array(
									"name" => $agent["nome_agente"],
									"area" => array(
										"value" => $agent["settore_agente"]->slug,
										"label" => $agent["settore_agente"]->name
									),
									"address" => $agent["indirizzo_agente"],
									"country" => array(
										"value" => $country,
										"label" => $label
									),
									"email" => $agent["email_agente"]
								));
							}
						} else {
							$agents = array_filter($section['agenti_default'], function($agent) use($area) {
								return $agent['settore_agente'] == $area;
							});
							foreach($agents as $agent) {
								array_push($data["agent"], array(
									"name" => $agent["nome_agente"],
									"area" => array(
										"value" => $agent["settore_agente"]->slug,
										"label" => $agent["settore_agente"]->name
									),
									"address" => $agent["indirizzo_agente"],
									"country" => array(
										"value" => $country,
										"label" => $label
									),
									"email" => $agent["email_agente"]
								));
							}
						}
					}
				}
				break;
			}
    }
	}
  set_transient("agents-".$request->get_param("page"), $data);
  return $data;
}


function getCareesData($request) {
  if(!isset($_GET["page"])) 
    return array(
      "code" => "rest_no_route",
      "message" => "page ID param is missing",
      "data" => array("status" => 404)
    );

  $data = get_transient("careers-".$request->get_param("page"));
  if($data) {
    return $data;
  }
  $args = array(
    'posts_per_page' => 1,
		'post_type' => 'page',
    'post_status' => 'publish',
		'include' => $request->get_param("page"),
		'fields' => 'ids'
	);
  $post_ids = get_posts($args);
  if(empty($post_ids)) {
		return array();
	}
	$data = array("country" => array("label" => __("Paese", "wstheme"), "options" => array()), "career" => array());
  foreach($post_ids as $post_id) {
		$fields = get_fields($post_id);
		foreach($fields['sezioni'] as $section) {
			if($section['acf_fc_layout'] == 'careers-careers-list') {
				$countries = get_field_object('field_620a16c4ed727');
				foreach($countries['choices'] as $label => $country) {
					array_push($data["country"]["options"], array(
						"value" => $country,
						"label" => $label
					));
				}
				foreach($section['candidature'] as $career) {
					array_push($data["career"], array(
						"country" => array(
							"value" => $career['nazione_candidatura'],
							"label" => $career['nazione_candidatura']
						)
					));
				}
				break;
			}
		}
	}
  set_transient("careers-".$request->get_param("page"), $data);
  return $data;
}


function on_save_delete_transient($post_ID, $post, $update) {
	if($post->post_type=='page') {
    global $wpdb;
    $query = "
			SELECT option_name
      FROM  ".$wpdb->options."
      WHERE option_name = '_transient_agents-'".$post_ID." OR option_name = '_transient_careers-'".$post_ID.";";
    $result = $wpdb->get_col($query);
    foreach($result as $transient) {
      delete_transient(str_replace('_transient_', '', $transient));
    }
	}
}
add_action('save_post', 'on_save_delete_transient', 10, 3);


function frm_create_custom_contact() {
	if(empty($_POST)) {
    wp_send_json_error(array("result"=>__("C'è stato un problema durante la registrazione della richiesta", "wstheme")));
	}
	if(strpos(current_filter(), "save_contact") !== false) {
		$id = wpml_object_id_filter(22640, 'wpcf7_contact_form', true, ICL_LANGUAGE_CODE);
		$form = WPCF7_ContactForm::get_instance($id);
		$result = $form->submit();
		if($result['status'] == "mail_failed") {
			//$flamingo_contact = Flamingo_Contact::add(array(
			//  'email' => $params['email'],
			//  'name' => $params['firstName'].' '.$params['lastName'],
			//  'last_contacted' => date('Y-m-d H:i:sP'),
			//));
			wp_send_json_error(array('message' => $result['message'], 'response' => __("Errore durante l'invio", "wstheme")));
		} else {
			wp_send_json_success(array('message' => $result['message'], 'response' => __("Richiesta inviata", "wstheme")));
		}
	} elseif(strpos(current_filter(), "save_agent_contact") !== false) {
		$id = wpml_object_id_filter(22465, 'wpcf7_contact_form', true, ICL_LANGUAGE_CODE);
		$form = WPCF7_ContactForm::get_instance($id);
		$result = $form->submit();
		if($result['status'] == "mail_failed") {
			//$flamingo_contact = Flamingo_Contact::add(array(
			//  'email' => $params['email'],
			//  'name' => $params['firstName'].' '.$params['lastName'],
			//  'last_contacted' => date('Y-m-d H:i:sP'),
			//));
			wp_send_json_error(array('message' => $result['message'], 'response' => __("Errore durante l'invio", "wstheme")));
		} else {
			wp_send_json_success(array('message' => $result['message'], 'response' => __("Richiesta inviata", "wstheme")));
		}
	} elseif(strpos(current_filter(), "save_career") !== false) {
		$upload_dir = wp_upload_dir();
		if ( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $_POST['file']['name'];
		}
		else {
			$file = $upload_dir['basedir'] . '/' . $_POST['file']['name'];
		}
		$content = explode(',', $_POST['file']['content']);
		$content = end($content);
		file_put_contents(
			$file,
			base64_decode($content)
		);
		
		$attachment = array(
			'post_mime_type' => $_POST['file']['type'],
			'post_title' => sanitize_file_name($_POST['file']['name']),
			'post_content' => '',
			'post_status' => 'inherit'
		);

		$attach_id = wp_insert_attachment($attachment, $file);
		$attach_data = wp_generate_attachment_metadata($attach_id, $file);
		wp_update_attachment_metadata($attach_id, $attach_data);
		if ($attach_id) {
			file_put_contents(ABSPATH.'error_log.txt', get_the_date("d F Y H:i:s") .PHP_EOL. $attach_id.PHP_EOL. print_r($attachment, true).PHP_EOL , FILE_APPEND | LOCK_EX);
			$_POST['curriculum'] = $upload_dir["url"].'/'.$_POST['file']['name'];
			$id = wpml_object_id_filter(22509, 'wpcf7_contact_form', true, ICL_LANGUAGE_CODE);
			$form = WPCF7_ContactForm::get_instance($id);
			$result = $form->submit();
			if($result['status'] == "mail_failed") {
				wp_send_json_error(array('message' => $result['message'], 'response' => __("Errore durante l'invio", "wstheme")));
			} else {
				wp_send_json_success(array('message' => $result['message'], 'response' => __("Richiesta inviata", "wstheme")));
			}
		} else {
			wp_send_json_error(array('message' => __("Errore durante il salvataggio del file", "wstheme"), 'response' => __("Errore durante l'invio", "wstheme")));
		}
	}
  wp_die();
}
add_action('wp_ajax_save_contact', 'frm_create_custom_contact');
add_action('wp_ajax_nopriv_save_contact', 'frm_create_custom_contact');
add_action('wp_ajax_save_agent_contact', 'frm_create_custom_contact');
add_action('wp_ajax_nopriv_save_agent_contact', 'frm_create_custom_contact');
add_action('wp_ajax_save_career', 'frm_create_custom_contact');
add_action('wp_ajax_nopriv_save_career', 'frm_create_custom_contact');


function set_agent_recipient($components, $form, $mailer) {
	$id = wpml_object_id_filter(22465, 'wpcf7_contact_form', true, ICL_LANGUAGE_CODE);
	if($form->id == $id && sanitize_email($_POST["agent"])) {
		$components['recipient'] = $_POST["agent"];
	}
	return $components;
}
add_filter( 'wpcf7_mail_components', 'set_agent_recipient', 10, 3);


function wpcf7_save_address_book($value, $field, $form) {
	//$id = wpml_object_id_filter(22465, 'wpcf7_contact_form', true, ICL_LANGUAGE_CODE);
	//if($form->id == $id) {
		switch($value) {
			case "[your-email]":
				$value = $_POST["email"];
				break;
			case "[your-name]":
				$value = $_POST["firstName"].' '.$_POST["lastName"];
				break;
			case "[your-subject]":
				$value = isset($_POST["subject"]) ? $_POST["subject"] : __($form->title, "wstheme");
				break;
			default:;
		}
	//}
	return $value;
}
add_filter('wpcf7_flamingo_get_value', 'wpcf7_save_address_book', 10, 3);
