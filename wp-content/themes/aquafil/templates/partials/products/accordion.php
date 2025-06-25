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

    // Verifica che categoria_prod sia un array e contenga almeno un elemento
    if (empty($accordion["categoria_prod"]) || !is_array($accordion["categoria_prod"])) {
      continue;
    }

    // Aumenta il conteggio totale
    $oldfilters["all"]["count"] += 1;

    // Cicla sulle categorie prodotto
    foreach ($accordion["categoria_prod"] as $cat) {
      
      if (empty($cat['value']) || empty($cat['label'])) {
        continue;
      }

      if (isset($oldfilters[$cat['value']])) {
        $oldfilters[$cat['value']]["count"] += 1;
      } else {
        $oldfilters[$cat['value']] = array(
          "value" => $cat['value'],
          "label" => $cat['label'],
          "count" => 1
        );
      }
    }
  }

  // Debug: visualizza i filtri finali
  // echo '<pre>';
  // print_r($oldfilters);
  // echo '</pre>';

endif;
?>

 <section id="financial-calendar">
  <?php 
 // print_r($oldfilters);
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
    <div class="card--calendar <?php 
  $classes = [];
  foreach ($accordion['categoria_prod'] as $cat) {
    $classes[] = $cat['value'];
  }
  echo implode(' ', $classes);
  ?>">
      <button type="button" class="btn--plus" toggle=".card--calendar">
        <svg><use xlink:href="#plus"></use></svg>
      </button>
      <div class="card--calendar__right">
      <?php foreach ($accordion['categoria_prod'] as $category) : ?>
        <div class="card--calendar__category"><?= $category['label'];?></div>
      <?php endforeach; ?>
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
        <a class="a-icon" href="<?= __("/richiedi-info", "wstheme"); ?>" target="_blank">
           <?= __("Richiedi informazioni", "wstheme"); ?>
        </a>
      </div>
    </div>
  <?php endforeach; ?>
</section>
<div class="load-more-container">
    <button type="button" class="btn btn--primary load-more-btn"><?= __("Show More", "wstheme"); ?></button>
</div>
