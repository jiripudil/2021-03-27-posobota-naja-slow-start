import 'nette-forms';
import './index.css';

document.addEventListener('DOMContentLoaded', () => {
	const categoryFilter = document.querySelector('.categoryFilter select');
	if (categoryFilter !== null) {
		categoryFilter.addEventListener('change', (event) => {
			event.target.form.submit();
		});
	}
});
