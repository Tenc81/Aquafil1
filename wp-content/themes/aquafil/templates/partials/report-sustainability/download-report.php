<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="title-text borders" id="the-project">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3 title-text__divline"></div>
		</div>
		<div class="row">
			<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
				<div class="title-text__content" appear>
					<div class="title-text__title"><?= $_args['section']['titolo_download_report']; ?></div>
					<!--<div class="title-text__abstract">
						<p>Scopri come diventare fornitore ECONYL® Qualified.</p>
					</div>-->
				</div>
			</div>
			<div class="col-sm-9 offset-sm-2 col-md-8 offset-md-3">
				<div class="title-text__content" appear>
					<div class="title-text__description">
            <p><?= $_args['section']['col1_download_report']; ?></p>
					</div>
				</div>
			</div>
			<div class="col-sm-9 offset-sm-2 col-md-8">
				<div class="title-text__content" appear>
					<div class="title-text__description">
						<p><?= $_args['section']['col2_download_report']; ?></p>
					</div>
				</div>
			</div>
			<?php
			$file = $_args['section']['download_report'];
			if(!empty($file)) {
				echo '
					<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
						<div class="title-text__cta">
							<a href="'.$file["url"].'" target="_blank" class="btn--download"><span>'.$_args['section']['etichetta_download_report'].'</span> <svg><use xlink:href="#download"></use></svg></a>
						</div>    
					</div>';
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>
