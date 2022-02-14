	<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="columns borders" <?=setAnchor($_args['section']);?>>
		<div class="container-fluid">
			<div class="row">
				<?php foreach($_args['section']['internal_multicol_three_cta'] as $k => $cta) {?>
					<?php if($cta['multicol_three_stile_cta'] == 'button') { ?>
						<div class="col-sm-6 offset-sm-1 col-md-4 offset-md-3 columns__column">
							<div class="card--numbers__title"><?=$cta['multicol_three_titolo_cta'] ?></div>
							<div class="card--numbers__abstract"><?=$cta['multicol_three_abstract_cta'] ?></div>
							<div class="card--numbers__cta">
								<a href="<?=$cta['multicol_three_link_cta'] ?>" class="btn--more"><span>Learn more</span> <svg><use xlink:href="#arrow-next"></use></svg></a>
							</div>
						</div>
					<?php } else { ?>
						<a href="<?=$cta['multicol_three_link_cta'] ?>" class="btn--category"><span><?=$cta['multicol_three_titolo_cta'] ?></span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>
						<div class="title-text__description">
							<p><?=$cta['multicol_three_testo_cta'] ?></p>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
<?php endif; ?>
