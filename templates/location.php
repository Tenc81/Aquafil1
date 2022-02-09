<?php 
/**
 * Template Name: Sedi
 */
get_header();
?>

<main class="main">
	<?php
	get_template_part('templates/partials/shared/sticky'); //the sticky menu (if present)

	get_template_part('templates/partials/shared/breadcrumb');

	get_template_part('templates/partials/location/location-hero');

	get_template_part('templates/partials/location/horizontal-menu', '01');
	
	get_template_part('templates/partials/location/horizontal-menu', '02');
	
	get_template_part('templates/partials/location/location-proposition');

	if(!is_page()) {
		$sedipage = get_posts(array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'meta_key' => '_wp_page_template',
			'meta_value' => 'templates/location.php',
			'suppress_filters' => false
		));
		if(!empty($sedipage)) {
			$post = $sedipage[0];
			setup_postdata($post);
		}
	}
	$fields = get_fields(get_the_ID());
	foreach($fields['sezioni'] as $i=>$section) {
		$partialPathRaw = explode('-', $section['acf_fc_layout']);
		$template = locate_template_part($partialPathRaw);
		if($template) {
			$part = substr(strstr($template, 'templates'), 0, strpos(strstr($template, 'templates'), '.php'));
			get_template_part($part, null, array("section" => $section, "index" => $i+1));
		}
	}
	wp_reset_postdata();

	get_template_part("templates/partials/homepage/newsletter-proposition");
	?>

</main>

<?php get_footer(); ?>
