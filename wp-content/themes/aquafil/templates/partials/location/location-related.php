<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section']) && !empty($_args['section']['location_related'])) :
	$img = $_args['section']['immagine_location_related'];
?>
<div class="global-capabilities">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="global-capabilities__content" appear>
					<div class="global-capabilities__title"><?= $_args['section']['titolo_location_related']; ?></div>
					<?= !empty($img) ? '<div class="global-capabilities__image"><img src="'.$img["url"].'" alt="'.get_the_title().'"></div>' : ''; ?>
				</div>
			</div>
		</div>
		<div class="row global-capabilities__contacts" appear>
			<?php
			foreach($_args['section']['location_related'] as $i=>$location) {
				$loc_fields = get_fields($location);
				echo '
					<div class="col-sm-20 offset-sm-2 col-md-5 offset-md-'.($i%3==0 ? '3' : '1').' global-capabilities__contacts-item">
						<div class="global-capabilities__contacts-icon">
							<svg><use xlink:href="#pin"></use></svg>
						</div>
						<div class="global-capabilities__contacts-block">
							<div class="global-capabilities__contacts-title">'.get_the_title($location).'</div>
							<div class="global-capabilities__contacts-text">
								<p>'.$loc_fields['abstract'].'</p>
								<p>'.$loc_fields['pretitle'].'</p>';
				$infos = array_filter($loc_fields['sezioni'], function($section) {
					return $section['acf_fc_layout']=='location-detail-address-detail';
				});
				if(!empty($infos)) {
					echo '<p>';
					foreach($infos as $info) {
						foreach($info['indirizzi'] as $address) {
							$address['dettaglio'] = str_replace('<p>', '', $address['dettaglio']);
							$address['dettaglio'] = str_replace('</p>', '<br />', $address['dettaglio']);
							echo $address['dettaglio'];
						}
					}
					echo '</p>';
				}
				echo '
							</div>
						</div>
					</div>';
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>