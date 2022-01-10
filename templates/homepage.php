<?php
/**
 * Template Name: Homepage
 */
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
	<meta charset="utf-8" />
	<base href="<?=DOCS_DIR; ?>">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
	<meta name="Content-Language" content="it" />
	<meta name="robots" content="noindex,nofollow" />
	<title>Aquafil</title>
	<link rel="icon" href="<?=DOCS_DIR; ?>img/icon/favicon-32x32.png" type="image/x-icon" />
	<link rel="shortcut icon" href="<?=DOCS_DIR; ?>img/icon/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?=DOCS_DIR; ?>img/icon/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?=DOCS_DIR; ?>img/icon/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?=DOCS_DIR; ?>img/icon/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?=DOCS_DIR; ?>img/icon/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?=DOCS_DIR; ?>img/icon/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?=DOCS_DIR; ?>img/icon/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?=DOCS_DIR; ?>img/icon/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?=DOCS_DIR; ?>img/icon/apple-touch-icon-152x152.png" />
	<link rel="manifest" href="<?=DOCS_DIR; ?>img/icon/site.webmanifest">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<meta name="description" content="">
	<meta name="keywords" content="aquafil">
	<meta name="application-name" content="Aquafil">
	<meta name="apple-mobile-web-app-title" content="Aquafil">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<!--<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">-->
	<link rel="stylesheet" href="<?=DOCS_DIR; ?>css/vendors.min.css" />
	<link rel="stylesheet" href="<?=DOCS_DIR; ?>css/main.min.css" />
	<?php wp_head() ?>
</head>

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

