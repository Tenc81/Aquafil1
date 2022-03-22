<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="secondary-hero" <?=setAnchor($_args['section']);?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 offset-sm-2 col-md-6 offset-md-2 order-2 order-sm-1">
				<div class="secondary-hero__content" appear>
					<div class="secondary-hero__title"><?= $_args['section']['titolo_sec_hero']; ?></div>
					<div class="secondary-hero__abstract"><?= $_args['section']['sottotitolo_sec_hero']; ?></div>
				</div>
			</div>
			<div class="col-sm-12 offset-sm-2 col-md-11 offset-md-2 order-1 order-sm-2">
				<?php if($_args['section']['zoom_sec_hero']) : ?>
				<div class="secondary-hero__picture" gallery="<?= $_args['section']['immagine_sec_hero']['url']; ?>" scroll scrollSpeed="1">
					<img loading="lazy" src="<?= $_args['section']['immagine_sec_hero']['url']; ?>" alt="<?= get_the_title(); ?>" />
					<?php include(locate_template('templates/partials/shared/zoom-button.html')); ?>
				</div>
				<?php else : ?>
				<div class="secondary-hero__picture" scroll scrollSpeed="1">
					<img loading="lazy" src="<?= $_args['section']['immagine_sec_hero']['url']; ?>" alt="<?= get_the_title(); ?>" />
				</div>
				<?php endif; ?>
			</div>
			<?php
			if(!empty($_args['section']['link_sec_hero'])) {
				echo '
				<div class="col-sm-12 offset-sm-2 col-md-11 offset-md-2 order-1 order-sm-2">
					<a href="'.$_args['section']['link_sec_hero']["url"].'" class="btn--more-md"><span>'.$_args['section']['link_sec_hero']["title"].'</span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>
				</div>';
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>
