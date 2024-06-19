import { Directive, getContext } from 'rxcomp';
import { fromEvent } from 'rxjs';
import { takeUntil, tap } from 'rxjs/operators';

export class ToggleDirective extends Directive {
	onInit() {
		const { node } = getContext(this);
		fromEvent(node, 'click').pipe(
			tap(_ => {
				const targetSelector = this.toggle;
				const targetElements = document.querySelectorAll(targetSelector);
				
				targetElements.forEach(target => {
					if (target === node || target.contains(node)) {
						target.classList.toggle('active');
					} else {
						target.classList.remove('active');
					}
				});
			}),
			takeUntil(this.unsubscribe$),
		).subscribe();
	}
}

ToggleDirective.meta = {
	selector: '[toggle]',
	inputs: ['toggle'],
};
