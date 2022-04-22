<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
	if($_args['section']['aggiungi_filtri']) {
		$filters = array();
		$categories = array_column($_args['section']['histories'], 'categoria_hi');
		foreach($categories as $category) {
			if(!isset($filters[$category])) {
				$filters[$category] = 0;
			}
			$filters[$category] += 1;
		}
		if(!empty($filters)) {
			echo '
				<div class="horizontal-menu">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
								<div class="horizontal-menu__content">
									<div class="horizontal-menu__title">'.__("Filtra per", "wstheme").'</div>
									<ul class="nav--horizontal-menu">
										<li class="nav__item"><a href="javascript:void(0);" class="history-filter active" data-filter="all"><span class="name">'.__("Tutte", "wstheme").'</span> <span class="count">('.count($_args['section']['histories']).')</span></a></li>';
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
					$("body").on("click", ".history-filter", function() {
						$(".listing__item").show();
						$(".history-filter").removeClass("active");
						$(this).addClass("active");
						if($(this).attr("data-filter")!="all" && $(this).not(".active")) {
							$(".card--history").not("."+$(this).attr("data-filter")).parent().hide();
						}
					});
				})(jQuery);
				</script>';
		}
	}
?>
<div class="history-listing">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-20 offset-md-2">
				<div class="listing--history">
					<?php
					foreach($_args['section']['histories'] as $history) {
						echo '
							<div class="listing__item '.$history['dimensione_card_hi'].'" appear>';
						get_template_part('templates/partials/history/card-history', null, array('history' => $history));
						echo '
							</div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
