import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.getElementById('cruise-addon-button');
    const container = document.getElementById('cruise-addon-container');

    if (!addButton || !container) return;

    addButton.addEventListener('click', function () {
        const index = container.querySelectorAll('.cruise-addon-row').length;
        const newRow = `
            <div class="col-md-4 mb-4 cruise-addon-row">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Services</label>
                            <select class="form-control" name="cruiseaddon[${index}][services]">
                                <option value="">Select</option>
                                <option value="Excursions">Excursions</option>
                                <option value="WiFi Packages">WiFi Packages</option>
                                <option value="Crew Appreciation Fees/Gratuities">Crew Appreciation Fees/Gratuities</option>
                                <option value="Shuttle Services">Shuttle Services</option>
                                <option value="Speciality Dining">Speciality Dining</option>
                                <option value="Drink Packages">Drink Packages</option>
                                <option value="Trip Insurance">Trip Insurance</option>
                                <option value="Check-in Proces (Luggage Tags & Sailing Pass)">Check-in Proces (Luggage Tags & Sailing Pass)</option>
                                <option value="Special Occasion Package">Special Occasion Package</option>
                                <option value="Water Bottle or Distilled Water Package">Water Bottle or Distilled Water Package</option>
                                <option value="Old Itinerary">Old Itinerary</option>
                                <option value="Changed Itinerary">Changed Itinerary</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name of Service</label>
                            <textarea class="form-control" name="cruiseaddon[${index}][service_name]" rows="4"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-outline-danger delete-addon-cruise-btn">
                                <i class="ri ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', newRow);
        const textarea = document.querySelector(`textarea[name="cruiseaddon[${index}][service_name]"]`);
        
        const editorDiv = document.createElement('div');
        editorDiv.style.minHeight = '150px';
        textarea.style.display = 'none';
        textarea.parentNode.insertBefore(editorDiv, textarea.nextSibling);

        const quill = new Quill(editorDiv, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

        window.quillInstances[textarea.name] = quill;
        
        quill.on('text-change', () => {
            textarea.value = quill.root.innerHTML;
        });
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.delete-addon-cruise-btn')) {
            e.preventDefault();
            const cardToDelete = e.target.closest('.cruise-addon-row');
            const hiddenIdInput = cardToDelete.querySelector('input[type="hidden"][name*="[id]"]');
            
            if (hiddenIdInput && hiddenIdInput.value) {
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'deleted_cruise_addons[]';
                deleteInput.value = hiddenIdInput.value;
                document.querySelector('form').appendChild(deleteInput);
            }
            
            cardToDelete.remove();
            updateCruiseAddonIndexes();
        }
    });

    function updateCruiseAddonIndexes() {
        const rows = container.querySelectorAll('.cruise-addon-row');
        rows.forEach((row, index) => {
            const select = row.querySelector('select');
            if (select) select.name = `cruiseaddon[${index}][services]`;

            const textarea = row.querySelector('textarea[name*="[service_name]"]');
            if (textarea) textarea.name = `cruiseaddon[${index}][service_name]`;
            
            const hiddenInput = row.querySelector('input[type="hidden"][name*="[id]"]');
            if (hiddenInput) hiddenInput.name = `cruiseaddon[${index}][id]`;
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const cruiseCheckbox = document.querySelector('#booking-cruise');
    const cruiseRoomCategory = document.querySelectorAll('#cruise_room_category');

    if (!cruiseCheckbox) return;

    function toggleCruiseField() {
        cruiseRoomCategory.forEach(el => {
            el.style.display = cruiseCheckbox.checked ? "" : "none";
        });
    }

    toggleCruiseField();
    cruiseCheckbox.addEventListener('change', toggleCruiseField);
});

document.addEventListener('DOMContentLoaded', function() {
    let cruisePorts = [];
    
    async function fetchCruisePorts() {
        try {
            const response = await fetch('/api/cruise-ports');
            if (response.ok) {
                cruisePorts = await response.json();
            }
        } catch (error) {
            console.error('Error fetching cruise ports:', error);
        }
    }
    
    fetchCruisePorts();
    
    function createSuggestionDropdown(input) {
        const dropdown = document.createElement('div');
        dropdown.className = 'cruise-port-suggestions';
        dropdown.style.cssText = 'position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ccc; max-height: 200px; overflow-y: auto; z-index: 99999; display: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);';
        input.parentNode.style.position = 'relative';
        input.parentNode.appendChild(dropdown);
        return dropdown;
    }
    
    function showSuggestions(input, dropdown, query) {
        if (!query || query.length < 2) {
            dropdown.style.display = 'none';
            return;
        }
        
        const filtered = cruisePorts.filter(port => 
            port.name.toLowerCase().includes(query.toLowerCase()) ||
            port.country.toLowerCase().includes(query.toLowerCase())
        );
        
        if (filtered.length === 0) {
            dropdown.style.display = 'none';
            return;
        }
        

        
        dropdown.innerHTML = filtered.map(port => 
            `<div class="suggestion-item" style="padding: 8px; cursor: pointer; border-bottom: 1px solid #eee;" data-port="${port.name}, ${port.country}">
                ${port.name}, ${port.country}
            </div>`
        ).join('');
        
        dropdown.style.display = 'block';
        
        dropdown.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', function() {
                input.value = this.dataset.port;
                dropdown.style.display = 'none';
            });
        });
    }
    
    function setupPortAutoSuggestion(input) {
        // Ensure table cell can show dropdown
        const tableCell = input.closest('td');
        if (tableCell) {
            tableCell.style.overflow = 'visible';
        }
        const table = input.closest('table');
        if (table) {
            table.style.overflow = 'visible';
        }
        const tableContainer = input.closest('.table-responsive');
        if (tableContainer) {
            tableContainer.style.overflow = 'visible';
        }
        
        const dropdown = createSuggestionDropdown(input);
        
        input.addEventListener('input', function() {
            showSuggestions(input, dropdown, this.value);
        });
        
        input.addEventListener('focus', function() {
            if (this.value.length >= 2) {
                showSuggestions(input, dropdown, this.value);
            }
        });
        
        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
    }
    
    document.querySelectorAll('input[name="departure_port"], input[name="arrival_port"]').forEach(input => {
        setupPortAutoSuggestion(input);
    });
    
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) {
                    const portInputs = node.querySelectorAll ? node.querySelectorAll('input[name*="departure_port"], input[name*="arrival_port"]') : [];
                    portInputs.forEach(input => {
                        setupPortAutoSuggestion(input);
                    });
                }
            });
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});