<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
			<?php
			if($_args['section']['titolo_download'] != '') {
				echo '<div class="certification__title">'.$_args['section']['titolo_download'].'</div>';
			}
			?>
			<div class="listing--downloads">
				<?php
				foreach($_args['section']['lista_downloads'] as $download) {
					$file = $download['file_download'];
					if(!empty($file)) {
						echo '
							<div class="listing__item">
								<a href="#" download="'.$file['url'].'" class="btn--certification">
									<span>'.$download['titolo_download'].'</span>
									<span class="icon">
										<svg><use xlink:href="#download"></use></svg>
									</span>
								</a>
							</div>';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
