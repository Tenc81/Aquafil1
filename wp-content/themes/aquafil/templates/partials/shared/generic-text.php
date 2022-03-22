<?php
$_args = wp_parse_args(
  $args,
  array(
    'section' => array(),
    'index' => 0
  ));
if(!empty($_args['section'])) :
?>
<div class="section-generic">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
        <?= $_args['section']["text"]; ?>
      </div>
			<?php
			if(!empty($_args['section']['generic_link'])) {
				echo '
				<div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
					<a href="'.$_args['section']['generic_link']["url"].'" class="btn--more-md"><span>'.$_args['section']['generic_link']["title"].'</span> <svg><use xlink:href="#arrow-next-md"></use></svg></a>
				</div>';
			}
			?>
    </div>
  </div>
</div>
<?php endif; ?>
