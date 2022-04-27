<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
	$list_html = '
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
					<div class="listing--downloads">';
	$filterstypes = array("categories" => array(), "countries" => array());
	foreach($_args['section']['downloads'] as $download) {
		$countries = '';
		foreach($download["nazione_multiselect_downloads"] as $nazione) {
			$countries .= ' '.sanitize_title($nazione);
			if(!isset($filterstypes["countries"][$nazione])) {
				$filterstypes["countries"][$nazione] = 0;
			}
			$filterstypes["countries"][$nazione] += count($download['lista_downloads']);
		}
		$categories = '';
		foreach($download["categoria_multiselect_downloads"] as $categoria) {
			$category = get_term_field('name', $categoria);
			$categories .= ' '.sanitize_title($category);
			if(!isset($filterstypes["categories"][$category])) {
				$filterstypes["categories"][$category] = 0;
			}
			$filterstypes["categories"][$category] += count($download['lista_downloads']);
		}
		ob_start();
		get_template_part("templates/partials/shared/cards-certification", null, array("section" => $download, "class" => $countries.$categories));
		$list_html .= ob_get_contents();
		ob_end_clean();
	}
	$list_html .= '
					</div>
				</div>
			</div>
		</div>';
	foreach($filterstypes as $type=>$filters) {
		if(!empty($filters)) {
			$total = array_sum($filters);
			echo '
				<div class="horizontal-menu">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
								<div class="horizontal-menu__content">
									<div class="horizontal-menu__title">'.($type=="countries" ? __("Filtra per nazione", "wstheme") : __("Filtra per categoria", "wstheme")).'</div>
									<ul class="nav--horizontal-menu certs--filters">
										<li class="nav__item"><a href="javascript:void(0);" class="active" data-filter="all"><span class="name">'.__("Tutte", "wstheme").'</span> <span class="count">('.$total.')</span></a></li>';
			foreach($filters as $filter=>$count) {
				echo '
										<li class="nav__item"><a href="javascript:void(0);" data-filter="'.sanitize_title($filter).'"><span class="name">'.$filter.'</span> <span class="count">('.$count.')</span></a></li>';
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
					$(".certs--filters a").on("click", function() {
						$(".listing__item").hide();
						$(this).closest(".certs--filters").find("a").removeClass("active");
						$(this).addClass("active");

						var flclasses = [".listing__item"];
						$(".certs--filters a.active").each(function(index, f) {
							if($(f).attr("data-filter")!="all")
								flclasses.push($(f).attr("data-filter"));
						});
						$(flclasses.join(".")).show();
					});
				})(jQuery)
				</script>';
		}
	}
?>
<div class="certification borders" <?=setAnchor($_args['section']);?>>
	<?= $list_html; ?>
</div>
<?php endif; ?>
