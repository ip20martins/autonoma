
    $(document).ready(function(){
    // Event listener for the edit button
    $('.edit-btn').click(function(){
        // Get the car ID associated with the edit button
        var carId = $(this).closest('.car-box').data('car-id');

        // AJAX request to fetch car details
        $.ajax({
            url: 'get_car_details.php', // Adjust the URL to the script that fetches car details
            type: 'POST',
            data: {car_id: carId},
            dataType: 'json',
            success: function(response) {
                // Populate modal inputs with fetched car details
                $('#car_id').val(response.car_id);
                $('#car_name').val(response.car_name);
                $('#rental_rate').val(response.rental_rate);
                $('#year').val(response.year);
                $('#color').val(response.color);
                $('#mileage').val(response.mileage);
                $('#transmission').val(response.transmission);
                $('#description').val(response.description);

                // Display the edit car modal
                $('#editCarModal').css('display', 'block');
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });

    // Close the modal when the close button is clicked
    $('.close').click(function(){
    $('#editCarModal').css('display', 'none');
});

    // Close the modal when the user clicks outside of it
    $(window).click(function(event) {
    if (event.target == $('#editCarModal')[0]) {
    $('#editCarModal').css('display', 'none');
}
});
});