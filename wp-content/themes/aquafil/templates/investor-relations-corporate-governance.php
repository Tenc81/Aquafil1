<?php 
/**
 * Template Name: Investor Relations/Corporate Governance
 * Template Post Type: investor-relations, corporate-governance
 */
get_header("ircg");
?>

<main class="main">
	<?php
	$fields = get_fields(get_queried_object());
	$filtered = array_filter($fields['sezioni'], function($section) {
		$keys = array_keys($section);
		$index = array_search('acf_fc_layout', $keys);
		unset($keys[$index]);
		$result = preg_grep('@\d+_attiva_sticky_item@', $keys);
		if(empty($result)) {
			foreach($keys as $key) {
				if(is_array($section[$key])) {
					$subfiltered = array_filter($section[$key], function($subsection) {
						$subkeys = array_keys($subsection);
						$res = preg_grep('@\d+_attiva_sticky_item@', $subkeys);
						return !empty($res) && $subsection[reset($res)];
					});
					if(!empty($subfiltered)) {
						array_push($result, $key);
					}
				}
			}
		}
		return !empty($result) && $section[reset($result)];
	});
	get_template_part( 'templates/partials/shared/sticky', null, array("all" => $filtered) );

	echo '
    <div class="container-fluid">
      <div class="row">';
	get_template_part("templates/partials/investors/side-menu");
	echo '
				<div class="col-sm-15 page--investors__content">
					<h1 class="page--investors__page-title">'.get_the_title().'</h1>';
	foreach($fields['sezioni'] as $i=>$section) {
		$partialPathRaw = explode('-', $section['acf_fc_layout']);
		$template = locate_template_part($partialPathRaw);
		if($template) {
			$part = substr(strstr($template, 'templates'), 0, strpos(strstr($template, 'templates'), '.php'));
			get_template_part($part, null, array("section" => $section, "index" => $i+1));
		}
	}

	echo '
				</div>
      </div>
    </div>';
	?>
</main>

<?php get_footer("ircg"); ?>
