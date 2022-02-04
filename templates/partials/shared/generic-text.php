<?php
$_args = wp_parse_args(
  $args,
  array(
    'text' => ''
  ));
?>
<div class="section-generic">
	<div class="container"><?= $_args["text"]; ?></div>
</div>
