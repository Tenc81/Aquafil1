<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="case-studies-hero">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="case-studies-hero__content" appear>
					<div class="case-studies-hero__title"><?= $_args['section']['titolo_cs_hero'] ?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 offset-sm-3 col-md-7 offset-md-4">
				<div class="case-studies-hero__content" appear>
					<div class="case-studies-hero__abstract"><?= $_args['section']['sottotitolo_cs_hero'] ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
