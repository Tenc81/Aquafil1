<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<section class="page--investors__accordion" <?=setAnchor($_args['section']);?>>
	<?php foreach($_args['section']['accordion'] as $accordion) : ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
          <div class="page--investors__accordion-item">
            <div class="page--investors__accordion-title" target="#<?= sanitize_title($accordion['titolo_accordion']); ?>-content">
              <span class="page--investors__accordion-text"><?= $accordion['titolo_accordion']; ?></span>
              <span class="page--investors__accordion-icon"></span>
            </div>
            <div class="page--investors__accordion-content" id="<?= sanitize_title($accordion['titolo_accordion']); ?>-content">
              <div class="_page--investors__downloads">
                <?php
                foreach($accordion['contenuti_accordion'] as $content) {
                  echo '
                    <div class="_page--investors__downloads-item">
                      <p class="page--investors__downloads-item-label">
                        <strong>'.$content['titolo_contenuto'].'</strong><br>
                        '.$content['contenuto'].'
                      </p>
                    </div>';
                }
                ?>
              </div>    
            </div>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
</section>
<?php endif; ?>
