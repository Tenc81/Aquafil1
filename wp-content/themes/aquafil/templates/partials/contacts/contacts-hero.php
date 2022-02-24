<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="contacts-hero">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-10 offset-sm-2 col-md-9 offset-md-3">
        <div class="contacts-hero__title"><?= $_args['section']['titolo_cnt_hero']; ?></div>
        <div class="contacts-hero__text">
          <div class="contacts-hero__paragraph-title"><?= $_args['section']['sottotitolo_cnt_hero']; ?></div>
          <div class="contacts-hero__paragraph-text">
            <?= $_args['section']['testo_cnt_hero']; ?>
          </div>
        </div>
      </div>
      <div class="col-sm-10 col-md-12">
        <div class="contacts-hero__map">
					<?php
					if(!empty($_args['section']['indirizzo_cnt_hero'])) {
						echo '
							<a href="//www.google.it/maps/search/'.str_replace(' ', '+', trim($_args['section']['indirizzo_cnt_hero'])).'" target="_blank">
								<img loading="lazy" src="//maps.googleapis.com/maps/api/staticmap?style=feature:all|saturation:-100&style=feature:poi|visibility:off&zoom=12&scale=2&size=460x260&maptype=roadmap&markers=color:blue%7Csize:small%7C'.str_replace(' ', '+', trim($_args['section']['indirizzo_cnt_hero'])).'&format=jpg&key='.GOOGLE_API_KEY.'" />
							</a>';
					}
					?>
        </div>
      </div>
    </div>
  </div>
</div>    
<?php endif; ?>
