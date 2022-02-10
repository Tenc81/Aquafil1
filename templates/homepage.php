<?php
/**
 * Template Name: Homepage
 */
get_header(); 

$fields = get_fields(get_the_ID());
?>

<main class="main">
	<?php
	$filtered = array_filter($fields['sezioni'], function($section) {
		$keys = array_keys($section);
		$result = preg_grep('@\d+_attiva_sticky_item@', $keys);
		return !empty($result) && $section[reset($result)];
	});
	get_template_part( 'templates/partials/shared/sticky', null, array("all" => $filtered) );

	foreach($fields['sezioni'] as $section){
		$partialPathRaw = explode('-', $section['acf_fc_layout']);
		set_query_var( 'f', $section );
		switch(count($partialPathRaw)){
			case 2:
				get_template_part( 'templates/partials/' . implode('/',$partialPathRaw) );
			break;								
			default:
				$partialPath =	$partialPathRaw[0] . '/' . $partialPathRaw[1];
				array_shift($partialPathRaw);
				array_shift($partialPathRaw);
				get_template_part( 'templates/partials/' . $partialPath, implode('-',$partialPathRaw) );
			break;	
		}
	}
	?>
</main>

<?php get_footer(); ?>
