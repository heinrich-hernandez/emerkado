// Display the file name in the label
// Usage: displayFileName('inputId');
function displayFileName(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
        // Find the associated label using the 'for' attribute
        const label = document.querySelector(`label[aria-describedby="${inputId}"]`);
        if (label) {
            input.addEventListener('change', function() {
                const fileName = this.files.length > 0 ? this.files[0].name : 'Choose file';
                label.textContent = fileName;
            });
        }
    }
}

function initializeFileUploads() {
    const fileInputs = [
        'coop_profile_picture',
        'coop_valid_id_picture',
        'merchant_profile_picture',
        'merchant_valid_id_picture',
        // Add more input IDS as needed
    ];

    fileInputs.forEach(inputId => {
        displayFileName(inputId);
    });
}

document.addEventListener('DOMContentLoaded', initializeFileUploads);
