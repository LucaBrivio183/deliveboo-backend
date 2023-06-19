// Show image preview when an image is added in Create and Edit views

const imageInput = document.getElementById("image");

// Event starts when changing image url
imageInput.addEventListener('change', showPreview);

function showPreview(event) {
    if (event.target.files.length > 0) {
        const src = URL.createObjectURL(event.target.files[0]);
        const preview = document.getElementById("file-image-preview");
        preview.src = src;
        preview.style.display = "block";
        preview.classList.add('mt-4', 'mb-3');
    }
}
