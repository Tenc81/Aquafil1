<div class="contacts-form secondary" contact-modal>
	<div class="contacts-form__wrapper">
		<div *if="!success">
			<form class="form" [formGroup]="form" (submit)="onSubmit($event)" name="form" role="form" novalidate autocomplete="off">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-22 offset-sm-1">
							<div class="contacts-form__title" [innerHTML]="'titolo_contatti' | label"></div>
							<div class="contacts-form__text-top" [innerHTML]="'sottotitolo_contatti' | label"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 offset-sm-1">
							<input name="checkField" [formControl]="controls.checkField" value="" type="text" style="display:none !important;" />
							<div control-text [control]="controls.firstName" [label]="'nome' | label"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.lastName" [label]="'cognome' | label"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.company" [label]="'azienda' | label"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.email" [label]="'email' | label"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.address" [label]="'indirizzo' | label"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.city" [label]="'citta' | label"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-text [control]="controls.zip" [label]="'cap' | label"></div>
						</div>
						<div class="col-sm-10 offset-sm-1">
							<div control-custom-select [control]="controls.country" [label]="'nazione' | label"></div>
						</div>
						<div class="col-sm-21 offset-sm-1">
							<div control-text [control]="controls.subject" [label]="'soggetto' | label"></div>
						</div>
						<div class="col-sm-21 offset-sm-1">
							<div control-textarea [control]="controls.message" [label]="'messaggio' | label"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-21 offset-sm-1">
							<test-component [form]="form" (test)="test($event)" (reset)="reset($event)"></test-component>
							<div class="full" control-checkbox [control]="controls.privacy" [label]="'privacy' | label"></div>
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
								<span [innerHTML]="'invia' | label"></span>
							</button>
							<button type="submit" class="btn--submit" data-title="Inviato!" *if="form.submitted">
								<span [innerHTML]="'inviato' | label"></span>
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
