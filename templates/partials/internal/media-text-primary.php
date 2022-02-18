<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="<?= $_args['section']['internal_media_bg']; ?>" <?=setAnchor($_args['section']);?>>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 offset-sm-2 col-md-13 offset-md-2">
					<?php if($_args['section']['internal_media_zoom_image']) : ?>
					<div class="<?= $_args['section']['internal_media_bg']; ?>__picture" gallery="<?= $_args['section']['internal_media_image'] ?>" scroll scrollSpeed="1">
						<img loading="lazy" src="<?= $_args['section']['internal_media_image'] ?>" />
						<?php include(locate_template('templates/partials/shared/zoom-button.html')); ?>
					</div>
					<?php else : ?>
					<div class="<?= $_args['section']['internal_media_bg']; ?>__picture" scroll scrollSpeed="1">
						<img loading="lazy" src="<?= $_args['section']['internal_media_image'] ?>" />
					</div>
					<?php endif; ?>
				</div>
				<div class="col-sm-7 offset-sm-1 col-md-7 offset-md-1">
					<div class="<?= $_args['section']['internal_media_bg']; ?>__content" appear>
						<div class="<?= $_args['section']['internal_media_bg']; ?>__title"><?= $_args['section']['internal_media_titolo'] ?></div>
						<div class="<?= $_args['section']['internal_media_bg']; ?>__abstract"><?= $_args['section']['internal_media_abstract'] ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
