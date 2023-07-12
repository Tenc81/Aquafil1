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

function __custom($text, $domain) {
	global $wpdb;
	$query = "
		SELECT st.value FROM wp_icl_string_translations st JOIN wp_icl_strings s
		ON st.string_id=s.id
		AND s.value='".$text."' AND s.context='".$domain."' AND st.language='".ICL_LANGUAGE_CODE."' LIMIT 1";
	$label = $wpdb->get_var($query);
	$label = $label == '' ? $text : $label;
	return $label;
}

/*--------------------------------------------------
Path uploads
--------------------------------------------------*/
function wp_cdn_upload_url($args) {
    if (!is_admin()) {
        $args['baseurl'] = WP_CDNURL;
    }
    return $args;
}
add_filter('upload_dir', 'wp_cdn_upload_url');

//if (! defined('DOCS_DIR')) {
//  define('DOCS_DIR', get_template_directory_uri().'/docs/');
//}

add_theme_support('post-thumbnails');

function aquafil_enqueue_scripts() {
	wp_enqueue_style('aquafil-style', get_stylesheet_uri(), array());

	//wp_register_script('websolute_helper', DOCS_DIR . 'js/customizer.js', array('jquery'), '1.0.0', true );
	//wp_enqueue_script('websolute_helper');
  wp_localize_script('jquery', 'ws_vars', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'docsDir' => DOCS_DIR,
		'post_id' => is_singular() ? get_the_ID() : 0
  ));
  wp_localize_script('jquery', 'environment', array(
		'flags' => array(
			'production' => true,
		),
		'api' => '',
		'assets' => DOCS_DIR,
		'template' => array(
			'modal' => array(
				'genericModal' => WP_CONTENT_URL.'/themes/aquafil/templates/partials/modals/generic-modal.html',
				'sideModal' => WP_CONTENT_URL.'/themes/aquafil/templates/partials/modals/side-modal.html',
				'contactModal' => WP_CONTENT_URL.'/themes/aquafil/templates/partials/modals/contact-modal.html',
				'salesModal' => WP_CONTENT_URL.'/themes/aquafil/templates/partials/modals/sales-modal.html',
				'galleryModal' => WP_CONTENT_URL.'/themes/aquafil/templates/partials/modals/gallery-modal.html',
				'userModal' => WP_CONTENT_URL.'/themes/aquafil/templates/partials/modals/user-modal.html',
				'productRequestModal' => WP_CONTENT_URL.'/themes/aquafil/templates/partials/modals/product-request-modal.html'
			)
		),
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
			'privacy' => get_the_ID() == 31744 || get_the_ID() == 24299 ? "<p>Seznanjen <a href=\"/assets/uploads/01-IZJAVA-O-ZASEBNOSTI-ZA-E-NOVICE.pdf\" target=\"_blank\">sem z načinom upravljanja z mojim e-naslovom</a> in se strinjam s prijavo na prejemanje Novičnika.</p>(*) S posredovanjem naslova elektronske pošte soglašam, da AquafilSLO Proizvodnja poliamidnih filamentov in granulatov d.o.o. in Aquafil S.p.A. moj elektronski naslov uporabljata za namene obveščanja o novostih. Seznanjen sem, da se lahko iz sistema sporočil kadarkoli izpišem, in sicer tako, da v poslanem elektronskem sporočilu kliknem na označeno povezavo." : 
        __("<p>Ho letto l'<a href=\"/it/privacy-policy\" target=\"_blank\">informativa</a> e do il consenso al trattamento del dato </p>(*) In ottemperanza alla legge 196/03 La informiamo che i dati personali da Lei forniti verranno registrati nel nostro archivio elettronico e/o server sicuro con mezzi manuali, elettronici o telefonici e trattati in modo riservato da Aquafil S.p.A. nel rispetto delle norme in vigore.", "wstheme"),
			'invia' => __("Invia", "wstheme"),
			'inviato' => get_the_ID() == 31744 || get_the_ID() == 24299 ? "Zahteva poslana" : __("Richiesta inviata", "wstheme"),
			'select' => __("Seleziona", "wstheme"),
			'error_required' => __("campo obbligatorio", "wstheme"),
			'select_file' => __("Seleziona un file (max 15 Mb)", "wstheme")
		)
  ));
}
add_action('wp_enqueue_scripts', 'aquafil_enqueue_scripts', 11);


function setAnchorMenuItem($fg){

	//print_r($fg);
	$output = '';
	$hasAnchor = false;
	foreach($fg as $k => $v){
		if(is_array($v)) {
			$output .= setAnchorMenuItem($v);
		} else {
			if(strstr($k, '_attiva_sticky_item') && $v == 1){
				$hasAnchor = true;
			}
			if(strstr($k, '_label_sticky_item') && $hasAnchor == true){
				$output = '<li class="nav__item"><a href="#'.sanitize_title($v).'" (scrollTo)="\'#'.sanitize_title($v).'\'">'.$v.'</a></li>';
			}
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
			break;
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
	$homeLink = home_url('/');
	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) {
			$output .= '<ul class="nav--breadcrumb"><li class="nav__item"><a href="' . $homeLink . '">' . $home . '</a></li></ul>';
		}
	} else {
		$output .= '<ul class="nav--breadcrumb"><li class="nav__item"><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
		if (is_category()) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$output .= $before.get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' '). $after;
			}
			$output .= $before . single_cat_title('', false) . $after;
		} elseif (is_search()) {
			$output .= $before . 'Search results for "' . get_search_query() . '"' . $after;
		} elseif (is_day()) {
			$output .= '<li class="nav__item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			$output .= '<li class="nav__item"><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
			$output .= $before . get_the_time('d') . $after;
		} elseif (is_month()) {
			$output .= '<li class="nav__item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			$output .= $before . get_the_time('F') . $after;
		} elseif (is_year()) {
			$output .= $before . get_the_time('Y') . $after;
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post' && get_post_type() != 'localnews') { //$output .= get_the_ID();
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				if($post_type->has_archive && $post_type->labels->singular_name != "Service" && $post_type->labels->singular_name != "Posizione Lavorativa"){
					$output .= '<li class="nav__item"><a href="' . $homeLink . ($post_type->labels->singular_name == 'Case History' ? 'our-xstories' : __($slug['slug'], "WordPress") ) . '/">' . ($post_type->labels->singular_name == 'Case History' ? 'xStories' : ucfirst(__(strtolower($post_type->labels->name), "WordPress"))) . '</a></li>';
				}
				if ($showCurrent == 1) {
					$output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				}
			} else {
				$cat = get_the_category();
				if(!empty($cat)) {
					$cat = $cat[0];
					$cats = get_category_parents($cat->term_id, true, ' ' . $delimiter . ' ');
					if ($showCurrent == 0) {
						$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
					}
					$cats = str_replace("</a> " . $delimiter . " <a", "</a> " . $after.$before . " <a", $cats);
					$output .= $before.$cats.$after;
				}
				if ($showCurrent == 1) {
					$output .= $before . get_the_title() . $after;
				}
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			$output .= $before.ucfirst(__(strtolower($post_type->labels->name), "WordPress")) . $after;
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID);
			$cat = $cat[0];
			$output .= get_category_parents($cat->term_id, true, ' ' . $delimiter . ' ');
			$output .= '<li class="nav__item"><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
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
				$breadcrumbs[] = '<li class="nav__item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
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
				'orderby'          => 'date',
				'order'            => 'DESC',
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
						<span (click)="onMenu(100)">
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
            <ul class="nav--submenu" [class]="{ active: menu == 100 }">';
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
									<svg class="back"><use xlink:href="#arrow-back"></use></svg><span>'.__("Indietro", "wstheme").'</span>
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


function blogpage_active_languages($active_languages, $filters) {
	if(is_home()) {
		$id = get_queried_object_id();
		foreach($active_languages as $lang=>$active_language) {
			$trid = apply_filters('wpml_object_id', $id, 'page', false, $lang);
			if($trid) {
				$active_languages[$lang]["url"] = get_permalink($trid);
			}
		}
	}
	return $active_languages;
}
add_filter('wpml_active_languages', 'blogpage_active_languages', 10, 2);

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


function my_acf_format_value($value, $post_id, $field) {
	if($field["type"] == "link" && is_array($value)) {
    if($value["target"] == '') {
      $value["target"] = "_self";
		}
    if($value["url"] == '#') {
      $value["url"] = "javascript:void();";
		}
	} elseif($field['type'] == "url" && ($value == '' || $value == '#')) {
		$value = 'javascript:void(0);';
	}
	return $value;
}
add_filter('acf/format_value/type=link', 'my_acf_format_value', 10, 3);
add_filter('acf/format_value/type=url', 'my_acf_format_value', 10, 3);


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
          return is_numeric($param) && ('publish' == get_post_status ($param) || 'draft' == get_post_status ($param));
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
          return is_numeric($param) && 'publish' == get_post_status ($param);
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
          return is_numeric($param) && 'publish' == get_post_status ($param);
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
      WHERE option_name = '_transient_agents-".$post_ID."' OR option_name = '_transient_careers-".$post_ID."';";
    $result = $wpdb->get_col($query);
    foreach($result as $transient) {
      delete_transient(str_replace('_transient_', '', $transient));
    }
	}
}
add_action('save_post', 'on_save_delete_transient', 10, 3);


function frm_create_custom_contact() {
	global $wpdb;
	$query = "
		SELECT st.value
		FROM wp_icl_strings s JOIN wp_icl_string_translations st
		ON st.string_id=s.id
		WHERE s.context='wstheme' AND s.value=%s AND st.language='".$_COOKIE["wp-wpml_current_language"]."'";

	if(empty($_POST)) {
		$s0 = $wpdb->get_col($wpdb->prepare($query, "C'è stato un problema durante la registrazione della richiesta"));
		$values = array_filter(array(
			'msgerror' => is_null($s0) ? '' : __($s0, "wstheme"),
			), function($s) {
			return $s != '';
		});
		$strings = wp_parse_args(
			$values,
			array('msgerror' => __("C'è stato un problema durante la registrazione della richiesta", "wstheme"))
		);
    wp_send_json_error(array("result"=> $strings['msgerror']));
	}
	if(strpos(current_filter(), "save_contact") !== false) {
		$form = WPCF7_ContactForm::get_instance(22640);
		$result = $form->submit();

		$default = array(
			'msg' => __($result['message'], "wstheme"),
			'error' => __("Errore durante l'invio", "wstheme"),
			'sent' => __("Richiesta inviata", "wstheme")
		);
		$s1 = $wpdb->get_var($wpdb->prepare($query, $result['message']));
		$s2 = $wpdb->get_var($wpdb->prepare($query, "Errore durante l'invio"));
		$s3 = $wpdb->get_var($wpdb->prepare($query, "Richiesta inviata"));
		$values = array_filter(array(
				'msg' => is_null($s1) ? '' : __($s1, "wstheme"),
				'error' => is_null($s2) ? '' : __($s2, "wstheme"),
				'sent' => is_null($s3) ? '' : __($s3, "wstheme")
			), function($s) {
			return $s != '';
		});
		$strings = wp_parse_args(
			$values,
			$default
		);

		if($result['status'] == "mail_failed") {
			//$flamingo_contact = Flamingo_Contact::add(array(
			//  'email' => $params['email'],
			//  'name' => $params['firstName'].' '.$params['lastName'],
			//  'last_contacted' => date('Y-m-d H:i:sP'),
			//));
			wp_send_json_error(array('message' => $strings['msg'], 'response' => $strings['error']));
		} else {
			wp_send_json_success(array('message' => $strings['msg'], 'response' => $strings['sent']));
		}
	} elseif(strpos(current_filter(), "save_agent_contact") !== false) {
		$form = WPCF7_ContactForm::get_instance(22465);
		$result = $form->submit();

		$default = array(
			'msg' => __($result['message'], "wstheme"),
			'error' => __("Errore durante l'invio", "wstheme"),
			'sent' => __("Richiesta inviata", "wstheme")
		);
		$s1 = $wpdb->get_var($wpdb->prepare($query, $result['message']));
		$s2 = $wpdb->get_var($wpdb->prepare($query, "Errore durante l'invio"));
		$s3 = $wpdb->get_var($wpdb->prepare($query, "Richiesta inviata"));
		$values = array_filter(array(
				'msg' => is_null($s1) ? '' : __($s1, "wstheme"),
				'error' => is_null($s2) ? '' : __($s2, "wstheme"),
				'sent' => is_null($s3) ? '' : __($s3, "wstheme")
			), function($s) {
			return $s != '';
		});
		$strings = wp_parse_args(
			$values,
			$default
		);

		if($result['status'] == "mail_failed") {
			wp_send_json_error(array('message' => $strings['msg'], 'response' => $strings['error']));
		} else {
			wp_send_json_success(array('message' => $strings['msg'], 'response' => $strings['sent']));
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
			//file_put_contents(ABSPATH.'error_log.txt', get_the_date("d F Y H:i:s") .PHP_EOL. $attach_id.PHP_EOL. print_r($attachment, true).PHP_EOL , FILE_APPEND | LOCK_EX);
			$_POST['curriculum'] = $upload_dir["url"].'/'.$_POST['file']['name'];
			$form = WPCF7_ContactForm::get_instance(22509);
			$result = $form->submit();

			$default = array(
				'msg' => __($result['message'], "wstheme"),
				'error' => __("Errore durante l'invio", "wstheme"),
				'sent' => __("Richiesta inviata", "wstheme")
			);
			$s1 = $wpdb->get_var($wpdb->prepare($query, $result['message']));
			$s2 = $wpdb->get_var($wpdb->prepare($query, "Errore durante l'invio"));
			$s3 = $wpdb->get_var($wpdb->prepare($query, "Richiesta inviata"));
			$values = array_filter(array(
					'msg' => is_null($s1) ? '' : __($s1, "wstheme"),
					'error' => is_null($s2) ? '' : __($s2, "wstheme"),
					'sent' => is_null($s3) ? '' : __($s3, "wstheme")
				), function($s) {
				return $s != '';
			});
			$strings = wp_parse_args(
				$values,
				$default
			);

			if($result['status'] == "mail_failed") {
				wp_send_json_error(array('message' => $strings['msg'], 'response' => $strings['error']));
			} else {
				wp_send_json_success(array('message' => $strings['msg'], 'response' => $strings['sent']));
			}
		} else {

			$default = array(
				'error' => __("Errore durante l'invio", "wstheme"),
				'errorsave' => __("Errore durante il salvataggio del file", "wstheme")
			);
			$s2 = $wpdb->get_var($wpdb->prepare($query, "Errore durante l'invio"));
			$s4 = $wpdb->get_var($wpdb->prepare($query, "Errore durante il salvataggio del file"));
			$values = array_filter(array(
					'error' => is_null($s2) ? '' : __($s2, "wstheme"),
					'errorsave' => is_null($s4) ? '' : __($s4, "wstheme")
				), function($s) {
				return $s != '';
			});
			$strings = wp_parse_args(
				$values,
				$default
			);

			wp_send_json_error(array('message' => $strings['errorsave'], 'response' => $strings['error']));
		}
	} elseif(strpos(current_filter(), "save_product_request") !== false) {
		$form = WPCF7_ContactForm::get_instance(23293);
		$result = $form->submit();

		$default = array(
			'msg' => __($result['message'], "wstheme"),
			'error' => __("Errore durante l'invio", "wstheme"),
			'sent' => __("Richiesta inviata", "wstheme"),
			'download' => __("Clicca su <FONT COLOR='#00aced'>%s</FONT> per scaricare il documento.", "wstheme")
		);
		$s1 = $wpdb->get_var($wpdb->prepare($query, $result['message']));
		$s2 = $wpdb->get_var($wpdb->prepare($query, "Errore durante l'invio"));
		$s3 = $wpdb->get_var($wpdb->prepare($query, "Richiesta inviata"));
		$s4 = $wpdb->get_var($wpdb->prepare($query, "Clicca su <FONT COLOR='#00aced'>%s</FONT> per scaricare il documento."));
		$values = array_filter(array(
				'msg' => is_null($s1) ? '' : __($s1, "wstheme"),
				'error' => is_null($s2) ? '' : __($s2, "wstheme"),
				'sent' => is_null($s3) ? '' : __($s3, "wstheme"),
				'download' => is_null($s4) ? '' : __($s4, "wstheme")
			), function($s) {
			return $s != '';
		});
		$strings = wp_parse_args(
			$values,
			$default
		);

		if($result['status'] == "mail_failed") {
			wp_send_json_error(array('message' => $strings['msg'], 'response' => $strings['error']));
		} else {
			$download = isset($_POST['download']) && !empty($_POST['download']) ? sprintf('<br /><br />'.$strings['download'], '<a href="'.$_POST['download'].'" target="_blank">download</a>') : '';
			wp_send_json_success(array('message' => $strings['msg'].$download, 'response' => $strings['sent']));
		}
	} elseif(strpos(current_filter(), "subscribe_newsletter") !== false) {
		$form = WPCF7_ContactForm::get_instance(35220);
    foreach($_POST as $key=>$value) {
      switch($key) {
        case "email":
          unset($_POST["email"]);
          $_POST["EMAIL"] = $value;
          break;
        case "job":
          $_POST["YOUR-PROFESSIONE"] = $value;
          break;
        case "language":
          $_POST["YOUR-LINGUA"] = $value;
          break;
        case "privacy":
          $_POST["YOUR-OPT_IN_1"] = $value == "true" ? "Checked" : '';
          break;
        default:;
      }
    }
		$result = $form->submit();

		$default = array(
			'msg' => __($result['message'], "wstheme"),
			'error' => __("Errore durante l'invio", "wstheme"),
			'sent' => __("Richiesta inviata", "wstheme")
		);
		$s1 = $wpdb->get_var($wpdb->prepare($query, $result['message']));
		$s2 = $wpdb->get_var($wpdb->prepare($query, "Errore durante l'invio"));
		$s3 = $wpdb->get_var($wpdb->prepare($query, "Richiesta inviata"));
		$values = array_filter(array(
				'msg' => is_null($s1) ? '' : __($s1, "wstheme"),
				'error' => is_null($s2) ? '' : __($s2, "wstheme"),
				'sent' => is_null($s3) ? '' : __($s3, "wstheme")
			), function($s) {
			return $s != '';
		});
		$strings = wp_parse_args(
			$values,
			$default
		);

    if($_POST["YOUR-LINGUA"] == "sl") {
      if($result['status'] == "mail_failed") {
        $string['error'] = "Napaka med pošiljanjem.";
        $strings['msg'] = "Med pošiljanjem je prišlo do napake. Poskusite kasneje.";
      } else {
        $string['sent'] = "Zahteva poslana";
        $strings['msg'] = "Hvala, prejeli smo vašo zahtevo.";
      }
    }
		if($result['status'] == "mail_failed") {
			wp_send_json_error(array('message' => $strings['msg'], 'response' => $strings['error']));
		} else {
			wp_send_json_success(array('message' => $strings['msg'], 'response' => $strings['sent']));
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
add_action('wp_ajax_save_product_request', 'frm_create_custom_contact');
add_action('wp_ajax_nopriv_save_product_request', 'frm_create_custom_contact');
add_action('wp_ajax_subscribe_newsletter', 'frm_create_custom_contact');
add_action('wp_ajax_nopriv_subscribe_newsletter', 'frm_create_custom_contact');


function set_agent_recipient($components, $form, $mailer) {
	if($form->id == 22465 && sanitize_email($_POST["agent"])) {
		$components['recipient'] = $_POST["agent"];
	} elseif($form->id == 23293 && sanitize_email($_POST["recipient"])) {
		$components['recipient'] = $_POST["recipient"];
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
				$value = isset($_POST["your-name"]) ? $_POST["your-name"] : $_POST["firstName"].' '.$_POST["lastName"];
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


/**
 * Crea un nuovo ruolo utente WP
 */
function create_new_user_role() {
  global $wp_roles;
  if (!isset($wp_roles)) $wp_roles = new WP_Roles();

  $caps = $wp_roles->get_role("subscriber")->capabilities;  
  $caps["upload_files"] = 1;
  
  /**
   * per aggiornare le capabilities di un ruolo 
   * 
   */
  // global $wp_roles;
  // $wp_roles->remove_role('editor-ir');

  if(get_role('editor-ir') == null) {
		add_role(
			"editor-ir",
			"Editor IR e CG",
			$caps
		);
	}
}
add_action('admin_init', 'create_new_user_role', 10);


function ir_user_caps() {
	global $wp_roles;

  $all_roles = $wp_roles->roles;
  $editable_roles = apply_filters('editable_roles', $all_roles);
	unset($editable_roles["subscriber"]);
	foreach(array_keys($editable_roles) as $rolename) {
		$role = get_role($rolename);
		if($role instanceof WP_Role && !$role->has_cap('edit_investor_relation')) {
			$role->add_cap('edit_investor_relation');
			$role->add_cap('read_investor_relation');
			$role->add_cap('delete_investor_relation');
			$role->add_cap('edit_investor_relations');
			$role->add_cap('edit_others_investor_relations');
			$role->add_cap('delete_investor_relations');
			$role->add_cap('publish_investor_relations');
			$role->add_cap('read_private_investor_relations');
			$role->add_cap('delete_private_investor_relations');
			$role->add_cap('delete_published_investor_relations');
			$role->add_cap('delete_others_investor_relations');
			$role->add_cap('edit_private_investor_relations');
			$role->add_cap('edit_published_investor_relations');
			$role->add_cap('unfiltered_html');
			$role->add_cap('upload_files_investor_relations');
			//file_put_contents(ABSPATH.'error_log.txt', date('d-m-Y h:m:s').print_r($role, true).PHP_EOL, FILE_APPEND | LOCK_EX);
		}
		if($role instanceof WP_Role && !$role->has_cap('edit_corporate_governance')) {
			$role->add_cap('edit_corporate_governance');
			$role->add_cap('read_corporate_governance');
			$role->add_cap('delete_corporate_governance');
			$role->add_cap('edit_corporate_governances');
			$role->add_cap('edit_others_corporate_governances');
			$role->add_cap('delete_corporate_governances');
			$role->add_cap('publish_corporate_governances');
			$role->add_cap('read_private_corporate_governances');
			$role->add_cap('delete_private_corporate_governances');
			$role->add_cap('delete_published_corporate_governances');
			$role->add_cap('delete_others_corporate_governances');
			$role->add_cap('edit_private_corporate_governances');
			$role->add_cap('edit_published_corporate_governances');
			$role->add_cap('unfiltered_html');
			$role->add_cap('upload_files_corporate_governances');
		}
	}
}
add_action('admin_init', 'ir_user_caps', 15);


function custom_query($query) {
  // gestione risultati
  if($query->is_main_query() && !is_admin()) {
		if(is_home()) {
			$terms = array();
			$nations = get_terms(array(
				'taxonomy' => 'localnews_category',
				'hide_empty' => true,
				'fields' => 'ids'
			));
			$pcategory_id = apply_filters("wpml_object_id", 25, "category", false, ICL_LANGUAGE_CODE);
			if($pcategory_id) {
				global $wpdb;
				$q = "
					SELECT t.*, tt.count
					FROM ".$wpdb->posts." AS p JOIN ".$wpdb->terms." AS t JOIN ".$wpdb->term_taxonomy." AS tt JOIN ".$wpdb->term_relationships." AS tr
					ON p.ID = tr.object_id AND t.term_id = tt.term_id AND tr.term_taxonomy_id = tt.term_taxonomy_id
					WHERE p.post_type='post' AND p.post_status='publish' AND tt.taxonomy='category' AND tt.count>0 AND tt.parent=%d
					GROUP BY t.term_id, tt.count";
				$terms = $wpdb->get_results($wpdb->prepare($q, $pcategory_id));
			}
			$query->set('post_type', array('post', 'localnews'));
      $query->set('posts_per_page', 12);
      $query->set('tax_query', array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => array_column($terms, "term_id"),
          'operator' => 'IN'
				),
				array(
					'taxonomy' => 'localnews_category',
					'field' => 'term_id',
					'terms' => $nations,
          'operator' => 'IN'
				)
			));
		} elseif(is_category() || is_tax("localnews_category")) {
			$query->set('post_type', array('post', 'localnews'));
      $query->set('posts_per_page', 12);
		} elseif(is_tax("localnews_category")) {
      $query->set('posts_per_page', 12);
		} elseif(is_post_type_archive('sedi') || is_search()) {
      $query->set('posts_per_page', -1);
		}
  }
}
add_action('pre_get_posts', 'custom_query');


function edit_posts_orderby($orderby_statement) {
	global $wp_query;
	if(!is_admin() && $wp_query->is_main_query() && is_search()) {
		if (!empty($wp_query->query_vars['s'])) {
			global $wpdb;
			$orderby_statement = "FIELD(wp_posts.post_type, 'page', 'post', 'localnews'), " . $wpdb->posts . ".post_title LIKE '%".addslashes($wp_query->get('s'))."%' DESC, " . $wpdb->posts . ".post_date DESC";
			$orderby_statement = $wpdb->prepare($orderby_statement);
		}
	}
	return $orderby_statement;
}
add_filter('posts_orderby', 'edit_posts_orderby');

function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = ceil(number_format($bytes / 1073741824, 2)) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = ceil(number_format($bytes / 1048576, 2)) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = ceil(number_format($bytes / 1024, 2)) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = ceil($bytes) . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = ceil($bytes) . ' byte';
    }
    else {
        $bytes = '0 bytes';
    }
    return $bytes;
}


function count_published_posts_for_terms($term, $name) {
	global $wpdb;
	$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships JOIN $wpdb->posts ON $wpdb->term_relationships.object_id=$wpdb->posts.ID WHERE $wpdb->term_relationships.term_taxonomy_id = %d AND $wpdb->posts.post_status='publish'", $term ) );

	do_action( 'edit_term_taxonomy', $term, $name );
	$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
}
add_action('edited_term_taxonomy', 'count_published_posts_for_terms', 10, 2);


function set_cfield_readonly_attribute($field) {
  //if(!is_null($field['value']) && $field['value'] !== '') {
    $field['readonly'] = true;
  //}
  return $field;
}
add_filter('acf/prepare_field/name=data_creazione', 'set_cfield_readonly_attribute');


function set_cfield_copyvalue($value, $post_id, $field, $original) {
	if($value=="[replace-with-post-modified-date]") {
		$v = get_field(str_replace("pretitolo_contenuto", "data_creazione", $field['name']), $post_id);
		if(!is_null($v)) {
			$value = $v;
		}
	}
  return $value;
}
add_filter('acf/update_value/name=pretitolo_contenuto', 'set_cfield_copyvalue', 10, 4);


function set_cfield_value($value, $post_id, $field, $original) {
	if($value === '') {
		$value = get_the_modified_date("d.m.Y - H:i", $post_id);
	}
  return $value;
}
add_filter('acf/update_value/name=data_creazione', 'set_cfield_value', 10, 4);


if(!function_exists('wp_is_block_theme')) {
	function wp_is_block_theme() {
		return false;
	}
}


function wpml_wpseo_title($title, $presentation) {
  switch($presentation->model->object_type) {
    case 'post-type-archive':
      $key = 'title-ptarchive-' . $presentation->model->object_sub_type;
      break;
    case 'system-page':
      $key = 'title-' . $presentation->model->object_sub_type . '-wpseo';
      break;
    default:
      $key = false;
  }

  if($key) {
    $option = get_option('wpseo_titles');
    if(isset($option[$key])) {
			if($key=='title-ptarchive-sedi') {
				$e = __('Archivi %%pt_plural%% %%page%% %%sep%% %%sitename%%', 'admin_texts_wpseo_titles');
				$f = __($option[$key], 'admin_texts_wpseo_titles');
			}
      $title = wpseo_replace_vars(__($option[$key], 'admin_texts_wpseo_titles'), $presentation);
    }
  }

  return $title;
}

function wpml_wpseo_desc($title, $presentation) {
  switch($presentation->model->object_type) {
    case 'post-type-archive':
      $key = 'metadesc-ptarchive-' . $presentation->model->object_sub_type;
      break;
    case 'system-page':
      $key = 'metadesc-' . $presentation->model->object_sub_type . '-wpseo';
      break;
    default:
      $key = false;
  }

  if($key) {
    $option = get_option('wpseo_titles');
    if(isset($option[$key])) {
        $title = wpseo_replace_vars(__($option[$key], 'admin_texts_wpseo_titles'), $presentation);
    }
  }

  return $title;
}

add_filter('wpseo_save_indexable', function($indexable) {
  $args = [
    'element_id' => $indexable->object_id,
    'element_type' => $indexable->object_type,
  ];

  $language_code = apply_filters('wpml_element_language_code', false, $args);
  $indexable->permalink = apply_filters('wpml_permalink', $indexable->permalink, $language_code, true);

  return $indexable;
});

//if(!is_admin()) {
  add_filter('wpseo_title', 'wpml_wpseo_title', 10, 2);
  add_filter('wpseo_opengraph_title', 'wpml_wpseo_title', 10, 2);
  add_filter('wpseo_metadesc', 'wpml_wpseo_desc', 10, 2);
  add_filter('wpseo_opengraph_desc', 'wpml_wpseo_desc', 10, 2);
//}


function news_page_link($permalink, $post_id) {
  if (empty($post_id) || get_post_status($post_id) != "publish") return $permalink;
	$permalink = preg_replace('@('.get_post_field("post_name", $post_id).'/?)@', 'magazine/$1', $permalink);
  return $permalink;
}
add_filter('post_link', 'news_page_link', 10, 2);


function localnews_page_link($permalink, $post_id) {
  if (empty($post_id) || get_post_status($post_id) != "publish") return $permalink;
	if (get_post_type($post_id) == 'localnews') {
		$permalink = str_replace('localnews/', 'magazine/localnews/', $permalink);
	}
  return $permalink;
}
add_filter('post_type_link', 'localnews_page_link', 10, 2);


function product_page_link($permalink, $post_id) {
  if (empty($post_id) || get_post_status($post_id) != "publish") return $permalink;
	if(get_page_template_slug($post_id) == "page-product.php") {
		$permalink = preg_replace('@('.get_post_field("post_name", $post_id).'/?)@', 'products/$1', $permalink);
	}
  return $permalink;
}
add_filter('page_link', 'product_page_link', 10, 2);


function redirect_product_page_url() {
	global $post;
	if(is_singular() && $post && get_page_template_slug($post->ID) == "page-product.php" && strpos($_SERVER["REQUEST_URI"], "products") === false) {
		wp_redirect("/products".$_SERVER["REQUEST_URI"]);
    exit();
	}
}
add_action('template_redirect', 'redirect_product_page_url');


function mytheme_do_not_redirect_products( $redirect, $post_id, $query ) {
	if(get_page_template_slug($post_id) == "page-product.php") {
		if(strpos($_SERVER["REQUEST_URI"], "products") !== false) {
      return false;
    }
	}
  return $redirect;
};
add_filter( 'wpml_is_redirected', 'mytheme_do_not_redirect_products', 10, 3 );


function filter_rewrite_rules_array($rules) {
  $new_rules = array();
	$new_rules['magazine/localnews/(.+)/?$'] = 'index.php?localnews=$matches[1]';
	global $wpdb;
	$query = "
		SELECT t.slug FROM wp_terms t JOIN wp_term_taxonomy tt
		ON t.term_id=tt.term_taxonomy_id
		WHERE tt.taxonomy='localnews_category'";
	$terms = $wpdb->get_col($query);
	foreach($terms as $term) {
	  $new_rules['magazine/('.$term.')/page/?([0-9]{1,})/?$'] = 'index.php?localnews_category=$matches[1]&paged=$matches[2]';
	  $new_rules['magazine/('.$term.')/?$'] = 'index.php?localnews_category=$matches[1]';
	}
	$query = "
		SELECT t.slug FROM wp_terms t JOIN wp_term_taxonomy tt
		ON t.term_id=tt.term_taxonomy_id
		WHERE tt.taxonomy='category'";
	$terms = $wpdb->get_col($query);
	foreach($terms as $term) {
	  $new_rules['magazine/('.$term.')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
	  $new_rules['magazine/('.$term.')/?$'] = 'index.php?category_name=$matches[1]';
	}
	$slug = get_post_field("post_name", get_option("page_for_posts"));
	if($slug) {
	  $new_rules['('.$slug.')/?$'] = 'index.php?pagename=$matches[1]'; // sovrascrittura categoria magazine con pagina blog magazine
	}
	$rules['magazine/([^/]+)/?$'] = 'index.php?name=$matches[1]'; // in coda il dettaglio news
	$products = get_posts(array(
		'post_type' => 'page',
		'posts_per_page' => -1,
		'meta_key' => '_wp_page_template',
    'meta_value' => 'page-product.php',
		'fields' => 'ids'
	));
	foreach($products as $product) {
		$new_rules['^products/('.get_post_field('post_name', $product).')/?$'] = 'index.php?pagename=$matches[1]'; // pagine di prodotto
	}
  return $new_rules + $rules;
};
add_filter('rewrite_rules_array', 'filter_rewrite_rules_array', 10, 1);


function debug_page_request() {
    if(!is_admin() && defined('WP_DEBUG') && WP_DEBUG) {
        global $wp, $template;
        echo '<!--'.PHP_EOL;
        echo 'Request: '. esc_html($wp->request) .PHP_EOL;
        echo 'Matched Rewrite Rules: '. esc_html($wp->matched_rule) .PHP_EOL;
        echo 'Matched Query: '. esc_html($wp->matched_query).PHP_EOL;
        echo 'Loaded Template: '. esc_html(basename($template)) .PHP_EOL;
        preg_match('/'.str_replace('/', '\/', $wp->matched_rule).'/', $wp->request, $matches);
        if(!empty($matches))
            print_r($matches);
        echo '-->'.PHP_EOL;
    }
}
add_action('wp_footer', 'debug_page_request');

function debug_scripts_queued() {
    if(!is_admin() && defined('WP_DEBUG') && WP_DEBUG) {
        global $wp_scripts;
        echo '<!--- SCRIPTS TROVATI'."\r\n";
        foreach ( $wp_scripts->queue as $script ) {
            echo "\r\nSCRIPT: ".$script."\r\n";
            $deps = $wp_scripts->registered[$script]->deps;
            if ($deps) {
                echo "DIPENDENZE: ";
                print_r($deps);
            }
        }
        echo "\r\n--->";
	}
}
add_action('wp_footer', 'debug_scripts_queued');

function import_flamingo() {
		$dir = opendir(ABSPATH . 'import');
		if ($dir) {
			global $wpdb;
			while (!empty($entry = readdir($dir))) {
				if($entry != "." && $entry != "..") {
					preg_match('@(?<=(aquafil-flamingo-))(.+)(?=(\.csv))@', $entry, $matches);
					if(!empty($matches)) {
				if(!get_transient('flamingo_imported-all-'.$matches[0])) {
						$query = "SELECT ID FROM wp_posts WHERE post_type='wpcf7_contact_form' AND post_title='".$matches[0]."'";
						$form_id = $wpdb->get_var($query);
						if($form_id) {
							$file_path = ABSPATH . 'import/' . $entry;
							if (($file = fopen($file_path, "r")) !== FALSE) {
								$start = get_transient('flamingo_imported-'.$matches[0]);
								$i = 1; $j = $start+0;
								$keys = array();
								while (($row = fgetcsv($file, 0, ',')) !== FALSE) {
									if($i==1 || ($i>$start && $i<=$start+5)) {
										$values = array();
										if($i==1) $keys = $row;
										else $values = $row;
										if($i>1) {
											$params = array_combine($keys, $values);
											$form = wpcf7_contact_form($form_id);
											if($form) {
												$_POST = array_merge($_POST, $params);
												$_POST['_wpcf7'] = $form_id;
												$_POST['_wpcf7_version'] = WPCF7_VERSION;
												$_POST['_wpcf7_locale'] = $form->locale();
												$_POST['_wpcf7_unit_tag'] = sprintf('wpcf7-f%1$d-o%2$d', $form_id, 1);
												$_POST['_wpcf7_container_post'] = 0;
												$_POST['_wpcf7_posted_data_hash'] = '';
										
												if(strtotime($_POST['Date']) > strtotime('2021-06-29T00:00:00')) {
													$form->submit(array(
														'skip_mail' => true
													));
												}
											}
										}
										$j++;
									}
									$i++;
								}
								fclose($file);
								if($i==$j) {
									set_transient('flamingo_imported-all-'.$matches[0], true);
								}
								set_transient('flamingo_imported-'.$matches[0], $j);
							}
						}
				}
					}
				}
			}
		}
  closedir($dir);
}
//add_action('init', 'import_flamingo');

function flamingo_inbound_message_timestamp($args) {
	if(isset($_POST['Date'])) {
		$time = strtotime($_POST['Date']);
		if(isset($args['timestamp'])) {
			$args['meta']['date'] = date("F j, Y", $time);
			$args['meta']['time'] = date("g:i a", $time);
			$time = strtotime('-2 hours', $time);
			$args['timestamp'] = $time;
		}
		if(isset($args['last_contacted'])) {
			$args['last_contacted'] = date("Y-m-d H:i:s", $time);
		}
	}
	return $args;
}
add_filter('wpcf7_flamingo_inbound_message_parameters', 'flamingo_inbound_message_timestamp', 10, 1);
add_filter('flamingo_add_contact', 'flamingo_inbound_message_timestamp', 10, 1);



function landing_labels($translation, $text, $domain) {
  if(is_page_template("templates/landing.php") && $domain == "wstheme" && get_field("traduci_etichette")) {
    $labels = get_field("etichette");
    $index = array_search($translation, array_column($labels, "default_label"), true);
    if($index !== false) {
      return $labels[$index]["translated_label"];
    }
  }
  return $translation;
}
add_filter('gettext_wstheme', 'landing_labels', 10, 3);


/**
 * aggiunge un container html all'output del campo
 */
function wysiwyg_html_container( $field ) {
  return '<div class="wysiwyg">'.$field.'</div>';
}
add_action('acf/format_value/type=wysiwyg', 'wysiwyg_html_container');


// Disabilitare il file XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

/**
* Remove /wp/v2/users REST API endpoint to prevent user enumeration via API
*/
add_filter('rest_endpoints', 'websolute_remove_users_rest_endpoint');
function websolute_remove_users_rest_endpoint( $endpoints ) {
    if( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    return $endpoints;
}