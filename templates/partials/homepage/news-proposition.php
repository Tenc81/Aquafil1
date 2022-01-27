<!-- NEWS PROPOSITION -->
<?php 

if(!is_array($f)){ //pick 5 post automatic
$f = [
	'news_cards' => at_more_by_cat($cids,5)
];
}

?>

<div class="news-proposition">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-9 offset-sm-2 col-md-8 offset-md-3">
				<div class="news-proposition__content" appear>
					<div class="news-proposition__title">Latest News</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9 offset-sm-2 col-md-8 offset-md-3">
				
				<a href="<?=get_permalink($f['news_cards'][0])?>" class="card--news">
					<div class="card--news__picture">
						<img loading="lazy" src="<?=esc_url(get_the_post_thumbnail_url($f['news_cards'][0],'full'));?>" />
					</div>
					<div class="card--news__content" appear>
						<div class="card--news__title"><?=get_the_title($f['news_cards'][0])?></div>
						<div class="card--news__abstract"><?=get_the_excerpt($f['news_cards'][0])?></div>
						<div class="card--news__cta">
							<button type="button" class="btn--more"><span>Read more</span> <svg><use xlink:href="#arrow-next"></use></svg></button>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-10 offset-sm-1 col-md-9 offset-md-1">
				<div class="listing--news-proposition">

					<?php foreach($f['news_cards'] as $k => $v) {
						if ($k > 0) {
							?>

						<div class="listing__item">
							<a href="<?=get_permalink($v)?>" class="card--news">
								<div class="card--news__picture">
									<img loading="lazy" src="<?=esc_url(get_the_post_thumbnail_url($v));?>" />
								</div>
								<div class="card--news__content" appear>
									<div class="card--news__title"><?=get_the_title($v)?></div>
									<div class="card--news__cta">
										<button type="button" class="btn--more"><span>Read more</span> <svg><use xlink:href="#arrow-next"></use></svg></button>
									</div>
								</div>
							</a>
						</div>

					<?php
						} } ?>
				</div>
			</div>
		</div>
	</div>
</div>
