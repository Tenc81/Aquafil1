<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="careers-hero" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="careers-hero__content" appear>
					<div class="careers-hero__title"><?= $_args['section']['careers_title_titolo'] ?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9 offset-sm-2 col-md-7 offset-md-4">
				<div class="careers-hero__content" appear>
					<div class="careers-hero__abstract"><?= $_args['section']['careers_title_abstract_st'] ?></div>
				</div>
			</div>
			<div class="col-sm-9 offset-sm-2 col-md-7 offset-md-1">
				<div class="careers-hero__content" appear>
					<div class="careers-hero__abstract"><?= $_args['section']['careers_title_abstract_nd'] ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
