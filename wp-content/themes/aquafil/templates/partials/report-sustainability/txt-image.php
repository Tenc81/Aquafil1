<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="media-text-secondary">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 offset-sm-2 col-md-9 offset-md-3">
				<?php
				$img_container = '
					<div class="media-text-secondary__offset">';
				if($_args['section']['zoom_txt_image']) {
					$img_container .= '
						<div class="media-text-secondary__picture" gallery="'.$_args['section']['immagine_txt_image']['url'].'" scroll scrollSpeed="1">
							<img loading="lazy" src="'.$_args['section']['immagine_txt_image']['url'].'" alt="<'.get_the_title().'" />';
							<?php include(locate_template('templates/partials/shared/zoom-button.html')); ?>
						</div>';
				} else {
					$img_container .= '
						<div class="media-text-secondary__picture" scroll scrollSpeed="1">
							<img loading="lazy" src="'.$_args['section']['immagine_txt_image']['url'].'" alt="'.get_the_title().'" />
						</div>';
				}
				$img_container .= '
					</div>';
				?>
			</div>
			<div class="col-sm-8 offset-sm-2 col-md-7 offset-md-2">
				<div class="media-text-secondary__content" appear>
					<div class="media-text-secondary__title"><?= $_args['section']['titolo_txt_image']; ?></div>
					<div class="media-text-secondary__abstract"><?= $_args['section']['testo_txt_image']; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
