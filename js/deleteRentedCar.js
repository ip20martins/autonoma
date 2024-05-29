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
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}
