<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section']) && !empty($_args['section']['tabella'])) :
	foreach($_args['section']['tabella'] as $index=>$table)  {
		echo '
			<section '.($index==0 ? setAnchor($_args['section']) : '').'>';
		if(!empty($table['titolo_tabella'])) {
			echo '
				<h2 class="page--investors__section-title">'.$table['titolo_tabella'].'</h2>';
		}
		if(!empty($table['descrizione_tabella'])) {
			echo '
				<div class="">
					<p>'.$table['descrizione_tabella'].'</p>
				</div>';
		}
		echo '
				<div class="table">
					<div class="table__row table__row--head">';
		foreach($table['intestazione_tabella'] as $i=>$column) {
			echo '
						<div class="table__cell"'.($i==count($table['intestazione_tabella'])-1 ? ' data-align="right"' : '').'>
							<div class="table__value">'.$column['colonna_tabella'].'</div>
						</div>';
		}
		echo '
					</div>';
		for($i=0; $i<(ceil(count($table['corpo_tabella'])/count($table['intestazione_tabella']))*count($table['intestazione_tabella'])); $i++) {
			$cell = $i<count($table['corpo_tabella']) ? $table['corpo_tabella'][$i]['colonna_tabella'] : '';
			if($i%count($table['intestazione_tabella']) == 0) {
			echo '
					<div class="table__row">';
			}
			echo '
						<div class="table__cell" data-title="'.$table['intestazione_tabella'][$i%count($table['intestazione_tabella'])]['colonna_tabella'].'"'.($i%count($table['intestazione_tabella']) == count($table['intestazione_tabella'])-1 ? ' data-align="right"' : '').'>
							<div class="table__value">'.$cell.'</div>
						</div>';
			if($i%count($table['intestazione_tabella']) == count($table['intestazione_tabella'])-1) {
			echo '
					</div>';
			}
		}
		if(!empty($table['piede_tabella'])) {
			echo '
					<div class="table__row table__row--foot">';
			foreach($table['piede_tabella'] as $i=>$cell) {
				echo '
						<div class="table__cell"'.($i==count($table['piede_tabella'])-1 ? ' data-align="right"' : '').'>
							<div class="table__value">'.$cell['colonna_tabella'].'</div>
						</div>';
			}
			echo '
					</div>';
		}
		echo '
				</div>
			</section>';
	}
	endif;
?>