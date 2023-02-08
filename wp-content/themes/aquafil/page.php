<?php get_header(); ?>

<?php 
global $post;
// If post password required and it doesn't match the cookie.
if ( post_password_required( $post ) ) {
  echo '
    <main class="main">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-8 offset-sm-6 col-md-7 offset-md-6">'
          .get_the_password_form( $post ).
          '</div>
        </div>
      </div>
    </main>';
  get_footer();
  return;
}
?>

<main class="main">
	<?php
	$fields = get_fields(get_queried_object());
	$filtered = array_filter($fields['sezioni'], function($section) {
		$keys = array_keys($section);
		$result = preg_grep('@\d+_attiva_sticky_item@', $keys);
		return !empty($result) && $section[reset($result)];
	});
	get_template_part( 'templates/partials/shared/sticky', null, array("all" => $filtered) );

	get_template_part('templates/partials/shared/breadcrumb');

	foreach($fields['sezioni'] as $i=>$section) {
		$partialPathRaw = explode('-', $section['acf_fc_layout']);
		$template = locate_template_part($partialPathRaw);
		if($template) {
			$part = substr(strstr($template, 'templates'), 0, strpos(strstr($template, 'templates'), '.php'));
			get_template_part($part, null, array("section" => $section, "index" => $i+1));
		}
	}

	get_template_part("templates/partials/homepage/newsletter-proposition");
	?>
</main>

<?php get_footer(); ?>
