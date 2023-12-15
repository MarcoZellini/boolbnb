
const form = document.querySelector('#payment-form');

braintree.dropin.create({
    authorization: document.querySelector('#client_token').value,
    container: document.querySelector('#dropin-container'),
    // ...plus remaining configuration
}, (error, dropinInstance) => {
    if (error) console.error(error);
    // Use 'dropinInstance' here
    // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
    form.addEventListener('submit', event => {
        event.preventDefault();

        dropinInstance.requestPaymentMethod((error, payload) => {
            if (error) console.error(error);

            // Step four: when the user is ready to complete their
            //   transaction, use the dropinInstance to get a payment
            //   method nonce for the user's selected payment method, then add
            //   it a the hidden field before submitting the complete form to
            //   a server-side integration
            document.querySelector('#nonce').value = payload.nonce;
            document.querySelector('#form_button').style.display = 'none';
            form.submit();
        });
    });
});
