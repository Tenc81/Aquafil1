
export const environmentServed = {
	flags: {
		production: true,
		cart: true,
	},
	markets: ['IT', 'EU', 'AM', 'AS', 'IN'],
	defaultMarket: 'IT',
	currentMarket: 'IT',
	languages: ['it', 'en', 'de', 'ch'],
	defaultLanguage: 'it',
	currentLanguage: 'it',
	api: window.location.protocol + '//' + window.location.host,
	assets: ws_vars.docsDir,
	slug: {
		configureProduct: `/it/it/products-configure`,
		cart: `/it/it/cart`,
		reservedArea: `/it/it/reserved-area`,
	},
	template: {
		modal: {
			genericModal: ws_vars.docsDir + '../templates/partials/modals/generic-modal.html',
			sideModal: ws_vars.docsDir + '../templates/partials/modals/side-modal.html',
			contactModal: ws_vars.docsDir + '../templates/partials/modals/contact-modal.html',
			salesModal: ws_vars.docsDir + '../templates/partials/modals/sales-modal.html',
			galleryModal: ws_vars.docsDir + '../templates/partials/modals/gallery-modal.html',
			userModal: ws_vars.docsDir + '../templates/partials/modals/user-modal.html'
		}
	},
	facebook: {
		appId: 610048027052371,
		fields: 'id,name,first_name,last_name,email,gender,picture,cover,link',
		scope: 'public_profile, email', // publish_stream
		tokenClient: '951b013fe59b05cf471d869aae9ba6ba',
		version: 'v11.0',
	},
	google: {
		clientId: '760742757246-61qknlmthbmr54bh7ch19kjr0sftm4q3.apps.googleusercontent.com',
	},
	linkedIn: {
		clientId: '77cg5ls5lgu3k3',
		clientSecret: 'gfBIl365EdckxCgK',
		scope: 'r_emailaddress r_liteprofile',
	},
	googleMaps: {
		apiKey: 'AIzaSyByTXqwtyFUcD6d4PY7ab4GBwS5IYjEVcc',
	},
	thron: {
		clientId: '',
	},
	workers: {
		image: '/Client/docs/js/workers/image.service.worker.js',
		prefetch: '/Client/docs/js/workers/prefetch.service.worker.js',
	},
	githubDocs: 'https://raw.githubusercontent.com/actarian/aquafil/main/docs/',
};
