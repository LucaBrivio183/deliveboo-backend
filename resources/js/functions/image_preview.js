const imageInput = document.querySelector('#image');

imageInput.addEventListener('change', showPreview);

function showPreview(event) {
    if (event.target.files.length > 0) {
        const src = URL.createObjectURL(event.target.files[0]);
        const preview = document.getElementById("file-image-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}
