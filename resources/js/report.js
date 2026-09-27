document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const removeButton = document.getElementById('remove-image');

    if (!imageInput) {
        return;
    }

    imageInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {

            previewImage.src = event.target.result;

            previewContainer.style.display = 'block';
            uploadPlaceholder.style.display = 'none';

        };

        reader.readAsDataURL(file);
    });


    removeButton.addEventListener('click', function () {

        imageInput.value = '';

        previewImage.src = '';

        previewContainer.style.display = 'none';
        uploadPlaceholder.style.display = 'flex';

    });

});