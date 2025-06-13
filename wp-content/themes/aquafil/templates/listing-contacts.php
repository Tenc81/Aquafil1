<?php 
/**
 * Template Name: Listing Contacts
 */
get_header('landing');

$fields = get_fields(get_queried_object());
	$filtered = array_filter($fields['sezioni'], function($section) {
		$keys = array_keys($section);
		$result = preg_grep('@\d+_attiva_sticky_item@', $keys);
		return !empty($result) && $section[reset($result)];
	});
	get_template_part( 'templates/partials/shared/sticky', null, array("all" => $filtered) );
?>

<main class="main" product-list>
	
      <div class="page--investors__content">
	      <div class="col-sm-22 offset-sm-1">
			    <h1 class="page--investors__page-title"><?= get_the_title(); ?></h1>
				<div class="contacts-form__text-top"><?= __("Per ulteriori informazioni, contattaci compilando il form sottostante:", "wstheme"); ?></div>
			</div>
		</div>
<?php	foreach($fields['sezioni'] as $i=>$section) {
		$partialPathRaw = explode('-', $section['acf_fc_layout']);
		$template = locate_template_part($partialPathRaw);
		if($template) {
			$part = substr(strstr($template, 'templates'), 0, strpos(strstr($template, 'templates'), '.php'));
			get_template_part($part, null, array("section" => $section, "index" => $i+1));
		}
	} ?>
				</div>

	
</main>

<?php get_footer('landing'); ?>
