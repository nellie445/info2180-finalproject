function saveNote() {
    // Get the note content from the textarea
    const noteContent = document.getElementById('noteContent').value;
  
    // Validate the note content (add your own validation logic)
  
    // Simulate updating the contact's updated_at timestamp
    const updatedAt = new Date().toLocaleString();
  
    // Simulate adding the new note to the list of existing notes
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
  }
  