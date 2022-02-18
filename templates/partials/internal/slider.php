<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="content-slider borders<?= $_args['section']['internal_slider_bg'] == "blu" ? " negative" : ''; ?>" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<!-- swiper -->
				<div class="swiper-container" swiper-content>
					<div class="content-slider__index"><span class="page" [innerHTML]="slideIndex"></span> of <span [innerHTML]="slideTotal"></span></div>
					<div class="swiper-wrapper">

						<?php foreach($_args['section']['internal_slides'] as $k => $slide) { ?>

							<!-- slide -->
							<div class="swiper-slide">
								<div class="card--content">
									<div class="card--content__left">
										<div class="card--content__title"><?=$slide['slide_titolo']?></div>
										<div class="card--content__abstract"><?=$slide['slide_abstract']?></div>
										<?php
										$link = $slide['slide_link'];
										if(!empty($link)) {
											echo '
												<div class="card--content__cta">
													<a href="'.$link["url"].'" class="btn--more"><span>'.$link["title"].'</span> <svg><use xlink:href="#arrow-next"></use></svg></a>
												</div>';
										}
										?>
									</div>
									<div class="card--content__right">
										<?php
										$card = '<div class="card--content__picture" %1$s>%2$s</div>';
										if($slide['slider_mp4_video'] != '') {
											if($slide['slide_zoom_image']) {
												ob_start();
												include(locate_template('templates/partials/shared/zoom-button.html'));
												$btn = ob_get_contents();
												ob_end_clean();
												$card = sprintf($card, 'gallery="'.$slide['slider_mp4_video'].'"', '<video src="'.$slide['slider_mp4_video'].'" playsinline="" autoplay="" loop="" muted="" style="width:100%; height:100%; object-fit:cover"></video>'.$btn);
											} else {
												$card = sprintf($card, '', '<video src="'.$slide['slider_mp4_video'].'" playsinline="" autoplay="" loop="" muted="" style="width:100%; height:100%; object-fit:cover"></video>');
											}
										} else {
											if($slide['slide_zoom_image']) {
												ob_start();
												include(locate_template('templates/partials/shared/zoom-button.html'));
												$btn = ob_get_contents();
												ob_end_clean();
												$card = sprintf($card, 'gallery="'.$slide['slide_image'].'"', '<img loading="lazy" src="'.$slide['slide_image'].'" />'.$btn);
											} else {
												$card = sprintf($card, '', '<img loading="lazy" src="'.$slide['slide_image'].'" />');
											}
										}
										echo $card;
										?>
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
<?php endif; ?>
