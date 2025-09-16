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
        
        // Create Quill editor for new textarea
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
            
            // If this is an existing record, mark it for deletion
            if (hiddenIdInput && hiddenIdInput.value) {
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'deleted_cruise_addons[]';
                deleteInput.value = hiddenIdInput.value;
                document.querySelector('form').appendChild(deleteInput);
            }
            
            // Remove the card immediately
            cardToDelete.remove();
            
            // Update indexes for remaining cards
            updateCruiseAddonIndexes();
        }
    });

    function updateCruiseAddonIndexes() {
        const rows = container.querySelectorAll('.cruise-addon-row');
        rows.forEach((row, index) => {
            const currentIndex = index;
            const select = row.querySelector('select');
            if (select) select.name = `cruiseaddon[${currentIndex}][services]`;

            const textarea = row.querySelector('textarea[name*="[service_name]"]');
            if (textarea) textarea.name = `cruiseaddon[${currentIndex}][service_name]`;
            
            const hiddenInput = row.querySelector('input[type="hidden"][name*="[id]"]');
            if (hiddenInput) hiddenInput.name = `cruiseaddon[${currentIndex}][id]`;
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

    // Run on load
    toggleCruiseField();

    // Run on change
    cruiseCheckbox.addEventListener('change', toggleCruiseField);
});
