import { Component, getContext } from 'rxcomp';
import { FormControl, FormGroup, Validators } from 'rxcomp-form';
import { first, takeUntil, tap } from 'rxjs/operators';
import { GtmService } from '../../common/gtm/gtm.service';
import { ModalOutletComponent } from '../../common/modal/modal-outlet.component';
import { ModalService } from '../../common/modal/modal.service';
import { FormService } from '../../controls/form.service';
import { ProductRequestSloService } from './product-request-slo.service';

export class ProductRequestSloComponent extends Component {

	onInit() {
		const { parentInstance } = getContext(this);
		if (parentInstance instanceof ModalOutletComponent) {
			const data = parentInstance.modal.data;
			const id = data.id;
			const productName = data.productName;
			this.productName = productName ? productName : this.productName;
			const recipient = data.recipient;
			this.recipient = recipient ? recipient : this.recipient;
			const download = data.download;
			this.download = download ? download : this.download;
			console.log('ProductRequestSloComponent.onInit', id, productName);
		}
		this.error = null;
		this.success = false;
		this.response = '';
		this.message = '';
		const form = this.form = new FormGroup({
			productName: this.productName,
			recipient: this.recipient,
			download: this.download,
			firstName: new FormControl(null, [Validators.RequiredValidator()]),
			lastName: new FormControl(null, [Validators.RequiredValidator()]),
			email: new FormControl(null, [Validators.RequiredValidator(), Validators.EmailValidator()]),
			address: new FormControl(null),
			city: new FormControl(null),
			zip: new FormControl(null),
			message: new FormControl(null, [Validators.RequiredValidator()]),
			file: new FormControl(null, [Validators.RequiredValidator()]),
			privacy: new FormControl(null, [Validators.RequiredTrueValidator()]),
			checkRequest: window.antiforgery,
			checkField: '',
			action: 'save_product_request_slo',
		});
		const controls = this.controls = form.controls;
		form.changes$.pipe(
			takeUntil(this.unsubscribe$)
		).subscribe((_) => {
			this.pushChanges();
		});
		this.pushChanges();
	}

	test() {
		const form = this.form;
		const controls = this.controls;
		form.patch({
			firstName: 'Janez',
			lastName: 'Novak',
			email: 'janez.novak@gmail.com',
			address: 'Slovenska cesta 1',
			city: 'Ljubljana',
			zip: '1000',
			message: 'Pozdravljeni!',
			privacy: true,
			checkRequest: window.antiforgery,
			checkField: ''
		});
	}

	reset() {
		const form = this.form;
		form.reset();
	}

	onSubmit(model) {
		const form = this.form;
		console.log('ProductRequestSloComponent.onSubmit', form.value);
		if (form.valid) {
			form.submitted = true;
			ProductRequestSloService.submit$(form.value).pipe(
				first(),
			).subscribe(_ => {
				if (_.success) {
					GtmService.push({ 'event': "Product Request SLO", 'form_name': "Product Request Slovenian" });
				}
				this.success = true;
				form.reset();
				this.response = _.data["response"];
				this.message = _.data["message"];
			}, error => {
				console.log('ProductRequestSloComponent.error', error);
				this.error = error;
				this.pushChanges();
			});
		} else {
			form.touched = true;
		}
	}

	onClose() {
		ModalService.reject();
	}
}

ProductRequestSloComponent.meta = {
	selector: '[product-request-slo]',
	inputs: ['productName', 'download'],
};
