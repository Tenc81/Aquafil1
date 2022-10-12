<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
		$img_container = '
			<div class="media-text-secondary__offset">';
		if($_args['section']['zoom_txt_image']) {
			$img_container .= '
				<div class="media-text-secondary__picture" gallery="'.$_args['section']['immagine_txt_image']['url'].'" scroll scrollSpeed="1">
					<img loading="lazy" src="'.$_args['section']['immagine_txt_image']['url'].'" alt="<'.get_the_title().'" />';
			ob_start();
			include(locate_template('templates/partials/shared/zoom-button.html'));
			$img_container .= ob_get_contents();
			ob_end_clean();
			$img_container .= '
				</div>';
		} else {
			$img_container .= '
				<div class="media-text-secondary__picture" scroll scrollSpeed="1">
					<img loading="lazy" src="'.$_args['section']['immagine_txt_image']['url'].'" alt="'.get_the_title().'" />
				</div>';
		}
		$img_container .= '
			</div>';

		$txt_container = '
			<div class="media-text-secondary__content" appear>
				<div class="media-text-secondary__title">'.$_args['section']['titolo_txt_image'].'</div>
				<div class="media-text-secondary__abstract">'.$_args['section']['testo_txt_image'].'</div>';
		if($_args['section']['tipo_link_txt_image'] == 'page') {
			if(!empty($_args['section']['link_txt_image'])) {
				$txt_container .= '
					<a href="'.$_args['section']['link_txt_image']['url'].'" target="'.$_args['section']['link_txt_image']['target'].'" class="btn--right"><span>'.$_args['section']['link_txt_image']['title'].'</span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>';
			}
		} elseif($_args['section']['tipo_link_txt_image'] == 'modal') {
			if(!empty($_args['section']['modal_label_txt_image'])) {
				$txt_container .= '
					<div class="text-media-secondary__cta" card-product-detail>
						<button type="button" class="btn--right" (click)="onRequestInfo(\'product-request\', \''.$_args['section']['modal_label_txt_image'].'\', \''.$_args['section']['modal_download_txt_image'].'\', \''.$_args['section']["modal_email_destinatario_txt_image"].'\')">
							<span>'.$_args['section']['modal_label_txt_image'].'</span> <svg><use xlink:href="#arrow-next-md"></use></svg>
						</button>
					</div>';
			}
		} elseif($_args['section']['tipo_link_txt_image'] == 'modals') {
			foreach($_args['section']['bottoni_modali_txt_image'] as $modal) {
				if(!empty($modal['modal_label_txt_image']) && !empty($modal['modal_download_txt_image'])) {
					$txt_container .= '
						<div class="text-media-secondary__cta" card-product-detail>
							<button type="button" class="btn--right" (click)="onRequestInfo(\'product-request\', \''.$modal['modal_label_txt_image'].'\', \''.$modal['modal_download_txt_image'].'\', \''.$modal["modal_email_destinatario_txt_image"].'\')">
								<span>'.$modal['modal_label_txt_image'].'</span> <svg><use xlink:href="#arrow-next-md"></use></svg>
							</button>
						</div>';
				}
		 	}
		}
		$txt_container .= '
			</div>';
?>
<div class="media-text-secondary" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<?php
			if($_args['section']['inverti_txt_image']) {
				echo '
					<div class="col-sm-10 offset-sm-2 col-md-8 offset-md-3">
					'.$img_container.'
					</div>
					<div class="col-sm-8 offset-sm-2 col-md-7 offset-md-2">
					'.$txt_container.'
					</div>';
			} else {
				echo '
					<div class="col-sm-8 offset-sm-2 col-md-7 offset-md-3 o-2">
					'.$txt_container.'
					</div>
					<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-3 o-1">
					'.$img_container.'
					</div>';
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>
