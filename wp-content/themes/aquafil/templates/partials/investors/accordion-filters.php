<?php
$_args = wp_parse_args(
  $args,
  array(
    'filters' => array(),
    'oldfilters' => array()
  ));
if(!empty($_args['filters']) || !empty($_args['oldfilters'])) :
?>
<h2 class="page--investors__section-title"><?= __("Upcoming events", "wstheme"); ?></h2>
<h2 class="page--investors__section-title hidden"><?= __("Past events", "wstheme"); ?></h2>

<div class="horizontal-menu">
  <div class="horizontal-menu__content">
    <div class="horizontal-menu__title"><?= __("Filter by typology", "wstheme"); ?></div>
    <?php if(!empty($_args['filters'])) : ?>
    <ul class="nav--horizontal-menu">
      <?php $i=0;
      foreach($_args['filters'] as $filter) : 
      ?>
      <li class="nav__item">
        <a href="javascript:void(0);" class="history-filter <?= $i==0 ? "active" : ''; ?>" data-filter="<?= $filter["value"];  ?>">
          <span class="name"><?= $filter["label"]; ?></span>
          <span class="count">(<?= $filter["count"]; ?>)</span>
        </a>
      </li>
      <?php 
      $i++; 
      endforeach; 
      ?>
    </ul>
    <?php endif; ?>
    <?php if(!empty($_args['oldfilters'])) : ?>
    <ul class="nav--horizontal-menu hidden">
      <?php $i=0;
      foreach($_args['oldfilters'] as $filter) : 
      ?>
      <li class="nav__item">
        <a href="javascript:void(0);" class="history-filter <?= $i==0 ? "active" : ''; ?>" data-filter="<?= $filter["value"];  ?>">
          <span class="name"><?= $filter["label"]; ?></span>
          <span class="count">(<?= $filter["count"]; ?>)</span>
        </a>
      </li>
      <?php 
      $i++; 
      endforeach; 
      ?>
    </ul>
    <?php endif; ?>
  </div>
</div>

<a href="javascript:void(0);" class="btn--more-md" id="switch_events">
  <span><?= __("Past events", "wstheme"); ?></span>
  <span class="hidden"><?= __("Upcoming events", "wstheme"); ?></span>
  <svg><use xlink:href="#arrow-next"></use></svg>
</a>
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
    $("#switch_events").on("click", function() {
      $("span", this).toggleClass("hidden");
      $(".history-filter").removeClass("active");
      $(".nav--horizontal-menu, .page--investors__section-title", '#financial-calendar').toggleClass("hidden");
      $('.history-filter:first', '.nav--horizontal-menu').addClass("active");
      $("#financial-calendar .card--calendar").removeAttr("style");
      $("#financial-calendar .card--calendar").toggleClass("hidden");
    });
  })(jQuery);
</script>
<?php endif; ?>