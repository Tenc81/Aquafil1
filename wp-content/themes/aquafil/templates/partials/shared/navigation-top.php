<?php
$_args = wp_parse_args(
  $args,
  array(
    'menu' => array(),
		'hlmenu' => array()
  ));
?>
<ul class="nav--service">
	<li class="nav__item search">
		<span>
			<?= get_search_form(); ?>
		</span>
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
	foreach($_args["hlmenu"] as $item) {
		echo '
			<li class="nav__item investor">
				<a href="'.$item["url"].'" target="'.$item["target"].'" '.($item["rel"] != '' ? 'rel="'.$item["rel"].'"' : '').' class="btn--investor">
					'.$item["label"].'
				</a>
			</li>';
	}
	?>
</ul>
<?= icl_post_languages(); ?>
