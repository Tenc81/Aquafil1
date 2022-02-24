<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="primary-hero" <?=setAnchor($_args['section']);?> >
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-14 offset-sm-2 col-md-14 offset-md-2 order-2 order-sm-1">
					<div class="primary-hero__content" appear>
						<div class="primary-hero__category"><?= $_args['section']['internal_hero_abstract'] ?></div>
						<div class="primary-hero__title"><?= $_args['section']['internal_hero_titolo'] ?></div>
					</div>
				</div>
				<div class="col-sm-15 col-md-17 order-1 order-sm-2">
					<?php if($_args['section']['internal_hero_zoom_image']) : ?>
					<div class="primary-hero__picture" gallery="<?= $_args['section']['internal_hero_image']; ?>" scroll scrollSpeed="1">
						<img loading="lazy" src="<?= $_args['section']['internal_hero_image']; ?>" alt="<?= get_the_title(); ?>" />
						<?php include(locate_template('templates/partials/shared/zoom-button.html')); ?>
					</div>
					<?php else : ?>
					<div class="primary-hero__picture" scroll scrollSpeed="1">
						<img loading="lazy" src="<?= $_args['section']['internal_hero_image']; ?>" alt="<?= get_the_title(); ?>" />
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="title-hero" id="brand-manifesto">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-18 offset-sm-2 col-md-15 offset-md-3">
					<div class="title-hero__content" appear>
						<div class="title-hero__title"><?= $_args['section']['internal_hero_secondary_abstract'] ?></div>
					</div>
				</div>
				<div class="col-sm-18 offset-sm-2 col-md-8 offset-md-10">
					<div class="title-hero__content" appear>
						<div class="title-hero__abstract"><?= $_args['section']['internal_hero_content'] ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
