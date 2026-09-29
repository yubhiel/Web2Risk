// validation du form
const form = document.getElementById('contact-form');
const erreur = document.getElementById('form-error');

form.addEventListener('submit', function (e) {
    const nom = document.getElementById('nom').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    if (nom === '' || email === '' || message === '') {
        e.preventDefault();
        erreur.textContent = 'Please fill in all the fields.';
    } else if (email.indexOf('@') === -1) {
        e.preventDefault();
        erreur.textContent = 'Please enter a valid email address.';
    }
});

// message apres contact.php
const params = new URLSearchParams(window.location.search);

if (params.get('envoi') === 'ok') {
    form.insertAdjacentHTML('beforebegin', '<p id="form-success">Thank you! Your message has been sent.</p>');
} else if (params.get('envoi') === 'erreur') {
    erreur.textContent = 'Something went wrong, please try again.';
}