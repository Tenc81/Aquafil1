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
				<?php if($_args['section']['multicol_three_bigger']) : ?>
				<div class="card--numbers__title"><?=$cta['multicol_three_titolo'] ?></div>
				<?php
				if($cta['multicol_three_abstract'] != '') {
					echo '
						<div class="card--numbers__abstract">
							'.$cta['multicol_three_abstract'].'
						</div>';
				}
				echo '<div class="card--numbers__cta">';
				if($cta['multicol_three_link_cta'] != '') {
					if($cta['multicol_three_stile_cta'] == 'testo') {
						echo '<a href="'.$cta['multicol_three_link_cta'].'" target="'.$cta['multicol_three_target_cta'].'" class="btn--category"><span>'.($cta['multicol_three_titolo_cta'] != '' ? $cta['multicol_three_titolo_cta'] : __("Leggi di più", "wstheme")).'</span><svg><use xlink:href="#arrow-next-md"></use></svg></a>';
					} else {
						echo '<a href="'.$cta['multicol_three_link_cta'].'" target="'.$cta['multicol_three_target_cta'].'" class="btn--more">		 <span>'.($cta['multicol_three_titolo_cta'] != '' ? $cta['multicol_three_titolo_cta'] : __("Leggi di più", "wstheme")).'</span><svg><use xlink:href="#arrow-next">	 </use></svg></a>';
					}
				}
				echo '</div>';
				else :
				?>
				<div class="card--icon__icon">
					<?php
					if(!empty($cta['multicol_three_icona_cta'])) {
						echo '<img loading="lazy" src="'.$cta['multicol_three_icona_cta']['url'].'" alt="'.get_the_title().'" />';
					}
					?>
				</div>
				<div class="card--icon__title"><?=$cta['multicol_three_titolo'] ?></div>
				<?php
				if($cta['multicol_three_abstract'] != '') {
					echo '
						<div class="card--icon__abstract">
							<p>'.$cta['multicol_three_abstract'].'</p>
						</div>';
				}
				if($cta['multicol_three_link_cta'] != '') {
					if($cta['multicol_three_stile_cta'] == 'testo') {
						echo '<a href="'.$cta['multicol_three_link_cta'].'" target="'.$cta['multicol_three_target_cta'].'" class="btn--category"><span>'.($cta['multicol_three_titolo_cta'] != '' ? $cta['multicol_three_titolo_cta'] : __("Leggi di più", "wstheme")).'</span><svg><use xlink:href="#arrow-next-md"></use></svg></a>';
					} else {
						echo '<a href="'.$cta['multicol_three_link_cta'].'" target="'.$cta['multicol_three_target_cta'].'" class="btn--more">		 <span>'.($cta['multicol_three_titolo_cta'] != '' ? $cta['multicol_three_titolo_cta'] : __("Leggi di più", "wstheme")).'</span><svg><use xlink:href="#arrow-next">	 </use></svg></a>';
					}
				}
				?>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>
