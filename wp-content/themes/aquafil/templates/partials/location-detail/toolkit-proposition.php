<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="toolkit-proposition">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="toolkit-proposition__title"><?= $_args['section']['titolo_toolkits_correlati']; ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-18 offset-sm-3 col-md-14 offset-md-5">
				<!-- swiper -->
				<div class="swiper-container" swiper-toolkit>
					<div class="swiper-wrapper">
						<?php
						foreach($_args['section']['toolkits_correlati'] as $i=>$toolkit) {
							$img = $toolkit['immagine_toolkit'];
							$html = $toolkit['html_toolkit'];
							echo '
								<!-- slide -->
								<div class="swiper-slide">
									<div class="card--toolkit">
										<div class="card--toolkit__picture">
											'.(!empty($img) ? '<img loading="lazy" src="'.$img["url"].'" alt="'.$toolkit['titolo_toolkit'].'" />' : '').'
										</div>
										<div class="card--toolkit__content">
											<div class="card--toolkit__title">'.$toolkit['titolo_toolkit'].'</div>
											<div class="card--toolkit__abstract">'.$toolkit['descrizione_breve_toolkit'].'</div>
											<div class="card--toolkit__cta">
												'.$html.'
											</div>
										</div>
									</div>
								</div>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
