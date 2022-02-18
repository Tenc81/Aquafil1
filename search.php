<?php get_header(); ?>

<main class="main">
	<?php
	get_template_part('templates/partials/shared/breadcrumb');
	
	get_template_part('templates/partials/shared/generic-hero', null, array("section" => array("title" => __("Ricerca", "wstheme"), "text" => sprintf('%1$s: "%2$s"', __("Risultati per", "wstheme"), get_query_var('s'))), "index" => 0));

echo '
	<div class="section-generic search">
		<div class="container">';
if(have_posts()) {
	while(have_posts()) {
		the_post();
		$thumb = get_the_post_thumbnail_url();
		echo '
			<div class="search__item">
				<div class="search__thumb">
					'.($thumb ? '<img src="'.$thumb.'">' : '').'
				</div>
				<div class="search__content">
					<div class="search__title">'.get_the_title().'</div>
					<div class="search__abstract">'.get_the_excerpt().'</div>
					<div class="search__link"><a href="'.get_permalink().'" class="btn--primary">'.__("Dimmi di più", "wstheme").'</a></div>
				</div>
			</div>';
	}
} else {
	echo '
			<div class="search__item">
				<div class="search__thumb"></div>
				<div class="search__content">
					<div class="search__title">'.sprintf('%1$s "%2$s"', __("Nessun risultato per", "wstheme"), get_query_var('s')).'</div>
				</div>
			</div>';
}
echo '
		</div>
	</div>';

get_template_part('templates/partials/homepage/newsletter', 'proposition');
?>
</main>

<?php get_footer(); ?>
