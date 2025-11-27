import { Component } from 'rxcomp';
import { first } from 'rxjs/operators';
import { ModalService } from '../../common/modal/modal.service';
import { environment } from '../../environment';

export class CardProductDetailComponent extends Component {
	onRequestInfo(id, product, download, recipient) {
		// Check if Slovenian form is enabled via ACF field
		// Handle various ACF checkbox return values: true, "1", 1, or empty string
		const formSloValue = window.ws_vars ? window.ws_vars.form_sloveno : false;
		const isSlovenianForm = formSloValue === true || formSloValue === "1" || formSloValue === 1 || formSloValue === "true";

		console.log('Form Sloveno Debug:', {
			ws_vars: window.ws_vars,
			form_sloveno_raw: formSloValue,
			isSlovenianForm: isSlovenianForm
		});

		const modalSrc = isSlovenianForm ? environment.template.modal.productRequestModalSlo : environment.template.modal.productRequestModal;
		console.log('Modal selected:', modalSrc);

		ModalService.open$({ src: modalSrc, data: { id: id, productName: product, download: download, recipient: recipient } }).pipe(
			first(),
		).subscribe(event => {
			console.log('CardProductDetailComponent.open$', event);
		});
	}
}

CardProductDetailComponent.meta = {
	selector: '[card-product-detail]',
	inputs: ['id'],
};
