<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="address-detail">
	<div class="container-fluid">
		<div class="row">
			<?php
			foreach($_args['section']['indirizzi'] as $i=>$address) {
				switch($i%4) {
					case 0:
						echo '
							<div class="col-12 col-sm-4 offset-sm-2 col-md-3 offset-md-3">';
						break;
					default:
						echo '
							<div class="col-12 col-sm-4 offset-sm-1 col-md-3 offset-md-2">';
				}
				echo '
								<div class="card--address">
									<div class="card--address__title">'.$address['tipologia'].'</div>
									<div class="card--address__abstract">'.$address['dettaglio'].'</div>
								</div>
							</div>';

			}
			?>
		</div>
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3 address-detail__divline"></div>
		</div>
	</div>
</div>
<?php endif; ?>
