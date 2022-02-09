<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="product-proposition">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="product-proposition__title"><?= $_args['section']['titolo_prodotti_correlati']; ?></div>
				<div class="listing--product">
					<?php
					foreach($_args['section']['prodotti_correlati'] as $i=>$product) {
						$thumb = $product['thumb_prodotto'];
						$img = $product['immagine_prodotto'];
						$link = $product['link_prodotto'];
						echo '
							<div class="listing__item" appear>
								<div class="card--product" open-modally="#detail-'.($i+1).'">
									<div class="card--product__picture">
										'.(!empty($thumb) ? '<img loading="lazy" src="'.$thumb["url"].'" alt="'.$product['titolo_prodotto'].'" />' : '').'
									</div>
									<div class="card--product__content">
										<div class="card--product__title">'.$product['titolo_prodotto'].'</div>
										<div class="card--product__abstract">'.$product['descrizione_breve_prodotto'].'</div>
										<div class="card--product__cta">
											<button type="button" class="btn--plus"><svg><use xlink:href="#plus"></use></svg></button>
										</div>
									</div>
								</div>
								<!-- in page detail - 1 -->
								<div class="card--side-modal" card-product-detail id="detail-'.($i+1).'">
									<div class="card--side-modal__picture">
										'.(!empty($img) ? '<img loading="lazy" src="'.$img["url"].'" alt="'.$product['titolo_prodotto'].'" />' : '').'
									</div>
									<div class="card--side-modal__content">
										<div class="card--side-modal__title">'.$product['titolo_prodotto'].'</div>
										<div class="card--side-modal__abstract">'.$product['descrizione_estesa_prodotto'].'</div>
									</div>
									<div class="card--side-modal__cta">
										'.(!empty($link) ? '<a href="'.$link["url"].'" class="btn--more-md"><span>'.$link["title"].'</span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>' : '').'
										<button type="button" class="btn--more-md" (click)="onRequestInfo()"><span>'.__("Maggiori informazioni", "wstheme").'</span> <svg><use xlink:href="#pencil"></use></svg></button>
									</div>
								</div>
							</div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
