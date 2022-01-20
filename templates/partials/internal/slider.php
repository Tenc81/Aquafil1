<div class="content-slider borders negative" <?=setAnchor($f);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<!-- swiper -->
				<div class="swiper-container" swiper-content>
					<div class="content-slider__index"><span class="page" [innerHTML]="slideIndex"></span> of <span [innerHTML]="slideTotal"></span></div>
					<div class="swiper-wrapper">

						<?php foreach($f['internal_slides'] as $k => $slide) { ?>

							<!-- slide -->
							<div class="swiper-slide">
								<div class="card--content">
									<div class="card--content__left">
										<div class="card--content__title"><?=$slide['slide_titolo']?></div>
										<div class="card--content__abstract"><?=$slide['slide_abstract']?></div>
										<!--
										<div class="card--content__cta">
											<a href="#" class="btn--more"><span>Learn more</span> <svg><use xlink:href="#arrow-next"></use></svg></a>
										</div>
										-->
									</div>
									<div class="card--content__right">
										<div class="card--content__picture" gallery="<?=$slide['slide_image']?>">
											<img loading="lazy" src="<?=$slide['slide_image']?>" />
										</div>
									</div>
								</div>
							</div>							

						<?php }?>

					</div>
					<div class="content-slider__nav">
						<!-- prev button -->
						<button type="button" class="btn--prev">
							<svg class="circle"><use xlink:href="#circle-dotted"></use></svg>
							<svg class="caret"><use xlink:href="#caret-left"></use></svg>
						</button>
						<!-- next button -->
						<button type="button" class="btn--next">
							<svg class="circle"><use xlink:href="#circle-dotted"></use></svg>
							<svg class="caret"><use xlink:href="#caret-right"></use></svg>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
