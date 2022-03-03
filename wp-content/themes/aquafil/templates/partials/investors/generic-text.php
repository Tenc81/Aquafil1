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
	<?php
	echo !empty($_args['section']['titolo_generico']) ? '<h2 class="page--investors__section-title">'.$_args['section']['titolo_generico'].'</h2>' : '';
	echo !empty($_args['section']['testo_generico']) ? $_args['section']['testo_generico'] : ''; 
	?>
</section>
<?php endif; ?>
