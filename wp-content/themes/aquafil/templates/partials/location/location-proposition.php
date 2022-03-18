<?php if(have_posts()) : ?>
<div class="location-proposition">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="listing--location">
					<?php
					global $post, $wp_query;
					while(have_posts()) {
						the_post();
						$thumb = get_the_post_thumbnail_url();
						$terms = wp_get_post_terms(get_the_ID(), 'settori-sedi', array('fields' => 'slugs'));
						echo '
							<div class="listing__item '.implode(' ', $terms).'" appear>
								<a href="'.get_permalink().'" class="card--location">
									<div class="card--location__picture">
										'.(!empty($thumb) ? '<img loading="lazy" src="'.$thumb.'" />' : '').'
									</div>
									<div class="card--location__content">
										<div class="card--location__category">'.get_field("pretitle").'</div>
										<div class="card--location__title">'.get_field("title").'</div>
										<div class="card--location__abstract">'.get_field("abstract").'</div>
										<div class="card--location__cta">
											<button type="button" class="btn--more"><span>'.__("Scopri di più", "wstheme").'</span> <svg><use xlink:href="#arrow-next"></use></svg></button>
										</div>
									</div>
								</a>
							</div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
