<?php
$_args = wp_parse_args(
  $args,
  array(
    'filters' => array(),
    'oldfilters' => array()
  ));
  //var_dump($_args);

/*echo '<pre>';
foreach($_args['oldfilters'] as $k => $filter) {
    echo "Filtro key: $k - label: {$filter['label']} - count: {$filter['count']}\n";
}
echo '</pre>'; */

if(!empty($_args['filters']) || !empty($_args['oldfilters'])) :

?>

<div class="horizontal-menu">
  <div class="horizontal-menu__content">
    <div class="horizontal-menu__title"><?= __("Filter by", "wstheme"); ?></div>
    <?php if (!empty($_args['oldfilters'])) : ?>
  <ul class="nav--horizontal-menu">
    <?php $i = 0; ?>
    <?php foreach ($_args['oldfilters'] as $key => $filter) : ?>
      <li class="nav__item">
        <a href="javascript:void(0);" class="history-filter <?= $i == 0 ? 'active' : ''; ?>" data-filter="<?= $key; ?>">
          <span class="name"><?= esc_html( apply_filters( 'wpml_translate_single_string', $filter['label'], 'acf', $filter['label'] ) ); ?></span>
          <span class="count">(<?= esc_html($filter['count']); ?>)</span>
        </a>
      </li>
      <?php $i++; ?>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
  </div>
</div>


<script type="text/javascript">
  (function($) {
    $(".history-filter").on("click", function() {
      $("#financial-calendar .card--calendar").show();
      $(".history-filter").removeClass("active");
      $(this).addClass("active");
      if($(this).attr("data-filter")!="all") {
        $("#financial-calendar .card--calendar").not("."+$(this).attr("data-filter")).hide();
      }
    });
  })(jQuery);
</script>
<?php endif; ?>