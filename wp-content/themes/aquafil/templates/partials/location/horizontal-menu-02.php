<?php
if(is_tax("nazione-sedi")) {
	global $wp_query, $wpdb;
	$query =
		'SELECT t.*, count(t.term_id) AS count FROM wp_terms t JOIN wp_term_relationships tr JOIN wp_term_taxonomy tt
			ON t.term_id=tr.term_taxonomy_id AND tr.term_taxonomy_id=tt.term_taxonomy_id
			WHERE tt.taxonomy = "settori-sedi" AND object_id IN ('.implode(',', array_column($wp_query->posts, 'ID')).')
			GROUP BY t.term_id';
	$filters = $wpdb->get_results($query);
} else {
	$filters = get_terms(array(
		'taxonomy' => 'settori-sedi',
		'hide_empty' => true
	));
}
if(!empty($filters)) {
	$total = array_sum(array_column($filters, 'count'));
	if(is_post_type_archive("sedi")) {
		$href = 'href="javascript:void(0);" class="active"';
	} elseif(is_tax("nazione-sedi")) {
		$href = 'href="'.get_term_link(get_queried_object_id()).'"';;
	} elseif(is_tax("settori-sedi")) {
		$href = 'href="'.get_post_type_archive_link('sedi').'"';
	}
	echo '
		<div class="horizontal-menu">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
						<div class="horizontal-menu__content">
							<div class="horizontal-menu__title">'.__("Filter by category", "wstheme").'</div>
							<ul class="nav--horizontal-menu">
								<li class="nav__item"><a '.$href.'><span class="name">'.__("All", "wstheme").'</span> <span class="count">('.$total.')</span></a></li>';
	foreach($filters as $filter) {
		if((is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id) || is_tax("nazione-sedi")) {
			echo '<li class="nav__item"><a href="javascript:void(0);" class="'.$filter->slug.(is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id ? ' active' : '').'"><span class="name">'.$filter->name.'</span> <span class="count">('.$filter->count.')</span></a></li>';
		} else {
			echo '<li class="nav__item"><a href="'.get_term_link($filter).'"'.(is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id ? ' class="active"' : '').'><span class="name">'.$filter->name.'</span> <span class="count">('.$filter->count.')</span></a></li>';
		}
	}
	echo '
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>';
}

//$filters = get_terms(array(
//  'taxonomy' => 'settori-sedi',
//  'hide_empty' => true
//));
//if(!empty($filters)) {
//  $total = array_sum(array_column($filters, 'count'));
//  echo '
//    <div class="horizontal-menu">
//      <div class="container-fluid">
//        <div class="row">
//          <div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
//            <div class="horizontal-menu__content">
//              <div class="horizontal-menu__title">'.__("Filter by category", "wstheme").'</div>
//              <ul class="nav--horizontal-menu">
//                <li class="nav__item"><a '.(is_post_type_archive("sedi") ? 'href="javascript:void(0);" class="active"' : 'href="'.get_post_type_archive_link('sedi').'"').'><span class="name">'.__("All", "wstheme").'</span> <span class="count">('.$total.')</span></a></li>';
	
//    if((is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id) || is_tax("nazione-sedi")) {
//      echo '
//        <li class="nav__item" *for="let [key, filter] of filters">
//          <a href="javascript:void(0);" "[class]="{ active: filter.has(item) }" (click)="filter.set(item)">
//            <span class="name" [innerHTML]="item.label"></span> <span class="count" [innerHTML]="item.count || \'\'"></span>
//          </a>
//        </li>';
//    } else {
//      foreach($filters as $filter) {
//        echo '
//          <li class="nav__item">
//            <a href="'.$href.'"'.(is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id ? ' class="active"' : '').'>
//              <span class="name">'.$filter->name.'</span> <span class="count">('.$filter->count.')</span>
//            </a>
//          </li>';
//      }
//    }
//  foreach($filters as $filter) {
//    if((is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id) || is_tax("nazione-sedi")) {
//      $href = '<li class="nav__item"><a href="javascript:void(0);" "[class]="{ active: filter.has(item) }" (click)="filter.set(item)"><span class="name" [innerHTML]="item.label"></span> <span class="count" [innerHTML]="item.count || \'\'"></span></a></li>';
//    } else {
//      $href = '<li class="nav__item"><a href="'.$href.'"'.(is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id ? ' class="active"' : '').'><span class="name">'.$filter->name.'</span> <span class="count">('.$filter->count.')</span></a></li>';
//    }
//    //echo '
//    //            <li class="nav__item"><a href="'.$href.'"'.(is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id ? ' class="active"' : '').'><span class="name">'.$filter->name.'</span> <span class="count">('.$filter->count.')</span></a></li>';
//  }
//  echo '
//              </ul>
//            </div>
//          </div>
//        </div>
//      </div>
//    </div>';
//}
