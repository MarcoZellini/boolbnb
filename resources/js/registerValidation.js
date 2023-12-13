let submitBtn, message;

document.addEventListener('DOMContentLoaded', function () {
    submitBtn = document.getElementById('submitBtn');

    console.log('Submit', submitBtn);

    message = document.getElementById('message');

    console.log("message", message);

});

document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('password-confirm').value;

    // RESETTA IL MESSAGGIO
    message.textContent = '';

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

/* document.getElementById('submitBtn').addEventListener("click", function (e) {
    e.preventDefault();

    let password = document.getElementById('password').value;

    console.log(password);

    let confirmPassword = document.getElementById('password-confirm').value;

    console.log(confirmPassword);

    if (password.length >= 8) {

        console.log("length >= 8");

        if (password.replace(/\s/g, '').length === password.length) {
            console.log("Non sono stati inseriti spazi");

            if (password === confirmPassword) {
                console.log("Le password corrispondono!");
                e.preventDefault();
                message.innerHTML =
                    'Le password corrispondono!';
                document.getElementById('registerForm').submit();
                return false
            } else {
                message.innerHTML =
                    'Le password non corrispondono!';
                e.preventDefault();
                return false
            }

        } else {
            console.log("Contiene spazi");
            message.innerHTML =
                'Le password non deve contenere spazi!';
            e.preventDefault();
            return false
        }
    } else {
        console.log("Lunghezza errata");
        message.innerHTML =
            'La password deve essere lunga almeno 8 caratteri!';
        e.preventDefault();
        return false
    }



}) */

/*     function checkPass() {
                if (document.getElementById('password').value.trim() !=
    document.getElementById('password-confirm').value.trim() || document.getElementById('password')
    .value
    .length < 8) {

        console.log(document.getElementById('password').value.length);
    message.style.color = 'red';

    if (document.getElementById('password').value.length < 8) {
        message.innerHTML =
        'Il campo password deve essere lungo almeno 8 caratteri.';
                    } else {
        message.innerHTML =
        'Il campo password e il campo conferma devono essere identici';
                    }

                    // submitBtn.disabled = true;
                } else {
        message.innerHTML = '';
    // submitBtn.disabled = false;
    document.getElementById('registerForm').submit();
                }
            } */
