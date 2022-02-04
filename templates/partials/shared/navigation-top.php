<?php
$_args = wp_parse_args(
  $args,
  array(
    'menu' => array()
  ));
?>
<ul class="nav--service">
	<li class="nav__item search">
		<svg x="0px" y="0px" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
			<g transform="matrix(1.087584, 0, 0, 1.087584, -0.875838, -0.035034)">
				<path d="M 598.8 666.074 L 670.419 594.368 L 916.219 839.994 L 844.6 911.7 L 598.8 666.074 Z" style="fill: rgb(0, 58, 86);"></path>
				<path d="M 376.4 0.4 C 173.2 0.4 10 166.9 10 370.1 C 10 573.3 176.6 739.9 379.8 739.9 C 583 739.9 749.6 573.3 749.6 370.1 C 749.5 166.9 579.6 0.4 376.4 0.4 Z M 376.4 659.9 C 216.5 659.9 86.6 530 86.6 370.1 C 86.6 210.2 216.5 80.3 376.4 80.3 C 536.3 80.3 666.2 210.2 666.2 370.1 C 666.2 530 536.3 659.9 376.4 659.9 Z" style="fill: rgb(0, 58, 86);"></path>
			</g>
		</svg>
		<?= get_search_form(); ?>
	</li>
	<?php
	foreach($_args["menu"] as $item) {
		echo '
			<li class="nav__item">
				<a href="'.$item["url"].'" target="'.$item["target"].'" '.($item["rel"] != '' ? 'rel="'.$item["rel"].'"' : '').'>
					<span>'.$item["label"].'</span>
				</a>
			</li>';
	}
	?>
</ul>
<?= icl_post_languages(); ?>
