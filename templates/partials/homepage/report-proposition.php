<!-- REPORT PROPOSITION -->
<div class="report-proposition">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="report-proposition__picture" scroll="img">
					<img loading="lazy" src="<?=$f['report_image']?>" />
				</div>
			</div>
			<div class="col-sm-8 offset-sm-1">
				<div class="report-proposition__content" appear>
					<div class="report-proposition__title"><?=$f['report_titolo']?></div>
					<div class="report-proposition__abstract"><?=$f['report_sottotitolo']?></div>
					<div class="report-proposition__cta">
						<a href="<?=$f['report_link_cta']?>" class="btn--download"><span><?=($f['report_testo_cta'] != '' ? $f['report_testo_cta'] : __('Read more'))?></span> <svg><use xlink:href="#download"></use></svg></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
