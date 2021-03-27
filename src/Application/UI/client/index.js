import naja from 'naja';
import 'nette-forms';
import './index.css';

document.addEventListener('DOMContentLoaded', () => {
	naja.uiHandler.selector = ':not([data-naja-off])';
	naja.initialize();

	const categoryFilter = document.querySelector('.categoryFilter select');
	if (categoryFilter !== null) {
		categoryFilter.addEventListener('change', (event) => {
			event.target.form.requestSubmit();
		});
	}
});
