<?php 
/**
 * Template Name: Listing Products
 */
get_header('landing');
?>

<main class="main" product-list>

<div class="sticky-menu">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2">
				<div class="sticky-menu__content">
					<ul class="nav--scroll-menu" scroll-menu="">
					<li class="nav__item"><a href="<?= __("/it/", "wstheme"); ?>" class="active"><?= __("Catalogo prodotti", "wstheme"); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

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
	get_template_part("templates/partials/products/sidebar");
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

<?php get_footer('landing'); ?>
