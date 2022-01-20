<div class="primary-hero" <?=setAnchor($f);?> >
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-14 offset-sm-2 col-md-14 offset-md-2 order-2 order-sm-1">
					<div class="primary-hero__content" appear>
						<div class="primary-hero__category"><?=$f['internal_hero_abstract']?></div>
						<div class="primary-hero__title"><?=$f['internal_hero_titolo']?></div>
					</div>
				</div>
				<div class="col-sm-15 col-md-17 order-1 order-sm-2">
					<div class="primary-hero__picture" gallery="<?=$f['internal_hero_image']?>" scroll scrollSpeed="1">
						<img loading="lazy" src="<?=$f['internal_hero_image']?>" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="title-hero" id="brand-manifesto">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-18 offset-sm-2 col-md-15 offset-md-3">
					<div class="title-hero__content" appear>
						<div class="title-hero__title"><?=$f['internal_hero_secondary_abstract']?></div>
					</div>
				</div>
				<div class="col-sm-18 offset-sm-2 col-md-8 offset-md-10">
					<div class="title-hero__content" appear>
						<div class="title-hero__abstract"><?=$f['internal_hero_content']?></div>
					</div>
				</div>
			</div>
		</div>
	</div>