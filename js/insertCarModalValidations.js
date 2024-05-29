document.addEventListener("DOMContentLoaded", function() {
    const transmissionInput = document.getElementById('transmission');
    const yearInput = document.getElementById('year');
    const colorInput = document.getElementById('color');
    const mileageInput = document.getElementById('mileage');
    const rentalRateInput = document.getElementById('rentalRate');
    const descriptionInput = document.getElementById('description');

    const inputs = [transmissionInput, yearInput, colorInput, mileageInput, rentalRateInput, descriptionInput];

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (input.value !== "") {
                input.style.borderColor = 'green';
            } else {
                input.style.borderColor = '';
            }
        });
    });
});