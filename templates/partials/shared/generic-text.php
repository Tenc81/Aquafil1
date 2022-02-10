<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="section-generic">
	<div class="container"><?= $_args['section']["text"]; ?></div>
</div>
<?php endif; ?>
