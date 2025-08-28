import { Component } from 'rxcomp';

export class ProductListComponent extends Component {
	onInit() {
		this.activeFilters = new Set();
		this.currentCategory = 'all';
		this.visibleItemsCount = 10;
		this.itemsPerLoad = 5;
		this.filteredCards = [];
		this.initializeFilters();
		this.initializeSidebarFilters();
		this.updateFilterCounts();
		this.initializeLoadMore();
		this.applyCardVisibility();
	}

	initializeSidebarFilters() {
		const sidebarButtons = document.querySelectorAll('.product-list__sidebar .list-filters .btn');

		sidebarButtons.forEach(button => {
			button.addEventListener('click', (event) => {
				const filterText = event.target.textContent.trim();

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
		const noResultsDiv = document.querySelector('.no-results');

		this.visibleItemsCount = 10;

		this.filteredCards = [];

		cards.forEach(card => {
			const matchesCategory = this.currentCategory === 'all' || card.classList.contains(this.currentCategory);

			if (!matchesCategory) {
				card.style.display = 'none';
				return;
			}

			if (this.activeFilters.size === 0) {
				this.filteredCards.push(card);
				return;
			}

			const tagList = card.querySelector('.tag-list');
			const tags = tagList ? Array.from(tagList.querySelectorAll('.btn')).map(tag => tag.textContent.trim()) : [];

			const cardTagsExpanded = tags.reduce((acc, tag) => {
				return acc.concat(tag.split(', ').map(t => t.trim()));
			}, []);

			const hasAllMatchingTags = Array.from(this.activeFilters).every(filter => {
				const match = cardTagsExpanded.includes(filter);
				console.log(`Filtro "${filter}" trovato:`, match);
				return match;
			});

			console.log('Ha tutti i tag richiesti:', hasAllMatchingTags);
			console.log('---');

			if (hasAllMatchingTags) {
				this.filteredCards.push(card);
			} else {
				card.style.display = 'none';
			}
		});

		if (this.filteredCards.length === 0) {
			noResultsDiv.style.display = 'block';
			const loadMoreBtn = document.querySelector('.load-more-btn');
			if (loadMoreBtn) loadMoreBtn.classList.add('hidden');
		} else {
			noResultsDiv.style.display = 'none';
		}

		this.applyCardVisibility();

		this.updateLoadMoreButton();
	}

	updateFilterCounts() {
		const allCards = document.querySelectorAll('.card--calendar');
		const basedPolymerCards = document.querySelectorAll('.card--calendar.based-polymer');
		const engineeredPolymerCards = document.querySelectorAll('.card--calendar.engineered-polymers');

		const allCountEl = document.querySelector('.history-filter[data-filter="all"] .count');
		const basedPolymerCountEl = document.querySelector('.history-filter[data-filter="based-polymer"] .count');
		const engineeredPolymerCountEl = document.querySelector('.history-filter[data-filter="engineered-polymers"] .count');

		if (allCountEl) allCountEl.textContent = `(${allCards.length})`;
		if (basedPolymerCountEl) basedPolymerCountEl.textContent = `(${basedPolymerCards.length})`;
		if (engineeredPolymerCountEl) engineeredPolymerCountEl.textContent = `(${engineeredPolymerCards.length})`;
	}

	toggleSidebarSections(categoryFilter) {
		const propertiesContent = document.querySelector('.sidebar--item.properties .sidebar--content');
		if (!propertiesContent) return;

		const sections = propertiesContent.querySelectorAll('.filters-title');
		let basedPolymerSection = null;
		let engineeredPolymerSection = null;

		sections.forEach(section => {
			const title = section.textContent.trim().toLowerCase();
			if (title === 'based polymer') {
				basedPolymerSection = section;
			} else if (title === 'engineered polymers') {
				engineeredPolymerSection = section;
			}
		});

		if (basedPolymerSection && engineeredPolymerSection) {
			const getNextFilters = (element) => {
				let nextElement = element.nextElementSibling;
				if (nextElement && nextElement.classList.contains('list-filters')) {
					return nextElement;
				}
				return null;
			};

			const basedPolymerFilters = getNextFilters(basedPolymerSection);
			const engineeredPolymerFilters = getNextFilters(engineeredPolymerSection);

			if (basedPolymerSection) basedPolymerSection.classList.remove('hide-section');
			if (basedPolymerFilters) basedPolymerFilters.classList.remove('hide-section');
			if (engineeredPolymerSection) engineeredPolymerSection.classList.remove('hide-section');
			if (engineeredPolymerFilters) engineeredPolymerFilters.classList.remove('hide-section');

			if (categoryFilter === 'based-polymer') {
				if (engineeredPolymerSection) engineeredPolymerSection.classList.add('hide-section');
				if (engineeredPolymerFilters) engineeredPolymerFilters.classList.add('hide-section');
			}
			else if (categoryFilter === 'engineered-polymers') {
				if (basedPolymerSection) basedPolymerSection.classList.add('hide-section');
				if (basedPolymerFilters) basedPolymerFilters.classList.add('hide-section');
			}
		}
	}

	initializeFilters() {
		const filters = document.querySelectorAll('.history-filter');
		filters.forEach(filter => {
			filter.addEventListener('click', (event) => {
				filters.forEach(f => f.classList.remove('active'));

				const filterEl = event.target.closest('.history-filter');
				filterEl.classList.add('active');

				this.currentCategory = filterEl.getAttribute('data-filter');

				this.clearAllSidebarFilters();

				this.toggleSidebarSections(this.currentCategory);

				this.filterCards();
			});
		});

		const allFilter = document.querySelector('.history-filter[data-filter="all"]');
		if (allFilter) {
			allFilter.classList.add('active');
			this.toggleSidebarSections('all');
		}
	}

	clearAllSidebarFilters() {
		const sidebarButtons = document.querySelectorAll('.product-list__sidebar .list-filters .btn');
		sidebarButtons.forEach(button => {
			button.classList.remove('active');
		});

		this.activeFilters.clear();
	}

	initializeLoadMore() {
		const loadMoreBtn = document.querySelector('.load-more-btn');

		if (loadMoreBtn) {
			loadMoreBtn.addEventListener('click', () => {
				this.loadMoreItems();
			});

			this.updateLoadMoreButton();
		}
	}

	loadMoreItems() {
		this.visibleItemsCount += this.itemsPerLoad;
		this.applyCardVisibility();
		this.updateLoadMoreButton();
	}
	applyCardVisibility() {
		const cards = this.filteredCards.length > 0 ? this.filteredCards : document.querySelectorAll('.card--calendar');
		const noResultsVisible = document.querySelector('.no-results').style.display === 'block';

		if (noResultsVisible) {
			cards.forEach(card => {
				card.style.display = 'none';
			});
			return;
		}

		cards.forEach((card, index) => {
			if (index < this.visibleItemsCount) {
				card.style.display = 'flex';
			} else {
				card.style.display = 'none';
			}
		});
	}
	updateLoadMoreButton() {
		const loadMoreBtn = document.querySelector('.load-more-btn');
		if (!loadMoreBtn) return;

		const filteredCards = this.filteredCards.length > 0 ? this.filteredCards : document.querySelectorAll('.card--calendar');
		const noResultsVisible = document.querySelector('.no-results').style.display === 'block';

		if (noResultsVisible || filteredCards.length <= this.visibleItemsCount) {
			loadMoreBtn.classList.add('hidden');
		} else {
			loadMoreBtn.classList.remove('hidden');
		}
	}
}

ProductListComponent.meta = {
	selector: '[product-list]'
};
