import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.getElementById('cruise-addon-button');
    const container = document.getElementById('cruise-addon-container');

    addButton.addEventListener('click', function () {

        const index = container.querySelectorAll('.cruise-addon-row').length;
        const newRow = `
            <tr class="cruise-addon-row">
                <td style="width: 200px">
                    <select class="form-control" name="cruiseaddon[${index}][services]">
                        <option value="">Select</option>
                        <option>Excursions</option>
                        <option>WiFi Packages</option>
                        <option>Crew Appreciation Fees/Gratuities</option>
                        <option>Shuttle Services</option>
                        <option>Speciality Dining</option>
                        <option>Drink Packages</option>
                        <option>Trip Insurance</option>
                        <option>Check-in Proces (Luggage Tags & Sailing Pass)</option>
                        <option>Special Occasion Package</option>
                        <option>Water Bottle or Distiled Water Package</option>
                        <option>Old Itinerary</option>
                        <option>Changed Itinerary</option>
                    </select>
                </td>
                <td style="width:1200px">
                    <textarea class="form-control cruiseaddon ckeditor" name="cruiseaddon[${index}][service_name]" rows="6"></textarea>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger delete-addon-cruise-btn"><i class="ri ri-delete-bin-line"></i></button>
                </td>
            </tr>
        `;

        container.insertAdjacentHTML('beforeend', newRow);
        const textarea = document.querySelector(`textarea[name="cruiseaddon[${index}][service_name]"]`);
        ClassicEditor.create(textarea, {
            toolbar: ["bold", "italic", "link", "bulletedList", "numberedList", "blockQuote", "undo", "redo"],
        })
            .catch(error => {
                console.error(error);
            });
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.delete-addon-cruise-btn')) {
            e.target.closest('.cruise-addon-row').remove();
            updateCruiseAddonIndexes();
        }
    });

    function updateCruiseAddonIndexes() {
        const rows = container.querySelectorAll('.cruise-addon-row');
        rows.forEach((row, index) => {
            const currentIndex = index;
            const select = row.querySelector('select');
            if (select) select.name = `cruiseaddon[${currentIndex}][services]`;

            const textarea = row.querySelector('textarea.ckeditor');
            if (textarea) textarea.name = `cruiseaddon[${currentIndex}][service_name]`;
        });
    }
});