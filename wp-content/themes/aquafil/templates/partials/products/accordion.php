<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  )
);

if (!empty($_args['section']) && !empty($_args['section']['list_accordion'])):

  // Inizializza il filtro "All"
  $filters = $oldfilters = array(
    "all" => array(
      "value" => "all",
      "label" => __("All", "wstheme"),
      "count" => 0
    )
  );

  // Costruisci i filtri partendo dai dati dell'accordion
  foreach ($_args['section']['list_accordion'] as $accordion) {

    // Evita errori se manca categoria_prod o i suoi valori
    if (
      empty($accordion["categoria_prod"]) ||
      empty($accordion["categoria_prod"]["value"]) ||
      empty($accordion["categoria_prod"]["label"])
    ) {
      continue;
    }

    $key = $accordion["categoria_prod"]["value"];

    // Aumenta il conteggio totale
    $oldfilters["all"]["count"] += 1;

    // Aumenta il conteggio per la categoria, o crea il filtro se non esiste
    if (isset($oldfilters[$key])) {
      $oldfilters[$key]["count"] += 1;
    } else {
      $oldfilters[$key] = array(
        "value" => $key,
        "label" => $accordion["categoria_prod"]["label"],
        "count" => 1
      );
    }
  }
?>

 <section id="financial-calendar">
  <?php 
  if(count($oldfilters)>1) {
    $part = "templates/partials/products/accordion-filters";
    get_template_part($part, null, array("filters" => $filters, "oldfilters" => $oldfilters));
  } 
  ?>
 
 <section class="page--investors__accordion" <?= setAnchor($_args['section']); ?>>
   <div class="no-results" style="display: none;">
    <p><?= __("No products found with the selected filters", "wstheme"); ?></p>
  </div>
  <?php foreach ($_args['section']['list_accordion'] as $accordion) : ?>
    <div class="card--calendar <?= $accordion['categoria_prod']['value']; ?>">
      <button type="button" class="btn--plus" toggle=".card--calendar">
        <svg><use xlink:href="#plus"></use></svg>
      </button>
      <div class="card--calendar__right">
        <div class="card--calendar__category"><?= $accordion['categoria_prod']['label'];?></div>
        <span class="card--calendar__title"><?= $accordion['nome_prod']; ?></span>
        <p class="card--calendar__description"><?= $accordion['descrizione_prod']; ?></p>
           <div class="tag-list">
              <?php if (!empty($accordion['tag_prod'])) :
              foreach ($accordion['tag_prod'] as $tag) : ?>
                <div class="btn btn--outline"><?= esc_html($tag); ?></div>
              <?php endforeach;
            endif; ?>
           </div>
      </div>
      <div class="card--calendar__extra">
        <?php if (!empty($accordion['download_prod']) || $accordion['listing_video_prod']) : ?>
          <ul>
            <?php if (!empty($accordion['download_prod'])) :
              foreach ($accordion['download_prod'] as $link) : ?>
                <li>
                  <a class="a-icon" href="<?= $link['url_prod']; ?>" target="_blank">
           <!--         <span class="icon">
                      <svg>
                        <use xlink:href="<?= preg_match("@\.(pdf|zip)$@", $link['url_prod']) ? "#download" : "#arrow-next-md"; ?>"></use>
                      </svg>
                    </span> -->
                    <?= $link['etichetta_prod']; ?>
                  </a>
                </li>
              <?php endforeach;
            endif; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</section>
<div class="load-more-container">
    <button type="button" class="btn btn--primary load-more-btn"><?= __("Show More", "wstheme"); ?></button>
</div>
<?php endif; ?>
