/**
 * Toggles the visibility of the password field.
 * 
 * @param {string} inputId - The ID of the input field to toggle.
 * @param {HTMLElement} iconElement - The icon element to update based on the state.
 */
function togglePassword(inputId, iconElement) {
    const input = document.getElementById(inputId);
    const iconImg = iconElement.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        iconImg.classList.remove('bi-eye-slash-fill');
        iconImg.classList.add('bi-eye-fill');
        iconImg.setAttribute('data-toggle', 'visible');
    } else {
        input.type = "password";
        iconImg.classList.remove('bi-eye-fill');
        iconImg.classList.add('bi-eye-slash-fill');
        iconImg.setAttribute('data-toggle', 'hidden');
    }
}
