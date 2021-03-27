import naja from 'naja';
import 'nette-forms';
import './index.css';

document.addEventListener('DOMContentLoaded', () => {
	naja.uiHandler.selector = ':not([data-naja-off])';
	naja.initialize();

	const enableCategoryFilter = (element) => {
		const categoryFilter = element.querySelector('.categoryFilter select');
		categoryFilter?.addEventListener('change', (event) => {
			naja.uiHandler.submitForm(event.target.form);
		});
	}

	enableCategoryFilter(document);
	naja.snippetHandler.addEventListener('afterUpdate', (event) => enableCategoryFilter(event.detail.snippet));
});
