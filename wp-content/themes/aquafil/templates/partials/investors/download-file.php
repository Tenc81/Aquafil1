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
  <h2 class="page--investors__section-title"><?= $_args['section']['titolo_download_file']; ?></h2>

	<?php
	echo !empty($_args['section']['immagine_download_file']) ? '<img src="'.$_args['section']['immagine_download_file']['url'].'">' : '';
	echo !empty($_args['section']['descrizione_download_file']) ? '<p>'.$_args['section']['descrizione_download_file'].'</p>' : '';
	echo '<a href="#" download="'.$_args['section']['download_file']['filename'].'" class="btn--certification"><span>'.$_args['section']['etichetta_download_file'].'</span> <span class="icon"><svg><use xlink:href="#download"></use></svg></span></a>';
	?>
  
</section>
<?php endif; ?>
