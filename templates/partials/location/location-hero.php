<?php
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
$img = get_field("location_hero_image");
?>
<div class="location-hero">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 offset-sm-2 col-md-6 offset-md-2 order-2 order-sm-1">
				<div class="location-hero__content" appear>
					<div class="location-hero__title"><?= get_field("location_hero_titolo"); ?></div>
					<div class="location-hero__abstract"><?= get_field("location_hero_abstract"); ?></div>
				</div>
			</div>
			<div class="col-sm-12 offset-sm-2 col-md-10 offset-md-2 order-1 order-sm-2">
				<div class="location-hero__picture">
					<?= !empty($img) ? '<img loading="lazy" src="'.$img["url"].'" alt="'.get_the_title().'- hero" />' : ''; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>
