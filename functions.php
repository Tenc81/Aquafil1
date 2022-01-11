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

if (! defined('DOCS_DIR')) {
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1' ))) {
        //define('DOCS_DIR', 'http://localhost:3542/wp-content/themes/alpha-test/docs/');
    } else {
        define('DOCS_DIR', get_template_directory_uri().'/docs/');
    }
}



function the_breadcrumb()
{
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = ''; // delimiter between crumbs
    $home = 'Homepage'; // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '</li><li class="breadcrumb__list-item line-with-circle"><span class="current breadcrumb__list-title">'; // tag before the current crumb
    $after = '</span></li>'; // tag after the current crumb

    $output = '';



    global $post;
    $homeLink = get_bloginfo('url');
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) {
            $output .= '<ul id="crumbs" class="list inline breadcrumb__list"><li class="breadcrumb__list-item line-with-circle"><a class="breadcrumb__list-link link-bold 1" href="' . $homeLink . '">' . $home . '</a></li></ul>';
        }
    } else {
        $output .= '<ul id="crumbs" class="list inline breadcrumb__list"><li class="breadcrumb__list-item line-with-circle"><a class="breadcrumb__list-link link-bold 2" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $output .= get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
            }
            $output .= $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_search()) {
            $output .= $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            $output .= '<li class="breadcrumb__list-item line-with-circle"><a class="breadcrumb__list-link link-bold 3" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</li></a> ' . $delimiter . ' ';
            $output .= '<li class="breadcrumb__list-item line-with-circle"><a class="breadcrumb__list-link link-bold 4" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</li></a> ' . $delimiter . ' ';
            $output .= $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            $output .= '<li class="breadcrumb__list-item line-with-circle"><a class="breadcrumb__list-link link-bold 5" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</li></a> ' . $delimiter . ' ';
            $output .= $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            $output .= $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') { //$output .= get_the_ID();
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                if($post_type->labels->singular_name != "Service" && $post_type->labels->singular_name != "Posizione Lavorativa"){
                $output .= '<li class="breadcrumb__list-item line-with-circle"><a class="breadcrumb__list-link link-bold 6" href="' . $homeLink . '/' . ($post_type->labels->singular_name == 'Case History' ? 'our-xstories' : $slug['slug'] ) . '/">' . ($post_type->labels->singular_name == 'Case History' ? 'xStories' : $post_type->labels->singular_name) . '</li></a>';
                }
                if ($showCurrent == 1) {
                    $output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                }
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
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
            $output .= $before . '<<'.$post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            $output .= get_category_parents($cat, true, ' ' . $delimiter . ' ');
            $output .= '<li class="breadcrumb__list-item line-with-circle"><a class="breadcrumb__list-link link-bold 7" href="' . get_permalink($parent) . '">' . $parent->post_title . '</li></a>';
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
                $breadcrumbs[] = '<li class="breadcrumb__list-item line-with-circle"><a class="breadcrumb__list-link link-bold 8" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</li></a>';
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

?>