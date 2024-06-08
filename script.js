document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    fetch('register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
        var responseDiv = document.getElementById('response');
        if (data.error) {
            responseDiv.textContent = 'Error: ' + data.error;
            responseDiv.style.color = 'red';
        } else {
            responseDiv.textContent = 'Registration successful! Your API token: ' + data.api_token;
            responseDiv.style.color = 'green';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
