<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<!-- INNOVATION PROPOSITION -->
<div class="innovation-proposition" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 offset-sm-2 col-md-11 offset-md-3">
				<div class="innovation-proposition__content" appear>
					<div class="innovation-proposition__category"><?= $_args['section']['innovation_abstract']?></div>
					<h2 class="innovation-proposition__title"><?= $_args['section']['innovation_titolo']?></h2>
					<div class="innovation-proposition__abstract"><?= $_args['section']['innovation_sottotitolo']?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php foreach($_args['section']['innovation_cards'] as $k => $s) { ?>
				<div class="<?=($k == 0 ? 'col-sm-6 offset-sm-2 col-md-5 offset-md-3' : 'col-sm-6 offset-sm-1 col-md-5 offset-md-1')?>">
					<?php if($s['innovation_cards_link_cta'] != 'javascript:void(0);') : ?>
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
					<?php else : ?>
					<div class="card--innovation">
						<div class="card--innovation__picture">
							<img loading="lazy" src="<?=$s['innovation_cards_image']?>" />
						</div>
						<div class="card--innovation__content" appear>
							<div class="card--innovation__title"><?=$s['innovation_cards_titolo']?></div>
							<div class="card--innovation__abstract"><?=$s['innovation_cards_sottotitolo']?></div>
						</div>
					</div>
					<?php endif; ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php endif; ?>
