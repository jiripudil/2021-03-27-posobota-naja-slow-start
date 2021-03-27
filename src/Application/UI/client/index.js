import naja from 'naja';
import 'nette-forms';
import './index.css';

class CategoryFilterExtension {
	initialize(naja) {
		const enableCategoryFilter = (element) => {
			const categoryFilter = element.querySelector('.categoryFilter select');
			categoryFilter?.addEventListener('change', (event) => {
				naja.uiHandler.submitForm(event.target.form);
			});
		}

		enableCategoryFilter(document);
		naja.snippetHandler.addEventListener('afterUpdate', (event) => enableCategoryFilter(event.detail.snippet));
	}
}

class SpinnerExtension {
	constructor(selector) {
		this.selector = selector;
	}

	initialize(naja) {
		naja.uiHandler.addEventListener('interaction', (event) => {
			event.detail.options.spinnerTarget = event.detail.element.closest(this.selector) ?? document.querySelector('.mainContent');
		});

		naja.addEventListener('start', (event) => event.detail.options.spinnerTarget?.classList.add('spinner'));
		naja.addEventListener('complete', (event) => event.detail.options.spinnerTarget?.classList.remove('spinner'));
	}
}

document.addEventListener('DOMContentLoaded', () => {
	naja.uiHandler.selector = ':not([data-naja-off])';
	naja.registerExtension(new CategoryFilterExtension());
	naja.registerExtension(new SpinnerExtension('[data-spinner]'));
	naja.initialize();
});
