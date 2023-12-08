/* Dom elements */
const SuggestedAddress = document.getElementById('Suggested_Address');

function searchAddress(query) {
    const apiKey = 'zGXu3iFl86vJs8yD3Uq6OGoANFEGzFkS';
    const apiUrl = `https://api.tomtom.com/search/2/search/${query}.json?countrySet=IT&key=${apiKey}`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            SuggestedAddress.innerHTML = "";


            let hints = data.results
            hints.forEach((hint, i) => {
                let position = hint.position
                let address = hint.address.freeformAddress
                let option = document.createElement('option');
                option.setAttribute('id', 'option' + i)
                option.value = address;
                option.innerHTML = address;
                SuggestedAddress.appendChild(option);

            });

        })
        .catch(error => {
            console.error('Errore nella chiamata API:', error);
        });
}

document.getElementById('address').addEventListener('keyup', function (event) {
    const inputValue = event.target.value;

    if (inputValue.length > 2) {
        setTimeout(() => {
            searchAddress(inputValue);
        }, 200);
    }

});