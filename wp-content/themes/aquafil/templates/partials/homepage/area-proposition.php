<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<!-- PRODUCT PROPOSITION -->
<div class="area-proposition">
	<div class="area-proposition__head">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 offset-sm-2 col-md-11 offset-md-3">
					<div class="area-proposition__content" appear>
						<div class="area-proposition__category"><?= $_args['section']['area_abstract']?></div>
						<div class="area-proposition__title"><?= $_args['section']['area_titolo']?></div>
						<div class="area-proposition__abstract"><?= $_args['section']['area_sottotitolo']?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="listing--area">
		<?php foreach($_args['section']['area_cards'] as $s) { ?>
			<div class="listing__item" appear>
				<div class="card--area" scroll scrollSpeed="2">
					<div class="card--area__title"><?=$s['area_cards_titolo']?></div>
					<div class="card--area__picture">
						<img loading="lazy" src="<?=$s['area_cards_image']?>" />
					</div>
					<div class="card--area__abstract"><?=$s['area_cards_sottotitolo']?></div>
					<div class="card--area__cta">
						<a href="<?=$s['area_cards_link_cta']?>" target="<?=$s['area_cards_target_cta']?>" class="btn--primary"><?=($s['area_cards_testo_cta'] != '' ? $s['area_cards_testo_cta'] : __('Read more'))?></a>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
<?php endif; ?>
