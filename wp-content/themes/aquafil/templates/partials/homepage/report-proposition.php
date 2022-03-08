<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<!-- REPORT PROPOSITION -->
<div class="report-proposition" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="report-proposition__picture" scroll="img">
					<img loading="lazy" src="<?= $_args['section']['report_image']?>" />
				</div>
			</div>
			<div class="col-sm-8 offset-sm-1">
				<div class="report-proposition__content" appear>
					<div class="report-proposition__title"><?= $_args['section']['report_titolo']?></div>
					<div class="report-proposition__abstract"><?= $_args['section']['report_sottotitolo']?></div>
					<div class="report-proposition__cta">
						<a href="<?= $_args['section']['report_link_cta']?>" target="<?= $_args['section']['report_target_cta']?>" class="btn--download"><span><?=($_args['section']['report_testo_cta'] != '' ? $_args['section']['report_testo_cta'] : __('Read more'))?></span> <svg><use xlink:href="#download"></use></svg></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
