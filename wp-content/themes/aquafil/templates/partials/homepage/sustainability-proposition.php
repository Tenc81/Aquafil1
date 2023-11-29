<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<!-- SUSTAINABILITY PROPOSITION -->
<div class="sustainability-proposition" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 offset-sm-2 col-md-11 offset-md-3">
				<div class="sustainability-proposition__content" appear>
					<div class="sustainability-proposition__category"><?= $_args['section']['sustainability_abstract']?></div>
					<h2 class="sustainability-proposition__title"><?= $_args['section']['sustainability_titolo']?></h2>
					<div class="sustainability-proposition__abstract"><?= $_args['section']['sustainability_sottotitolo']?></div>
				</div>
			</div>
		</div>
		<div class="listing--sustainability">
			<?php foreach($_args['section']['sustainability_cards'] as $s) : ?>
				<div class="listing__item">
					<?php if($s['sustainability_cards_link_cta'] != 'javascript:void(0);') : ?>
					<a href="<?=$s['sustainability_cards_link_cta']?>" target="<?=$s['sustainability_cards_target_cta']?>" class="card--sustainability">
						<div class="card--sustainability__picture">
							<img loading="lazy" src="<?=$s['sustainability_cards_image']?>" />
						</div>
						<div class="card--sustainability__content" appear>
							<div class="card--sustainability__title"><?=$s['sustainability_cards_titolo']?></div>
							<div class="card--sustainability__abstract" ellipsis><?=$s['sustainability_cards_sottotitolo']?></div>
							<div class="card--sustainability__cta">
								<button type="button" class="btn--more"><span><?=($s['sustainability_cards_testo_cta'] != '' ? $s['sustainability_cards_testo_cta'] : __('Read more'))?></span> <svg><use xlink:href="#arrow-next"></use></svg></button>
							</div>
						</div>
					</a>
					<?php else : ?>
					<div class="card--sustainability">
						<div class="card--sustainability__picture">
							<img loading="lazy" src="<?=$s['sustainability_cards_image']?>" />
						</div>
						<div class="card--sustainability__content">
							<div class="card--sustainability__title"><?=$s['sustainability_cards_titolo']?></div>
							<div class="card--sustainability__abstract"><?=$s['sustainability_cards_sottotitolo']?></div>
						</div>
					</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>
