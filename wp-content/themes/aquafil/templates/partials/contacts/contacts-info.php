<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="contacts-info">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-11 offset-sm-2 col-md-10 offset-md-3"<?= !empty($_args['section']['immagine_cnt_info']) ? ' gallery="'.$_args['section']['immagine_cnt_info']['url'].'"' : ''; ?> scroll scrollSpeed="1">
				<?php
				if(!empty($_args['section']['immagine_cnt_info'])) {
					echo '<img loading="lazy" src="'.$_args['section']['immagine_cnt_info']['url'].'" alt="'.get_the_title().'" />';
					include(locate_template('templates/partials/shared/zoom-button.html'));
				}
				?>
      </div>
			<?php
			if(!empty($_args['section']['informazioni_cnt_info'])) {
				echo '
					<div class="col-sm-8 offset-sm-1 col-md-7 offset-md-2">';
				foreach($_args['section']['informazioni_cnt_info'] as $info) {
					echo '
            <div class="contacts-info__text-block">';
					if(!empty($info['approfondimento_informazione_contatto'])) {
						echo '
              <a href="'.$info['approfondimento_informazione_contatto']['url'].'" class="contacts-info__title">
                '.$info['approfondimento_informazione_contatto']['title'].' <svg class="contacts-info__arrow"><use xlink:href="#arrow-next-md"></use></svg>
              </a>';
					}
					echo '
              <div class="contacts-info__content">
                '.$info['descrizione_informazione_contatto'].'
              </div>
            </div>';
				}
				echo '
					</div>';
			}
			?>
    </div>
  </div>
</div>
<?php endif; ?>
