<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="sales-list">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="sales-list__text-top"><?= $_args['section']["titolo_lista_agenti"]; ?></div>
				<div class="sales-list__items">
					<?php
					$areas = get_terms(array(
						'taxonomy' => 'settori-sedi',
						'hide_empty' => false
					));
					//$product_areas = array_column($_args['section']['agenti'], "settore_agente");
					//$product_areas = array_unique($product_areas);
					foreach($areas as $i=>$area) {
					  $img = get_field('settori_preview_image', $area);
					  echo '
					    <div class="listing__item" appear>
					      <div class="card--product" open-modally="#detail-'.($i+1).'">
					        <div class="card--product__picture">
					          '.(!empty($img) ? '<img loading="lazy" src="'.$img["url"].'" alt ="'.get_field('settori_preview_title', $area).'" />' : '').'
					        </div>
					        <div class="card--product__content">
					          <div class="card--product__title">'.get_field('settori_preview_title', $area).'</div>
					          <div class="card--product__cta">
					            <button type="button" class="btn--plus"><svg><use xlink:href="#plus"></use></svg></button>
					          </div>
					        </div>
					      </div>
					      <!-- in page detail - 1 -->
					      <div class="card--side-modal" card-sale-detail area="'.$area->name.'" productName="'.get_field('settori_preview_title', $area).'" id="detail-'.($i+1).'">
					        <div class="card--side-modal__content">';
						$agents = array_filter($_args['section']['agenti_default'], function($agent) use($area) {
							return $agent['settore_agente'] == $area;
						});
						if(!empty($agents)) {
							echo '
										<div class="card--side-modal__text-top">'.__("Choose the country of your interest", "wstheme").'</div>
					          <div control-custom-select [control]="controls.country" label="'.__("Country", "wstheme").'"></div>
					          <div class="card--side-modal__agent-name" *if="agent" [innerHTML]="agent.name"></div>
					          <div class="card--side-modal__abstract" *if="agent" [innerHTML]="agent.address"></div>
					          <button type="button" class="btn--more-md" (click)="onRequestInfo()"><span>'.__("Request informations", "wstheme").'</span> <svg><use xlink:href="#pencil"></use></svg></button>';
						}
						echo '
					        </div>
					      </div>
					    </div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?= do_shortcode('[contact-form-7 id="3983" title="Contact-it"]'); ?>
