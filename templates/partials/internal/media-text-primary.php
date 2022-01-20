<div class="media-text-primary" <?=setAnchor($f);?>>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-11 offset-sm-1 col-md-11 offset-md-1">
					<div class="media-text-primary__picture" gallery="<?=$f['internal_media_image']?>" scroll scrollSpeed="1">
						<img loading="lazy" src="<?=$f['internal_media_image']?>" />
					</div>
				</div>
				<div class="col-sm-7 offset-sm-2 col-md-7 offset-md-2">
					<div class="media-text-primary__content" appear>
						<div class="media-text-primary__title"><?=$f['internal_media_titolo']?></div>
						<div class="media-text-primary__abstract"><?=$f['internal_media_abstract']?></div>
					</div>
				</div>
			</div>
		</div>
	</div>