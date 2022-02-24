<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0,
		'class' => ''
  ));
if(!empty($_args['section'])) :
foreach($_args['section']['lista_downloads'] as $download) {
	$file = $download['file_download'];
	if(!empty($file)) {
		echo '
			<div class="listing__item '.$_args['class'].'">
				<a href="'.$file['url'].'" class="btn--certification">
					<span>'.$download['titolo_download'].'</span>
					<span class="icon">
						<svg><use xlink:href="#download"></use></svg>
					</span>
				</a>
			</div>';
	}
}
endif;
?>
