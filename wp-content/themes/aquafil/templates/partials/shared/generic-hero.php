<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="generic-hero secondary">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="generic-hero__content" appear>
					<div class="generic-hero__title"><?= $_args['section']["title"]; ?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 offset-sm-3 col-md-7 offset-md-4">
				<div class="generic-hero__content" appear>
					<div class="generic-hero__abstract"><?= $_args['section']["text"]; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
