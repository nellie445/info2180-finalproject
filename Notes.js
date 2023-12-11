function saveNote() {
    // Get the note content from the textarea
    const noteContent = document.getElementById('noteContent').value;
  
    // Validate the note content (add your own validation logic)
  
    // Simulate updating the contact's updated_at timestamp
    const updatedAt = new Date().toLocaleString();
  
    // Create an object with the note content
    const data = {
        noteContent: encodeURIComponent(noteContent),
    };
  
    // Make a fetch request to save the note
    fetch('main.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(data).toString(),
    })
    .then(response => {
        if (response.ok) {
            // Update the datetime and display the new note
            const updatedAt = new Date().toLocaleString();
            const newNote = document.createElement('div');
            newNote.className = 'note';
            newNote.innerHTML = `
                <p>${noteContent}</p>
                <span class="datetime">${updatedAt}</span>
            `;
  
            // Append the new note to the existing notes section
            const existingNotes = document.querySelector('.existing-notes');
            existingNotes.appendChild(newNote);
  
            // Clear the textarea after saving the note
            document.getElementById('noteContent').value = '';
        } else {
            return Promise.reject('Failed to save the note!');
        }
    })
    .catch(error => console.log('There was an error: ' + error));
}
  
// Make a fetch request to retrieve data from the server
fetch('main.php?querytypes=' + encodeURIComponent('') + '&email=' + encodeURIComponent('') + '&password=' + encodeURIComponent(''), { method: 'GET' })
    .then(response => {
        if (response.ok) {
            return response.text();
        } else {
            return Promise.reject('Failed to retrieve data!');
        }
    })
    .then(data => {
        // Process the data
        console.log(data);
    })
    .catch(error => console.log('There was an error: ' + error));
  