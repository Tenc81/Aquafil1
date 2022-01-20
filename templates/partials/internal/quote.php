<div class="quote" <?=setAnchor($f);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-19 offset-md-2 order-sm-1 order-2">
				<div class="quote__content" appear>
					<div class="quote__title">
						<svg><use xlink:href="#quote"></use></svg><?=$f['internal_quote_titolo']?></div>
					<div class="quote__abstract"><?=$f['internal_quote__abstract']?></div>
				</div>
			</div>
			<div class="col-sm-6 order-sm-2 order-1 quote__inset">
				<div class="quote__picture" scroll scrollSpeed="1">
					<img loading="lazy" src="<?=$f['internal_quote_image']?>" />
				</div>
			</div>
		</div>
	</div>
</div>