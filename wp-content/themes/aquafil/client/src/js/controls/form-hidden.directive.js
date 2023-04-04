import { Directive, getContext } from 'rxcomp';
import { FormAbstractCollectionDirective } from 'rxcomp-form';
import { fromEvent } from 'rxjs';
import { takeUntil } from 'rxjs/operators';

export class FormHiddenDirective extends Directive {

	get control() {
		if (this.formControl) {
			return this.formControl;
		} else {
			if (!this.host) {
				throw ('missing form collection');
			}
			return this.host.control.get(this.formControlName);
		}
	}

	onInit() {
		const node = getContext(this).node;
		fromEvent(node, 'input').pipe(takeUntil(this.unsubscribe$)).subscribe(event => this.onChange(event));
		fromEvent(node, 'change').pipe(takeUntil(this.unsubscribe$)).subscribe(event => this.onChange(event));
		fromEvent(node, 'blur').pipe(takeUntil(this.unsubscribe$)).subscribe(event => this.onBlur(event));
		this.control.value = this.parseValue();
	}

	onChanges() {
		const node = getContext(this).node;
		if (this.formControlName) {
			node.name = this.formControlName;
		}
		const control = this.control;
		const flags = control.flags;
		Object.keys(flags).forEach((key) => {
			flags[key] ? node.classList.add(key) : node.classList.remove(key);
		});
		this.writeValue(control.value);
	}

	setDisabledState(disabled) {
		const node = getContext(this).node;
		node.disabled = disabled;
	}

	writeValue(value) {
		const node = getContext(this).node;
		node.value = value == null ? '' : value;
	}

	parseValue() {
		const node = getContext(this).node;
		let value = node.value === '' ? null : node.value;
		const flag = Boolean(value);
		const num = parseFloat(value);
		if (String(flag) === value) {
			value = flag;
		} else if (String(num) === value) {
			value = num;
		}
		return value;
	}

	onChange() {
		this.control.value = this.parseValue();
	}

	onBlur() {
		this.control.touched = true;
	}
}

FormHiddenDirective.meta = {
	selector: 'input[type=hidden][formControl],input[type=hidden][formControlName]',
	inputs: ['formControl', 'formControlName'],
	hosts: { host: FormAbstractCollectionDirective },
};
