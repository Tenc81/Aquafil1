<?php
if(is_post_type_archive('sedi')) {
	$sedipage = get_posts(array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'meta_key' => '_wp_page_template',
		'meta_value' => 'templates/location.php',
		'suppress_filters' => false
	));
	if(!empty($sedipage)) {
	  $ref = $sedipage[0];
	}
} else {
	$ref = get_queried_object();
}
$img = get_field("location_hero_image", $ref);
?>
<div class="location-hero">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 offset-sm-2 col-md-6 offset-md-2 order-2 order-sm-1">
				<div class="location-hero__content" appear>
					<div class="location-hero__category"><?= get_field("location_hero_pretitolo", $ref); ?></div>
					<div class="location-hero__title"><?= get_field("location_hero_titolo", $ref); ?></div>
					<div class="location-hero__abstract"><?= get_field("location_hero_abstract", $ref); ?></div>
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
