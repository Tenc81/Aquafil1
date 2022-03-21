<?php
$sharelink = get_permalink();
$sharecontent = htmlentities(get_the_excerpt());
?>
<div class="container-fluid">
	<div class="row news-detail-content__row" appear>
		<div class="col-sm-20 offset-sm-2 col-md-10 offset-md-7">
			<div class="news-detail-content__text">
				<div class="share">
					<p class="share__text"><?= __("Condividi", "wstheme"); ?></p>
					<a class="share__link" target="_blank" rel="nofollow" href="//www.facebook.com/sharer/sharer.php?u=<?= $sharelink; ?>&amp;src=sdkpreparse">
						<svg class="facebook">
							<use xlink:href="#facebook"></use>
						</svg>
					</a>
					<a class="share__link" target="_blank" rel="nofollow" href="//twitter.com/intent/tweet?text=<?= wp_trim_words($sharecontent, 30)."@AquafilSpa"; ?>&url=<?= $sharelink; ?>">
						<svg class="twitter">
							<use xlink:href="#twitter"></use>
						</svg>
					</a>
					<a class="share__link" target="_blank" rel="nofollow" href="//www.linkedin.com/shareArticle?mini=true&url=<?= str_replace('http:', 'https:', $sharelink); ?>&title=<?= get_the_title(); ?>&summary=<?= $sharecontent; ?>&source=<?= get_bloginfo('name'); ?>">
						<svg class="linkedin">
							<use xlink:href="#linkedin"></use>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	(function ($) {
		$('body').on('click', '.share__link', function () {
			var href = $(this).attr('href');

			wLeft = window.screenLeft ? window.screenLeft : window.screenX;
			wTop = window.screenTop ? window.screenTop : window.screenY;

			var left = wLeft + (window.innerWidth / 2) - 300;
			var top = wTop + (window.innerHeight / 2) - 200;
			var style = "top=" + top + ", left=" + left + ", width=600, height=400, status=no, menubar=no, toolbar=no scrollbars=no";
			window.open(href, "", style);
			return false;
		});
	})(jQuery);
</script>
