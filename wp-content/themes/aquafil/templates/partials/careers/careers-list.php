<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="careers-list">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="careers-list__text-top"><?= $_args['section']['titolo_candidature'] ?></div>
				<?php
				if(!empty($_args['section']['candidature'])) {
					echo '
						<div class="careers-list__items">';
					foreach($_args['section']['candidature'] as $career) {
						if($career["apri_link_esterno"]) {
							echo '
								<div class="careers-list__item">
									<div class="careers-list__item-name">'.$career['nazione_candidatura'].'</div>
									<div class="careers-list__item-links">
										<a href="'.($career["link_esterno"] ? $career["link_esterno"] : 'javascript:void(0)').'" target="_blank">'.__("Invia", "wstheme").' <svg><use xlink:href="#arrow-next-md"></use></svg></a>
									</div>
								</div>';
						} else {
							echo '
								<div class="careers-list__item" open-modally="#detail-'.sanitize_title($career['nazione_candidatura']).'">
									<div class="careers-list__item-name">'.$career['nazione_candidatura'].'</div>
									<div class="careers-list__item-links">
										'.__("Invia", "wstheme").' <svg><use xlink:href="#arrow-next-md"></use></svg>
									</div>
									<!-- in page detail - 1 -->
									<div class="card--side-modal" careers-modal id="detail-'.sanitize_title($career['nazione_candidatura']).'" countryOfInterestId="'.sanitize_title($career['nazione_candidatura']).'">';
							include(locate_template('templates/partials/modals/careers-modal.html'));
							echo '
									</div>
								</div>';
						}
					}
					echo '
						</div>';
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
