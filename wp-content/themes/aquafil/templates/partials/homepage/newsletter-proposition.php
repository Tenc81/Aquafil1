<?php
if(!is_page_template("templates/landing.php")) {
  return; // provvisorio
}

if(is_page_template("templates/landing.php")) {
  $lang = "sl";
} else {
  $lang = ICL_LANGUAGE_CODE;
}
// if(is_singular()) {
// 	$action = get_permalink();
// } elseif(is_home()) {
// 	$action = get_permalink(get_option("page_for_posts"));
// } elseif(is_tax()) {
// 	$action = get_term_link(get_queried_object_id());
// } elseif(is_archive()) {
// 	global $wp_query;
// 	$action = get_post_type_archive_link($wp_query->query_vars['post_type']);
// } else {
// 	$action = home_url();
// } 
?>
<!-- NEWSLETTER PROPOSITION -->
<div class="newsletter-proposition borders" newsletter-proposition><!-- action="<?= $action; ?>">-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 offset-sm-2 col-md-8 offset-md-3">
				<div class="newsletter-proposition__content">
          <div class="newsletter-proposition__title">Newsletter</div>
          <div class="newsletter-proposition__abstract"><?= __("Get a preview of our latest news", "wstheme"); ?></div>
				</div>
			</div>
			<div class="col-sm-11 offset-sm-1 col-md-9 offset-md-1">
        <div *if="!success">
          <form class="form newsletter-proposition__form" [formGroup]="form" (submit)="onSubmit($event)" name="form" role="form" novalidate autocomplete="off">
            <div class="newsletter-proposition__flex">
              <div class="newsletter-proposition__email">
                <div control-email [control]="controls.email" label="<?= __("Inserisci la tua email", "wstheme"); ?>"></div>
                <svg><use xlink:href="#email"></use></svg>
              </div>
              <div class="newsletter-proposition__cta">
                <button type="submit" class="btn--submit" data-title="Invia" *if="!form.submitted">
                  <span><?= __("Iscriviti", "wstheme"); ?></span>
                </button>
                <button type="submit" class="btn--submit" data-title="Inviato!" *if="form.submitted">
                  <span [innerHTML]="'inviato' | label"></span>
                </button>
              </div>
            </div>
            <div class="newsletter-proposition__checkboxes">
              <div class="full" control-checkbox [control]="controls.privacy" [label]="'privacy' | label"></div>
            </div>
            <input name="newsletter" [formControl]="controls.newsletter" value="true" type="hidden" />
            <input name="language" [formControl]="controls.language" value="<?= $lang; ?>" type="hidden" />
          </form>
        </div>

        <div class="container-fluid" *if="success">
          <div class="row">
            <div class="col-sm-22 offset-sm-1">
              <div class="newsletter-proposition__content">
                <div class="newsletter-proposition__title" [innerHTML]="response"></div>
                <div class="newsletter-proposition__abstract" [innerHTML]="message"></div>
              </div>
            </div>
          </div>
        </div>

			</div>
		</div>
	</div>
</div>