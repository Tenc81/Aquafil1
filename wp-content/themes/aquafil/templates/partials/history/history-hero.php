<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="history-hero">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2">
				<div class="history-hero__content" appear>
					<div class="history-hero__title"><?= $_args['section']['titolo_hi_hero'] ?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9 offset-sm-2 col-md-8 offset-md-3">
				<div class="history-hero__content" appear>
					<div class="history-hero__abstract"><?= $_args['section']['sottotitolo_hi_hero'] ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
