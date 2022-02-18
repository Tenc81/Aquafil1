<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="image-full">
	<?php if(!empty($_args['section']['internal_full_image'])) : ?>
	<div class="image-full__picture" gallery="<?= $_args['section']['internal_full_image']['url']; ?>" scroll scrollSpeed="1">
		<img loading="lazy" src="<?= $_args['section']['internal_full_image']['url'] ?>" />
		<?php include(locate_template('templates/partials/shared/zoom-button.html')); ?>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>
