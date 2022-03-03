<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<section <?= setAnchor($_args['section']); ?>>
  <h2 class="page--investors__section-title"><?= $_args['section']['titolo_highlighted_date']; ?></h2>

  <div class="btn--calendar">
    <span class="left"><?= $_args['section']['data_highlighted_date']; ?></span>
    <span class="right"><?= $_args['section']['meeting_highlighted_date']; ?></span>
  </div>
</section>
<?php endif; ?>
