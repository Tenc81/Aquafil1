<?php get_header(); ?>

<main class="main">
	<div class="news-listing borders">
		<!-- the listing - 12 -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
					<?php
					if(have_posts()) {
						echo '<h1>'.sprintf('%1$s "%2$s":', __("Risultati per", "wstheme"), get_query_var('s')).'</h1>';
						echo '<ul>';
						while(have_posts()) {
							the_post();
							echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
						}
						echo '</ul>';
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'templates/partials/homepage/newsletter', 'proposition' ); ?>
</main>

<?php get_footer(); ?>
