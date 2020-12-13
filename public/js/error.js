document.addEventListener('DOMContentLoaded', function () {
        const dogImage = document.getElementById('error-img');
        const errorMsg = document.getElementById('error-msg');

        fetch('https://dog.ceo/api/breeds/image/random')
            .then(response => response.json())
            .then(data => {
                dogImage.innerHTML = `<img src="${data.message}" alt="doggo img"/>`;
                errorMsg.innerHTML = `<p>ERROR 404 - Page not found</p>`;
            })
    }
);

