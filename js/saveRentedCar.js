$(document).ready(function() {
    $('.rent-button').on('click', function() {
        var carId = $(this).data('car-id');
        $('#datepicker-' + carId).show();
        var selectedDates = JSON.parse(localStorage.getItem('selectedDates_' + carId)) || [];

        $.ajax({
            type: "GET",
            url: "../functions/get-rented-cars.php",
            data: { car_id: carId },
            success: function(response) {
                var rentedDates = response;

                $('#datepicker-' + carId).datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: 0,
                    beforeShowDay: function(date) {
                        var formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
                        var isRented = $.inArray(formattedDate, rentedDates) >= 0;
                        var isAvailable = !isRented;
                        var isSelected = $.inArray(formattedDate, selectedDates) >= 0;
                        return [!isSelected, isAvailable ? 'available' : 'rented', isRented ? 'Already rented' : ''];
                    },
                    onSelect: function(date) {
                        selectedDates.push(date);
                        localStorage.setItem('selectedDates_' + carId, JSON.stringify(selectedDates));
                        $.ajax({
                            type: "GET",
                            url: "../functions/save-rented-car.php",
                            data: { car_id: carId, rent_date: date },
                            success: function(response) {
                                alert(response);
                                rentedDates.push(date);
                                $('#datepicker-' + carId).datepicker('refresh');
                            }
                        });
                    }
                }).datepicker('show'); // Trigger the datepicker to open immediately
            }
        });

    });
});
function cancelReservation(carId, rentDate) {
    if (confirm("Vai tiešām vēlaties atcelt nomu?")) {
        $.ajax({
            type: "POST",
            url: "../functions/cancel-user-reservation.php",
            data: { carId: carId, rentDate: rentDate },
            success: function(response) {
                console.log(response);
                // Remove canceled date from selectedDates array in local storage
                var selectedDates = JSON.parse(localStorage.getItem('selectedDates_' + carId)) || [];
                var index = selectedDates.indexOf(rentDate);
                if (index !== -1) {
                    selectedDates.splice(index, 1);
                    localStorage.setItem('selectedDates_' + carId, JSON.stringify(selectedDates));
                    console.log('Canceled date removed:', rentDate); // Check if the canceled date is removed
                }
                // Refresh the datepicker
                $('#datepicker-' + carId + ' .datepicker-input').datepicker('refresh');
                // Reload the page after successful cancellation
                location.reload();
            },

            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}
