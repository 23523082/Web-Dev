document.getElementById('likeButton').addEventListener('click', function () {
    const id = document.querySelector('input[name="id"]').value;

    if (sessionStorage.getItem(`liked_${id}`)) {
        alert('You have already liked this product.');
        return;
    }

    fetch('likeProduct.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Thank you for liking this product!');
                sessionStorage.setItem(`liked_${id}`, true);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your request.');
        });
});
