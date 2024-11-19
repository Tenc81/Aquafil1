


import { from, Observable, of } from 'rxjs';
import { concatMap, first, map, switchMap } from 'rxjs/operators';
import { environment } from '../../environment';
import { OnceService } from '../once/once.service';

export class RecaptchaService {

	static authResponse;
	static storage;
	static grecaptcha;
	static auth2;
	static instance;

	static init() {
		if (!environment.grecaptcha || !environment.grecaptcha.sitekey) {
			throw new Error('RecaptchaService.error missing sitekey in environment.grecaptcha');
		}
	}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*  call RecaptchaService.grecaptcha on component OnInit to avoid popup blockers via asyncronous loading *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	static execute$(action = 'submit') {
		return this.grecaptcha$().pipe(
			first(),
			switchMap(grecaptcha => {
				return from(
					new Promise((resolve, reject) => {
						grecaptcha.enterprise
							.ready(() => {
								grecaptcha.enterprise
									.execute(environment.grecaptcha.sitekey, { action })
									.then((token) => {
										resolve(token);
									});
							});
					})
				);
			}),
		)
	}

	static render$(idOrElement = 'recaptcha', theme = 'light') {
		return this.grecaptcha$().pipe(
			map(grecaptcha => {
				return grecaptcha.render(idOrElement, {
					sitekey: environment.grecaptcha.sitekey,
					theme: theme
				})
			}),
		)
	}

	static grecaptcha$() {
		return new Observable().pipe(x => {
			if (this.grecaptcha) {
				return of(this.grecaptcha);
			} else {
				return this.once$();
			}
		});
	}

	static once$() {
		return OnceService.script$(`//www.google.com/recaptcha/enterprise.js?onload={{callback}}&render=${environment.grecaptcha.sitekey}`, true).pipe(
			concatMap(x => {
				this.grecaptcha = window['grecaptcha'];
				return of(this.grecaptcha);
			})
		);
	}
}
