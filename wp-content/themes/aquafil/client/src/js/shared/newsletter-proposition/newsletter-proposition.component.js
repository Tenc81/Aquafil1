import { Component } from 'rxcomp';
import { FormControl, FormGroup, Validators } from 'rxcomp-form';
import { first, takeUntil, tap } from 'rxjs/operators';
import { FormService } from '../../controls/form.service';
import { ContactsService } from '../../pages/contact-modal/contacts.service';

export class NewsletterPropositionComponent extends Component {

	onInit() {
		this.error = null;
		this.success = false;
		this.response = null;
		this.message = null;
		const form = this.form = new FormGroup({
			country: new FormControl(null),
			email: new FormControl(null, [Validators.RequiredValidator()]),
			privacy: new FormControl(null, [Validators.RequiredTrueValidator()]),
			newsletter: new FormControl(null, [Validators.RequiredTrueValidator()]),
			language: new FormControl(null, [Validators.RequiredValidator()]),
			checkRequest: window.antiforgery,
			checkField: '',
			action: 'subscribe_newsletter',
		});
		const controls = this.controls = form.controls;
		form.changes$.pipe(
			takeUntil(this.unsubscribe$)
		).subscribe((_) => {
			this.pushChanges();
		});
		this.load$().pipe(
			first(),
		).subscribe();
	}

	load$() {
		return ContactsService.data$().pipe(
			tap(data => {
				const controls = this.controls;
				controls.country.options = FormService.toSelectOptions(data.country.options);
				this.pushChanges();
			})
		);
	}

	reset() {
		const form = this.form;
		form.reset();
	}

	onSubmit(model) {
		const form = this.form;
		console.log('NewsletterPropositionComponent.onSubmit', form.value);
		if (form.valid) {
			form.submitted = true;
			ContactsService.submit$(form.value).pipe(
				first(),
			).subscribe(_ => {
				// if (_.success) {
				// 	GtmService.push({ 'event': "Newsletter", 'form_name': "Newsletter" });
				// }
				this.success = true;
				form.reset();
				this.response = _.data["response"];
				this.message = _.data["message"];
			}, error => {
				console.log('NewsletterPropositionComponent.error', error);
				this.error = error;
				this.pushChanges();
			});
		} else {
			form.touched = true;
		}
	}
}

NewsletterPropositionComponent.meta = {
	selector: '[newsletter-proposition]',
	inputs: [],
};
