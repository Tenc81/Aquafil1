<?php
/**
 * Template Name: Mission / Pillars
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

	get_template_part( 'templates/partials/shared/breadcrumb' ); //the breadcrumb
	?>


	<?php //print_r($fields);
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
					//echo 'templates/partials/' . $partialPath . ' ||||| '. implode('/',$partialPathRaw)
					get_template_part( 'templates/partials/' . $partialPath, implode('-',$partialPathRaw) );
				break;	
			}
		}
	?>


	<?php //get_template_part( 'templates/partials/internal/hero' ); the internal hero?>
	<?php //get_template_part( 'templates/partials/internal/media', 'text-primary' ); the media text primary ?>				
	<?php //get_template_part( 'templates/partials/internal/title', 'hero-02' ); the alternate hero title repeatable ?>
	<?php //get_template_part( 'templates/partials/internal/quote' ); the quote block ?>
	<?php //get_template_part( 'templates/partials/internal/multicol', 'two' ); the two columns block (even with 2 different flavour CTA repeatable) ?>				
	<?php //get_template_part( 'templates/partials/internal/slider'); the slider block ?>
	<?php //get_template_part( 'templates/partials/internal/multicol', 'two' ); the two columns block (even with 2 different flavour CTA) ?>				
	<?php //get_template_part( 'templates/partials/internal/slider'); the slider block (yes, repeated) ?>
	<?php //get_template_part( 'templates/partials/homepage/newsletter', 'proposition' ); ?>
	<?php //get_template_part( 'templates/partials/internal/multicol', 'three' ); the three columns block (no multi CTA here) ?>

</main>

<?php get_footer(); ?>
