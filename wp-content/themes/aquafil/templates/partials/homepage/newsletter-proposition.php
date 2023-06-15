<?php
if(get_the_ID() != 31744 && get_the_ID() != 24299) {
  return; // provvisorio
}

$lang = "sl";
if(get_the_ID() == 31744 || get_the_ID() == 24299) {
  $labels = array(
    "title" => "Novičnik AquafilSLO",
    "subtitle" => "Naročite se na naš Novičnik in ostanite obveščeni o vseh novostih.",
    "email_label" => "Vnesite svoj email",
    "submit_label" => "Prijava",
  );
} else {
  $labels = array(
    "title" => __("Newsletter AquafilSLO", "wstheme"),
    "subtitle" => __("Subscribe to our Newsletter and stay informed about all the news.", "wstheme"),
    "email_label" => __("Inserisci la tua email", "wstheme"),
    "submit_label" => __("Iscriviti", "wstheme"),
  );
}
?>
<!-- NEWSLETTER PROPOSITION -->
<div class="newsletter-proposition borders" newsletter-proposition>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 offset-sm-2 col-md-8 offset-md-3">
				<div class="newsletter-proposition__content">
          <div class="newsletter-proposition__title"><?= $labels["title"]; ?></div>
          <div class="newsletter-proposition__abstract"><?= $labels["subtitle"]; ?></div>
				</div>
			</div>
			<div class="col-sm-11 offset-sm-1 col-md-9 offset-md-1">
        <div *if="!success">
          <form class="form newsletter-proposition__form" [formGroup]="form" (submit)="onSubmit($event)" name="form" role="form" novalidate autocomplete="off">
            <div class="newsletter-proposition__flex">
              <div class="newsletter-proposition__email">
                <div control-email [control]="controls.email" label="<?= $labels["email_label"]; ?>"></div>
                <svg><use xlink:href="#email"></use></svg>
              </div>
              <div class="newsletter-proposition__cta">
                <button type="submit" class="btn--submit" data-title="Invia" *if="!form.submitted">
                  <span><?= $labels["submit_label"]; ?></span>
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