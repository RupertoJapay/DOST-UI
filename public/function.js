document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('uploadForm');
  if (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      } else {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.disabled = true;
      }
      form.classList.add('was-validated');
    });
  }
});

// Clear file input when "Remove" is clicked
function clearFileInput(inputId) {
  const fileInput = document.getElementById(inputId);
  if (fileInput) {
    fileInput.value = '';
  }
}

// Auto-submit the form when the staff type dropdown changes
document.addEventListener('DOMContentLoaded', () => {
  const typeFilter = document.getElementById('typeFilter');
  if (typeFilter) {
    typeFilter.addEventListener('change', function () {
      this.form.submit();
    });
  }
});

document.getElementById('statusFilter').addEventListener('change', function() {
      this.form.submit();
});


