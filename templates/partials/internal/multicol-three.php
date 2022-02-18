	<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="columns borders<?= $_args['section']['internal_multicol_bg'] == "blu" ? " negative" : ''; ?>" <?=setAnchor($_args['section']);?>>
		<div class="container-fluid">
			<div class="row">
				<?php foreach($_args['section']['internal_multicol_three_cta'] as $k => $cta) : ?>
						<div class="col-sm-6 offset-sm-1 col-md-4 offset-md-3 columns__column">
							<div class="card--icon__icon">
								<?php
								if(!empty($cta['multicol_three_icona_cta'])) {
									echo '<img loading="lazy" src="'.$cta['multicol_three_icona_cta']['url'].'" alt="'.get_the_title().'" />';
								}
								?>
							</div>
							<div class="card--icon__title"><?=$cta['multicol_three_titolo_cta'] ?></div>
						<?php if($cta['multicol_three_stile_cta'] == 'testo') : ?>
						<div class="card--icon__description">
							<p><?=$cta['multicol_three_testo_cta'] ?></p>
						</div>
						<?php endif; ?>
							<div class="card--icon__abstract"><?=$cta['multicol_three_abstract_cta'] ?></div>
							<?php if($cta['multicol_three_link_cta'] != '') : ?>
							<?php if($cta['multicol_three_titolo_cta'] != '') : ?>
								<a href="<?=$cta['multicol_three_link_cta'] ?>" class="btn--category"><span><?=$cta['multicol_three_titolo_cta'] ?></span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>
							<?php else : ?>
								<a href="<?=$cta['multicol_three_link_cta'] ?>" class="btn--more"><span><?= __("Leggi di più", "wstheme"); ?></span> <svg><use xlink:href="#arrow-next"></use></svg></a>
							<?php endif; ?>
							<?php endif; ?>
						</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
