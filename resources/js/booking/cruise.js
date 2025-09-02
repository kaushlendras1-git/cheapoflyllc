
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
                <td style="width:400px"><textarea class="form-control" name="cruiseaddon[${index}][service_name]" rows="6"></textarea></td>
                <td><input type="file" multiple class="form-control" name="cruiseaddon[${index}][image][]" /></td>
                <td><button type="button" class="btn btn-outline-danger delete-addon-cruise-btn"><i class="ri ri-delete-bin-line"></i></button></td>
            </tr>
        `;

        container.insertAdjacentHTML('beforeend', newRow);
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.delete-addon-cruise-btn')) {
            e.target.closest('.cruise-addon-row').remove();
        }
    });
});