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
        <h1 class="contacts-hero__title"><?= $_args['section']['titolo_cnt_hero']; ?></h1>
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
								<img loading="lazy" src="//maps.googleapis.com/maps/api/staticmap?
                style=feature%3Aadministrative%7Celement%3Alabels.text.fill%7Ccolor%3A0x444444%7C&style=feature%3Alandscape%7Celement%3Aall%7Ccolor%3A0xf2f2f2%7C&style=feature%3Apoi%7Celement%3Aall%7Cvisibility%3Aoff%7C&style=feature%3Aroad%7Celement%3Aall%7Csaturation%3A-100%7Clightness%3A45%7C&style=feature%3Aroad.highway%7Celement%3Aall%7Cvisibility%3Asimplified%7C&style=feature%3Aroad.arterial%7Celement%3Alabels.icon%7Cvisibility%3Aoff%7C&style=feature%3Atransit%7Celement%3Aall%7Cvisibility%3Aoff%7C&style=feature%3Awater%7Celement%3Aall%7Ccolor%3A0x46bcec%7Cvisibility%3Aon%7C
                &style=feature:poi|visibility:off
                &zoom=14&scale=1&size=800x600&maptype=roadmap
                &markers=color:0xffffff00%7Csize:small%7C'.str_replace(' ', '+', trim($_args['section']['indirizzo_cnt_hero'])).'
                &format=jpg&key='.GOOGLE_API_KEY.'" />
							</a>';
					}
					?>
        </div>
      </div>
    </div>
  </div>
</div>    
<?php endif; ?>
