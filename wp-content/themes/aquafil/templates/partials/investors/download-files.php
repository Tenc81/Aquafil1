<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<section <?= setAnchor($_args['section']); ?>>
  <h2 class="page--investors__section-title"><?= $_args['section']['titolo_download_files']; ?></h2>
	<?php
	if(!empty($_args['section']['download_files'])) {
		echo '
			<div class="page--investors__downloads">';
		foreach($_args['section']['download_files'] as $download) {
			$file = get_attached_file($download['download_file']["id"]);
			$filesize = formatSizeUnits(filesize($file));
			echo '
				<div class="page--investors__downloads-item">
					<p class="page--investors__downloads-item-label">'.$download['etichetta_download_file'].'</p>
					<a href="'.$download['download_file']['url'].'" download="'.$download['download_file']['filename'].'" class="btn--investor"><span>'.strtoupper($download['download_file']['subtype']).' - '.$filesize.'</span> <span class="icon"><svg><use xlink:href="#download"></use></svg></span></a>
				</div>';
		}
		echo '
			</div>';
	}
	?>
</section>
<?php endif; ?>
