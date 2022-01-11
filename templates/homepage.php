<?php
/**
 * Template Name: Homepage
 */
get_header(); ?>

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

				<?php get_template_part( 'templates/partials/homepage/main', 'hero' ); ?>
				<?php get_template_part( 'templates/partials/homepage/profile', 'proposition' ); ?>
				<?php get_template_part( 'templates/partials/homepage/area', 'proposition' ); ?>
				<?php get_template_part( 'templates/partials/homepage/sustainability', 'proposition' ); ?>
				<?php get_template_part( 'templates/partials/homepage/report', 'proposition' ); ?>
				<?php get_template_part( 'templates/partials/homepage/innovation', 'proposition' ); ?>
				<?php get_template_part( 'templates/partials/homepage/news', 'proposition' ); ?>
				<?php get_template_part( 'templates/partials/homepage/newsletter', 'proposition' ); ?>

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

