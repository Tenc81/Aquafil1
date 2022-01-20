<?php
/**
 * Template Name: Mission / Pillars
 */
get_header(); 
$fields = get_fields(get_the_ID());
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
	<div class="app" app-component>
		<div class="page page--location">

			<?php get_template_part( 'templates/partials/shared/header'); ?>

			<!--<div class="wrapper">-->
			<main class="main">


				<?php 
				set_query_var( 'all', $fields['sezioni'] );
				get_template_part( 'templates/partials/shared/sticky' ); //the sticky menu (if present) ?>
				<?php get_template_part( 'templates/partials/shared/breadcrumb' ); //the breadcrumb ?>


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

