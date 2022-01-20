<div class="sticky-menu">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2">
				<div class="sticky-menu__content">
					<!--
					<div class="sticky-menu__title">
						Change country
					</div>
					-->
					<ul class="nav--scroll-menu" scroll-menu>

<?php foreach($all as $k => $v) {
	echo setAnchorMenuItem($v);
 } ?>

					</ul>
				</div>
			</div>
		</div>
	</div>
</div>