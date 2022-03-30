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
  <?php if(!empty($_args['section']['titolo_highlighted_date'])) { ?>				
  <h2 class="page--investors__section-title"><?= $_args['section']['titolo_highlighted_date']; ?></h2>
  <?php } ?>
  <div class="card--calendar">    
		<div class="card--calendar__left">
      <span class="card--calendar__date"><?= $_args['section']['data_highlighted_date']; ?></span>
    </div>
    <div class="card--calendar__right">
      <span class="card--calendar__description"><?= $_args['section']['meeting_highlighted_date']; ?></span>
    </div>
  </div>
</section>
<?php endif; ?>
