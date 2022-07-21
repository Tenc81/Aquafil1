<!-- footer -->
<footer class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 offset-sm-2 col-md-5 offset-md-2 col-lg-4 offset-lg-2">
				<a href="<?= home_url(); ?>" class="btn--logo"><svg><use xlink:href="#aquafil"></use></svg></a>
			</div>
			<div class="col-sm-18 offset-sm-2 offset-md-0 col-md-13 col-lg-14">
				<?php
				$locations = get_nav_menu_locations();
				foreach ($locations as $key => $menu_id) {
					$location = apply_filters('wpml_object_id', $menu_id, 'nav_menu', TRUE);
					switch ($key) {
						case "footer_menu":
							$footerMenu = menuParse($location);
							break;
						default:;
					}
				}
				if(!is_page_template('templates/landing.php') && !empty($footerMenu)) {
					echo '
						<ul class="nav--footer">';
					foreach ($footerMenu as $item) {
						echo '
							<li class="nav__item nav__item--title">
								<a href="'.$item["url"].'" target="'.$item["target"].'" '.($item["rel"] != '' ? 'rel="'.$item["rel"].'"' : '').'><span>'.$item["label"].'</span></a>';
						if(!empty($item['children'])) {
							echo '
								<ul>';
							foreach($item['children'] as $subitem) {
								echo '
									<li class="nav__item"><a href="'.$subitem["url"].'" target="'.$subitem["target"].'" '.($subitem["rel"] != '' ? 'rel="'.$subitem["rel"].'"' : '').'><span>'.$subitem["label"].'</span></a></li>';
							}
							echo '
								</ul>';
						}
						echo '
							</li>';
					}
					echo '
						</ul>';
				}
				?>
			</div>
			<?php
			if(is_active_sidebar("social-widget")) {
				dynamic_sidebar("social-widget");
			}
			?>
		</div>
		<div class="row">
			<div class="col-sm-20 offset-sm-2">
				<div class="footer__divline"></div>
			</div>
		</div>
		<div class="row">
			<?php
			if(is_active_sidebar("corporate-widget")) {
				dynamic_sidebar("corporate-widget");
			}
			?>
			<div class="col-sm-10">
				<div class="footer__credits">
					<a href="https://www.websolute.com" class="btn--websolute"><svg><use xlink:href="#websolute"></use></svg></a>
				</div>
			</div>
		</div>
	</div>
</footer>
