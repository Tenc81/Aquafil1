<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="title-text borders<?= $_args['section']['internal_multicol_bg'] == "blu" ? " negative" : ''; ?>"<?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3 title-text__divline"></div>
		</div>
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="title-text__content" appear>
					<div class="title-text__title"><?= $_args['section']['internal_multicol_two_titolo']?></div>
					<div class="title-text__abstract"><?= $_args['section']['internal_multicol_two_abstract']?></div>
				</div>
			</div>

			<?php foreach($_args['section']['internal_multicol_two_cta'] as $k => $cta) : ?>
				<div class="col-sm-9 offset-sm-2 col-md-8 <?= ($k%2==0 ? 'offset-md-3' : ''); ?>">
					<div class="title-text__content" appear>
						<?php if($cta['multicol_two_stile_cta'] == 'testo') : ?>
						<div class="title-text__description">
							<p><?=$cta['multicol_two_testo_cta'] ?></p>
						</div>
						<?php endif; ?>
						<?php if($cta['multicol_two_link_cta'] != '') : ?>
						<?php if($cta['multicol_two_titolo_cta'] != '') : ?>
						<a href="<?= $cta['multicol_two_link_cta']; ?>" class="btn--category"><span><?= $cta['multicol_two_titolo_cta']; ?></span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>
						<?php else : ?>
						<a href="<?= $cta['multicol_two_link_cta']; ?>" class="btn--primary"><span><?= __("Leggi di più", "wstheme"); ?></span></a>
						<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>

		</div>
	</div>
</div>
<?php endif; ?>
