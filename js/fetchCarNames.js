document.addEventListener("DOMContentLoaded", function() {
    const carForm = document.getElementById('carForm');
    const carSearch = document.getElementById('carSearch');
    const carDropdown = document.getElementById('carDropdown');
    const error = document.getElementById('error');
    let carBrands = [];

    fetch('../js/carBrands.json')
        .then(response => response.json())
        .then(data => {
            carBrands = data.map(brand => brand.toLowerCase());

            carSearch.addEventListener('input', function() {
                const enteredCar = carSearch.value.toLowerCase();
                const isCarValid = carBrands.includes(enteredCar);

                carSearch.style.borderColor = isCarValid ? 'green' : 'red';

                if (!isCarValid && enteredCar.trim() !== "") {
                    error.textContent = 'Please select a valid car brand.';
                } else {
                    error.textContent = '';
                }

                const searchValue = enteredCar.toLowerCase();
                const filteredBrands = carBrands.filter(brand => brand.startsWith(searchValue));

                carDropdown.innerHTML = '';

                if (filteredBrands.length > 0) {
                    filteredBrands.forEach(brand => {
                        const option = document.createElement('div');
                        option.textContent = brand;
                        option.className = 'dropdown-item';
                        option.addEventListener('click', function() {
                            carSearch.value = brand;
                            carDropdown.innerHTML = '';
                            error.textContent = '';
                            carSearch.style.borderColor = 'green';
                        });
                        carDropdown.appendChild(option);
                    });
                    carDropdown.style.display = 'block';
                } else {
                    carDropdown.style.display = 'none';
                }
            });

            document.addEventListener('click', function(event) {
                if (!carDropdown.contains(event.target) && !carSearch.contains(event.target)) {
                    carDropdown.style.display = 'none';
                }
            });
        })
        .catch(error => console.error('Error fetching car brands:', error));

    carForm.addEventListener('submit', function(event) {
        const enteredCar = carSearch.value.toLowerCase();
        if (!carBrands.includes(enteredCar)) {
            error.textContent = 'Please select a valid car brand.';
            event.preventDefault();
        } else {
            error.textContent = '';
        }
    });
});