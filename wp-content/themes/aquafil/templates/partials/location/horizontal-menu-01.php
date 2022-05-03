<?php
$filters = get_terms(array(
	'taxonomy' => 'nazione-sedi',
	'hide_empty' => true
));
if(!empty($filters)) {
	$total = array_sum(array_column($filters, 'count'));
	echo '
		<div class="horizontal-menu">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
						<div class="horizontal-menu__content">
							<div class="horizontal-menu__title">'.__("Change country", "wstheme").'</div>
							<ul class="nav--horizontal-menu">
								<li class="nav__item"><a '.(is_post_type_archive("sedi") ? 'href="javascript:void(0);" class="active"' : 'href="'.get_post_type_archive_link('sedi').'"').'><span class="name">'.__("All", "wstheme").'</span> <span class="count">('.$total.')</span></a></li>';
	foreach($filters as $filter) {
		echo '
								<li class="nav__item"><a '.(is_tax("nazione-sedi") && get_queried_object_id() == $filter->term_id ? 'href="javascript:void(0);" class="active"' : 'href="'.get_term_link($filter).'"').'><span class="name">'.__($filter->name, "wstheme").'</span> <span class="count">('.$filter->count.')</span></a></li>';
	}
	echo '
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>';
}
