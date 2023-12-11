/* Dom elements */
const suggestedAddress = document.getElementById('suggested_address');
const addressInput = document.getElementById('address');

let selectedOption = false;

function searchAddress(query) {
    const apiKey = 'zGXu3iFl86vJs8yD3Uq6OGoANFEGzFkS';
    const apiUrl = `https://api.tomtom.com/search/2/search/${query}.json?countrySet=IT&key=${apiKey}`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            suggestedAddress.innerHTML = "";
            let hints = data.results;

            hints.forEach((hint, i) => {
                let address = hint.address.freeformAddress;
                let option = document.createElement('option');
                option.setAttribute('id', 'option' + i);
                option.value = address;
                option.innerHTML = address;
                suggestedAddress.appendChild(option);
            });

            selectedOption = false;
        })
        .catch(error => {
            console.error('Errore nella chiamata API:', error);
        });
}

addressInput.addEventListener('keyup', function (event) {
    const inputValue = event.target.value;

    if (inputValue.length > 2 && !selectedOption) {
        setTimeout(() => {
            searchAddress(inputValue);
        }, 200);
    }
});

addressInput.addEventListener('change', function () {
    selectedOption = true;
    suggestedAddress.innerHTML = "";
});

addressInput.addEventListener('keydown', function (event) {
    const key = event.key;
    if (key === "Backspace" || key === "Delete") {
        selectedOption = false
    }
})
