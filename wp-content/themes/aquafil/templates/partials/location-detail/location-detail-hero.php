<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
	$img = $_args['section']['hero_image'];
?>
<div class="location-detail-hero">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-9 offset-sm-2 col-md-8 offset-md-3 order-2 order-sm-1">
				<div class="location-detail-hero__content" appear>
					<h1 class="location-detail-hero__title"><?= get_the_title(); ?></h1>
					<div class="location-detail-hero__abstract"><?= $_args['section']['hero_text']; ?></div>
				</div>
			</div>
			<div class="col-sm-11 offset-sm-2 col-md-11 offset-md-2 order-1 order-sm-2">
				<?php
				if(!empty($img)) {
					echo '
						<div class="location-detail-hero__picture" gallery="'.$img["url"].'">
							<img loading="lazy" src="'.$img["url"].'" alt="'.get_the_title().' - hero" />
						</div>';
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
