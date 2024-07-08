<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section']) && !empty($_args['section']['list_accordion_container'])) :  
  $filters = $oldfilters = array("all" => array("value" => "all", "label" => __("All", "wstheme"), "count" => 0));
  foreach($_args['section']['list_accordion_container'] as $accordion) {
    $date = date_create_from_format("d/m/Y", $accordion['data_highlighted_date']);
    if($date->getTimestamp()<time()) {
      $oldfilters["all"]["count"] += 1;
      if($oldfilters[$accordion["filtro_highlighted_date"]["value"]]) {
        $oldfilters[$accordion["filtro_highlighted_date"]["value"]]["count"] += 1;
      } else {
        $oldfilters[$accordion["filtro_highlighted_date"]["value"]]["count"] = 1;
        $oldfilters[$accordion["filtro_highlighted_date"]["value"]]["value"] = $accordion["filtro_highlighted_date"]["value"];
        $oldfilters[$accordion["filtro_highlighted_date"]["value"]]["label"] = $accordion["filtro_highlighted_date"]["label"];
      }
    } else {
      $filters["all"]["count"] += 1;
      if($filters[$accordion["filtro_highlighted_date"]["value"]]) {
        $filters[$accordion["filtro_highlighted_date"]["value"]]["count"] += 1;
      } else {
        $filters[$accordion["filtro_highlighted_date"]["value"]]["count"] = 1;
        $filters[$accordion["filtro_highlighted_date"]["value"]]["value"] = $accordion["filtro_highlighted_date"]["value"];
        $filters[$accordion["filtro_highlighted_date"]["value"]]["label"] = $accordion["filtro_highlighted_date"]["label"];
      }
    }
  }
?>
<section id="financial-calendar" <?= setAnchor($_args['section']); ?>>
  <?php 
  if(count($filters)>1 || count($oldfilters)>1) {
    $part = "templates/partials/investors/accordion-filters";
    get_template_part($part, null, array("filters" => $filters, "oldfilters" => $oldfilters));
  }
  ?>
  <?php 
  foreach($_args['section']['list_accordion_container'] as $accordion) : 
    $date = date_create_from_format("d/m/Y", $accordion['data_highlighted_date']);
  ?>
  <div class="card--calendar <?= $accordion['filtro_highlighted_date']['value']; ?><?= $date->getTimestamp()<time() ? " hidden" : ''; ?>">
    <button type="button" class="btn--plus" toggle=".card--calendar"><svg><use xlink:href="#plus"></use></svg></button>
    <div class="card--calendar__left">
      <span class="card--calendar__date"><?= $accordion['data_highlighted_date']; ?></span>
    </div>
    <div class="card--calendar__right">
      <span class="card--calendar__description"><?= $accordion['meeting_highlighted_date']; ?></span>
    </div>
    <div class="card--calendar__extra">
      <?php if(!empty($accordion['links_sx_highlighted_date']) || $accordion['cta_calendar_highlighted_date']) : ?>
      <ul>
        <?php if($accordion['cta_calendar_highlighted_date']) : ?>
        <li>
          <add-to-calendar-button
            id="calendar-<?= $_args['index']; ?>"
            label="<?= __("Add to calendar", "wstheme"); ?>"
            name="<?= !empty($accordion['titolo_highlighted_date']) ? $accordion['titolo_highlighted_date'] : sprintf(__("Aquafil event on %s", "wstheme"), $accordion['data_highlighted_date']); ?>"
            description="<?= strip_tags($accordion['meeting_highlighted_date']); ?>"
            startDate="<?= $date->format("Y-m-d"); ?>"
            endDate="<?= $date->format("Y-m-d"); ?>"
            startTime=""
            endTime=""
            location=""
            options="['Apple','Google','iCal','Microsoft365','Outlook.com','Yahoo']"
            timeZone="Europe/Rome"
            trigger="click"
            buttonStyle='default'
            inline
            listStyle="modal"
            iCalFileName="Reminder-Event"
            hideCheckmark="true"
          />
        </li>
        <?php endif; ?>
        <?php foreach($accordion['links_sx_highlighted_date'] as $link) : ?>
        <li><a class="a-icon" href="<?= $link['url']; ?>" target="_blank"><span class="icon"><svg><use xlink:href="<?= preg_match("@\.(pdf|zip)$@", $link['url']) ? "#download" : "#arrow-next-md"; ?>"></use></svg></span><?= $link['label']; ?></a></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
      <?php if(!empty($accordion['links_dx_highlighted_date'])) : ?>
      <ul>
        <?php foreach($accordion['links_dx_highlighted_date'] as $link) : ?>
        <li><a class="a-icon" href="<?= $link['url']; ?>" target="_blank"><span class="icon"><svg><use xlink:href="<?= preg_match("@\.(pdf|zip)$@", $link['url']) ? "#download" : "#arrow-next-md"; ?>"></use></svg></span><?= $link['label']; ?></a></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>
</section>
<?php endif; ?>