<?php
get_header();

$video = get_field('video');
$rendervideo = [];

if (is_array($video) && count($video)> 0) {
	foreach($video as $code){
		array_push($rendervideo,'
				</div>
      </div>
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
        <div class="news-detail-content__text">
          <div class="video-embed">
            <div class="video-embed__iframe-container">
              <iframe class="video-embed__iframe" width="560" height="315" src="https://www.youtube.com/embed/'.$code['cod'].'"></iframe>
            </div>
          </div>
				</div>
      </div>
      <div class="col-sm-20 offset-sm-2 col-md-10 offset-md-7">
        <div class="news-detail-content__text">');
	}
}

?>
<main class="main">
	<?php
	$fields = get_fields(get_queried_object());
	$filtered = array_filter($fields['sezioni'], function($section) {
		$keys = array_keys($section);
		$result = preg_grep('@\d+_attiva_sticky_item@', $keys);
		return !empty($result) && $section[reset($result)];
	});
	get_template_part( 'templates/partials/shared/sticky', null, array("all" => $filtered) );

	get_template_part( 'templates/partials/shared/breadcrumb' ); //the breadcrumb
	?>


	<div class="news-detail-hero">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3 col-lg-11">
					<div class="news-detail-hero__content" appear>
						<div class="news-detail-hero__category"><?= get_the_date("d.m.Y"); ?></div>
						<div class="news-detail-hero__title-small">
							<?=get_the_title()?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php
	$hero = !empty(get_field("news_detail_hero")) ? get_field("news_detail_hero")["url"] : esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
	?>
	<section class="news-detail-content">
		<div class="container-fluid">
			<div class="news-detail-content__row" appear>
				<div class="news-detail-content__thumbnail" style="background-image:url(<?= $hero; ?>)"></div>
			</div>
			<div class="row news-detail-content__row" appear>
				<div class="col-sm-20 offset-sm-2 col-md-10 offset-md-7">
					<div class="news-detail-content__text">
						<?php
						$placed = [];
						$content = get_the_content_with_formatting();
						foreach($rendervideo as $k => $v){
							if (strstr($content, '[insertVideo_')) {
								$content = str_replace('[insertVideo_'.$k.']', $v, $content);
								$placed[$k] = true;
							} else {
								$placed[$k] = false;
							}
						}
						echo $content;

						foreach ($rendervideo as $k => $v) {
							if(!$placed[$k]){
								echo $v;
							}
						}


						?>
					</div>
				</div>
			</div>
		</div>
		<?php
		$carousel = get_field('photogallery');
		if (is_array($carousel) && count($carousel)> 0) {

        ?>
		<div class="content-slider" appear>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
						<!-- swiper -->
						<div class="swiper-container" swiper-content>
							<div class="swiper-wrapper">
								<?php foreach($carousel as $slide){
                                ?>
								<div class="swiper-slide">
									<div class="card--content">
										<img src="<?=$slide['image']['url']?>" />
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="content-slider__controls">
								<div class="content-slider__index">
									<span class="page" [innerhtml]="slideIndex"></span> of <span [innerhtml]="slideTotal"></span>
								</div>
								<div class="content-slider__nav">
									<!-- prev button -->
									<button type="button" class="btn--prev">
										<svg class="circle">
											<use xlink:href="#circle-dotted"></use>
										</svg>
										<svg class="caret">
											<use xlink:href="#caret-left"></use>
										</svg>
									</button>
									<!-- next button -->
									<button type="button" class="btn--next">
										<svg class="circle">
											<use xlink:href="#circle-dotted"></use>
										</svg>
										<svg class="caret">
											<use xlink:href="#caret-right"></use>
										</svg>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php }  ?>

		<?php get_template_part('templates/partials/shared/share'); ?>

	</section>


	<?php get_template_part( 'templates/partials/homepage/news', 'proposition' ); ?>
</main>

<?php get_footer(); ?>
