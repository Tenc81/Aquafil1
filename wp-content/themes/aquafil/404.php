<?php get_header(); ?>

<main class="main">
	<?php get_template_part( 'templates/partials/shared/breadcrumb' ); //the breadcrumb ?>
	<?php
	while(have_rows("flexible_content", "options")) {
		the_row();
		switch(get_row_layout()) {
			case "generic_hero":
				get_template_part('templates/partials/shared/generic-hero', null, array("section" => array("title" => get_sub_field("title"), "text" => get_sub_field("text")), "index" => 0));
				break;
			case "generic_text":
				get_template_part('templates/partials/shared/generic-text', null, array("section" => array("text" => get_sub_field("text")), "index" => 1));
				break;
			default:;
		}
	}
	?>
</main>

<?php get_footer(); ?>
