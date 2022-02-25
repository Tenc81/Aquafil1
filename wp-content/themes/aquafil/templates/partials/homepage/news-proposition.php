<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));

if((!isset($_args['section']['news_cards']) || empty($_args['section']['news_cards'])) && is_singular('post')) {
	$cat = get_the_category(get_the_ID());
	$cids = [];
	foreach($cat as $c){
		array_push($cids, $c->term_id);
	}
	$_args['section']['news_cards'] = at_more_by_cat($cids,5);
}
if(isset($_args['section']['news_cards']) && !empty($_args['section']['news_cards'])) :
?>
<!-- NEWS PROPOSITION -->
<div class="news-proposition">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-9 offset-sm-2 col-md-8 offset-md-3">
				<div class="news-proposition__content" appear>
					<div class="news-proposition__title"><?= $_args['section']['titolo_news_cards']; ?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9 offset-sm-2 col-md-8 offset-md-3">

				<a href="<?=get_permalink($_args['section']['news_cards'][0])?>" class="card--news">
					<div class="card--news__picture">
						<img loading="lazy" src="<?=esc_url(get_the_post_thumbnail_url($_args['section']['news_cards'][0],'full'));?>" alt="<?=get_the_title($v)?>" />
					</div>
					<div class="card--news__content" appear>
						<div class="card--news__date">23.06.2021</div>
						<div class="card--news__title"><?=get_the_title($_args['section']['news_cards'][0])?></div>
						<div class="card--news__abstract"><?=get_the_excerpt($_args['section']['news_cards'][0])?></div>
						<div class="card--news__cta">
							<button type="button" class="btn--more"><span><?= __("Read more", "wstheme"); ?></span> <svg><use xlink:href="#arrow-next"></use></svg></button>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-10 offset-sm-1 col-md-9 offset-md-1">
				<div class="listing--news-proposition">
					<?php
					foreach($_args['section']['news_cards'] as $k => $v) {
						if ($k > 0) {
					?>
					<div class="listing__item">
						<a href="<?=get_permalink($v)?>" class="card--news">
							<div class="card--news__picture">
								<img loading="lazy" src="<?=esc_url(get_the_post_thumbnail_url($v));?>" alt="<?=get_the_title($v)?>" />
							</div>
							<div class="card--news__content" appear>
								<div class="card--news__date">23.06.2021</div>
								<div class="card--news__title"><?=get_the_title($v)?></div>
								<div class="card--news__cta">
									<button type="button" class="btn--more"><span><?= __("Read more", "wstheme"); ?></span> <svg><use xlink:href="#arrow-next"></use></svg></button>
								</div>
							</div>
						</a>
					</div>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
