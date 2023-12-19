const dropdownElement = document.querySelector('#navbarDropdown');

dropdownElement.addEventListener('focusin', function () {
    dropdownElement.classList.add('current_page');
});

dropdownElement.addEventListener('focusout', function () {
    dropdownElement.classList.remove('current_page');
});

var textarea = document.getElementById("description");
function autoResize() {

    textarea.style.height = 'auto'
    textarea.style.height = (textarea.scrollHeight) + 'px';
};
autoResize()
textarea.addEventListener("input", autoResize);