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
  <h2 class="page--investors__section-title"><?= $_args['section']['titolo_directors']; ?></h2>
  <div class="page--investors__text-intro"><?= $_args['section']['sottotitolo_directors']; ?></div>
	<?php
	if(!empty($_args['section']['directors'])) {
		echo '
			<div class="listing-board">';
		foreach($_args['section']['directors'] as $i=>$director) {
			$img = $director['immagine'];
			echo '
				<div class="listing-board__card">
					<div class="card--product" open-modally="#detail-'.($i+1).'">
						<div class="listing-board__image">
						'.(!empty($img) ? '
							<img src="'.$img['url'].'">
							<button type="button" class="btn--plus listing-board__btn"><svg><use xlink:href="#plus"></use></svg></button>' : '').'
						</div>
						<div class="listing-board__name">'.$director['nome'].'</div>
						<div class="listing-board__role">'.$director['ruolo'].'</div>
					</div>
					<!-- in page detail -->
					<div class="card--side-modal" card-product-detail id="detail-'.($i+1).'">
						<div class="card--side-modal__content">
							<div class="card--side-modal__title">'.$director['nome'].'</div>
							<div class="card--side-modal__text">'.$director['ruolo'].'</div>
							<div class="card--side-modal__abstract">'.$director['descrizione'].'</div>
						</div>
					</div>
				</div>';
		}
		echo '
			</div>';
	}
	echo $_args['section']['descrizione_directors']; 
	?>
</section>
<?php endif; ?>
