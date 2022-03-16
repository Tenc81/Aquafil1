<?php
echo '
	<div class="col-sm-5 offset-sm-2 page--investor__menu">
		<div class="page--investor__menu-toggle" onclick="document.body.classList.toggle(\'investor-menu-open\')">
				<svg><use xlink:href="#caret-up-md"></use></svg>
		</div>';
	
$cposts = get_posts(array(
	"post_type" => array("investor-relations", "corporate-governance"),
	"posts_per_page" => -1,
	"post_status" => "publish",
	"orderby" => array("post_type" => "DESC", "menu_order" => "ASC", "post_name" => "ASC"),
	"suppress_filters" => false
));

if(!empty($cposts)) {
	$sections =array();
	foreach($cposts as $p) {
		if(!isset($sections[$p->post_type]))
			$sections[$p->post_type] = array();
		$sections[$p->post_type][] = $p->ID;
	}
	foreach($sections as $section=>$posts) {
		echo '
			<div class="page--investor__menu-title">'.__(get_post_type_object($section)->label, "wstheme").'</div>
			<div class="page--investor__menu-links">';
		foreach($posts as $p) {
			if($p==get_the_ID()) {
				echo '
					<a href="javascript:void(0);" class="page--investor__menu-link active">'.get_the_title($p).'</a>';
			} else {
				echo '
					<a href="'.get_permalink($p).'" class="page--investor__menu-link">'.get_the_title($p).'</a>';
			}
		}
		echo '
			</div>';
	}
}
echo '
	</div>';