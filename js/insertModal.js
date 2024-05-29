document.addEventListener("DOMContentLoaded", function() {
    var openInsertModal = document.getElementById("openInsertModal");
    var modal = document.getElementById("insertModal");
    var closeButton = modal.querySelector(".close");

    openInsertModal.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeButton.addEventListener("click", function() {
        modal.style.display = "none";
    });
});

function previewImage(input, previewId) {
    var preview = document.getElementById(previewId);
    while (preview.firstChild) {
        preview.removeChild(preview.firstChild);
    }

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement("img");
            img.src = e.target.result;
            img.style.maxWidth = "300px";
            img.style.maxHeight = "100px";
            preview.appendChild(img);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

