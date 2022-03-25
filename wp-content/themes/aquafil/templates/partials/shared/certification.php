<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
	$class_prefix = $_args['section']['padding_downloads'];
?>
<div class="<?= $class_prefix; ?> borders" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<?php
				if($_args['section']['titolo_downloads'] != '') {
					echo '<div class="'.$class_prefix.'__title">'.$_args['section']['titolo_downloads'].'</div>';
				}
				echo '<div class="listing--downloads">';
				get_template_part("templates/partials/shared/cards-certification", null, array("section" => $_args['section']));
				echo '</div>';
				?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
