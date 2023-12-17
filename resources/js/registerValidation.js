let submitBtn, message, message_date_of_birth;

document.addEventListener('DOMContentLoaded', function () {
    submitBtn = document.getElementById('submitBtn');

    console.log('Submit', submitBtn);

    message = document.getElementById('message');

    console.log("message", message);

    message_date_of_birth = document.getElementById('message_date_of_birth');

    console.log("message_date_of_birth", message_date_of_birth);

});

document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('password-confirm').value;
    let dateOfBirth = document.getElementById('date_of_birth').value
    // RESETTA IL MESSAGGIO
    message.textContent = '';

    /* validazione data di nascita  */

    let currentDate = new Date()
    let userDate = new Date(dateOfBirth)

    if (userDate > currentDate) {
        message_date_of_birth.textContent = 'la data di nascita non puo essere futura';
        return false;
    }

    const MaxAge = 100
    const MinAge = 18
    let UserAge = currentDate.getFullYear() - userDate.getFullYear()

    if (UserAge > MaxAge) {
        message_date_of_birth.textContent = `l'utente non puo avere piu di 100 anni`;
        return false;
    }
    else if (UserAge < MinAge) {
        message_date_of_birth.textContent = `l'utente deve essere maggiorenne`;
        return false;
    }

    /* validazione password */

    // CONTROLLA CHE LA PASSWORD SIA LUNGA ALMENO 8 CARATTERI
    if (password.length < 8) {
        message.textContent = 'La password deve essere lunga almeno 8 caratteri';
        return false;
    }

    // CONTROLLA CHE LA PASSWORD CONTENGA ALMENO UNA LETTERA MAIUSCOLA
    if (!/[A-Z]/.test(password)) {
        message.textContent = 'La password deve contenere almeno una lettera maiuscola';
        return false;
    }

    // CONTROLLA CHE LA PASSWORD CONTENGA ALMENO UNA LETTERA MINUSCOLA
    if (!/[a-z]/.test(password)) {
        message.textContent = 'La password deve contenere almeno una lettera minuscola';
        return false;
    }

    // CONTROLLA CHE LA PASSWORD CONTENGA ALMENO UN NUMERO
    if (!/\d/.test(password)) {
        message.textContent = 'La password deve contenere almeno un numero';
        return false;
    }

    // CONTROLLA CHE LA PASSWORD NON CONTENGA SPAZI BIANCHI
    if (/\s/.test(password)) {
        message.textContent = 'La password non può contenere spazi bianchi';
        return false;
    }

    // CONTROLLA CHE IL CAMPO PASSWORD E CONFIRM PASSWORD COMBACINO
    if (password !== confirmPassword) {
        message.textContent = 'I campi password e conferma password devono essere identici';
        return false;
    }


    // SE TUTTI I CONTROLLI PASSANO IL FORM VIENE INVIATI
    document.getElementById('registerForm').submit()
}

);
