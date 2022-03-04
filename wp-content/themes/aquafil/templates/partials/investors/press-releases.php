<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<section class="page--investors__accordion">
	<?php foreach($_args['section']['accordion'] as $accordion) : ?>
  <div class="page--investors__accordion-item" <?=setAnchor($accordion);?>>
    <div class="page--investors__accordion-title" target="#<?= sanitize_title($accordion['titolo_accordion']); ?>-content">
      <span class="page--investors__accordion-text"><?= $accordion['titolo_accordion']; ?></span>
      <span class="page--investors__accordion-icon"></span>
    </div>
    <div class="page--investors__accordion-content" id="<?= sanitize_title($accordion['titolo_accordion']); ?>-content">
      <div class="page--investors__downloads">
				<?php
				foreach($accordion['contenuti_accordion'] as $content) {
					$file = get_attached_file($content['contenuto']["id"]);
					$filesize = formatSizeUnits(filesize($file));
					echo '
						<div class="page--investors__downloads-item">
              <p class="page--investors__downloads-item-label">
                <strong>'.$content['pretitolo_contenuto'].'</strong><br>
                '.$content['titolo_contenuto'].'
              </p>
              <a href="#" download="'.$content['contenuto']['filename'].'" class="btn--investor"><span>'.strtoupper($content['contenuto']['subtype']).' - '.$filesize.'</span> <span class="icon"><svg><use xlink:href="#download"></use></svg></span></a>
						</div>';
				}
				?>
      </div>    
    </div>
	</div>
<?php endforeach; ?>
</section>
<?php endif; ?>