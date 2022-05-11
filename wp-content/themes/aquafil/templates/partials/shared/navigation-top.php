<?php
$_args = wp_parse_args(
  $args,
  array(
    'menu' => array()
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
	?>
	<li class="nav__item investor">
		<a href="/investor-relations/homepage/" target="_self" class="btn--investor">Investors</a>
	</li>
</ul>
<?= icl_post_languages(); ?>
