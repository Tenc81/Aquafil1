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

<body>
	<script>
	window.STATIC = true;

	window.labels = {
		select: "Seleziona",
		error_required: "Il campo &#232; obbligatorio",
		error_email: "Email non valida",
		error_match: "I campi non corrispondono",
		select_file: "Seleziona un file (fino a 15mb)",
	};

	</script>
	<?php get_template_part( 'templates/partials/shared/svg'); ?>
	<div class="app hidden" app-component>
		<div class="page page--homepage">

			<?php get_template_part( 'templates/partials/shared/header'); ?>

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
				<?php get_template_part( 'templates/partials/shared/footer'); ?>
			<!--</div>-->
			<?php get_template_part( 'templates/partials/shared/modal', 'outlet' ); ?>
		</div>
	</div>
	<?php wp_footer(); ?>
	<script src="<?=DOCS_DIR; ?>js/vendors.min.js"></script>
	<script src="<?=DOCS_DIR; ?>js/main.js"></script>

</body>

</html>

