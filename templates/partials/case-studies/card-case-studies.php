<?php
$_args = wp_parse_args(
  $args,
  array(
    'ID' => 0
  ));
if($_args['ID']!=0) :
		$thumb = get_the_post_thumbnail_url($_args['ID']);
?>
<div class="card--product">
	<a href="<?= get_permalink($_args['ID']); ?>">
		<div class="card--product__picture">
			<?= !empty($thumb) ? '<img loading="lazy" src="'.$thumb.'">' : ''; ?>
		</div>
		<div class="card--product__content">
			<div class="card--product__title"><?= get_the_title($_args['ID']); ?></div>
			<div class="card--product__abstract"><?= get_the_excerpt($_args['ID']); ?></div>
			<div class="card--product__cta">
				<button type="button" class="btn--plus">
					<svg><use xlink:href="#plus"></use></svg>
				</button>
			</div>
		</div>
	</a>
</div>
<!-- in page detail -->
<div class="card--side-modal" card-product-detail id="detail-<!--@@var=id-->">
	<div class="card--side-modal__picture">
		<img loading="lazy" src="<!--@@var=img-->">
	</div>
	<div class="card--side-modal__content">
		<div class="card--side-modal__title">
			<!--@@var=title-->
		</div>
		<div class="card--side-modal__abstract">
			<!--@@var=abstract-->
		</div>
	</div>
</div>
<?php endif; ?>
