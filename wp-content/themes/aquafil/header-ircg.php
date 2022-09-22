<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?=ICL_LANGUAGE_CODE?>" xml:lang="<?=ICL_LANGUAGE_CODE?>">
	<head>
		<meta charset="utf-8" />
		<base href="<?=DOCS_DIR; ?>">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
		<meta name="Content-Language" content="<?=ICL_LANGUAGE_CODE?>" />
		<title><?= wp_title(''); ?></title>
		<link rel="icon" href="img/icon/favicon-32x32.png" type="image/x-icon" />
		<link rel="shortcut icon" href="img/icon/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/icon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="57x57" href="img/icon/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="img/icon/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="img/icon/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="img/icon/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="img/icon/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="img/icon/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="img/icon/apple-touch-icon-152x152.png" />
		<!--<link rel="manifest" href="<?=DOCS_DIR; ?>img/icon/site.webmanifest">-->
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
		<meta name="keywords" content="aquafil">
		<meta name="application-name" content="Aquafil">
		<meta name="apple-mobile-web-app-title" content="Aquafil">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<!--<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">-->
		<link rel="stylesheet" href="css/vendors.min.css?v=<?= filemtime(get_theme_file_path('/client/docs/css/vendors.min.css')) ?>" />
		<link rel="stylesheet" href="css/main.min.css?v=<?= filemtime(get_theme_file_path('/client/docs/css/main.min.css')) ?>" />
		<?php wp_head() ?>
		<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="33aabc39-1f1a-4433-8a07-23df0f5c4270" data-blockingmode="auto" type="text/javascript"></script>
	</head>

	<body <?php body_class(); ?>>
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
			<div class="page page--investors">
				<!-- header -->
				<header class="header has--nav" header>
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-20 offset-sm-2">
								<div class="header__main">
									<div class="header__logo">
										<?php
										//$cposts = get_posts(array(
										//  "post_type" => get_post_type(),
										//  "posts_per_page" => 1,
										//  "post_status" => "publish",
										//  "orderby" => array("menu_order" => "ASC", "post_name" => "ASC")
										//));
										//$hurl = !empty($cposts) ? get_permalink($cposts[0]) : home_url();
										?>
										<a href="<?= home_url();//$hurl; ?>" class="btn--logo">
											<svg>
												<use xlink:href="#aquafil"></use>
											</svg>
										</a>
									</div>
									<div class="header__menu" [class]="{ active: header == 'menu' }">
										<a href="<?= home_url(); ?>" class="btn--investor"><?= __("Torna al sito web", "wstheme"); ?></a>
										<ul class="nav--service">
											<li class="nav__item search">
												<span>
													<?= get_search_form(); ?>
												</span>
											</li>
										</ul>
										<?= icl_post_languages(); ?>
									</div>
									<button type="button" class="btn--menu" [class]="{ active: header == 'menu' }" (click)="onToggle('menu')">
										<svg class="menu"><use xlink:href="#menu"></use></svg>
										<svg class="close"><use xlink:href="#close"></use></svg>
									</button>
								</div>
							</div>
						</div>
					</div>
				</header>
				<div class="wrapper">