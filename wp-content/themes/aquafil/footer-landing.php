					<?php get_template_part( 'templates/partials/shared/footer'); ?>
					</div>
				<?php get_template_part( 'templates/partials/shared/modal', 'outlet' ); ?>
			</div>
		</div>
		<?php wp_footer(); ?>
		<script src="js/vendors.min.js?v=<?= filemtime(get_theme_file_path('/client/docs/js/vendors.min.js')) ?>"></script>
		<script src="js/main.js?v=<?= filemtime(get_theme_file_path('/client/docs/js/main.js')) ?>"></script>
		<?php if((is_tax("settori-sedi") && get_queried_object_id() == $filter->term_id) || is_tax("nazione-sedi")) : ?>
		<script>
			jQuery('.nav--horizontal-menu .nav__item a').on('click', function () {
				jQuery(this).closest('.nav--horizontal-menu').find('.nav__item a').not(this).removeClass('active');
				if (!jQuery(this).is('.active') && (jQuery(this).attr('href') == '#' || jQuery(this).attr('href') == 'javascript:void(0);')) {
					jQuery('.listing__item').hide();
					var classes = jQuery(this).attr('class');
					classes = classes.split(' ');
					classes.forEach(function (c) {
						jQuery('.listing__item.' + c).show();
					});
					jQuery(this).addClass('active');
					return false;
				}
			});
		</script>
		<?php endif;?>
	</body>
</html>
