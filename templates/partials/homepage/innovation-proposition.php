<!-- INNOVATION PROPOSITION -->
<div class="innovation-proposition">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 offset-sm-2 col-md-11 offset-md-3">
				<div class="innovation-proposition__content" appear>
					<div class="innovation-proposition__category"><?=$f['innovation_abstract']?></div>
					<div class="innovation-proposition__title"><?=$f['innovation_titolo']?></div>
					<div class="innovation-proposition__abstract"><?=$f['innovation_sottotitolo']?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php foreach($f['innovation_cards'] as $k => $s) { ?>
				<div class="<?=($k == 0 ? 'col-sm-6 offset-sm-2 col-md-5 offset-md-3' : 'col-sm-6 offset-sm-1 col-md-5 offset-md-1')?>">
					<a href="<?=$s['innovation_cards_link_cta']?>" class="card--innovation" target="<?=$s['innovation_cards_target_cta']?>">
						<div class="card--innovation__picture">
							<img loading="lazy" src="<?=$s['innovation_cards_image']?>" />
						</div>
						<div class="card--innovation__content" appear>
							<div class="card--innovation__title"><?=$s['innovation_cards_titolo']?></div>
							<div class="card--innovation__abstract"><?=$s['innovation_cards_sottotitolo']?></div>
						</div>
						<div class="card--innovation__cta">
							<button type="button" class="btn--more-md"><span><?=($s['innovation_cards_testo_cta'] != '' ? $s['innovation_cards_testo_cta'] : __('Read more'))?></span> <svg><use xlink:href="#arrow-next-md"></use></svg></button>
						</div>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
