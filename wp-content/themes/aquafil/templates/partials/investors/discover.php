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
  <h2 class="page--investors__section-title"><?= $_args['section']['titolo_discover']; ?></h2>
	<?php
	$video = $_args['section']['video_discover'];
	if(!empty($video)) {
		echo '
  <div class="responsive-iframe__container">
    <iframe class="responsive-iframe__iframe" src="'.$video.'" frameborder="0"></iframe>
  </div>';
	}
	echo $_args['section']['descrizione_discover']; 
	?>
</section>
<?php endif; ?>
