<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="content-slider borders<?= $_args['section']['content_slider_bg'] == "blu" ? " negative" : ''; ?>">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<!-- swiper -->
				<div class="swiper-container" swiper-content>
					<div class="content-slider__index"><span class="page" [innerHTML]="slideIndex"></span> <?= __("of", "wstheme"); ?> <span [innerHTML]="slideTotal"></span></div>
					<div class="swiper-wrapper">
						<?php
						foreach($_args['section']['content-slider'] as $slide) {
							$link = $slide['link_slide'];
							echo '
								<!-- slide -->
								<div class="swiper-slide">
									<div class="card--content">
										<div class="card--content__left">
											<div class="card--content__title">'.$slide['titolo_slide'].'</div>
											<div class="card--content__abstract">'.$slide['sottotitolo_slide'].'</div>
										</div>
										<div class="card--content__right">
											<div class="card--content__abstract">'.$slide['testo_slide'].'</div>
											'.(!empty($link) ? 
											'<div class="card--content__cta">
												<a href="'.$link["url"].'" target="'.$link["target"].'" class="btn--more"><span>'.$link["title"].'</span> <svg><use xlink:href="#arrow-next"></use></svg></a>
											</div>' : '').'
										</div>
									</div>
								</div>
								<!-- slide -->';
						}
						?>
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
<?php endif; ?>
