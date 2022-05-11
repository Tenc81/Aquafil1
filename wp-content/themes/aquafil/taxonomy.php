<?php
get_header();
$q = get_queried_object(); 

//print_r($q);
?>

<main class="main">
	<?php
	$fields = get_fields(get_queried_object());
	$filtered = array_filter($fields['sezioni'], function($section) {
		$keys = array_keys($section);
		$result = preg_grep('@\d+_attiva_sticky_item@', $keys);
		return !empty($result) && $section[reset($result)];
	});
	get_template_part( 'templates/partials/shared/sticky', null, array("all" => $filtered) );
	?>

	<div class="news-hero">
		<!-- hero -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
					<div class="news-hero__content" appear>
						<div class="news-hero__title">
							<h1><?= $q->name; ?></h1>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 offset-sm-3 col-md-7 offset-md-4">
					<div class="news-hero__content" appear>
						<div class="news-hero__abstract">
							<?=$q->description?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="news-listing borders">
		<!-- the listing - 12 -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
					<div class="listing--news">
						<!-- foreach -->
						<?php
						while(have_posts()) {
							the_post();
            ?>
						<div class="listing__item" appear>
							<a href="<?=get_the_permalink()?>" class="card--news">
								<div class="card--news__picture">
									<img loading="lazy" src="<?=esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" />
								</div>
								<div class="card--news__content" appear>
									<div class="card--news__title">
										<?=get_the_title();?>
									</div>
									<!-- <div class="card--news__abstract"><-@@var=abstract-></div> -->
									<div class="card--news__cta">
										<button type="button" class="btn--more">
											<span>Read more</span><svg>
												<use xlink:href="#arrow-next"></use>
											</svg>
										</button>
									</div>
								</div>
							</a>
						</div>
						<?php } ?>
					</div>
					<?php
					if ($paged > 1) {
						previous_posts_link('&laquo; '.__("Precedente", "wstheme"));
						echo ' | ';
					}
					next_posts_link(__("Prossimo", "wstheme").' &raquo;');

					wp_reset_postdata();
          ?>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'templates/partials/homepage/newsletter', 'proposition' ); ?>
</main>

<?php get_footer(); ?>
