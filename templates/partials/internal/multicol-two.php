<div class="title-text negative borders"<?=setAnchor($f);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3 title-text__divline"></div>
		</div>
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="title-text__content" appear>
					<div class="title-text__title"><?=$f['internal_multicol_two_titolo']?></div>
					<div class="title-text__abstract"><?=$f['internal_multicol_two_abstract']?></div>
				</div>
			</div>

			<?php foreach($f['internal_multicol_two_cta'] as $k => $cta){ ?>
				<div class="col-sm-9 offset-sm-2 col-md-8 <?=(is_int($k/2) ? 'offset-md-3' : '')?>">
					<div class="title-text__content" appear>
					
						<?php if($cta['multicol_two_stile_cta'] == 'testo') { ?>
						<a href="<?=$cta['multicol_two_link_cta'] ?>" class="btn--category"><span><?=$cta['multicol_two_titolo_cta'] ?></span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>
						<div class="title-text__description">
							<p><?=$cta['multicol_two_testo_cta'] ?></p>
						</div>
						<?php } else { ?>
							<span><?=$cta['multicol_two_titolo_cta'] ?></span>
							<div class="card--content__cta">
								<a href="<?=$cta['multicol_two_link_cta'] ?>" class="btn--primary"><?=__('Read more')?></span></a>	
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>
</div>