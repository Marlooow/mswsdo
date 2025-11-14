// resources/js/components/FormSubmission.js

export function submitForm(event, endpoint) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    fetch(endpoint, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.error && data.showModal) {
            showModal(data.message); // Assuming showModal is imported from Modal.js
        } else if (data.success) {
            window.location.href = data.redirect; // Redirect on success
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
