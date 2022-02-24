<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="title-hero-02" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="title-hero-02__content" appear>
					<div class="title-hero-02__title"><?= $_args['section']['internal_title_titolo'] ?></div>
				</div>
			</div>
			<div class="col-sm-10 offset-sm-2 col-md-9 offset-md-3">
				<div class="title-hero-02__content" appear>
					<div class="title-hero-02__abstract"><?= $_args['section']['internal_title_abstract'] ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
