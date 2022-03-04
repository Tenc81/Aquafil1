<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<!-- PROFILE PROPOSITION -->
<div class="profile-proposition" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 background-primary">
				<div class="profile-proposition__picture">
					<img loading="lazy" src="<?= $_args['section']['profile_image']?>" scroll />
				</div>
			</div>
			<div class="col-sm-8 offset-sm-6 col-md-7 offset-md-6">
				<div class="profile-proposition__content" appear>
					<div class="profile-proposition__category"><?= $_args['section']['profile_abstract']?></div>
					<div class="profile-proposition__title"><?= $_args['section']['profile_titolo']?></div>
					<div class="profile-proposition__abstract"><?= $_args['section']['profile_sottotitolo']?></div>
					<div class="profile-proposition__cta">
						<a href="<?= $_args['section']['profile_link_cta']?>" class="btn--primary" target="<?= $_args['section']['profile_target_cta']?>"><?=( $_args['section']['profile_testo_cta'] != '' ? $_args['section']['profile_testo_cta'] : __('Read more'))?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
