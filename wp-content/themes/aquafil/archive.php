<?php
/**
 * Template Name: News
 */
get_header();
$q = get_queried_object();

//print_r($q);
?>

<main class="main">
	<?php
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
							<?=$q->name?>
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


	<?php
	$terms = array();
	$pcategory_id = apply_filters("wpml_get_object_id", 25, "category", false, ICL_LANGUAGE_CODE);
	if($pcategory_id) {
		global $wpdb;
		$query = "
			SELECT t.*, tt.count
			FROM ".$wpdb->posts." AS p JOIN ".$wpdb->terms." AS t JOIN ".$wpdb->term_taxonomy." AS tt JOIN ".$wpdb->term_relationships." AS tr
			ON p.ID = tr.object_id AND t.term_id = tt.term_id AND tr.term_taxonomy_id = tt.term_taxonomy_id
			WHERE p.post_type='post' AND p.post_status='publish' AND tt.taxonomy='category' AND tt.count>0 AND tt.parent=%d
			GROUP BY t.term_id, tt.count";
		$terms = $wpdb->get_results($wpdb->prepare($query, $pcategory_id));
	}
	?>

	<div class="horizontal-menu borders">
		<!-- taxonomy filter -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
					<div class="horizontal-menu__content">
						<div class="horizontal-menu__title"><?= __("Filtra per", "wstheme"); ?></div>
						<ul class="nav--horizontal-menu">
							<li class="nav__item" data-term-id="">
								<a href="<?= get_permalink(get_option("page_for_posts")); ?>" style="color:inherit">
									<span class="name">
											<?= __("Tutte", "wstheme"); ?>
									</span><span class="count">
										(<?= array_sum(array_column($terms, "count")); ?>)
									</span>
								</a>
							</li>
							<?php foreach($terms as $term) : ?>
							<li class="nav__item" data-term-id="<?= $term->term_id; ?>">
								<a href="<?=get_category_link($term->term_id);?>" style="color:inherit"<?= $term->term_id==get_queried_object_id() ? ' class="active"' : ''; ?>>
									<span class="name">
											<?= $term->name; ?>
									</span><span class="count">
										(<?= $term->count; ?>)
									</span>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
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
									<div class="card--news__date">23.06.2021</div>
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
						previous_posts_link('&laquo; Precedente');
						echo ' | ';
					}
					next_posts_link('Prossimo &raquo;');

					wp_reset_postdata();
          ?>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'templates/partials/homepage/newsletter', 'proposition' ); ?>
</main>

<?php get_footer(); ?>
