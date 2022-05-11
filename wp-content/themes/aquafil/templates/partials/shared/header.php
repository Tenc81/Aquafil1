<!-- header -->
<header class="header" header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2">
				<div class="header__main">
					<div class="header__logo">
						<a href="<?= home_url(); ?>" class="btn--logo">
							<svg>
								<use xlink:href="#aquafil"></use>
							</svg>
						</a>
					</div>
					<div class="header__menu" [class]="{ active: header == 'menu' }">
						<?php
						$locations = get_nav_menu_locations();
						foreach ($locations as $key => $menu_id) {
							$location = apply_filters('wpml_object_id', $menu_id, 'nav_menu', TRUE);
							switch ($key) {
								case "main_menu":
									$mainMenu = menuParse($location);
									break;
								case "secondary_menu":
									$secMenu = menuParse($location);
									break;
								default:;
							}
						}
						$hlItems = array();
						if(!empty($mainMenu)) {
							echo '
									<ul class="nav--main">';
							foreach ($mainMenu as $i=>$item) {
								if($item["label"] != "Highlighted Item") {
									echo '
										<li class="nav__item">';
									if(!empty($item['children'])) {
										echo '
											<span (click)="onMenu('.($i+1).')"><span>'.$item["label"].'</span>
												<svg class="down"><use xlink:href="#caret-down"></use></svg>
												<svg class="next"><use xlink:href="#arrow-next"></use></svg>
											</span>
											<ul class="nav--submenu" [class]="{ active: menu == '.($i+1).' }">';
										foreach($item['children'] as $subitem) {
											echo '
												<li class="nav__item"><a href="'.$subitem["url"].'" target="'.$subitem["target"].'" '.($subitem["rel"] != '' ? 'rel="'.$subitem["rel"].'"' : '').'><span>'.$subitem["label"].'</span></a></li>';
										}										
										echo '
												<li class="nav__item back"><span (click)="onBack()"><svg class="back"><use xlink:href="#arrow-back"></use></svg><span>'.__("Indietro", "wstheme").'</span></span></li>
											</ul>';
									} else {
										echo '
											<a href="'.$item["url"].'" target="'.$item["target"].'" '.($item["rel"] != '' ? 'rel="'.$item["rel"].'"' : '').'><span>'.$item["label"].'</span>
												<svg class="down"><use xlink:href="#caret-down"></use></svg>
												<svg class="next"><use xlink:href="#arrow-next"></use></svg>
											</a>';
									}
									echo '
										</li>';
								} else {
									$hlItems= array_merge($hlItems, $item['children']);
								}
							}
							echo '
									</ul>';
							foreach($hlItems as $item) {
								echo '
									<a href="'.$item["url"].'" target="'.$item["target"].'" '.($item["rel"] != '' ? 'rel="'.$item["rel"].'"' : '').' class="btn--investor">'.$item["label"].'</a>';
							}
						}
						if(isset($secMenu)) {
							get_template_part('templates/partials/shared/navigation', 'top', array("menu" => $secMenu, "hlmenu" => $hlItems));
						}
						?>
					</div>
					<button type="button" class="btn--menu" [class]="{ active: header == 'menu' }" (click)="onToggle('menu')">
						<svg class="menu"><use xlink:href="#menu"></use></svg>
						<svg class="close"><use xlink:href="#close"></use></svg>
					</button>
				</div>
			</div>
		</div>
	</div>
</header>
