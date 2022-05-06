<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="main-hero" <?=setAnchor($_args['section']);?>>
	<!-- swiper -->
	<div class="swiper-container" swiper-main>
		<div class="swiper-wrapper">

		<!-- slide -->
		<?php foreach($_args['section']['carousel'] as $index=>$s) { ?>
			<div class="swiper-slide">
				<div class="card--main-hero">
					<div class="card--main-hero__background">
						<img loading="lazy" src="<?=$s['hero_slide'] ?>" />
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-20 col-sm-9 offset-sm-2">
								<div class="card--main-hero__content">
									<div class="card--main-hero__category"><?=$s['hero_abstract'] ?></div>
									<h1 class="card--main-hero__title"><?= $s['hero_titolo'] ?></h1>
									<div class="card--main-hero__abstract"><?=$s['hero_sottotitolo'] ?></div>
									<div class="card--main-hero__cta">
										<a href="<?=$s['hero_link_cta']?>" target="<?=$s['hero_target_cta']?>" class="btn--primary"><?=($s['hero_testo_cta'] != '' ? $s['hero_testo_cta'] : __('Read more', "wstheme"))?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<!-- slide -->

		</div>
		<div class="main-hero__nav">
			<!-- up button -->
			<button type="button" class="btn--up"><svg><use xlink:href="#caret-up-md"></use></svg></button>
			<!-- pagination -->
			<div class="main-hero__bullets"></div>
			<!-- down button -->
			<button type="button" class="btn--down"><svg><use xlink:href="#caret-down-md"></use></svg></button>
		</div>
	</div>
	<div class="scroll-proposition"><span>Scroll</span></div>
</div>
<?php endif; ?>
