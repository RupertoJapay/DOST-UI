document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('uploadForm');

  form.addEventListener('submit', function (event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.classList.add('was-validated');
  });
});

// Clear file input when "Remove" is clicked
function clearFileInput() {
  const fileInput = document.getElementById('fileInput');
  fileInput.value = '';
}
