<?php
$_args = wp_parse_args(
  $args,
  array(
    'history' => array()
  ));
if(!empty($_args['history'])) :
?>
<div class="card--history <?= $_args['history']['categoria_hi']; ?>" toggle=".card--history">
	<div class="card--history__picture">
		<?= !empty($_args['history']['immagine_hi']) ? '<img loading="lazy" src="'.$_args['history']['immagine_hi']['url'].'" />' : ''; ?>
	</div>
	<div class="card--history__content">
		<div class="card--history__year"><?= $_args['history']['anno_hi']; ?></div>
		<div class="card--history__title"><?= $_args['history']['titolo_hi']; ?></div>
	</div>
	<div class="card--history__cta">
		<?php if($_args['history']['evidenzia_categoria_hi']) : ?>
		<div class="card--history__category"><?= $_args['history']['categoria_hi']; ?></div>
		<?php endif; ?>
		<button type="button" class="btn--plus"><svg><use xlink:href="#plus"></use></svg></button>
	</div>
</div>
<div class="card--history-detail <?= $_args['history']['categoria_hi']; ?>">
	<div class="card--history-detail__col">
		<div class="card--history-detail__title"><?= $_args['history']['titolo_hi']; ?></div>
		<div class="card--history-detail__year"><?= $_args['history']['anno_hi']; ?></div>
		<?php if($_args['history']['evidenzia_categoria_hi']) : ?>
		<div class="card--history-detail__cta">
			<div class="card--history-detail__category"><?= ucfirst($_args['history']['categoria_hi']); ?></div>
		</div>
		<?php endif; ?>
	</div>
	<div class="card--history-detail__col">
		<div class="card--history-detail__abstract"><?= $_args['history']['testo_hi']; ?></div>
	</div>
</div>
<?php endif; ?>
