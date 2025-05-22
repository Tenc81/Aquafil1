import { Component } from 'rxcomp';

export class ProductListComponent extends Component {
	onInit() {
		this.activeFilters = new Set();
		this.currentCategory = 'all';
		this.initializeFilters();
		this.initializeSidebarFilters();
		this.updateFilterCounts();
	}

	initializeSidebarFilters() {
		const sidebarButtons = document.querySelectorAll('.product-list__sidebar .list-filters .btn');

		sidebarButtons.forEach(button => {
			button.addEventListener('click', (event) => {
				const filterText = event.target.textContent.trim();

				// Toggle active state of the button
				button.classList.toggle('active');

				if (button.classList.contains('active')) {
					this.activeFilters.add(filterText);
				} else {
					this.activeFilters.delete(filterText);
				}

				this.filterCards();
			});
		});
	}

	filterCards() {
		const cards = document.querySelectorAll('.card--calendar');
		let visibleCards = 0;
		const noResultsDiv = document.querySelector('.no-results');

		cards.forEach(card => {
			// Prima controlla se la card appartiene alla categoria corrente
			const matchesCategory = this.currentCategory === 'all' || card.classList.contains(this.currentCategory);

			// Se non appartiene alla categoria, nascondi la card
			if (!matchesCategory) {
				card.style.display = 'none';
				return;
			}

			// Se non ci sono filtri attivi nella sidebar e la card appartiene alla categoria, mostrala
			if (this.activeFilters.size === 0) {
				card.style.display = 'flex';
				visibleCards++;
				return;
			}

			// Controlla i tag della card
			const tagList = card.querySelector('.tag-list');
			const tags = Array.from(tagList.querySelectorAll('.btn')).map(tag => tag.textContent.trim());

			// Check if any of the card's tags match any of the active filters
			const hasMatchingTag = Array.from(this.activeFilters).some(filter => {
				// Handle comma-separated tags (like "Filled, Impact Modified, Colored")
				const cardTagsExpanded = tags.reduce((acc, tag) => {
					return acc.concat(tag.split(', '));
				}, []);

				return cardTagsExpanded.includes(filter);
			});

			card.style.display = hasMatchingTag ? 'flex' : 'none';
			if (hasMatchingTag) visibleCards++;
		});

		// Mostra/nascondi il messaggio "nessun risultato"
		if (visibleCards === 0) {
			noResultsDiv.style.display = 'block';
		} else {
			noResultsDiv.style.display = 'none';
		}
	}

	updateFilterCounts() {
		// Get all cards
		const allCards = document.querySelectorAll('.card--calendar');
		const basedPolymerCards = document.querySelectorAll('.card--calendar.based-polymer');
		const engineeredPolymerCards = document.querySelectorAll('.card--calendar.engineered-polymers');

		// Update count numbers in the filter menu
		const allCountEl = document.querySelector('.history-filter[data-filter="all"] .count');
		const basedPolymerCountEl = document.querySelector('.history-filter[data-filter="based-polymer"] .count');
		const engineeredPolymerCountEl = document.querySelector('.history-filter[data-filter="engineered-polymers"] .count');

		if (allCountEl) allCountEl.textContent = `(${allCards.length})`;
		if (basedPolymerCountEl) basedPolymerCountEl.textContent = `(${basedPolymerCards.length})`;
		if (engineeredPolymerCountEl) engineeredPolymerCountEl.textContent = `(${engineeredPolymerCards.length})`;
	}

	initializeFilters() {
		const filters = document.querySelectorAll('.history-filter');
		filters.forEach(filter => {
			filter.addEventListener('click', (event) => {
				// Remove active class from all filters
				filters.forEach(f => f.classList.remove('active'));

				// Add active class to clicked filter
				const filterEl = event.target.closest('.history-filter');
				filterEl.classList.add('active');

				// Get and store the filter value
				this.currentCategory = filterEl.getAttribute('data-filter');

				// Apply filters
				this.filterCards();
			});
		});

		// Ensure "All" filter is active by default
		const allFilter = document.querySelector('.history-filter[data-filter="all"]');
		if (allFilter) {
			allFilter.classList.add('active');
		}
	}
}

ProductListComponent.meta = {
	selector: '[product-list]'
};
