<div class="contacts-form secondary" contact-modal>
	<div class="contacts-form__wrapper">
		<div *if="!success">
			<form class="form" [formGroup]="form" (submit)="onSubmit($event)" name="form" role="form" novalidate autocomplete="off">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-22 offset-sm-1">
							<div class="contacts-form__title" [innerHTML]="ws_vars.labels.titolo_contatti"></div>
							<div class="contacts-form__text-top" [innerHTML]="ws_vars.labels.sottotitolo_contatti"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 offset-sm-1">
							<input name="checkField" [formControl]="controls.checkField" value="" type="text" style="display:none !important;" />
							<div control-text [control]="controls.firstName" [label]="ws_vars.labels.nome"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.lastName" [label]="ws_vars.labels.cognome"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.company" [label]="ws_vars.labels.azienda"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.email" [label]="ws_vars.labels.email"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.address" [label]="ws_vars.labels.indirizzo"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.city" [label]="ws_vars.labels.citta"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.zip" [label]="ws_vars.labels.cap"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-custom-select [control]="controls.country" [label]="ws_vars.labels.nazione"></div>
						</div>
						<div class="col-sm-21 offset-sm-1">
							<div control-text [control]="controls.subject" [label]="ws_vars.labels.soggetto"></div>
						</div>
						<div class="col-sm-21 offset-sm-1">
							<div control-textarea [control]="controls.message" [label]="ws_vars.labels.messaggio"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-21 offset-sm-1">
							<test-component [form]="form" (test)="test($event)" (reset)="reset($event)"></test-component>
							<div class="full" control-checkbox [control]="controls.privacy" [label]="ws_vars.labels.privacy"></div>
							<div class="form__error" *if="error">
								<span class="status-code" [innerHTML]="error.statusCode"></span>
								<span class="status-message" [innerHTML]="error.statusMessage"></span>
								<span class="friendly-message" [innerHTML]="error.friendlyMessage"></span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-22 offset-sm-1">
							<button type="submit" class="btn--submit" data-title="Invia" *if="!form.submitted">
								<span [innerHTML]="ws_vars.labels.invia"></span>
							</button>
							<button type="submit" class="btn--submit" data-title="Inviato!" *if="form.submitted">
								<span [innerHTML]="ws_vars.labels.inviato"></span>
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="container-fluid" *if="success">
			<div class="row">
				<div class="col-sm-22 offset-sm-1">
					<div class="contacts-form__title" [innerHTML]="response"></div>
					<div class="contacts-form__content">
						<div class="contacts-form__abstract" [innerHTML]="message"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
