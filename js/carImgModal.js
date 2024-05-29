function openModal(carId, index) {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImage");
    var images = document.querySelectorAll('.car-image[data-car-id="' + carId + '"]');
    modal.style.display = "block";
    modalImg.src = images[index].src;
    var currentIndex = index;

    document.querySelector('.close').onclick = function() {
        modal.style.display = "none";
    };

    document.querySelector('.prev').onclick = function() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        modalImg.src = images[currentIndex].src;
    };

    document.querySelector('.next').onclick = function() {
        currentIndex = (currentIndex + 1) % images.length;
        modalImg.src = images[currentIndex].src;
    };
}

document.querySelectorAll('.car-image').forEach(function(image, index) {
    image.addEventListener('click', function() {
        var carId = this.getAttribute('data-car-id');
        var imageIndex = Array.from(document.querySelectorAll('.car-image[data-car-id="' + carId + '"]')).indexOf(this);
        openModal(carId, imageIndex);
    });
});

window.onclick = function(event) {
    var modal = document.getElementById("imageModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
};