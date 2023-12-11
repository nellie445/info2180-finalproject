// JavaScript code for handling form submission
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('form');
    const errorContainer = document.getElementById('error-container');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Get form data
        const formData = new FormData(form);

        // Use fetch to send data to the server
        fetch('main.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Assuming the server returns a plain text response
        })
        .then(data => {
            // Check the response for success or error messages
            if (data.includes('success')) {
                // Successful submission
                window.location = "NewUser.html";
            } else {
                // Unsuccessful submission, display error messages
                displayErrors(data);
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    });

    function displayErrors(errorMessage) {
        // Clear previous error messages
        errorContainer.innerHTML = '';

        // Display new error message
        const errorParagraph = document.createElement('p');
        errorParagraph.textContent = errorMessage;
        errorContainer.appendChild(errorParagraph);
    }
});
