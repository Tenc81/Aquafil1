<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
	$descr = !empty($_args['section']['descrizione_stock_chart']) ? $_args['section']['descrizione_stock_chart'] : '';
	$imgs = '';
	foreach($_args['section']['grafici_stock_chart'] as $img) {
		$imgs .= '<img src="'.$img["url"].'">';
	}
	echo '
		<section '.setAnchor($_args['section']).'>';
	if(!empty($_args['section']['titolo_stock_chart'])) {
		echo '<h2 class="page--investors__section-title">'.$_args['section']['titolo_stock_chart'].'</h2>';
	}
	
	echo $_args['section']['descrizione_sotto'] ? $imgs.$descr : '<div class="page--investors__text-intro">'.$descr.'</div>'.$imgs;

	echo '
		</section>';
endif; 
?>