document.addEventListener('DOMContentLoaded', function() {
    let currentFocus = -1;
    let currentSuggestionBox = null;

    // Enhanced autocomplete with keyboard navigation
    function initAutocompleteWithKeyboard(input, suggestionBoxClass, searchRoute, searchParam) {
        const suggestionBox = input.parentElement.querySelector(`.${suggestionBoxClass}`);
        if (!suggestionBox) return;

        input.addEventListener('input', async function(e) {
            const keyword = e.target.value.trim();
            currentFocus = -1;
            
            if (keyword.length < 2) {
                suggestionBox.style.display = 'none';
                return;
            }

            try {
                const response = await axios.get(route(searchRoute), {
                    params: { keyword, searchAt: searchParam }
                });
                
                const data = response.data;
                if (data.length > 0) {
                    suggestionBox.innerHTML = data.map((item, index) => {
                        const text = item.airport_name ? 
                            `${item.airport_name}, ${item.city}, ${item.country}` : 
                            item.airline_code ? 
                            `${item.airline_code}, ${item.airline_name}` :
                            item.name || item;
                        return `<div class="suggestion-item" data-index="${index}">${text}</div>`;
                    }).join('');
                    suggestionBox.style.display = 'block';
                    currentSuggestionBox = suggestionBox;
                } else {
                    suggestionBox.style.display = 'none';
                }
            } catch (error) {
                console.error('Search error:', error);
                suggestionBox.style.display = 'none';
            }
        });

        input.addEventListener('keydown', function(e) {
            if (!currentSuggestionBox || currentSuggestionBox.style.display === 'none') return;
            
            const items = currentSuggestionBox.querySelectorAll('.suggestion-item');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                currentFocus++;
                if (currentFocus >= items.length) currentFocus = 0;
                setActive(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                currentFocus--;
                if (currentFocus < 0) currentFocus = items.length - 1;
                setActive(items);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (currentFocus > -1 && items[currentFocus]) {
                    selectItem(items[currentFocus], input);
                }
            } else if (e.key === 'Escape') {
                currentSuggestionBox.style.display = 'none';
                currentFocus = -1;
            }
        });

        // Mouse click handler
        suggestionBox.addEventListener('click', function(e) {
            if (e.target.classList.contains('suggestion-item')) {
                selectItem(e.target, input);
            }
        });

        input.addEventListener('blur', function() {
            setTimeout(() => {
                if (suggestionBox) suggestionBox.style.display = 'none';
                currentFocus = -1;
            }, 150);
        });
    }

    function setActive(items) {
        items.forEach((item, index) => {
            item.classList.toggle('active', index === currentFocus);
        });
    }

    function selectItem(item, input) {
        const text = item.textContent.trim();
        if (input.classList.contains('airline_code_input')) {
            input.value = text.split(',')[0]; // Get only the code part
        } else {
            input.value = text;
        }
        item.parentElement.style.display = 'none';
        currentFocus = -1;
        input.dispatchEvent(new Event('change'));
    }

    // Initialize for existing elements
    function initializeAutocomplete() {
        // Airport search
        document.querySelectorAll('.departure-airport').forEach(input => {
            initAutocompleteWithKeyboard(input, 'flight-suggestions-list', 'airline.search', 'departure');
        });

        document.querySelectorAll('.arrival-airport').forEach(input => {
            initAutocompleteWithKeyboard(input, 'flight-suggestions-list', 'airline.search', 'arrival');
        });

        // Airline code search
        document.querySelectorAll('.airline_code_input').forEach(input => {
            initAutocompleteWithKeyboard(input, 'flight-code-suggestions-list', 'airlines_code.search', 'departure');
        });

        // Operating service search
        document.querySelectorAll('.operating_service_search').forEach(input => {
            initAutocompleteWithKeyboard(input, 'operating-flight-suggestions-list', 'airline.search', 'departure');
        });
    }

    // Initial setup
    initializeAutocomplete();

    // Observer for dynamically added elements
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) { // Element node
                        // Re-initialize autocomplete for new elements
                        const newInputs = node.querySelectorAll('.departure-airport, .arrival-airport, .airline_code_input, .operating_service_search');
                        newInputs.forEach(input => {
                            if (input.classList.contains('departure-airport') || input.classList.contains('arrival-airport')) {
                                initAutocompleteWithKeyboard(input, 'flight-suggestions-list', 'airline.search', 
                                    input.classList.contains('departure-airport') ? 'departure' : 'arrival');
                            } else if (input.classList.contains('airline_code_input')) {
                                initAutocompleteWithKeyboard(input, 'flight-code-suggestions-list', 'airlines_code.search', 'departure');
                            } else if (input.classList.contains('operating_service_search')) {
                                initAutocompleteWithKeyboard(input, 'operating-flight-suggestions-list', 'airline.search', 'departure');
                            }
                        });
                    }
                });
            }
        });
    });

    // Start observing
    const flightContainer = document.getElementById('flightForms');
    if (flightContainer) {
        observer.observe(flightContainer, { childList: true, subtree: true });
    }
});

// Add CSS for active suggestion
const style = document.createElement('style');
style.textContent = `
    .flight-suggestions-list,
    .flight-code-suggestions-list,
    .operating-flight-suggestions-list {
        max-height: 200px;
        overflow-y: auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }
    .suggestion-item {
        padding: 6px 10px;
        cursor: pointer;
        border-bottom: 1px solid #f8f9fa;
        font-size: 10px;
        color: #055bdb;
        background-color: #dfecff;
        transition: background-color 0.15s ease;
    }
    .suggestion-item:hover,
    .suggestion-item.active {
        background-color: #c7ddff;
        color: #055bdb;
    }
    .suggestion-item:last-child {
        border-bottom: none;
    }
`;
document.head.appendChild(style);