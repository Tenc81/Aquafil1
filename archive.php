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

	get_template_part( 'templates/partials/shared/breadcrumb' ); //the breadcrumb
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

	$terms    = get_terms([
		'taxonomy'    => 'category',
		'hide_empty'  => true
	]);

	//print_r($terms);

	/*
    [1] => WP_Term Object
	(
	[term_id] => 106
	[name] => Agents-BCF
	[slug] => agents-bcf-it
	[term_group] => 0
	[term_taxonomy_id] => 106
	[taxonomy] => agents_category
	[description] =>
	[parent] => 0
	[count] => 8
	[filter] => raw
	[term_order] => 0
	)
	 */

    ?>

	<div class="horizontal-menu borders">
		<!-- taxonomy filter -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
					<div class="horizontal-menu__content">
						<div class="horizontal-menu__title">
							Filtra per
						</div>
						<ul class="nav--horizontal-menu">

							<?php foreach($terms as $term) {
									  //if ($term->parent != 0) {
                            ?>
							<li class="nav__item" data-term-id="<?=$term->term_id?>">
								<span>
									<span class="name">
										<a href="<?=get_term_link($term->term_id);?>" style="color:inherit">
											<?=$term->name?>
										</a>
									</span><span class="count">
										(<?=$term->count ?>)
									</span>
								</span>
							</li>
							<?php } //} ?>

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


						$paged    = get_query_var('paged') ? : 1;
						$offset   = (1 === $paged) ? 0 : (($paged - 1) * 12) + (($paged - 1) * 2);




						$af_args = array(
							'paged' => $paged,
							'offset' => $offset,
							'post_type' => 'post',
							'post_status' => 'publish',
							'posts_per_page'=> 12,
							'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'field' => 'term_id',
									'terms' => $q->term_id
								)
							)
							);
						//echo $term->id;
						$af_list = new WP_Query( $af_args );
						while ($af_list->have_posts()) {
							$af_list->the_post();
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
						<?php
						}


						previous_posts_link('&laquo; Precedente', $af_list->max_num_pages);
						if ($paged > 1) echo ' | ';
						next_posts_link('Prossimo &raquo;', $af_list->max_num_pages);

						//echo '<br> Showing ' . $offset . '-' . ($offset + 6) . ' of ' . $query->found_posts . ' posts.';

						wp_reset_postdata();

            ?>


					</div>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'templates/partials/homepage/newsletter', 'proposition' ); ?>
</main>

<?php get_footer(); ?>
