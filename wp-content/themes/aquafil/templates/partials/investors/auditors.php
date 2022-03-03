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
  <h2 class="page--investors__section-title"><?= $_args['section']['titolo_auditors']; ?></h2>

	<?php
  echo !empty($_args['section']['sottotitolo_auditors']) ? '<p>'.$_args['section']['sottotitolo_auditors'].'</p>' : '';

	foreach($_args['section']['auditors'] as $i=>$auditor) {
		echo '
			<div class="gray-card">
				<span class="gray-card__name">'.$auditor['nome'].'</span>
				<span class="gray-card__role">'.$auditor['ruolo'].'</span>
			</div>';
	}
	?>
</section>
<?php endif; ?>
