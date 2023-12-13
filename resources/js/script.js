const dropdownElement = document.querySelector('#navbarDropdown');

dropdownElement.addEventListener('focusin', function () {
    dropdownElement.classList.add('current_page');
});

dropdownElement.addEventListener('focusout', function () {
    dropdownElement.classList.remove('current_page');
});