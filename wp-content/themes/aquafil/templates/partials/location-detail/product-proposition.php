<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
	if($_args['section']['aggiungi_filtri']) {
		echo '
			<div class="title-text" id="applications">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
							<div class="title-text__content" appear>
								<div class="title-text__title">'.$_args['section']['titolo_prodotti_correlati'].'</div>
							</div>
						</div>
					</div>
				</div>';
		$filters = array();
		$categories = array_column($_args['section']['filtri_prodotti_correlati'], 'titolo_filtro_prodotti_correlati');
		foreach($categories as $category) {
		  if(!isset($filters[$category])) {
		    $filters[$category] = 0;
		  }
		}
		foreach($_args['section']['prodotti_correlati'] as $product) {
			$flts = explode(',', $product['filtro_prodotto']);
			foreach($flts as $filter) {
				$filters[$filter] += 1;
			}
		}
		echo '
			</div>';			
		if(!empty($filters)) {
			echo '
				<div class="horizontal-menu">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
								<div class="horizontal-menu__content">
									<div class="horizontal-menu__title">'.__("Filtra per applicazione", "wstheme").'</div>
									<ul class="nav--horizontal-menu">
										<li class="nav__item"><a href="javascript:void(0);" class="history-filter active" data-filter="all"><span class="name">'.__("Tutte", "wstheme").'</span> <span class="count">('.count($_args['section']['prodotti_correlati']).')</span></a></li>';
			foreach($filters as $filter=>$count) {
				echo '
										<li class="nav__item"><a href="javascript:void(0);" class="history-filter" data-filter="'.sanitize_title($filter).'"><span class="name">'.$filter.'</span> <span class="count">('.$count.')</span></a></li>';
			}
			echo '
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>
				(function($) {
					$(".history-filter").on("click", function() {
						$(".listing__item").show();
						$("[class$=-details]").hide();
						$(".history-filter").removeClass("active");
						$(this).addClass("active");
						if($(this).attr("data-filter")!="all" && $(this).not(".active")) {
							$(".listing__item").not("."+$(this).attr("data-filter")).hide();
							$("."+$(this).attr("data-filter")+"-details").show();
						}
					});
				})(jQuery);
				</script>';
		}
	}
?>
<div class="product-proposition" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
			<?php
			if($_args['section']['aggiungi_filtri']) {
				foreach($_args['section']['filtri_prodotti_correlati'] as $filtro) {
					echo '
						<div class="row '.sanitize_title($filtro['titolo_filtro_prodotti_correlati']).'-details" style="display:none;">
							<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
								<div class="product-proposition__content" appear>
									<div class="product-proposition__title-small">'.$filtro['titolo_filtro_prodotti_correlati'].'</div>
								</div>
							</div>
							<div class="col-sm-20 offset-sm-2 col-md-8 offset-md-3">
								<div class="product-proposition__content" appear>
									<div class="product-proposition__abstract">'.$filtro['descrizione_col1_filtro_prodotti_correlati'].'</div>
								</div>
							</div>
							<div class="col-sm-20 offset-sm-2 col-md-8 offset-md-2">
								<div class="product-proposition__content" appear>
									<div class="product-proposition__abstract">'.$filtro['descrizione_col2_filtro_prodotti_correlati'].'</div>
								</div>
							</div>
						</div>';
				}
				echo '
						<div class="row">
							<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">';
			} else {
				echo '
						<div class="row">
							<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
								<div class="product-proposition__title">'.$_args['section']['titolo_prodotti_correlati'].'</div>';
			}
			echo '
								<div class="listing--product">';
			foreach($_args['section']['prodotti_correlati'] as $i=>$product) {
				$thumb = $product['thumb_prodotto'];
				$img = $product['immagine_prodotto'];
				$link = $product['link_prodotto'];
				$filters = explode(',', $product['filtro_prodotto']);
				$filters = array_map(function($filter) {
					return sanitize_title(trim($filter));
				}, $filters);
				echo '
									<div class="listing__item '.($_args['section']['aggiungi_filtri'] ? implode(' ', $filters) : '').'" appear>
										<div class="card--product" open-modally="#'.sanitize_title($_args['section']['titolo_prodotti_correlati']).'-detail-'.($i+1).'">
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
										<div class="card--side-modal" card-product-detail id="'.sanitize_title($_args['section']['titolo_prodotti_correlati']).'-detail-'.($i+1).'">
											'.(!empty($img) ? '
											<div class="card--side-modal__picture">
												<img loading="lazy" src="'.$img["url"].'" alt="'.$product['titolo_prodotto'].'" />
											</div>' : '').'
											<div class="card--side-modal__content">
												<div class="card--side-modal__title">'.$product['titolo_prodotto'].'</div>
												<div class="card--side-modal__abstract">'.$product['descrizione_estesa_prodotto'].'</div>
											</div>
											<div class="card--side-modal__cta">
												'.(!empty($link) ? '<a href="'.$link["url"].'" class="btn--more-md"><span>'.$link["title"].'</span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>' : '').
												($product['inserisci_bottone_contatti_prodotto'] ? '
												<button type="button" class="btn--more-md" (click)="onRequestInfo(\'product-request\', \''.$product['titolo_prodotto'].'\', \'\', \''.$product["email_destinatario_prodotto"].'\')">
													<span>'.__("Maggiori informazioni", "wstheme").'</span> <svg><use xlink:href="#pencil"></use></svg>
												</button>' : '').'
											</div>
										</div>
									</div>';
			}
			echo '
								</div>
							</div>
						</div>';
			?>
	</div>
</div>
<?php endif; ?>
