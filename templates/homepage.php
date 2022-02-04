<?php
/**
 * Template Name: Homepage
 */
get_header(); 

$fields = get_fields(get_the_ID());

/*[0] => Array
(
	[acf_fc_layout] => homepage-main-hero
	[carousel] => 
	[01_attiva_sticky_item] => 
	[01_label_sticky_item] => 
)*/

?>

<!--<div class="wrapper">-->
<main class="main">
<?php

//set_query_var( 'all', $fields['sezioni'] );
//get_template_part( 'templates/partials/shared/sticky' ); //the sticky menu (if present)
//get_template_part( 'templates/partials/shared/breadcrumb' ); //the breadcrumb ?>



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
				get_template_part( 'templates/partials/' . $partialPath, implode('-',$partialPathRaw) );
			break;	
		}
	}
?>
</main>

<?php get_footer(); ?>
