document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('carForm');
    const imageInputs = document.querySelectorAll('input[type="file"]');
    const carSearchInput = document.getElementById('carSearch');
    const transmissionInput = document.getElementById('transmission');
    const yearInput = document.getElementById('year');
    const rentalRateInput = document.getElementById('rentalRate');
    const descriptionInput = document.getElementById('description');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        const inputs = [carSearchInput, rentalRateInput];

        inputs.forEach(input => {
            if (input.value.trim() === "") {
                input.style.borderColor = 'red';
                isValid = false;
            } else {
                input.style.borderColor = 'green';
            }
        });

        const yearValue = parseInt(yearInput.value.trim());
        const yearError = document.getElementById('yearError');
        if (isNaN(yearValue) || yearValue < 1960 || yearValue > 2024) {
            yearInput.style.borderColor = 'red';
            if (!yearError) {
                const errorSpan = document.createElement('span');
                errorSpan.id = 'yearError';
                errorSpan.className = 'error-message';
                errorSpan.style.color = 'red';
                errorSpan.innerText = 'Lūdzu ievadiet gadu starp 1960 un 2024.';
                yearInput.parentNode.appendChild(errorSpan);
            }
            isValid = false;
        } else {
            yearInput.style.borderColor = 'green';
            if (yearError) {
                yearError.parentNode.removeChild(yearError);
            }
        }

        const descriptionValue = descriptionInput.value.trim();
        const descriptionError = document.getElementById('descriptionError');
        if (descriptionValue === "") {
            descriptionInput.style.borderColor = 'red';
            if (!descriptionError) {
                const errorSpan = document.createElement('span');
                errorSpan.id = 'descriptionError';
                errorSpan.className = 'error-message';
                errorSpan.style.color = 'red';
                errorSpan.innerText = 'Lūdzu ievadiet aprakstu';
                descriptionInput.parentNode.appendChild(errorSpan);
            }
            isValid = false;
        } else {
            descriptionInput.style.borderColor = 'green';
            if (descriptionError) {
                descriptionError.parentNode.removeChild(descriptionError);
            }
        }

        const priceValue = parseInt(rentalRateInput.value.trim());
        const priceError = document.getElementById('priceError');
        if (isNaN(priceValue) || priceValue <= 0) {
            rentalRateInput.style.borderColor = 'red';
            if (!priceError) {
                const errorSpan = document.createElement('span');
                errorSpan.id = 'priceError';
                errorSpan.className = 'error-message';
                errorSpan.style.color = 'red';
                errorSpan.innerText = 'Lūdzu ievadiet derīgu cenu.';
                rentalRateInput.parentNode.appendChild(errorSpan);
            }
            isValid = false;
        } else {
            rentalRateInput.style.borderColor = 'green';
            if (priceError) {
                priceError.parentNode.removeChild(priceError);
            }
        }

        if (transmissionInput.value === "") {
            transmissionInput.style.borderColor = 'red';
            let transmissionError = document.getElementById('transmissionError');
            if (!transmissionError) {
                transmissionError = document.createElement('span');
                transmissionError.id = 'transmissionError';
                transmissionError.className = 'error-message';
                transmissionError.style.color = 'red';
                transmissionError.innerText = 'Lūdzu izvēlieties transmisijas tipu.';
                transmissionInput.parentNode.appendChild(transmissionError);
            }
            isValid = false;
        } else {
            transmissionInput.style.borderColor = 'green';
            let transmissionError = document.getElementById('transmissionError');
            if (transmissionError) {
                transmissionError.parentNode.removeChild(transmissionError);
            }
        }

        let hasImage = false;
        imageInputs.forEach((input, index) => {
            const imageErrorId = `imageError${index + 1}`;
            const imageError = document.getElementById(imageErrorId);
            const previewContainer = document.getElementById(`preview${index + 1}`);
            if (!input.files || input.files.length === 0) {
                input.style.borderColor = 'red';
                if (!imageError) {
                    const errorSpan = document.createElement('span');
                    errorSpan.id = imageErrorId;
                    errorSpan.className = 'error-message';
                    errorSpan.style.color = 'red';
                    errorSpan.innerText = 'Lūdzu pievienojiet attēlu.';
                    previewContainer.appendChild(errorSpan);
                }
                isValid = false;
            } else {
                input.style.borderColor = 'green';
                if (imageError) {
                    imageError.parentNode.removeChild(imageError);
                }
                hasImage = true;
            }
        });

        if (!hasImage) {
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    [carSearchInput, rentalRateInput, transmissionInput].forEach(input => {
        input.addEventListener('input', function() {
            if (input.value.trim() !== "") {
                input.style.borderColor = 'green';
                let errorSpan = input.parentNode.querySelector('.error-message');
                if (errorSpan) {
                    errorSpan.parentNode.removeChild(errorSpan);
                }
            } else {
                input.style.borderColor = '';
            }
        });
    });

    yearInput.addEventListener('input', function() {
        const yearValue = parseInt(yearInput.value.trim());
        const yearError = document.getElementById('yearError');
        if (yearValue >= 1960 && yearValue <= 2024) {
            yearInput.style.borderColor = 'green';
            if (yearError) {
                yearError.parentNode.removeChild(yearError);
            }
        } else {
            yearInput.style.borderColor = 'red';
            if (!yearError) {
                const errorSpan = document.createElement('span');
                errorSpan.id = 'yearError';
                errorSpan.className = 'error-message';
                errorSpan.style.color = 'red';
                errorSpan.innerText = 'Lūdzu ievadiet gadu starp 1960 un 2024.';
                yearInput.parentNode.appendChild(errorSpan);
            }
        }
    });

    descriptionInput.addEventListener('input', function() {
        const descriptionValue = descriptionInput.value.trim();
        const descriptionError = document.getElementById('descriptionError');
        if (descriptionValue === "") {
            descriptionInput.style.borderColor = 'red';
            if (!descriptionError) {
                const errorSpan = document.createElement('span');
                errorSpan.id = 'descriptionError';
                errorSpan.className = 'error-message';
                errorSpan.style.color = 'red';
                errorSpan.innerText = 'Lūdzu ievadiet aprakstu.';
                descriptionInput.parentNode.appendChild(errorSpan);
            }
        } else {
            descriptionInput.style.borderColor = 'green';
            if (descriptionError) {
                descriptionError.parentNode.removeChild(descriptionError);
            }
        }
    });

    imageInputs.forEach((input, index) => {
        input.addEventListener('change', function() {
            const imageErrorId = `imageError${index + 1}`;
            const imageError = document.getElementById(imageErrorId);
            const previewContainer = document.getElementById(`preview${index + 1}`);
            if (input.files && input.files.length > 0) {
                input.style.borderColor = 'green';
                if (imageError) {
                    imageError.parentNode.removeChild(imageError);
                }
            } else {
                input.style.borderColor = 'red';
                if (!imageError) {
                    const errorSpan = document.createElement('span');
                    errorSpan.id = imageErrorId;
                    errorSpan.className = 'error-message';
                    errorSpan.style.color = 'red';
                    errorSpan.innerText = 'Lūdzu pievienojiet attēlu.';
                    previewContainer.appendChild(errorSpan);
                }
            }
        });
    });
});

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
                    error.textContent = 'Lūdzu ievadiet derīgu automašīnas marku.';
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
            error.textContent = 'Lūdzu ievadiet derīgu automašīnas marku.';
            event.preventDefault();
        } else {
            error.textContent = '';
        }
    });
});



