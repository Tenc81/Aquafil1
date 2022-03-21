<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="title-text borders<?= $_args['section']['internal_multicol_bg'] == "blu" ? " negative" : ''; ?>" <?=setAnchor($_args['section']);?>>
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
						<?php
						if($cta['multicol_two_testo_cta'] != '') {
							echo '
								<div class="title-text__description">
									<p>'.$cta['multicol_two_testo_cta'].'</p>
								</div>';
						}
						if($cta['multicol_two_link_cta'] != 'javascript:void(0);') {
							if($cta['multicol_two_stile_cta'] == 'testo') {
								echo '<a href="'.$cta['multicol_two_link_cta'].'" target="'.$cta['multicol_two_target_cta'].'" class="btn--category"><span>'.($cta['multicol_two_titolo_cta'] != '' ? $cta['multicol_two_titolo_cta'] : __("Leggi di più", "wstheme")).'</span><svg><use xlink:href="#arrow-next-md"></use></svg></a>';
							} else {
								echo '<a href="'.$cta['multicol_two_link_cta'].'" target="'.$cta['multicol_two_target_cta'].'" class="btn--primary"> <span>'.($cta['multicol_two_titolo_cta'] != '' ? $cta['multicol_two_titolo_cta'] : __("Leggi di più", "wstheme")).'</span></a>';
							}
						}
						?>
					</div>
				</div>
			<?php endforeach; ?>

		</div>
	</div>
</div>
<?php endif; ?>
