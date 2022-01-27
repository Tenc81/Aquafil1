<!-- PROFILE PROPOSITION -->
<div class="profile-proposition">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 background-primary">
				<div class="profile-proposition__picture">
					<img loading="lazy" src="<?=$f['profile_image']?>" scroll />
				</div>
			</div>
			<div class="col-sm-8 offset-sm-6 col-md-7 offset-md-6">
				<div class="profile-proposition__content" appear>
					<div class="profile-proposition__category"><?=$f['profile_abstract']?></div>
					<div class="profile-proposition__title"><?=$f['profile_titolo']?></div>
					<div class="profile-proposition__abstract"><?=$f['profile_sottotitolo']?></div>
					<div class="profile-proposition__cta">
						<a href="<?=$f['profile_url_cta']?>" class="btn--primary" target="<?=$f['profile_target_cta']?>"><?=($f['profile_testo_cta'] != '' ? $f['profile_testo_cta'] : __('Read more'))?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
