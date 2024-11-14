document.getElementById('checkBtn').addEventListener('click', () => {
    const paragraph = document.getElementById('paragraph').value;
  
    document.getElementById('result').textContent = "Processing...";
  
    if (!paragraph) {
        document.getElementById('result').textContent = "Please enter a paragraph.";
        return;
    }
  
    document.getElementById('result').textContent = "Sending request to the server...";
  
    fetch('check_ai.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ text: paragraph })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Server error: ${response.status}`);
        }
        document.getElementById('result').textContent = "Server responded, processing data...";
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const feedback = data.data;
            
            // Display the entire object as a formatted JSON string
            document.getElementById('result').innerHTML = `<b>Feedback:</b> <pre>${JSON.stringify(feedback, null, 2)}</pre>`;
        } else {
            document.getElementById('result').textContent = "An error occurred while processing the text.";
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('result').textContent = `An error occurred: ${error.message}`;
    });
  });
  