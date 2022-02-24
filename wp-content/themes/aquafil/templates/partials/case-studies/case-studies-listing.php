<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
	if($_args['section']['aggiungi_filtri']) {
		global $wpdb;
		$query = "
			SELECT t.*, tt.count
			FROM ".$wpdb->posts." p JOIN ".$wpdb->term_relationships." tr JOIN ".$wpdb->terms." t JOIN ".$wpdb->term_taxonomy." tt
			ON p.ID=tr.object_id AND tr.term_taxonomy_id=t.term_id AND t.term_id=tt.term_id
			WHERE p.ID IN (%s) AND tt.taxonomy='category'
			GROUP BY t.term_id, tt.count";
		$s = sprintf($query, implode(',', $_args['section']['case_studies']));
		$filters = $wpdb->get_results(sprintf($query, implode(',', $_args['section']['case_studies'])));
		if(!empty($filters)) {
			echo '
				<div class="horizontal-menu borders">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
								<div class="horizontal-menu__content">
									<div class="horizontal-menu__title">'.__("Filtra per", "wstheme").'</div>
									<ul class="nav--horizontal-menu">';
			foreach($filters as $filter) {
				echo '
										<li class="nav__item"><a href="'.get_category_link($filter->term_id).'" style="color:inherit"><span class="name">'.$filter->name.'</span> <span class="count">('.$filter->count.')</span></a></li>';
			}
			echo '
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>';
		}
	}
?>
<div class="case-studies-listing borders">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="listing--case-studies">
					<?php
					foreach($_args['section']['case_studies'] as $case) {
						echo '
							<div class="listing__item" appear>';
						get_template_part('templates/partials/case-studies/card-case-studies', null, array('ID' => $case));
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
